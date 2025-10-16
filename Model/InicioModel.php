<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/RepoMN/Model/UtilesModel.php';

    function CrearCuentaModel($identificacion,$nombre,$correoElectronico,$contrasenna)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL CrearCuenta('$identificacion', '$nombre', '$correoElectronico', '$contrasenna')";
            $resultado = $context -> query($sentencia);

            CloseConnection($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return false;
        }
    }

    function ValidarCuentaModel($correoElectronico,$contrasenna)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ValidarCuenta('$correoElectronico', '$contrasenna')";
            $resultado = $context -> query($sentencia);

            CloseConnection($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return null;
        }
    }    

    function ValidarCorreoModel($correoElectronico)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ValidarCorreo('$correoElectronico')";
            $resultado = $context -> query($sentencia);

            //CloseConnection($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return null;
        }
    }

    function ActualizarContrasennaModel($ConsecutivoUsuario, $ContrasennaGenerada)
    {
        try
        {
            $context = OpenConnection();

            $sentencia = "CALL ActualizarContrasenna('$ConsecutivoUsuario', '$ContrasennaGenerada')";
            $resultado = $context -> query($sentencia);

            CloseConnection($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            SaveError($error);
            return false;
        }
    }

?>