<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/cs/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Resposta</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/cs/resposta/{$contact->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="responseContact" />
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Nome:</span>
                    <input type="text" name="first_name" placeholder="Primeiro nome" required value="<?= $contact->name; ?>" disabled />
                </label>

                <label class="label">
                    <span class="legend">*E-mail:</span>
                    <input type="text" name="first_name" placeholder="Primeiro nome" required value="<?= $contact->email; ?>" disabled />
                </label>
                <label class="label">
                    <span class="legend">*Telefone: <a href="<?= 'https://wa.me/55' . $whats ?>" class="">Converse pelo <span class="icon-whatsapp"></span></a></span>
                    <input type="text" name="first_name" placeholder="Primeiro nome" required value="<?= $contact->phone; ?>" disabled />
                </label>
            </div>

            <div class="label">
                <label class="label">
                    <span class="legend">*Mensagem:</span>
                    <textarea name="messageContact" rows="10" cols="33" disabled><?= $contact->messageContact; ?></textarea>
                </label>
            </div>

            <hr>
            <br>
            <div class="label">
                <label class="label">
                    <span class="legend">*Resposta:</span>
                    <?php if ($response) : ?>
                        <textarea name="response" rows="10" cols="33" required><?= $response->response; ?></textarea>
                    <?php else : ?>
                        <textarea name="response" rows="10" cols="33" required></textarea>
                    <?php endif; ?>
                </label>
            </div>


            <div class="al-right">
                <button class="btn btn-default icon-check-square-o">Enviar Resposta</button>
            </div>
        </form>
    </div>

</section>