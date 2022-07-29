<?php
include_once '../../config/parameters.php';
session_start();
session_destroy();


header('location: '.base_url.'user/login.php');