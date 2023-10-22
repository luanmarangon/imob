<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Características do Imóveis - <?= $propertie->reference; ?></h2>
    </header>

    <section class="app_control_subs radius">
        <?php if ($features) : ?>
            <article class="radius">
                <a class="icon-plus-circle btn btn-green mostrarForm">Novo <span id="icon_new" class="icon-expand"></span></a>
            </article>
            <br>
            <div class="newForm">
                <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/details/features"); ?>" method="post">
                    <!--ACTION SPOOFING-->
                    <input type="hidden" name="action" value="create" />
                    <div class="labe">
                        <label class="label">
                            <span class="legend">*Característica do Imóvel:</span>
                            <div class="checkbox-columns">
                                <?php foreach ($features as $feature) : ?>
                                    <div class="checkbox-column_2">
                                        <label><?= $feature->feature; ?></label>
                                        <input type="checkbox" name="feature[]" value="<?= $feature->id; ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </label>
                    </div>
                    <div class="al-right">
                        <button class="btn btn-green icon-plus-square-o">Inserir Característica</button>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <h5 class="new_form_complet">Todas as características já foram cadastradas.</h5>
        <?php endif; ?>
    </section>

    <div class="dash_content_app_box">
        <?php if ($propertieFeatures) : ?>
            <section class="app_users_home">
                <?php foreach ($propertieFeatures as $features) : ?>
                    <article class="user radius">
                        <h4><?= $features->features($features->features_id)->feature; ?></h4>
                        <!-- <h5>6</h5> -->
                        <div class="info">
                            <p><b>Criado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($features->created_at)); ?></span>
                            </p>
                            <p><b>Atualizado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($features->updated_at)); ?></span>
                            </p>
                        </div>

                        <div class="actions">
                            <a href="#" class="icon-times btn btn-red" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/details/features"); ?>" data-action="delete" data-confirm="ATENÇÃO: Você tem certeza de que deseja excluir a caracteristica do Imóvel <?= $propertie->reference; ?> ?" data-features_id="<?= $features->features_id; ?>" data-properties_id="<?= $features->properties_id; ?>">Excluir</a>
                            <!-- <a class="icon-times btn btn-red" href="" title="">Excluir</a> -->
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php else : ?>
            <section class="app_control_subs radius">
                <h3></h3>
                <article class="subscriber">
                    <h5>O imóvel não possui características cadastradas. Sinta-se à vontade para adicioná-las.</h5>

                </article>
            </section>
        <?php endif; ?>
    </div>
</section>