<?php

/**
 * Estacion filter form base class.
 *
 * @package    innova_versionado
 * @subpackage filter
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'identificador'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_estacion'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'latitud'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'longitud'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'altura'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'distancia_al_mar' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'region'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'I REGIÓN DE TARAPACÁ' => 'I REGIÓN DE TARAPACÁ', 'II REGIÓN DE ANTOFAGASTA' => 'II REGIÓN DE ANTOFAGASTA', 'III REGIÓN DE ATACAMA' => 'III REGIÓN DE ATACAMA', 'IV REGIÓN DE COQUIMBO' => 'IV REGIÓN DE COQUIMBO', 'V REGIÓN DE VALPARAISO' => 'V REGIÓN DE VALPARAISO', 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS' => 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS', 'VII REGIÓN DEL MAULE' => 'VII REGIÓN DEL MAULE', 'VIII REGIÓN DEL BÍO - BÍO' => 'VIII REGIÓN DEL BÍO - BÍO', 'IX REGIÓN DE LA ARAUCANÍA' => 'IX REGIÓN DE LA ARAUCANÍA', 'X REGIÓN DE LOS LAGOS' => 'X REGIÓN DE LOS LAGOS', 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO' => 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO', 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA' => 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA', 'RM REGIÓN METROPOLITANA' => 'RM REGIÓN METROPOLITANA', 'XIV REGION DE LOS RÍOS' => 'XIV REGION DE LOS RÍOS', 'XV REGIÓN DE ARICA Y PARINACOTA' => 'XV REGIÓN DE ARICA Y PARINACOTA'))),
      'imagen'           => new sfWidgetFormFilterInput(),
      'color'            => new sfWidgetFormFilterInput(),
      'alto'             => new sfWidgetFormFilterInput(),
      'ancho'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'identificador'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre_estacion'  => new sfValidatorPass(array('required' => false)),
      'latitud'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitud'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'altura'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'distancia_al_mar' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'region'           => new sfValidatorChoice(array('required' => false, 'choices' => array('I REGIÓN DE TARAPACÁ' => 'I REGIÓN DE TARAPACÁ', 'II REGIÓN DE ANTOFAGASTA' => 'II REGIÓN DE ANTOFAGASTA', 'III REGIÓN DE ATACAMA' => 'III REGIÓN DE ATACAMA', 'IV REGIÓN DE COQUIMBO' => 'IV REGIÓN DE COQUIMBO', 'V REGIÓN DE VALPARAISO' => 'V REGIÓN DE VALPARAISO', 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS' => 'VI REGIÓN DEL LIBERTADOR GENERAL BERNARDO O\'HIGGINS', 'VII REGIÓN DEL MAULE' => 'VII REGIÓN DEL MAULE', 'VIII REGIÓN DEL BÍO - BÍO' => 'VIII REGIÓN DEL BÍO - BÍO', 'IX REGIÓN DE LA ARAUCANÍA' => 'IX REGIÓN DE LA ARAUCANÍA', 'X REGIÓN DE LOS LAGOS' => 'X REGIÓN DE LOS LAGOS', 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO' => 'XI REGIÓN AYSÉN DEL GENERAL CARLOS IBÁÑEZ DEL CAMPO', 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA' => 'XII REGIÓN DE MAGALLANES Y LA ANTÁRTICA CHILENA', 'RM REGIÓN METROPOLITANA' => 'RM REGIÓN METROPOLITANA', 'XIV REGION DE LOS RÍOS' => 'XIV REGION DE LOS RÍOS', 'XV REGIÓN DE ARICA Y PARINACOTA' => 'XV REGIÓN DE ARICA Y PARINACOTA'))),
      'imagen'           => new sfValidatorPass(array('required' => false)),
      'color'            => new sfValidatorPass(array('required' => false)),
      'alto'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ancho'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('estacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estacion';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'identificador'    => 'Number',
      'nombre_estacion'  => 'Text',
      'latitud'          => 'Number',
      'longitud'         => 'Number',
      'altura'           => 'Number',
      'distancia_al_mar' => 'Number',
      'region'           => 'Enum',
      'imagen'           => 'Text',
      'color'            => 'Text',
      'alto'             => 'Number',
      'ancho'            => 'Number',
    );
  }
}
