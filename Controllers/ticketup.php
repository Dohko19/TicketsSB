<?php
require ('../Config/db.php');

//Creamos las variables necesarias
$motivo = $_POST['motivo'];
$comentarios = $_POST['comentarios'];
$otromotivo = $_POST['otromotivo'];
//$foto1 = $_POST['Foto1'];
switch ($motivo){
    case 0:
        $motivo = 'Otro Motivo';
        $otromotivo = $otromotivo;
        break;
    case 1:
        $motivo = 'Solicitud 4+1';
        break;
    case 2:
        $motivo = 'Compra Jabonera(rota, robo, vandalismo)';
        break;
    case 3:
        $motivo = 'Cambio por uso común';
        break;
    case 4:
        $motivo = 'Envio de Etiquetas y ayudas visuales';
        break;
    case 5:
        $motivo = 'Contenedor para Solucion Sanitizante';
        break;
    case 6:
        $motivo = 'Guia de envio de contenedores';
        break;
    case 7:
        $motivo = 'Tapa oscilante para contenedor';
        break;
    case 8:
        $motivo = 'Guias de envio de tapas';
        break;
    case 9:
        $motivo = 'LGS bimestral';
        break;
    case 10: $motivo = 'Solicitud de portagalones';
        break;
    default:
        echo "No Eligio Opción";
}
//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");

$motivo = str_replace($caracteres_malos, $caracteres_buenos, $motivo);
$comentarios = str_replace($caracteres_malos, $caracteres_buenos, $comentarios);

//Comprobamos que los inputs no estén vacíos, y si lo están, mandamos el mensaje correspondiente
if(empty($motivo)) {
    die( 'Es necesario establecer un Motivo' );
} elseif(empty($comentarios)) {
    die( 'Es necesario tu comentario' );
    //"Error 4" en los array de $_FILES significa que ningún archivo fue subido o incluido en el input
    //Más info en http://php.net/manual/es/features.file-upload.errors.php
} elseif($_FILES['Foto1']['error'] === 4) {
    die( 'Es necesario subir al menos una imagen' );
    //Si los inputs están seteados y el archivo no tiene errores, se procede
} else if(isset($motivo) AND isset($comentarios) AND $_FILES['Foto1']['error'] === 0 ) {
    //Otras comprobaciones

    //Convertimos la información de la imagen en binario para insertarla en la BBDD
    $imagenBinaria = addslashes(file_get_contents($_FILES['Foto1']['tmp_name']));

    //Nombre del archivo
    $nombreArchivo = $_FILES['Foto1']['name'];

    //Extensiones permitidas
    $extensiones = array('jpg', 'jpeg', 'gif', 'png', 'bmp');

    //Obtenemos la extensión (en minúsculas) para poder comparar
    //Obtenemos la extensión (en minúsculas) para poder comparar
    $array = explode('.', $nombreArchivo);
    $extension = strtolower(end($array));

    //Verificamos que sea una extensión permitida, si no lo es mostramos un mensaje de error
    if(!in_array($extension, $extensiones))
    {
        die( 'Sólo se permiten archivos con las siguientes extensiones: '.implode(', ', $extensiones) );
    }
    else
     {
        //Si la extensión es correcta, procedemos a comprobar el tamaño del archivo subido
        //Y definimos el máximo que se puede subir
        //Por defecto el máximo es de 2 MB, pero se puede aumentar desde el .htaccess o en la directiva 'upload_max_filesize' en el php.ini

        $tamañoArchivo = $_FILES['Foto1']['size']; //Obtenemos el tamaño del archivo en Bytes
        $tamañoArchivoKB = round(intval(strval( $tamañoArchivo / 1024 ))); //Pasamos el tamaño del archivo a KB

        $tamañoMaximoKB = "5120"; //Tamaño máximo expresado en KB
        $tamañoMaximoBytes = $tamañoMaximoKB * 1024; // -> 2097152 Bytes -> 2 MB

        //Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
        if($tamañoArchivo > $tamañoMaximoBytes) {
            die( "El archivo ".$nombreArchivo." es demasiado grande. El tamaño máximo del archivo es de ".$tamañoMaximoKB."Kb." );
    }
         //Si el tamaño es correcto, subimos los datos
         $anio = date("Y");
         $mes = date("m");
         if($otromotivo == null)
         {
             $consulta = "INSERT INTO tickets_web (Motivo, Comentarios, Foto1) VALUES ('$motivo', '$comentarios', '$imagenBinaria')";
         }
         else{
             $consulta = "INSERT INTO tickets_web (Motivo, OtroMotivo, Comentarios, Foto1) VALUES ('$motivo', '$otromotivo' ,'$comentarios', '$imagenBinaria')";

         }

         //Hacemos la inserción, y si es correcta, se procede
         if(mysqli_query($conn, $consulta)) {
             //Reiniciamos los inputs
             echo '<script>
            $("#enviartickets input,textarea").each(function(index) {
                $(this).val("");
            });
            </script>';
             //Cerramos la conexión con MySQL
             mysqli_close($conn);
             //Mostramos un mensaje
             die( "El archivo con el nombre ".$nombreArchivo." fue subido. Su peso es de ".$tamañoArchivoKB." KB." );
         } else {
             //Si hay algún error con la inserción, se muestra un mensaje
             die( "Parece que ha habido un error. Recargue la página e inténtelo nuevamente." );
         }

     }//Fin condicional tamaño archivo
}


