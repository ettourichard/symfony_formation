<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('blog_index'));
    }

    /*
     * @Route("/redirect-user", name="sonata_user_profile_edit")
     */
    /*public function redirectAction()
    {
        return $this->redirect($this->generateUrl('blog_index'));
    }*/
}
