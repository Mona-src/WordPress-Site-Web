<?php

if (!isset($_SESSION)) {
    session_start();
}


$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
$page = isset($_GET['pagenbr']) ? intval($_GET['pagenbr']) : 1;

$userList = new \TheWeb\Manage\ListUserTable($limit, $page);

if (isset($_POST['user_id'])) {
    $manageUser = new \TheWeb\Manage\ManageUser();
    if (gettype($manageUser->delete_user($_POST['user_id'])) !== 'string') {
        $_SESSION['success'] = "L'utilisateur a bien été supprimé.";
    }
    $_SESSION['global_error']['error'] = $manageUser->delete_user($_POST['user_id']);
}

?>

<head>
    <title>The Web | Liste des utilisateurs</title>
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
                <h1>Liste des utilisateurs</h1>
                <?php $userList->change_limit_form() ?>
                <?php $userList->display() ?>
                <?php $userList->paginate() ?>
            </div>
        </div>
    </main>
</body>

</html>

<?php

unset($_SESSION['global_error']);
unset($_SESSION['success']);
