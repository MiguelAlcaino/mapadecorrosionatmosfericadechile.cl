<?php if($sf_request->getParameter('estacion')==-1):?>
    <?php include_partial('estaciones/inicio')?>
<?php else:?>
    <?php include_partial('estaciones/estacion', array('estacion' => $estacion,'mediciones_cloruro' => $mediciones_cloruro,'mediciones_sulfato' => $mediciones_sulfato, 'mediciones_humidificacion' => $mediciones_humidificacion, 'fotos' => $fotos, 'mediciones_velocidad_aluminio' => $mediciones_velocidad_aluminio, 'mediciones_velocidad_galvanizado' => $mediciones_velocidad_galvanizado, 'mediciones_velocidad_cobre' => $mediciones_velocidad_cobre, 'mediciones_velocidad_acero' => $mediciones_velocidad_acero))?>
<?php endif;?>
