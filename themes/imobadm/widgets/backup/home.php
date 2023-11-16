<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/backup/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dashboard de Controle de Backup</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-home">Quantidade de Backups </h4>
                    <!-- <p><?= $backupCount; ?></p> -->
                </article>

                <article class="radius">
                    <a href="<?= url('admin/backup/new'); ?>" class="btn btn-green">Gerar Backup</a>
                    <!-- <h4 class="icon-home">Convertidos</h4> -->
                    <!-- <p><?= $countClients; ?></p> -->
                </article>
            </section>

            <section class="app_control_subs radius">
                <?php foreach ($existingBackups as $backup) : ?>
                    <article class="subscriber">
                        <h4><?= basename($backup); ?></h4>
                        <h4><?= date("d/m/Y H:i:s", filectime($backup)); ?></h4>
                        <a href="<?= '../../' . $backup; ?>" class="btn btn-small btn-green icon-cloud"></a>
                    </article>
                <?php endforeach; ?>
            </section>

        </div>
    </div>
</section>