<!DOCTYPE html>
<html>
    <head>
        <title>Práctico final</title>
        <style>
            .datos {
                background-color: #006658;
                color: yellow;
            }
            .datos::placeholder {
                color: yellow;
            }
            h1 {
                font-size: 16px;
            }
            form {
                border: black solid 1px;
                border-radius: 10px;
                padding: 20px;
                width: 300px;
                margin: 20px auto;
            }
            .box {
                border: black solid 1px;
                border-radius: 10px;
                padding: 15px;
                width: 300px;
                margin: 20px auto;
            }
        </style>
    </head>
    <body>

        <form method="post" action="index.php">
            <h1>Datos de inicio de sesión</h1>
            <input type="text" class="datos" name="nombre" placeholder="Ingresa tu nombre"><br><br>
            <input type="text" class="datos" name="apellido" placeholder="Ingresa tu apellido"><br><br>
            <input type="date" class="datos" name="fecha"><br><br>
            <input type="email" class="datos" name="email" placeholder="Ingresa tu email"><br><br>
            <input type="password" class="datos" name="clave" placeholder="Ingresa tu contraseña"><br><br>
            <input type="submit" class="datos" value="Enviar">
        </form>

        <?php
            const EDAD_MINIMA = 18;
            function formatoNombre($nom, $ape) {
                return $nom . " " . $ape;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') { //con esto comprueba que haya cargado por el envío de formulario y no por la URL directo, osea para que no intente guardar datos vacíos ni bien entra en la página 
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $fecha = $_POST['fecha'];
                $email = $_POST['email'];
                $clave = $_POST['clave'];
                $conexion = mysqli_connect("localhost", "root", "", "velazquez_thiago");

                if (!$conexion) {
                    echo "Error en la conexión";
                } else {
                    $sql = "INSERT INTO usuarios (nombre, apellido, email, clave, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$email', '$clave', '$fecha')";
                    $resultado = mysqli_query($conexion, $sql);
                    echo "<div class='box'>";
                    if ($resultado) { // verifico si la consulta SQL se ejecutó correctamente en MySQL, osea con esto y el else de mas abajo evito que salga una confirmación falsa 
                        echo "Usuario guardado en la base de datos<br><br>";
                        $completo = formatoNombre($nombre, $apellido);
                        echo "Nombre completo: " . $completo . "<br>";
                        echo "Email: " . $email . "<br>";
                        echo "Edad mínima requerida: " . EDAD_MINIMA . "<br><br>";
                        $resumen = [$nombre, $apellido, $email];
                        echo "Datos enviados:<br>";
                        foreach ($resumen as $dato) { // verifico que no esten vacías las casillas del array
                            if (!empty($dato)) {
                                echo "- " . $dato . "<br>";
                            }
                        }
                    } else {
                        echo "Error al registrar el usuario";
                    }
                    echo "</div>";

                    mysqli_close($conexion);
                }
            }
        ?>
        <div class="box">
            <h3>Consulta GET de prueba</h3>
            <a href="index.php?curso=PHP y MySQL inicial&unidad=Final&estado=Finalizando">Enviar datos por GET</a>
            <?php
                if (isset($_GET['curso']) && isset($_GET['unidad']) && isset($_GET['estado'])) { // creo que esta sería la mejor forma para validar la URL, había hecho unas versiones con if else anidadas o switch case antes de esta version del if con && pero eran muy enredadas y creo que esta es la mejor forma y además queda limpio
                    $curso = $_GET['curso'];
                    $unidad = $_GET['unidad'];
                    $estado = $_GET['estado'];
                    echo "<br><br>";
                    echo "Curso: " . $curso . "<br>";
                    echo "Unidad: " . $unidad . "<br>";
                    echo "Estado: " . $estado . "<br>";
                    if ($estado == "Finalizando") {
                        echo "Estado del curso: OK";
                    } else {
                        echo "Estado de la cursada: En proceso";
                    }
                }
            ?>
        </div>
    </body>
</html>