<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/dash/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-users">Leads</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $leads); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-home">Total de Imóveis</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $properties); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-banknote">Imóveis a Vender</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $rents); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-banknote">Imóveis a Alugar</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $sales); ?></p>
                </article>
            </section>
            <br>
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-users">Proprietários</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $owners); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-home">Total de Imóveis</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $properties); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-banknote">Imóveis a Vender</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $rents); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-banknote">Imóveis a Alugar</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $sales); ?></p>
                </article>
            </section>
        </div>




        <section class="app_dash_home_trafic">
            <h3 class="icon-bar-chart">Online agora: 10</h3>
            <?php for ($i = 0; $i < 10; $i++) : ?>
            <article>
                <h4>[20h23 - 21h01] Guest User</h4>
                <p>34 page views</p>
                <p><a target="_blank" href="">/blog/lorem-ipsum-dolor-sit-amet-dolom-lipsum</a> </p>
            </article>
            <?php endfor; ?>
        </section>
    </div>
</section>