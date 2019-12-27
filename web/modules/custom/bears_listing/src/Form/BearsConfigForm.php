<?php

namespace Drupal\bears_listing\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BearsConfigForm.
 */
class BearsConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'bears_listing.bearsconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bears_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //$form['#disable_inline_form_errors'] = FALSE;
    $config = $this->config('bears_listing.bearsconfig');
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('name'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('bears_listing.bearsconfig')
      ->set('name', $form_state->getValue('name'))
      ->save();
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('name');

    if (strlen($name) < 2) {
      $form_state->setErrorByName('name', t('Name needs to be longer.'));
    }
    parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
  }


}
