<div class="dash_content_sidebar">
    <h3 class="icon-home">Imóveis <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Imoveis, transações e gestão do IMOB-Admin? Está tudo aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "properties/home", "Dashboard");
        echo $nav("home", "properties/properties", "Imóveis");
        echo $nav("plus-circle", "properties/properties-create", "Novo Imóvel");

        // echo $nav("files-o", "relatorios/home", "Relatórios");
        ?>
    </nav>
</div>