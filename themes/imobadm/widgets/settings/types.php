<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/settings/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">TIpos de Imóveis</h2>
        <form action="<?= url("/admin/settings/types"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <section class="app_control_subs radius">
        <!-- <article class="radius">
            <a class="icon-plus-circle btn btn-green" href="dash.php?app=configuracoes/type-create">Novo Tipo</a>
        </article> -->

        <article class="radius">
            <a class="icon-plus-circle btn btn-green mostrarForm">Novo Tipo <span id="icon_new" class="icon-expand"></span></a>
        </article>
        <br>
        <div class="newForm">
            <form class="app_form" action="" method="post">
                <label class="label">
                    <span class="legend">*Tipo de Imóvel:</span>
                    <input type="text" name="title" placeholder="O nome do tipo de Imóvel" required />
                </label>
                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Criar Tipo</button>
                </div>
            </form>>
            </form>
        </div>
    </section>

    <div class="dash_content_app_box">
        <section class="app_users_home">
            <?php foreach ($types as $type) : ?>
                <article class="user radius">
                    <h4><?= $type->type; ?></h4>
                    <div class="info">
                        <p><b>Criado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($type->created_at)); ?></span>
                        </p>
                        <p><b>Atualizado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($type->updated_at)); ?>;
                                ?></span></p>
                    </div>

                    <div class="actions">
                        <a class="icon-cog btn btn-blue" href="" title="">Gerenciar</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
        <?= $paginator; ?>
    </div>
</section>