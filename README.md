# Equipe CEOS

## Projeto A Taverna
Este projeto é desenvolvido por estudantes da Universidade Federal do Ceará, para a disciplina de Projeto Integrado I, com o intuito de unir jogadores e mestres de RPG de mesa em um ambiente seguro e inclusivo. 

## Instalação

### Requisitos:
Para rodar o projeto é necessário ter em sua maquina um servidor web (o php instalado nele) e o banco de dados MySQL, tudo isso pode ser usado através do software [XAMPP] (https://www.apachefriends.org/), bastando instalá-lo e configurá-lo em sua maquina.

### Guia:
Você pode clonar este repositório ou baixar o .zip. Caso baixado o .zip, extraia na pasta htdocs do xampp. Cuidado! Ao extrair, automaticamente será criado projeto-webapp-taverna/projeto-webapp-taverna-main, recorte os arquivos e cole na pasta projeto-webapp-taverna e exclua a pasta projeto-webapp-taverna-main para a aplicação rodar sem problemas.

### Banco de Dados:
Abra o PHPmyadmin por meio do XAMPP, crie um banco de dados com o nome "taverna" e importe o arquivo taverna.sql que está na pasta do projeto. 

## Uso

Abra o XAMPP e ligue o APACHE e o MySQL. Após isso, vá ao seu navegador e acesse seu localhost. 

Link de acesso rápido: http://localhost/projeto-webapp-taverna/

## Desenvolvedores:
- Caio Henrique Capêlo (full stack)
- José Matheus Alvino (back-end)
  
Aqui está uma breve descrição de cada pasta e arquivo:

assets/: Esta pasta contém as imagens do projeto. Seja foto de perfil, favicon ou background.

css/: Aqui você tem as folhas de estilo do projeto. Foi utilizado o bootstrap para facilitar a criação do projeto.

db/: Esta pasta contém a ligação com o banco de dados. Utilizamos o objeto mysqli da linguagem PHP.

js/: Aqui você tem os scripts em JavaScript. Foi utilizado o bootstrap para facilitar a criação do projeto.

php/: Esta pasta contém o arquivo info.php onde é possível visualizar as configurações do php.

PHPMailer/: Esta pasta contém os arquivos da biblioteca PHPMailer utilizada para enviar o link de redefinição de senha por e-mail.

telas/: Aqui você tem as telas do projeto divididas em categorias. Utilizamos um sistema de código que define que telas que o usuário vê começa com letra maiúscula e telas que forem apenas funcionalidades começam com a letra minúscula.

index.php/: Porta de entrada da aplicação.

<p align="right">(<a href="#readme-top">Voltar para o topo</a>)</p>

**Com amor, equipe CEOS <3**
