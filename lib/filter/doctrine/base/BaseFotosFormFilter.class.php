<?php

/**
 * Fotos filter form base class.
 *
 * @package    innova_versionado
 * @subpackage filter
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFotosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'), 'add_empty' => true)),
      'foto'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'estacion'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estacion'), 'column' => 'id')),
      'foto'        => new sfValidatorPass(array('required' => false)),
      'descripcion' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fotos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fotos';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'estacion'    => 'ForeignKey',
      'foto'        => 'Text',
      'descripcion' => 'Text',
    );
  }
}
