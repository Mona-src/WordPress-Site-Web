<?php

/**
 * @package theweb_plugin
 */

namespace TheWeb\Common;

class Uninstall
{
    public function uninstall()
    {
        global $wpdb;

        $wpdb->prepare($wpdb->query("DROP TABLE IF EXISTS theweb_quiz_question_answer, theweb_quiz_question, theweb_quizs, theweb_users;"));
    }
}
