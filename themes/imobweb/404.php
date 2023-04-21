<?php $v->layout("_theme"); ?>

<div class="main_content notfound">
    <div class="container">
        <span class="icon-chain-broken icon-notext notfound_icon"> <?= $error->code; ?></span>
        <h1><?= $error->title; ?></h1>
        <p><?= $error->message; ?></p>
        <?php if ($error->link) : ?>
            <a class="btn notfound_btn" title="<?= $error->linkTitle; ?>" href="<?= $error->link; ?>"><?= $error->linkTitle; ?></a>
        <?php endif; ?>
    </div>
</div>