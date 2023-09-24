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
                        <?php if ($person->status != "Inativo") : ?>
                            <h4><span class="active icon-user"></span><?= $person->fullName(); ?></h4>
                        <?php else : ?>
                            <h4><span class="inactive icon-user"></span><?= $person->fullName(); ?></h4>
                        <?php endif; ?>

                        <?php
                        $count = 0;
                        foreach ($peopleContacts as $contact) {
                            if ($contact->people_id === $person->id) {
                                $count++;
                                if ($count <= 2) {
                        ?>
                                    <p><b><?= $contact->type; ?>:</b> <?= $contact->contact; ?></p>
                        <?php
                                }
                            }
                        }
                        ?>


                    </div>
                    <div class="actions">
                        <a class="icon-check btn btn-default" href="" title="">10</a>
                        <a class="icon-pencil btn btn-blue" href="<?= url("/admin/people/people-create/{$person->id}"); ?>" title="">Editar</a>
                        <a class="icon-phone btn btn-green" href="<?= url("admin/people/people/{$person->id}/contacts"); ?>" title="">Contatos</a>
                        <!-- <a class="icon-phone btn btn-green" href="dash.php?app=owners/contacts" title="">Contatos</a> -->
                        <?php if ($person->status != "Inativo") : ?>

                            <a href="#" class="btn btn-red icon-warning" data-post="<?= url("/admin/people/people-create/{$person->id}"); ?>" data-action="delete" data-confirm="ATENÇÃO: Tem certeza que deseja excluir o cliente e todos os dados relacionados a ele? Essa ação não pode ser feita!" data-user_id="<?= $person->id; ?>"><span class="icon-ban"></span></a>
                        <?php else : ?>
                            <a href="#" class="btn btn-green icon-warning" data-post="<?= url("/admin/people/people-create/{$person->id}"); ?>" data-action="ativar" data-confirm="ATENÇÃO: Tem certeza que deseja ativar o cliente!" data-user_id="<?= $person->id; ?>"><span class="icon-check"></span></a>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>

            <?= $paginator; ?>
        </section>
    </div>
</section>