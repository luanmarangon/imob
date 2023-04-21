<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $head; ?>
    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png"); ?>" />
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>" />
</head>

<body>
    <!--HEADER-->
    <header class="main_header">
        <div class="header-bar bg-front">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="d-none d-lg-flex col-lg-4 justify-content-center align-items-center p-2 text-white">
                        <i class="icon-location-arrow"></i>
                        <p class="my-auto ml-3">
                            <?= CONF_SITE_ADDR_STREET . ", " . CONF_SITE_ADDR_NUMBER . " - " . CONF_SITE_ADDR_DISTRICT; ?>
                            <br><?= CONF_SITE_ADDR_CITY . "/" . CONF_SITE_ADDR_STATE; ?>
                        </p>
                    </div>
                    <div class="d-none d-md-flex col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-white">
                        <i class="icon-clock-o"></i>
                        <p class="my-auto ml-3">
                            <?= CONF_COMPANY_ATTENDANCE_WEEK . ": " . CONF_COMPANY_ATTENDANCE_WEEK_TIME; ?>
                            <br><?= CONF_COMPANY_ATTENDANCE_WEEKEND . ": " . CONF_COMPANY_ATTENDANCE_WEEKEND_TIME; ?>
                        </p>
                    </div>
                    <div class="d-flex col-4 col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-white">
                        <i class="icon-envelope"></i>
                        <p class="my-auto ml-3"><a class="text-white" href="mailto:<?= CONF_COMPANY_ATTENDANCE_MAIL; ?>"><?= CONF_COMPANY_ATTENDANCE_MAIL; ?></a></br><a class="text-white" href="tel:<?= CONF_COMPANY_ATTENDANCE_PHONE; ?>"><?= CONF_COMPANY_ATTENDANCE_PHONE; ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NAV -->
        <nav class="navbar navbar-expand-md navbar-ligth my-3">
            <div class="container">
                <div class="navbar-brand">
                    <a href="<?= url("/"); ?>">
                        <h1 class="d-none">Imobiliária</h1>
                        <img src="<?= theme("assets/images/logo.png"); ?>" alt="" class="d-inline-block" width="280">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= url("/"); ?>">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-front" aria-current="page" href="<?= url("/destaques"); ?>">Destaque</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= url("/filtro/Aluguel"); ?>">Alugar</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= url("/filtro/Venda"); ?>">Comprar</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= url("/contato"); ?>">Contato</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <!--CONTENT-->
    <main class="main_content">
        <?= $v->section("content"); ?>
    </main>

    <!--OPTIN-->
    <article class="main_optin bg-dark text-white py-5">
        <div class="container">
            <div class="row mx-auto" style="max-width: 600px;">
                <h1>Quer ficar por dentro das novidades?</h1>
                <p>Deixe seu nome e seu melhor e-mail nos campos abaixo e nós vamos lhe informar sobre os melhores
                    negócios de todos os lançamentos do sul da ilha</p>

                <form action="#">
                    <input type="text" class="form-control" placeholder="Digite seu nome" size="50">
                    <input type="email" class="form-control" placeholder="Digite seu melhor e-mail" size="50">
                    <input type="tel" class="form-control" placeholder="Digite seu whatsapp" size="50">
                    <button type="submit" class="btn btn-front">Me Avise</button>
                </form>
            </div>
        </div>
    </article>

    <!--FOOTER-->
    <section class="main_footer bg-light" style="background: url(assets/images/footer.png) repeat-x bottom center; background-size: 10%;">
        <div class="container pt-5" style="padding-bottom: 120px;">
            <div class="row justify-content-around text-muted">
                <div class="col-12 col-md-3 col-lg-3">
                    <h1 class="pb-2">Navegue <span class="text-front">Aqui!</span></h1>
                    <ul>
                        <li><a href="<?= url("/"); ?>">Home</a></li>
                        <li><a href="<?= url("/destaques"); ?>" class="text-front">Destaque</a></li>
                        <li><a href="<?= url("/filtro/Aluguel"); ?>">Alugar</a></li>
                        <li><a href="<?= url("/filtro/Venda"); ?>">Comprar</a></li>
                        <li><a href="<?= url("/contato"); ?>">Contato</a></li>
                        <li><a href="<?= url("/termos"); ?>">Termos de Uso</a></li>
                        <li><a href="<?= url("/admin/login"); ?>">Login</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-9 col-lg-6">
                    <h1 class="pb-2">Nos <span class="text-front">Conheça!</span></h1>
                    <p>Nossa maior satisfação é lhe ajudar a encontrar seu imóvel dos sonhos nos bairros do Sul da Ilha
                        da Magia, em Florianópolis.</p>
                    <h1 class="pb-2">Quer <span class="text-front">Investir?</span></h1>
                    <p>Entre em contato com nossa equipe e vamos lhe informar sempre sobre os melhores negócios.</p>
                </div>
                <div class="col-12 col-md-12 col-lg-3 text-center">
                    <?php if (CONF_SOCIAL_FACEBOOK_PAGE != "#") : ?>
                        <a href="https://www.facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE; ?>" target="_blank" class="btn btn-front icon-facebook icon-notext"></a>
                    <?php endif; ?>
                    <?php if (CONF_SOCIAL_TWITTER_CREATOR != "#") : ?>
                        <a href="https://twitter.com/<?= CONF_SOCIAL_TWITTER_CREATOR; ?>" target="_blank" class="btn btn-front icon-twitter icon-notext"></a>
                    <?php endif; ?>
                    <?php if (CONF_SOCIAL_INSTAGRAM_PAGE != "#") : ?>
                        <a href="https://www.instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>" target="_blank" class="btn btn-front icon-instagram icon-notext"></a>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </section>

    <div class="main_copyright py-3 bg-front text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0">
                        <?= CONF_SITE_NAME; ?> |
                        CRECI 1234 |
                        <?= CONF_SITE_ADDR_STREET . ", " . CONF_SITE_ADDR_NUMBER . " - " . CONF_SITE_ADDR_DISTRICT . " - " . CONF_SITE_ADDR_CITY . "/" . CONF_SITE_ADDR_STATE . " - C.E.P: " . CONF_SITE_ADDR_ZIPCODE; ?>
                    </p>
                    <p class="mb-0">Todos os Direitos Reservados - <a href="<?= CONF_SITE_DOMAIN_LINK; ?>" class="text-white" target="_blank"><strong><?= CONF_SITE_DOMAIN; ?></strong></a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= theme("/assets/scripts.js"); ?>"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= CONF_API_GOOGLE_MAPS; ?>&callback=initMap">
    </script>


    <?= $v->section("scripts"); ?>


</body>

</html>