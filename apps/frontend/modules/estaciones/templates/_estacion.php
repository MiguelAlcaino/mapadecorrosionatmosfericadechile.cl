
  <script type="text/javascript"> 


  $(function() {

    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    

    galleries[0].addAnimation('wild',
      function(img_container, direction, desc) {
        var current_left = parseInt(img_container.css('left'), 10);
        var current_top = parseInt(img_container.css('top'), 10);
        if(direction == 'left') {
          var old_image_left = '-'+ this.image_wrapper_width +'px';
          img_container.css('left',this.image_wrapper_width +'px');
          var old_image_top = '-'+ this.image_wrapper_height +'px';
          img_container.css('top', this.image_wrapper_height +'px');
        } else {
          var old_image_left = this.image_wrapper_width +'px';
          img_container.css('left','-'+ this.image_wrapper_width +'px');
          var old_image_top = this.image_wrapper_height +'px';
          img_container.css('top', '-'+ this.image_wrapper_height +'px');
        };
        if(desc) {
          desc.css('bottom', '-'+ desc[0].offsetHeight +'px');
          desc.animate({bottom: 0}, this.settings.animation_speed * 2);
        };
        img_container.css('opacity', 0);
        return {old_image: {left: old_image_left, top: old_image_top, opacity: 0},
                new_image: {left: current_left, top: current_top, opacity: 1},
                easing: 'easeInBounce',
                speed: 2500};
      }
    );
  });

  </script> 


<div class="demo">
<h3>ESTACIÓN <?php echo $estacion['identificador']?>: <?php echo $estacion['nombre_estacion']?></h3>

<div class="ad-gallery" style="margin: 0 auto;width: 90%; margin-bottom: 15px;">
  <div class="ad-image-wrapper">
  </div>
  <div class="ad-controls">
  </div>
  <div class="ad-nav">
    <div class="ad-thumbs">
      <ul class="ad-thumb-list">

<?php foreach($fotos as $item):?>
<li>
<a href="<?php echo public_path('/uploads/estaciones/'.$item['foto']) ?>"><img longdesc="<?php echo $item['descripcion'] ?>" src="<?php echo public_path('/uploads/estaciones/s_'.$item['foto']) ?>" /></a>
</li> 
<?php endforeach;?>
      </ul>
    </div>
  </div>
</div>


<div >
<div class="textbox">
<h2>Datos Estaci&oacute;n Meteorol&oacute;gica</h2>

<br />
<b>Latitud:</b> <?php echo $estacion['latitud']?><br />
<b>Longitud:</b> <?php echo $estacion['longitud']?><br />
<b>Altura:</b> <?php echo $estacion['altura']?> mts.<br />
<b>Distancia al mar:</b> <?php echo $estacion['distancia_al_mar']?> mts.<br />
<br />
<b>Regi&oacute;n:</b> <?php echo $estacion['region']?><br />
<!--<b>Provincia:</b> <?php echo $estacion['provincia']?><br />
<b>Comuna:</b> <?php echo $estacion['comuna']?><br />-->
 
</div>

<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>Cloruro Atmósferico en mgCl/m2dia</h2>



<table style="border: 1px solid #999; width: 100%;">

<?php if(count($mediciones_cloruro)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif; ?>

<?php foreach($mediciones_cloruro as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>

<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>SO2 atmosférico en mgSO2/m2dia</h2>

<table style="border: 1px solid #999; width: 100%;">
<?php if(count($mediciones_sulfato)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif;?>
<?php foreach($mediciones_sulfato as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>



<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>Tiempo de Humidificación</h2>

<table style="border: 1px solid #999; width: 100%;">

<?php if(count($mediciones_humidificacion)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif;?>
<?php foreach($mediciones_humidificacion as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>

<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>Velocidades de corrosión del Acero &micro;m/año</h2>

<table style="border: 1px solid #999; width: 100%;">

<?php if(count($mediciones_velocidad_acero)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif;?>
<?php foreach($mediciones_velocidad_acero as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>

<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>Velocidades de corrosión del Cobre &micro;m/año</h2>

<table style="border: 1px solid #999; width: 100%;">

<?php if(count($mediciones_velocidad_cobre)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif;?>
<?php foreach($mediciones_velocidad_cobre as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>

<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>Velocidades de corrosión del Galvanizado &micro;m/año</h2>

<table style="border: 1px solid #999; width: 100%;">

<?php if(count($mediciones_velocidad_galvanizado)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif;?>
<?php foreach($mediciones_velocidad_galvanizado as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>

<div style="width: 100%; text-align: center; margin-top: 30px;">
<h2>Velocidades de corrosión del Aluminio g/m&sup2; año</h2>

<table style="border: 1px solid #999; width: 100%;">

<?php if(count($mediciones_velocidad_aluminio)==0):?>
<tr>
<th>No hay Datos Disponibles</th>
</tr>
<?php endif;?>
<?php foreach($mediciones_velocidad_aluminio as $key => $item):?>
<tr><th colspan="12"><?php echo $key?></th></tr>
<tr>
<th>Ene</th>
<th>Feb</th>
<th>Mar</th>
<th>Abr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Ago</th>
<th>Sept</th>
<th>Oct</th>
<th>Nov</th>
<th>Dic</th>
</tr>
<tr>
<th><?php echo isset($item['Enero']) ? $item['Enero'] : '---'?></th>
<th><?php echo isset($item['Febrero'])? $item['Febrero'] : '---'?></th>
<th><?php echo isset($item['Marzo'])? $item['Marzo'] : '---'?></th>
<th><?php echo isset($item['Abril'])? $item['Abril'] : '---'?></th>
<th><?php echo isset($item['Mayo'])? $item['Mayo'] : '---'?></th>
<th><?php echo isset($item['Junio'])? $item['Junio'] : '---'?></th>
<th><?php echo isset($item['Julio'])? $item['Julio'] : '---'?></th>
<th><?php echo isset($item['Agosto'])? $item['Agosto'] : '---'?></th>
<th><?php echo isset($item['Septiembre'])? $item['Septiembre'] : '---'?></th>
<th><?php echo isset($item['Octubre'])? $item['Octubre'] : '---'?></th>
<th><?php echo isset($item['Noviembre'])? $item['Noviembre'] : '---'?></th>
<th><?php echo isset($item['Diciembre'])? $item['Diciembre'] : '---'?></th>
</tr>
<?php endforeach;?>
</table>

</div>

<div style="width: 100%; text-align: right; margin-top: 20px;">
<a href="javascript:llenarDIV(-1,-33.48,-70.99,'<?php echo url_for('@homepage')?>')" >Volver</a>
</div>
</div>

    </div> 

