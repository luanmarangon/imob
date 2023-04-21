<div class="dash_content_sidebar">
    <h3 class="icon-home">Imóveis\Trasação <a href="javascript:history.back()"><span class=" icon-reply"></span></a>
    </h3>
    <p class="dash_content_sidebar_desc">Tudo sobre as transações do seu imóvel, bem aqui.... </p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("money", "properties/properties/{$propertie->reference}/transactions/transactions", "Transação");
        echo $nav("plus-circle", "properties/transactions/transactions-create", "Novo Imóvel");


        ?>
    </nav>
</div>