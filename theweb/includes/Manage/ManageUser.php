<?php

namespace TheWeb\Manage;

class ManageUser
{
    public function check_email_format($email)
    {
        if ($email === '') {
            return 'Ce champ ne peut pas être vide.';
        } else if (preg_match('/.{2,}[@]{1}.{2,}[\.]{1}.{2,}/', $email) !== 1) {
            return "Ce format d'email n'est pas correct.";
        }
        return true;
    }

    public function check_email_unique($email)
    {
        global $wpdb;
        $query = "SELECT * FROM theweb_users WHERE email = '$email'";
        $result = $wpdb->get_results($query);
        if (empty($result)) {
            return true;
        }
        return 'Cet email est déjà pris.';
    }

    public function add_user($name, $email)
    {
        if ($this->check_email_format($email)) {
            global $wpdb;
            $wpdb->insert(
                'theweb_users',
                array(
                    'email' => $email,
                    'name' => $name
                )
            );
            if ($wpdb->insert_id > 0) {
                return true;
            }
            return false;
        }
    }

    public function update_user($newname, $newemail, $oldmail)
    {
        global $wpdb;
        $data = [
            'name' => $newname,
            'email' => $newemail
        ];
        $where = [
            'email' => $oldmail
        ];
        $update = $wpdb->update(
            'theweb_users',
            $data,
            $where
        );
        if ($update > 0) {
            return true;
        }
        return false;
    }

    public function get_user($id)
    {
        global $wpdb;
        $query = "SELECT * FROM theweb_users WHERE id = $id;";
        $user = $wpdb->get_results($query);
        return $user;
    }

    public function get_users()
    {
        global $wpdb;
        $query = "SELECT email FROM theweb_users;";
        $users = $wpdb->get_results($query);
        return $users;
    }

    public function delete_user($id)
    {
        $userToDelete = $this->get_user($id);
        if (empty($userToDelete)) {
            return "L'utilisateur n'existe pas.";
        }
        $where = [
            'id' => $id
        ];
        global $wpdb;
        $delete = $wpdb->delete(
            'theweb_users',
            $where
        );

        if ($delete > 0) {
            return true;
        }

        return "Une erreur est survenue, veuillez réessayer ultérieurement.";
    }
}
