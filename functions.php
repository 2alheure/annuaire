<?php

function is_connected(): bool {
    return !empty($_SESSION);
}

function redirect(string $destination) {
    header('location: ' . $destination);
    exit;
}

function connect_to_db(): PDO {
    return new PDO('mysql:host=localhost;dbname=annuaire;port=3306', 'root', '');
}

function error401() {
    include_once '401.php';
    exit;
}
