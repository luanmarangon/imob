<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/owners/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_subs radius">
                <article class="radius">
                    <h3 class="icon-user">Total Proprietários</h3>
                    <h3><?= sprintf('%02d', $owners); ?></h3>
                </article>

            </section>


            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Proprietários: {Ultimos}</h3>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <article class="subscriber">
                        <h5>22.10.18 22h - Jessica Fernanda Vieira Marangon</h5>
                        <p>(18) 99748-2397</p>
                        <p>Martinópolis-SP</p>
                    </article>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</section>