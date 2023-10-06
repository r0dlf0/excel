<?php
require('config.php');
$cant_duplicidad = 0;
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
		$marca_nombre               = !empty($datos[0])  ? ($datos[0]) : '';
        $modelo_nombre              = !empty($datos[1])  ? ($datos[1]) : '';
        $pantalla                   = !empty($datos[2]) ? ($datos[2]) : '';
        $lectorHuella               = !empty($datos[3]) ? ($datos[3]) : '';
        $bateriaExtraible           = !empty($datos[4]) ? ($datos[4]) : '';
        $bateriaInterna             = !empty($datos[5]) ? ($datos[5]) : '';
        $bandeja                    = !empty($datos[6]) ? ($datos[6]) : '';
        $botones                    = !empty($datos[7]) ? ($datos[7]) : '';
        $pulsador                   = !empty($datos[8]) ? ($datos[8]) : '';
        $flex                       = !empty($datos[9]) ? ($datos[9]) : '';
        $lente_camara               = !empty($datos[10]) ? ($datos[10]) : '';
        $lente_frontal              = !empty($datos[11]) ? ($datos[11]) : '';
        $camara_trasera             = !empty($datos[12]) ? ($datos[12]) : '';
        $tapa_media                 = !empty($datos[13]) ? ($datos[13]) : '';
        $tapa                       = !empty($datos[14]) ? ($datos[14]) : '';
        $parlante                   = !empty($datos[15]) ? ($datos[15]) : '';
        $bisel                      = !empty($datos[16]) ? ($datos[16]) : '';
        $vibrador                   = !empty($datos[17]) ? ($datos[17]) : '';
        $antena                     = !empty($datos[18]) ? ($datos[18]) : '';
        $sensor_huella              = !empty($datos[19]) ? ($datos[19]) : '';
        $placaPrincipal             = !empty($datos[20]) ? ($datos[20]) : '';
        $placaInferior              = !empty($datos[21]) ? ($datos[21]) : '';
        $placaCompleta              = !empty($datos[22]) ? ($datos[22]) : '';
        $ParlanteEntero             = !empty($datos[23]) ? ($datos[23]) : '';
        $auricular                  = !empty($datos[24]) ? ($datos[24]) : '';
        $fecModificacion            = "Sin Modificaciónes";

       
        if (!empty($marca_nombre)) {
            // Verificar si la marca ya existe en la tabla 'marcas'
            $check_marca_query = "SELECT marca_id FROM marcas WHERE nombre = '$marca_nombre'";
            $resultado_check_marca = mysqli_query($con, $check_marca_query);
    
            if (mysqli_num_rows($resultado_check_marca) > 0) {
                // La marca ya existe en la tabla 'marcas', obtenemos el 'marca_id'
                $marca_row = mysqli_fetch_assoc($resultado_check_marca);
                $marca_id = $marca_row['marca_id'];
            } else {
                // La marca no existe en la tabla 'marcas', la insertamos y obtenemos el 'marca_id'
                $insertar_marca_query = "INSERT INTO marcas (nombre) VALUES ('$marca_nombre')";
                mysqli_query($con, $insertar_marca_query);
    
                $marca_id = mysqli_insert_id($con);
            }
        }

 
 
