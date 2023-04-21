<div class="dash_content_sidebar">
    <h3 class="icon-television">Dashboard <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Tenha insights poderosos para escalar seus resultados...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"dash.php?app={$href}\">{$title}</a>";
        };

        echo $nav("laptop", "dash/home", "Dash");
        ?>
    </nav>
</div>