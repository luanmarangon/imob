<div class="dash_content_sidebar">
    <h3 class="icon-users">Configurações <a href="javascript:history.back()"><span class=" icon-reply"></span></a></h3>
    <p class="dash_content_sidebar_desc">Gerenciamento completo do seu APP de configurações</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("", "settings/home", "Dashboard");
        echo $nav("", "settings/feature", "Características do Imóvel");
        echo $nav("", "settings/category", "Categorias do Imóvel");
        echo $nav("", "settings/comfortable", "Cômodos do Imóvel");
        echo $nav("", "settings/structures", "Estruturas do Imóvel");
        echo $nav("", "settings/charges", "Tipos de Cobranças");
        echo $nav("", "settings/types", "Tipos de Imóveis");
        ?>
    </nav>
</div>