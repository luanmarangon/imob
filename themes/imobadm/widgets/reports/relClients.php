<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/reports/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-coffee">Relatorio Geral de Clientes</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/reports/relatorioClientes"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="relClients" />
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Data Inicial:</span>
                    <input type="date" name="dateFirst" />
                </label>

                <label class="label">
                    <span class="legend">*Data Final:</span>
                    <input type="date" name="dateLast" />
                </label>

                <label class="label">
                    <span class="legend">Sexo</span>
                    <select name="genre" id="">
                        <option value=""></option>
                        <option value="female">Feminino</option>
                        <option value="male">Masculino</option>
                        <option value="other">Outros</option>
                    </select>
                </label>
                <label class="label">
                    <span class="legend">*Ativo?</span>
                    <select name="status" id="">
                        <option value="Ativo">ATIVO</option>
                        <option value="Inativo">INATIVO</option>
                        <option value="Geral">GERAL</option>
                    </select>
                </label>
                <label class="label">
                    <span class="legend">*Ativo?</span>
                    <label>Teste <input type="checkbox" name="feature[]" value="Teste"></label>
                    <label>Teste <input type="checkbox" name="feature[]" value="Teste"></label>
                    <label>Teste <input type="checkbox" name="feature[]" value="Teste"></label>

                </label>
            </div>



            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Buscar</button>
            </div>
        </form>
    </div>
</section>