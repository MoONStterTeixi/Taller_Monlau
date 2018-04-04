<?php
    include('conexiondb.class.php');
    if(isset($_GET['action'])){
        editmaterial();
    }
    switch($_POST['action']){
        case "addtype":
            addtype();
        break;
        case "deltetype":
            deltetype();
        break;
        case "addmaterial":
            addmaterial();
        break;
        case "deletematerial":
            deletematerial();
        break;
        case "editmaterial":
            editmaterial();
        break;
        case "adduser":
            adduser();
        break;
        case "getcsv":
            getcsv();
        break;
    }
    function addtype(){
        echo $_POST['addname'];
        $conexion = new conexiondb();
        $query = "INSERT INTO `tallerddbb`.`type` (`name`) VALUES ('" . $_POST['addname'] . "');";;
        $conexion->query($query);
        header("Location: ../edit_type.php");
    }
    function deltetype(){
        echo $_POST['value'];
        $conexion = new conexiondb();
        $query = "DELETE FROM `tallerddbb`.`type` WHERE  `name`='" . $_POST['value'] . "';";;
        $conexion->query($query);
        header("Location: ../edit_type.php");
    }
    function addmaterial(){
        $conexion = new conexiondb();
        $query = "INSERT INTO `tallerddbb`.`material` (`ref`, `type`, `marca`, `modelo`, `estado`, `lastupdate`) VALUES ('" . $_POST['Referencia'] . "', '" . $_POST['type'] . "', '" . $_POST['Marca'] . "', '" . $_POST['Modelo'] . "', '" . $_POST['Estado'] . "', sysdate());";
        $conexion->query($query);
        header("Location: ../dashboard.php");
    }
    function deletematerial(){
        $conexion = new conexiondb();
        $query = "DELETE FROM `tallerddbb`.`material` WHERE  `ref`='" . $_POST['value'] . "';";;
        $conexion->query($query);
        header("Location: ../material.php?type=".$_POST['type']);
    }
    function editmaterial(){
        echo $_GET['comentario'];
        $conexion = new conexiondb();
        $query = "UPDATE `tallerddbb`.`material` SET `estado`='" . $_GET['value'] . "',`lastupdate` = SYSDATE(), `comment`='" . $_GET['comentario'] . "'  WHERE  `ref`='" . $_GET['id'] . "';";
        $conexion->query($query);
        header("Location: ../material.php?type=".$_GET['type']);
    }
    function adduser(){
        $conexion = new conexiondb();
        if(!isset($_POST['admin'])){
            $_POST['admin'] = 0;
        }
        else{
            $_POST['admin'] = 1;
        }
        $passw = md5($_POST['password']);
        $query = "INSERT INTO `tallerddbb`.`usuarios` (`username`, `password`, `admin`) VALUES ('" . $_POST['username'] . "', '" . $passw . "', '" . $_POST['admin'] . "');";
        $conexion->query($query);
        header("Location: ../add_user.php");
    }
    function getcsv(){
        $Datos = 'REFERENCIA;TIPO;MARCA;MODELO;ESTADO;ULTIMA REVISION;COMENTARIO';
        $Datos .= "\r\n";
        $conexion = new conexiondb();
        header('Expires: 0');
        header('Cache-control: private');
        header('Content-Type: application/x-octet-stream'); // Archivo de Excel
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header('Content-Disposition: attachment; filename="file.csv"');
        header("Content-Transfer-Encoding: binary");
         
        $query = "SELECT * FROM `material` WHERE `type` = '" . $_POST['value'] . "';";
        $result = $conexion->query($query);
         
        while($oRow = $result->fetch_assoc()){
            $Datos .= $oRow['ref'] . ";" . $oRow['type'] . ";" . $oRow['marca'] . ";" . $oRow['modelo'] . ";" . $oRow['estado'] . ";" . $oRow['lastupdate'] . ";" . $oRow['comment'];
            $Datos .= "\r\n"; 
         
        }#end while
         
        echo $Datos;
    }
?>