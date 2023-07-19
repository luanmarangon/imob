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
            </section>


            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Imóveis: <?= $countLeads ? $countLeads : 0; ?></h3>
                <?php if ($lastLeads) : ?>
                <?php foreach ($lastLeads as $last) : ?>
                <article class="subscriber">
                    <h5><a href="<?= url("admin/leads/leads/{$last->name()[0]}/1") ?>"><?= $last->full_name; ?></a>
                    </h5>
                    <p class="mask-phone"><?= $last->phone; ?></p>
                    <p><?= date_fmt($last->created_at, "d/m/y \à\s H\hi"); ?></p>
                </article>
                <?php endforeach; ?>
                <?php else : ?>
                <article class="subscriber">
                    <h5>Desculpe, não há novos leads cadastrados neste mês. Por favor, verifique novamente mais tarde ou
                        aguarde que novos leads sejam gerados automaticamente quando os usuários preencherem os
                        formulários de cadastro.</h5>
                </article>
                <?php endif; ?>
            </section>
        </div>
    </div>
</section>