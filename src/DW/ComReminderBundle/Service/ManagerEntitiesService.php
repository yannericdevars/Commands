<?php

namespace DW\ComReminderBundle\Service;
  
class ManagerEntitiesService {
  
  /**
   * Récupère une entité par son id
   * @param string    $entity     L'entitee
   * @param controler $controller Le controleur
   * @param int       $id         L'identifiant
   * 
   * @return entite
   */
  public static function getEntity($controller, $id, $repository)
  {

    $em = $controller->getDoctrine()->getManager();
    $entity = $em->getRepository($repository)->find($id);

    return $entity;
  }

  /**
   * Recupere des entites selon des criteres
   * @param string    $entity     Nom de l'entite
   * @param controler $controller Le controler
   * @param array     $criteria   Les criteres
   * @param string    $order      Ordre du tri
   * 
   * @return array Tableau d'entites
   */
  public static function getEntitiesByCriterias($entity, $controller, $criteria, $order = null)
  {
    $repository = self::getRepository($entity);
    $em = $controller->getDoctrine()->getManager();

    return $em->getRepository($repository)->findBy($criteria, $order);
  }

  /**
   * Recupere une entite selon un critere
   * @param string    $entity     Nom de l'entite
   * @param controler $controller Le controler
   * @param array     $criteria   Les criteres
   * 
   * @return Entity L'entite
   */
  public static function getEntityByCriterias($entity, $controller, $criteria)
  {
    $repository = self::getRepository($entity);
    $em = $controller->getDoctrine()->getManager();

    return $em->getRepository($repository)->findOneBy($criteria);
  }

  /**
   * Recupere toues les entites
   * @param string    $entity     Le nom de l'entite
   * @param controler $controller Le controler
   * 
   * @return Entity L'entite
   */
  public static function getAllEntities($entity, $controller)
  {
    $repository = self::getRepository($entity);
    $em = $controller->getDoctrine()->getManager();

    return $em->getRepository($repository)->findAll();
  }

  /**
   * Récupère des entitees stockees dans APC
   * @param Object     $entity     entite
   * @param Controller $controller Un controleur
   * @param int        $timeToLive Le nombre de secondes ou la donnee est stockee
   * 
   * @return array les entites
   */
  public static function getAllEntitiesWithApc($entity, $controller, $timeToLive)
  {

    if (!apc_exists($entity)) {
      self::writeToApc($entity, $controller, $timeToLive);
    }

    return self::readFromApc($entity);
  }

  /**
   * Ecrit dans le cache apc
   * @param Object     $entity     entite
   * @param Controller $controller Un controleur
   * @param int        $timeToLive Le nombre de secondes ou la donnee est stockee
   */
  public static function writeToApc($entity, $controller, $timeToLive = 30)
  {
    $repository = self::getRepository($entity);
    $em = $controller->getDoctrine()->getManager();
    $entities = $em->getRepository($repository)->findAll();
    $tabToRecord = array();
    foreach ($entities as $value) {
      $tabToRecord[] = $value->objetCustomSerialize();
    }

    apc_add($entity, $tabToRecord, $timeToLive);
  }

  /**
   * Recupere un tableau d'entites
   * @param Array $entity l'entite
   * 
   * @return array tableau d'entite
   */
  public static function readFromApc($entity)
  {
    return apc_fetch($entity);
  }

  /**
   * Sauvegarde une entité
   * @param controler $controller Le controler
   * @param entite    $entity     L'entite
   */
  public static function saveEntity($controller, $entity)
  {
    $em = $controller->getDoctrine()->getEntityManager();
    $em->persist($entity);
    $em->flush();
  }

  /**
   * Supprime une entité
   * @param controler $controller Le controler
   * @param entite    $entity     L'entite
   */
  public static function deleteEntity($controller, $entity)
  {
    $em = $controller->getDoctrine()->getEntityManager();
    $em->remove($entity);
    $em->flush();
  }

  /**
   * Recupere un repository avec son entite
   * @param Entity $entity l'entite
   * 
   * @return Repository Le repository
   */
  public static function getRepository($entity)
  {


    $repository = 'Not defined';

    if ($entity == 'User') {
      $repository = 'HubeeUserBundle:' . $entity;
    } else {
      $repository = 'HubeeCanalPlayBundle:' . $entity;
    }

    return $repository;
  }

  /**
   * Permet de faire une requete DQL
   * @param controler     $controller Le controleur
   * @param string        $strQuery   La chaine de requete
   * @param EntityManager $em         Un entity manager peut être precise
   * 
   * @return Tableau d'objets
   */
  public static function selectByDQL($controller, $strQuery, $em = null)
  {
    if ($controller != null) {
      $em = $controller->getDoctrine()->getManager();
    }

    $query = $em->createQuery($strQuery);

    return $query->getResult();
  }

  /**
   * @param string $key      La clef dans le Json
   * @param string $url      L'url interrogee
   * @param string $body     Le corps du Json
   * @param int    $lifeTime Temps de mise en cache en secondes
   * 
   * @return json
   */
  public static function getJsonFromApc($key, $url, $body, $lifeTime = 20)
  {
    if (!apc_exists($key)) {
      $data = AtgService::getJsonListeAtg($url, $body);
      apc_add($key, $data, $lifeTime);
    }

    return apc_fetch($key);
  }
}
