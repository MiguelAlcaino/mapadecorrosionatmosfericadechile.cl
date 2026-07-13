<?php

/**
 * Mediciones form.
 *
 * @package    innova_versionado
 * @subpackage form
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MedicionesForm extends BaseMedicionesForm
{
  public function configure()
  {
    $this->widgetSchema['estacion'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'),'method' => 'getNombreEstacion', 'add_empty' => false));
  }
}
