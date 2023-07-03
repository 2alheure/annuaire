<?php
include 'functions.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    !is_connected()
    && !empty($_COOKIE['remember'])
    && $_COOKIE['remember'] === 'toto'
) {
    // On n'est pas connecté mais on a le cookie remember
    // Donc on connecte d'office l'utilisateur

    include 'user.php';
    $_SESSION['pseudo'] = $user['login'];
    $_SESSION['image'] = $user['avatar'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon super site</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto">

        <!-- Menu -->
        <nav class="flex p-4 gap-8 items-center bg-gray-800 text-white">

            <a href="index.php" class="hover:underline">Accueil</a>

            <?php if (is_connected()) : ?>
                <a href="logout.php" class="hover:underline">Se déconnecter</a>
                <a href="profil.php" class="hover:underline flex gap-2 items-center ml-auto">
                    <img src="<?= $_SESSION['image'] ?>" alt="" class="bg-gray-500 w-10 h-10 object-cover rounded-full">
                    <?= $_SESSION['pseudo'] ?>
                </a>
            <?php else : ?>
                <a href="login.php" class="hover:underline">Se connecter</a>
            <?php endif; ?>


        </nav>