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
                    <p><b>Total:</b> <?= sprintf('%02d', $people); ?></p>
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
            <h3 class="icon-bar-chart">Online agora:
                <span class="app_dash_home_trafic_count"><?= $onlineCount; ?></span>
            </h3>

            <div class="app_dash_home_trafic_list">
                <?php if (!$online) : ?>
                    <div class="message info icon-info">
                        Não existem usuários online navegando no site neste momento. Quando tiver, você
                        poderá monitoriar todos por aqui.
                    </div>
                <?php else : ?>
                    <?php foreach ($online as $onlineNow) : ?>
                        <article>
                            <h4>[<?= date_fmt($onlineNow->created_at, "H\hm"); ?> - <?= date_fmt(
                                                                                        $onlineNow->updated_at,
                                                                                        "H\hm"
                                                                                    ); ?>]
                                <?= ($onlineNow->user ? $onlineNow->user()->fullName() : "Visitante"); ?></h4>
                            <p><?= $onlineNow->pages; ?> páginas vistas</p>
                            <p class="radius icon-link"><a target="_blank" href="<?= url("/{$onlineNow->url}"); ?>"><b><?= strtolower(CONF_SITE_NAME); ?></b><?= $onlineNow->url; ?>
                                </a></p>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</section>

<?php $v->start("scripts"); ?>
<script>
    $(function() {
        setInterval(function() {
            $.post('<?= url("/admin/dash/home"); ?>', {
                refresh: true
            }, function(response) {
                // count
                if (response.count) {
                    $(".app_dash_home_trafic_count").text(response.count);
                } else {
                    $(".app_dash_home_trafic_count").text(0);
                }

                //list
                var list = "";
                if (response.list) {
                    $.each(response.list, function(item, data) {
                        var url = '<?= url(); ?>' + data.url;
                        var title = '<?= strtolower(CONF_SITE_NAME); ?>';

                        list += "<article>";
                        list += "<h4>[" + data.dates + "] " + data.user + "</h4>";
                        list += "<p>" + data.pages + " páginas vistas</p>";
                        list += "<p class='radius icon-link'>";
                        list += "<a target='_blank' href='" + url + "'><b>" + title +
                            "</b>" + data.url + "</a>";
                        list += "</p>";
                        list += "</article>";
                    });
                } else {
                    list = "<div class=\"message info icon-info\">\n" +
                        "Não existem usuários online navegando no site neste momento. Quando tiver, você\n" +
                        "poderá monitoriar todos por aqui.\n" +
                        "</div>";
                }

                $(".app_dash_home_trafic_list").html(list);
            }, "json");
        }, 1000 * 10);
    });
</script>
<?php $v->end(); ?>