<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/reports/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatorio</h2>
    </header>
    <?php if (!$reports) : ?>
    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/reports/relImoveis"); ?>" method="get">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="relImoveis" />
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Data Inicial:</span>
                    <input type="date" name="dateFirst" required value="<?= date('2023-01-01'); ?>" />

                </label>

                <label class="label">
                    <span class="legend">*Data Final:</span>
                    <input type="date" name="dateLast" required value="<?= date('Y-m-d'); ?>" />
                </label>

                <label class="label">
                    <span class="legend">Cidade</span>
                    <select name="city" id="">
                        <option value="Geral">GERAL</option>
                        <?php foreach ($citys as $city) : ?>
                        <option value="<?= $city->city; ?>-<?= $city->state; ?>">
                            <?= $city->city; ?>-<?= $city->state; ?>
                        </option>
                        <?php endforeach; ?>

                    </select>
                </label>
                <label class="label">
                    <span class="legend">*Ativo?</span>

                    <select name="status" id="">
                        <!-- <option value=""></option> -->
                        <option value="Ativo">ATIVO</option>
                        <option value="Inativo">INATIVO</option>
                        <option value="Geral">GERAL</option>

                    </select>
                </label>
            </div>



            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Buscar</button>
                <!-- <a href="<?= url("/admin/reports/relatorioImoveis"); ?>" class="btn btn-green icon-check-square-o"
                    data-teste="teste">Buscar</a> -->
            </div>
        </form>
    </div>
    <?php else : ?>
    <div class="dash_content_app_box">
        <!-- <?php if ($reports) : ?> -->
        <div id="containerDoBotao">
            <a class="btn btn-default icon-print" id="printReports">Imprimir</a>
        </div>
        <hr>
        <table class="reports">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Categoria</th>
                    <th>C.E.P.</th>
                    <th>Cidade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $key) : ?>
                <tr>
                    <td><?= $key->reference; ?></td>
                    <td><?= $key->category($key->categories_id)->category; ?></td>
                    <td><?= $key->zipcode; ?></td>
                    <td><?= $key->city; ?>-<?= $key->state; ?></td>
                    <td><?= $key->active; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- <?= $paginator; ?> -->
        <!-- <?php endif; ?> -->
    </div>

    <?php endif; ?>
</section>