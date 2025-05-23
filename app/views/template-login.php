<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title><?= $title ?? 'Document' ?></title>
</head>
<body>
    
    <div class="alert-container absolute top-5 right-5">
        <?= getFlash("message") ?>
    </div>
    <main class="h-screen w-full bg-orange-500 flex justify-center items-center p-4">
        <?php $this->load($view, $viewData); ?>
    </main>


</body>
</html>