<?php

namespace App\Tests\Domain\Service;

use App\Domain\Entity\User;
use App\Domain\Service\RegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class RegistrationServiceTest extends TestCase
{
    private EntityManagerInterface $entityManagerMock;
    private LoggerInterface $loggerMock;
    private RegistrationService $registrationService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->loggerMock = $this->createMock(LoggerInterface::class);
        $this->registrationService = new RegistrationService($this->entityManagerMock, $this->loggerMock);
    }

    public function testRegistration()
    {
        $user = new User();
        $user->setFirstName('Scoo');
        $user->setLastName('Bidoo');
        $user->setUserName('Scoobidoo');
        $user->setEmail('scoo@bi.doo');
        $user->setPassword('S@m!');


        $this->entityManagerMock->expects($this->once())->method('persist')->with($user);
        $this->entityManagerMock->expects($this->once())->method('flush');

        $this->registrationService->register($user);

    }
}