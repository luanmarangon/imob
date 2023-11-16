<?php $v->layout("_login"); ?>

<div class="login">
    <div class="login-card">
        <img src="<?= theme('assets/images/icons/icon_cadeado.png'); ?>" alt="Login">
        <h2>Login</h2>
        <h3>Entre com suas Credencias</h3>

        <form class="login-form" action="<?= url("/admin/login") ?>" method="post" enctype="multipart/form-data">
            <div class="ajax_response"><?= flash(); ?></div>
            <?= csrf_input(); ?>

            <input type="email" name="email" class="control" value="<?= ($cookie ?? null); ?>" placeholder="Login">
            <div class="password">
                <input id="password" type="password" class="control" name="password" placeholder="Informe sua senha:"
                    required />
                <!-- <input  type="password" class="control" placeholder="Senha"> -->
                <button class="toggle" type="button" onclick="togglePassword(this)"></button>
            </div>
            <label class="check">
                <input type="checkbox" <?= (!empty($cookie) ? "checked" : ""); ?> name="save" />
                <span>Lembrar dados?</span>
            </label>
            <button class="control">LOGIN</button>
            <a href="<?= url("/"); ?>">Home</a>
            <h3></h3>
        </form>
    </div>
</div>