<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/transactions/sidebar.php"); ?>

<section class="dash_content_app">

    <?php if (!$transaction) : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Nova Transação para o Imóvel <?= $propertie->reference; ?></h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />
                <div class="label">
                    <label class="label">
                        <span class="legend">*Referência Imóvel:</span>
                        <input type="text" name="propertieReference" value="<?= $propertie->reference; ?>" disabled />

                    </label>
                    <label class="label">
                        <span class="legend">*Plano:</span>
                        <input type="text" name="propertieAddress" value="<?= $addressPropertie; ?>" disabled />
                    </label>

                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="transactionsType" required>
                            <option value="Aluguel">Aluguel</option>
                            <option value="Venda">Venda</option>
                        </select>
                    </label>
                    <label class="label">
                        <span class="legend">*Preço:</span>
                        <input class="mask-money" type="text" name="transactionsValue" required />
                    </label>
                    <label class="label">
                        <span class="legend">*Início Vigência:</span>
                        <input class="mask-date" type="text" name="transactionsStart" required />
                    </label>

                    <label class="label">
                        <span class="legend">*Fim Vigência:</span>
                        <input class="mask-date" type="text" name="transactionsEnd" required />
                    </label>

                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Inserir Transação</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Alteração da transação <?= $transaction->id; ?> no Imovel: <?= $propertie->reference; ?> </h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create/{$transaction->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />
                <div class="label">
                    <label class="label">
                        <span class="legend">*Referência Imóvel:</span>
                        <input type="text" name="propertieReference" value="<?= $propertie->reference; ?>" disabled />

                    </label>
                    <label class="label">
                        <span class="legend">*Plano:</span>
                        <input type="text" name="propertieAddress" value="<?= $addressPropertie; ?>" disabled />
                    </label>

                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="transactionsType">

                            <?php if ($transaction->type === 'Aluguel') : ?>
                                <option value="Aluguel">Aluguel</option>
                                <option value="Venda">Venda</option>
                            <?php else : ?>
                                <option value="Venda">Venda</option>
                                <option value="Aluguel">Aluguel</option>
                            <?php endif; ?>

                        </select>
                    </label>
                    <label class="label">
                        <span class="legend">*Preço:</span>
                        <input class="mask-money" type="text" name="transactionsValue" value="<?= $transaction->value; ?>" />
                    </label>
                    <label class="label">
                        <span class="legend">*Início Vigência:</span>
                        <input class="mask-date" type="text" name="transactionsStart" value="<?= date_fmt($transaction->start); ?>" />
                    </label>

                    <label class="label">
                        <span class="legend">*Fim Vigência:</span>
                        <input class="mask-date" type="text" name="transactionsEnd" value="<?= date_fmt($transaction->end); ?>" />
                    </label>

                </div>
                <div class="al-right">
                    <a href="#" class="icon-ban btn btn-red" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/transactions/transactions-create"); ?>" data-action="delete" data-confirm="ATENÇÃO: Você tem certeza de que deseja excluir esta transação?" data-transaction_id="<?= $transaction->id; ?>">Excluir</a>

                    <button class="btn btn-blue icon-check-square-o">Editar Transação</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</section>