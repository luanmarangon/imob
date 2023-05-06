<div class="dash_content_sidebar">
    <h3 class="icon-users">Clientes <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Gerencie, monitore e acompanhe os clientes do seu sistema aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "people/home", "Dashboard");
        echo $nav("users", "people/people", "Clientes");
        echo $nav("plus-circle", "people/people-create", "Novo Cliente");
        ?>
    </nav>
</div>