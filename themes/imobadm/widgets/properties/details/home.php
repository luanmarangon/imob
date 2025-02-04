<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/details/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-desktop">Dash <?= $propertie->reference; ?> -
            <?= $propertie->address($propertie->addresses_id)->street; ?> -
            <?= $propertie->address($propertie->addresses_id)->number; ?> -
            <?= $propertie->address($propertie->addresses_id)->city; ?> -
            <?= $propertie->address($propertie->addresses_id)->state; ?>
        </h2>
    </header>

    <div class="dash_content_app_box">
        <div class="app_control_home">
            <section class="app_control_home_stats">
                <article class="radius">
                    <h4 class="icon-home">Total de Cômodos</h4>
                    <?php if ($countComfortable) : ?>
                        <p><?= $countComfortable ?></p>
                    <?php else : ?>
                        <p>Não Informado</p>
                    <?php endif; ?>
                </article>

                <article class="radius">
                    <h4 class="icon-home">Total Características</h4>
                    <?php if ($countFeatures) : ?>
                        <p><?= $countFeatures ?></p>
                    <?php else : ?>
                        <p>Não Informado</p>
                    <?php endif; ?>
                </article>
            </section>
            <br>
            <section class="app_control_home_stats">
                <?php if ($propertieStructures) : ?>
                    <?php foreach ($propertieStructures as $structure) : ?>
                        <article class="radius">
                            <h4 class="icon-home"><?= $structure->structures($structure->id)->structure; ?></h4>
                            <?php if ($structure->structures_id) : ?>
                                <p><?= $structure->footage ?></p>
                            <?php else : ?>
                                <p>Não Informado</p>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>


            <section class="app_control_subs radius">
                <h3 class="icon">Informações mais atualizadas</h3>
                <article class="subscriber">
                    <?php if ($endComfortable) : ?>
                        <h5>Cômodos: <?= $endComfortable->comfortable($endComfortable->comfortable_id)->convenient; ?> - <?= date("d-m-Y H:i", strtotime($endComfortable->updated_at)); ?></h5>
                    <?php endif; ?>
                </article>
                <article class="subscriber">
                    <?php if ($endFeatures) : ?>
                        <h5>Características: <?= $endFeatures->features($endFeatures->features_id)->feature; ?> - <?= date("d-m-Y H:i", strtotime($endFeatures->updated_at)); ?></h5>
                    <?php endif; ?>
                </article>
                <article class="subscriber">
                    <?php if ($endStructures) : ?>
                        <h5>Estruturas: <?= $endStructures->structures($endStructures->structures_id)->structure; ?> - <?= date("d-m-Y H:i", strtotime($endStructures->updated_at)); ?></h5>
                    <?php endif; ?>
                </article>

            </section>
            <!--Teste para melhor apresentação da informação  -->
            <!-- <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Imóveis: {Ultimos}</h3>
                <?php for ($i = 0; $i < 3; $i++) : ?>
                <article class="subscriber">
                    <h5>22.10.18 22h - Rua Alcides Ramos da Silva, 315</h5>
                    <p>Martinópolis-SP</p>
                    <p>Concluída</p>
                </article>
                <?php endfor; ?>
            </section>

            <section class="app_control_subs radius">
                <h3 class="icon-heartbeat">Imóveis: {Ultimos}</h3>
                <?php for ($i = 0; $i < 3; $i++) : ?>
                <article class="subscriber">
                    <h5>22.10.18 22h - Rua Alcides Ramos da Silva, 315</h5>
                    <p>Martinópolis-SP</p>
                    <p>Concluída</p>
                </article>
                <?php endfor; ?>
            </section> -->
        </div>
    </div>
</section>