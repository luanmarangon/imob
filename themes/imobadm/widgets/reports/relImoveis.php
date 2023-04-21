<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatorio</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <form class="app_form" action="" method="post">
                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Início:</span>
                                <input type="date" id="data" name="data">
                            </label>

                            <label class="label">
                                <span class="legend">Final:</span>
                                <input type="date" id="data" name="data" placeholder="DD/MM/AAAA">
                            </label>
                            <label class="label">
                                <span class="legend">Situação:</span>
                                <select name="" id="">
                                    <option value="">Ativo</option>
                                    <option value="">Inativo</option>
                                </select>
                            </label>
                            <label class="label">
                                <span class="legend">Situação:</span>
                                <select name="" id="">
                                    <option value="">Alu</option>
                                    <option value="">Inativo</option>
                                </select>
                            </label>
                        </div>
                        <div class="al-right">
                            <button class="btn btn-green icon-check-square-o">Consultar</button>
                        </div>
                    </form>
                </article>

            </section>


            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Imóveis:</h3>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <article class="subscriber">
                        <h5>22.10.18 22h - Rua Alcides Ramos da Silva, 315</h5>
                        <p>Martinópolis-SP</p>
                        <p>Concluída</p>
                    </article>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</section>