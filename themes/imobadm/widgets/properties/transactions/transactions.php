<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/transactions/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-money">Transações do <?= $propertie->reference ?></h2>
        <form action="" class="app_search_form">
            <input type="text" name="s" placeholder="Pesquisar:">
            <button class="icon-search icon-notext"></button>
        </form>
        <!-- <a class="icon-plus-circle btn btn-green" href="dash.php?app=transacoes/transacao-create">Novo Imóvel</a> -->
    </header>

    <div class="dash_content_app_box">
        <section class="app_control_plans">
            <?php foreach ($transactions as $transaction) : ?>
            <article class="radius">
                <div>
                    <h4 class="icon-home"><?= $propertie->reference ?></h4>
                    <p><b>Endereço:</b>
                        <?= $propertie->address($propertie->id)->street . ", " . $propertie->address($propertie->id)->number; ?>
                    </p>
                    <p><b>Bairro:</b> <?= $propertie->address($propertie->id)->district; ?></p>
                    <p><b>Cidade:</b>
                        <?= $propertie->address($propertie->id)->city . "-" . $propertie->address($propertie->id)->state; ?>
                    </p>
                    <p><b>CEP:</b> <span class="mask-cep"><?= $propertie->address($propertie->id)->zipcode; ?></span>
                    </p>
                </div>

                <div>
                    <p><b>Transação:</b> <?= $transaction->type; ?></p>
                    <p><b>Valor:</b> R$ <span class="mask-money"><?= $transaction->value; ?></span></p>
                    <p><b>Inicio:</b> <span
                            class="mask-date"><?= date("d-m-Y", strtotime($transaction->start)); ?></span></p>
                    <p><b>Fim:</b> <span class="mask-date"><?= date("d-m-Y", strtotime($transaction->end)); ?></span>
                    </p>
                    <?php if (date("d/m/Y") < date("d-m-Y", strtotime($transaction->end))) : ?>
                    <p><b>Status:</b> Ativo</p>
                    <?php else : ?>
                    <p><b>Status:</b> Inativo</p>
                    <?php endif; ?>
                    <?php foreach ($people as $person) : ?>
                    <?php if ($propertie->address($propertie->id)->people_id === $person->id) : ?>
                    <p><b>Proprietário:</b> <?= $person->fullName(); ?></p>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>

                <div class="actions">
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-ban btn btn-yellow" href="" title="">Desativar</a>
                </div>
            </article>
            <?php endforeach; ?>

            <!-- <nav class="paginator">
                <a class="paginator_item" title="Primeira página" href="">&lt;&lt;</a>
                <span class="paginator_item paginator_active">1</span>
                <a class="paginator_item" title="Página 2" href="">2</a>
                <a class="paginator_item" title="Página 3" href="">3</a>
                <a class="paginator_item" title="Página 4" href="">4</a>
                <a class="paginator_item" title="Última página" href="">&gt;&gt;</a>
            </nav> -->
        </section>
    </div>
</section>