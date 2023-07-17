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

## Requisitos funcionais
| Requisitos | Status | Código |
|----------|----------|----------|
| Escolher matriz curricular considerada. | Não implementado |  |
| Selecionar disciplinas obrigatórias cursadas. | Implementado   | [tabs.html](pages/tabs.html), [scriptDisciplinas.js](js/scriptDisciplinas.js), [multi-select-dropdown.js](js/multi-select-dropdown.js) |
| Selecionar disciplinas eletivas cursadas. | Implementado | [tabs.html](pages/tabs.html), [scriptDisciplinas.js](js/scriptDisciplinas.js), [multi-select-dropdown.js](js/multi-select-dropdown.js)  |
| Selecionar disciplinas optativas cursadas. | Implementado   | [tabs.html](pages/tabs.html), [scriptDisciplinas.js](js/scriptDisciplinas.js), [multi-select-dropdown.js](js/multi-select-dropdown.js)  |
| Informar horas complementares realizadas. | Implementado   | [tabs.html](pages/tabs.html), [scriptActivities.js](js/scriptActivities.js)  |
| Exibir disciplinas obrigatórias e eletivas que faltam para conclusão do curso. | Em andamento   | [report.html](pages/report.html)  |
| Exibir horas complementares restantes necessárias para conclusão do curso. | Implementado   | [report.html](pages/report.html)  |
| Exportar dados (disciplinas e horas complementares restantes) exibidos pela calculadora. | Não implementado   |  |
| Exibir infográfico interativo-descritivo. | Implementado   | [info.html](pages/info.html), [grade-curricular.html](pages/grade-curricular.html), [trilhas.html](pages/trilhas.html), [horas-complementares.html](pages/horas-complementares.html)  |
| Exibir e explicar o que são as trilhas e como funcionam.  | Implementado   | [trilhas.html](pages/trilhas.html) |
| Exibir e explicar o que são as horas complementares. | Implementado   | [horas-complementares.html](pages/horas-complementares.html) |
| Exibir e explicar o que são as disciplinas obrigatórias e eletivas. | Implementado   | [grade-curricular.html](pages/grade-curricular.html) |
| Disponibilizar acesso aos dados da matriz curricular  | Implementado   | [MatrizcurricularController.php get( )](api_meuDiploma/src/controllers/MatrizcurricularController.php)  | 
| Disponibilizar acesso aos dados das disciplinas | Implementado   | [DisciplinaController.php get( )](api_meuDiploma/src/controllers/DisciplinaController.php) |
| Alterar registro na tabela de matriz curriculares | Implementado   | [MatrizcurricularController.php update( )](api_meuDiploma/src/controllers/MatrizcurricularController.php) |
| Excluir registro da tabela de matriz curriculares | Implementado   | [MatrizcurricularController.php detele( )](api_meuDiploma/src/controllers/MatrizcurricularController.php) |
| Integrar sistema ao banco  | Implementado   | [scriptDisciplinas.js](js/scriptDisciplinas.js) |
| Incluir registro na tabela de disciplinas  | Implementado   | [DisciplinaController.php insert( )](api_meuDiploma/src/controllers/DisciplinaController.php) |
| Alterar registro na tabela de disciplinas | Implementado   | [DisciplinaController.php update( )](api_meuDiploma/src/controllers/DisciplinaController.php) |
| Excluir registro da tabela de disciplinas  | Implementado   | [DisciplinaController.php delet( )](api_meuDiploma/src/controllers/DisciplinaController.php) |
| Incluir registro na tabela de requisitos | Implementado   | [DisciplinaController.php insertR( )](api_meuDiploma/src/controllers/DisciplinaController.php) |
| Excluir registro da tabela de requisitos | Implementado   | [DisciplinaController.php deleteR( )](api_meuDiploma/src/controllers/DisciplinaController.php) |
  
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
