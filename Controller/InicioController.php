<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoMN/Model/InicioModel.php';

    if(isset($_POST["btnCrearCuenta"]))
    {
        $identificacion = $_POST["Identificacion"];
        $nombre = $_POST["Nombre"];
        $correoElectronico = $_POST["CorreoElectronico"];
        $contrasenna = $_POST["Contrasenna"];

        $resultado = CrearCuentaModel($identificacion,$nombre,$correoElectronico,$contrasenna);

        if($resultado)
        {
            header("Location: ../../View/Inicio/IniciarSesion.php");
            exit;
        }
        else
        {
            $_POST["Mensaje"] = "No se ha podido crear la cuenta solicitada";
        }
    }

    if(isset($_POST["btnIniciarSesion"]))
    {
        $correoElectronico = $_POST["CorreoElectronico"];
        $contrasenna = $_POST["Contrasenna"];

        $resultado = ValidarCuentaModel($correoElectronico, $contrasenna);

        if($resultado != null && $resultado -> num_rows > 0)
        {
            header("Location: ../../View/Inicio/Principal.php");
            exit;
        }
        else
        {
            $_POST["Mensaje"] = "No se ha podido validar la cuenta ingresada";
        }
    }

    if(isset($_POST["btnRecuperarAcceso"]))
    {
        $correoElectronico = $_POST["CorreoElectronico"];
 
        $resultado = ValidarCorreoModel($correoElectronico);

        if($resultado && $resultado -> num_rows > 0)
        {
            //Leer la información del resultado
            $datos = mysqli_fetch_array($resultado);

            //Generar contraseña aleatoria
            $ContrasennaGenerada = GenerarContrasenna();

            //Actualizar la contraseña actual
            $resultadoActualizar = ActualizarContrasennaModel($datos["ConsecutivoUsuario"], $ContrasennaGenerada);


            //Notificarle por correo la nueva contraseña

            header("Location: ../../View/Inicio/Principal.php");
            exit;
        }
        else
        {
            $_POST["Mensaje"] = "No se ha podido recuperar el acceso";
        }
    }

    function GenerarContrasenna()
    {
        $length = 8;
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ0123456789';
        $max = strlen($chars) - 1;
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $pass .= $chars[random_int(0, $max)];
        }
        return $pass;
    }

?>