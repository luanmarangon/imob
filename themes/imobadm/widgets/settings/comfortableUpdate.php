<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/settings/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share"><?= $comfortable->convenient; ?></h2>

    </header>
    <section class="app_control_subs radius">
        <div class="">
            <form class="app_form" action="<?= url("/admin/settings/comfortableUpdate/{$comfortable->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <label class="label">
                    <span class="legend">*Cômodos do Imóvel:</span>
                    <input type="text" name="convenient" value="<?= $comfortable->convenient; ?>" required />
                </label>
                <div class="al-right">
                    <!-- <button class="btn btn-green icon-check-square-o">Atualizar</button> -->
                    <?php if ($comfortable->status != "Inativo") : ?>
                        <a href="#" class="btn btn-red icon-warning" data-post="<?= url("/admin/settings/comfortableUpdate/{$comfortable->id}"); ?>" data-action="delete" data-confirm="ATENÇÃO: Tem certeza que deseja Inativar o <?= $comfortable->convenient; ?>?" data-user_id="<?= $comfortable->id; ?>">Inativar</a>
                        <button class="btn btn-blue icon-check-square-o">Atualizar</button>
                    <?php else : ?>
                        <a href="#" class="btn btn-green icon-warning" data-post="<?= url("/admin/settings/comfortableUpdate/{$comfortable->id}"); ?>" data-action="ativar" data-confirm="ATENÇÃO: Tem certeza que deseja ativar o <?= $comfortable->convenient; ?>!" data-user_id="<?= $comfortable->id; ?>">Ativar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
</section>