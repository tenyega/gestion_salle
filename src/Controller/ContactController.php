<?php

namespace App\Controller;

// use App\DTO\ContactDTO; // Corrected namespace case
use App\Form\ContactType;
use Symfony\Component\Mime\Address;
use App\Security\EmailVerifier;
use App\Service\EmailNotificationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

#[Route('/contact')]
class ContactController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier, private EntityManagerInterface $em) {}

    #[Route('', name: 'app_contact', methods: ['GET', 'POST'])] // Added POST method
    public function index(Request $request, MailerInterface $mailer, EmailNotificationService $emailNotificationService): Response
    {
        // $data = new ContactDTO(); // Corrected case for class name
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        //Doc symfony:  https://symfony.com/doc/current/mailer.html#creating-sending-messages
        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();
            $userEmail = $formData['email'];
            $emailNotificationService->sendEmail($userEmail,   [
                'subject' => 'Thank you for contacting us ',
                'template' => 'contact/confirmation',
            ]);




            // $email = (new TemplatedEmail())
            //     ->from(new Address($data->email)) // Correctly wrapping in Address
            //     ->to('hallForall@email.com', 'hallForall') // your adress
            //     ->subject('Contact request')
            //     ->htmlTemplate('Contact/request.html.twig')
            //     ->context(['data' => $data]);

            // $mailer->send($email);
            $this->addFlash('success', 'Your email has been sent');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}

    // {
    //     $form = $this->createForm(ContactType::class);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $this->emailVerifier->sendEmailConfirmation(
    //             'app_verify_email',
    //             $this->getUser(),
    //             (new TemplatedEmail())
    //                 ->from(new Address('hall4all@email.com', 'hall4all'))
    //                 ->to((string) $this->getUser()->getEmail())
    //                 ->subject('Thank you for contacting us ')
    //                 ->htmlTemplate('contact/confirmation.html.twig')
    //         );
    //         $this->em->flush();
    //         return $this->redirectToRoute('app_reservation_index');
    //     }


    //     return $this->render('contact/index.html.twig', [
    //         'form' => $form,
    //     ]);
    // }
