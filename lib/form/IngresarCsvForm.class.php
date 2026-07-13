<?php

class IngresarCsvForm extends MedicionesForm
{
  public function configure()
  {
    unset($this['anio'], 
    $this['mes'], 
    $this['valor'], 
    $this['estacion'],
    $this['observaciones']);
    $this->widgetSchema['archivo'] = new sfWidgetFormInputFile();
    
  }
}