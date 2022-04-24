<?php
namespace Drupal\kadabrait_content\Controller;

use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;
class KadabraItController extends ControllerBase
{
// Página 1
  public function getPage1() {
  $kadrabra_service = \Drupal::service('kadabra_it_content_services');
  $ten_last_content = $kadrabra_service->getlastTenContent();

    // Recorrer los resultados y guardar los nodos en un array
    if (!empty($ten_last_content)) {
      foreach ($ten_last_content as $ten_last_contentId) {
        $node = Node::load($ten_last_contentId->nid);
        $data[] = $node;
      }
    }

    return array(
      '#type' => 'markup',
      '#theme' => 'show_last_ten_content',
      '#titulo' => $this->t('Listado de mis ultimos diez contenidos'),
      '#descripcion' => $this->t('Ultimos 10 contenidos creados por mi'),
      '#data' => $data
    );

  }

// Página 2
  public function getPage2() {
    $kadrabra_service = \Drupal::service('kadabra_it_services');
    $three_last_content = $kadrabra_service->getlastThreeContent();

    // Recorrer los resultados y guardar los nodos en un array
    if (!empty($three_last_content)) {
      foreach ($three_last_content as $three_last_contenttId) {
        $node = Node::load($three_last_contenttId);
        $data[] = $node;
      }
    }

    return array(
      '#theme' => 'kadabra_block',
      '#titulo' => $this->t('Listado de mis ultimos tres contenidos'),
      '#descripcion' => $this->t('Ultimos 3 contenidos creados por mi'),
      '#data' => $data
    );
  }

}
