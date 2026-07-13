<?php

/**
 * Fotos form.
 *
 * @package    innova_versionado
 * @subpackage form
 * @author     Rodrigo Muñoz
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FotosForm extends BaseFotosForm
{
  public function configure()
  {

sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $this->widgetSchema['estacion'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estacion'),'method' => 'getNombreEstacion', 'add_empty' => false));



    $this->widgetSchema['foto'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Imagen',
      'file_src'  => public_path('/uploads/estaciones/s_'.$this->getObject()->getFoto()),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div><a href="'.public_path('/uploads/estaciones/'.$this->getObject()->getFoto()).'"> %file%</a><br />%input%<br />%delete% %delete_label%</div>',
    ));
 
    $this->validatorSchema['foto_delete'] = new sfValidatorPass();


$this->validatorSchema['foto'] = new sfValidatorFile(array(
   'required'   => false,
   'mime_types' => 'web_images',
   'path' => sfConfig::get('sf_upload_dir').'/estaciones',
   'validated_file_class' => 'sfResizedFile',
));

$this->validatorSchema['foto_delete'] = new sfValidatorBoolean();

  }





}
