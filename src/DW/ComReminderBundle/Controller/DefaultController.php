<?php

namespace DW\ComReminderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \DW\ComReminderBundle\Entity\Remind;
use \DW\ComReminderBundle\Service\ManagerEntitiesService;
use DW\ComReminderBundle\Service\RemindService;

class DefaultController extends Controller {

    public function indexAction() {
      
      $remind = new Remind();
      $remind->setName("test");
      $remind->setText("test");
      $remind->setNumber(3);
      $remind->setRate(3);
      
      ManagerEntitiesService::saveEntity($this, $remind);
      
      
      $remind2 = RemindService::getEntity($this, 9);
      
      var_dump($remind2->getText());
     
      
        return $this->render('DWComReminderBundle:Default:index.html.twig');
    }

    

}
