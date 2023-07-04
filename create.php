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
            INSERT INTO contact 
            VALUE (
                NULL,
                '{$_POST['prenom']}',
                '{$_POST['nom']}',
                '{$_POST['adresse']}',
                '{$_POST['tel']}',
                '{$_POST['email']}',
                '{$_POST['description']}',
                '{$_POST['anniv']}',
                {$_SESSION['id']}
            )
        ");

        redirect('list.php');
    }
}
include_once 'header.php';
?>

<?php if (!empty($error)) : ?>
    <p class="text-red-700 text-bold text-center mx-auto md:w-1/2 w-full p-4 mt-8 rounded bg-red-100">Vous vous êtes trompé en saisissant le formulaire (<?= $error ?>). Veuillez réessayer.</p>
<?php endif; ?>

<form action="" method="post" class="flex flex-col md:w-1/2 w-full border-2 mt-8 shadow-xl rounded-lg mx-auto p-8">
    <label for="prenom">Prénom</label>
    <input type="text" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="prenom" id="prenom" placeholder="Prénom">

    <label for="nom">Nom</label>
    <input type="text" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="nom" id="nom" placeholder="Nom">

    <label for="email">Email</label>
    <input type="email" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="email" id="email" placeholder="Email">

    <label for="tel">N° téléphone</label>
    <input type="tel" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="tel" id="tel" placeholder="N° téléphone">

    <label for="anniv">Date d'anniversaire</label>
    <input type="date" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="anniv" id="anniv" placeholder="Date d'anniversaire">

    <label for="adresse">Adresse</label>
    <textarea class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="adresse" id="adresse" placeholder="Adresse"></textarea>

    <label for="description">Description</label>
    <textarea class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="description" id="description" placeholder="Description"></textarea>

    <input type="submit" value="Se connecter" class="cursor-pointer rounded bg-gray-800 text-white hover:bg-gray-600 w-1/2 p-2 mx-auto">
</form>


<?php include_once 'footer.php'; ?>