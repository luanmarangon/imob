<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/clients/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-star-o">Clientes</h2>
        <form action="" class="app_search_form">
            <input type="text" name="s" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
        <!-- <a class="icon-plus-circle btn btn-green" href="dash.php?app=imoveis/proprietarios-create">Novo Proprietário</a> -->
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php foreach ($clients as $client) : ?>
            <article class="radius">
                <div>
                    <h4 class="icon-user"><?= $client->fullName(); ?></h4>
                    <p><b>R.G.:</b> <span class="mask-rg"><?= $client->rg; ?></span></p>
                    <p><b>C.P.F.:</b> <span class="mask-cpf"><?= $client->cpf; ?></span></p>
                    <?php foreach ($clientsContacts as $contacts) : ?>
                    <?php if ($contacts->clients_id === $client->id) : ?>
                    <p><b><?= $contacts->contact()->type; ?>:</b> <?= $contacts->contact()->contact; ?></p>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div>
                    <p><b>Status:</b> <a class="icon-check btn btn-green" href="#">Ativo</a></p>
                </div>
                <div class="actions">
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-pencil btn btn-default" href="dash.php?app=clients/contracts/home"
                        title="">Contratos</a>
                    <a class="icon-phone btn btn-green"
                        href="<?= url("admin/clients/client/{$client->id}/contacts"); ?>" title="">Contatos</a>
                    <a class="icon-ban btn btn-yellow" href="" title="">Desativar</a>
                </div>
            </article>
            <?php endforeach; ?>
            <?= $paginator; ?>
        </section>
    </div>
</section>