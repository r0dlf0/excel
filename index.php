<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="shortcut icon" href="img/logo-mywebsite-urian-viera.svg"/>
  <title>Cómo Importar Excel a MYSQL con PHP sin Libreria de forma Fácil</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/cargando.css">
  <link rel="stylesheet" type="text/css" href="css/cssGenerales.css">
</head>
<body>

<div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>


<nav class="navbar navbar-expand-lg navbar-light navbar-dark fixed-top" style="background-color: blue !important;">
    <ul class="navbar-nav mr-auto collapse navbar-collapse">
      <li class="nav-item active">
        <a href="index.php"> 
          <img src="img/logo-mywebsite-urian-viera.svg" alt="Web Developer Urian Viera" width="120">
        </a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
      <h5 class="navbar-brand"> FONTEC </h5>
    </div>
</nav>


<div class="container">

<h3 class="text-center">
    Cómo Importar Excel a MYSQL con PHP sin Libreria de forma Fácil
</h3>
<hr>
<br><br>


 <div class="row">
    <div class="col-md-7">
      <form action="recibe_excel_validando.php" method="POST" enctype="multipart/form-data"/>
        <div class="file-input text-center">
            <input  type="file" name="dataCliente" id="file-input" class="file-input__input"/>
            <label class="file-input__label" for="file-input">
              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
              <span>Elegir Archivo Excel</span></label
            >
          </div>
      <div class="text-center mt-5">
          <input type="submit" name="subir" class="btn-enviar" value="Subir Excel"/>
      </div>
      </form>
    </div>

    <div class="col-md-5">
  <?php
  header("Content-Type: text/html;charset=utf-8");
  include('config.php');
  $sqlClientes = ("SELECT contenidos.*, modelos.*, marcas.nombre as nombre_marca 
                    FROM contenidos 
                    left join modelos on contenidos.modelo_id = modelos.modelo_id
                    left join marcas on modelos.marca_id = marcas.marca_id
                    ORDER BY contenido_id ASC");
  $queryData   = mysqli_query($con, $sqlClientes);
  $total_client = mysqli_num_rows($queryData);
  ?>

      <h6 class="text-center">
        Lista de modelos <strong>(<?php echo $total_client; ?>)</strong>
      </h6>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>orden</th>
               <th>id</th>
              <th>marca</th>
              <th>nombre</th>
              <th>pantalla</th>
              <th>lectorHuella</th>
               <th>bateria Extraible</th>
              <th>bateria Interna</th>
               <th>bandeja</th>
              <th>botones</th>
              <th>pulsador</th>
               <th>flex</th>
              <th>lente camara</th>
              <th>camara frontal</th>
               <th>camara trasera</th>
              <th>tapa media</th>
              <th>tapa</th>
               <th>parlante</th>
              <th>bisel</th>
              <th>vibrador</th>
               <th>antena</th>
              <th>sensor de huella</th>
              <th>placa Principal</th>
              <th>placa inferior</th>
              <th>placa Completa</th>
              <th>parlante Entero</th>
              <th>auricular</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            while ($data = mysqli_fetch_array($queryData)) { ?>
            <tr>
              <th scope="row"><?php echo $i++; ?></th>
              <td><?php echo $data['contenido_id']; ?></td>
              <td><?php echo $data['nombre_marca']; ?></td>
              <td><?php echo $data['nombre_modelo']; ?></td>
              <td><?php echo $data['pantalla']; ?></td>
              <td><?php echo $data['lectorHuella']; ?></td>
              <td><?php echo $data['bateriaExtraible']; ?></td>
              <td><?php echo $data['bateriaInterna']; ?></td>
              <td><?php echo $data['bandeja']; ?></td>
              <td><?php echo $data['botones']; ?></td>
              <td><?php echo $data['pulsador']; ?></td>
              <td><?php echo $data['flex']; ?></td>
              <td><?php echo $data['lente_camara']; ?></td>
              <td><?php echo $data['camara_frontal']; ?></td>
              <td><?php echo $data['camara_trasera']; ?></td>
              <td><?php echo $data['tapa_media']; ?></td>
              <td><?php echo $data['tapa']; ?></td>
              <td><?php echo $data['parlante']; ?></td>
              <td><?php echo $data['bisel']; ?></td>
              <td><?php echo $data['vibrador']; ?></td>
              <td><?php echo $data['antena']; ?></td>
              <td><?php echo $data['sensor_huella']; ?></td>
              <td><?php echo $data['placaPrincipal']; ?></td>
              <td><?php echo $data['placaInferior']; ?></td>
              <td><?php echo $data['placaCompleta']; ?></td>
              <td><?php echo $data['parlanteEntero']; ?></td>
              <td><?php echo $data['auricular']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>

    </div>
  </div>

</div>


<script src="js/jquery.min.js"></script>
<script src="'js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            $(".cargando").fadeOut(1000);
        });      
});
</script>

</body>
</html>