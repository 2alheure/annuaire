<?php

include_once 'functions.php';
session_start();

if (!is_connected()) {
    error401();
}

if (empty($_GET['id'])) {
    error404();
}

$bdd = connect_to_db();
$contact = $bdd
    ->query("DELETE FROM contact WHERE id = {$_GET['id']} AND user_id = {$_SESSION['id']}");

redirect('list.php');
