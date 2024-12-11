<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'Meu Site'; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
    <!-- Link para o seu arquivo de CSS global -->
    <link rel="stylesheet" href="<?= base_url('path/to/your/styles.css'); ?>">

    <!-- Adicionando o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Adicionando o DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Possibilidade de incluir estilos específicos para cada página -->
    <?= $this->renderSection('css'); ?>
</head>
<body>
    <?= $this->include('layouts/header'); ?>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <?= $this->include('layouts/footer'); ?>

    <?= $this->renderSection('js'); ?> <!-- Para scripts adicionais -->
</body>
</html>
