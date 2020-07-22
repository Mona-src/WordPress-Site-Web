<?php
if (!isset($_SESSION['user'])) {
    wp_safe_redirect('index.php/inscription-connexion');
}

if (isset($_POST['submit_question'])) {
    global $wpdb;
    $question = $_POST['ask_question'];
    if ($question !== "") {
        $user_id = $_SESSION['user'][0]->id;
        $data = [
            "user_id" => $user_id,
            "question" => $question
        ];
        $insert = $wpdb->insert(
            "theweb_user_questions",
            $data
        );
        wp_safe_redirect('index.php/reponses');
    }
}

if (isset($_POST['quiz'])) {
    wp_safe_redirect('index.php/quiz');
}
?>

<!DOCTYPE html>
<html lang='fr'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <?php wp_head() ?>
</head>

<body>
    <main class='container' id='main-container'>
        <div class='row'>
            <div class='col s12' id='header-admin'>
                <nav id='admin-nav'>
                    <a href='/wordpress' class='nav-link'>Accueil</a>
                    <?php if (current_user_can('administrator')) : ?>
                        <a href='/wordpress/index.php/creer' class='nav-link'>Créer un quiz</a>
                    <?php endif ?>
                    <a href='<?= admin_url('admin-post.php?action=disconnect') ?>' class='nav-link'>
                        Déconnexion
                    </a>
                </nav>
            </div>