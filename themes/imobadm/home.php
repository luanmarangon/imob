<?php

use Source\Models\Auth;
?>
<!-- <h1><?= $teste; ?> <?= $user->first_name; ?> </h1> -->


<div class="al-center"><?= flash(); ?></div>
<h1>Bem Vindo <?= Auth::user()->fullName(); ?></h1>
<a class="icon-sign-out radius transition" title="Sair" href="<?= url("/admin/sair"); ?>">Sair</a>