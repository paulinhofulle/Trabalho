<?php
    session_start();
 
    include "bibliotecas/parametros.php";
    include "bibliotecas/conexao.php";
    include LAYOUTS.'header.php';
 
    if (!isset($_SESSION['login'])) {
        include "login.php";
    }
    if (isset($_SESSION['login'])) {
        include LAYOUTS.'menu.php';
 
        if (!isset($_GET['pagina']))
            include LAYOUTS.'home.php';
        else
            include CADASTROS.$_GET['modulo'].'/'.$_GET['pagina'].'.php';
   
        include LAYOUTS.'footer.php';
    }
    if (isset($_POST['desconectar'])) {
        session_destroy();
        header('Location: index.php');
    }
