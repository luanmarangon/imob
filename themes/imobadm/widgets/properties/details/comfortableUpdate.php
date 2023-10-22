<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Cômodos do Imóveis - <?= $propertie->reference; ?> </h2>
    </header>

    <section class="app_control_subs radius">
        <?php if ($propertieComfortable) : ?>
            <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/details/comfortableUpdate/{$propertieComfortable->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Cômodo do Imóvel:</span>
                        <input type="text" name="comfortable" placeholder="Cômodo" value="<?= $propertieComfortable->comfortable($propertieComfortable->comfortable_id)->convenient; ?>" disabled />


                    </label>
                    <label class="label">
                        <span class="legend">*Quantidade</span>
                        <input type="text" name="quantity" placeholder="Cômodo" required value="<?= $propertieComfortable->quantity; ?>" />
                    </label>
                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-plus-square-o">Inserir Cômodo</button>
                </div>
            </form>
        <?php else : ?>

            <h1>Teste</h1>

        <?php endif; ?>


    </section>


</section>