<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Comodos do Imóveis - <?= $propertie->reference; ?> </h2>
    </header>

    <section class="app_control_subs radius">
        <?php if ($propertieStructures) : ?>
            <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/details/structuresUpdate/{$propertieStructures->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Estrutura do Imóvel:</span>
                        <input type="text" name="footage" placeholder="Metragem" value="<?= $propertieStructures->structures($propertieStructures->structures_id)->structure ?>" disabled />


                    </label>
                    <label class="label">
                        <span class="legend">*Metragem:</span>
                        <input type="text" name="footage" placeholder="Metragem" required value="<?= $propertieStructures->footage; ?>" />
                    </label>
                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-plus-square-o">Inserir Estrutura</button>
                </div>
            </form>
        <?php else : ?>

            <h1>Teste</h1>

        <?php endif; ?>


    </section>


</section>