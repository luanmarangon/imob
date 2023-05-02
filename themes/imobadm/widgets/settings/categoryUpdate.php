<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/settings/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share"><?= $category->category; ?></h2>

    </header>
    <section class="app_control_subs radius">
        <div class="">
            <form class="app_form" action="<?= url("/admin/settings/categoryUpdate/{$category->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <label class="label">
                    <span class="legend">*Categoria do Imóvel:</span>
                    <input type="text" name="category" value="<?= $category->category; ?>" required />
                </label>
                <div class="al-right">
                    <!-- <button class="btn btn-green icon-check-square-o">Atualizar</button> -->
                    <?php if ($category->status != "Inativo") : ?>
                        <a href="#" class="btn btn-red icon-warning" data-post="<?= url("/admin/settings/categoryUpdate/{$category->id}"); ?>" data-action="delete" data-confirm="ATENÇÃO: Tem certeza que deseja Inativar o <?= $category->category; ?>?" data-user_id="<?= $category->id; ?>">Inativar</a>
                        <button class="btn btn-blue icon-check-square-o">Atualizar</button>
                    <?php else : ?>
                        <a href="#" class="btn btn-green icon-warning" data-post="<?= url("/admin/settings/categoryUpdate/{$category->id}"); ?>" data-action="ativar" data-confirm="ATENÇÃO: Tem certeza que deseja ativar o <?= $category->category; ?>!" data-user_id="<?= $category->id; ?>">Ativar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
</section>