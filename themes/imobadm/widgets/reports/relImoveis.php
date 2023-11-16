<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/reports/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatório de Imóveis</h2>
    </header>
    <div class="ajax_response"><?= flash(); ?></div>

    <?php if (!$reports) : ?>
    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/reports/relImoveis"); ?>" method="post"
            enctype="multipart/form-data">
            <!-- <?= csrf_input(); ?> -->
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="relImoveis" />
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Data Inicial:</span>
                    <input type="date" name="dateFirst" required />

                </label>

                <label class="label">
                    <span class="legend">*Data Final:</span>
                    <input type="date" name="dateLast" required />
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
            </div>
        </form>
    </div>
    <?php else : ?>
    <div class="dash_content_app_box">
        <?php if ($dateFirst && $dateLast) : ?>
        <p>Período: <?= date_fmt($dateFirst); ?> à <?= date_fmt($dateLast); ?></p>
        <?php endif; ?>

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
    </div>

    <?php endif; ?>
</section>