<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/Imóveis</h3>
    <p class="dash_content_sidebar_desc">Planos, assinaturas e gestão do CaféControl? Está tudo aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($getApp) {
            $active = ($getApp == $href ? "active" : null);
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"dash.php?app={$href}\">{$title}</a>";
        };

        echo $nav("laptop", "reports/home", "Dashboard");
        // echo $nav("files-o", "reports/relImoveis", "Relatórios Imóveis");

        ?>
    </nav>
</div>