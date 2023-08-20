<div class="dash_content_sidebar">
    <h3 class="icon-television">Customer Success <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Tenha insights poderosos para escalar seus resultados...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "cs/home", "Home");
        echo $nav("laptop", "cs/contato", "Suporte ao Cliente");
        ?>
    </nav>
</div>