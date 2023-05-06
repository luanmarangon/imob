<?php $v->layout("_theme"); ?>

<div class="main_filter light py-5">
    <div class="container">
        <section class="row">
            <div class="col-6">
                <h2 class="text-front icon-filter">Filtro</h2>
            </div>
            <div class="col-6">
                <h2 class="text-front" style="text-align: end;"><?= $type; ?></h2>
                <!-- <h2 class="text-front"></h2> -->
            </div>
            <div class="col-12 col-md-4">
                <form action="" class="row w-100 bg-white p-3 mb-5">


                    <div class="row">
                        <?php
                        for ($i = 0; $i < 2; $i++) {   ?>
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
                        <?php
                        for ($i = 0; $i < 2; $i++) {   ?>
                        <div class="form-group col-12 ">
                            <label for="search" class="mb-2 text-front">Comprar ou Alugar?</label>
                            <select name="search" id="search" class="selectpicker" title="Escolha..." multiple
                                data-actions-box="true">
                                <option value=" ">Comprar</option>
                                <option value=" ">Alugar</option>
                            </select>
                        </div>
                        <?php
                        }
                        ?>
                        <!-- filtros avancados -->
                        <div class="row advanced_filter mt-2">
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
                        </div>

                        <div class="col-12  mt-3 text-end">
                            <a class="btn btn-front advanced_hidden">Filtro Avançado &darr;</a>
                            <button class="btn btn-front icon-search">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-8">
                <section class="main_properties">
                    <div class="container">
                        <div class="row">
                            <!-- <?= var_dump($properties); ?> -->
                            <?php foreach ($properties as $properti) : ?>
                            <?php if ($properti->transactionsProperties($properti->id)->type == $data) : ?>
                            <article class="col-12 col-md-6 col-lg4 mb-4">
                                <div class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <?php if (!empty($properti->imagesProperties($properti->id)->path)) : ?>
                                        <img src="<?= image($properti->imagesProperties($properti->id)->path, 1280); ?>"
                                            class="card-img-top"
                                            alt="<?= $properti->imagesProperties($properti->id)->identification; ?>"
                                            title="<?= $properti->imagesProperties($properti->id)->identification; ?>">
                                        <?php else : ?>
                                        <img src="<?= theme("/assets/images/semImagem.png"); ?>" width="500px"
                                            class="card-img-top" alt="Sem Imagem" title="Sem Imagem">
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-body">
                                        <h2 class="main_properties_item_title text-front"><span
                                                class="reference"><?= $properti->reference; ?> -</span> Linda Casa no
                                            <?= $properti->address()->district ?> </h2>
                                        <p class="main_properties_item_category">Imóvel
                                            <?= $properti->category()->category; ?></p>
                                        <p class="main_properties_item_type"><?= $properti->type()->type; ?> -
                                            <?= $properti->address()->city ?>-<?= $properti->address()->state ?> <i
                                                class="icon-icon-location-arrow"></i></p>
                                        <p class="main_properties_item_price text-front">R$
                                            <?= str_price($properti->transactionsProperties($properti->id)->value); ?>
                                        </p>
                                        <a href="<?= url("/propriedades/{$properti->id}"); ?>"
                                            class="btn btn-front w-100">Ver
                                            Imóvel</a>
                                    </div>


                                    <div class="card-footer d-flex text-muted">
                                        <?php foreach ($propertiComfortable as $propertiComfor) : ?>
                                        <?php if ($propertiComfor->properties_id == $properti->id) : ?>
                                        <?php if ($propertiComfor->comfortable()->convenient == "Quarto" || $propertiComfor->comfortable()->convenient == "Garage") : ?>
                                        <?php if (!empty($propertiComfor->quantity)) : ?>
                                        <div class="col-4 main_properties_item_features text-center">
                                            <img src="<?= theme("/assets/images/icons/{$propertiComfor->comfortable()->convenient}.png"); ?>"
                                                class="img-fluid"
                                                alt="<?= $propertiComfor->comfortable()->convenient; ?>">
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
                                            <img src="<?= theme("/assets/images/icons/util-area.png"); ?>"
                                                class="img-fluid" alt="">
                                            <p class="text-muted"><?= $structures->footage; ?></p>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </article>
                            <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>