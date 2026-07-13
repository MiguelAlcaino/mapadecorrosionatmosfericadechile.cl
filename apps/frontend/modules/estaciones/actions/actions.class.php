<?php

/**
 * estaciones actions.
 *
 * @package    sf_sandbox
 * @subpackage estaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estacionesActions extends sfActions
{


 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function executeAgregarMedicionPorMesAnterior(sfWebRequest $request){
    $medicion = new Mediciones();
    $medicion->setValor($request->getParameter('valor'));
    $medicion->setMes($request->getParameter('mes'));
    $medicion->setAnio($request->getParameter('anio'));
    $medicion->setTipo($request->getParameter('tipo'));
    $medicion->setEstacion(Doctrine_Core::getTable('Estacion')->find($request->getParameter('estacion')));
    $medicion->save();
    $this->setLayout(false);
     
  }
  
  public function executeActualizarValor(sfWebRequest $request){
    $medicion = Doctrine_Core::getTable('Mediciones')->find($request->getParameter('id'));
    $medicion->setValor($request->getParameter('valor'));
    $medicion->save();
    $this->setLayout(false);
  }
  
  public function executeIngresarCSV(sfWebRequest $request){
    
    $array_meses = array();
    $array_meses[0] = 'Enero';
    $array_meses[1] = 'Febrero';
    $array_meses[2] = 'Marzo';
    $array_meses[3] = 'Abril';
    $array_meses[4] = 'Mayo';
    $array_meses[5] = 'Junio';
    $array_meses[6] = 'Julio';
    $array_meses[7] = 'Agosto';
    $array_meses[8] = 'Septiembre';
    $array_meses[9] = 'Octubre';
    $array_meses[10] = 'Noviembre';
    $array_meses[11] = 'Diciembre';
    
    $this->meses = $array_meses;
    if($request -> isMethod(sfRequest::POST) || $request -> isMethod(sfRequest::PUT)){
      $this->files = $request->getFiles();
      $form = $request->getParameter('mediciones');
      $this->tipo = $form['tipo'];
      $row = 1;
      $handle = fopen($this->files['mediciones']['archivo']['tmp_name'], "r");
      $contenido_archivo_aux = array();
      $i=0;
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $contenido_archivo_aux[$i] = $data;
        $i++;
      }
      fclose($handle);
      $i=0;
      $array_datos_modelo = array();
      foreach($contenido_archivo_aux as $valor){
        $array_datos_modelo[$i] = Doctrine_Query::create()->from('Mediciones m')
          ->where('m.estacion = ? AND m.tipo = ?',array($valor[0], $this->tipo))
          ->orderBy('m.anio, m.mes ASC')
          ->execute();
        $i++;
      }
      $contenido_archivo = array();
      $contenido_archivo['lineas'] = $contenido_archivo_aux;
      $contenido_archivo['datos_modelo'] = $array_datos_modelo;
      
      $this->contenido_archivo = $contenido_archivo;
    }
    
    $this->form = new IngresarCsvForm();
  }
  
  /**
   * Reordena las mediciones según los valores dados y muestra un formulario para realizar la edición rápida
   * Request debe traer:
   * - integer id_estacion : Id de la estación en la cual se desea hacer la modificación
   * - string tipo : Puede ser Cloruro, Sulfato, Humidificacion, Velocidad_aluminio, Velocidad_acero, Velocidad_cobre, Velocidad_galvanizado
   */
  public function executeReordenarMediciones(sfWebRequest $request){
    if($request -> isMethod(sfRequest::POST) || $request -> isMethod(sfRequest::PUT)){
      foreach($request->getParameter('mediciones') as $medicion_form){
        $medicion = Doctrine_Core::getTable('Mediciones')->find($medicion_form['id']);
        $medicion->setTipo($medicion_form['tipo']);
        $medicion->setMes($medicion_form['mes']);
        $medicion->setAnio($medicion_form['anio']);
        $medicion->setEstacion(Doctrine_Core::getTable('Estacion')->find($medicion_form['estacion']));
        $medicion->setValor($medicion_form['valor']);
        $medicion->setObservaciones($medicion_form['observaciones']);
        $medicion->save();
      }
    }
    $mediciones = Doctrine_Query::create()->from('Mediciones m')
      ->where('m.estacion = ? AND m.tipo = ?',array($request->getParameter('id_estacion'), $request->getParameter('tipo')))
      ->orderBy('m.anio, m.mes ASC')
      ->execute();
    $this->form = new ReordenarMedicionesForm(array(), array('mediciones' => $mediciones));
  }
  
  
  /**
   * Ordena las mediciones según los valores dados
   * Request debe traer:
   * - integer id_estacion : Id de la estación en la cual se desea hacer la modificación
   * - string tipo : Puede ser Cloruro, Sulfato, Humidificacion, Velocidad_aluminio, Velocidad_acero, Velocidad_cobre, Velocidad_galvanizado
   */
  public function executeOrdenarVelocidad(sfWebRequest $request){
    
   
    $mediciones = Doctrine_Query::create()->from('Mediciones m')
      ->where('m.estacion = ? AND m.tipo = ?',array($request->getParameter('id_estacion'), $request->getParameter('tipo')))
      ->orderBy('m.anio, m.mes ASC')
      ->execute();
   
    
    
    $array_meses = array();
    $array_meses[0] = 'Enero';
    $array_meses[1] = 'Febrero';
    $array_meses[2] = 'Marzo';
    $array_meses[3] = 'Abril';
    $array_meses[4] = 'Mayo';
    $array_meses[5] = 'Junio';
    $array_meses[6] = 'Julio';
    $array_meses[7] = 'Agosto';
    $array_meses[8] = 'Septiembre';
    $array_meses[9] = 'Octubre';
    $array_meses[10] = 'Noviembre';
    $array_meses[11] = 'Diciembre';
    
    
    foreach($mediciones as $key =>$medicion){
      //echo 'key: '.$key.', valor:'.$medicion->getValor().'<br />';
     // echo 'key: '.$key.', valor:'.$mediciones[$key+1]->getValor().'<br />';
      //$medicion->setMes($array_meses[array_search($medicion->getMes(), $array_meses)+1]);
      if(($request->getParameter('suma_mes') + array_search($medicion->getMes(), $array_meses)) > 11 ){
        $key_meses = $request->getParameter('suma_mes') + array_search($medicion->getMes(), $array_meses) - 12;
        $medicion->setAnio($medicion->getAnio()+1);
      }else{
        if( ($request->getParameter('suma_mes') + array_search($medicion->getMes(), $array_meses)) < 0 ){
          $key_meses = $request->getParameter('suma_mes') + array_search($medicion->getMes(), $array_meses) + 12;
          $medicion->setAnio($medicion->getAnio()-1);
        }else{
          $key_meses = $request->getParameter('suma_mes') + array_search($medicion->getMes(), $array_meses);
        }
        
        
      }
      $medicion->setMes($array_meses[$key_meses]);
      $mediciones_backup[$key] = $medicion;
      $mediciones_backup[$key]['tipo'] = $medicion->getTipo();
      $mediciones_backup[$key]['anio'] = $medicion->getAnio();
      $mediciones_backup[$key]['valor'] = $medicion->getValor();
      $mediciones_backup[$key]['estacion'] = $medicion->getEstacion();
      $mediciones_backup[$key]['mes'] = $medicion->getMes();
      echo $key_meses.' '.$medicion->getMes()." ".$medicion->getAnio()."->".$array_meses[$key_meses]."<br />";
     //echo 'key: '.$key.', valor:'.$medicion->getValor().'<br />';
     $medicion->delete();
     echo $medicion->getMes();
     
     echo " ".$medicion->getMes()."<br />";
     //$medicion->save();
      
    }
    
    foreach($mediciones_backup as $key => $medicion1){
      $medicion = new Mediciones();
      
      $medicion->setTipo($medicion1['tipo']);
      $medicion->setAnio($medicion1['anio']);
      $medicion->setValor($medicion1['valor']);
      $medicion->setEstacion(Doctrine_Core::getTable('estacion')->find($medicion1['estacion']));
      $medicion->setMes($medicion1['mes']);
      $medicion->save();
    }
    $this->setLayout(false);
  }
  
  public function executeIndex(sfWebRequest $request)
  {

  	$id_estacion=$request->getParameter('estacion');

  $q = Doctrine_Query::create()->from('Estacion e')
                               ->where('e.identificador = ?', $id_estacion);
  $estacion = $q->fetchArray();

  $this->estacion = $estacion [0];

  $mediciones=array();
  $mediciones_array=array();

  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Cloruro"', $this->estacion['id'])
                               ->orderBy('anio ASC');
  $mediciones = $q->fetchArray();

  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  $this->mediciones_cloruro = $mediciones_array;

  $mediciones=array();
  $mediciones_array=array();


  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Sulfato"', $this->estacion['id'])
                               ->orderBy('anio ASC');
  $mediciones = $q->fetchArray();

  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  $this->mediciones_sulfato = $mediciones_array;

  $mediciones=array();
  $mediciones_array=array();


  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Humidificacion"', $this->estacion['id'])
                               ->orderBy('anio ASC');
  $mediciones = $q->fetchArray();

  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  $this->mediciones_humidificacion = $mediciones_array;


  $q = Doctrine_Query::create()->from('Fotos f')
                               ->where('f.estacion = ?', $this->estacion['id']);
  $fotos = $q->fetchArray();

  $this->fotos = $fotos;
  
  $mediciones=array();
  $mediciones_array=array();
  
  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Velocidad_aluminio"', $this->estacion['id'])
                               ->orderBy('m.anio ASC');
                               
  $mediciones = $q->fetchArray();
  
  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  
  $this->mediciones_velocidad_aluminio = $mediciones_array;
  
  $mediciones=array();
  $mediciones_array=array();
  
  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Velocidad_acero"', $this->estacion['id'])
                               ->orderBy('anio ASC');
                               
  $mediciones = $q->fetchArray();
  
  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  
  $this->mediciones_velocidad_acero = $mediciones_array;
  
  $mediciones=array();
  $mediciones_array=array();
  
  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Velocidad_galvanizado"', $this->estacion['id'])
                               ->orderBy('anio ASC');
                               
  $mediciones = $q->fetchArray();
  
  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  
  $this->mediciones_velocidad_galvanizado = $mediciones_array;
  
  $mediciones=array();
  $mediciones_array=array();
  
  $q = Doctrine_Query::create()->from('Mediciones m')
                               ->where('m.estacion = ? and m.tipo = "Velocidad_cobre"', $this->estacion['id'])
                               ->orderBy('anio ASC');
                               
  $mediciones = $q->fetchArray();
  
  foreach($mediciones as $item)
  {
    $mediciones_array[$item['anio']][$item['mes']]=$item['valor'];

  }
  
  $this->mediciones_velocidad_cobre = $mediciones_array;
  
  }



  public function executeListadoEstacionesJSON($request)
  {
  $this->getResponse()->setContentType('application/json');

  $q = Doctrine_Query::create()->from('Estacion');
  $estaciones = $q->fetchArray();



 

  return $this->renderText(json_encode($estaciones));



  
  }




}
