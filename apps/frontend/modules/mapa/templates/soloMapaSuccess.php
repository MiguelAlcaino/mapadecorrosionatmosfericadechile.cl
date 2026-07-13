<? use_helper('jQuery');?>


<?php echo javascript_tag("jQuery(document).ready(function() {iniciar_mapas('".url_for('@homepage')."');   });")?>





	<div id="map" class="mapa" <?php if($sf_request->getParameter('action')=='soloMapa'): echo 'style="width: 100%;height: 100%;"';endif;?>></div> 



	<div style="clear: both;"> </div>

