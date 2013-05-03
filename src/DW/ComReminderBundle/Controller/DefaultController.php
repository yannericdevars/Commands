<?php

namespace DW\ComReminderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('DWComReminderBundle:Default:index.html.twig', array('name' => $name));
    }

    

}
