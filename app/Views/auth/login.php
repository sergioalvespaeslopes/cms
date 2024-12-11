<?= $this->extend('layouts/base'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto mt-20">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-200 text-red-600 p-3 rounded mb-4">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/login'); ?>" method="POST">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Senha:</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <button type="submit" class="w-full py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none">Entrar</button>
    </form>

    <div class="mt-4 text-center">
        <p class="text-sm">Não tem uma conta? <a href="/register" class="text-blue-500 hover:text-blue-700">Cadastre-se aqui</a></p>
    </div>
</div>

<?= $this->endSection(); ?>
