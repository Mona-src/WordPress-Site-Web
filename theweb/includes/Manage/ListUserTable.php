<?php

namespace TheWeb\Manage;

class ListUserTable
{
    private $limit;
    private $page;

    public function __construct($limit = 5, $page = 1)
    {
        $this->limit = is_int($limit) ? $limit : 5;
        $this->page = is_int($page) ? $page : 1;
    }

    private function get_offset()
    {
        return ($this->page - 1) * $this->limit;
    }

    private function get_users_number()
    {
        global $wpdb;
        $query = "SELECT * FROM theweb_users;";

        return sizeof($wpdb->get_results($query));
    }

    private function get_users()
    {
        global $wpdb;
        $query = "SELECT * FROM theweb_users LIMIT " . $this->limit;

        if ($this->page > 1) {
            $query .= " OFFSET " . $this->get_offset();
        }

        $query .= ";";

        return $wpdb->get_results($query);
    }

    private function change_page($newpage)
    {
        $query = $_GET;
        $query['pagenbr'] = $newpage;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($query);
    }

    private function change_limit($newlimit)
    {
        $query = $_GET;
        $query['limit'] = $newlimit;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($query);
    }

    public function change_limit_form()
    {
        $limit = $this->limit;
?>
        <div id='limit-control'>
            <p class='title'>Résutlat(s) par page</p>
            <a class='link-limit <?= $limit === 1 ? 'link-limit-active' : ''; ?>' href='<?= $this->change_limit(1) ?>'>
                1
            </a>
            <a class='link-limit <?= $limit === 5 ? 'link-limit-active' : ''; ?>' href='<?= $this->change_limit(5) ?>'>
                5
            </a>
            <a class='link-limit <?= $limit === 10 ? 'link-limit-active' : ''; ?>' href='<?= $this->change_limit(10) ?>'>
                10
            </a>
            <a class='link-limit <?= $limit === 25 ? 'link-limit-active' : ''; ?>' href='<?= $this->change_limit(25) ?>'>
                25
            </a>
            <a class='link-limit <?= $limit === 50 ? 'link-limit-active' : ''; ?>' href='<?= $this->change_limit(50) ?>'>
                50
            </a>
            <a class='link-limit <?= $limit === 100 ? 'link-limit-active' : ''; ?>' href='<?= $this->change_limit(100) ?>'>
                100
            </a>
        </div>
    <?php
    }

    public function paginate()
    {
        $current = $this->page;
        $max = ceil($this->get_users_number() / $this->limit);
        if ($current > $max) {
            $current = $max;
        }
    ?>
        <nav id='pagination'>
            <ul>
                <?php if ($current > 2) : ?>
                    <li>
                        <a class='p-item <?php $current === $max ? 'p-disabled' : ''; ?>' href='<?= $this->change_page(1) ?>'>&Lt;</a>
                    </li>
                <?php endif ?>
                <?php if ($current > 1) : ?>
                    <li>
                        <a class='p-item <?php $current === $max ? 'p-disabled' : ''; ?>' href='<?= $this->change_page($current - 1) ?>'>&lt;</a>
                    </li>
                <?php endif ?>
                <li>
                    <a class='p-item p-active' href=''><?= $current ?></a>
                </li>
                <?php if ($current < $max) : ?>
                    <li>
                        <a class='p-item <?php $current === $max ? 'p-disabled' : ''; ?>' href='<?= $this->change_page($current + 1) ?>'>&gt;</a>
                    </li>
                <?php endif ?>
                <?php if ($current < $max - 1) : ?>
                    <li>
                        <a class='p-item <?php $current === $max ? 'p-disabled' : ''; ?>' href='<?= $this->change_page($max) ?>'>&Gt;</a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    <?php
    }

    public function display()
    {
        $max = ceil($this->get_users_number() / $this->limit);
        if ($this->page > $max) {
            $this->page = $max;
        }
        $users = $this->get_users();
        $managePage = new ManageAdminPage();
    ?>
        <p class='title'>Résultat(s)</p>
        <table id='table-user-list-head'>
            <thead>
                <tr class="">
                    <th class="c1">ID</th>
                    <th class="c2">Nom</th>
                    <th class="c3">Mail</th>
                    <th class="c4">Modification</th>
                    <th class="c5">Suppression</th>
                </tr>
            </thead>
        </table>
        <table id='table-user-list-body'>
            <tbody>
                <?php
                foreach ($users as $user) :
                ?>
                    <tr class="">
                        <td class="c1"><?= $user->id ?></td>
                        <td class="c2"><?= $user->name ?></td>
                        <td class="c3"><?= $user->email ?></td>
                        <td class="c4 c-button"><a href='<?= $managePage->change_admin_page('theweb_update', $user->id) ?>' class="btn btn-info">Modifier</a></td>
                        <td class="c5 c-button">
                            <form method='POST'>
                                <input type='hidden' name='user_id' value='<?= $user->id ?>' />
                                <input type='submit' class="btn btn-danger" name='submit_user_delete' value='Supprimer' />
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
<?php
    }
}
