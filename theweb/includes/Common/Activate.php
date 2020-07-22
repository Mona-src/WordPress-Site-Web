<?php

/**
 * @package theweb_plugin
 */

namespace TheWeb\Common;

class Activate
{
    public static function activate()
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("
            CREATE TABLE IF NOT EXISTS theweb_users (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) UNIQUE NOT NULL,
                name VARCHAR(255) NOT NULL
            );"));
        $wpdb->query($wpdb->prepare("
            CREATE TABLE IF NOT EXISTS theweb_quizs (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) UNIQUE NOT NULL
            );"));
        $wpdb->query($wpdb->prepare("
            CREATE TABLE IF NOT EXISTS theweb_user_questions (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user_id INT UNSIGNED NOT NULL,
                question VARCHAR(255) NOT NULL,
                FOREIGN KEY (user_id) REFERENCES theweb_users(id) ON DELETE CASCADE
            );"));
        $wpdb->query($wpdb->prepare("
            CREATE TABLE IF NOT EXISTS theweb_quiz_question (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                quiz_id INT UNSIGNED NOT NULL,
                question VARCHAR(255) NOT NULL,
                FOREIGN KEY (quiz_id) REFERENCES theweb_quizs(id) ON DELETE CASCADE
            );"));
        $wpdb->query($wpdb->prepare("
            CREATE TABLE IF NOT EXISTS theweb_quiz_question_answer (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                quiz_id INT UNSIGNED NOT NULL,
                question_id INT UNSIGNED NOT NULL,
                user_id INT UNSIGNED NOT NULL,
                answer VARCHAR(255) NOT NULL,
                FOREIGN KEY (quiz_id) REFERENCES theweb_quizs(id) ON DELETE CASCADE,
                FOREIGN KEY (question_id) REFERENCES theweb_quiz_question(id) ON DELETE CASCADE,
                FOREIGN KEY (user_id) REFERENCES theweb_users(id) ON DELETE CASCADE
            );"));
        flush_rewrite_rules();
    }
}
