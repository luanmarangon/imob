<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/properties/tributes/sidebar.php"); ?>

<section class="dash_content_app">

    <?php if (!$tribute) : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Nova Transação para o Imóvel <?= $propertie->reference; ?></h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/tributes/tributes-create"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />
                <div class="label">
                    <label class="label">
                        <span class="legend">*Referência Imóvel:</span>
                        <input type="text" name="propertieReference" value="<?= $propertie->reference; ?>" disabled />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Tributo:</span>
                        <select name="tribute" required>
                            <option value=""></option>
                            <?php foreach ($charge as $key) : ?>
                                <option value="<?= $key->id; ?>"><?= $key->charge; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="label">
                        <span class="legend">*Valor:</span>
                        <input class="mask-money" type="text" name="tributeValue" required />
                    </label>
                    <label class="label">
                        <span class="legend">*Exercício:</span>
                        <input class="" type="text" name="tributeExercise" placeholder="Ano do Exercício" required />
                    </label>

                </div>
                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Inserir Tributo</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Alteração do tributo <?= $tribute->id; ?> no Imovel: <?= $propertie->reference; ?> </h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/properties/properties/{$propertie->reference}/tributes/tributes-create"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />
                <div class="label">
                    <label class="label">
                        <span class="legend">*Referência Imóvel:</span>
                        <input type="text" name="propertieReference" value="<?= $propertie->reference; ?>" disabled />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Tributo:</span>
                        <select name="tribute" required>
                            <option value="<?= $tribute->charges_id; ?>"><?= $tribute->findTribute($tribute->charges_id)->charge; ?></option>
                        </select>
                    </label>
                    <label class="label">
                        <span class="legend">*Valor:</span>
                        <input class="mask-money" type="text" name="tributeValue" value="<?= $tribute->value; ?>" />
                    </label>
                    <label class="label">
                        <span class="legend">*Exercício:</span>
                        <input class="" type="text" name="tributeExercise" placeholder="Ano do Exercício" value="<?= $tribute->exercise; ?>" />
                    </label>

                </div>
                <div class="al-right">
                    <a href="#" class="icon-ban btn btn-red" data-post="<?= url("/admin/properties/properties/{$propertie->reference}/tributes/tributes-create"); ?>" data-action="delete" data-confirm="ATENÇÃO: Você tem certeza de que deseja excluir este tributo?" data-tribute_id="<?= $tribute->id; ?>">Excluir</a>
                    <button class="btn btn-green icon-check-square-o">Alterar Tributo</button>
                </div>
            </form>
        </div>
        </div>
    <?php endif; ?>
</section>