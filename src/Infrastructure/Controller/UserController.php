<?php

namespace App\Infrastructure\Controller;

use App\Application\DTO\User\RegistrationData;
use App\Application\UseCase\User\RegistrationUseCase;
use App\Infrastructure\Form\Type\User\RegistrationType;
use Psr\Log\LoggerInterface;
use RegistrationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private RegistrationUseCase $registrationUseCase;
    private LoggerInterface $logger;

    public function __construct(RegistrationUseCase $registrationUseCase, LoggerInterface $logger)
    {
        $this->registrationUseCase = $registrationUseCase;
        $this->logger = $logger;
    }

    #[Route("/register", name: "app_register")]
    public function registration(Request $request): Response
    {
        $this->logger->info("RegistrationController: Start registration");

        $registrationData = new RegistrationData();

        $form = $this->createForm(RegistrationType::class, $registrationData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->registrationUseCase->register($registrationData);

                $this->addFlash('success', 'Votre compte a bien été créé');
                $this->redirectToRoute('app_login');

            } catch (RegistrationException $exception) {
                $this->logger->error("RegistrationController: An error occured during the registration process", ['exception' => $exception]);
                $this->addFlash('error', 'Une erreur est survenue. Veuillez réessayer ultérieurement.');

                return $this->render("/User/register.html.twig");
            }
        }
        return $this->render('/User/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
