<?php

namespace App\Application\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationData
{
    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    public string $userName;

    #[Assert\NotBlank]
    public string $email;

    #[Assert\NotBlank]
    public string $plainPassword;
}
