<?php

session_start();
session_destroy();

setcookie('remember', '', -1); // On supprime le cookie

include_once 'functions.php';
redirect('index.php');