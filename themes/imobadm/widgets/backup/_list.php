<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/backup/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-user">Backups</h2>
    </header>

    <section class="app_control_subs radius">
        <?php foreach ($existingBackups as $backup) : ?>
        <article class="subscriber">
            <h4><?= basename($backup); ?></h4>
            <h4><?= date("d/m/Y H:i:s", filectime($backup)); ?></h4>
            <a href="<?= '../../' . $backup; ?>" class="btn btn-small btn-green icon-cloud"></a>
        </article>
        <?php endforeach; ?>
    </section>
</section>