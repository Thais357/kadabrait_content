<?php
namespace Drupal\kadabrait_content\Services;
/**
 * Class UtilsService.
 *
 * @package Drupal\kadabrait_content\Services;
 */
class KadabraItServices
{
   public function getlastTenContent() {
     $current_user_id = \Drupal::currentUser()->id(); //user logueado

     $database = \Drupal::database();
     $query = $database->select('node_field_data' , 'u')
       ->condition('uid',$current_user_id,'=')
       ->orderBy('created','DESC')
       ->fields('u')
       ->range(0, 10);

     return $query->execute()->fetchAll();
  }

  public function getlastThreeContent() {
    $current_user_id = \Drupal::currentUser()->id(); //user logueado

    $database = \Drupal::database();
    $query = $database->select('node_field_data' , 'u')
      ->condition('uid',$current_user_id,'=')
      ->orderBy('created','DESC')
      ->fields('u',['title'])
      ->range(0, 3);

    return $query->execute()->fetchAll();

  }


}
