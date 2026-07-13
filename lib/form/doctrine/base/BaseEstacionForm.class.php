<?php

/**
 * Estacion form base class.
 *
 * @method Estacion getObject() Returns the current form's model object
 *
 * @package    innova_versionado
 * @subpackage form
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'identificador'    => new sfWidgetFormInputText(),
      'nombre_estacion'  => new sfWidgetFormInputText(),
      'latitud'          => new sfWidgetFormInputText(),
      'longitud'         => new sfWidgetFormInputText(),
      'altura'           => new sfWidgetFormInputText(),
      'distancia_al_mar' => new sfWidgetFormInputText(),
      'region'           => new sfWidgetFormChoice(array('choices' => array('I REGIÓN DE TARAPACÁ' => 'I REGIÓN DE TARAPACÁ', 'II REGIÓN DE ANTOFAGASTA' => 'II REGIÓN DE ANTOFAGASTA', 'III REGIÓN DE ATACAMA' => 'III REGIÓN DE ATACAMA', 'IV REGIÓN DE COQUIMBO' => 'IV REGIÓN DE COQUIMBO', 'V REGIÓN DE VALPARAISO' => 'V REGIÓN DE VALPARAISO', 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS' => 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS', 'VII REGIÓN DEL MAULE' => 'VII REGIÓN DEL MAULE', 'VIII REGIÓN DEL BÍO - BÍO' => 'VIII REGIÓN DEL BÍO - BÍO', 'IX REGIÓN DE LA ARAUCANÍA' => 'IX REGIÓN DE LA ARAUCANÍA', 'X REGIÓN DE LOS LAGOS' => 'X REGIÓN DE LOS LAGOS', 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO' => 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO', 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA' => 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA', 'RM REGIÓN METROPOLITANA' => 'RM REGIÓN METROPOLITANA', 'XIV REGION DE LOS RÍOS' => 'XIV REGION DE LOS RÍOS', 'XV REGIÓN DE ARICA Y PARINACOTA' => 'XV REGIÓN DE ARICA Y PARINACOTA'))),
      'imagen'           => new sfWidgetFormInputText(),
      'color'            => new sfWidgetFormInputText(),
      'alto'             => new sfWidgetFormInputText(),
      'ancho'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'identificador'    => new sfValidatorInteger(),
      'nombre_estacion'  => new sfValidatorString(array('max_length' => 255)),
      'latitud'          => new sfValidatorNumber(),
      'longitud'         => new sfValidatorNumber(),
      'altura'           => new sfValidatorInteger(),
      'distancia_al_mar' => new sfValidatorInteger(),
      'region'           => new sfValidatorChoice(array('choices' => array(0 => 'I REGIÓN DE TARAPACÁ', 1 => 'II REGIÓN DE ANTOFAGASTA', 2 => 'III REGIÓN DE ATACAMA', 3 => 'IV REGIÓN DE COQUIMBO', 4 => 'V REGIÓN DE VALPARAISO', 5 => 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS', 6 => 'VII REGIÓN DEL MAULE', 7 => 'VIII REGIÓN DEL BÍO - BÍO', 8 => 'IX REGIÓN DE LA ARAUCANÍA', 9 => 'X REGIÓN DE LOS LAGOS', 10 => 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO', 11 => 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA', 12 => 'RM REGIÓN METROPOLITANA', 13 => 'XIV REGION DE LOS RÍOS', 14 => 'XV REGIÓN DE ARICA Y PARINACOTA'))),
      'imagen'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'color'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'alto'             => new sfValidatorInteger(array('required' => false)),
      'ancho'            => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estacion';
  }

}
