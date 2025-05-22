<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset("css/alert.css") ?>">
    <title><?= $title ?? 'Document' ?></title>
</head>
<body>

    <?php component("partials.cabecalho") ?>

        <?php $this->load($view, $viewData); ?>

    <?php component('partials.rodape') ?>

</body>
</html>