<?php

namespace Drupal\Tests\sph_config\Kernel\Form;

use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormState;
use Drupal\KernelTests\KernelTestBase;
use Drupal\sph_config\Form\SPHConfigForm;

/**
 * Tests the SPH Config Default settings form.
 *
 * @coversDefaultClass \Drupal\sph_config\Form\SPHConfigForm
 *
 * @group sph_config
 */
class SPHConfigFormTest extends KernelTestBase {

  /**
   * The sph settings form object under test.
   *
   * @var \Drupal\sph_config\Form\SPHConfigForm
   */
  protected $sphConfigForm;

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = [
    'sph_config',
  ];

  /**
   * {@inheritdoc}
   *
   * @covers ::__construct
   */
  protected function setUp() {
    parent::setUp();

    $this->installConfig(static::$modules);

    $this->sphConfigForm = SPHConfigForm::create($this->container);
  }

  /**
   * Tests for \Drupal\sph_config\Form\SPHConfigForm.
   *
   * @covers ::getFormId
   * @covers ::getEditableConfigNames
   * @covers ::buildForm
   * @covers ::submitForm
   */
  public function testSPHConfigForm() {
    // Emulate a form state of a submitted form.
    $form_state = (new FormState())->setValues([
      'enable'  => true,
      'api_key' => 'test124',
      'summary' => 'summary text',
    ]);

    $this->assertInstanceOf(FormInterface::class, $this->sphConfigForm);

    $id = $this->sphConfigForm->getFormId();
    $this->assertEquals('sph_config_form', $id);

    $method = new \ReflectionMethod(SPHConfigForm::class, 'getEditableConfigNames');
    $method->setAccessible(TRUE);

    $name = $method->invoke($this->sphConfigForm);
    $this->assertEquals(['sph_config.sphconfig'], $name);

    $form = $this->sphConfigForm->buildForm([], $form_state);
    $this->sphConfigForm->submitForm($form, $form_state);
  }

}
