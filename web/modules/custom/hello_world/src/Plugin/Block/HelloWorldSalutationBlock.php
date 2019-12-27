<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\hello_world\HelloWorldSalutation as HelloWorldSalutationService;

/**
 * Class HelloWorldSalutationBlock
 * Hello World salutation block
 *
 * @Block(
 *   id = "hello_world_salutation_block",
 *   admin_label = @Translation("Hello world salutation"),
 *   )
 * @package Drupal\hello_world\Plugin\Block
 */
class HelloWorldSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The salutation service
   *
   * @var \Drupal\hello_world\HelloWorldSalutation
   */
  protected $salutation;

  /**
   * HelloWorldSalutationBlock constructor.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param \Drupal\hello_world\HelloWorldSalutation $salutation *   The
   *   salutation service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HelloWorldSalutation $salutation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return \Drupal\Core\Plugin\ContainerFactoryPluginInterface|static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition, $container->get('hello_world.salutation'));
  }

  /**
   * @return array
   * @throws \Exception
   */
  public function build() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

  /**
   * @return array
   */
  public function defaultConfiguration() {
    return [
      'enabled' => 1,
    ];
  }

  /**
   * @param $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return array
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form['enabled'] = array (
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#description' => t('Check this box if you want to enable this feature'),
      '#default_value' => $config['enabled'],
      );
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['enabled'] = $form_state->getValue('enabled');
  }

//  public function blockValidate($form, FormStateInterface $form_state) {
//    $enable = $form_state->getValue('enabled');
//    if ($enable == NULL){
//      $form_state->setErrorByName('enabled',$this->t('Checkbox must be checked'));
//    }
//    parent::blockValidate($form, $form_state);
//  }
}
