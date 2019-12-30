<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Form\UserFormType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class UserController
 * @package App\Controller
 * @Route("/user", name="")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_account")
     */
    public function userAccount(Request $request){
        
        $id=$request->request->get('id');
        $user= $this->getUser();
        return $this->render('user/index.html.twig', ['user'=>$user]);
    }

    /**
     * @Route("/edit", name="user_edit")
     */
    public function edit(Request $request, FileUploader $fileUploader): Response
    {
        $user=$this->getUser();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form['photo']->getData();
            if ($photoFile) {
                $fileSystem=new Filesystem();
                $photoFileName = $fileUploader->upload($photoFile);
                $fileSystem->remove($user->getPhoto());
                $user->setPhoto($photoFileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_account');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
