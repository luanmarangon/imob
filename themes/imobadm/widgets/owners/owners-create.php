<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Novo Proprietário</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="" method="post">

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Nome:</span>
                    <input type="text" name="first_name" placeholder="Primeiro nome" required />
                </label>

                <label class="label">
                    <span class="legend">*Sobrenome:</span>
                    <input type="text" name="last_name" placeholder="Último nome" required />
                </label>
            </div>
            <div class="label_g2">

                <label class="label">
                    <span class="legend">Genero:</span>
                    <select name="genre">
                        <option value="male">Masculino</option>
                        <option value="female">Feminino</option>
                        <option value="other">Outros</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Nascimento:</span>
                    <input type="text" class="mask-date" name="last_name" placeholder="dd/mm/yyyy" />
                </label>

                <label class="label">
                    <span class="legend">C.P.F.:</span>
                    <input class="mask-doc" type="text" name="document" placeholder="CPF do cliente" />
                </label>
                <label class="label">
                    <span class="legend">R.G.:</span>
                    <input type="text" class="mask-rg" name="last_name" placeholder="RG do cliente" />
                </label>
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Celular:</span>
                    <input type="text" name="phone" class="mask-phone" placeholder="Celular" required />
                </label>

                <label class="label">
                    <span class="legend">*E-mail:</span>
                    <input type="email" name="email" placeholder="Melhor e-mail" required />
                </label>
            </div>
            <div class="label_g2">

                <label class="label">
                    <span class="legend">C.E.P.: </span>
                    <!-- <input class="mask-cep" type="text" id="cep" name="number" required /> -->
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
            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Cadastrar</button>
            </div>
        </form>
    </div>
</section>