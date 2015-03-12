<?php

namespace Esgi\BlogBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PostRestController extends FOSRestController
{

    /**
     * @ApiDoc(
     *  description="Retrieve all Categories",
     *  output="Esgi\BlogBundle\Entity\Post"
     * )
     */
    public function getPostsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository('BlogBundle:Post')->findAll();
        $view = $this->view($data, 200)
            ->setTemplate("BlogBundle:Users:getUsers.html.twig")
            ->setTemplateVar('posts')
        ;

        return $this->handleView($view);
    }

    public function redirectAction()
    {
        $view = $this->redirectView($this->generateUrl('/'), 301);
        // or
        $view = $this->routeRedirectView('/', array(), 301);

        return $this->handleView($view);
    }
}