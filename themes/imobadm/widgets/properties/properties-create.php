<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Novo Imóvel</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="" method="post">
            <div class="label_g2">
                <label class="label">
                    <span class="legend">Proprietário:</span>
                    <input type="text" name="name" value="Full Name" disabled />
                </label>
            </div>

            <div class="label_g2">

                <label class="label">
                    <span class="legend">C.E.P.:</span>
                    <input class="mask-cep" type="text" id="cep" name="number" minlength="10" required placeholder="Digite o CEP" />
                </label>


                <label class="label">
                    <span class="legend">Cidade:</span>
                    <input class="" id="cidade" type="text" name="number" required />
                </label>
                <label class="label">
                    <span class="legend">Estado:</span>
                    <input class="" id="uf" type="text" name="number" required />
                </label>


            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">Logradouro:</span>
                    <input class="" id="logradouro" type="text" name="address" required />
                </label>

                <label class="label">
                    <span class="legend">Número:</span>
                    <input class="" type="text" name="number" required />
                </label>
                <label class="label">
                    <span class="legend">Complemento:</span>
                    <input class="" type="text" name="number" required />
                </label>

                <label class="label">
                    <span class="legend">Bairro:</span>
                    <input class="" id="bairro" type="text" name="address" required />
                </label>


            </div>
            <hr>



            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Criar Imóvel</button>
            </div>
        </form>
    </div>
</section>