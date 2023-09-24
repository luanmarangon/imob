<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/cs/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Central de Comunicações</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-users">Contatos Lidos"</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $readContactCount); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-home">Contatos Lidos dos Últimos 30 Dias</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $readContact); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-banknote">"Contatos Não Lidos"</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $unreadContactCount); ?></p>
                </article>

                <article class="radius">
                    <h4 class="icon-banknote">Contatos Pendentes dos Últimos 30 Dias</h4>
                    <p><b>Total:</b> <?= sprintf('%02d', $unreadContact); ?></p>
                </article>
            </section>
        </div>




        <section class="app_dash_home_trafic">
            <h3 class="icon-bar-chart">Ultimas Mensagens:
            </h3>

            <div class="app_dash_home_trafic_list">
                <?php if (!$contact) : ?>
                    <div class="message info icon-info">
                        Não existe nenhuma mensagem nova. Quando tiver, você poderá monitoriar todos por aqui.
                    </div>
                <?php else : ?>
                    <?php foreach ($contact as $cs) : ?>
                        <article>
                            <h4>[<?= date_fmt($cs->created_at, "d-m-Y H\hm"); ?>] <a href="<?= url("admin/cs/resposta/{$cs->id}"); ?>"><strong><?= $cs->name;  ?></strong></a></h4>
                            <h4><?= $cs->email; ?> | <?= $cs->phone; ?></h4>

                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</section>

<?php $v->start("scripts"); ?>
<!-- <script>
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
</script> -->
<?php $v->end(); ?>