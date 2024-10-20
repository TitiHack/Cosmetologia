
<?php
//incluimos la conexion a la base de datos 
include("../Conexion/conexion.php");


//Recibimos las variables enviadas
$txtdocu_prov = (isset($_POST['txtdocu_prov'])) ? $_POST['txtdocu_prov'] : "";
$txtnombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre'] : "";
$txtapellido = (isset($_POST['txtapellido'])) ? $_POST['txtapellido'] : "";
$txtemail = (isset($_POST['txtemail'])) ? $_POST['txtemail'] : "";
$txtcelular = (isset($_POST['txtcelular'])) ? $_POST['txtcelular'] : "";
$txtcontraseña = (isset($_POST['txtcontraseña'])) ? $_POST['txtcontraseña'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";



switch ($accion) {
    case 'Agregar':

               
                $agregrarProveedor = $conn->prepare("INSERT INTO proveedor (nombre, apellido, celular, email, contraseña, docu_prov)
                VALUES (?, ?, ?, ?, ?, ?)");

               // Verifica si se preparó la consulta correctamente
               if ($agregrarProveedor === false) {
                   die('Error al preparar la consulta: ' . $conn->error);
               }

              // Vincula los parámetros a la consulta
               $agregrarProveedor->bind_param("ssssss", $txtnombre, $txtapellido, $txtcelular, $txtemail, $txtcontraseña, $txtdocu_prov);

               // Ejecuta la consulta
               $agregrarProveedor->execute();

               // Verifica si hubo errores durante la ejecución
               if ($agregrarProveedor->error) {
                   die('Error al ejecutar la consulta: ' . $agregrarProveedor->error);
               }

               // Cierra la declaración
               $agregrarProveedor->close();

               header('location: index.php');
           
               break;

    case 'Modificar':

        $editarProveedor = $conn->prepare(" UPDATE proveedor SET docu_prov = '$txtdocu_prov', nombre = '$txtnombre', apellido = '$txtapellido', celular = '$txtcelular', direccion = '$txtdireccion', email  = '$txtemail'
        WHERE id_vendedor = '$txtcontraseña' ");

        
        $editarProveedor->execute();
        $conn->close();

        header('location: index.php');

        break;

    case 'Eliminar':
        

        $eliminarProveedor = $conn->prepare(" DELETE FROM proveedor
        WHERE docu_prov = '$txtdocu_prov' ");

        $eliminarProveedor->execute();
        $conn->close();
        header('location: index.php');

       
        break;

    case 'Cancelar':
        header('location: index.php');
        break;

    default:
        # code...
        break;
}


/* Consultamos todos los empleados  */
$consultaProveedor = $conn->prepare("SELECT * FROM proveedor");
$consultaProveedor->execute();
$listaProveedor = $consultaProveedor->get_result();
$conn->close();
