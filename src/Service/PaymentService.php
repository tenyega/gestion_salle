<?php

namespace App\Service;

use App\Entity\Payment;
use App\Repository\ReservationRepository;
use Stripe\Stripe;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class PaymentService
{
    // private string $apiKey = $this->parametmer->get('STRIPE_API_SK');

    private $domain;
    private $apiKey;
    private $user;
    private $em;
    private $rr;
    private $hourcal;
    public function __construct(protected ReservationRepository $reservationRepository, protected HourCalculator $hourCalculator, protected ParameterBagInterface $parameter, private Security $security, private EntityManagerInterface $entityManagerInterface)
    {
        $this->parameter = $parameter;
        $this->rr = $reservationRepository;
        $this->hourcal = $hourCalculator;
        // $this->stripe = $stripe; //Creating object of Stripe Class
        $this->apiKey = $this->parameter->get('STRIPE_API_SK');
        $this->domain = 'https://127.0.0.1:8000';
        $this->user = $security->getUser();
        $this->em = $entityManagerInterface;
    }

    //generate une demande de paiement vers stripe. 
    /**
     * askCheckout()
     * Méthode permettant de créer une session de paiement Stripe
     * @return Stripe\Checkout\Session
     */
    public function askCheckout(): ?Session
    {
        $reservation = $this->rr->find('3');
        $totalHours = $this->hourcal->calculateTotalHours($reservation->getStartDate()->format('Y-m-d'), $reservation->getEndDate()->format('Y-m-d'), $reservation->getStartTime()->format('H:i'), $reservation->getEndTime()->format('H:i'));

        dd(round($totalHours));
        Stripe::setApiKey($this->apiKey); // Établissement de la connexion (requête API)        
        $checkoutSession = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'tax_behavior' => 'exclusive',
                    'unit_amount' => round($totalHours) * 100, // Stripe utilise des centimes
                    'product_data' => [ // Les informations du produit sont personnalisables
                        'name' => $reservation->getHallId()->getName(),
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->domain . '/payment-success',
            'cancel_url' => $this->domain . '/payment-cancel',
            'automatic_tax' => [
                'enabled' => true,
            ],
        ]);

        return $checkoutSession;
    }
    //traitement du role de utilisateurs en fonction du paiement. 
    public function addPayment(): ?Payment
    {
        $reservation = $this->rr->find('3');
        // Adding new payment;
        $payment = new Payment();
        $payment->setAmount('1001')
            ->setPaymentDate(new \DateTimeImmutable())
            ->setPaymentStatus('Paid')
            ->setReservationId($reservation)
            ->setType('Credit Card')
        ;
        $this->em->persist($payment);
        $this->em->flush();



        return $payment;
    }
    //Generation de la facture 
    //notification par email


}
