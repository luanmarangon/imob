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
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
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

                    <div class="main_property_content_price text-muted pt-4">
                        <p class="main_property_content_price_small">IPTU:
                            <?= $propertiTributes ? str_price($propertiTributes) : "Não Informado"; ?></p>
                        <p class="main_property_content_price_big">Valor de
                            <?= $properti->transactionsProperties($properti->id)->type; ?>:
                            <?= str_price($properti->transactionsProperties($properti->id)->value); ?><?= $properti->transactionsProperties($properti->id)->type === "Aluguel" ? "/ mês" : ""; ?>
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
                    <div class="main_property_content_features">
                        <h2 class="text-front">Características</h2>
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($propertiComfortable as $comfortable) : ?>
                                    <tr>
                                        <td><?= $comfortable->comfortable()->convenient; ?>
                                        </td>
                                        <td><?= $comfortable->quantity; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="main_property_content_structure">
                        <h2 class="text-front">Estrutura</h2>


                        <?php foreach ($propertiStructures as $structures) : ?>
                            <!-- <div class="d-flex"> -->
                            <button class="main_property_content_structure_item icon-check"><?= $structures->structures()->structure; ?></button>
                            <!-- <label for=""><?= $structures->structures()->structure; ?> : </label> -->
                            <button class="main_property_content_structure_item icon-check"><?= $structures->footage; ?></button>
                            <!-- </div> -->
                        <?php endforeach; ?>

                    </div>

                    <div class="main_property_content_location">
                        <h2 class="text-front">Localização</h2>
                        <hr>
                        <input type="hidden" id="latitude" value="<?= $properti->address()->latitude ?>">
                        <input type="hidden" id="longitute" value="<?= $properti->address()->longitude ?>">
                        <div class="main_property_content_location_maps" id="map"></div>

                    </div>




                </div>
                <di class="col-12 col-lg-4">

                    <a href="https://api.whatsapp.com/send?phone=<?= CONF_COMPANY_ATTENDANCE_WHATS; ?>&text=<?= CONF_COMPANY_ATTENDANCE_MENSAGE; ?> <?= $properti->reference; ?>" target="_blank" class="btn btn-success btn-lg icon-whatsapp mb-3 w-100">Converse com um
                        Corretor</a>

                    <div class="main_property_contact">
                        <h2 class="bg-front text-white">Entre em Contato</h2>
                        <form action="">
                            <input type="hidden" name="" value="<?= $properti->reference; ?>">
                            <div class="form-group">
                                <label for="">Seu Nome:</label>
                                <input type="text" class="form-control" placeholder="Informe seu nome completo" required>
                            </div>
                            <div class="form-group">
                                <label for="">Seu Telefone:</label>
                                <input type="text" id="phone" class="form-control" placeholder="Informe seu telefone com DDD" required>
                            </div>
                            <div class="form-group">
                                <label for="">Seu E-mail:</label>
                                <input type="email" class="form-control" placeholder="Informe seu melhor e-mail" required>
                            </div>
                            <div class="form-group">
                                <label for="">Sua Mensagem:</label>
                                <textarea name="" rows="5" class="form-control">Quero ter mais informações sobre este imóvel. Imóvel <?= $properti->category()->category; ?> - <?= $properti->type()->type; ?> - <?= $properti->address()->city ?>/<?= $properti->address()->state ?> (#<?= $properti->reference ?>)</textarea>
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