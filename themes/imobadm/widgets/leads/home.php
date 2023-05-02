<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/leads/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-home">Total </h4>
                    <p><?= $leads; ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-home">Convertidos</h4>
                    <p><?= $countClients; ?></p>
                </article>
                <!-- 
                <article class="radius">
                    <h4 class="icon-home">Convertidos</h4>
                    <p><?= $countClients; ?></p>
                </article> -->

                <!-- 
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
                <h3 class="icon-heartbeat">Imóveis: <?= $countLeads; ?></h3>
                <?php foreach ($lastLeads as $last) : ?>
                <article class="subscriber">
                    <h5><?= $last->full_name; ?></h5>
                    <p class="mask-phone"><?= $last->phone; ?></p>
                    <p><?= date_fmt($last->created_at, "d/m/y \à\s H\hi"); ?></p>
                </article>
                <?php endforeach; ?>
            </section>
        </div>
    </div>
</section>