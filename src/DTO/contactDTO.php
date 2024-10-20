<?php
namespace App\DTO;

use Symfony\Component\Validator\Contraints as Assert;

class ContactDTO
{
    /**
     * @Assert\NotBlank(message="Please enter your name.")
     */
    #[Assert\NotBlank]
    #[Assert\Length(min:3, max: 255)]
   
    public string $name = '';
    /**
     * @Assert\NotBlank(message="Please enter your email address.")
     * @Assert\Email(message="Please enter a valid email address.")
     */
    public string $email = '';

    /**
     * @Assert\NotBlank(message="Please enter a subject.")
     */
    #[Assert\NotBlank]
    #[Assert\Lenth(min:3, max: 200)]

    public string $subject = '';
    #[Assert\NotBlank]
    #[Assert\Lenth(min:3, max: 200)]
    public string $message = '';
}