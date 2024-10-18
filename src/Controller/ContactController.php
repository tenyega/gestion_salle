<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();

            // Traitement des données (comme l'envoi d'un email)
            // mail($data['email'], $data['subject'], $data['message']); // Exemple d'envoi d'email
            
            // Redirection ou message de succès
            $this->addFlash('success', 'Your message has been sent!');

            return $this->redirectToRoute('app_contact'); // Ou une autre route
        }

        return $this->render('contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
