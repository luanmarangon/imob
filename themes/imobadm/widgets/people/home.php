<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/people/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_subs radius">
                <article class="radius">
                    <h3 class="icon-users">Total Proprietários</h3>
                    <h3><?= sprintf('%02d', $people); ?></h3>
                </article>

            </section>
            <br>

            <section class="app_control_subs radius">
                <article class="radius">
                    <h3 class="icon-birthday-cake">Aniversariantes entre as datas de <?= date('d/m/Y'); ?> à <?= date('d/m/Y', strtotime('+30 days')); ?> </h3>
                    <h3><?= sprintf('%02d', $birthsCount); ?></h3>
                </article>


                <!-- <h3 class="icon-birthday-cake">Aniversariantes entre as datas de <?= date('d/m/Y'); ?> à <?= date('d/m/Y', strtotime('+30 days')); ?> </h3> -->

                <?php if ($births) : ?>
                    <?php foreach ($births as $birth) : ?>
                        <article class="subscriber">
                            <h3><a href="<?= url("admin/people/people/{$birth->first_name}/1") ?>"><?= $birth->fullName(); ?></a>
                            </h3>
                            <h3><?= date_fmt($birth->datebirth, "d/m/Y "); ?></h3>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <article class="subscriber">
                        <h3>Desculpe, não há clientes aniversariantes dentro desse periodo. Por favor, verifique novamente daqui alguns dias.</h3>
                    </article>
                <?php endif; ?>
            </section>

            <section class="app_control_subs radius">
                <h3 class="icon-line-chart">Clientes: <?= $countPeople ? $countPeople : 0; ?></h3>
                <?php if ($lastPeople) : ?>
                    <?php foreach ($lastPeople as $people) : ?>
                        <article class="subscriber">
                            <h3><a href="<?= url("admin/people/people/{$people->first_name}/1") ?>"><?= $people->fullName(); ?></a>
                            </h3>
                            <h3><?= date_fmt($people->created_at, "d/m/y \à\s H\hi"); ?></h3>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <article class="subscriber">
                        <h3>Desculpe, não há clientes cadastrados neste mês. Por favor, verifique novamente mais tarde ou
                            tente cadastrar um novo cliente.</h3>
                    </article>
                <?php endif; ?>
            </section>

            <!-- <section class="dash_content_app_box">
                <h3 class="icon-users">Proprietários <?= $countPeople; ?></h3>
                <br>
                <div class="app_users_home">
                    <?php if (!$lastPeople) : ?>
                    <?php foreach ($lastPeople as $people) : ?>
                    <article class="user radius">
                        <h4><?= $people->fullName(); ?></h4>
                        <div class="info">
                            <p>Desde <?= date_fmt($people->created_at, "d/m/y \à\s H\hi"); ?></p>
                            <p><?= $people->addressPeople($people->id)->city; ?>-<?= $people->addressPeople($people->id)->state; ?>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section> -->
            <!-- <?php else : ?>
            <div class="app_control_home">
                <section class="app_control_subs radius">
                    <article class="radius">
                        <h3 class="icon-user">Total Proprietários</h3>
                        <h3><?= sprintf('%02d', $people); ?></h3>
                    </article>

                </section>
            </div>


            <?php endif; ?> -->


        </div>
    </div>
</section>