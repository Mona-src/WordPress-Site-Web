<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submit_new_user'])) {
    $userAdd = new \TheWeb\Manage\ManageUser();

    $name = $_POST['name'];
    $email = $_POST['email'];

    $_SESSION['error'] = [];
    $_SESSION['success'] = [];

    if ($name === '') {
        $_SESSION['error']['name'] = "Ce champ ne peut pas être vide.";
    }

    if (gettype($userAdd->check_email_format($email)) === 'string') {
        $_SESSION['error']['email'] = $userAdd->check_email_format($email);
    }

    if (gettype($userAdd->check_email_unique($email)) === 'string') {
        $_SESSION['global_error']['user_exists'] = $userAdd->check_email_unique($email);
    }

    if (empty($_SESSION['error'])) {
        $add = $userAdd->add_user($name, $email);
        if (!$add) {
            $_SESSION['global_error']['error'] = 'Une erreur est survenue, veuillez réessayer ultérieurement.';
        }
        $_SESSION['success'] = "L'utilisateur a bien été ajouté.";
    }
}
?>

<head>
    <title>The Web | Ajouter un utilisateur</title>
</head>

<body>
    <main class='container'>
        <?php if (!empty($_SESSION['global_error'])) : ?>
            <?php foreach ($_SESSION['global_error'] as $error) : ?>
                <span class='alert alert-danger'>
                    <?= $error ?>
                </span>
            <?php endforeach ?>
        <?php endif ?>
        <?php if (isset($_SESSION['success'])) : ?>
            <span class='alert alert-success'>
                <?= $_SESSION['success'] ?>
            </span>
        <?php endif ?>
        <div class='row'>
            <div class='col s12'>
                <h1>Ajouter un utilisateur</h1>
                <form method='POST' id='create-user-form'>
                    <label for='name'>Nom de l'utilisateur</label>
                    <input type='text' id='name' name='name' class='<?php isset($_SESSION['error']['name']) ? 'input-error' : ''; ?>' value='<?= $_POST['name'] ?>' />
                    <?php if (isset($_SESSION['error']['name'])) : ?>
                        <p class='form-error'><?= $_SESSION['error']['name'] ?></p>
                    <?php endif ?>
                    <br />
                    <label for='email'>Mail de l'utilisateur</label>
                    <input type='email' id='email' name='email' value='<?= $_POST['email'] ?>' />
                    <?php if (isset($_SESSION['error']['email'])) : ?>
                        <p class='form-error'><?= $_SESSION['error']['email'] ?></p>
                    <?php endif ?>
                    <br />
                    <input type='submit' name='submit_new_user' value="Ajouter l'utilisateur" />
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
