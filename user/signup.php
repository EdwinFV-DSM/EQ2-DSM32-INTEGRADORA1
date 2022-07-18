<?php 
    if (session_start()) {
    
    }else{
        session_start();
    }
    if(isset($_SESSION['login']) == 1){
        //echo $_SESSION['login'];
        header('Location: panel.php');
    }
    $pagina_admin = 0;
    $pagina_modificacion = 0;
    $pagina = 0;
    $video = 0;
    require_once '../includes/header.php';
?>



<?php require_once '../includes/footer.php'; ?>