<?php

namespace DW\ComReminderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \DW\ComReminderBundle\Entity\Remind;
use \DW\EntityManagerBundle\Service\ManagerEntitiesService;
use DW\ComReminderBundle\Service\RemindService;

class DefaultController extends Controller {

    public function indexAction() {
      
      $reminds = RemindService::getEntity($this, 7);
      
      var_dump(count($reminds));
      
      
      
      
        return $this->render('DWComReminderBundle:Default:index.html.twig');
    }

    

}
