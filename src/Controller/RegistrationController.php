<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator, \Swift_Mailer $mailer, FileUploader $fileUploader): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $photoFile = $form['photo']->getData();
            if ($photoFile) {
                $photoFileName = $fileUploader->upload($photoFile);
                $user->setPhoto($photoFileName);
            }
            $user->setPrenom($form->get('prenom')->getData());
            $user->setNom($form->get('nom')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setAuthNewsEmail('authNewsEmail');

            $user->setRoles(['ROLE_USER']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('cinecollab@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('emails/registration.html.twig',['user'=>$user]),
                    'text/html'
                )

                // you can remove the following code if you don't define a text version for your emails
            ;

            $mailer->send($message);

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
