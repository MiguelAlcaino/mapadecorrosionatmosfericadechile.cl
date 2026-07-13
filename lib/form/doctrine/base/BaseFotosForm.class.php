<?php

/**
 * Fotos form base class.
 *
 * @method Fotos getObject() Returns the current form's model object
 *
 * @package    innova_versionado
 * @subpackage form
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFotosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'estacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'), 'add_empty' => false)),
      'foto'        => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'estacion'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'))),
      'foto'        => new sfValidatorString(array('max_length' => 255)),
      'descripcion' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fotos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fotos';
  }

}
