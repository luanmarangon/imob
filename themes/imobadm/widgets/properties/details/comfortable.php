<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Cômodos de Imóveis - <?= $propertie->reference; ?> </h2>
        <!-- <form action="" class="app_search_form">
            <input type="text" name="s" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form> -->
    </header>

    <section class="app_control_subs radius">
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
    </section>

    <div class="dash_content_app_box">
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

                    <div class="actions">
                        <!-- <a class="icon-cog btn btn-blue" title="" href="<?=  url("/admin/properties/properties/{$propertie->reference}/details/comfortable/{$comfortable->id}"); ?>">Gerenciar</a> -->
                        <a class="icon-cog btn btn-blue" title="" href="#">Gerenciar</a>
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