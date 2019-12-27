<?php

namespace Drupal\hello_world;

/**
 * Class HelloWorldJamaica
 *
 * @package Drupal\hello_world
 */
class HelloWorldJamaica {

  /**
   * @return mixed
   */
  public function getNews() {
    return $this->t('Better news');
  }
}
