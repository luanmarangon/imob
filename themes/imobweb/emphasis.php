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
                            <?php foreach ($transactionProperties as $transaction) : ?>

                            <?php foreach ($properties as $properti) : ?>

                            <?php if ($transaction->properties_id === $properti->id) : ?>
                            <article class="col-12 col-md-4 col-lg4 mb-4">
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
                                                class="reference"><?= $properti->reference; ?> - </span>Imóvel no
                                            <?= $properti->address()->district ?> </h2>
                                        <p class="main_properties_item_category">Imóvel
                                            <?= $properti->category()->category; ?></p>
                                        <p class="main_properties_item_type"><?= $properti->type()->type; ?> -
                                            <?= $properti->address()->city ?>-<?= $properti->address()->state ?> <i
                                                class="icon-icon-location-arrow"></i></p>

                                        <div
                                            class="property-highlight <?= $transaction->type === 'Venda' ? 'sale' : 'rent' ?>">
                                        </div>

                                        <?php if (!empty($properti->transactionsProperties($properti->id)->value)) : ?>
                                        <p class="main_properties_item_price text-front">R$
                                            <?= str_price($properti->transactionsProperties($properti->id)->value); ?>
                                            <?= $properti->transactionsProperties($properti->id)->type === "Aluguel" ? "/ mês" : ""; ?>
                                        </p>
                                        <?php endif; ?>

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

                            <?php endforeach; ?>


                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>