<?php require __DIR__ . "/sidebar.php"; ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Nova Transação do Imóvel {IMOB001}</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="" method="post">
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Referência Imóvel:</span>
                    <input type="text" name="name" value="IMOB001" disabled />

                </label>
                <label class="label">
                    <span class="legend">*Plano:</span>
                    <input type="text" name="name" value="Endereço Full" disabled />
                </label>

            </div>


            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <option value="active">Aluguel</option>
                        <option value="inactive">Venda</option>
                    </select>
                </label>
                <label class="label">
                    <span class="legend">*Preço:</span>
                    <input class="mask-money" type="text" name="price" required />
                </label>
                <label class="label">
                    <span class="legend">*Início Vigência:</span>
                    <input class="mask-date" type="text" name="price" required />
                </label>

                <label class="label">
                    <span class="legend">*Fim Vigência:</span>
                    <input class="mask-date" type="text" name="price" required />
                </label>

            </div>

            <!-- <div class="label_g2">
                <label class="label">
                    <span class="legend">*Início:</span>
                    <input class="mask-date" type="text" name="price" required />
                </label>

                <label class="label">
                    <span class="legend">*Fim:</span>
                    <input class="mask-date" type="text" name="price" required />
                </label>
            </div> -->

            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Inserir Transação</button>
            </div>
        </form>
    </div>
</section>