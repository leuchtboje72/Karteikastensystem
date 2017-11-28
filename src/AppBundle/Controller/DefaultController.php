<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/dashboard")
     */
    public function dashboardAction() {

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

            return $this->render(':default:dashboard.html.twig', [
                'users' => $users
            ]);
    }

    /**
     * @Route("/edituser/{id}", name="user.edit")
     * @ParamConverter("user", class="AppBundle\Entity\User")
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editUserAction (Request $request, User $user, UserPasswordEncoderInterface $encoder) {

        $em = $this->getDoctrine()->getManager();
        //a form to edit the user
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //passowrd encoding
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $em->persist($user);
            $em->flush();
        }

        return $this->render(':default:editUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
