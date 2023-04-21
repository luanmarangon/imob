<div class="dash_content_sidebar">
    <h3 class="icon-user">Usuários <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Gerencie, monitore e acompanhe os usuários do seu site aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("user", "users/home", "Usuários");
        echo $nav("plus-circle", "users/user", "Novo usuário");
        ?>
    </nav>
</div>