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

        <!-- Campo de CEP -->
        <label for="cep" class="block text-lg text-gray-700 mb-2">CEP:</label>
        <input type="text" name="cep" id="cep" required placeholder="XXXXX-XXX" class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" title="CEP no formato XXXXX-XXX">

        <!-- Campos de Latitude e Longitude -->
        <label for="latitude" class="block text-lg text-gray-700 mb-2">Latitude:</label>
        <input type="text" name="latitude" id="latitude" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" >

        <label for="longitude" class="block text-lg text-gray-700 mb-2">Longitude:</label>
        <input type="text" name="longitude" id="longitude" required class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" >

        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Criar Cliente</button>
    </form>

    <div class="text-center mt-6">
        <p><a href="<?= base_url('/clients'); ?>" class="text-blue-500 hover:underline">Voltar para a lista de clientes</a></p>
    </div>
</div>

<!-- Incluindo a biblioteca IMask.js -->
<script src="https://unpkg.com/imask"></script>

<script>
    // Aplica a máscara de CEP no campo de CEP
    var cepElement = document.getElementById('cep');
    var cepMask = IMask(cepElement, {
        mask: '00000-000' // Máscara para o formato de CEP XXXXX-XXX
    });

    // Função para buscar latitude e longitude através do CEP
    async function fetchGeolocation(cep) {
        try {
            let response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            let data = await response.json();

            if (data.logradouro && data.bairro && data.localidade && data.uf) {
                // Monta o endereço completo
                const address = `${data.logradouro}, ${data.bairro}, ${data.localidade}, ${data.uf}`;

                // Consulta a API de Geocodificação do OpenStreetMap (Nominatim)
                let geoResponse = await fetch(`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=${encodeURIComponent(address)}`);
                let geoData = await geoResponse.json();

                if (geoData && geoData[0]) {
                    const location = geoData[0];
                    document.getElementById('latitude').value = location.lat;
                    document.getElementById('longitude').value = location.lon;
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

    // Quando o campo CEP perder o foco (evento blur)
    cepElement.addEventListener('blur', function() {
        var cep = cepElement.value.replace('-', ''); // Remove o hífen
        if (cep.length === 8) { // Verifica se o CEP tem 8 caracteres
            fetchGeolocation(cep);
        }
    });

    // Remover o hífen antes de enviar o formulário
    document.getElementById('createClientForm').addEventListener('submit', function(e) {
        var cep = document.getElementById('cep').value;
        document.getElementById('cep').value = cep.replace(/-/g, ''); // Remove o hífen

        // Validação para garantir que a latitude e longitude estão preenchidas
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;
  
        if (!latitude || !longitude) {
            e.preventDefault(); // Impede o envio do formulário
            alert('Por favor, preencha as coordenadas de latitude e longitude.');
        }
    });
</script>


<?= $this->endSection(); ?>
