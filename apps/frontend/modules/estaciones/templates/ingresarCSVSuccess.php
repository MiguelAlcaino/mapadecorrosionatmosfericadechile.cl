<?php slot('added_css')?>
  <style>
    #csv, th, td{
      border: 1px solid black;
    }
    #csv td{
      color: black;
    }
  </style>
<?php end_slot()?>
<?php $meses_nuevo = array();?>
<?php foreach($meses as $key => $valor):?>
  <?php $meses_nuevo[$key] = $valor?>
<?php endforeach;?> 
<?php if(isset($contenido_archivo)):?>
  <h1><?php echo $tipo?></h1>
<table id="csv">
  <thead>
    <tr>
      <th>Estacion</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach($contenido_archivo['lineas'] as $key => $linea):?>
    <tr>
      <?php foreach($linea as $key_linea =>$valor):?>
        <?php if($key_linea == 0):?>
          <td><?php echo $valor?></td>
        <?php else:?>
          
          <td style="<?php echo ($contenido_archivo['datos_modelo'][$key][$key_linea-1]['valor'] == $valor) ? 'background-color: green;' : 'background-color: red;'?>">
            <strong><?php echo $contenido_archivo['datos_modelo'][$key][$key_linea-1]['mes']?> - <?php echo $contenido_archivo['datos_modelo'][$key][$key_linea-1]['anio']?></strong> 
            <br />
            <?php echo $valor?> -> <?php echo $contenido_archivo['datos_modelo'][$key][$key_linea-1]['valor']?>
            <br />
            <?php echo link_to('[Edit]','mediciones/edit?id='.$contenido_archivo['datos_modelo'][$key][$key_linea-1]['id'])?>
            <?php echo ($contenido_archivo['datos_modelo'][$key][$key_linea-1]['valor'] == $valor) ? '' : link_to('[Up!]', 'estaciones/actualizarValor?id='.$contenido_archivo['datos_modelo'][$key][$key_linea-1]['id'].'&valor='.$valor)?>
            <?php if(!$contenido_archivo['datos_modelo'][$key][$key_linea-1]['valor']):?>
              <?php $numero_mes=array_search($contenido_archivo['datos_modelo'][$key][$key_linea-2]['mes'], $meses_nuevo)+3?>
                <?php if($numero_mes > 11):?>
                  <?php $numero_mes = $numero_mes - 12;?>
                  <?php $anio =  $contenido_archivo['datos_modelo'][$key][$key_linea-2]['anio'] +1?> 
                <?php else:?>
                  <?php $anio =  $contenido_archivo['datos_modelo'][$key][$key_linea-2]['anio']?>
                <?php endif;?>
              
              <?php echo link_to('[+Mes '.$meses_nuevo[$numero_mes].' - '.$anio.']', 'estaciones/agregarMedicionPorMesAnterior?mes='.$meses_nuevo[$numero_mes].'&anio='.$anio.'&valor='.$valor.'&tipo='.$tipo.'&estacion='.$linea[0])?>
            <?php endif?>
          </td>
        <?php endif?>
      <?php endforeach?>
      
    </tr>
    <?php endforeach?>
  </tbody>
</table>
<?php endif?>
<form method="post" enctype="multipart/form-data">
<?php echo $form?>
<input type="submit" value="dale!" />
</form>
<pre>
  <?php //print_r($contenido_archivo['datos_modelo'])?>
</pre>