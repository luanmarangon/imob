<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/people/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-user-plus">Clientes</h2>
        <form action="<?= url("/admin/people/people"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
        <!-- <a class="icon-plus-circle btn btn-green" href="dash.php?app=imoveis/proprietarios-create">Novo Proprietário</a> -->
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php foreach ($people as $person) : ?>
            <article class="radius">
                <div>
                    <h4 class="icon-user"><?= $person->fullName(); ?></h4>
                    <!-- <?= var_dump($peopleContacts); ?></p> -->
                    <?php foreach ($peopleContacts as $contacts) : ?>
                    <?php if ($contacts->owners_id === $person->id) : ?>
                    <p><b><?= $contacts->contact()->type; ?>:</b> <?= $contacts->contact()->contact; ?></p>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>
                <div class="actions">
                    <a class="icon-check btn btn-default" href="" title="">10</a>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-phone btn btn-green" href="<?= url("admin/people/people/{$person->id}/contacts"); ?>"
                        title="">Contatos</a>
                    <!-- <a class="icon-phone btn btn-green" href="dash.php?app=owners/contacts" title="">Contatos</a> -->
                    <a class="icon-ban btn btn-yellow" href="" title="">Desativar</a>
                </div>
            </article>
            <?php endforeach; ?>

            <?= $paginator; ?>
        </section>
    </div>
</section>