<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-heartbeat">Configurações {IMOB001}</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="" method="post">
            <!-- <div class="label_g2">
                <label class="label">
                    <span class="legend">*Plano:</span>
                    <select name="plan_id" required>
                        <option value="ID">PRO - R$ 5,00/mês</option>
                        <option value="ID">PRO - R$ 50,00/ano</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">*Cartão:</span>
                    <select name="card_id" required>
                        <option value="ID">Mastercard 5567</option>
                        <option value="ID">Visa 6678</option>
                    </select>
                </label>
            </div> -->

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Status da assinatura:</span>
                    <select name="status" required>
                        <option value="active">Comfortable</option>
                        <option value="canceled">features</option>
                        <option value="canceled">types</option>
                        <option value="canceled">Category</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">*Status da recorrência:</span>
                    <select name="pay_status" required>
                        <option value="active">banheiro</option>
                        <option value="canceled">suite</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">*Status da recorrência:</span>
                    <input type="text">
                </label>

                <label class="label">
                    <i class="btn btn-yellow icon-cogs"> </i>
                </label>
            </div>

            <!-- <label class="label">
                <span class="legend">*Dia de vencimento:</span>
                <select name="due_day" required>
                    <?php for ($day = 1; $day <= 28; $day++) : ?>
                        <option value="active">Todo dia <?= str_pad($day, 2, 0, 0); ?></option>
                    <?php endfor; ?>
                </select>
            </label>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Próximo vencimento:</span>
                    <input class="mask-date" type="text" name="next_due" value="<?= date("d/m/Y"); ?>" required />
                </label>

                <label class="label">
                    <span class="legend">*Útima cobrança:</span>
                    <input class="mask-date" type="text" name="last_charge" value="<?= date("d/m/Y"); ?>" required />
                </label>
            </div> -->

            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Atualizar Assinatura</button>
            </div>

            <?php for ($i = 0; $i < 10; $i++) : ?>
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Status da assinatura:</span>
                        <input type="text" value="Banheiro" disabled>
                    </label>

                    <label class="label">
                        <span class="legend">*Status da recorrência:</span>
                        <input type="text">
                    </label>

                    <label class="label">
                        <span class="legend">*Status da assinatura:</span>
                        <input type="text" value="Banheiro" disabled>
                    </label>

                    <label class="label">
                        <span class="legend">*Status da recorrência:</span>
                        <input type="text">
                    </label>

                </div>
            <?php endfor; ?>
            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Atualizar Assinatura</button>
            </div>
        </form>
    </div>
</section>