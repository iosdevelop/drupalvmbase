<?php

namespace Drupal\hello_world;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class SalutationEvent to be dispatched from the HelloWorldSalutation service.
 *
 * @package Drupal\hello_world
 */
class SalutationEvent extends Event {
  const EVENT = 'hello_world.salutation_event';

  /**
   * The salutation message
   * @var string
   */
  protected $message;

  /**
   * The salutation message
   * @return string
   */
  public function getValue() {
    return $this->message;
  }

  /**
   * @param mixed $message
   */
  public function setValue($message) {
    $this->message = $message;
  }

}
