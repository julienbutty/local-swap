<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use RegistrationException;

class RegistrationService
{
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function register(User $user): void
    {
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (RegistrationException $exception) {
            $this->logger->error("RegistrationService: An error occured during the user registration {$user->getId()}", ['exception' => $exception]);
        }
    }
}
