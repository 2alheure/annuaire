<?php

session_start();
session_destroy();

setcookie('remember', '', -1); // On supprime le cookie

include 'functions.php';
redirect('index.php');