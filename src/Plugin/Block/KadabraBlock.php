<?php

namespace Drupal\kadabrait_content\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'KadabraBlock' block.
 *
 * @Block(
 *  id = "kadabra_block",
 *  admin_label = @Translation("Kadabra block"),
 * )
 */
class KadabraBlock extends BlockBase {

  /**
   * Upgrade Plan Utils.
   */
  public $kadabraUtils;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
    ] + parent::defaultConfiguration();
  }

//  /**
//   * {@inheritDoc}
//   */
//  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
//    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
//    $instance->kadabraUtils = $container->get('kadabra_it_content_services');
//    return $instance;
//  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['id'] = [
      '#type' => 'numeric',
      '#title' => $this->t('id'),
      '#description' => $this->t('Id de contenido'),
      '#default_value' => $this->configuration['id'],
      '#weight' => '0',
    ];
    $form['type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type'),
      '#description' => $this->t('Tipo de contenido'),
      '#default_value' => $this->configuration['type'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['titulo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Titulo'),
      '#default_value' => $this->configuration['titulo'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['id'] = $form_state->getValue('id');
    $this->configuration['type'] = $form_state->getValue('type');
    $this->configuration['titulo'] = $form_state->getValue('titulo');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $kadabra_utils_service = \Drupal::service('kadabra_it_content_services');
    $data = $kadabra_utils_service->getlastThreeContent();

    $build = [];
    $build['#theme'] = 'kadabra_block';
    $build['#data'] = $data;
    $build['#region'] = 'sidebar_left';

    return $build;
  }
  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }


}
