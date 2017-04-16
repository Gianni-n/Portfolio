<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contents = $em->getRepository('PortfolioBundle:Content')->findAll();
        
        return $this->render('portfolio/index.html.twig', array(
            'contents' => $contents,
        ));
    }

    public function projectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('PortfolioBundle:Project')->getByDate();
      

        return $this->render('portfolio/projects.html.twig', array(
            'projects' => $projects,
        ));
    }

    public function aboutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contents = $em->getRepository('PortfolioBundle:Content')->findAll();

        return $this->render('portfolio/about.html.twig', array(
            'contents' => $contents,
        ));
    }

    public function contactAction()
    {
        return $this->render('PortfolioBundle:Default:contact.html.twig');
    }

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
