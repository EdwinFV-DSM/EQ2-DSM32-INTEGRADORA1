<?php

session_start();
$pagina = 0;
$video = 0;
require_once '../includes/header.php';
require_once '../config/ConexionDB.php';
if(isset($_SESSION['login']) == 1){
    // echo $_SESSION['login'];
}else{
    header('Location: login.php');
}
?>

<section class="profile">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">

        </div>
    </div>
</section>

<?php include_once '../includes/footer.php'; ?>