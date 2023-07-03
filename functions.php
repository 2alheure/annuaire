<?php

function is_connected(): bool {
    return !empty($_SESSION);
}

function redirect(string $destination) {
    header('location: ' . $destination);
    exit;
}