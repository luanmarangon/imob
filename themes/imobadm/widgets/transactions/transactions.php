<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/transactions/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-money">Transações</h2>
        <form action="<?= url("/admin/transactions/transactions"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php foreach ($transactions as $transaction) : ?>
                <article class="radius">
                    <div>
                        <?php foreach ($properties as $propertie) : ?>
                            <?php if ($propertie->id === $transaction->properties_id) : ?>
                                <a class="icon-share " href="<?= url("admin/properties/properties/{$propertie->reference}/transactions/transactions"); ?>" title=""></a>

                                <h4 class="icon-home"> <?= $propertie->reference; ?></h4>

                                <p><b>Endereço:</b>
                                    <?= $propertie->address($propertie->id)->street . ", " . $propertie->address($propertie->id)->number; ?>
                                </p>
                                <p><b>Bairro:</b> <?= $propertie->address($propertie->id)->district; ?></p>
                                <p><b>Cidade:</b>
                                    <?= $propertie->address($propertie->id)->city . "-" . $propertie->address($propertie->id)->state; ?>
                                </p>
                                <p><b>CEP:</b> <span class="mask-cep"> <?= $propertie->address($propertie->id)->zipcode; ?></span>
                                </p>

                    </div>

                    <div>
                        <p><b>Transação:</b> <?= $transaction->type; ?></p>
                        <p><b>Valor:</b> R$ <span class=""><?= str_price($transaction->value); ?></span></p>
                        <p><b>Inicio:</b> <span class="mask-date"><?= date("d-m-Y", strtotime($transaction->start)); ?></span></p>
                        <p><b>Fim:</b> <span class="mask-date"><?= date("d-m-Y", strtotime($transaction->end)); ?></span>
                        </p>

                        <p><b>Status:</b> <?= $transaction->status; ?></p>

                        <?php foreach ($people as $owner) : ?>
                            <?php if ($propertie->address($propertie->id)->people_id === $owner->id) : ?>
                                <p><b>Proprietário:</b> <?= $owner->fullName(); ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                    </div>

                </article>

            <?php endforeach; ?>

            <?= $paginator; ?>
        </section>
    </div>
</section>