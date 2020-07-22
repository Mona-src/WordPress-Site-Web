<?php

?>

<head>
    <title>Envoyer des mails</title>
</head>

<body>
    <main class='container'>
        <div class='row'>
            <div class='col s12'>
                <h1>Envoyer des mails</h1>
                <form method='POST' action='<?= admin_url('admin-post.php') ?>'>
                    <input type='hidden' name='action' value='photos_form' />
                    <input type='submit' value='Envoyer' />
                </form>
            </div>
        </div>
    </main>
</body>

</html>