<?php

include_once 'functions.php';
session_start();

if (!is_connected()) {
    error401();
}

$bdd = connect_to_db();
$resultat = $bdd->query('SELECT * FROM contact WHERE user_id = ' . $_SESSION['id']);
$contacts = $resultat->fetchAll(PDO::FETCH_OBJ);

include_once 'header.php';
?>

<p class="mt-8 text-center">
    <a href="create.php" class="bg-green-500 text-white py-1 px-4 rounded text-2xl">
        <i class="fa fa-plus mr-2" aria-hidden="true"></i> Nouveau contact
    </a>
</p>

<div class="grid grid-cols-3 md:grid-cols-2 sm-grid-cols-1 gap-8 mt-8 text-2xl">
    <?php foreach ($contacts as $c) : ?>
        <div class="border p-8">
            <h2><?= $c->prenom . ' ' . mb_strtoupper($c->nom) ?></h2>
            <p class="flex gap-8 mt-4">
                <a href="details.php?id=<?= $c->id ?>" class="bg-blue-500 text-white py-1 px-4 rounded"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="update.php?id=<?= $c->id ?>" class="bg-yellow-500 text-white py-1 px-4 rounded"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="delete.php?id=<?= $c->id ?>" class="bg-red-500 text-white py-1 px-4 rounded"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </p>
        </div>
    <?php endforeach; ?>
</div>

<?php include_once 'footer.php'; ?>