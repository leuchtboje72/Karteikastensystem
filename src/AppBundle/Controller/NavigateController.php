<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NavigateController extends Controller
{
    /**
     * @Route("/impressum", name="impressum")
     */
    public function impressumAction()
    {
        return $this->render('AppBundle:Navigate:impressum.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/index", name="index")
     */
    public function indexAction() {
        return $this->render('AppBundle:Navigate:index.html.twig');
    }

}
