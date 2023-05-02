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
                <article class="radius">
                    <h4 class="icon-calendar-check-o">Expiração:</h4>

                    <p><?= $moneyRent ?  date("d-m-Y", strtotime($moneyRent->end)) : "-------" ?>
                    </p>

                </article>
                <article class="radius">
                    <h4 class="icon-money">Total Vendas</h4>
                    <p> R$ <?= $moneyRent ? str_price($moneyRent->value) : str_price(0) ?></p>
                </article>
                <article class="radius">
                    <h4 class="icon-home">Imóvel:</h4>
                    <p><?= $moneyRent ? $propertieRent->reference : 'Sem Imóvel ' ?></p>
                </article>

            </section>
            <br>
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-line-chart">total Imóveis</h4>
                    <p><?= $saleCount; ?></p>
                </article>
                <article class="radius">
                    <h4 class="icon-calendar-check-o">Expiração:</h4>

                    <p><?= $moneySale ?  date("d-m-Y", strtotime($moneySale->end)) : "-------" ?>
                    </p>

                </article>
                <article class="radius">
                    <h4 class="icon-money">Total Vendas</h4>
                    <p> R$ <?= $moneySale ? str_price($moneySale->value) : str_price(0) ?></p>
                </article>
                <article class="radius">
                    <h4 class="icon-home">Imóvel:</h4>
                    <p><?= $moneySale ? $propertieSale->reference : 'Sem Imóvel ' ?></p>
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