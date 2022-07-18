<?php
include_once '../../config/parameters.php';
if (session_start()) {
    
}else{
    session_start();
}
session_destroy();


header('location: '.base_url.'user/login.php');