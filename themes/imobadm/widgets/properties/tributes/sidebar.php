<div class="dash_content_sidebar">
    <h3 class="icon-home">Imóveis\Detalhes <a href="<?= url("/admin/properties/properties"); ?>"><span class=" icon-reply"></span></a>
    </h3>
    <p class="dash_content_sidebar_desc">Cômodos, características e estruturas do seu imóvel? Está tudo aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("laptop", "properties/properties/{$propertie->reference}/tributes/home", "Dashboard");
        echo $nav("plus-circle", "properties/properties/{$propertie->reference}/tributes/tributes-create", "Novo Tributo");
        ?>
    </nav>
</div>