<?php

namespace Drupal\bears_listing\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class BearsController.
 */
class BearsController extends ControllerBase {

  /**
   * Growl.
   *
   * @return string
   *   Return Hello string.
   */
  public function growl() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: growl')
    ];
  }

}
