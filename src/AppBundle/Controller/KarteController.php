<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Karte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Karte controller.
 *
 * @Route("karte")
 */
class KarteController extends Controller
{
    /**
     * Lists all karte entities.
     *
     * @Route("/", name="karte_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kartes = $em->getRepository('AppBundle:Karte')->findAll();

        return $this->render('karte/index.html.twig', array(
            'kartes' => $kartes,
        ));
    }

    /**
     * Creates a new karte entity.
     *
     * @Route("/new", name="karte_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $karte = new Karte();
        $form = $this->createForm('AppBundle\Form\KarteType', $karte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($karte);
            $em->flush();

            return $this->redirectToRoute('karte_show', array('id' => $karte->getId()));
        }

        return $this->render('karte/new.html.twig', array(
            'karte' => $karte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a karte entity.
     *
     * @Route("/{id}", name="karte_show")
     * @Method("GET")
     */
    public function showAction(Karte $karte)
    {
        $deleteForm = $this->createDeleteForm($karte);

        return $this->render('karte/show.html.twig', array(
            'karte' => $karte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing karte entity.
     *
     * @Route("/{id}/edit", name="karte_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Karte $karte)
    {
        $deleteForm = $this->createDeleteForm($karte);
        $editForm = $this->createForm('AppBundle\Form\KarteType', $karte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('karte_edit', array('id' => $karte->getId()));
        }

        return $this->render('karte/edit.html.twig', array(
            'karte' => $karte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a karte entity.
     *
     * @Route("/{id}", name="karte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Karte $karte)
    {
        $form = $this->createDeleteForm($karte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($karte);
            $em->flush();
        }

        return $this->redirectToRoute('karte_index');
    }

    /**
     * Creates a form to delete a karte entity.
     *
     * @param Karte $karte The karte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Karte $karte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('karte_delete', array('id' => $karte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
