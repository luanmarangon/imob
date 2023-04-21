<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/owners/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-book">Contatos do <?= $clients->fullName(); ?></h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="" method="post">
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Tipo de Contato:</span>
                    <select name="contact" id="select-opcoes" required>
                        <option value="">Escolha</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Fixo">Fixo</option>
                        <option value="E-mail">E-mail</option>
                    </select>
                </label>

                <label class="label" id="phone" style="display:none;">
                    <span class="legend">*Contato:</span>
                    <input type="text" id="phone" placeholder="Digite o telefone de contato" class="mask-phone">
                </label>
                <label class="label" id="email" style="display:none;">
                    <span class="legend">*Contato:</span>
                    <input type="email" id="email" placeholder="Digite o E-mail de contato" class="mask-email">
                </label>
                <label class="label">
                    <button class="btn btn-green icon-check-square-o">Cadastrar</button>
                </label>

            </div>
        </form>
        <section class="app_control_subs radius">
            <h3 class="icon-bar-chart">Contatos: <?= sprintf('%02d', $count); ?></h3>
            <?php if ($clientsContacts) : ?>
            <?php foreach ($clientsContacts as $contacts) : ?>
            <article>
                <?php if ($contacts->contact()->type === "WhatsApp") : ?>
                <h4 class="icon-whatsapp mask-phone"><?= $contacts->contact()->contact; ?></h4>
                <div>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-pencil btn btn-red" href="" title="">Inativar</a>
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

            <!-- <?php for ($i = 0; $i < 2; $i++) : ?>
            <article>
                <h4 class="icon-phone">(18) 99748-2397</h4>

                <div>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-pencil btn btn-red" href="" title="">Inativar</a>
                </div>

            </article>
            <?php endfor; ?>

            <?php for ($i = 0; $i < 2; $i++) : ?>
            <article>
                <h4 class="icon-envelope-o">luan.limarangon@gmail.com</h4>
                <div>
                    <a class="icon-pencil btn btn-blue" href="" title="">Editar</a>
                    <a class="icon-pencil btn btn-red" href="" title="">Inativar</a>
                </div>


            </article>
            <?php endfor; ?> -->
        </section>
    </div>
</section>