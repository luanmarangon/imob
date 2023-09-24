<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/cs/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-user-plus">Solicitações de Contatos</h2>
        <form action="<?= url("/admin/cs/contato"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar Contato:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php if ($contact) : ?>
                <?php foreach ($contact as $cs) : ?>
                    <article class="radius">
                        <div>

                            <h4><span class="icon-user"></span><?= $cs->name; ?></h4>

                            <h5><span class=" icon-envelope"></span><?= $cs->email; ?></h5>
                            <h5><span class=" icon-commenting"></span><?= $cs->messageContact; ?></h5>
                        </div>
                        <div class="actions">
                            <?php if ($cs->status != "N") : ?>
                                <a class="icon-check btn btn-green" href="" title=""> <span></span></a>
                            <?php else : ?>
                                <a class="icon-check btn btn-red" href="" title=""> <span></span></a>
                            <?php endif; ?>
                            <a class="icon-pencil btn btn-blue" href="<?= url("admin/cs/resposta/{$cs->id}"); ?>" title="">Responder</a>
                        </div>
                        <!-- <?php var_dump($cs); ?> -->
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="message info icon-info">
                    Atualmente, não há nenhuma solicitação de contato. Assim que houver alguma, ela será exibida nesta seção.
                </div>

            <?php endif; ?>

            <?= $paginator; ?>
        </section>
    </div>
</section>