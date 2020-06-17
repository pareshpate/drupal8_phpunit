<?php

namespace Drupal\sph_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SPHConfigForm.
 */
class SPHConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'sph_config.sphconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sph_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('sph_config.sphconfig');
    $form['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable'),
      '#description' => $this->t('Enable 3rd Party API'),
      '#default_value' => $config->get('enable'),
    ];
    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#description' => $this->t('API Key'),
      '#default_value' => $config->get('api_key'),
    ];
    $form['summary'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Summary'),
      '#description' => $this->t('Summary'),
      '#default_value' => $config->get('summary'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('sph_config.sphconfig')
      ->set('enable', $form_state->getValue('enable'))
      ->set('api_key', $form_state->getValue('api_key'))
      ->set('summary', $form_state->getValue('summary'))
      ->save();
  }

}
