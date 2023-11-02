<div class="dash_content_sidebar">
    <h3 class="icon-money">Relatórios <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Transações dos Imóveis? Está tudo aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "reports/home", "Dashboard");
        echo $nav("laptop", "reports/relImoveis", "Relatórios de Imóveis");
        echo $nav("laptop", "reports/relClients", "Relatórios de Clientes");


        // echo $nav("files-o", "imoveis/relatorios/home", "Relatórios");

        ?>
    </nav>
</div>