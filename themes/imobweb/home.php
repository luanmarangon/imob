<?php
$v->layout("_theme"); ?>

<div class="main_slide d-none d-md-block">
    <div class="container" style="height: 100%;">
        <div class="row align-items-center" style="height: 100%;">
            <div class="col-8">
                <p class="main_slide_content">Encontre o <b>imóvel ideal</b> para você e <b>sua família</b> morar com
                    <b>tranquilidade</b> e <b>segurança</b>
                </p>
                <a href="<?= url("/filtro/Aluguel"); ?>" class="btn btn-front btn-lg">Quero <b>Alugar</b></a>
                <a href="<?= url("/filtro/Venda"); ?>" class="btn btn-front btn-lg">Quero <b>Comprar</b></a>
            </div>
        </div>
    </div>
</div>

<div class="main_filter">
    <div class="container my-5">
        <div>
            <form action="#" class="row form-inline w-100" method="post" enctype="multipart/form-data">

                <?php
                for ($i = 0; $i < 2; $i++) {   ?>
                <div class="form-group col-12 col-sm-6 col-lg-3">
                    <label for="search" class="mb-2"><b>Comprar ou Alugar?</b></label>
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
                <div class="form-group col-12 col-sm-6 col-lg-3">
                    <label for="search" class="mb-2"><b>Tipo?</b></label>
                    <select name="search" id="search" class="selectpicker" title="Escolha..." multiple
                        data-actions-box="true">
                        <option value=" ">Comprar</option>
                        <option value=" ">Alugar</option>
                    </select>
                </div>
                <?php
                }
                ?>
                <div class="col-6 mt-3">
                    <!-- <a href="#" class="text-front advanced_filter_btn">Filtro Avançado &darr;</a> -->
                    <a class="btn btn-front advanced_hidden mb-2">Filtro Avançado &darr;</a>
                </div>

                <!-- filtros avancados -->
                <div class="row form-inline w-100 advanced_filter">
                    <hr>
                    <?php
                    for ($i = 0; $i < 4; $i++) {   ?>
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="search" class="mb-2"><b>Comprar ou Alugar?</b></label>
                        <select name="search" id="search" class="selectpicker" title="Escolha...">
                            <option value=" ">Comprar</option>
                            <option value=" ">Alugar</option>
                        </select>
                    </div>
                    <?php
                    }
                    ?>
                </div>


                <div class="col-6 mt-3 text-end">
                    <button class="btn btn-front icon-search" type="submit">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <section>
    <div class="main_list_group py-5 light">
        <div class="container">
            <div class="p-4 border-bottom border-front">
                <h1 class="text-center">Ambiente no seu <span class="text-front"><b>estilo</b></span></h1>
                <p class="text-center text-muted h4">Encontre o imóvel com a experiência que você quer viver</p>
            </div>

            <div class=" main_list_group_items mt-5 d-flex justify-content-around row">
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center cobertura">
                            <h2>Cobertura</h2>
                        </div>
                    </a>
                </article>
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center" style="background: url('themes/assets/images/home/alto_padrao_1.jpg') no-repeat; background-size: cover;">
                            <h2>Alto Padrão</h2>
                        </div>
                    </a>
                </article>
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center" style="background: url('themes/assets/images/home/de_frente_pro_mar_original.jpg') no-repeat; background-size: cover;">
                            <h2>De Frente para o Mar</h2>
                        </div>
                    </a>
                </article>
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center" style="background: url('themes/assets/images/home/condominio_fechado_1.jpg') no-repeat; background-size: cover;">
                            <h2>Condominio Fechado</h2>
                        </div>
                    </a>
                </article>
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center" style="background: url('themes/assets/images/home/compacto_1.jpg') no-repeat; background-size: cover;">
                            <h2>Compacto</h2>
                        </div>
                    </a>
                </article>
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center" style="background: url('themes/assets/images/home/sala_comercial_original.jpg') no-repeat; background-size: cover;">
                            <h2>Lojas e Salas</h2>
                        </div>
                    </a>
                </article>
            </div>
        </div>
    </div>
</section> -->

