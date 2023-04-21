<div class="dash_content_sidebar">
    <h3 class="icon-users">Proprietários <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Gerencie, monitore e acompanhe os proprietários do seu sistema aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "owners/home", "Dashboard");
        echo $nav("users", "owners/owners", "Proprietarios");
        echo $nav("plus-circle", "owners/owners-create", "Novo Proprietário");
        ?>
    </nav>
</div>