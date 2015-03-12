<?php

namespace Esgi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Esgi\BlogBundle\Entity\Post;
use Esgi\BlogBundle\Entity\Comment;

use Esgi\BlogBundle\Form\ProposePostType;
use Esgi\BlogBundle\Form\AddCommentType;

class DefaultController extends Controller
{
    /**
     * @Route("/blog", name="blog_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $publishedPosts = $em->getRepository('BlogBundle:Post')->findPublicationStatus(0);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $publishedPosts,
            $request->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return array(
            'posts' => $pagination,
        );
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


    /**
     * Page Article complet
     *
     * @Route("/blog/article/{slug}", name="page_article")
     * @Template()
     */
    public function articleAction($slug, Request $request)
     {
        $em = $this->get('doctrine.orm.entity_manager');
        $post = $em->getRepository('BlogBundle:Post')->findOneBySlug($slug);

        $category = $em->getRepository('BlogBundle:Category')->find($post->getCategory());

        $post_id = $post->getId();
        $comments = $em->getRepository('BlogBundle:Comment')->findAllByPost($post_id);

        $com = new Comment();
        $form = $this->createForm(new AddCommentType(), $com);

        if($request->getMethod() == 'POST')
        {

            $com->setPost($post);
            $form->handleRequest($request);
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($com);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Your comment has been posted'
                );

                return $this->redirect($this->generateUrl('page_article', array('slug' => $post->getSlug())));
            }
        }

        return array(
            'post'      =>  $post,
            'category'  =>  $category,
            'comments'  =>  $comments,
            'commentForm' => $form->createView(),
        );
     }

    /**
     * Page Recherche Article
     *
     * @Route("/blog/search", name="search_article")
     * @Method({"POST"})
     * @Template()
     */
    public function searchAction(Request $request)
    {
        $text = $request->request->get('text');

        $em = $this->get('doctrine.orm.entity_manager');
        $posts = $em->getRepository('BlogBundle:Post')->findLikeText($text);


        return array(
            'posts'      =>  $posts,
            'text'      =>  $text,
        );
    }

}
