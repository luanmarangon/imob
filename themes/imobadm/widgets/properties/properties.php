<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-home">Imóveis</h2>
        <form action="<?= url("/admin/properties/properties"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php foreach ($properties as $propertie) : ?>
            <article class="radius">
                <div>
                    <h4 class="icon-home"><?= $propertie->reference; ?></h4>
                    <p><b>Endereço:</b> <?= $propertie->address($propertie->addresses_id)->street; ?>,
                        <?= $propertie->address($propertie->addresses_id)->number; ?></p>
                    <p><b>Bairro:</b><?= $propertie->address($propertie->addresses_id)->district; ?></p>
                </div>
                <div>
                    <p><b>Cidade:</b>
                        <?= $propertie->address($propertie->addresses_id)->city; ?>-<?= $propertie->address($propertie->addresses_id)->state; ?>
                    </p>
                    <p><b>CEP:</b><?= $propertie->address($propertie->addresses_id)->zipcode; ?></p>
                    <?php if ($propertie->active == 1) : ?>
                    <p><b>Status:</b>Ativo</p>
                    <?php else : ?>
                    <p><b>Status:</b>Inativo</p>
                    <?php endif; ?>
                    <?php foreach ($people as $person) : ?>
                    <?php if ($person->id === $propertie->address($propertie->addresses_id)->people_id) : ?>
                    <p><b>Proprietário:</b> <?= $person->fullName(); ?></p>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="actions">
                    <a class="icon-cogs btn btn-green"
                        href="<?= url("admin/properties/properties/{$propertie->reference}/details/home"); ?>"
                        title="">Detalhes</a>
                    <a class="icon-vallet btn btn-red"
                        href="<?= url("admin/properties/properties/{$propertie->reference}/transactions/transactions"); ?>"
                        title="">Transações</a>
                    <a class="icon-pencil btn btn-blue" href="<?= url("admin/properties/properties-create/{$propertie->id}"); ?>" title="">Editar</a>
                    <?php if ($propertie->active == 1) : ?>
                    <a class="icon-ban btn btn-yellow" href="" title="">Desativar</a>
                    <?php else : ?>
                    <a class="icon-check btn btn-green" href="" title="">Ativar</a>
                    <?php endif; ?>

                </div>
            </article>
            <?php endforeach; ?>


            <?= $paginator; ?>
        </section>
    </div>
</section>