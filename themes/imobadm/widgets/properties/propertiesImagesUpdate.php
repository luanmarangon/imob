<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Cadastro de Imagens do - <?= $properties->reference; ?> </h2>
    </header>

    <section class="app_control_subs radius">
        <div>
            <form class="app_form" action="<?= url("/admin/properties/propertiesImages/{$properties->reference}/{$imageProperties->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Nome da Imagem:</span>
                        <input type="text" name="identification" value="<?= $imageProperties->identification ?>" />
                    </label>
                    <label class="label">
                        <span class="legend">*Imagem do Imóvel:</span>
                        <input type="file" name="image" />
                    </label>
                </div>
                <div class="al-right">
                    <button class="btn btn-blue icon-plus-square-o">Atualizar Imagem</button>
                </div>
            </form>
        </div>
    </section>
</section>