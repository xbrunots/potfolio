-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Out-2019 às 11:01
-- Versão do servidor: 10.2.23-MariaDB
-- versão do PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u915481333_bborg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `tag` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `work`
--

INSERT INTO `work` (`id`, `tag`, `picture`, `title`, `description`, `link`) VALUES
(1, 'android kotlin java', 'img/logo-cea.jpeg', 'C&A Aplicativo Android', 'C&A: Comprar Online - Roupas, Moda e Eletrônicos', ''),
(2, 'android kotlin java', 'img/logo-xp.jpg', 'XP Investimentos', 'Desenvolvimento (ponta a ponta) e distribuição da evolução do app Minha Carteira XP para o', ''),
(3, 'android kotlin java', 'https://ww70.itau.com.br/M/MediaFiles/Comuns/Imagens/Home/miniatura-app-mobile.png', 'Banco Itaú', 'Evolução do Assistente Virtual', ''),
(4, 'android kotlin java', 'https://www.dicasvip.com/wp-content/uploads/2012/10/Fatura-Mastercard-Ita%C3%BA.jpg', 'Itaúcard', 'App Aquisição de Cartões de Crédito', ''),
(5, 'node sql javascript watson chatbot machine-learning', 'https://www.ibm.com/blogs/watson/wp-content/uploads/2017/06/blog_botGames_png_BlogBanner_050817.png', 'Lucy Chatbot', 'Lucy Chatbot Cognitivo - Hackathon IBM Bluehack 2017', 'https://www.youtube.com/watch?v=20i2EJ3HMY0'),
(6, 'android kotlin java node sql javascript', 'img/logo-tradein.jpg', 'Trade-In Força de Vendas', 'O Trade-In foi desenvolvido para otimizar a rotina do seu setor comercial', 'https://play.google.com/store/apps/details?id=com.inside.tradein'),
(7, 'android java php sql ', 'img/logo-android.png', 'Zerei', 'Zerei te ajuda a reduzir e até cortar vicios, e maus hábitos, mostrando o custo disso tanto para seu', ''),
(8, 'android kotlin java php sql javascript', 'img/logo-android.png', 'Superfit', 'O SuperFit 40, tem como proposta fundamental a criação de ferramentas de gestão integrada para acade', ''),
(9, 'unity ', 'img/logo-android.png', 'MarieBox', 'Game Para Celuares android', ''),
(10, 'php sql', 'img/web.svg', 'BlackReports Cloud MySQL', 'Sistema Web para Administração de Base de Dados MySQL Intuitivo e Moderno, Alternativa Poderosa ao P', ''),
(11, 'android java php sql ', 'img/logo-android.png', 'Doah App', 'Projeto desenvolvido durante a 4ª edição do Hackathon FIESP', ''),
(12, 'android java sql premiados javascript', 'img/logo-android.png', 'HydroAlert', 'Aplicação Mobile capaz de informar dados dos reservatórios de água de sua localidade em tempo real, ', ''),
(13, 'php javascript', 'img/web.svg', 'Mems Encontre um Meme', 'A proposta do Mems é agilizar a procura por Memes em toda internet, através de uma palavra chave ape', ''),
(14, 'javascript php sql cobol', 'img/web.svg', 'Artefacto Hot Site', 'Hot Site Para Venda Pontual do Ecommerce', ''),
(15, 'sql desktop sefaz', 'img/logo-desktop.png', 'DLL Manifesto NFe', 'DLL Desenvolvida para integração com a Receita Federal', ''),
(16, 'android sql ', 'img/logo-android.png', 'SQL Master Studio for Android', 'Gerenciamento e Administração de Bancos de Dados pelo Android', ''),
(17, 'desktop android sql php cobol', 'img/logo-android.png', 'Sextranet android', 'Efetua operações no servidor, através de parâmetros cadastrados, e/ou comandos SQL enviados via SMS ', ''),
(18, 'android sql php cobol', 'img/logo-android.png', 'WGET Mobile for Android', 'Funções basicas do ERP WGET para Android', ''),
(19, 'android java cobol sql php', 'img/logo-android.png', 'API CPM Tracking', 'API para comunicação entre o WGET e o App CPM Tracking ', ''),
(22, 'android kotlin java premiados', 'img/logo-win.png', 'Hackathon CI&T Think.Make.Move() Edição Sorocaba', '1° Lugar - Hackathon CI&T Think.Make.Move() Edição Sorocaba', ''),
(23, 'android kotlin java watson machine-learning premiados', 'img/logo-win.png', 'Melhor Aplicativo Mobile para o setor de Internet ', '1º Lugar - Melhor Aplicativo Mobile para o setor de Internet Banking', ''),
(24, 'desktop sql premiados', 'img/logo-win.png', 'GENS IDE', '(Nota 10 Execente pelo Baixaki) Ambiente Integrado de Desenvolvimento para aplicações web', 'https://www.baixaki.com.br/download/bruno-brito-gens.htm');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
