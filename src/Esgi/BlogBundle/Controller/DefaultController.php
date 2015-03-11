<?php

namespace Esgi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Esgi\BlogBundle\Entity\Post;

use Esgi\BlogBundle\Form\ProposePostType;

class DefaultController extends Controller
{
    /**
     * @Route("/blog")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $publishedPosts = $em->getRepository('BlogBundle:Post')->findPublicationStatus(0);

        return array(
            'posts' => $publishedPosts,
        );
    }

    /**
     * @Route("/compute/{a}/{b}")
     * @Template()
     */
     public function computeAction($a, $b)
     {
     	return [
     		'sum' => $this->get('esgi.computer')->addition($a, $b),
     		'power' => $this->get('esgi.computer')->power($a)
     	];
     }

     /**
     * @Route("/new-post")
     * @Template()
     */
     public function newPostAction()
     {
        $post = new Post();
        $post->setTitle('Le titre du post');
        $post->setBody('Le body body');
        $post->setIsPublished(false);

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($post);
        $em->flush();

        return new Response('le post ' . $post->getId() . ' a été crée');
     }

     /**
     * @Route("/blog/propose", name="blog_propose")
     * @Template()
     */
     public function proposeAction(Request $request)
     {
        $post = new Post();
        $form = $this->createForm(new ProposePostType(), $post);

        if($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Your proposition has been saved'
                );

                return $this->redirect($this->generateUrl('blog_propose'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
     }
}
