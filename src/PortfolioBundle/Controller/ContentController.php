<?php

namespace PortfolioBundle\Controller;

use PortfolioBundle\Entity\Content;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Content controller.
 *
 */
class ContentController extends Controller
{
    /**
     * Lists all content entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contents = $em->getRepository('PortfolioBundle:Content')->findAll();
        return $this->render('PortfolioBundle:content:index.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * Creates a new content entity.
     *
     */
    public function newAction(Request $request)
    {
        $content = new Content();
        $form = $this->createForm('PortfolioBundle\Form\ContentType', $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush($content);

            return $this->redirectToRoute('content_show', array('id' => $content->getId()));
        }

        return $this->render('PortfolioBundle:content:new.html.twig', array(
            'content' => $content,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a content entity.
     *
     */
    public function showAction(Content $content)
    {
        $deleteForm = $this->createDeleteForm($content);

        return $this->render('PortfolioBundle:content:show.html.twig', array(
            'content' => $content,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing content entity.
     *
     */
    public function editAction(Request $request, Content $content)
    {
        $deleteForm = $this->createDeleteForm($content);
        $editForm = $this->createForm('PortfolioBundle\Form\ContentType', $content);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('content_edit', array('id' => $content->getId()));
        }

        return $this->render('PortfolioBundle:content:edit.html.twig', array(
            'content' => $content,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a content entity.
     *
     */
    public function deleteAction(Request $request, Content $content)
    {
        $form = $this->createDeleteForm($content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($content);
            $em->flush($content);
        }

        return $this->redirectToRoute('content_index');
    }

    /**
     * Creates a form to delete a content entity.
     *
     * @param Content $content The content entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Content $content)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('content_delete', array('id' => $content->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
