<?= $this->extend('layouts/base'); ?>
<?= $this->section('css'); ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Criar Cliente</h1>
    <form action="<?= base_url('/clients'); ?>" method="POST" id="createClientForm">
        <label for="nome" class="block text-lg text-gray-700 mb-2">Nome:</label>
        <input type="text" name="nome" id="nome" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="email" class="block text-lg text-gray-700 mb-2">Email:</label>
        <input type="email" name="email" id="email" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="telefone" class="block text-lg text-gray-700 mb-2">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="segmento" class="block text-lg text-gray-700 mb-2">Segmento:</label>
        <input type="text" name="segmento" id="segmento" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="cep" class="block text-lg text-gray-700 mb-2">CEP:</label>
        <input type="text" name="cep" id="cep" required placeholder="XXXXX-XXX" class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" title="CEP no formato XXXXX-XXX">

        <label for="latitude" class="block text-lg text-gray-700 mb-2">Latitude:</label>
        <input type="text" name="latitude" id="latitude" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label for="longitude" class="block text-lg text-gray-700 mb-2">Longitude:</label>
        <input type="text" name="longitude" id="longitude" required class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Criar Cliente</button>
    </form>

    <div class="text-center mt-6">
        <p><a href="<?= base_url('/clients'); ?>" class="text-blue-500 hover:underline">Voltar para a lista de clientes</a></p>
    </div>
</div>

<script src="https://unpkg.com/imask"></script>
<script>
const cepMask = IMask(document.getElementById('cep'), {
    mask: '00000-000' 
});

async function fetchCEPData(cep) {
    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const data = await response.json();
    return data;
}

async function fetchGeolocation(address) {
    const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=${encodeURIComponent(address)}`);
    const data = await response.json();
    return data[0];
}

async function updateLocationFromCEP(cep) {
    try {
        const cepData = await fetchCEPData(cep);
        if (cepData.logradouro && cepData.bairro && cepData.localidade && cepData.uf) {
            const address = `${cepData.logradouro}, ${cepData.bairro}, ${cepData.localidade}, ${cepData.uf}`;
            const geoData = await fetchGeolocation(address);
            if (geoData) {
                document.getElementById('latitude').value = geoData.lat;
                document.getElementById('longitude').value = geoData.lon;
            } else {
                alert('Não foi possível obter a geolocalização para este endereço.');
            }
        } else {
            alert('CEP não encontrado.');
        }
    } catch (error) {
        console.error('Erro ao buscar geolocalização:', error);
    }
}

document.getElementById('cep').addEventListener('blur', function() {
    const cep = this.value.replace('-', '');
    if (cep.length === 8) {
        updateLocationFromCEP(cep);
    }
});

document.getElementById('createClientForm').addEventListener('submit', function(e) {
    const cep = document.getElementById('cep').value.replace(/-/g, '');
    document.getElementById('cep').value = cep;

    const latitude = document.getElementById('latitude').value;
    const longitude = document.getElementById('longitude').value;

    if (!latitude || !longitude) {
        e.preventDefault();
        alert('Por favor, preencha as coordenadas de latitude e longitude.');
    }
});
</script>

<?= $this->endSection(); ?>
