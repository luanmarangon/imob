<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Estruturas do Imóveis - <?= $propertie->reference; ?></h2>
    </header>

    <section class="app_control_subs radius">
        <?php if ($structures) : ?>

            <article class="radius">
                <a class="icon-plus-circle btn btn-green mostrarForm">Novo <span id="icon_new" class="icon-expand"></span></a>
            </article>
            <br>
            <div class="newForm">
                <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/details/structures"); ?>" method="post">
                    <!--ACTION SPOOFING-->
                    <input type="hidden" name="action" value="create" />
                    <div class="label_g2">
                        <label class="label">
                            <span class="legend">*Estrutura do Imóvel:</span>
                            <select name="structure" required>
                                <option value=""></option>
                                <?php foreach ($structures as $structure) : ?>
                                    <option value="<?= $structure->id; ?>"><?= $structure->structure; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="label ">
                            <span class="legend">*Metragem:</span>
                            <input class="structure" type="text" name="footage" placeholder="Metragem" required />
                        </label>
                    </div>
                    <div class="al-right">
                        <button class="btn btn-green icon-plus-square-o">Inserir Estrutura</button>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <h5 class="new_form_complet">Todas as estruturas já foram cadastradas.</h5>
        <?php endif; ?>
    </section>

    <div class="dash_content_app_box">
        <?php if ($propertieStructures) : ?>
            <section class="app_users_home">
                <?php foreach ($propertieStructures as $structures) : ?>
                    <article class="user radius">
                        <h4><?= $structures->structures($structures->structures_id)->structure; ?></h4>
                        <h5><?= $structures->footage; ?></h5>

                        <div class="info">
                            <p><b>Criado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($structures->created_at)); ?></span>
                            </p>
                            <p><b>Atualizado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($structures->updated_at)); ?></span>
                            </p>
                        </div>

                        <div class="actions">
                            <!-- <a class="icon-pencil btn btn-blue" href="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create/{$transaction->id}"); ?>" title="">Editar</a> -->
                            <a href="#" class="icon-times btn btn-red" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/details/structures"); ?>" data-action="delete" data-confirm="ATENÇÃO: Você tem certeza de que deseja excluir a estrutura do Imóvel <?= $propertie->reference; ?> ?" data-structures_id="<?= $structures->structures_id; ?>" data-properties_id="<?= $structures->properties_id; ?>">Excluir</a>

                            <!-- <a class="icon-cog btn btn-red" href="<?php url("/admin/properties/properties/{$propertie->reference}/details/structures/{$propertie->id}"); ?>" title="">Excluir</a> -->
                            <!-- <a class="icon-cog btn btn-blue" href="#" id="icon_new" title="">Editar</a> -->
                            <a href="<?= url("/admin/properties/properties/{$propertie->reference}/details/structuresUpdate/{$structures->id}"); ?>" class="icon-cog btn btn-blue">Editar</a>


                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php else : ?>
            <section class="app_control_subs radius">
                <h3></h3>
                <article class="subscriber">
                    <h5>O imóvel não possui estruturas cadastradas. Sinta-se à vontade para adicioná-las.</h5>
                </article>
            </section>
        <?php endif; ?>

    </div>
</section>