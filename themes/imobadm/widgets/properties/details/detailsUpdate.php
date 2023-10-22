<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-share">Estruturas do Imóveis - </h2>
    </header>

    <section class="app_control_subs radius">



        <form class="app_form" action="" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Estrutura do Imóvel:</span>
                    <input type="text" name="footage" placeholder="Metragem" value="TETSE" disabled />


                </label>
                <label class="label">
                    <span class="legend">*Metragem:</span>
                    <input type="text" name="footage" placeholder="Metragem" required />
                </label>
            </div>
            <div class="al-right">
                <button class="btn btn-green icon-plus-square-o">Inserir Estrutura</button>
            </div>
        </form>


    </section>


</section>