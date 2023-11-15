<?php $v->layout("_theme"); ?>

<div class="main_filter light py-5">
    <div class="container">
        <section class="row">
            <div class="col-6">
                <h2 class="text-front icon-filter">Filtro</h2>
            </div>
            <div class="col-6">
                <h2 class="text-front" style="text-align: end;"><?= $typeFront = ($type === 'Aluguel') ? 'Alugar' : 'Comprar';
                                                                ?></h2>

                <!-- <h2 class="text-front"></h2> -->
            </div>
            <div class="col-12 col-md-4">
                <form action="<?= url("/propertySearch"); ?>" class="row form-inline w-100" method="post"
                    enctype="multipart/form-data">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?= csrf_input(); ?>
                    <!--ACTION SPOOFING-->
                    <input type="hidden" name="action" value="filter" />
                    <input type="hidden" name="typePage" value="<?= $type; ?>" />
                    <div class="row">

                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Categorias</b></label>
                            <select name="category[]" id="search" class="selectpicker" title="Escolha..." multiple
                                data-actions-box="true">>
                                <?php foreach ($category as $c) : ?>
                                <option value="<?= $c->id; ?>"><?= $c->category; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Tipo</b></label>
                            <select name="type[]" id="search" class="selectpicker" title="Escolha..." multiple
                                data-actions-box="true">>
                                <?php foreach ($typesProperties as $t) : ?>
                                <option value="<?= $t->id; ?>"><?= $t->type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Localidade</b></label>
                            <select name="locality[]" id="search" class="selectpicker" title="Escolha..." multiple
                                data-actions-box="true">
                                <?php foreach ($addresses as $a) : ?>
                                <option value="<?= $a->city; ?>"><?= $a->city; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Características</b></label>
                            <select name="features[]" id="search" class="selectpicker" title="Escolha..." multiple
                                data-actions-box="true">
                                <?php foreach ($features as $f) : ?>
                                <option value="<?= $f->id; ?>"><?= $f->feature; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- filtros avancados -->
                        <!-- <div class="row advanced_filter mt-2">
                            <span><small class="text-front">Filtros Avançados</small></span>
                            <?php
                            for ($i = 0; $i < 4; $i++) {   ?>
                                <div class="form-group col-12 ">
                                    <label for="search" class="mb-2 text-front">Comprar ou Alugar?</label>
                                    <select name="search" id="search" class="selectpicker" title="Escolha...">
                                        <option value=" ">Comprar</option>
                                        <option value=" ">Alugar</option>
                                    </select>
                                </div>
                            <?php
                            }
                            ?>
                        </div> -->

                        <div class="col-12  mt-3 text-end">
                            <!-- <a class="btn btn-front advanced_hidden">Filtro Avançado &darr;</a> -->
                            <!-- <a href="<?= url("/pesquisa"); ?>">sas</a> -->
                            <button class="btn btn-front icon-search" type="reset">Reset</button>
                            <button class="btn btn-front icon-search">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-8">
                <section class="main_properties">
                    <div class="container">
                        <div class="row">
                            <?php if ($propertieTransactions) : ?>
                            <?php foreach ($propertieTransactions as $key) : ?>
                            <article class="col-12 col-md-6 col-lg4 mb-4">
                                <div class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <?php $propertiImage = ($key->path ? image($key->path, 1280) : theme("/assets/images/semImagem.png", CONF_VIEW_THEME)); ?>
                                        <img src="<?= $propertiImage; ?>">
                                    </div>

                                    <div class="card-body">
                                        <h2 class="main_properties_item_title text-front"><span
                                                class="reference"><?= $key->reference; ?> -</span> Linda Casa no
                                            <?= $key->district ?> </h2>
                                        <p class="main_properties_item_category">Imóvel
                                            <?= $key->category; ?></p>
                                        <p class="main_properties_item_type"><?= $key->Type; ?> -
                                            <?= $key->city ?>-<?= $key->state ?> <i
                                                class="icon-icon-location-arrow"></i></p>
                                        <p class="main_properties_item_price text-front">R$
                                            <?= str_price($key->value); ?></p>
                                        <a href="<?= url("/propriedades/{$key->properties_id}"); ?>"
                                            class="btn btn-front w-100">Ver
                                            Imóvel</a>
                                    </div>
                                </div>
                            </article>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <div class="modal_aviso">
                                <h1>Desculpe, não há imóveis disponíveis para anunciar no momento.</h1>
                            </div>
                            <?php endif; ?>
                        </div>


                    </div>
                </section>
            </div>
        </section>
    </div>
</div>