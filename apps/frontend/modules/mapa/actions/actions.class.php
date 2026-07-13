<?php

/**
 * mapa actions.
 *
 * @package    sf_sandbox
 * @subpackage mapa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mapaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function executeMantencion(sfWebRequest $request){
    
  }
  
  public function executeIndex(sfWebRequest $request)
  {

  }
  
  

  public function executeSoloMapa(sfWebRequest $request)
  {

  }

  public function executeMapasGenerados(sfWebRequest $request)
  {

  }
  
  public function executeMapasGeneradosTortas(sfWebRequest $request){
    
  }



  public function executeMapaImagen(sfWebRequest $request)
  {
	  $zona=$request->getParameter('zona');
	  $tiempo=$request->getParameter('tiempo');
	  $material=$request->getParameter('material');

	  $imagen=$material . $zona . $tiempo . ".png";
	  $this->imagen=$imagen;


  }
}
