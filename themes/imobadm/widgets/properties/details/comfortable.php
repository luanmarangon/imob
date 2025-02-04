<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Cômodos de Imóveis - <?= $propertie->reference; ?> </h2>
    </header>

    <section class="app_control_subs radius">
        <?php if ($comfortable) : ?>
            <article class="radius">
                <a class="icon-plus-circle btn btn-green mostrarForm">Novo <span id="icon_new" class="icon-expand"></span></a>
            </article>
            <br>
            <div class="newForm">
                <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/details/comfortable"); ?>" method="post">
                    <!--ACTION SPOOFING-->
                    <input type="hidden" name="action" value="create" />
                    <div class="label_g2">
                        <label class="label">
                            <span class="legend">*Cômodo do Imóvel:</span>
                            <select name="comfortable" required>
                                <option value=""></option>
                                <?php foreach ($comfortable as $convenient) : ?>
                                    <option value="<?= $convenient->id; ?>"><?= $convenient->convenient; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="label">
                            <span class="legend">*Quantidade do Cômodo:</span>
                            <input type="text" name="quantityComfortable" placeholder="A Quantidade do cômodo" required />
                        </label>
                    </div>
                    <div class="al-right">
                        <button class="btn btn-green icon-plus-square-o">Inserir Cômodo</button>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <h5 class="new_form_complet">Todas os cômodos já foram cadastradas.</h5>
        <?php endif; ?>
    </section>
    <div class="dash_content_app_box">
        <?php if ($propertieComfortable) : ?>
            <section class="app_users_home">
                <?php foreach ($propertieComfortable as $comfortable) : ?>
                    <article class="user radius">
                        <h4><?= $comfortable->comfortable($comfortable->comfortable_id)->convenient; ?></h4>
                        <h5><?= $comfortable->quantity; ?></h5>
                        <input type="text" name="quantityComfortable" placeholder="A Quantidade do cômodo" id="teste" class="ds-none" />

                        <div class="info">
                            <p><b>Criado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($comfortable->created_at)); ?></span>
                            </p>
                            <p><b>Atualizado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($comfortable->updated_at)); ?></span>
                            </p>
                        </div>
                        <!-- <?php var_dump($comfortable->id); ?> -->
                        <div class="actions">
                            <a href="#" class="icon-times btn btn-red" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/details/comfortable"); ?>" data-action="delete" data-confirm="ATENÇÃO: Você tem certeza de que deseja excluir o cômodo do Imóvel <?= $propertie->reference; ?> ?" data-comfortable_id="<?= $comfortable->comfortable_id; ?>" data-properties_id="<?= $comfortable->properties_id; ?>">Excluir</a>
                            <a href="<?= url("/admin/properties/properties/{$propertie->reference}/details/comfortableUpdate/{$comfortable->id}"); ?>" class="icon-cog btn btn-blue">Editar</a>

                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php else : ?>
            <section class="app_control_subs radius">
                <h3></h3>
                <article class="subscriber">
                    <h5>O imóvel não possui cômodos cadastradas. Sinta-se à vontade para adicioná-las.</h5>
                </article>
            </section>
        <?php endif; ?>
    </div>
</section>