<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/transactions/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-money">Transações do <?= $propertie->reference ?></h2>
        <!-- <form action="" class="app_search_form">
            <input type="text" name="s" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form> -->
        <!-- <a class="icon-plus-circle btn btn-green" href="dash.php?app=transacoes/transacao-create">Novo Imóvel</a> -->
    </header>

    <div class="dash_content_app_box">
        <?php if ($transactions) : ?>
            <?php foreach ($transactions as $transaction) : ?>
                <section class="app_control_plans">
                    <article class="radius">
                        <div>
                            <?php if ($transaction->status === 'Ativo') : ?>
                                <h4 class="icon-home active">Transação: <?= $transaction->id; ?> do <?= $propertie->reference ?></h4>
                            <?php else : ?>
                                <h4 class="icon-home inactive">Transação: <?= $transaction->id; ?> do <?= $propertie->reference ?></h4>
                            <?php endif; ?>
                            <p><b>Endereço:</b>
                                <?= $addresses->street . ", " . $addresses->number; ?>
                            </p>
                            <p><b>Bairro:</b> <?= $addresses->district; ?></p>
                            <p><b>Cidade:</b>
                                <?= $addresses->city . "-" . $addresses->state; ?>
                            </p>
                            <p><b>CEP:</b> <span class="mask-cep"><?= $addresses->zipcode; ?></span>
                            </p>
                        </div>

                        <div>
                            <p><b>Transação:</b> <?= $transaction->type; ?></p>
                            <p><b>Valor:</b> R$ <span class="mask-money"><?= $transaction->value; ?></span></p>
                            <p><b>Inicio:</b> <span class="mask-date"><?= date("d-m-Y", strtotime($transaction->start)); ?></span></p>
                            <p><b>Fim:</b> <span class="mask-date"><?= date("d-m-Y", strtotime($transaction->end)); ?></span></p>
                            <p><b>Status:</b> <?= $transaction->status; ?></p>
                            <p><b>Proprietário:</b> <?= $people->fullName(); ?></p>
                        </div>

                        <div class="actions">
                            <a class="icon-pencil btn btn-blue" href="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create/{$transaction->id}"); ?>" title="">Editar</a>
                            <?php if (($transaction->status != "Inativo")) : ?>
                                <a href="#" class="icon-ban btn btn-yellow" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create"); ?>" data-action="inactive" data-confirm="ATENÇÃO: Você tem certeza de que deseja inativar esta transação?" data-transaction_id="<?= $transaction->id; ?>">Inativar</a>
                            <?php else : ?>
                                <a href="#" class="icon-check btn btn-green" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create"); ?>" data-action="active" data-confirm="ATENÇÃO: Você tem certeza de que deseja ativar esta transação?" data-transaction_id="<?= $transaction->id; ?>">Ativar</a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?= $paginator; ?>
                </section>
            <?php else : ?>
                <section class="app_control_plans">
                    <article class="radius">
                        <h1>Até o momento, não existem transações cadastradas para este imóvel.</h1>
                    </article>
                </section>
            <?php endif; ?>
    </div>
</section>