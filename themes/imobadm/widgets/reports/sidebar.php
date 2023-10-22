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

        echo $nav("laptop", "transactions/home", "Dashboard");
        echo $nav("money", "transactions/transactions", "Transação");
        echo $nav("plus-circle", "properties/properties", "Nova Transação");

        // echo $nav("files-o", "imoveis/relatorios/home", "Relatórios");

        ?>
    </nav>
</div>