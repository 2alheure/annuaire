<?php

if (!empty($_POST)) {
    // Le formulairee a été soumis.
    // On fait nos vérifications
    include 'user.php';

    if (
        $_POST['login'] === $user['login']
        && $_POST['password'] === $user['mdp']
    ) {
        // Notre utilisateur est correctement identifié

        include 'functions.php';
        session_start();

        $_SESSION['pseudo'] = $user['login'];
        $_SESSION['image'] = $user['avatar'];

        if (!empty($_POST['remember'])) {
            // L'utilisateur veut qu'on se souvienne de lui
            setcookie('remember', 'toto', time() + 30 * 24 * 60 * 60);
        }

        redirect('index.php');
    } else {
        // L'utilisateur a fait une erreur
        $error = true;
    }
}

include 'header.php'; ?>

<?php if (!empty($error)) : ?>
    <p class="text-red-700 text-bold text-center mx-auto md:w-1/2 w-full p-4 mt-8 rounded bg-red-100">Vous vous êtes trompé dans votre identifiant ou votre mot de passe. Veuillez réessayer.</p>
<?php endif; ?>


<form action="" method="post" class="flex flex-col md:w-1/2 w-full border-2 mt-8 shadow-xl rounded-lg mx-auto p-8">
    <label for="login">Identifiant</label>
    <input type="text" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="login" id="login" placeholder="Identifiant">

    <label for="password">Mot de passe</label>
    <input type="password" class="outline outline-gray-500 p-1 outline-1 rounded-sm mt-2 mb-8" name="password" id="password" placeholder="Mot de passe">

    <div>
        <input type="checkbox" class="p-1 outline-1 rounded-sm mt-2 mb-8" name="remember" id="remember" placeholder="Mot de passe" value="true">
        <label for="remember">Se souvenir de moi</label>
    </div>

    <input type="submit" value="Se connecter" class="cursor-pointer rounded bg-gray-800 text-white hover:bg-gray-600 w-1/2 p-2 mx-auto">
</form>

<?php include 'footer.php'; ?>