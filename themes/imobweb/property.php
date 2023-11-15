<?php $v->layout("_theme"); ?>

<div class="main_property">
    <div class="main_property_header light py-5">
        <div class="container">
            <h1 class="text-front"><small class="reference"><?= $properti->reference; ?></small> - Lindo imóvel
                localizado no <?= $properti->address()->district; ?></h1>
            <p class="mb-0">Imóvel <?= $properti->category()->category; ?> - <?= $properti->type()->type; ?> -
                <?= $properti->address()->city ?>-<?= $properti->address()->state ?>
            </p>
        </div>
    </div>

    <div class="main_property_content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- Carousel Slide -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <?php if ($imagesCount) : ?>
                            <div class="carousel-indicators">
                                <?php for ($i = 0; $i < $imagesCount; $i++) : ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i; ?>" class="active" aria-current="true" aria-label="<?= $i; ?>"></button>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                        <div class="carousel-inner">
                            <?php if (!empty($propertiesImages)) : ?>
                                <?php foreach ($propertiesImages as $images) : ?>
                                    <div class="carousel-item active">
                                        <img src="<?= image($images->path, 1280); ?>" class="d-block w-100" alt="<?= $images->identification; ?>" title="<?= $images->identification; ?>">
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="carousel-item active">
                                    <img src="<?= theme("/assets/images/semImagem.png"); ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Proximo</span>
                        </button>
                    </div>
                    <!-- FIM Carousel Slide -->
                    <div class="main_property_content_price text-muted pt-4">
                        <?php if ($propertiTributes) : ?>
                            <?php foreach ($propertiTributes as $key) : ?>
                                <p class="main_property_content_price_small"><?= $key->findTribute($key->charges_id)->charge; ?>: <?= $key->value; ?>/<?= $key->exercise; ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>


                        <!-- <p class="main_property_content_price_small">IPTU: <?= $propertiTributes ? $propertiTributes : "Não Informado"; ?></p> -->



                        <p class="main_property_content_price_big">Valor de
                            <?= $properti->transactionsProperties($properti->id)->type; ?>:
                            R$
                            <?= $properti->transactionsProperties($properti->id)->value; ?><?= $properti->transactionsProperties($properti->id)->type === "Aluguel" ? "/ mês" : ""; ?>
                        </p>
                    </div>

                    <div class="main_property_content_description">
                        <h2 class="text-front">Conheça mais o imóvel</h2>
                        <?php if ($properti->description) : ?>
                            <p>
                                <?= $properti->description; ?>
                            </p>
                        <?php else : ?>
                            <p>
                                Lindo imóvel <?= $properti->category()->category; ?>, localizado no bairro
                                <?= $properti->address()->district; ?>, na cidade de
                                <?= $properti->address()->city ?>-<?= $properti->address()->state ?>
                            </p>
                        <?php endif; ?>
                        <p>
                            Esperamos que essas informações ajudem a conhecer melhor o imóvel e a decidir se ele atende
                            às suas necessidades
                            e expectativas. Caso haja alguma dúvida ou informação adicional que gostaria de saber, por
                            favor,
                            não hesite em entrar em contato.
                        </p>
                    </div>
                    <!-- Comodos  -->
                    <div class="main_property_content_features">
                        <h2 class="text-front">Cômodos do imóvel</h2>
                        <?php if ($propertiComfortable) : ?>
                            <?php foreach ($propertiComfortable as $comfortable) : ?>
                                <table class="table">
                                    <tbody class="table-dark">
                                        <tr>
                                            <td class="property-table-td"><?= $comfortable->comfortable()->convenient; ?>
                                            </td>
                                            <td class=""><?= $comfortable->quantity; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="modal_aviso">
                                <p>No momento não possuímos informações disponíveis. Por favor, verifique novamente mais
                                    tarde.</p>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="main_property_content_structure">
                        <h2 class="text-front">Características do imóvel</h2>
                        <?php if ($propertiFeatures) : ?>
                            <?php foreach ($propertiFeatures as $features) : ?>
                                <!-- <?php if ($features->properties_id === $properti->id) : ?> -->
                                <div class="d-flex">
                                    <div class="main_property_content_structure_item icon-check">
                                        <?= $features->features()->feature; ?>
                                    </div>
                                </div>
                                <!-- <?php endif; ?> -->
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="modal_aviso">
                                <p>No momento não possuímos informações disponíveis. Por favor, verifique novamente mais
                                    tarde.</p>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="main_property_content_structure">
                        <h2 class="text-front">Estrutura</h2>
                        <?php if ($propertiStructures) : ?>
                            <!-- <?php var_dump($propertiStructures); ?> -->
                            <?php foreach ($propertiStructures as $structures) : ?>
                                <!-- <?php if ($structures->properties_id === $properti->id) : ?> -->
                                <div class="d-flex">
                                    <div class="main_property_content_structure_item icon-check">
                                        <?= $structures->structures()->structure; ?></div>
                                    <div class="main_property_content_structure_item icon-check">
                                        <?= $structures->footage; ?>
                                    </div>
                                </div>
                                <!-- <?php endif; ?> -->
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="modal_aviso">
                                <p>No momento não possuímos informações disponíveis. Por favor, verifique novamente mais
                                    tarde.</p>
                            </div>
                        <?php endif; ?>


                    </div>

                    <div class="main_property_content_location">
                        <h2 class="text-front">Localização</h2>
                        <hr>
                        <?php if ($properti->address()->latitude && $properti->address()->longitude) : ?>
                            <input type="hidden" id="latitude" value="<?= $properti->address()->latitude ?>">
                            <input type="hidden" id="longitute" value="<?= $properti->address()->longitude ?>">
                            <div class="main_property_content_location_maps" id="map"></div>
                        <?php else : ?>
                            <div class="modal_aviso">
                                <p>No momento não possuímos informações disponíveis. Por favor, verifique novamente mais
                                    tarde.</p>
                            </div>
                        <?php endif; ?>
                    </div>




                </div>
                <di class="col-12 col-lg-4">

                    <a href="https://api.whatsapp.com/send?phone=<?= CONF_COMPANY_ATTENDANCE_WHATS; ?>&text=<?= CONF_COMPANY_ATTENDANCE_MENSAGE; ?> <?= $properti->reference; ?>" target="_blank" class="btn btn-success btn-lg icon-whatsapp mb-3 w-100">Converse com um
                        Corretor</a>

                    <div class="main_property_contact">
                        <h2 class="bg-front text-white">Entre em Contato</h2>
                        <form action="<?= url("/interest"); ?>" method="post">
                            <div class="ajax_response"><?= flash(); ?></div>
                            <?= csrf_input(); ?>
                            <input type="hidden" name="reference" value="<?= $properti->reference; ?>">
                            <input type="hidden" name="transaction" value="<?= $properti->transactionsProperties($properti->id)->id; ?>">
                            <div class="form-group">
                                <label for="">Seu Nome:</label>
                                <input type="text" name="name" class="form-control" placeholder="Informe seu nome completo" required>
                            </div>
                            <div class="form-group">
                                <label for="">Seu Telefone:</label>
                                <input type="text" name="phone" class="form-control mask-phone" placeholder="Informe seu telefone com DDD" required>
                            </div>
                            <div class="form-group">
                                <label for="">Seu E-mail:</label>
                                <input type="email" name="email" class="form-control mask-email" placeholder="Informe seu melhor e-mail" required>
                            </div>
                            <div class="form-group">
                                <label for="">Sua Mensagem:</label>
                                <textarea rows="5" name="message" class="form-control">Quero ter mais informações sobre este imóvel. Imóvel <?= $properti->category()->category; ?> - <?= $properti->type()->type; ?> - <?= $properti->address()->city ?>/<?= $properti->address()->state ?> (#<?= $properti->reference ?>)</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-front w-100 mt-3">Enviar</button>
                                <p class="text-front text-center mt-2">+55 (99) 3322-4569</p>
                            </div>
                        </form>
                    </div>

                    <div class="main_property_share mt-3 text-center">
                        <a href="https://www.facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE; ?>" target="_blank" class="btn btn-front icon-facebook icon-notext"></a>
                        <a href="https://twitter.com/<?= CONF_SOCIAL_TWITTER_CREATOR; ?>" target="_blank" class="btn btn-front icon-twitter icon-notext"></a>
                        <a href="https://www.instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>" target="_blank" class="btn btn-front icon-instagram icon-notext"></a>
                    </div>
                </di>
            </div>
        </div>
    </div>
</div>