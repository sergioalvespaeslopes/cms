<?= $this->extend('layouts/base'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Criar Cliente</h1>
    <form action="<?= base_url('/clients'); ?>" method="POST">
        <label for="nome" class="block text-lg text-gray-700 mb-2">Nome:</label>
        <input type="text" name="nome" id="nome" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="email" class="block text-lg text-gray-700 mb-2">Email:</label>
        <input type="email" name="email" id="email" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="telefone" class="block text-lg text-gray-700 mb-2">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="segmento" class="block text-lg text-gray-700 mb-2">Segmento:</label>
        <input type="text" name="segmento" id="segmento" required class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Criar Cliente</button>
    </form>

    <div class="text-center mt-6">
        <p><a href="<?= base_url('/clients'); ?>" class="text-blue-500 hover:underline">Voltar para a lista de clientes</a></p>
    </div>
</div>

<?= $this->endSection(); ?>
