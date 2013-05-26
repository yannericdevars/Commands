<?php

namespace DW\EntityManagerBundle\Service;

/**
 * Interface des services pour les entites
 */
Interface ServiceInterface
{

  /**
   * Retourne une entite
   * @param Controller $controller Controller 
   * @param integer    $id         Id
   */
  public static function getEntity($controller, $id);

  /**
   * Retourne des entites serialisees de APC
   * @param Controller $controller Controller
   * @param integer    $timeToLive Temps de cache en secondes
   */
  public static function getEntitiesWithApc($controller, $timeToLive);

  /**
   * Retournes toutes les entites
   * @param Controller $controller Controller
   */
  public static function getAllEntities($controller);
}

