-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/07/2023 às 18:42
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `taverna`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `id_denunciante` varchar(255) NOT NULL,
  `apelido_denunciante` varchar(30) NOT NULL,
  `id_denunciado` varchar(255) NOT NULL,
  `apelido_denunciado` varchar(30) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `denuncia`
--

INSERT INTO `denuncia` (`id`, `titulo`, `id_denunciante`, `apelido_denunciante`, `id_denunciado`, `apelido_denunciado`, `motivo`, `comentario`) VALUES
(1, 'fwfwfwfwf', '7', 'digo', '8', 'ddiangelo', 'O usuário praticou bullying, assédio ou difamação;O usuário possui um conteúdo violento/explícito', 'gay'),
(2, 'Ele se lamenta demais', '19', 'wwagner', '10', 'wwagner33', 'O usuário possui um conteúdo violento/explícito', 'Ele não sofre tanto assim.'),
(3, 'usuario irritante', '23', 'israleite', '7', 'digo', 'O usuário praticou bullying, assédio ou difamação;O usuário expôs informações sensíveis, confidenciais;O usuário incita o ódio contra minorias;O usuário possui um conteúdo violento/explícito;Outro', 'este usuário me irrita'),
(4, 'Achei paia', '24', 'dawn', '7', 'digo', 'Outro', 'O usuário comeu meu sanduíche :('),
(5, 'O FEIOSO', '25', 'Ala', '7', 'digo', '', 'Pq ele é feio'),
(6, 'denunciando o digo', '26', 'jam', '7', 'digo', 'O usuário praticou bullying, assédio ou difamação', 'me assediou e me chamou de p*ta'),
(7, 'Denúncia', '27', 'biankaespalhalixo', '7', 'digo', 'Outro', 'Não gostei dele'),
(8, '', '15', 'Caio', '8', 'ddiangelo', '', ''),
(11, 'usuário é babaca', '33', 'apelido123', '32', 'Noah', 'O usuário incita o ódio contra minorias', 'usuário é muito babaca');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesa`
--

CREATE TABLE `mesa` (
  `id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `anuncio` tinyint(1) NOT NULL,
  `id_mestre` int(11) NOT NULL,
  `email_mestre` varchar(255) NOT NULL,
  `nome_mestre` varchar(255) NOT NULL,
  `matricula_mestre` int(6) NOT NULL,
  `celular_mestre` varchar(255) NOT NULL,
  `nome_campanha` varchar(255) NOT NULL,
  `sistema` varchar(255) NOT NULL,
  `sinopse` text NOT NULL,
  `duracao` varchar(255) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `classificacao_indicativa` varchar(3) NOT NULL,
  `numero_vagas` int(30) NOT NULL,
  `participantes` varchar(255) NOT NULL,
  `nivel_jogadores` varchar(255) NOT NULL,
  `requisitos` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mesa`
--

INSERT INTO `mesa` (`id`, `foto`, `anuncio`, `id_mestre`, `email_mestre`, `nome_mestre`, `matricula_mestre`, `celular_mestre`, `nome_campanha`, `sistema`, `sinopse`, `duracao`, `tema`, `classificacao_indicativa`, `numero_vagas`, `participantes`, `nivel_jogadores`, `requisitos`, `data`, `hora`, `timestamp`) VALUES
(5, '../../assets/bg-2.png', 1, 0, 'wwagner33@gmail.com', 'Wellington Wagner F. Sarmento', 17110932, '85988891975', 'Morte Certa', 'Story Telling', 'História na Hiperbória!', 'Média', 'Aventura', '18', 3, 'digo;Mount;Caio;', 'Avançado', 'Saber jogar.', '2023-05-22', '00:00:00', '2023-07-15 21:40:22'),
(11, '../../assets/bg-1.jpg', 1, 7, 'digatinho_dolatino@gmail.com', 'Lukinha Jesus', 611233, '(85) 9 9888-5555', 'Terra da Magia', 'Storytelling', 'Uma campanha cheia de aventura e mistérios!', 'Média', 'Aventura', 'L', 5, '', 'Intermediário', 'Nenhum.', '2023-06-19', '11:50:00', '2023-06-10 18:06:07'),
(12, '../../assets/vamp.png', 0, 19, '', '', 0, '', 'Dragões Zumbis de Lilith', 'D&D', 'Lilith criou um Dragão Zumbi que consegue contaminar outras criaturas com sua maldição. O ataque telas terá decréscimo de 10.', 'One-shot', 'Aventura', '18', 7, 'ddiangelo;israleite;digo;', 'Avançado', 'Saber D&D; Espírito de Equipe e Paz no coração.', '2023-06-19', '10:00:00', '2023-07-15 00:06:16'),
(14, '../../assets/narutolouco.webp', 0, 23, '', '', 0, '', 'Naruto Trevas', 'Naruto 5e', 'Você faz parte da equipe sete e está prestes a sair em uma aventura para acabar com o Zabuza Momochi, o Demônio do Gás Oculto.', 'Curta', 'Ação', '14', 2, 'Ala;digo;apelido123;', 'Livre', 'Deixar os companheiros da mesa falarem, não ferir nenhum direito humano, o resto tá tranquilo, e sem metagame, por favor.', '2023-06-26', '18:00:00', '2023-07-16 16:10:32'),
(15, '../../assets/bday!.jpg', 0, 24, '', '', 0, '', 'Fui pra Academia Quieto', 'Maromba Simulator', 'Wheyzinho sabor guaraná hmmm delicia', 'One-shot', 'Body Building', 'L', 0, 'biankaespalhalixo;', 'Livre', '--', '2023-06-23', '16:05:00', '2023-06-26 03:29:04'),
(16, '../../assets/narutolouco.webp', 0, 25, '', '', 0, '', 'Ala Aventura', 'D&D', 'Eu acordei e virei um mago', 'Média', 'Ação', '18', 5, '', 'Iniciante', 'Maior de 18', '2023-06-24', '20:16:00', '2023-06-23 20:16:25'),
(17, '../../assets/', 0, 26, '', '', 0, '', 'orbis', 'html css', 'uma bussola muito simpática', 'Curta', 'Aventura', 'L', 7, '', 'Livre', 'ser feliz', '2023-06-23', '20:40:00', '2023-06-23 20:30:01'),
(18, '../../assets/', 0, 27, '', '', 0, '', 'Luis espalha lixo e suas aventuras', 'vampiro a mascara', 'grandessíssimo luis espalha lixo esta de volta com seu plano de dominaçãomundial', 'Odisseia', 'Body Building', '18', 7, '', 'Mestre', '+18\r\nrespirar', '2023-11-26', '12:34:00', '2023-06-23 20:40:53'),
(19, '../../assets/', 0, 7, 'digatinho_dolatino@gmail.com', 'Lukinha Jesus', 611233, '(85) 9 9888-5555', 'ssdsd', 'sdsd', 'sdsd', '', '', '', 0, '', '', 'sdsdsd', '0000-00-00', '00:00:00', '2023-06-26 03:02:15'),
(20, '../../assets/images/Captura de tela 2023-06-14 193540.png', 0, 7, 'digatinho_dolatino@gmail.com', 'Lukinha Jesus Amado', 611233, '85981718210', 'Lotação em Izlude', '', '', '', 'Ação', '', 0, '', '', '', '0000-00-00', '00:00:00', '2023-06-26 03:29:17'),
(21, '../../assets/images/Captura de tela 2023-05-09 115833.png', 0, 31, 'wwagner33@gmail.com', 'Wellington W F Sarmento', 666666, '(85) 9 9888-5555', 'Covil dos Horrores', 'Story Telling', 'A morte virá para todes!', 'One-shot', 'Horror', 'L', 0, '', 'Livre', 'Saiba jogar RPG.', '2023-07-10', '15:58:00', '2023-07-10 18:58:14'),
(23, '../../assets/images/', 0, 2, 'ddiangelo02@gmail.com', 'Dai', 681823, '85988888888', 'Os Caminhos do Conhecimento', 'Ordem Paranormal', 'Será que o conhecimento se conquista ou se encontra?', 'One-shot', '', '14', 4, '', 'Livre', 'Ser nerdola fã de ordem', '2023-07-18', '18:30:00', '2023-07-16 15:31:56'),
(24, '../../assets/images/fafbe1b6ab2255bbcc77a4b4d014523.jpg', 0, 32, 'joao@gmail.com', 'Noah', 539294, '00000000000', 'caos', 'd&d', 'muito caos', 'One-shot', '', '14', 5, '', 'Livre', 'nenhum', '2023-07-31', '04:20:00', '2023-07-16 15:54:50'),
(25, '../../assets/images/', 0, 33, 'joao@gmail.com', 'joão', 789456, '0000000000', 'caos', 'd&d', 'muito caos', 'One-shot', '', 'L', 4, '', 'Livre', 'nenhum', '2023-08-12', '04:20:00', '2023-07-16 16:12:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id` int(10) UNSIGNED NOT NULL,
  `apelido_admin` varchar(30) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticia`
--

INSERT INTO `noticia` (`id`, `apelido_admin`, `titulo`, `subtitulo`, `data`, `foto`, `texto`) VALUES
(1, 'admin', 'Arte dos Orcs', 'Uma nova tendência no mercado, a arte dos orcs vira febre na terra média', '2023-07-08 23:30:34', '../../assets/orcs.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at diam libero. Duis odio ante, posuere sed nibh eu, pulvinar maximus turpis. Nullam auctor arcu magna, nec fringilla enim luctus sed. Quisque ullamcorper justo a dui aliquam ornare. Nullam quis odio non purus gravida hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis lectus ut ex pretium consequat vel sit amet ex. Morbi tempus nisi a sapien lacinia, vitae bibendum turpis pellentesque. Maecenas in neque dignissim orci gravida euismod nec vel lacus. Nullam tristique risus in nibh sagittis, et rutrum dolor facilisis.\n\nUt ornare dictum lorem, non finibus sapien suscipit a. Sed volutpat risus in tincidunt pretium. Nullam et consequat tortor. Pellentesque malesuada mi lacus, sed vulputate nulla feugiat at. Quisque eu bibendum nunc, vitae vehicula enim. Vivamus eros ligula, suscipit at lectus sed, suscipit ultrices risus. Vestibulum pellentesque et risus ac mattis. Duis lacinia facilisis nunc, at euismod purus ornare quis. Aliquam dignissim ultrices leo. Nunc molestie tortor et nulla suscipit, vel venenatis diam rutrum. In interdum velit ut consectetur hendrerit. Mauris nec vulputate urna. Proin vitae lectus non est blandit rutrum.\n\nMauris non neque ornare, gravida orci vel, cursus nisi. Morbi fermentum velit at ligula congue condimentum. In ut nunc vitae ex pulvinar porttitor ac nec ipsum. Proin at hendrerit risus, ac viverra lorem. Pellentesque in magna enim. Cras rutrum vehicula magna vitae mattis. Mauris lectus magna, tincidunt sit amet nisi non, dictum hendrerit nisi. Phasellus sed nisi non magna laoreet ornare. Mauris molestie enim nec lobortis pretium. Morbi id ante et lorem ultricies dignissim a non nisi.'),
(2, 'admin', 'Dia da Dracomancia', 'Venha conhecer as novidade da magia mais quente do mundo mágico!', '2023-07-08 23:30:49', '../../assets/zyra.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut dui id nunc auctor fringilla. Aenean vel ligula mi. Mauris vulputate porta ligula non scelerisque. Pellentesque sagittis tellus in enim posuere, vitae tincidunt orci facilisis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin ac ultricies diam. Cras ut mauris scelerisque, viverra lectus a, rhoncus enim. Proin pellentesque, ex at interdum mattis, ligula purus mattis mi, vitae sodales velit ipsum eget sem. Sed quis tortor sit amet tellus scelerisque efficitur. Phasellus laoreet, lectus in efficitur ultrices, metus lacus commodo purus, in scelerisque turpis arcu semper diam. Nunc finibus est quis nisi lacinia, in blandit urna euismod. Morbi fringilla mauris justo, sed viverra nunc venenatis vel.\r\n\r\nPraesent gravida enim at laoreet facilisis. Nullam gravida imperdiet risus, non elementum massa lacinia in. Nunc vestibulum, magna nec molestie blandit, nisi sem feugiat orci, sit amet fermentum ante nunc a erat. Integer eleifend ligula leo. Suspendisse potenti. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum quis odio diam.\r\n\r\nUt id accumsan dui, eu feugiat erat. Nulla nec dolor velit. Ut nibh tortor, pretium vel dictum vel, faucibus ut risus. Praesent ultrices tortor in vulputate vestibulum. Vestibulum blandit rutrum dui, ac tristique urna egestas sit amet. Vestibulum maximus tellus arcu, quis imperdiet nulla scelerisque nec. Phasellus euismod malesuada purus, eget convallis est egestas vitae. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla aliquam purus id nisi eleifend, sit amet euismod mi scelerisque. Fusce fringilla sed neque ac condimentum.'),
(3, 'admin', 'Agon: Um RPG de heróis gregos', 'Se você é apaixonado por jogos de RPG e mitologia grega, precisa conhecer Agon', '2023-07-08 23:30:53', '../../assets/agon.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut dui id nunc auctor fringilla. Aenean vel ligula mi. Mauris vulputate porta ligula non scelerisque. Pellentesque sagittis tellus in enim posuere, vitae tincidunt orci facilisis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin ac ultricies diam. Cras ut mauris scelerisque, viverra lectus a, rhoncus enim. Proin pellentesque, ex at interdum mattis, ligula purus mattis mi, vitae sodales velit ipsum eget sem. Sed quis tortor sit amet tellus scelerisque efficitur. Phasellus laoreet, lectus in efficitur ultrices, metus lacus commodo purus, in scelerisque turpis arcu semper diam. Nunc finibus est quis nisi lacinia, in blandit urna euismod. Morbi fringilla mauris justo, sed viverra nunc venenatis vel.\r\n\r\nPraesent gravida enim at laoreet facilisis. Nullam gravida imperdiet risus, non elementum massa lacinia in. Nunc vestibulum, magna nec molestie blandit, nisi sem feugiat orci, sit amet fermentum ante nunc a erat. Integer eleifend ligula leo. Suspendisse potenti. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum quis odio diam.\r\n\r\nUt id accumsan dui, eu feugiat erat. Nulla nec dolor velit. Ut nibh tortor, pretium vel dictum vel, faucibus ut risus. Praesent ultrices tortor in vulputate vestibulum. Vestibulum blandit rutrum dui, ac tristique urna egestas sit amet. Vestibulum maximus tellus arcu, quis imperdiet nulla scelerisque nec. Phasellus euismod malesuada purus, eget convallis est egestas vitae. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla aliquam purus id nisi eleifend, sit amet euismod mi scelerisque. Fusce fringilla sed neque ac condimentum.'),
(4, 'admin', 'Mesão de Aniversário d\'A Guilda!', 'Lorem Ipsum', '2023-07-08 23:30:58', '../../assets/bday!.jpg', 'teste'),
(5, 'admin', '', '', '2023-07-16 01:36:28', '../../assets/', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `mesas` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `matricula` int(6) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `recuperar_senha` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `foto`, `nome`, `apelido`, `bio`, `mesas`, `email`, `celular`, `discord`, `matricula`, `senha`, `recuperar_senha`, `admin`) VALUES
(1, '../../../assets/jared.jpg', 'Lukinha Jesus Amado', 'digo', 'OIIII', '3;12,14,', 'digatinho_dolatino@gmail.com', '85981718210', 'Digguerer#1223', 611233, '$2y$10$BWEmYFFJ7kTTM8m4XhxfLOY5eAIHw3QfVod0erkbqrjsmt.PZeQgW', NULL, 0),
(2, '../../../assets/images/Dai.jpg', 'Dai', 'ddiangelo', 'Linda, maravilhosa e perfeita :v', '12,', 'ddiangelo02@gmail.com', '85988888888', 'ddiangelo#0808', 681823, '$2y$10$kpmA7Ox7D1GrzhsUTRjolONw8U5U5slFLasjDT.VcRe/GQQ6Rlzhy', NULL, 0),
(3, '', 'catia', 'catia', 'sou catia e gosto de rpg', '', 'catiajogodoido@gmail.com', '85988888888', 'catiajogodoido', 387514, '$2y$10$hVAaa9HNfFD3AltKbzkXYevx/m/LyNyzfJMXTAQ71WV8j7lHcrvMS', NULL, 0),
(4, '', 'Wellington Wagner F. Sarmento', 'wwagner33', ';-) Professor e sofredor.', '', 'wwagner33@gmail.com', '85988891975', 'wwagner33', 17110932, '$2y$10$maEgMW1iVvIZyMn486cOF.2tkFuIEyTsFA4nIn6RNPpr1xBqmmrua', '$2y$10$fnCu8IMQdRFwrHGzEd3IZO/TsnQwYU48vQw9i7NYnlhnW8xDw.bcG', 0),
(5, '', '', 'Samuel', '', '', '', '', '', 0, '$2y$10$Av4BV2nPCK53WByec3UqGeg/BtQwOOWMhnzoiUc7DzblEJPb9jG1m', NULL, 0),
(6, '', 'Alairton Pascoal', 'Lala', 'Dev', '3,', 'alairton20@gmail.com', '85992736261', 'alairtonjr', 537678, '$2y$10$6aIpauMrifXnXkDhHdFIb.cB56i7Msf7tYiiG4vjN9DDEp66Ws37e', NULL, 0),
(7, '../../../assets/Captura de tela 2023-07-11 002047.png', 'Caio Henrique Capêlo', 'Caio', 'Sou apenas um garoto latino-americano', '5,', 'caiocapelo@alu.ufc.br', '', 'Caio#1221', 537459, '$2y$10$cI3af5iqWaELbFZqzSoWJ.6gPRVYdiYDVgpjaP.qkOWCp2hF3GxPS', NULL, 0),
(8, '', '', 'admin', '', '', '', '', '', NULL, '$2y$10$2bVeswS6JQyLDnU6gKeOYeLst84x.SbW9SLdbIfAxuotnorezqVEa', NULL, 1),
(9, '', '', 'jp', '', '9,', '', '', '', NULL, '$2y$10$41U019HQ6uLUmPcrPRW.c.pQh82V8o25InN7jcWPTViKT5l.daofy', NULL, 0),
(10, '', '', 'testeee', '', '', '', '', '', NULL, '$2y$10$k.rxVAArNZ1dv9idP6AbE.Anw1Zqqi0M3QxxkL5HuC4m4ctEmrYgu', NULL, 0),
(11, '', '', 'wwagner', '', '3,', '', '', '', NULL, '$2y$10$1ZhFdmRKl3TmwsW9gAN8DumCJd9WQjeFqzPtKCLd7sqWhFUmzen6S', NULL, 0),
(12, '', '', 'FlavinDoPeneu', '', '', '', '', '', NULL, '$2y$10$wecZCESqz/aMFjUiH8t5Fe1m5GURfVCbgBNCcc7voCzwaVEyQHQAG', NULL, 0),
(13, '', '', 'Wesley', '', '3,', '', '', '', NULL, '$2y$10$73060yZM.vSkoJqT24v3ZOR76zGwiZz8GHkzo1fY0drP.FmLtxlUa', NULL, 0),
(14, '', '', 'capeloo', '', '', '', '', '', NULL, '$2y$10$10bv2plAnRsgVIX6CaLI8OWPMyjeSxhXbQS7mhPzLWckIf90Cy3wS', NULL, 0),
(15, '', '', 'israleite', '', '12,', '', '', '', NULL, '$2y$10$PtW.c1xF/Lq7cjTzLFInkezezDNS2lFfBw5uzzoar3KMPSxBWdP5W', NULL, 0),
(16, '', '', 'dawn', '', '', '', '', '', NULL, '$2y$10$kuHMLlVo9eikwf8rC7eMT.7QN0M2Gu1RJXdU86z97cikwFhY2CMQm', NULL, 0),
(17, '', '', 'Ala', '', '14,', '', '', '', NULL, '$2y$10$skOAkuNhR4v/z5/9gy5PseiGIZcGBTCQ0Sj1bomZmNILkdthUpsDC', NULL, 0),
(18, '', '', 'jam', '', '', '', '', '', NULL, '$2y$10$7e3oyftv5gQRpighhnCKfeYV5t6LEhsDPnTKCkPraWWJZFMHogP2C', NULL, 0),
(19, '', '', 'biankaespalhalixo', '', '15,', '', '', '', NULL, '$2y$10$Qcf6xvk/1hZfnXh/7A9aNebQqKrKT0T8b0hGKCr5GqonE1Ioxyjt.', NULL, 0),
(20, '../../../assets/images/placeholder.jpg', '', 'new', '', '', '', '', '', NULL, '$2y$10$gxZ46s5SIeK4bKXgBMahPe8KgOJx.4kbU1UpX89bDfkcvyumy8ciC', NULL, 0),
(21, '../../../assets/images/placeholder.jpg', '', 'suho', '', '', '', '', '', NULL, '$2y$10$LiiBwPdChGclHfq.2VmE.ORPx6xdnIL1Mfa8Dxf8ibeCxVnIlAPs.', NULL, 0),
(22, '../../../assets/images/placeholder.jpg', '', 'isadora', '', '', '', '', '', NULL, '$2y$10$TEYck9A1xWSGYtJO8aDLN.fWr6X.4j03HT46dj/VoHLOoZ37Q4mQu', NULL, 0),
(23, '../../../assets/Captura de tela 2023-04-09 215357.png', 'Wellington W F Sarmento', 'wwagner_33', 'blá blá professor...', '3,', 'wwagner33@gmail.com', '(85) 9 9888-5555', 'ddiangelo#0808', 666666, '$2y$10$M3mKJwrbRNN/O023qIAr1u.HVldCDsMD7h/KsOmqfx2zpRFuZoH/6', NULL, 0),
(32, '../../../assets/', 'Noah', 'Noah', 'jogador de rpg', '', 'joao@gmail.com', '00000000000', '', 539294, '$2y$10$5z6pfl5GUvEYtjBvkMxnGOGkuflC2e9wCR0wlUAGgNWMu9tWlakKm', NULL, 0),
(33, '../../../assets/gato.jpg', 'joão', 'apelido123', 'jogador de rpg', '14,', 'joao@gmail.com', '0000000000', '', 789456, '$2y$10$2dwSvFjuRL9qShfwf7I02ereBrLRZMQVi/rl9KP4onS//V8CQlII2', NULL, 0),
(34, '../../../assets/images/placeholder.jpg', '', 'apelido456', '', '', '', '', '', NULL, '$2y$10$KLwiNZpJP1r967SgekJiHuJBmFNNNcGxSiE2XsGA1/QsTBzERYN92', NULL, 0),
(35, '../../../assets/gato.jpg', 'joao', 'apelido789', 'jogador de rpg', '', 'joao@gmail.com', '00000000', '', 0, '$2y$10$oYhYJiNtLdcsRaKVu1UWCu8E5wcznH.n90tZ9rWHhOBVmRNqeig6i', NULL, 0),
(36, '../../../assets/gato.jpg', 'joao', 'apelido', 'jogador de rpg', '', 'joao@gmail.com', '000000000', '', 0, '$2y$10$k0ABfYVi4Xz77BOUGmXj9.7dqBiS9fzpgq.1Lu/.PDk1mPZrN3936', NULL, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
