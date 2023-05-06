<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/people/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-book">Contatos do <?= $people->fullName(); ?></h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Tipo de Contato:</span>
                    <select name="contactType" id="select-opcoes" required>
                        <option value="">Escolha</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Fixo">Fixo</option>
                        <option value="E-mail">E-mail</option>
                    </select>
                </label>

                <label class="label" id="phone" style="display:none;">
                    <span class="legend">*Contato:</span>
                    <input type="text" id="phone" name="phone" placeholder="Digite o telefone de contato"
                        class="mask-phone">
                </label>
                <label class="label" id="email" style="display:none;">
                    <span class="legend">*Contato:</span>
                    <input type="email" id="email" name="email" placeholder="Digite o E-mail de contato"
                        class="mask-email">
                </label>
                <label class="label">
                    <button class="btn btn-green icon-check-square-o">Cadastrar</button>
                </label>

            </div>
        </form>



        <section class="app_control_subs radius">
            <h3 class="icon-bar-chart">Contatos: <?= sprintf('%02d', $count); ?></h3>
            <?php if ($peopleContacts) : ?>

            <?php foreach ($peopleContacts as $contacts) : ?>
            <!-- <?php var_dump($contacts->id); ?> -->
            <article>
                <?php if ($contacts->contact()->type === "WhatsApp") : ?>
                <h4 class="icon-whatsapp mask-phone"><?= $contacts->contact()->contact; ?></h4>
                <div>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <?php if($contacts->contact()->status != "Inativo") :?>
                    <!-- <a class="icon-pencil btn btn-red" href="" title="">Inativar</a> -->
                    <a class="btn btn-red icon-warning" data-post="<?= url("/admin/people/people/{$people->id}/contacts/{$contacts->contact()->id}"); ?>" data-action="delete" data-confirm="ATENÇÃO: Tem certeza que deseja excluir o usuário e todos os dados relacionados a ele? Essa ação não pode ser feita!" data-user_id="<?= $contacts->id; ?>">Inativar</a>
                        <?php else: ?>
                            <a class="btn btn-green icon-warning" data-post="<?= url("/admin/people/people/{$people->id}/contacts/{$contacts->contact()->id}"); ?>" data-action="active" data-confirm="ATENÇÃO: Tem certeza que deseja excluir o usuário e todos os dados relacionados a ele? Essa ação não pode ser feita!" data-user_id="<?= $contacts->id; ?>">Ativar</a>
                            <?php endif;?>
                </div>
                <?php elseif ($contacts->contact()->type === "Fixo") : ?>
                <h4 class="icon-phone mask-phone"><?= $contacts->contact()->contact; ?></h4>
                <div>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-pencil btn btn-red" href="" title="">Inativar</a>
                </div>
                <?php else : ?>
                <h4 class="icon-envelope-o"><?= $contacts->contact()->contact; ?></h4>
                <div>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-pencil btn btn-red" href="" title="">Inativar</a>
                </div>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
            <?php else : ?>
            <br>
            <h2>Sem Contatos cadastrados</h2>
            <?php endif; ?>
        </section>
        <?= $paginator; ?>
    </div>
</section>