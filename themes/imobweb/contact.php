<?php $v->layout("_theme"); ?>

<div class="main_contact py-5 light text-center">
    <div class="container">
        <h1 class="text-front">Entre em Contato Conosco</h1>
        <p class="mb-0">Quer conversar com um corretor exclusivo e ter o atendimento diferenciado em busca do seu imóvel do sonhos?</p>
        <p>Preencha o formulário abaixo e vamos lhe direcionar para alguém que entende sua necessidade!</p>

        <div class="row text-start">
            <form action="">
                <h2 class="icon-envelope text-black-50 ">Envie um e-mail</h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Insira seu Nome">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Insira seu melhor e-mail">
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" placeholder="Insira seu telefone">
                </div>
                <div class="form-group">
                    <textarea name="teste" rows="5" class="form-control" placeholder="Escreva sua mensagem"></textarea>
                </div>
                <div class="form-group text-end">
                    <button class="btn btn-front">Enviar Contato</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main_contact_types py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 col-md-4 ">
                <h2 class="icon-envelope">Por E-mail</h2>
                <p>Nossos atendentes irão entrar em contato com você assim que possível.</p>
                <p class="pt-2"><a href="#" class="text-front"><?= CONF_COMPANY_ATTENDANCE_MAIL;?></a></p>
            </div>
            <div class="col-12 col-md-4">
                <h2 class="icon-phone">Por Telefone</h2>
                <p>Estamos disponíveis nos números abaixo no hórario comercial.</p>
                <p class="text-front pt-2"><span class="icon-phone"><?= CONF_COMPANY_ATTENDANCE_PHONE;?> | <span class="icon-whatsapp"><?= CONF_COMPANY_ATTENDANCE_WHATS;?></span></p>
                
            </div>
            <div class="col-12 col-md-4">
            <h2 class="icon-share-alt">Redes Sociais</h2>
            <p>Fique por dentro de tudo o que a gente compartilha em nossas redes sociais!</p>
            <a href="https://www.facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE;?>" target="_blank" class="btn btn-front icon-facebook icon-notext"></a>
            <a href="https://twitter.com/<?= CONF_SOCIAL_TWITTER_CREATOR;?>" target="_blank" class="btn btn-front icon-twitter icon-notext"></a>
            <a href="https://www.instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE;?>" target="_blank" class="btn btn-front icon-instagram icon-notext"></a>


            </div>
        </div>
    </div>
</div>