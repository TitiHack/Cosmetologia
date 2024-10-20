<?php
if (isset($_POST["registrarB"])) {
    // Verificar si alguno de los campos obligatorios está vacío
    if (empty($_POST["email"]) || empty($_POST["celular"]) || empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["contraseña"])) {
        echo '<div class="alert">Uno de los campos está vacío</div>';
    } else {
        $email = $_POST["email"];
        $celular = $_POST["celular"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $documento = $_POST["documento"];
        $contrasena = $_POST["contraseña"];
        $provedor = isset($_POST["check"]); // Asumimos que "check" indica proveedor

        // Comprobación de la conexión a la base de datos
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Verificar si el cliente ya existe
        $count = "SELECT * FROM cliente WHERE docu_clie = ?";
        $consult = $conn->prepare($count);
        
        if ($consult === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $consult->bind_param("s", $documento);
        $consult->execute();
        $result = $consult->get_result();

        // Verificar si el usuario ya existe
        if ($result && $result->num_rows > 0 && !$provedor) {
            echo '<script type="text/javascript">';
            echo 'alert("El usuario ya existe");';
            echo 'window.location.href = "http://localhost/Cosmetologia2.0/views/registro.php";';
            echo '</script>';
        } if ($provedor) {
            // Verificar si el proveedor ya existe
            $count1 = "SELECT * FROM proveedor WHERE docu_prov = ?";
            $consult1 = $conn->prepare($count1);
            $consult1->bind_param("s", $documento);
            $consult1->execute();
            $result1 = $consult1->get_result();

            if ($result1 && $result1->num_rows > 0) {
                echo '<script type="text/javascript">';
                echo 'alert("El proveedor ya existe");';
                echo 'window.location.href = "http://localhost/Cosmetologia2.0/views/registro.php";';
                echo '</script>';
            } else {
                // Inserción en la tabla correspondiente
                if ($provedor) {
                    $stmt = $conn->prepare("INSERT INTO proveedor (email, celular, nombre, apellido, contraseña, docu_prov) VALUES (?, ?, ?, ?, ?, ?)");
                } else {
                    $stmt = $conn->prepare("INSERT INTO cliente (email, celular, nombre, apellido, contraseña, docu_clie) VALUES (?, ?, ?, ?, ?, ?)");
                }
                
                // Verificar si la preparación fue exitosa
                if ($stmt === false) {
                    die("Error en la preparación de la consulta: " . $conn->error);
                }

                $stmt->bind_param("ssssss", $email, $celular, $nombre, $apellido, $contrasena, $documento);
                $stmt->execute();

                // Verificar si la inserción fue exitosa
                if ($stmt->affected_rows > 0) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Registro exitoso");';
                    echo 'window.location.href = "http://localhost/Cosmetologia2.0/views/registro.php";';
                    echo '</script>';
                } else {
                    echo '<div class="alert">Error al registrar</div>';
                }
                
                // Cerrar el stmt después de usarlo
                $stmt->close();
            }

            // Cerrar la consulta del proveedor
            $consult1->close();
        }

        // Cerrar la consulta del cliente
        $consult->close();
        // Cerrar la conexión
        $conn->close();
    }
}
?>
