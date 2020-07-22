<?php

if (!isset($_SESSION)) {
    session_start();
}

$manageUser = new TheWeb\Manage\ManageUser();

$userId = isset($_GET['userid']) ? $_GET['userid'] : '';
if ($userId !== '') {
    $userToUpdate = $manageUser->get_user(intval($userId));
    if (empty($userToUpdate)) {
        $_SESSION['error']['user_unknown'] = "Cet utilisateur n'existe pas";
    }
}

if (isset($_POST['submit_update_user'])) {
    $userAdd = new \TheWeb\Manage\ManageUser();

    $oldEmail = $_POST['old_email'];
    $name = $_POST['new_name'];
    $email = $_POST['new_email'];

    if ($name === '') {
        $_SESSION['error']['new_name'] = "Ce champ ne peut pas être vide.";
    }

    if (gettype($userAdd->check_email_unique($oldEmail)) !== 'string') {
        $_SESSION['error']['old_email'] = "Cet email n'est pas assigné.";
    }

    if (gettype($userAdd->check_email_format($email)) === 'string') {
        $_SESSION['error']['new_email'] = $userAdd->check_email_format($email);
    }

    if (empty($_SESSION['error'])) {
        if (empty($_SESSION))

            $update = $manageUser->update_user($name, $email, $oldEmail);
        if (!$update) {
            $_SESSION['global_error']['error'] = 'Une erreur est survenue, veuillez réessayer ultérieurement.';
        }
        $_SESSION['success'] = "L'utilisateur a bien été modifié.";
    }
}
?>

<head>
    <title>The Web | Modifier un utilisateur</title>
</head>

<body>
    <main class='container'>
        <?php if (!empty($_SESSION['global_error'])) : ?>
            <span class='alert alert-danger'>
                <?php foreach ($_SESSION['global_error'] as $error) : ?>
                    <?= $error ?>
                <?php endforeach ?>
            </span>
        <?php endif ?>
        <?php if (isset($_SESSION['success'])) : ?>
            <span class='alert alert-success'>
                <?= $_SESSION['success'] ?>
            </span>
        <?php endif ?>
        <div class='row'>
            <div class='col s12'>
                <h1>Modifier un utilisateur</h1>
                <form method='POST' id='create-user-form'>
                    <label for='old_email'>Ancien mail</label>
                    <input type='text' id='old_email' name='old_email' class='<?php isset($_SESSION['error']['old_email']) ? 'input-error' : ''; ?>' value='<?= isset($userToUpdate[0]) ? $userToUpdate[0]->email : $_POST['old_email']; ?>' />
                    <?php if (isset($_SESSION['error']['old_email'])) : ?>
                        <p class='form-error'><?= $_SESSION['error']['old_email'] ?></p>
                    <?php endif ?>
                    <label for='new_name'>Nouveau nom</label>
                    <input type='text' id='new_name' name='new_name' class='<?php isset($_SESSION['error']['new_name']) ? 'input-error' : ''; ?>' value='<?= isset($userToUpdate[0]) ? $userToUpdate[0]->name : $_POST['new_name']; ?>' />
                    <?php if (isset($_SESSION['error']['new_name'])) : ?>
                        <p class='form-error'><?= $_SESSION['error']['new_name'] ?></p>
                    <?php endif ?>
                    <label for='new_email'>Nouveau mail</label>
                    <input type='new_email' id='new_email' name='new_email' class='<?php isset($_SESSION['error']['new_email']) ? 'input-error' : ''; ?>' value='<?= $_POST['new_email'] ?>' />
                    <?php if (isset($_SESSION['error']['new_email'])) : ?>
                        <p class='form-error'><?= $_SESSION['error']['new_email'] ?></p>
                    <?php endif ?>
                    <br />
                    <input type='submit' name='submit_update_user' value="Modifier l'utilisateur" />
                </form>
            </div>
        </div>
    </main>
</body>

</html>

<?php

unset($_SESSION['error']);
unset($_SESSION['global_error']);
unset($_SESSION['success']);
