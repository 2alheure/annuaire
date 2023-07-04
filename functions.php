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
