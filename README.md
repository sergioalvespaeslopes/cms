CMS Project
Este projeto é um Sistema de Gestão de Conteúdo (CMS) desenvolvido utilizando CodeIgniter 4. O sistema oferece funcionalidades de autenticação de usuários, gerenciamento de dados de clientes e um painel gráfico com gráficos de barras. O banco de dados utilizado é MySQL ou MariaDB, com práticas recomendadas para código limpo, documentação e controle de versão.

Pré-requisitos
Antes de rodar o projeto, você precisa ter os seguintes softwares instalados:

PHP 7.4 ou superior
Composer
MySQL ou MariaDB
Git
Configuração
Clone o repositório do projeto:
bash

git clone https://github.com/sergioalvespaeslopes/cms.git
Acesse o diretório do projeto:
bash

cd cms
Instale as dependências do Composer:

composer install
Renomeie o arquivo .env.example para .env e configure as variáveis de ambiente, especialmente as configurações de banco de dados:
bash

cp .env.example .env
Ajuste as configurações conforme necessário, especialmente a URL base e as configurações de banco de dados:

app.baseURL = 'http://localhost:8080'

# DATABASE
database.default.hostname = localhost
database.default.database = cms_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
Gere a chave da aplicação:
vbnet

php spark key:generate
Migrações
Para aplicar as migrações, execute o seguinte comando:

php spark migrate
Isso criará as tabelas necessárias no banco de dados, de acordo com as migrações definidas.

Executando o Servidor
Para rodar o servidor de desenvolvimento local, use o comando:

php spark serve
O CMS estará disponível em http://localhost:8080.

Estrutura do Projeto
app/: Contém os controladores, modelos e visualizações do CMS.
cms/: Pasta do repositório Git, contém os arquivos do CMS.
composer.json: Arquivo de configuração do Composer, que define as dependências do projeto.
composer.lock: Arquivo gerado automaticamente pelo Composer para garantir que as versões das dependências sejam consistentes.
env: Arquivo de variáveis de ambiente que contém configurações sensíveis, como credenciais de banco de dados.
phpunit.xml.dist: Arquivo de configuração para testes unitários.
public/: Pasta pública, onde ficam os arquivos acessíveis publicamente, como imagens, scripts e estilos.
README.md: Documento que contém a descrição do projeto e instruções de configuração.
spark: Ferramenta de linha de comando do CodeIgniter para gerenciar o projeto.
system/: Contém o código do framework CodeIgniter.
tests/: Pasta para os testes unitários do projeto.
vendor/: Pasta gerada pelo Composer que contém as dependências do projeto.
writable/: Pasta onde o CodeIgniter escreve arquivos, como logs e caches.
Contribuições

