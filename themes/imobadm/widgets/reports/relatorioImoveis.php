<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/reports/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatorio</h2>
    </header>


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
</section>