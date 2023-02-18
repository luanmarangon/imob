<?php $v->layout("_theme"); ?>

<div class="main_slide d-none d-md-block">
    <div class="container" style="height: 100%;">
        <div class="row align-items-center" style="height: 100%;">
            <div class="col-8">
                <p class="main_slide_content">Encontre o <b>imóvel ideal</b> para você e <b>sua família</b> morar na
                    praia!</p>
                <a href="#" class="btn btn-front btn-lg">Quero <b>Alugar</b></a>
                <a href="#" class="btn btn-front btn-lg">Quero <b>Comprar</b></a>
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
                        <select name="search" id="search" class="selectpicker" title="Escolha..." multiple data-actions-box="true">
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
            <a href="<?= url("/filtro"); ?>" class="text-front">Ver mais</a>
        </div>
        <div class="row">

            <?php
            for ($venda = 0; $venda < 4; $venda++) {

            ?>

                <article class="col-12 col-md-6 col-lg4 mb-4">
                    <div class="card main_properties_item">

                        <div class="img-responsive-16by9">
                            <a href="#"><img src="<?= theme("/assets/images/properties/1/1.jpg"); ?>" class="card-img-top" alt=""></a>
                        </div>

                        <div class="card-body">
                            <h2 class="main_properties_item_title"><a href="<?= url("/propriedades"); ?>"><span class="reference"><?= CONF_IMOVEL_TEST; ?></span> - Linda Casa no Campeche</a></h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Apartamento - Campeche <i class="icon-icon-location-arrow"></i></p>
                            <p class="main_properties_item_price text-front">R$ 400.000,00</p>
                            <a href="#" class="btn btn-front w-100">Ver Imóvel</a>
                        </div>

                        <div class="card-footer d-flex text-muted">
                            <div class="col-4 main_properties_item_features text-center">
                                <img src="<?= theme("/assets/images/icons/bed.png"); ?>" class="img-fluid" alt="">
                                <p class="text-muted">1</p>
                            </div>
                            <div class="col-4 main_properties_item_features text-center">
                                <img src=" <?= theme("/assets/images/icons/garage.png"); ?>" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>
                            <div class="col-4 main_properties_item_features text-center">
                                <img src="<?= theme("/assets/images/icons/util-area.png"); ?>" class="img-fluid" alt="">
                                <p class="text-muted">180m²</p>
                            </div>
                        </div>

                    </div>
                </article>

            <?php
            }
            ?>

        </div>
    </div>
</section>

<section class="main_properties py-5 light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
            <h1 class="text-front">Para Alugar</h1>
            <a href="<?= url("/filtro"); ?>" class="text-front">Ver mais</a>
        </div>
        <div class="row">

            <?php
            for ($alugar = 0; $alugar < 4; $alugar++) {

            ?>

                <article class="col-12 col-md-6 col-lg4 mb-4">
                    <div class="card main_properties_item">

                        <div class="img-responsive-16by9">
                            <a href="#"><img src="<?= theme("/assets/images/properties/4/3d656134-3760-4c9a-af1a-503301acc0be.jpg"); ?>" class="card-img-top" alt=""></a>
                        </div>

                        <div class="card-body">
                            <h2 class="main_properties_item_title"><a href="<?= url("/propriedades"); ?>"><span class="reference"><?= CONF_IMOVEL_TEST; ?></span> - Lindo Apartamento em São
                                    Paulo</a></h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Apartamento - Campeche <i class="icon-icon-location-arrow"></i></p>
                            <p class="main_properties_item_price text-front">R$ 2.000,00/mês</p>
                            <a href="#" class="btn btn-front w-100">Ver Imóvel</a>
                        </div>

                        <div class="card-footer d-flex text-muted">
                            <div class="col-4 main_properties_item_features text-center">
                                <img src="<?= theme("/assets/images/icons/bed.png"); ?>" class="img-fluid" alt="">
                                <p class="text-muted">1</p>
                            </div>
                            <div class="col-4 main_properties_item_features text-center">
                                <img src=" <?= theme("/assets/images/icons/garage.png"); ?>" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>
                            <div class="col-4 main_properties_item_features text-center">
                                <img src="<?= theme("/assets/images/icons/util-area.png"); ?>" class="img-fluid" alt="">
                                <p class="text-muted">180m²</p>
                            </div>
                        </div>

                    </div>
                </article>

            <?php
            }
            ?>
        </div>
    </div>
</section>