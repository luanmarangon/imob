<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-file-o">Contratos </h4>
                    <p>244</p>
                </article>

                <!-- <article class="radius">
                    <h4 class="icon-home">Convertidos</h4>
                    <p>200</p>
                </article>

                <article class="radius">
                    <h4 class="icon-calendar-check-o">Ativos</h4>
                    <p>15</p>
                </article>

                <article class="radius">
                    <h4 class="icon-retweet">Este mês</h4>
                    <p>5</p>
                </article> -->
            </section>


            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Contratos: {Ultimos}</h3>
                <?php for ($i = 0; $i < 6; $i++) : ?>
                    <article class="subscriber">
                        <h5>Cliente A</h5>
                        <p>(99) 99723-2369</p>
                        <p><?= date("d/m/Y H\hi"); ?></p>
                    </article>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</section>