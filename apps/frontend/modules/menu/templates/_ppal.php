
<h1 id="title">Proyecto INNOVA: <br> Construcci&oacute;n de mapas de Corrosividad Atmosf&eacute;rica de Chile</h1> 

<ul class="menu"> 
	<li class="top"><a class="top_link" href="<?php echo url_for('@homepage')?>"><span>Inicio</span></a></li>
	
	<li class="top"><a href="#" class="top_link"><span>Estaciones</span></a> 
		<ul class="sub"> 
      <?php $q = Doctrine_Query::create()->from('Estacion e')
                                         ->orderBy('e.identificador ASC');?>
      <?php $estaciones = $q->fetchArray();?>


      <?php foreach($estaciones as $estacion):?>
					<li><a style='color: red' href='javascript:llenarDIV(<?= $estacion["identificador"]?>,<?= $estacion["latitud"]?>,<?= $estacion["longitud"]?>,"<?= url_for('@homepage')?>")'><?= $estacion["identificador"]?> : <?= $estacion["nombre_estacion"]?></a></li>	
      <?php endforeach;?>		
    </ul> 
	</li> 
	

<li class="top"><a class="top_link" href="<?php echo url_for('mapa/mapasGenerados')?>">Mapas</a></li>	
<li class="top"><a class="top_link" href="<?php echo url_for('mapa/mapasGeneradosTortas')?>">Mapas puntuales</a></li>
<li class="top"><a class="top_link" href="<?php echo url_for('menu/modelos')?>">Modelos</a></li>
	<?php if($sf_user->isAuthenticated()):?> 
	<li class="top"><a href="#" class="top_link"><span>Mantenedores</span></a> 
		<ul class="sub"> 
			<li><?= link_to('Listado de Estaciones','estacion/index')?></li>
			<li><?= link_to('Listado de Fotos','fotos/index')?></li>
			<li><?= link_to('Listado de Mediciones','mediciones/index')?></li>					
    		</ul> 
	</li>
	<?php endif;?>
<li class="top"><a class="top_link" href="<?php echo url_for('menu/quienesSomos')?>">Quienes somos</a></li>
<!--<li class="top"><a class="top_link" href="<?php echo url_for('menu/acercaProyecto')?>">Acerca del proyecto</a></li>-->
<li class="top"><a class="top_link" href="<?php echo url_for('menu/acercaProyecto')?>">Documentos Relevantes</a>
  <ul class="sub">
    <li><?php echo link_to('Especificaciones técnicas para norma', 'http://www.mapadecorrosionatmosfericadechile.cl/uploads/publicaciones/Bases%20Tecnicas.pdf')?></li>
    <li><?php echo link_to('Tenacidad de los metales y aleaciones', 'http://www.mapadecorrosionatmosfericadechile.cl/uploads/publicaciones/DETERMINACION%20DE%20LA%20TENACIDAD%20DE%20LOS%20METALES%20Y%20ALEACIONES.pdf')?></li>
    <li><?php echo link_to('Toughness of SAE 2020...','http://mapadecorrosionatmosfericadechile.cl/uploads/publicaciones/Toughness%20of%20SAE%201020...pdf')?></li>
    <li><?php echo link_to('Publicaciones', 'menu/acercaProyecto')?></li>
  </ul>
</li>
<li class="top"><a class="top_link" href="<?php echo url_for('http://www.achcorr.cl/')?>">ACHCORR</a></li>	

<!--
	<li class="top"><a href="#" class="top_link"><span>Archivos</span></a> 
		<ul class="sub"> 
			<li><a href="<?= public_path('uploads/wheaterlink.pdf')?>">Manual WheaterLink</a></li>			
      <li><a href="<?= public_path('uploads/WheaterLink.zip')?>">Programa WheaterLink</a></li>		
    </ul> 
	</li> 
  -->
  <?php if($sf_user->isAuthenticated()):?> 
	 <li class="top" style="float:right"><a class="top_link" href="<?php echo url_for('sfGuardAuth/signout')?>"><span>Cerrar Sesión</span></a></li>
	<?php endif;?> 
</ul> 