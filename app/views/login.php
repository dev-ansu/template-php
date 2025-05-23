<div class="bg-white flex flex-col justify-center items-center rounded w-96 p-4">

    <img 
        src="<?= asset("/img/logo.jpeg") ?>"
        alt="Logo da escola itep"
        class="w-32 "
    />

    <form class="bg-white w-full flex flex-col gap-8" method="POST" action="<?= BASE_URL ?>/login">

        <div class="flex flex-col gap-4">
            <div class="flex flex-col flex-1">
                <label for="" class="text-gray-600">E-mail:</label>
                <input  type="email" name="email" value="" class="outline-none border-1 border-orange-500 rounded px-2 py-1" placeholder="Digite seu e-mail">
                <?= getFlash("email.required", true) ?>
                <?= getFlash("email.notNull", true) ?>
            </div>

            <div class="flex flex-col flex-1">
                <label for="" class="text-gray-600">Senha:</label>
                <input  type="password" name="senha" value="" class="outline-none border-1 border-orange-500 rounded px-2 py-1" placeholder="Digite seu e-mail">
                <?= getFlash("senha.required", true) ?>
                <?= getFlash("senha.notNull", true) ?>

            </div>
        </div>

        <input type="hidden" name="_csrf_token" value="<?= $token ?>">

        <button class="cursor-pointer bg-orange-400 transition-all rounded outline-none border-none py-2 px-8 self-start text-white cursor-pointer hover:bg-orange-500">Acessar</button>
    </form>

</div>