<?php

include_once 'functions.php';
session_start();

if (!is_connected()) {
    error401();
}

if (!empty($_POST)) {
    $error = false;

    if (
        !empty($_POST['tel'])
        && !preg_match('#^(0|\+33) ?[\d \-\.]{9,}$#', $_POST['tel'])
    ) $error = 'téléphone';

    if (
        !empty($_POST['email'])
        && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false
    ) $error = 'email';

    if (
        !empty($_POST['anniv'])
        && date_create_from_format('Y-m-d', $_POST['anniv']) === false
    ) $error = 'aniversaire';

    if (!$error) {
        $bdd = connect_to_db();
        $bdd->query("
            UPDATE contact SET
                prenom = '{$_POST['prenom']}',
                nom = '{$_POST['nom']}',
                adresse = '{$_POST['adresse']}',
                tel = '{$_POST['tel']}',
                email = '{$_POST['email']}',
                description = '{$_POST['description']}',
                anniversaire = '{$_POST['anniv']}'
                WHERE id = {$_GET['id']} AND user_id = {$_SESSION['id']}
        ");

        // redirect('list.php');
    }
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

<?php if (!empty($error)) : ?>
    <p class="text-red-700 text-bold text-center mx-auto md:w-1/2 w-full p-4 mt-8 rounded bg-red-100">Vous vous êtes trompé en saisissant le formulaire (<?= $error ?>). Veuillez réessayer.</p>
<?php endif; ?>

<form action="" method="post" class="flex flex-col md:w-1/2 w-full border-2 mt-8 shadow-xl rounded-lg mx-auto p-8">
    <label for="prenom">Prénom</label>
    <input type="text" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="prenom" id="prenom" placeholder="Prénom" value="<?= $_POST['prenom'] ?? $contact->prenom ?? null ?>">

    <label for="nom">Nom</label>
    <input type="text" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="nom" id="nom" placeholder="Nom" value="<?= $_POST['nom'] ?? $contact->nom ?? null ?>">

    <label for="email">Email</label>
    <input type="email" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="email" id="email" placeholder="Email" value="<?= $_POST['email'] ?? $contact->email ?? null ?>">

    <label for="tel">N° téléphone</label>
    <input type="tel" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="tel" id="tel" placeholder="N° téléphone" value="<?= $_POST['tel'] ?? $contact->tel ?? null ?>">

    <label for="anniv">Date d'anniversaire</label>
    <input type="date" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="anniv" id="anniv" placeholder="Date d'anniversaire" value="<?= $_POST['anniv'] ?? $contact->anniversaire ?? null ?>">

    <label for="adresse">Adresse</label>
    <textarea class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="adresse" id="adresse" placeholder="Adresse"><?= $_POST['adresse'] ?? $contact->adresse ?? null ?></textarea>

    <label for="description">Description</label>
    <textarea class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="description" id="description" placeholder="Description"><?= $_POST['description'] ?? $contact->description ?? null ?></textarea>

    <input type="submit" value="Modifier" class="cursor-pointer rounded bg-gray-800 text-white hover:bg-gray-600 w-1/2 p-2 mx-auto">
</form>


<?php include_once 'footer.php'; ?>