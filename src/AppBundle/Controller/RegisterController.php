<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @internal param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //connect to database
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //passowrd encoding
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            //create the user
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }
        return $this->render('AppBundle:Register:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
