<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Características do Imóveis - <?= $propertie->reference; ?></h2>
        <!-- <form action="" class="app_search_form">
            <input type="text" name="s" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form> -->
    </header>

    <section class="app_control_subs radius">
        <article class="radius">
            <a class="icon-plus-circle btn btn-green mostrarForm">Novo <span id="icon_new"
                    class="icon-expand"></span></a>
        </article>
        <br>
        <div class="newForm">
        <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/details/features"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Característica do Imóvel:</span>
                        <!-- <select name="feature" required>
                            <option value=""></option>
                            <?php foreach ($features as $feature) : ?>
                                <option value="<?= $feature->id; ?>"><?= $feature->feature; ?></option>
                            <?php endforeach; ?>
                        </select> -->
                        <div class="checkbox-columns">
                            <?php foreach ($features as $feature) : ?>
                                <div class="checkbox-column">
                                    <label><?= $feature->feature; ?></label>
                                    <input type="checkbox" name="feature" value="<?= $feature->id; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </label>
                    <!-- <label class="label">
                        <span class="legend">*Quantidade no Imóvel:</span>
                        <input type="text" name="quantityFeature" placeholder="A Quantidade da Característica" required />
                    </label> -->
                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-plus-square-o">Inserir Característica</button>
                </div>
            </form>
        </div>
    </section>

    <div class="dash_content_app_box">
        <section class="app_users_home">
            <?php foreach ($propertieFeatures as $features) : ?>
            <article class="user radius">
                <h4><?= $features->features($features->features_id)->feature; ?></h4>
                <h5>6</h5>
                <div class="info">
                    <p><b>Criado:</b> <span
                            class="mask-datetime"><?= date("d-m-Y H:i", strtotime($features->created_at)); ?></span>
                    </p>
                    <p><b>Atualizado:</b> <span
                            class="mask-datetime"><?= date("d-m-Y H:i", strtotime($features->updated_at)); ?></span>
                    </p>
                </div>

                <div class="actions">
                    <a class="icon-cog btn btn-blue" href="" title="">Gerenciar</a>
                </div>
            </article>
            <?php endforeach; ?>

            <!-- <nav class="paginator">
                <a class="paginator_item" title="Primeira página" href="">&lt;&lt;</a>
                <span class="paginator_item paginator_active">1</span>
                <a class="paginator_item" title="Página 2" href="">2</a>
                <a class="paginator_item" title="Página 3" href="">3</a>
                <a class="paginator_item" title="Página 4" href="">4</a>
                <a class="paginator_item" title="Última página" href="">&gt;&gt;</a>
            </nav> -->
        </section>
    </div>
</section>