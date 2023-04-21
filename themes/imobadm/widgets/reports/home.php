<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatorio</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-home">Total Imóveis</h4>
                    <p>244</p>
                </article>

                <article class="radius">
                    <h4 class="icon-home">Imóveis Ativos</h4>
                    <p>33</p>
                </article>

                <article class="radius">
                    <h4 class="icon-calendar-check-o">Este mês:</h4>
                    <p>R$ 3.200,00</p>
                </article>

                <article class="radius">
                    <h4 class="icon-retweet">Recorrência:</h4>
                    <p>R$ 20.500,00</p>
                </article>
            </section>


            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Imóveis:</h3>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <article class="subscriber">
                        <h5>22.10.18 22h - Rua Alcides Ramos da Silva, 315</h5>
                        <p>Martinópolis-SP</p>
                        <p>Concluída</p>
                    </article>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</section>