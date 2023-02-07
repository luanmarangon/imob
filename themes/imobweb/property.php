<?php $v->layout("_theme"); ?>

<div class="main_property">
    <div class="main_property_header light py-5">
        <div class="container">
            <h1 class="text-front"><small class="reference"><?= CONF_IMOVEL_TEST;?></small> - Linda Casa no Rio Tavares com vista para o Mar</h1>
            <p class="mb-0">Imóvel Residencial - Apartamento - Campeche</p>
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
                            <div class="carousel-item active">
                                <img src="<?= theme("assets/images/properties/1/1.jpg"); ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="<?= theme("assets/images/properties/1/2.jpg"); ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="<?= theme("assets/images/properties/1/3.jpg"); ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="<?= theme("assets/images/properties/1/4.jpg"); ?>" class="d-block w-100" alt="...">
                            </div>

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
                        <p class="main_property_content_price_small">IPTU: R$ 100,00</p>
                        <p class="main_property_content_price_big">Valor de Aluguel: R$ 2.300,00/mês</p>
                    </div>

                    <div class="main_property_content_description">
                        <h2 class="text-front">Conheça mais o imóvel</h2>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Repudiandae, doloremque sint maiores deserunt, accusantium,
                            mollitia nisi autem possimus voluptatem sunt ducimus harum
                            nihil. Doloremque optio dolorum itaque voluptas alias
                            exercitationem!
                        </p>
                    </div>
                    <div class="main_property_content_features">
                        <h2 class="text-front">Características</h2>
                        <table class="table table-striped">
                            <tbody>
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                ?>
                                    <tr>
                                        <td>Caracteristica_1</td>
                                        <td>Quantidade_1</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="main_property_content_structure">
                        <h2 class="text-front">Estrutura</h2>
                        <?php
                        for ($i = 1; $i < 11; $i++) {
                        ?>

                            <button class="main_property_content_structure_item icon-check">Estrutura_<?= $i; ?></button>

                        <?php
                        }
                        ?>


                    </div>

                    <div class="main_property_content_location">
                        <h2 class="text-front">Localização</h2>
                        <!-- colocar a Localização -->
                    </div>




                </div>
                <di class="col-12 col-lg-4">

                    <a href="https://api.whatsapp.com/send?phone=<?= CONF_COMPANY_ATTENDANCE_WHATS; ?>&text=<?= CONF_COMPANY_ATTENDANCE_MENSAGE; ?> <?=CONF_IMOVEL_TEST;?>" target="_blank" class="btn btn-success btn-lg icon-whatsapp mb-3 w-100">Converse com um Corretor</a>

                    <div class="main_property_contact">
                        <h2 class="bg-front text-white">Entre em Contato</h2>
                        <form action="">
                            <div class="form-group">
                                <label for="">Seu Nome:</label>
                                <input type="text" class="form-control" placeholder="Informe seu nome completo">
                            </div>
                            <div class="form-group">
                                <label for="">Seu Telefone:</label>
                                <input type="text" class="form-control" placeholder="Informe seu telefone com DDD">
                            </div>
                            <div class="form-group">
                                <label for="">Seu E-mail:</label>
                                <input type="text" class="form-control" placeholder="Informe seu melhor e-mail">
                            </div>
                            <div class="form-group">
                                <label for="">Sua Mensagem:</label>
                                <textarea name="" rows="5" class="form-control">Quero ter mais informações sobre este imóvel. Imóvel Residencial - Apartamento - Campeche (#1)</textarea>
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