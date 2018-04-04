<?php
$_POST['a'];
switch($_POST['a']){
    case "Login":
    login();
    break;
    case"Logout":
    logout();
    break;
}

function login(){
    session_start();
    $pass = md5($_POST['p']);
    include('conexiondb.class.php');
    $conexion = new conexiondb();
    $query = "SELECT * FROM `usuarios` WHERE `username` = '" . $_POST['u'] . "';";
    $result = $conexion->query($query);
    while ($row = $result->fetch_assoc()) {
         $Passw = $row['password'];
         $admin = $row['admin'];
    }
    if($Passw === $pass){
        //Contraseña correcta
        echo $admin;
        $_SESSION['Login'] = 1;
        if($admin == 1){
            $_SESSION['admin'] = TRUE;
        }else{
            $_SESSION['admin'] = FALSE;
        }
        header("Location: ../dashboard.php");
    }else{
        //Contraseña incorrecta
       header("Location: ../index.html");
    }
    $conexion->desconectar();
}
function logout(){
    session_start();
    echo 'DEW';
    session_destroy();
    header("Location: ../index.html");
}
?>