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
    ->query("SELECT * FROM contact WHERE id = {$_GET['id']} AND user_id = {$_SESSION['id']}")
    ->fetch(PDO::FETCH_OBJ);

if ($contact === false) {
    error404();
}

include_once 'header.php';
?>

<h1 class="mt-8 text-bold text-2xl text-center"><?= $contact->prenom . ' ' . mb_strtoupper($contact->nom) ?></h1>

<dl class="flex flex-col md:w-1/2 w-full border-2 mt-8 shadow-xl rounded-lg mx-auto p-8 text-lg">
    <dt>
        <i class="fa fa-phone mr-1" aria-hidden="true"></i> N° Téléphone
    </dt>
    <dd class="pl-8 mb-8 underline">
        <a href="tel:<?= $contact->tel ?>">
            <?= $contact->tel ?>
        </a>
    </dd>

    <dt>
        <i class="fa fa-envelope mr-1" aria-hidden="true"></i> Email
    </dt>
    <dd class="pl-8 mb-8 underline">
        <a href="mailto:<?= $contact->email ?>">
            <?= $contact->email ?>
        </a>
    </dd>

    <dt>
        <i class="fa fa-calendar mr-1" aria-hidden="true"></i> Date d'anniversaire
    </dt>
    <dd class="pl-8 mb-8">
        <?php if (!empty($contact->anniversaire)) : ?>
            Le <?= date_create_from_format('Y-m-d', $contact->anniversaire)->format('d/m') ?>
        <?php endif; ?>
    </dd>

    <dt>
        <i class="fa fa-home mr-1" aria-hidden="true"></i> Adresse
    </dt>
    <dd class="pl-8 mb-8"><?= nl2br($contact->adresse) ?></dd>

    <dt>
        <i class="fa fa-file mr-1" aria-hidden="true"></i> Description
    </dt>
    <dd class="pl-8 mb-8"><?= nl2br($contact->description) ?></dd>
</dl>


<?php
include_once 'footer.php';
