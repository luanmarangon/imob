<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/transactions/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-line-chart">total Imóveis</h4>
                    <p><?= $rentCount; ?></p>
                </article>
                <?php foreach ($moneyRent as $rent) : ?>

                    <article class="radius">
                        <h4 class="icon-calendar-check-o">Expiração:</h4>
                        <?php if ($rentCount) : ?>
                            <p><?= date("d-m-Y", strtotime($rent->end)); ?></p>
                        <?php else : ?>
                            <p>Sem Aluguel para expirar</p>
                        <?php endif; ?>
                    </article>
                    <article class="radius">
                        <h4 class="icon-money">Total Vendas</h4>
                        <p> R$ <?= str_price($rent->value); ?></p>
                    </article>
                <?php endforeach; ?>
                <article class="radius">
                    <h4 class="icon-home">Imóvel:</h4>
                    <?php foreach ($properties as $propertie) : ?>
                        <?php if ($propertie->id === $rent->properties_id) : ?>
                            <p><?= $propertie->reference; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </article>
            </section>
            <br>
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-line-chart">total Imóveis</h4>
                    <p><?= $saleCount; ?></p>
                </article>
                <?php foreach ($moneySale as $sale) : ?>

                    <article class="radius">
                        <h4 class="icon-calendar-check-o">Expiração:</h4>
                        <?php if ($saleCount) : ?>
                            <p><?= date("d-m-Y", strtotime($sale->end)); ?></p>
                        <?php else : ?>
                            <p>Sem Aluguel para expirar</p>
                        <?php endif; ?>
                    </article>
                    <article class="radius">
                        <h4 class="icon-money">Total Vendas</h4>
                        <p> R$ <?= str_price($sale->value); ?></p>
                    </article>
                <?php endforeach; ?>
                <article class="radius">
                    <h4 class="icon-home">Imóvel:</h4>
                    <?php foreach ($properties as $propertie) : ?>
                        <?php if ($propertie->id === $sale->properties_id) : ?>
                            <p><?= $propertie->reference; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </article>
            </section>




            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Imóveis:</h3>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <article class="subscriber">
                        <h5>22.10.18 22h - Aluguel</h5>
                        <p>R$ 500,00</p>
                        <p>IMOB001</p>
                    </article>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</section>