<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/settings/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <section class="app_dash_home_stats">
            <article class="radius">
                <h4 class="icon-users">Categorias</h4>
                <p><b>Total:</b> <?= $category; ?></p>
            </article>

            <article class="radius">
                <h4 class="icon-home">Cobranças</h4>
                <p><b>Total:</b> <?= $charge; ?></p>
            </article>

            <article class="radius">
                <h4 class="icon-home">Cômodos</h4>
                <p><b>Total:</b> <?= $comfortable; ?></p>
            </article>
        </section>
        <br>
        <section class="app_dash_home_stats">
            <article class="radius">
                <h4 class="icon-users">Características</h4>
                <p><b>Total:</b> <?= $feature; ?></p>
            </article>

            <article class="radius">
                <h4 class="icon-home">Estruturas</h4>
                <p><b>Total:</b> <?= $structures; ?></p>
            </article>

            <article class="radius">
                <h4 class="icon-home">Tipos</h4>
                <p><b>Total:</b> <?= $types; ?></p>
            </article>
        </section>

    </div>
</section>