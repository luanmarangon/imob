<div class="dash_content_sidebar">
    <h3 class="icon-files-o">Clientes\Contratos <a href="javascript:history.back()"><span class=" icon-reply"></span></a>
    </h3>
    <p class="dash_content_sidebar_desc">Aqui você gerencia todos os clientes e leads do IMOB-Admin...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($getApp) {
            $active = ($getApp == $href ? "active" : null);
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"dash.php?app={$href}\">{$title}</a>";
        };

        echo $nav("laptop", "clients/home", "Dashboard");
        echo $nav("users", "clients/contracts/contracts", "Contratos");
        // echo $nav("users", "clients/leads", "Leads");
        // echo $nav("plus-circle", "clients/client-create", "Novo Cliente");
        ?>
    </nav>
</div>