<section class="main_properties py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
            <h1 class="text-front">À Venda</h1>
            <a href="<?= url("/filtro/Venda"); ?>" class="text-front">Ver mais</a>
        </div>
        <div class="row">


            <?php foreach ($properties as $properti) : ?>
            <?php if ($properti->transactionsProperties($properti->id)->type == "Venda") : ?>
            <article class="col-12 col-md-6 col-lg4 mb-4">
                <div class="card main_properties_item">
                    <div class="img-responsive-16by9">
                        <?php if (!empty($properti->imagesProperties($properti->id)->path)) : ?>
                        <img src="<?= image($properti->imagesProperties($properti->id)->path, 1280); ?>"
                            class="card-img-top"
                            alt="<?= $properti->imagesProperties($properti->id)->identification; ?>"
                            title="<?= $properti->imagesProperties($properti->id)->identification; ?>">
                        <?php else : ?>
                        <img src="<?= image("images/semImagem.png", 1280); ?>" class="card-img-top" alt="Sem Imagem"
                            title="Sem Imagem">
                        <!-- <img src="<?= theme("/assets/images/semImagem.png"); ?>" class="card-img-top" alt="Sem Imagem"
                            title="Sem Imagem"> -->


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
                            <?= str_price($properti->transactionsProperties($properti->id)->value); ?></p>
                        <a href="<?= url("/propriedades/{$properti->id}"); ?>" class="btn btn-front w-100">Ver
                            Imóvel</a>
                    </div>


                    <div class="card-footer d-flex text-muted">
                        <?php foreach ($propertiComfortable as $propertiComfor) : ?>
                        <?php if ($propertiComfor->properties_id == $properti->id) : ?>
                        <?php if ($propertiComfor->comfortable()->convenient == "Quarto" || $propertiComfor->comfortable()->convenient == "Garage") : ?>
                        <?php if (!empty($propertiComfor->quantity)) : ?>
                        <div class="col-4 main_properties_item_features text-center">
                            <img src="<?= theme("/assets/images/icons/{$propertiComfor->comfortable()->convenient}.png"); ?>"
                                class="img-fluid" alt="<?= $propertiComfor->comfortable()->convenient; ?>">
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

        </div>
    </div>
</section>

<section class="main_properties py-5 light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
            <h1 class="text-front">Para Alugar</h1>
            <a href="<?= url("/filtro/Aluguel"); ?>" class="text-front">Ver mais</a>
        </div>
        <div class="row">

            <?php foreach ($properties as $properti) : ?>
            <?php if ($properti->transactionsProperties($properti->id)->type == "Aluguel") : ?>
            <article class="col-12 col-md-6 col-lg4 mb-4">
                <div class="card main_properties_item">
                    <div class="img-responsive-16by9">
                        <?php if (!empty($properti->imagesProperties($properti->id)->path)) : ?>
                        <img src="<?= image($properti->imagesProperties($properti->id)->path, 1280); ?>"
                            class="card-img-top"
                            alt="<?= $properti->imagesProperties($properti->id)->identification; ?>"
                            title="<?= $properti->imagesProperties($properti->id)->identification; ?>">
                        <?php else : ?>
                        <img src="<?= theme("/assets/images/semImagem.png"); ?>" width="500px" class="card-img-top"
                            alt="Sem Imagem" title="Sem Imagem">
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
                            <?= str_price($properti->transactionsProperties($properti->id)->value); ?></p>
                        <a href="<?= url("/propriedades/{$properti->id}"); ?>" class="btn btn-front w-100">Ver
                            Imóvel</a>
                    </div>


                    <div class="card-footer d-flex text-muted">
                        <?php foreach ($propertiComfortable as $propertiComfor) : ?>
                        <?php if ($propertiComfor->properties_id == $properti->id) : ?>
                        <?php if ($propertiComfor->comfortable()->convenient == "Quarto" || $propertiComfor->comfortable()->convenient == "Garage") : ?>
                        <?php if (!empty($propertiComfor->quantity)) : ?>
                        <div class="col-4 main_properties_item_features text-center">
                            <img src="<?= theme("/assets/images/icons/{$propertiComfor->comfortable()->convenient}.png"); ?>"
                                class="img-fluid" alt="<?= $propertiComfor->comfortable()->convenient; ?>">
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


        </div>
    </div>
</section>


<!-- DIV de Homologação -->
<!-- <div style="border: 2px solid red">

                        <?= var_dump(
                            $properti->id,
                            $properti->imagesProperties($properti->id)->path,
                            $properti->imagesProperties($properti->id)->identification
                        ); ?>

                    </div> -->