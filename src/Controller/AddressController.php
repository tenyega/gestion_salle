<?php

namespace App\Controller;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/hall')]
class AddressController extends AbstractController
{
    
    public function getAll(AddressRepository $ar): Response
    {
       return $addresses = $ar->findAll();
       
    }
    
    public function getAllCities(AddressRepository $ar): Response
    {
       
        return $addresses = $ar->findAll();
       
    }

   
    public function getOne(AddressRepository $ar, int $id) : Response
    {
        return $address = $ar->findOneById($id);
    }
}
