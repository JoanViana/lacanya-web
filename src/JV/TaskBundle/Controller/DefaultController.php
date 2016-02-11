<?php

namespace JV\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JVTaskBundle:Default:index.html.twig');
    }
    
}
