<?= $this->extend('layouts/base'); ?>

<?= $this->section('css'); ?>
<style>
    body {
        font-family: 'Arial', sans-serif;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto mt-20">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Registro</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-200 text-green-600 p-3 rounded mb-4">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-200 text-red-600 p-3 rounded mb-4">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="/register" method="POST">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail:</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="E-mail" required>
            <?php if (session()->getFlashdata('email_error')): ?>
                <div class="text-red-600 text-sm mt-1"><?= esc(session()->getFlashdata('email_error')) ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Senha:</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Senha" required>
            <?php if (session()->getFlashdata('password_error')): ?>
                <div class="text-red-600 text-sm mt-1"><?= esc(session()->getFlashdata('password_error')) ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-6">
            <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">Confirmar Senha:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Confirmar Senha" required>
            <?php if (session()->getFlashdata('confirm_password_error')): ?>
                <div class="text-red-600 text-sm mt-1"><?= esc(session()->getFlashdata('confirm_password_error')) ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="w-full py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 focus:outline-none">Registrar</button>
    </form>

    <div class="mt-4 text-center">
        <p class="text-sm">Já tem uma conta? <a href="/login" class="text-blue-500 hover:text-blue-700">Entre aqui</a></p>
    </div>
</div>
<?= $this->endSection(); ?>
