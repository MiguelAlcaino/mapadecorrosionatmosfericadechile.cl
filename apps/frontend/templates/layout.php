<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>






    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php if (has_slot('added_css')): ?>
      <?php include_slot('added_css')?>
    <?php endif;?>
</head>
 
 
<body  style="text-align: center;"> 

<div class="container">
<?php if($sf_request->getParameter('action')!='soloMapa'): ?>
<?php include_component('menu','ppal') ?>
<?php endif; ?>


<?php echo $sf_content ?>

</div>
 
 </body>



</html>
