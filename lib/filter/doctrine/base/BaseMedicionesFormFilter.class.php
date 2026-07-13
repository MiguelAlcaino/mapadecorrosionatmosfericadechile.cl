<?php

/**
 * Mediciones filter form base class.
 *
 * @package    innova_versionado
 * @subpackage filter
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMedicionesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'Cloruro' => 'Cloruro', 'Sulfato' => 'Sulfato', 'Humidificacion' => 'Humidificacion', 'Velocidad_aluminio' => 'Velocidad_aluminio', 'Velocidad_acero' => 'Velocidad_acero', 'Velocidad_cobre' => 'Velocidad_cobre', 'Velocidad_galvanizado' => 'Velocidad_galvanizado'))),
      'mes'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'Enero' => 'Enero', 'Febrero' => 'Febrero', 'Marzo' => 'Marzo', 'Abril' => 'Abril', 'Mayo' => 'Mayo', 'Junio' => 'Junio', 'Julio' => 'Julio', 'Agosto' => 'Agosto', 'Septiembre' => 'Septiembre', 'Octubre' => 'Octubre', 'Noviembre' => 'Noviembre', 'Diciembre' => 'Diciembre'))),
      'anio'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estacion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'), 'add_empty' => true)),
      'valor'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tipo'          => new sfValidatorChoice(array('required' => false, 'choices' => array('Cloruro' => 'Cloruro', 'Sulfato' => 'Sulfato', 'Humidificacion' => 'Humidificacion', 'Velocidad_aluminio' => 'Velocidad_aluminio', 'Velocidad_acero' => 'Velocidad_acero', 'Velocidad_cobre' => 'Velocidad_cobre', 'Velocidad_galvanizado' => 'Velocidad_galvanizado'))),
      'mes'           => new sfValidatorChoice(array('required' => false, 'choices' => array('Enero' => 'Enero', 'Febrero' => 'Febrero', 'Marzo' => 'Marzo', 'Abril' => 'Abril', 'Mayo' => 'Mayo', 'Junio' => 'Junio', 'Julio' => 'Julio', 'Agosto' => 'Agosto', 'Septiembre' => 'Septiembre', 'Octubre' => 'Octubre', 'Noviembre' => 'Noviembre', 'Diciembre' => 'Diciembre'))),
      'anio'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'estacion'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estacion'), 'column' => 'id')),
      'valor'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observaciones' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mediciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mediciones';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'tipo'          => 'Enum',
      'mes'           => 'Enum',
      'anio'          => 'Number',
      'estacion'      => 'ForeignKey',
      'valor'         => 'Number',
      'observaciones' => 'Text',
    );
  }
}
