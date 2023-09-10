<?php

namespace App\Application\UseCase\User;

use App\Application\DTO\User\RegistrationData;
use App\Domain\Entity\User;
use App\Domain\Service\User\RegistrationService;
use Psr\Log\LoggerInterface;
use RegistrationException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationUseCase
{
    private RegistrationService $registrationService;
    private UserPasswordHasherInterface $passwordHasher;
    private LoggerInterface $logger;

    public function __construct(RegistrationService $registrationService, UserPasswordHasherInterface $passwordHasher, LoggerInterface $logger)
    {
        $this->registrationService = $registrationService;
        $this->passwordHasher = $passwordHasher;
        $this->logger = $logger;
    }

    public function register(RegistrationData $data): void
    {
        try {
            $user = new User();

            $user->setFirstName($data->firstName);
            $user->setLastName($data->lastName);
            $user->setEmail($data->email);
            $user->setUserName($data->userName);

            $hashedPassword = $this->passwordHasher->hashPassword($user, $data->plainPassword);
            $user->setPassword($hashedPassword);

            $this->registrationService->register($user);
        } catch (RegistrationException $exception) {
            $this->logger->error("RegistrationUseCase: an error occured during the registration", ['exception' => $exception]);
        }
    }
}
