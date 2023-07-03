<?php
include 'functions.php';
session_start();
?>

<!-- Menu -->
<nav class="flex justify-center p-4 gap-8 items-center bg-gray-800 text-white">

    <a href="index.php" class="hover:underline">Accueil</a>

    <?php if (is_connected()) : ?>
        <a href="logout.php" class="hover:underline">Se déconnecter</a>
        <a href="profil.php" class="hover:underline flex gap-2 items-center ml-auto">
            <img src="<?= $_SESSION['image'] ?>" alt="" class="bg-gray-500 w-10 h-10 object-contain rounded-full">
            <?= $_SESSION['pseudo'] ?>
        </a>
    <?php else : ?>
        <a href="login.php" class="hover:underline">Se connecter</a>
    <?php endif; ?>


</nav>