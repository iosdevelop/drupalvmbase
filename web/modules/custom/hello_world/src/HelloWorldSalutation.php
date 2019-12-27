<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class HelloWorldSalutation
 *
 * @package Drupal\hello_world
 *
 * prepares Salutation for the world
 */
class HelloWorldSalutation {
  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * HelloWorldSalutation constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   * @throws \Exception
   */
  public function getSalutation() {

    /**
     * If salutation not empty return to config else proceed as normal
     */
    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');
    $color = $config->get('color');

    if ($salutation != ""){
      return $salutation;
    }
    if ($color != ""){
      return $color;
    }

    $time = new \DateTime();
    if ((int) $time->format('G') >= 00 && $time->format('G') < 12 ) {
      return $this->t('Good morning world');
    }

    if ((int) $time->format('G') >= 12 && $time->format('G') < 18 ) {
      return $this->t('Good afternoon world');
    }

    if ((int) $time->format('G') >= 18 ){
      return $this->t('Good evening world');
    }
  }
}
