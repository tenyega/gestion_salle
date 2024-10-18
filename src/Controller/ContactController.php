<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Address;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
class ContactController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier, private EntityManagerInterface $em) {}
    #[Route('', name: 'app_contact', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $this->getUser(),
                (new TemplatedEmail())
                    ->from(new Address('hall4all@email.com', 'hall4all'))
                    ->to((string) $this->getUser()->getEmail())
                    ->subject('Thank you for contacting us ')
                    ->htmlTemplate('contact/confirmation.html.twig')
            );
            $this->em->flush();
            return $this->redirectToRoute('app_reservation_index');
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
