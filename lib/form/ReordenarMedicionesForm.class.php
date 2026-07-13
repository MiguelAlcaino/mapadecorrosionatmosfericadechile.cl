<?php

class ReordenarMedicionesForm extends sfForm
{
  public function configure()
  {
    $mediciones = $this->getOption('mediciones');
    $mediciones_form = new sfForm();
    $i=0;
    foreach($mediciones as $medicion){
      $medicion_form = new MedicionesForm($medicion);
      $mediciones_form->embedForm('medicion_'.$i, $medicion_form);
      $i++;
    }
    $this->embedForm('mediciones', $mediciones_form);
  }
}