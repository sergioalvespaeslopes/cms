<?= $this->extend('layouts/base'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Editar Cliente</h1>
    <form action="<?= base_url('/clients/update/' . $client['id']); ?>" method="POST">
        <label for="nome" class="block text-lg text-gray-700 mb-2">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= esc($client['nome']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="email" class="block text-lg text-gray-700 mb-2">Email:</label>
        <input type="email" name="email" id="email" value="<?= esc($client['email']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="telefone" class="block text-lg text-gray-700 mb-2">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?= esc($client['telefone']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="cep" class="block text-lg text-gray-700 mb-2">CEP:</label>
        <input type="text" name="cep" id="cep" value="<?= esc($client['cep']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="segmento" class="block text-lg text-gray-700 mb-2">Segmento:</label>
        <input type="text" name="segmento" id="segmento" value="<?= esc($client['segmento']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <!-- Campos de Latitude e Longitude -->
        <label for="latitude" class="block text-lg text-gray-700 mb-2">Latitude:</label>
        <input type="text" name="latitude" id="latitude" value="<?= esc($client['latitude']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="longitude" class="block text-lg text-gray-700 mb-2">Longitude:</label>
        <input type="text" name="longitude" id="longitude" value="<?= esc($client['longitude']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Atualizar Cliente</button>
    </form>

    <div class="text-center mt-6">
        <p><a href="<?= base_url('/clients'); ?>" class="text-blue-500 hover:underline">Voltar para a lista de clientes</a></p>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    // Máscara para o campo de CEP
    document.getElementById('cep').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
        if (value.length <= 5) {
            e.target.value = value.replace(/(\d{5})(\d{0,3})/, '$1-$2');
        } else {
            e.target.value = value.replace(/(\d{5})(\d{0,3})/, '$1-$2');
        }
    });
</script>
<?= $this->endSection(); ?>
