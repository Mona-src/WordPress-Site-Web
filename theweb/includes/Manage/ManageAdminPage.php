<?php

namespace TheWeb\Manage;

class ManageAdminPage
{
    public function change_admin_page($newpage, $user = '')
    {
        $query = $_GET;
        $query['page'] = $newpage;
        $query['userid'] = $user;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($query);
    }

    public function change_admin_get($getName, $getValue)
    {
        $query = $_GET;
        $query[$getName] = $getValue;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($query);
    }
}
