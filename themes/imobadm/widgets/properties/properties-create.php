<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/sidebar.php"); ?>


<section class="dash_content_app">
    <?php if (!$propertie) : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Novo Imóvel</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/properties/properties-create"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Proprietário:</span>
                        <!-- <input type="text" name="name" value="Full Name" disabled /> -->
                        <select name="people" id="">
                            <option value=""></option>
                            <?php foreach ($peoples as $people) : ?>
                                <option value="<?= $people->id; ?>"><?= $people->fullName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">Categoria:</span>
                        <!-- <input type="text" name="name" value="Full Name" disabled /> -->
                        <select name="category" id="">
                            <option value=""></option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id; ?>"><?= $category->category; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">Tipo:</span>
                        <!-- <input type="text" name="name" value="Full Name" disabled /> -->
                        <select name="type" id="">
                            <option value=""></option>
                            <?php foreach ($types as $type) : ?>
                                <option value="<?= $type->id; ?>"><?= $type->type; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>


                <!-- <div class="label_g2"> -->
                <div class="label">
                    <label class="label">
                        <span class="legend">*Descrição:</span>
                        <textarea name="description" placeholder="Sobre o imovél" required></textarea>
                    </label>
                </div>
                <!-- </div> -->

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">C.E.P.:</span>
                        <input class="mask-cep" type="text" id="cep" name="cep" minlength="10" required placeholder="Digite o CEP" />
                    </label>

                    <label class="label">
                        <span class="legend">Cidade:</span>
                        <input class="" id="cidade" type="text" name="city" required />
                    </label>

                    <label class="label">
                        <span class="legend">Bairro:</span>
                        <input class="" id="bairro" type="text" name="district" required />
                    </label>

                </div>
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Logradouro:</span>
                        <input class="" id="logradouro" type="text" name="street" required />
                    </label>

                    <label class="label">
                        <span class="legend">Número:</span>
                        <input class="" type="text" name="number" required />
                    </label>

                    <label class="label">
                        <span class="legend">Complemento:</span>
                        <input class="" type="text" name="complement" required />
                    </label>
                </div>
                <hr>
                <h3>Cômodos do Imóvel <a class="btn btn-green btnAdd"> + </a></h3>
                <div id="attributes">
                    <div class="label_g2">
                        <label class="label">
                            <span class="legend">Comodos:</span>
                            <select name="comfortable[]" id="">
                                <option value=""></option>
                                <?php foreach ($comfortable as $convenient) : ?>
                                    <option value="<?= $convenient->id; ?>"><?= $convenient->convenient; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="label">
                            <span class="legend">Quantidade <span class="cep_search"> *(Unidade):</span></span>
                            <input class="" type="number" name="quantityComfortable[]" />
                        </label>
                    </div>
                </div>


                <h3>Estruturadas do Imóvel <a class="btn btn-green btnAdd"> + </a></h3>
                <div id="attributes">
                    <div class="label_g2">
                        <label class="label">
                            <span class="legend">Estrutura:</span>
                            <select name="structure[]" id="">
                                <option value=""></option>
                                <?php foreach ($structures as $structure) : ?>
                                    <option value="<?= $structure->id; ?>"><?= $structure->structure; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="label">
                            <span class="legend">Metragem <span class="cep_search"> *(Metros):</span></span>
                            <input class="" type="number" name="footageStructure[]" />
                        </label>
                    </div>
                </div>

                <h3>Tributos do imóvel <a class="btn btn-green btnAdd"> + </a></h3>
                <div id="attributes">
                    <div class="label_g2">
                        <label class="label">
                            <span class="legend">Tributo:</span>

                            <select name="tribute[]" id="">
                                <option value=""></option>
                                <?php foreach ($charge as $tributes) : ?>
                                    <option value="<?= $tributes->id; ?>"><?= $tributes->charge; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="label">
                            <span class="legend">Exercício <span class="cep_search"> *(Ano):</span></span>
                            <input type="text" id="datepicker" placeholder="Ano" name="yearTribute[]">
                        </label>
                        <label class="label">
                            <span class="legend">Valor <span class="cep_search"> *(R$):</span></span>
                            <input type="text" class="mask-money" name="valueTribute[]">
                        </label>
                    </div>
                </div>

                <h3>Características do Imóvel </h3>
                <div id="attributes">
                    <!-- <div class="label_g2"> -->
                    <label class="label">
                        <!-- <span class="legend">Caracteristicas:</span> -->
                        <div class="checkbox-columns">
                            <?php foreach ($features as $feature) : ?>
                                <div class="checkbox-column">
                                    <label><?= $feature->feature; ?></label>
                                    <input type="checkbox" name="feature[]" value="<?= $feature->id; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </label>
                    <!-- </div> -->
                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Criar Imóvel</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle"><?= $propertie->reference; ?></h2>
        </header>

        <div class="dash_content_app_box">

            <form class="app_form" action="<?= url("/admin/properties/properties-create/{$propertie->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Proprietário:</span>
                        <?php if (!$propertie->address()->people_id) : ?>
                            <select name="" id="">
                                <option value=""></option>
                                <?php foreach ($peoples as $owner) : ?>
                                    <option value="<?= $owner->id; ?>"><?= $owner->fullName(); ?></option>
                                <?php endforeach; ?>
                            </select>

                        <?php else : ?>
                            <?php foreach ($peoples as $owner) : ?>
                                <?php if ($propertie->address()->people_id == $owner->id) : ?>
                                    <input type="text" name="" id="" value="<?= $owner->fullName(); ?>">
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <span><a href="#">transferencia Propriedade</a></span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">C.E.P.:</span>
                        <input class="mask-cep" type="text" id="cep" name="number" minlength="10" value="<?= $propertie->address()->zipcode; ?>" placeholder="Digite o CEP" />
                    </label>

                    <label class="label">
                        <span class="legend">Cidade:</span>
                        <input class="" id="cidade" type="text" name="number" value="<?= $propertie->address()->city; ?>-<?= $propertie->address()->state; ?>" />
                    </label>

                    <label class="label">
                        <span class="legend">Bairro:</span>
                        <input class="" id="bairro" type="text" name="address" value="<?= $propertie->address()->district; ?>" />
                    </label>

                </div>
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Logradouro:</span>
                        <input class="" id="logradouro" type="text" name="address" value="<?= $propertie->address()->street; ?>" />
                    </label>

                    <label class="label">
                        <span class="legend">Número:</span>
                        <input class="" type="text" name="number" value="<?= $propertie->address()->number; ?>" />
                    </label>

                    <label class="label">
                        <span class="legend">Complemento:</span>
                        <input class="" type="text" name="number" value="<?= $propertie->address()->complement; ?>" />
                    </label>
                </div>

                <div class="al-right">
                    <button class="btn btn-blue icon-check-square-o">Atualizar Imóvel</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

</section>