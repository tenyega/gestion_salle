<?php

namespace App\Controller;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
class ContactController extends AbstractController
{
    
    #[Route('', name: 'app_contact', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig');
       
    }
   
}
