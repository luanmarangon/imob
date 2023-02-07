<?php $v->layout("_theme"); ?>

<div class="main_filter light py-5">
    <div class="container">
        <section class="row">
            <div class="col-12">
                <h2 class="text-front icon-filter">Filtro</h2>
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
                                <select name="search" id="search" class="selectpicker" title="Escolha..." multiple data-actions-box="true">
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

                            <?php
                            for ($venda = 0; $venda < 4; $venda++) {
                            ?>
                                <article class="col-12 col-md-12 col-lg-6 mb-4">
                                    <div class="card main_properties_item">

                                        <div class="img-responsive-16by9">
                                            <a href="#"><img src="<?= theme("/assets/images/properties/1/1.jpg");?>" class="card-img-top" alt=""></a>
                                        </div>

                                        <div class="card-body">
                                            <h2><a href="#" class="text-front">Linda Casa no Campeche</a></h2>
                                            <p class="main_properties_item_category">Imóvel Residencial</p>
                                            <p class="main_properties_item_type">Apartamento - Campeche <i class="icon-icon-location-arrow"></i></p>
                                            <p class="main_properties_item_price text-front">R$ 400.000,00</p>
                                            <a href="#" class="btn btn-front w-100">Ver Imóvel</a>
                                        </div>

                                        <div class="card-footer d-flex text-muted">
                                            <div class="col-4 main_properties_item_features text-center">
                                                <img src="<?= theme("/assets/images/icons/bed.png");?>" class="img-fluid" alt="">
                                                <p class="text-muted">1</p>
                                            </div>
                                            <div class="col-4 main_properties_item_features text-center">
                                                <img src="<?= theme("/assets/images/icons/garage.png");?>" class="img-fluid" alt="">
                                                <p class="text-muted">4</p>
                                            </div>
                                            <div class="col-4 main_properties_item_features text-center">
                                                <img src="<?= theme("/assets/images/icons/util-area.png");?>" class="img-fluid" alt="">
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
            </div>
        </section>
    </div>
</div>