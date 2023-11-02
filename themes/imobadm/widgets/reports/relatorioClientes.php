<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/reports/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatorio</h2>
    </header>


    <div class="dash_content_app_box">
        <?php if ($reports) : ?>
            <div id="containerDoBotao">
                <button class="btn btn-default icon-print" id="printReports">Imprimir</button>
            </div>
            <hr>
            <table class="reports">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>C.P.F.</th>
                        <th>E-Mail</th>
                        <!-- <th>E-Mail</th> -->
                        <!-- <th>Cidade</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $key) : ?>
                        <tr>
                            <td><?= $key->fullName(); ?></td>
                            <td class="mask-cpf"><?= $key->cpf; ?></td>
                            <td><?= $key->contact; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- <?= $paginator; ?> -->
        <?php endif; ?>
    </div>
</section>