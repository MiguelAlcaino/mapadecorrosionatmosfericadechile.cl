
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
</select> 
</td>
<td>
<select id="tiempo"> 
      <option value="1anio">1 a&ntilde;o</option> 
      <option value="2anios">2 a&ntilde;os</option> 
      <option value="3anios">3 a&ntilde;os</option>        
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

<div id="imagen">

</div>
