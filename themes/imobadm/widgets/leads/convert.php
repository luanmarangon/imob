<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/leads/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Converter Lead</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/leads/convert/{$convert->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="convert" />
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Nome:</span>
                    <input type="text" name="first_name" placeholder="Primeiro nome" required
                        value="<?= $convert->name()[0]; ?>" />
                </label>

                <label class="label">
                    <span class="legend">*Sobrenome:</span>
                    <input type="text" name="last_name" placeholder="Último nome" required
                        value="<?= $convert->name()[1]; ?>" />
                </label>
            </div>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">Genero:</span>
                    <select name="genre">
                        <option value="female">Feminino</option>
                        <option value="male">Masculino</option>
                        <option value="other">Outros</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Nascimento:</span>
                    <input type="text" class="mask-date" name="datebirth" placeholder="dd/mm/yyyy" />
                </label>
            </div>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">C.P.F.:</span>
                    <input class="mask-doc" type="text" name="document_cpf" placeholder="000.000.000-00" />
                </label>
                <label class="label">
                    <span class="legend">R.G.:</span>
                    <input type="text" class="mask-rg" name="document_rg" placeholder="00.000.000-X" />
                </label>
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Celular:</span>
                    <input type="text" name="phone" class="mask-phone" placeholder="Celular"
                        value="<?= $convert->phone; ?>" />
                </label>

                <label class="label">
                    <span class="legend">*E-mail:</span>
                    <input type="email" name="email" placeholder="Melhor e-mail" value="<?= $convert->email; ?>" />
                </label>
            </div>
            <div class="label_g2">

                <label class="label">
                    <span class="legend">C.E.P.: </span>
                    <!-- <input class="mask-cep" type="text" id="cep" name="number" required /> -->
                    <input class="mask-cep" type="text" id="cep" name="zipcode" minlength="10"
                        placeholder="Digite o CEP" />

                </label>


                <label class="label">
                    <span class="legend">Cidade:</span>
                    <input class="" id="cidade" type="text" name="city" />
                </label>
                <!-- <label class="label">
                    <span class="legend">Estado:</span>
                    <input class="" id="uf" type="text" name="number" required />
                </label> -->
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">Logradouro:</span>
                    <input class="" id="logradouro" type="text" name="street" />
                </label>

                <label class="label">
                    <span class="legend">Número:</span>
                    <input class="" type="text" name="number" />
                </label>
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">Complemento:</span>
                    <input class="" type="text" name="complement" />
                </label>

                <label class="label">
                    <span class="legend">Bairro:</span>
                    <input class="" id="bairro" type="text" name="district" />
                </label>
            </div>

            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Cadastrar</button>
            </div>
        </form>
    </div>

</section>