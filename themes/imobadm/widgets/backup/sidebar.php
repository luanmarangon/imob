<div class="dash_content_sidebar">
    <h3 class="icon-user-plus">Leads <a href="javascript:history.back()"><span class=" icon-reply"></span></a>
    </h3>
    <p class="dash_content_sidebar_desc">BACKUP</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "backup/home", "Dashboard");
        // echo $nav("users", "clients/client", "Clientes");
        // echo $nav("users", "backup/list", "Backups");
        // echo $nav("plus-circle", "leads/client-create", "Novo Cliente");
        ?>
    </nav>
</div>