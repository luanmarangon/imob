<?php $v->layout("_theme"); ?>

<div class="main_filter light py-5">
    <div class="container">
        <section class="row">
            <div class="col-12">
                <h2 class="text-front">Destaques</h2>
                <hr>
            </div>


            <div class="col-12">
                <section class="main_properties">
                    <div class="container">
                        <div class="row">
                            <?php if ($emphasis) : ?>
                                <?php foreach ($emphasis as $key) : ?>
                                    <article class="col-12 col-md-6 col-lg4 mb-4">
                                        <div class="card main_properties_item">
                                            <div class="img-responsive-16by9 image-container">
                                                <?php $propertiImage = ($key->path ? image($key->path, 1280) : theme("/assets/images/semImagem.png", CONF_VIEW_THEME)); ?>
                                                <!-- <div class="overlay ">Teste</div> -->
                                                <div class="overlay property-highlight <?= $key->type === 'Venda' ? 'sale' : 'rent' ?>"></div>
                                                <img src="<?= $propertiImage; ?>">
                                            </div>

                                            <div class="card-body">
                                                <h2 class="main_properties_item_title text-front"><span class="reference"><?= $key->reference; ?> -</span> Linda Casa no
                                                    <?= $key->district ?> </h2>
                                                <p class="main_properties_item_category">Imóvel
                                                    <?= $key->category; ?></p>
                                                <p class="main_properties_item_type"><?= $key->Type; ?> -
                                                    <?= $key->city ?>-<?= $key->state ?> <i class="icon-icon-location-arrow"></i></p>
                                                <p class="main_properties_item_price text-front">R$
                                                    <?= str_price($key->value); ?> </p>


                                                <a href="<?= url("/propriedades/{$key->properties_id}"); ?>" class="btn btn-front w-100">Ver
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