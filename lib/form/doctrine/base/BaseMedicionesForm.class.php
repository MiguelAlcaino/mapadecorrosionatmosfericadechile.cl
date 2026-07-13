<?php

/**
 * Mediciones form base class.
 *
 * @method Mediciones getObject() Returns the current form's model object
 *
 * @package    innova_versionado
 * @subpackage form
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMedicionesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'tipo'          => new sfWidgetFormChoice(array('choices' => array('Cloruro' => 'Cloruro', 'Sulfato' => 'Sulfato', 'Humidificacion' => 'Humidificacion', 'Velocidad_aluminio' => 'Velocidad_aluminio', 'Velocidad_acero' => 'Velocidad_acero', 'Velocidad_cobre' => 'Velocidad_cobre', 'Velocidad_galvanizado' => 'Velocidad_galvanizado'))),
      'mes'           => new sfWidgetFormChoice(array('choices' => array('Enero' => 'Enero', 'Febrero' => 'Febrero', 'Marzo' => 'Marzo', 'Abril' => 'Abril', 'Mayo' => 'Mayo', 'Junio' => 'Junio', 'Julio' => 'Julio', 'Agosto' => 'Agosto', 'Septiembre' => 'Septiembre', 'Octubre' => 'Octubre', 'Noviembre' => 'Noviembre', 'Diciembre' => 'Diciembre'))),
      'anio'          => new sfWidgetFormInputText(),
      'estacion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'), 'add_empty' => false)),
      'valor'         => new sfWidgetFormInputText(),
      'observaciones' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipo'          => new sfValidatorChoice(array('choices' => array(0 => 'Cloruro', 1 => 'Sulfato', 2 => 'Humidificacion', 3 => 'Velocidad_aluminio', 4 => 'Velocidad_acero', 5 => 'Velocidad_cobre', 6 => 'Velocidad_galvanizado'))),
      'mes'           => new sfValidatorChoice(array('choices' => array(0 => 'Enero', 1 => 'Febrero', 2 => 'Marzo', 3 => 'Abril', 4 => 'Mayo', 5 => 'Junio', 6 => 'Julio', 7 => 'Agosto', 8 => 'Septiembre', 9 => 'Octubre', 10 => 'Noviembre', 11 => 'Diciembre'))),
      'anio'          => new sfValidatorInteger(),
      'estacion'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'))),
      'valor'         => new sfValidatorNumber(),
      'observaciones' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mediciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mediciones';
  }

}
