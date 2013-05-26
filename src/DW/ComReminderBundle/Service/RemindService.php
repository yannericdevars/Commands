<?php

namespace DW\ComReminderBundle\Service;

use \DW\EntityManagerBundle\Service\ManagerEntitiesService;
use \DW\EntityManagerBundle\Service\ServiceInterface;

/**
 * Classe de service
 */
class RemindService implements ServiceInterface
{

  private static $repository = 'DWComReminderBundle:Remind';
  private static $idAPC = 'Remind';

  /**
   * Retourne une entite
   * @param Controller $controller Controller 
   * @param integer    $id         Id
   * 
   * @return Entite
   */
  public static function getEntity($controller, $id)
  {
    return ManagerEntitiesService::getEntity($controller, $id, self::$repository);
  }

  /**
   * Retourne des entites serialisees de APC
   * @param Controller $controller Controller
   * @param integer    $timeToLive Temps de cache en secondes
   * 
   * @return Entites serialisees stockees dans APC
   */
  public static function getEntitiesWithApc($controller, $timeToLive)
  {
    return ManagerEntitiesService::getAllEntitiesWithApc($controller, self::$idAPC, self::$repository, $timeToLive);
  }

  /**
   * Retournes toutes les entites
   * @param Controller $controller Controller
   * 
   * @return retourne toutes les entites
   */
  public static function getAllEntities($controller)
  {
    return ManagerEntitiesService::getAllEntities($controller, self::$repository);
  }

}
