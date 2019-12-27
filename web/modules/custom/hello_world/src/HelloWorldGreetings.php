<?php

namespace Drupal\hello_world;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class HelloWorldGreetings
 *
 * @package Drupal\hello_world
 */
class HelloWorldGreetings {
  use StringTranslationTrait;

  /**
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   */
  public function getGreetings() {
    return $this->t('Greetings friends!');
  }
}
