<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/leads/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-star-o">Clientes</h2>
        <form action="<?= url("/admin/leads/leads"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
        <!-- <a class="icon-plus-circle btn btn-green" href="dash.php?app=imoveis/proprietarios-create">Novo Proprietário</a> -->
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php foreach ($leads as $lead) : ?>
                <article class="radius">
                    <div>
                        <h4 class="icon-user"><?= $lead->full_name; ?></h4>
                        <p><b>Celular:</b> <span class="mask-phone"><?= $lead->phone; ?></span></p>
                        <p><b>E-mail:</b> <?= $lead->email; ?></p>
                    </div>
                    <!-- <div>
                        <p><b>Status:</b> <a class="icon-info btn btn-blue" href="#">Leads</a></p>
                    </div> -->
                    <div class="actions">
                        <?php if ($lead->status === 'Lead') : ?>
                            <a class="icon-pencil btn btn-blue" href="<?= url("admin/leads/convert/{$lead->id}") ?>" title="">Converter</a>
                            <a class="icon-ban btn btn-red" href="<?= url("admin/leads/inactive/{$lead->id}") ?>" title="">Desativar</a>
                        <?php else : ?>
                            <span class="icon-ban btn btn-dark" href="<?= url("admin/leads/inactive/{$lead->id}") ?>" title="">Lead <?= $lead->status; ?></span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
        <?= $paginator; ?>
    </div>
</section>