<?php

namespace Drupal\hello_world\Controller;

use Drupal\hello_world\HelloWorldSalutation;
use Drupal\hello_world\HelloWorldGreetings;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;

class HelloWorldController extends \Drupal\Core\Controller\ControllerBase {
  /**
   * @var \Drupal\hello_world\HelloWorldSalutation
   */

  protected $salutation;

  /**
   * HelloWorldController constructor
   *
   * @param \Drupal\hello_world\HelloWorldSalutation $salutation
   */

  public function __construct(HelloWorldSalutation $salutation) {
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('hello_world.salutation')
    );
  }

  /**
   * @return array
   */
  public function helloWorld() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

  public function getNews() {
    return [
      '#markup' => $this->salutation->getGreetings(),
    ];
  }
  /**
   * Returns a render-able array for a test page.
   */
  public function content() {

    //Do something with your variables here.
    $myText = 'This is not just a default text!';
    $myNumber = 1;
    $myArray = [1, 2, 3];

    return [
      //Your theme hook name
      '#theme' => 'hello_world_theme_hook',
      //Your variables
      '#variable1' => $myText,
      '#variable2' => $myNumber,
      '#variable3' => $myArray,
    ];
  }
}
