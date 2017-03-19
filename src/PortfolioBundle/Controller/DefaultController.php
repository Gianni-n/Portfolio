<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PortfolioBundle:Default:index.html.twig');
    }

    public function projectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('PortfolioBundle:Project')->getByDate();


        return $this->render('PortfolioBundle:Default:projects.html.twig', array(
            'projects' => $projects,
        ));
    }

    public function aboutAction()
    {
        return $this->render('PortfolioBundle:Default:about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('PortfolioBundle:Default:contact.html.twig');
    }
}
