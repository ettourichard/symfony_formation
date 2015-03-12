<?php

namespace Esgi\BlogBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CategoryRestController extends FOSRestController
{

    /**
     * @ApiDoc(
     *  description="Retrieve all Categories",
     *  output="Esgi\BlogBundle\Entity\Category"
     * )
     */
    public function getCategoriesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('BlogBundle:Category')->findAll();
        $view = $this->view($categories, 200)
            ->setTemplate("BlogBundle:Categories:getCategories.html.twig")
            ->setTemplateVar('categories')
        ;

        return $this->handleView($view);
    }

    public function redirectAction()
    {
        $view = $this->redirectView($this->generateUrl('some_route'), 301);
        // or
        $view = $this->routeRedirectView('some_route', array(), 301);

        return $this->handleView($view);
    }
}