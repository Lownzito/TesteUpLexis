# Teste Uplexis - Luís Otávio Wuleschen Nagel

## Tecnologias utilizadas
- Laravel v.10
- RegEx
- MySql
- Bootstrap
- Ajax
## Instalação
Abra o terminal e clone o repositório.
```
git clone https://github.com/Lownzito/TesteUpLexis.git
```
Ir para o diretório.
```
cd testeUpLexis.
```
Fazer a instalação das dependencias. Se sua máquina não tiver composer instalado, siga o tutorial https://getcomposer.org/download/ .
```
composer install
```
Crie o arquivo .env .
```
cp env.example .env
```
Crie uma "schema" com seu nome de preferência e altere as variáveis em .env .
```
DB_HOST= IP DO HOST DA SUA DB, O PADRÃO PARA DB LOCAIS É 127.0.0.1 
DB_PORT= PORTA PADRÃO É 3306, PODE MUDAR DE ACORDO COM SEU AMBIENTE
DB_DATABASE= NOME DE SUA ESCOLHA 
DB_USERNAME= SEU USERNAME DE LOGIN NO BANCO DE DADOS 
DB_PASSWORD= SENHA DE LOGIN NO BANCO DE DADOS 
```
Gere a chave de criptografia do programa
```
php artisan key:generate
```
Rode as migrações. Se houver um erro SQLSTATE HY000 1045 houve algum erro nas suas credenciais de banco de dados
```
php artisan migrate
```
Depois use o seguinte comando para que o seeder para que crie o usuário Admin.
```
php artisan db:seed --class=AdminSeeder
```

## Tutorial de uso da aplicação
Use o seguinte comando para inicializar a aplicação.
```
php artisan serve
```
O terminal irá retornar uma url como [127.0.0.1:8000], abra o link em seu navegador.

Clique em login na barra de navegação, efetue o login usando as seguintes credenciais. <br>
email: admin@admin.com <br>
senha: admin <br>

Você será retornado a pagina principal agora aonde você podera realizar as suas pesquisas, <br>
o retorno das informações poderá demorar dependendo do número de carros encontrado na pesquisa. <br>

Depois de efetuar a pesquisa você poderia ir ao painel de admin, acessado pela barra de navegação <br>
aonde você poderá efetuar a remoção de cadastros do banco de dados.

## Extra
Se você desejar, você pode criar um usuário comum e testar o site sem acesso as páginas de admin.
