<?= $this->extend('layouts/base'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Clientes</h1>
    <a href="<?= base_url('/clients/create'); ?>" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Criar Novo Cliente</a>
    
    <table id="clientsTable" class="min-w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Nome</th>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Email</th>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Telefone</th>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Segmento</th>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Longitude</th>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Latitude</th>
                <th class="px-4 py-2 text-left bg-blue-500 text-white">CEP</th> <!-- Nova coluna CEP -->
                <th class="px-4 py-2 text-left bg-blue-500 text-white">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2"><?= esc($client['nome']); ?></td>
                    <td class="px-4 py-2"><?= esc($client['email']); ?></td>
                    <td class="px-4 py-2"><?= esc($client['telefone']); ?></td>
                    <td class="px-4 py-2"><?= esc($client['segmento']); ?></td>
                    <td class="px-4 py-2"><?= esc($client['longitude']); ?></td>
                    <td class="px-4 py-2"><?= esc($client['latitude']); ?></td>
                    <td class="px-4 py-2"><?= esc($client['cep']); ?></td> <!-- Exibição do CEP -->
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="<?= base_url('/clients/edit/' . $client['id']); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-400 text-sm">Editar</a>
                        <a href="<?= base_url('/clients/delete/' . $client['id']); ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-400 text-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#clientsTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>

<?= $this->endSection(); ?>
