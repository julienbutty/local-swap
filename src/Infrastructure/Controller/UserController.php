<?php

namespace App\Infrastructure\Controller;

use App\Application\DTO\RegistrationData;
use App\Application\UseCase\RegistrationUseCase;
use App\Infrastructure\Form\Type\RegistrationType;
use App\Infrastructure\Repository\UserRepository;
use Exception;
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
    private UserRepository $userRepository;

    public function __construct(RegistrationUseCase $registrationUseCase, LoggerInterface $logger, UserRepository $userRepository)
    {
        $this->registrationUseCase = $registrationUseCase;
        $this->logger = $logger;
        $this->userRepository = $userRepository;
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

                return $this->render("/user/register.html.twig");
            }
        }
        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
