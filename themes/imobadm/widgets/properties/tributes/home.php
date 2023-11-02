<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/tributes/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash <?= $propertie->reference; ?>

        </h2>
    </header>

    <div class="dash_content_app_box">
        <?php if ($tributes) : ?>
            <?php foreach ($tributes as $tribute) : ?>
                <section class="app_control_plans">
                    <article class="radius">
                        <div>
                            <h4 class="icon-home"><?= $tribute->findTribute($tribute->charges_id)->charge; ?> do exercício de <?= $tribute->exercise; ?> </h4>
                            <p><b>Valor:</b> R$ <span class="mask-money"><?= $tribute->value; ?></span></p>
                            <!-- </div>

                        <div>
                            <br> -->
                            <p><b>Cadastro:</b> <span class="mask-date"><?= date("d/m/Y", strtotime($tribute->created_at)); ?></span></p>
                            <p><b>Atualização:</b> <span class="mask-date"><?= date("d/m/Y", strtotime($tribute->updated_at)); ?></span></p>

                        </div>

                        <div class="actions">
                            <a class="icon-pencil btn btn-blue" href="<?= url("/admin/properties/properties/{$propertie->reference}/tributes/tributes-create/{$tribute->id}"); ?>" data-transaction_id="<?= $tribute->id; ?>" title="">Editar</a>

                            <!-- <a class="icon-pencil btn btn-blue" href="<?php url("/admin/properties/properties/{$propertie->reference}/tribute/tribute-create"); ?>" title="">Editar</a> -->

                        </div>
                    </article>
                <?php endforeach; ?>
                <!-- <?= $paginator; ?> -->
                </section>
            <?php else : ?>
                <section class="app_control_plans">
                    <article class="radius">
                        <h1>Até o momento, não existem tributos cadastrados para este imóvel.</h1>
                    </article>
                </section>
            <?php endif; ?>
    </div>
</section>