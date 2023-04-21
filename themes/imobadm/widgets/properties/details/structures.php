<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Estruturas do Imóveis - <?= $propertie->reference; ?></h2>
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
            <form class="app_form" action="" method="post">
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Estrutura do Imóvel:</span>
                        <select name="status" required>
                            <option value="active">Quarto</option>
                            <option value="inactive">Banheiro</option>
                        </select>
                    </label>
                    <label class="label">
                        <span class="legend">*Metragem:</span>
                        <input type="text" name="title" placeholder="Metragem" required />
                    </label>
                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-plus-square-o">Inserir Estrutura</button>
                </div>
            </form>
        </div>
    </section>

    <div class="dash_content_app_box">
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