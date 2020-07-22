<?php
/* Template Name: Page Login */
if (isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Web \ Inscription - Connexion</title>
    <?php wp_head() ?>
</head>

<body>
    <main id='login-container'>
        <?php if (!empty($_SESSION['global_error'])) : ?>
            <?php foreach ($_SESSION['global_error'] as $error) : ?>
                <span class='alert alert-danger'>
                    <?= $error ?>
                </span>
            <?php endforeach ?>
        <?php endif ?>
        <h1 id='login-title'><?= the_title() ?></h1>
        <br />
        <div class='center-form'>
            <form method='POST' action='<?= admin_url('admin-post.php') ?>' class='form-login'>
                <label for='email'>Inscription \ Email</label>
                <input type='email' id='email' name='email' />
                <br />
                <label for='name'>Inscription \ Nom</label>
                <input type='text' id='name' name='name' />
                <input type='hidden' name='action' value='register' />
                <input type='submit' name='submit_register' value='Inscription' />
            </form>
        </div>
        <div class='center-form'>
            <form method='POST' action='<?= admin_url('admin-post.php') ?>' class=' form-login'>
                <label for='email'>Connexion \ Email</label>
                <input type='email' id='email' name='email' />
                <input type='hidden' name='action' value='login' />
                <input type='submit' name='submit_login' value='Connexion' />
            </form>
        </div>
    </main>
</body>

</html>

<?php

unset($_SESSION['global_error']);
