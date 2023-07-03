<?php
session_start();

if (!empty($_POST) || !empty($_FILES)) {

    // Dans le cas où on a l'identifiant
    if (!empty($_POST['login'])) {
        $_SESSION['pseudo'] = $_POST['login'];
    }

    // Dans le cas où on a un nouveau mot de passe
    if (
        !empty($_POST['password'])
        && $_POST['confirm'] === $_POST['password']
    ) {
        $_SESSION['mdp'] = $_POST['password'];
    }

    // Dans le cas où on a une nouvelle image de profil
    if (
        !empty($_FILES['avatar']) // Il nous a envoyé un fichier
        && $_FILES['avatar']['size'] < 5_000_000 // Plus petit que 5Mo
        && substr($_FILES['avatar']['type'], 0, 5) === 'image' // C'est bien une image
        && $_FILES['avatar']['error'] === 0 // Pas d'erreur pendant l'upload
    ) {
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $nouveau_nom = uniqid() . '.' . $extension;
        $destination = __DIR__ . '/' . $nouveau_nom;

        move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);

        $_SESSION['image'] = $nouveau_nom;
    }
}

include 'header.php'; ?>

<form action="" method="post" class="flex flex-col md:w-1/2 w-full border-2 mt-8 shadow-xl rounded-lg mx-auto p-8" enctype="multipart/form-data">
    <label for="login">Nouvel identifiant</label>
    <input type="text" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="login" id="login" placeholder="Nouvel identifiant" value="<?= $_SESSION['pseudo'] ?>">

    <label for="password">Nouveau mot de passe</label>
    <input type="password" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="password" id="password" placeholder="Nouveau mot de passe">

    <label for="confirm">Confirmation du nouveau mot de passe</label>
    <input type="password" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="confirm" id="confirm" placeholder="Confirmation du nouveau mot de passe">

    <div class="flex gap-8">
        <img src="<?= $_SESSION['image'] ?>" alt="" class="w-20 h-20 object-cover">
        <div class="flex flex-col grow">
            <label for="avatar">Nouvelle image de profil</label>
            <input type="file" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2" name="avatar" id="avatar" placeholder="Nouvelle image de profil" accept="image/*">
            <small class="text-gray-500 mb-8">Une image, de 5Mo maximum.</small>
        </div>
    </div>

    <input type="submit" value="Modifier votre profil" class="cursor-pointer rounded bg-gray-800 text-white hover:bg-gray-600 w-1/2 p-2 mx-auto">
</form>

<?php include 'footer.php'; ?>