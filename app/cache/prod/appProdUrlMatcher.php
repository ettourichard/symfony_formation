<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // esgi_blog_default_index
        if (preg_match('#^/(?P<name>[^/]++)/(?P<city>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'esgi_blog_default_index')), array (  '_controller' => 'Esgi\\BlogBundle\\Controller\\DefaultController::indexAction',));
        }

        // esgi_blog_default_compute
        if (0 === strpos($pathinfo, '/compute') && preg_match('#^/compute/(?P<a>[^/]++)/(?P<b>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'esgi_blog_default_compute')), array (  '_controller' => 'Esgi\\BlogBundle\\Controller\\DefaultController::computeAction',));
        }

        // esgi_blog_default_newpost
        if ($pathinfo === '/new-post') {
            return array (  '_controller' => 'Esgi\\BlogBundle\\Controller\\DefaultController::newPostAction',  '_route' => 'esgi_blog_default_newpost',);
        }

        // homepage
        if ($pathinfo === '/app/example') {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
