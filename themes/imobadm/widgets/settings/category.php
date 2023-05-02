<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/settings/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Categorias de Imóveis</h2>
        <form action="<?= url("/admin/settings/category"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <section class="app_control_subs radius">
        <article class="radius">
            <a class="icon-plus-circle btn btn-green mostrarForm">Nova
                Categoria <span id="icon_new" class="icon-expand"></span></a>
        </article>
        <br>
        <div class="newForm">
            <form class="app_form" action="<?= url("/admin/settings/category"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />

                <label class="label">
                    <span class="legend">*categoria do Imóvel:</span>
                    <input type="text" name="category" placeholder="O nome da categoria" required />
                </label>
                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Criar Categoria</button>
                </div>
            </form>
        </div>


    </section>

    <div class="dash_content_app_box">
        <section class="app_users_home">
            <?php foreach ($categories as $category) : ?>
                <article class="user radius">
                    <h4>
                        <?= $category->category; ?>
                        <?php if ($category->status == "Inativo") : ?>
                            <a class="inactive icon-thumbs-o-down"></a>
                        <?php else : ?>
                            <a class="active icon-thumbs-o-up "></a>
                        <?php endif; ?>
                    </h4>
                    <div class="info">
                        <p><b>Criado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($category->created_at)); ?></span></p>
                        <p><b>Atualizado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($category->updated_at)); ?></span>
                        </p>
                    </div>

                    <div class="actions">
                        <a class="icon-cog btn btn-blue" href="<?= url("/admin/settings/categoryUpdate/{$category->id}"); ?>" title="">Gerenciar</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
        <?= $paginator; ?>
    </div>
</section>