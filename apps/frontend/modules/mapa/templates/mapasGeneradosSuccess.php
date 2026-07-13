<?php use_helper('jQuery');?>
<div style="float: left">
<table>
<tr>
<th colspan="3">Corrosión</th>
</tr>
<tr>
<th>Zona</th>
<th>Tiempo</th>
<th>Material</th>
<th>Generar</th>
</tr>
<tr>
<td>
<select id="zona"> 
      <option value="Chile">Chile</option> 
      <option value="5Region">5ª Región</option> 
</select> 
</td>
<td>
<select id="tiempo"> 
      <option value="3Meses">3 Meses</option> 
      <option value="6Meses">6 Meses</option> 
      <option value="9Meses">9 Meses</option> 
      <option value="12Meses">12 Meses</option>
      <option value="15Meses">15 Meses</option>
      <option value="18Meses">18 Meses</option>
      <option value="21Meses">21 Meses</option>
      <option value="24Meses">24 Meses</option>
      <option value="27Meses">27 Meses</option>
      <option value="30Meses">30 Meses</option>
      <option value="33Meses">33 Meses</option>
      <option value="36Meses">36 Meses</option>
       
</select> 
</td>
<td>
<select id="material"> 
      <option value="Acero">Acero</option> 
      <option value="Cobre">Cobre</option> 
      <option value="Galva">Galvanizado</option> 
      <option value="Aluminio">Aluminio</option> 
</select> 
</td>


    <td style="text-align:center;">
<?php echo jq_link_to_remote('<img src="' . public_path('images/new.png') . '" alt="Nuevo" />', array(
    'script' => true,
    'update' => 'imagen',
    'url'    => 'mapa/mapaImagen',
    'with'   =>     "'zona=' + jQuery('#zona').val() + 
                    '&tiempo=' + jQuery('#tiempo').val() + 
                    '&material=' + jQuery('#material').val()"))?>



</a>   

    
    </td>

</tr>
</table>

</div>
<div style="float: right">
<table>
<tr>
<th colspan="3">Agresividad</th>
</tr>
<tr>
<th>Zona</th>
<th>Tiempo</th>
</tr>
<tr>
<td>
<select id="zonaAgresividad"> 
      <option value="Chile">Chile</option> 
      <option value="5Region">5ª Región</option> 
</select> 
</td>
<td>
<select id="tiempoAgresividad"> 
      <option value="1anio">1 a&ntilde;o</option> 
      <option value="2anios">2 a&ntilde;os</option> 
      <option value="3anios">3 a&ntilde;os</option> 
</select> 
</td>



    <td style="text-align:center;">
<?php echo jq_link_to_remote('<img src="' . public_path('images/new.png') . '" alt="Nuevo" />', array(
    'script' => true,
    'update' => 'imagen',
    'url'    => 'mapa/mapaImagen',
    'with'   =>     "'zona=' + jQuery('#zonaAgresividad').val() + 
                    '&tiempo=' + jQuery('#tiempoAgresividad').val() + 
                    '&material=Agresividad'"))?>



</a>   

    
    </td>

</tr>
</table>
</div>
<div id="imagen">

</div>
