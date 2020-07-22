<?php

namespace TheWeb\Manage;

class Emails
{
    public function send_to_registered()
    {
        $manageUser = new ManageUser();
        $users = $manageUser->get_users();

        foreach ($users as $user) {
            $to = $user->email;
            $subject = "Soirée Halloween";
            $message = "Merci d'avoir participé à cette soirée, n'hésite pas à nous envoyer une photo !";
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
            $headers[] = 'From: Me Myself';
            // var_dump($to, $headers);
            $sent = wp_mail($to, $message, $subject, $headers);
            // var_dump($sent);
            header("Location: " . admin_url() . "admin.php?page=theweb_plugin");
        }
    }
}
