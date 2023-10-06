<?php
require('config.php');
$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);
		$marca_nombre                = !empty($datos[0])  ? ($datos[0]) : '';
        $modelo_nombre               = !empty($datos[1])  ? ($datos[1]) : '';
        $pantalla                   = !empty($datos[2]) ? ($datos[2]) : '';
        $bateria                    = !empty($datos[3]) ? ($datos[3]) : '';
        $bandeja                    = !empty($datos[4]) ? ($datos[4]) : '';
        $pulsador_flex              = !empty($datos[5]) ? ($datos[5]) : '';
        $pulsador                   = !empty($datos[6]) ? ($datos[6]) : '';
        $flex                       = !empty($datos[7]) ? ($datos[7]) : '';
        $lente_camara               = !empty($datos[8]) ? ($datos[8]) : '';
        $lente_frontal              = !empty($datos[9]) ? ($datos[9]) : '';
        $camara_trasera             = !empty($datos[10]) ? ($datos[10]) : '';
        $tapa_media                 = !empty($datos[11]) ? ($datos[11]) : '';
        $tapa                       = !empty($datos[12]) ? ($datos[12]) : '';
        $parlante                   = !empty($datos[13]) ? ($datos[13]) : '';
        $marco                      = !empty($datos[14]) ? ($datos[14]) : '';
        $vibrador                   = !empty($datos[15]) ? ($datos[15]) : '';
        $antena                     = !empty($datos[16]) ? ($datos[16]) : '';
        $sensor_huella              = !empty($datos[17]) ? ($datos[17]) : '';
        $placa_superior             = !empty($datos[18]) ? ($datos[18]) : '';
        $placa_inferior             = !empty($datos[19]) ? ($datos[19]) : '';
        $placa_completa             = !empty($datos[20]) ? ($datos[20]) : '';
        $auricular                  = !empty($datos[21]) ? ($datos[21]) : '';
       
      
         $insertarModelos = "INSERT INTO modelos (
            nombre_modelo, marca_id
        ) VALUES (
            '$modelo_nombre', '$marca_id'
        )";
         mysqli_query($con, $insertarModelos);

         $insertarContenidos = "INSERT INTO contenidos(
            pantalla,
            bateria,
            bandeja,
            pulsador_flex,
            pulsador,
            flex,
            lente_camara,
            camara_frontal,
            camara_trasera,
            tapa_media,
            tapa,
            parlante,
            marco,
            vibrador,
            antena,
            sensor_huella,
            placa_superior,
            placa_inferior,
            placa_completa,
            auricular
        ) VALUES (
            '$pantalla',
            '$bateria',
            '$bandeja',
            '$pulsador_flex',
            '$pulsador',
            '$flex ',
            '$lente_camara',
            '$lente_frontal',
            '$camara_trasera',
            '$tapa_media',
            '$tapa',
            '$parlante',
            '$marco',
            '$vibrador',
            '$antena',
            '$sensor_huella',
            '$placa_superior',
            '$placa_inferior',
            '$placa_completa',
            '$auricular',
        )";
        mysqli_query($con, $insertarContenidos);
    }

      echo '<div>'. $i. "). " .$linea.'</div>';
    $i++;
}


  echo '<p style="text-aling:center; color:#333;">Total de Registros: '. $cantidad_regist_agregados .'</p>';

?>

<a href="index.php">Atras</a>