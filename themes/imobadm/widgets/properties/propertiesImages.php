<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Cadastro de Imagens do - <?= $properties->reference; ?> </h2>
    </header>

    <section class="app_control_subs radius">

        <article class="radius">
            <a class="icon-plus-circle btn btn-green mostrarForm">Novo <span id="icon_new" class="icon-expand"></span></a>
        </article>
        <br>
        <div class="newForm">
            <form class="app_form" action="<?= url("/admin/properties/propertiesImages/{$properties->reference}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Nome da Imagem:</span>
                        <input type="text" name="identification" placeholder="Informe o Nome da Imagem" required />
                    </label>
                    <label class="label">
                        <span class="legend">*Imagem do Imóvel:</span>
                        <input type="file" name="image" />
                    </label>
                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-plus-square-o">Inserir Imagem</button>
                </div>
            </form>
        </div>

    </section>

    <div class="dash_content_app_box">
        <?php if ($imageProperties) : ?>
            <section class="app_users_home">
                <?php foreach ($imageProperties as $image) : ?>
                    <article class="user radius">
                        <?php
                        $propertieImages = ($image->images() ? image($image->path, 300, 300) :
                            theme("/assets/images/semImagem.png", CONF_VIEW_THEME));
                        ?>

                        <div class="image" style="background-image: url(<?= $propertieImages; ?>)"></div>
                        <h4><?= $image->identification; ?></h4>
                        <!-- <input type="text" name="quantityComfortable" placeholder="A Quantidade do cômodo" id="teste" class="ds-none" /> -->

                        <div class="info">
                            <p><b>Criado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($image->created_at)); ?></span>
                            </p>
                            <p><b>Atualizado:</b> <span class="mask-datetime"><?= date("d-m-Y H:i", strtotime($image->updated_at)); ?></span>
                            </p>
                        </div>

                        <div class="actions">
                            <a href="#" class="icon-times btn btn-red" data-post="<?= url("/admin/properties/propertiesImages/{$properties->reference}"); ?>" data-action="delete" data-confirm="ATENÇÃO: Você tem certeza de que deseja remover a imagem cadastrada no Imóvel <?= $properties->reference; ?> ?" data-images_id="<?= $image->id; ?>">Excluir</a>
                            <a href="<?= url("/admin/properties/propertiesImages/{$properties->reference}/{$image->id}"); ?>" class="icon-cog btn btn-blue">Editar</a>

                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php else : ?>
            <section class="app_control_subs radius">
                <h3></h3>
                <article class="subscriber">
                    <h5>O imóvel não possui Imagens cadastradas. Sinta-se à vontade para adicioná-las.</h5>
                </article>
            </section>
        <?php endif; ?>
    </div>

</section>