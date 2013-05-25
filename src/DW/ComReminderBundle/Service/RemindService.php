<?php

namespace DW\ComReminderBundle\Service;

use DW\ComReminderBundle\Service\ManagerEntitiesService;

class RemindService {

  private static $repository = 'DWComReminderBundle:Remind';

  public static function getEntity($controller, $id) {

    return ManagerEntitiesService::getEntity($controller, $id, self::$repository);
  }

}
