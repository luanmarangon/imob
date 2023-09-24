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
                <!-- <form action="<?= url("/pesquisa"); ?>" method="post" class="row w-100 bg-white p-3 mb-5"> -->
                <form action="<?= url("/pesquisa"); ?>" method="POST">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?= csrf_input(); ?>

                    <!--ACTION SPOOFING-->
                    <input type="hidden" name="type" value="<?= $type; ?>" />

                    <div class="row">

                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Categorias</b></label>
                            <select name="category" id="search" class="selectpicker" title="Escolha..." value="all">
                                <?php foreach ($category as $c) : ?>
                                    <option value="<?= $c->id; ?>"><?= $c->category; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Tipo</b></label>
                            <select name="typeProperties[]" id="search" class="selectpicker" title="Escolha..." multiple data-actions-box="true">>
                                <?php foreach ($typesProperties as $t) : ?>
                                    <option value="<?= $t->id; ?>"><?= $t->type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Localidade</b></label>
                            <select name="location[]" id="search" class="selectpicker" title="Escolha..." multiple data-actions-box="true">
                                <?php foreach ($addresses as $a) : ?>
                                    <option value="<?= $a->city; ?>"><?= $a->city; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2"><b>Características</b></label>
                            <select name="feature[]" id="search" class="selectpicker" title="Escolha..." multiple data-actions-box="true">
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
                            <?php if ($transactionType) : ?>
                                <?php foreach ($transactionType as $t) : ?>
                                    <?php if ($t) : ?>
                                        <?php foreach ($properties as $properti) : ?>
                                            <?php if ($t->properties_id === $properti->id) : ?>
                                                <article class="col-12 col-md-6 col-lg4 mb-4">
                                                    <div class="card main_properties_item">
                                                        <div class="img-responsive-16by9">
                                                            <?php if (!empty($properti->imagesProperties($properti->id)->path)) : ?>
                                                                <img src="<?= image($properti->imagesProperties($properti->id)->path, 1280); ?>" class="card-img-top" alt="<?= $properti->imagesProperties($properti->id)->identification; ?>" title="<?= $properti->imagesProperties($properti->id)->identification; ?>">
                                                            <?php else : ?>
                                                                <img src="<?= theme("/assets/images/semImagem.png"); ?>" width="500px" class="card-img-top" alt="Sem Imagem" title="Sem Imagem">
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="card-body">
                                                            <h2 class="main_properties_item_title text-front"><span class="reference"><?= $properti->reference; ?> - </span>Imóvel no
                                                                <?= $properti->address()->district ?> </h2>
                                                            <p class="main_properties_item_category">Imóvel
                                                                <?= $properti->category()->category; ?></p>
                                                            <p class="main_properties_item_type"><?= $properti->type()->type; ?> -
                                                                <?= $properti->address()->city ?>-<?= $properti->address()->state ?> <i class="icon-icon-location-arrow"></i></p>
                                                            <p class="main_properties_item_price text-front">R$
                                                                <?= str_price($properti->transactionsProperties($properti->id)->value); ?>
                                                            </p>
                                                            <a href="<?= url("/propriedades/{$properti->id}"); ?>" class="btn btn-front w-100">Ver
                                                                Imóvel</a>
                                                        </div>


                                                        <div class="card-footer d-flex text-muted">
                                                            <?php foreach ($propertiComfortable as $propertiComfor) : ?>
                                                                <?php if ($propertiComfor->properties_id == $properti->id) : ?>
                                                                    <?php if ($propertiComfor->comfortable()->convenient == "Quarto" || $propertiComfor->comfortable()->convenient == "Garage") : ?>
                                                                        <?php if (!empty($propertiComfor->quantity)) : ?>
                                                                            <div class="col-4 main_properties_item_features text-center">
                                                                                <img src="<?= theme("/assets/images/icons/{$propertiComfor->comfortable()->convenient}.png"); ?>" class="img-fluid" alt="<?= $propertiComfor->comfortable()->convenient; ?>">
                                                                                <p class="text-muted">
                                                                                    <?= $propertiComfor->quantity; ?>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <?php foreach ($propertiStructures as $structures) : ?>
                                                                    <?php if ($structures->properties_id == $properti->id && $structures->structures()->structure == "Area Total") : ?>
                                                                        <div class="col-4 main_properties_item_features text-center">
                                                                            <img src="<?= theme("/assets/images/icons/util-area.png"); ?>" class="img-fluid" alt="">
                                                                            <p class="text-muted"><?= $structures->footage; ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </article>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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