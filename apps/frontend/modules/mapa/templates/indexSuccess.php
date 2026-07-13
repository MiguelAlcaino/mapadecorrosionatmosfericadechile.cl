<?php use_helper('jQuery');?>


<?php echo javascript_tag("jQuery(document).ready(function() {iniciar_mapas('".url_for('@homepage')."');});")?>





	<div id="map" class="mapa"></div> 
	<div class="galeriaP" id="galeriaP">
    <?php include_partial('estaciones/inicio')?>
    </div>


	<div style="clear: both;"> </div>

