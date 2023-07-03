<?php

session_start();
session_destroy();

include 'functions.php';
redirect('index.php');