//No existe Registros Duplicados
if ($cant_duplicidad == 0) {


    // Insertar en la tabla modelos
    $insertarModelos = "INSERT INTO modelos (nombre_modelo, marca_id) VALUES ('$modelo_nombre','$marca_id')";
    mysqli_query($con, $insertarModelos);

    // Obtener el ID insertado en la tabla modelos
    $modelo_id = mysqli_insert_id($con);

    // Insertar en la tabla contenidos
    $insertarContenidos = "INSERT INTO contenidos (
        nombre_modelo,
        pantalla,
        lectorHuella,
        bateriaExtraible,
        bateriaInterna,
        bandeja,
        botones,
        pulsador,
        flex,
        lente_camara,
        camara_frontal,
        camara_trasera,
        tapa_media,
        tapa,
        parlante,
        bisel,
        vibrador,
        antena,
        sensor_huella,
        placaPrincipal,
        placaInferior,
        placaCompleta ,
        ParlanteEntero,
        auricular,
        fec_modificacion,
        modelo_id
    ) VALUES (
        '$modelo_nombre',
        '$pantalla',                   
        '$lectorHuella',             
        '$bateriaExtraible',           
        '$bateriaInterna',            
        '$bandeja',                    
        '$botones',                   
        '$pulsador',                   
        '$flex',                       
        '$lente_camara',               
        '$lente_frontal',              
        '$camara_trasera',             
        '$tapa_media',                 
        '$tapa',                       
        '$parlante',                 
        '$bisel',                   
        '$vibrador',                  
        '$antena',                     
        '$sensor_huella',             
        '$placaPrincipal',          
        '$placaInferior',              
        '$placaCompleta',              
        '$ParlanteEntero',            
        '$auricular', 
        '$fecModificacion',
        '$modelo_id'
    )";
    mysqli_query($con, $insertarContenidos);
}
    
/**Caso Contrario actualizo el o los Registros ya existentes*/
// Verificar si el modelo ya existe en la tabla 'modelos'
$check_modelo_query = "SELECT modelo_id FROM modelos WHERE nombre_modelo = '$modelo_nombre'";
$resultado_check_modelo = mysqli_query($con, $check_modelo_query);

if (mysqli_num_rows($resultado_check_modelo) > 0) {
    // El modelo ya existe en la tabla 'modelos', obtenemos el 'modelo_id'
    $modelo_row = mysqli_fetch_assoc($resultado_check_modelo);
    $modelo_id = $modelo_row['modelo_id'];

    // Actualizar los datos de pantalla, batería y bandeja en la tabla 'contenidos'
    $updateData = "UPDATE contenidos SET pantalla='$pantalla', bateriaExtraible='$bateriaExtraible', bandeja='$bandeja' WHERE modelo_id='$modelo_id'";
    mysqli_query($con, $updateData);
} else {
    // El modelo no existe en la tabla 'modelos', lo insertamos
    $insertarModelos = "INSERT INTO modelos (nombre_modelo, marca_id) VALUES ('$modelo_nombre','$marca_id')";
    mysqli_query($con, $insertarModelos);

    // Obtener el ID insertado en la tabla modelos
    $modelo_id = mysqli_insert_id($con);

    // Insertar en la tabla contenidos1
    $insertarContenidos = "INSERT INTO contenidos (
        nombre_modelo,
        pantalla,
        lectorHuella,
        bateriaExtraible,
        bateriaInterna,
        pulsador_flex,
        bandeja,
        botones,
        pulsador,
        flex,
        lente_camara,
        camara_frontal,
        camara_trasera,
        tapa_media,
        tapa,
        parlante,
        bisel,
        vibrador,
        antena,
        sensor_huella,
        placaPrincipal,
        placaInferior,
        placaCompleta ,
        ParlanteEntero,
        auricular,
        modelo_id
    ) VALUES (
        '$modelo_nombre',
        '$pantalla',                   
        '$lectorHuella',             
        '$bateriaExtraible',           
        '$bateriaInterna',            
        '$bandeja',                    
        '$botones',                   
        '$pulsador',                   
        '$flex',                       
        '$lente_camara',               
        '$lente_frontal',              
        '$camara_trasera',             
        '$tapa_media',                 
        '$tapa',                       
        '$parlante',                 
        '$bisel',                   
        '$vibrador',                  
        '$antena',                     
        '$sensor_huella',             
        '$placaPrincipal',          
        '$placaInferior',              
        '$placaCompleta',              
        '$ParlanteEntero',            
        '$auricular', 

        '$modelo_id'
    )";
    mysqli_query($con, $insertarContenidos);
}
  }

 $i++;
}

?>

<a href="index.php">Atras</a>