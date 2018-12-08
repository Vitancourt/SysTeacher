-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Dez-2018 às 23:23
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systeacher`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_id` int(11) NOT NULL,
  `primeiro_nome` varchar(50) NOT NULL,
  `segundo_nome` varchar(50) DEFAULT NULL,
  `ultimo_nome` varchar(50) NOT NULL,
  `datanascimento` date DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`aluno_id`, `primeiro_nome`, `segundo_nome`, `ultimo_nome`, `datanascimento`, `usuario_id`) VALUES
(1, 'Maikel', 'A', 'Vitancourt', '1993-04-15', 6),
(2, 'Milene', '', 'Mendes', '1996-04-15', 6),
(4, 'Teste', '', 'teste', '2018-12-25', 1),
(7, 'j', '', 'J', '2018-12-20', 6),
(8, 'Teste2', '', '2', '2018-11-27', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE `arquivo` (
  `arquivo_id` int(11) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `caminho` varchar(150) DEFAULT NULL,
  `nome_arquivo` varchar(150) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tamanho` varchar(100) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `arquivo`
--

INSERT INTO `arquivo` (`arquivo_id`, `descricao`, `caminho`, `nome_arquivo`, `tipo`, `criacao`, `tamanho`, `categoria_id`, `usuario_id`) VALUES
(1, 'Harry Potter', '20181203190906d0a0e4fb135f6d4a78c08018fafb6ed2', 'HP meme.png', 'image/png', '2018-12-03 19:03:36', '494133', 5, 6),
(2, 'Mestre dos Magos', '20181203190744bb78c330678efd759df81b5604bfe365', 'orientadormestre dos magos.jpg', 'image/jpeg', '2018-12-03 19:07:44', '140333', 5, 6),
(3, 'Artigo estendido', '20181203190807854fa0be8c16cad645d320aa43190c01', 'Artigo estendido.pdf', 'application/pdf', '2018-12-03 19:08:07', '1387977', 6, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `avaliacao_id` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `numero` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`avaliacao_id`, `descricao`, `numero`, `turma_id`) VALUES
(1, 'Prova 1', 1, 1),
(2, '', 2, 2),
(3, '', 2, 1),
(4, '', 3, 1),
(5, '', 1, 2),
(6, '', 1, 4),
(7, '', 2, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `descricao`, `criacao`, `usuario_id`) VALUES
(1, 'Aula de Programação Matemática', '2018-12-03 18:53:55', 6),
(2, 'Aula de Sistemas Distribuídos', '2018-12-03 18:54:09', 6),
(4, 'Aula de Linguagem de Programação 2', '2018-12-03 18:59:58', 6),
(5, 'Memes', '2018-12-03 19:03:17', 6),
(6, 'TCC', '2018-12-03 19:07:53', 6),
(7, 'Teste', '2018-12-04 20:03:15', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ciencia`
--

CREATE TABLE `ciencia` (
  `ciencia_id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ciencia`
--

INSERT INTO `ciencia` (`ciencia_id`, `descricao`) VALUES
(1, 'Ciências exatas e da terra'),
(2, 'Ciências Biológicas'),
(3, 'Engenharias'),
(4, 'Ciências da Saúde'),
(5, 'Ciências Agrárias'),
(6, 'Ciências Sociais Aplicadas'),
(7, 'Ciências Humanas'),
(8, 'Lingüística, Letras e Artes'),
(9, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo`
--

CREATE TABLE `conteudo` (
  `conteudo_id` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `disciplina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `conteudo`
--

INSERT INTO `conteudo` (`conteudo_id`, `descricao`, `disciplina_id`) VALUES
(1, 'Algebra', 1),
(2, 'Análise', 1),
(3, 'Geometria e Topologia', 1),
(4, 'Matemática Aplicada', 1),
(5, 'Probabiblidade', 2),
(6, 'Estatística', 2),
(7, 'Probabiblidade e Estatistica Aplicadas', 2),
(8, 'Teoria da computação', 3),
(9, 'Matemática da Computação', 3),
(10, 'Metodologias e Técnicas da Computação', 3),
(11, 'Sistemas de Computação', 3),
(12, 'Astronomia de Posição e Mecânica Celeste', 4),
(13, 'Astrofísica Estelar', 4),
(14, 'Astrofísica do Meio Interestelar', 4),
(15, 'Astrofísica Extragaláctica', 4),
(16, 'Astrofísica do Sistema Solar', 4),
(17, 'Instrumentação Astronômica', 4),
(18, 'Física Geral', 5),
(19, 'Áreas Clássicas de Fenomenologia e suas Aplicações', 5),
(20, 'Física das Partículas Elementares e Campos', 5),
(21, 'Física Nuclear', 5),
(22, 'Física Atômica e Molécular', 5),
(23, 'Física dos Fluidos, Física de Plasmas e Descargas Elétricas', 5),
(24, 'Física da Matéria Condensada', 5),
(25, 'Química Orgânica', 6),
(26, 'Química Inorgânica', 6),
(27, 'Físico-Química', 6),
(28, 'Química Analítica', 6),
(29, 'Geologia', 7),
(30, 'Geofísica', 7),
(31, 'Meteorologia', 7),
(32, 'Geodesia', 7),
(33, 'Geografia Física', 7),
(34, 'Oceanografia Biológica', 8),
(35, 'Oceanografia Física', 8),
(36, 'Oceanografia Química', 8),
(37, 'Oceanografia Geológica', 8),
(38, 'Tudo', 9),
(39, 'Genética Quantitativa', 10),
(40, 'Genética Molecular e de Microorganismos', 10),
(41, 'Genética Vegetal', 10),
(42, 'Genética Animal', 10),
(43, 'Genética Humana e Médica', 10),
(44, 'Mutagênese', 10),
(45, 'Paleobotânica', 11),
(46, 'Morfologia Vegetal', 11),
(47, 'Fisiologia Vegetal', 11),
(48, 'Taxonomia Vegetal', 11),
(49, 'Fitogeografia', 11),
(50, 'Botânica Aplicada', 11),
(51, 'Paleozoologia', 12),
(52, 'Morfologia dos Grupos Recentes', 12),
(53, 'Fisiologia dos Grupos Recentes', 12),
(54, 'Comportamento Animal', 12),
(55, 'Taxonomia dos Grupos Recentes', 12),
(56, 'Zoologia Aplicada', 12),
(57, 'Ecologia Teórica', 13),
(58, 'Ecologia de Ecossistemas', 13),
(59, 'Ecologia Aplicada', 13),
(60, 'Citologia e Biologia Celular', 14),
(61, 'Embriologia', 14),
(62, 'Histologia', 14),
(63, 'Anatomia', 14),
(64, 'Fisiologia Geral', 15),
(65, 'Fisiologia de Órgãos e Sistemas', 15),
(66, 'Fisiologia do Esforço', 15),
(67, 'Fisiologia Comparada', 15),
(68, 'Química de Macromoléculas', 16),
(69, 'Bioquímica de Microorganismos', 16),
(70, 'Metabolismo e Bioenergética', 16),
(71, 'Biologia Molecular', 16),
(72, 'Enzimologia', 16),
(73, 'Biofísica Molecular', 17),
(74, 'Biofísica Celular', 17),
(75, 'Biofísica de Processos e Sistemas', 17),
(76, 'Radiologia e Fotobiologia', 17),
(77, 'Farmacologia Geral', 18),
(78, 'Farmacologia Autonômica', 18),
(79, 'Neuropsicofarmacologia', 18),
(80, 'Farmacologia Cardiorenal', 18),
(81, 'Farmacologia Bioquímica e Molecular', 18),
(82, 'Etnofarmacologia', 18),
(83, 'Toxicologia', 18),
(84, 'Farmacologia Clínica', 18),
(85, 'Imunoquímica', 19),
(86, 'Imunologia Celular', 19),
(87, 'Imunogenética', 19),
(88, 'Imunologia Aplicada', 19),
(89, 'Biologia e Fisiologia dos Microorganismos', 20),
(90, 'Microbiologia Aplicada', 20),
(91, 'Protozoologia de Parasitos', 21),
(92, 'Helmintologia de Parasitos', 21),
(93, 'Entomologia e Malacologia de Parasitos e Vetores', 21),
(94, 'Construção Civil', 22),
(95, 'Estruturas', 22),
(96, 'Geotécnica', 22),
(97, 'Engenharia Hidráulica', 22),
(98, 'Infra-Estrutura de Transportes', 22),
(99, 'Construção Civil', 22),
(100, 'Pesquisa Mineral', 23),
(101, 'Lavra', 23),
(102, 'Tratamento de Minérios', 23),
(103, 'Instalações e Equipamentos Metalúrgicos', 24),
(104, 'Metalurgia Extrativa', 24),
(105, 'Metalurgia de Transformação', 24),
(106, 'Metalurgia Física', 24),
(107, 'Materiais não Metálicos', 24),
(108, 'Materiais Elétricos', 25),
(109, 'Medidas Elétricas, Magnéticas e Eletrônicas; Instrumentação', 25),
(110, 'Circuitos Elétricos, Magnéticos e Eletrônicos', 25),
(111, 'Sistemas Elétricos de Potência', 25),
(112, 'Eletrônica Industrial, Sistemas e Controles Eletrônicos', 25),
(113, 'Telecomunicações', 25),
(114, 'Fenômenos de Transporte', 26),
(115, 'Engenharia Térmica', 26),
(116, 'Mecânica dos Sólidos', 26),
(117, 'Projetos de Máquinas', 26),
(118, 'Processo de Fabricação', 26),
(119, 'Processos Industriais de Engenharia Química', 27),
(120, 'Operações Industriais e Equipamentos para Engenharia Química', 27),
(121, 'Tecnologia Química', 27),
(122, 'Recursos Hídricos', 28),
(123, 'Tratamento de Águas de Abastecimento e Residuárias', 28),
(124, 'Saneamento Básico', 28),
(125, 'Sanemanto Ambiental', 28),
(126, 'Gerência de Produção', 29),
(127, 'Pesquisa Operacional', 29),
(128, 'Engenharia de Produto', 29),
(129, 'Engenharia Econômica', 29),
(130, 'Aplicações de Radioisotopos', 30),
(131, 'Fusão Controlada', 30),
(132, 'Combustível Nuclear', 30),
(133, 'Planejamento de Transportes', 31),
(134, 'Veículos e Equipamentos de Controle', 31),
(135, 'Operações de Transportes', 31),
(136, 'Hidrodinâmica de Navios e Sistemas Oceânicos', 32),
(137, 'Estruturas Navais e Oceânicas', 32),
(138, 'Máquinas Maríticas', 32),
(139, 'Projeto de Navios e Sistema Oceânicos', 32),
(140, 'Tecnologia de Construção Naval e de Sistemas Oceânicos', 32),
(141, 'Aerodinâmica', 33),
(142, 'Dinâmica de Vôo', 33),
(143, 'Estruturas Aeroespaciais', 33),
(144, 'Materiais e Processos para Engenharia Aeronáutica e Aeroespacial', 33),
(145, 'Propulsão Aeroespacial', 33),
(146, 'Sistemas Aeroespaciais', 33),
(147, 'Bioengenharia', 34),
(148, 'Engenharia Médica', 34),
(149, 'Clínica Médica', 35),
(150, 'Cirurgia', 35),
(151, 'Saúde Materno-Infantil', 35),
(152, 'Anatomia Patológica e Patologia Clínica', 35),
(153, 'Radiologia Médica', 35),
(154, 'Medicina Legal e Deontologia', 35),
(155, 'Clínica Odontológica', 36),
(156, 'Ortogontia', 36),
(157, 'Odontopediatria', 36),
(158, 'Periodontia', 36),
(159, 'Endodontia', 36),
(160, 'Radiologia Odontológica', 36),
(161, 'Odontologia Social e Preventiva', 36),
(162, 'Materiais Odontológicos', 36),
(163, 'Farmacotecnia', 37),
(164, 'Farmacognosia', 37),
(165, 'Análise Toxicológica', 37),
(166, 'Análise e Controle e Medicamentos', 37),
(167, 'Bromatologia', 37),
(168, 'Enfermagem Médico-Cirúrgica', 38),
(169, 'Enfermagem Obstétrica', 38),
(170, 'Enfermagem Pediátrica', 38),
(171, 'Enfermagem Psiquiátrica', 38),
(172, 'Enfermagem de Doenças Contagiosas', 38),
(173, 'Enfermagem da Saúde Pública', 38),
(174, 'Bioquímica da Nutrição', 39),
(175, 'Dietética', 39),
(176, 'Análise Nutricional de População', 39),
(177, 'Desnutrição e Desenvolvimento Fisiológico', 39),
(178, 'Epidemiologia', 40),
(179, 'Saúde Pública', 40),
(180, 'Medicina Preventiva', 40),
(181, 'Geral', 41),
(182, 'Geral', 42),
(183, 'Geral', 43),
(184, 'Ciência do Solo', 44),
(185, 'Fitossanidade', 44),
(186, 'Fitotecnia', 44),
(187, 'Floricultura, Parques e Jardins', 44),
(188, 'Agrometeorologia', 44),
(189, 'Extensão Rural', 44),
(190, 'Silvicultura', 45),
(191, 'Manejo Florestal', 45),
(192, 'Técnicas e Operações Florestais', 45),
(193, 'Tecnologia e Utilização de Produtos Florestais', 45),
(194, 'Conservação da Natureza', 45),
(195, 'Energia de Biomassa Florestal', 45),
(196, 'Máquinas e Implementos Agrícolas', 46),
(197, 'Engenharia de Água e Solo', 46),
(198, 'Engenharia de Processamento de Produtos Agrícolas', 46),
(199, 'Construções Rurais e Ambiência', 46),
(200, 'Energização Rural', 46),
(201, 'Ecologia dos Animais Domésticos e Etologia', 47),
(202, 'Genética e Melhoramento dos Animais Domésticos', 47),
(203, 'Nutrição e Alimentação Animal', 47),
(204, 'Pastagem e Forragicultura', 47),
(205, 'Produção Animal', 47),
(206, 'Clínica e Cirugia Animal', 48),
(207, 'Medicina Veterinária Preventiva', 48),
(208, 'Patologia Animal', 48),
(209, 'Reprodução Animal', 48),
(210, 'Inspeção de Produtos de Origem Animal', 48),
(211, 'Recursos Pesqueiros Marinhos', 49),
(212, 'Recursos Pesqueiros de Águas Interiores', 49),
(213, 'Aquicultura', 49),
(214, 'Engenharia de Pesca', 49),
(215, 'Ciência de Alimentos', 50),
(216, 'Tecnologia de Alimentos', 50),
(217, 'Engenharia de Alimentos', 50),
(218, 'Teoria do Direito', 51),
(219, 'Direito Público', 51),
(220, 'Direito Privado', 51),
(221, 'Direitos Especiais', 51),
(222, 'Administração de Empresas', 52),
(223, 'Administração Pública', 52),
(224, 'Administração de Setores Específicos', 52),
(225, 'Ciências Contáveis', 52),
(226, 'Teoria Economica', 53),
(227, 'Métodos Quantitativos em Economia', 53),
(228, 'Economia Monetária e Fiscal', 53),
(229, 'Crescimento, Flutuações e Planejamento Econômico', 53),
(230, 'Economia Internacional', 53),
(231, 'Economia de Recursos Humanos', 53),
(232, 'Economia Industrial', 53),
(233, 'Economia do Bem-Estar Social', 53),
(234, 'Economia Regional e Urbana', 53),
(235, 'Economias Agrária e dos Recursos Naturais', 53),
(236, 'Fundamentos de Arquitetura e Urbanismo', 54),
(237, 'Projeto de Arquitetura e Urbanismo', 54),
(238, 'Tecnologia de Arquitetura e Urbanismo', 54),
(239, 'Paisagismo', 54),
(240, 'Fundamentos do Planejamento Urbano e Regional', 55),
(241, 'Métodos e Técnicas do Planejamento Urbano e Regional', 55),
(242, 'Serviços Urbanos e Regionais', 55),
(243, 'Distribuição Espacial', 56),
(244, 'Tendência Populacional', 56),
(245, 'Componentes de Dinâmica Demográfica', 56),
(246, 'Nupcialidade e Família', 56),
(247, 'Demografia Histórica', 56),
(248, 'Política Pública e População', 56),
(249, 'Fontes de Dados Demográficos', 56),
(250, 'Teoria da Informação', 57),
(251, 'Biblioteconomia', 57),
(252, 'Arquivologia', 57),
(253, 'Geral', 58),
(254, 'Teoria da Comunicação', 59),
(255, 'Jornalismo e Editoração', 59),
(256, 'Rádio e Televisão', 59),
(257, 'Relações Públicas e Propaganda', 59),
(258, 'Comunicação Visual', 59),
(259, 'Fundamentos do Serviço Social', 60),
(260, 'Serviço Social Aplicado', 60),
(261, 'Geral', 61),
(262, 'Programação Visual', 62),
(263, 'Desenho de Produto', 62),
(264, 'Geral', 63),
(265, 'História da Filosofia', 64),
(266, 'Metafísica', 64),
(267, 'Lógica', 64),
(268, 'Ética', 64),
(269, 'Epistemologia', 64),
(270, 'Filosofia Brasileira', 64),
(271, 'Fundamentos da Sociologia', 65),
(272, 'Sociologia do Conhecimento', 65),
(273, 'Sociologia do Desenvolvimento', 65),
(274, 'Sociologia Urbana', 65),
(275, 'Sociologia Rural', 65),
(276, 'Sociologia da Saúde', 65),
(277, 'Outras Sociologias Específicas', 65),
(278, 'Teoria Antropológica', 66),
(279, 'Etnologia Indígena', 66),
(280, 'Antropologia Urbana', 66),
(281, 'Antropologia Rural', 66),
(282, 'Antropologia das Populações Afro-Brasileiras', 66),
(283, 'Teoria e Método em Arqueologia', 67),
(284, 'Arqueologia Pré-Histórica', 67),
(285, 'Arqueologia Histórica', 67),
(286, 'Teoria e Filosofia da História', 68),
(287, 'História Antiga e Medieval', 68),
(288, 'História Moderna e Contemporânea', 68),
(289, 'História da América', 68),
(290, 'História das Ciências', 68),
(291, 'Geografia Humana', 69),
(292, 'Geografia Regional', 69),
(293, 'Fundamentos e Medidas da Psicologia', 70),
(294, 'Psicologia Experimental', 70),
(295, 'Psicologia Fisiológica', 70),
(296, 'Psicologia Comparativa', 70),
(297, 'Psicologia Cognitiva', 70),
(298, 'Psicologia do Desenvolvimento Humano', 70),
(299, 'Psicologia do Ensino e da Aprendizagem', 70),
(300, 'Psicologia do Trabalho e Organizacional', 70),
(301, 'Tratamento e Prevenção Psicológica', 70),
(302, 'Fundamentos da Educação', 71),
(303, 'Administração Educacional', 71),
(304, 'Planejamento e Avaliação Educacional', 71),
(305, 'Ensino-Aprendizagem', 71),
(306, 'Currículo', 71),
(307, 'Orientação e Aconselhamento', 71),
(308, 'Tópicos Específicos de Educação', 71),
(309, 'Teoria Política', 72),
(310, 'Estado e Governo', 72),
(311, 'Comportamento Político', 72),
(312, 'Políticas Públicas', 72),
(313, 'Política Internacional', 72),
(314, 'História da Teologia', 73),
(315, 'Teologia Moral', 73),
(316, 'Teologia Sistemática', 73),
(317, 'Teologia Pastoral', 73),
(318, 'Teoria e Análise Linguística', 74),
(319, 'Fisiologia da Linguagem', 74),
(320, 'Sociolinguística e Dialetologia', 74),
(321, 'Psicolinguística', 74),
(322, 'Linguística Aplicada', 74),
(323, 'Língua Portuguesa', 75),
(324, 'Línguas Estrangeiras Modernas', 75),
(325, 'Língua Clássica', 75),
(326, 'Teoria Literária', 75),
(327, 'Literatura Brasileira', 75),
(328, 'Outras Literaturas Vernáculas', 75),
(329, 'Literaturas Estrangeiras Modernas', 75),
(330, 'Literaturas Clássicas', 75),
(331, 'Literatura Comparada', 75),
(332, 'Fundamentos e Críticas das Artes', 76),
(333, 'Artes Plásticas', 76),
(334, 'Música', 76),
(335, 'Dança', 76),
(336, 'Teatro', 76),
(337, 'Ópera', 76),
(338, 'Fotografia', 76),
(339, 'Cinema', 76),
(340, 'Artes do Vídeo', 76),
(341, 'Educação Artística', 76),
(342, 'Geral', 77),
(343, 'Geral', 78),
(344, 'Geral', 79),
(345, 'Geral', 80),
(346, 'Geral', 81),
(347, 'Geral', 82),
(348, 'Geral', 83),
(349, 'Geral', 84),
(350, 'Geral', 85),
(351, 'Geral', 86),
(352, 'Geral', 87),
(353, 'Geral', 88),
(354, 'Geral', 89),
(355, 'Geral', 90),
(356, 'Geral', 91),
(357, 'Geral', 92),
(358, 'Geral', 93),
(359, 'Geral', 94),
(360, 'Geral', 95),
(361, 'Geral', 96),
(362, 'Geral', 97),
(363, 'Geral', 98);

-- --------------------------------------------------------

--
-- Estrutura da tabela `diario`
--

CREATE TABLE `diario` (
  `date` date NOT NULL,
  `presente` tinyint(1) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `vinculo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `diario`
--

INSERT INTO `diario` (`date`, `presente`, `turma_id`, `aluno_id`, `vinculo_id`) VALUES
('2018-12-03', 0, 1, 1, 1),
('2018-12-03', 0, 1, 2, 3),
('2018-12-03', 1, 2, 7, 7),
('2018-12-04', 1, 3, 4, 10),
('2018-12-04', 0, 3, 8, 9),
('2018-12-04', 1, 4, 4, 11),
('2018-12-05', 1, 3, 4, 10),
('2018-12-05', 1, 3, 8, 9),
('2018-12-06', 1, 1, 1, 1),
('2018-12-06', 1, 1, 2, 3),
('2018-12-06', 1, 3, 4, 10),
('2018-12-06', 1, 3, 8, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `disciplina_id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `ciencia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`disciplina_id`, `descricao`, `ciencia_id`) VALUES
(1, 'Matemática', 1),
(2, 'Probabilidade e Estatística', 1),
(3, 'Ciência da Computação', 1),
(4, 'Astronomia', 1),
(5, 'Física', 1),
(6, 'Química', 1),
(7, 'GeoCiências', 1),
(8, 'Oceanografia', 1),
(9, 'Biologia Geral', 2),
(10, 'Genética', 2),
(11, 'Botânica', 2),
(12, 'Zoologia', 2),
(13, 'Ecologia', 2),
(14, 'Morfologia', 2),
(15, 'Fisiologia', 2),
(16, 'Bioquímica', 2),
(17, 'Biofísica', 2),
(18, 'Farmacologia', 2),
(19, 'Imunologia', 2),
(20, 'Microbiologia', 2),
(21, 'Parasitologia', 2),
(22, 'Engenharia Civil', 3),
(23, 'Engenharia de Minas', 3),
(24, 'Engenharia de Materiais e Metalúrgica', 3),
(25, 'Engenharia Elétrica', 3),
(26, 'Engenharia Mecânica', 3),
(27, 'Engenharia Química', 3),
(28, 'Engenharia Sanitária', 3),
(29, 'Engenharia de Produção', 3),
(30, 'Engenharia Nuclear', 3),
(31, 'Engenharia de Transportes', 3),
(32, 'Engenharia Naval e Oceânica', 3),
(33, 'Engenharia Aeroespacial', 3),
(34, 'Engenharia Biomédica', 3),
(35, 'Medicina', 4),
(36, 'Odontologia', 4),
(37, 'Farmácia', 4),
(38, 'Enfermagem', 4),
(39, 'Nutrição', 4),
(40, 'Saúde Coletiva', 4),
(41, 'Fonoaudiologia', 4),
(42, 'Fisioterapia e Terapia Ocupacional', 4),
(43, 'Educação Física', 4),
(44, 'Agronomia', 5),
(45, 'Recuros Florestais e Engenharia Florestal', 5),
(46, 'Engenharia Agrícola', 5),
(47, 'Zootecnia', 5),
(48, 'Medicina Veterinária', 5),
(49, 'Recursos Pesqueiros e Engenharia de Pesca', 5),
(50, 'Ciência e Tecnologia de Alimentos', 5),
(51, 'Direito', 6),
(52, 'Administração', 6),
(53, 'Economia', 6),
(54, 'Arquitetura e Urbanismo', 6),
(55, 'Planejamento Urbano e Regional', 6),
(56, 'Demografia', 6),
(57, 'Ciência da Informação', 6),
(58, 'Museologia', 6),
(59, 'Comunicação', 6),
(60, 'Serviço Social', 6),
(61, 'Economia Doméstica', 6),
(62, 'Desenho Industrial', 6),
(63, 'Turismo', 6),
(64, 'Filosofia', 7),
(65, 'Sociologia', 7),
(66, 'Antropologia', 7),
(67, 'Arqueologia', 7),
(68, 'História', 7),
(69, 'Geografia', 7),
(70, 'Psicologia', 7),
(71, 'Educação', 7),
(72, 'Ciência Política', 7),
(73, 'Teologia', 7),
(74, 'Linguística', 8),
(75, 'Linguística', 8),
(76, 'Artes', 8),
(77, 'Administração Hospitalar', 9),
(78, 'Administração Rural', 9),
(79, 'Carreira Militar', 9),
(80, 'Carreira Religiosa', 9),
(81, 'Ciências', 9),
(82, 'Biomedicina', 9),
(83, 'Ciências Sociais', 9),
(84, 'Ciências Autuariais', 9),
(85, 'Decoração', 9),
(86, 'Desenho de Moda', 9),
(87, 'Desenho de Projetos', 9),
(88, 'Diplomacia', 9),
(89, 'Engenharia de Agrimensura', 9),
(90, 'Engenharia de Armamentos', 9),
(91, 'Engenharia Mecatrônica', 9),
(92, 'Engenharia Têxtil', 9),
(93, 'Estudos Sociais', 9),
(94, 'História Natural', 9),
(95, 'Química Industrial', 9),
(96, 'Relações Internacionais', 9),
(97, 'Relações Públicas', 9),
(98, 'Secretariado Executivo', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nota`
--

CREATE TABLE `nota` (
  `nota_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL COMMENT '// 0 a 100\n',
  `avaliacao_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `vinculo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `nota`
--

INSERT INTO `nota` (`nota_id`, `valor`, `avaliacao_id`, `aluno_id`, `vinculo_id`) VALUES
(1, 100, 1, 1, 1),
(3, 90, 1, 2, 3),
(4, 100, 3, 1, 1),
(6, 90, 3, 2, 3),
(7, 100, 4, 1, 1),
(9, 90, 4, 2, 3),
(12, 0, 5, 7, 7),
(13, 90, 6, 4, 11),
(14, 95, 7, 4, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE `questao` (
  `questao_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1  Descritiva\n2  Objetiva\n',
  `criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conteudo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `ciencia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`questao_id`, `descricao`, `tipo`, `criacao`, `conteudo_id`, `usuario_id`, `disciplina_id`, `ciencia_id`) VALUES
(1, '<p>O que &eacute; hardware e o que &eacute; software?</p>\r\n', 1, '2018-12-03 19:57:58', 8, 6, 3, 1),
(2, '<p>Quanto &eacute; 1+1</p>\r\n', 2, '2018-12-03 20:01:12', 4, 6, 1, 1),
(4, '<p>123</p>\r\n', 1, '2018-12-03 20:03:25', 217, 1, 50, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta_descritiva`
--

CREATE TABLE `resposta_descritiva` (
  `resposta_descritiva_id` int(11) NOT NULL,
  `resposta` text NOT NULL,
  `questao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resposta_descritiva`
--

INSERT INTO `resposta_descritiva` (`resposta_descritiva_id`, `resposta`, `questao_id`) VALUES
(1, '<p>Software &eacute; o que a gente xinga e hardware &eacute; o que a gente chuta</p>\r\n', 1),
(2, '<p>321</p>\r\n', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta_objetiva`
--

CREATE TABLE `resposta_objetiva` (
  `resposta_objetiva_id` int(11) NOT NULL,
  `resposta` text NOT NULL,
  `correta` tinyint(4) NOT NULL COMMENT '1 correta\n0 errada',
  `questao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resposta_objetiva`
--

INSERT INTO `resposta_objetiva` (`resposta_objetiva_id`, `resposta`, `correta`, `questao_id`) VALUES
(1, '<p><img src=\"/ckfinder/userfiles/files/1.png\" style=\"height:100px; width:100px\" /></p>\r\n', 0, 2),
(2, '<p><img src=\"/ckfinder/userfiles/files/2.png\" style=\"height:129px; width:109px\" /></p>\r\n', 1, 2),
(3, '', 0, 2),
(4, '', 0, 2),
(5, '', 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `turma_id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `ano` year(4) NOT NULL,
  `quantidade_avaliacao` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 Aberta\n2 Fechada',
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`turma_id`, `descricao`, `ano`, `quantidade_avaliacao`, `status`, `usuario_id`) VALUES
(1, 'Turma 0 - Beta Teste', 2019, 3, 1, 6),
(2, 'Turma 2', 2018, 3, 1, 6),
(3, 'Teste', 2018, 3, 1, 1),
(4, 'Turma66', 2018, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '0',
  `hash` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `email`, `senha`, `ativo`, `hash`) VALUES
(1, 'maikelvitancourt@gmail.com', '83d207e51217ab18acaf2e513225cd03cd3db81a', 1, ''),
(6, 'maikel-93@hotmail.com', '83d207e51217ab18acaf2e513225cd03cd3db81a', 1, ''),
(7, 'vitancourt1@gmail.com', '8f3786ebb8cb05d8dcaaf79b81fea543f37ff9cd', 0, '47f563143c522b80bb56bc2311ea40c7');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vinculo`
--

CREATE TABLE `vinculo` (
  `vinculo_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vinculo`
--

INSERT INTO `vinculo` (`vinculo_id`, `turma_id`, `aluno_id`) VALUES
(1, 1, 1),
(3, 1, 2),
(5, 1, 7),
(7, 2, 7),
(9, 3, 8),
(10, 3, 4),
(11, 4, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_id`),
  ADD KEY `fk_pessoa_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `arquivo`
--
ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`arquivo_id`),
  ADD KEY `fk_arquivo_categoria1_idx` (`categoria_id`),
  ADD KEY `fk_arquivo_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`avaliacao_id`),
  ADD KEY `fk_avaliacao_turma1_idx` (`turma_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`),
  ADD KEY `fk_categoria_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `ciencia`
--
ALTER TABLE `ciencia`
  ADD PRIMARY KEY (`ciencia_id`);

--
-- Indexes for table `conteudo`
--
ALTER TABLE `conteudo`
  ADD PRIMARY KEY (`conteudo_id`),
  ADD KEY `fk_conteudo_disciplina1_idx` (`disciplina_id`);

--
-- Indexes for table `diario`
--
ALTER TABLE `diario`
  ADD PRIMARY KEY (`date`,`turma_id`,`aluno_id`,`vinculo_id`),
  ADD KEY `fk_table1_turma1_idx` (`turma_id`),
  ADD KEY `fk_table1_aluno1_idx` (`aluno_id`),
  ADD KEY `fk_table1_vinculo1_idx` (`vinculo_id`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`disciplina_id`),
  ADD KEY `fk_disciplina_ciencia1_idx` (`ciencia_id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `fk_nota_avaliacao1_idx` (`avaliacao_id`),
  ADD KEY `fk_nota_aluno1_idx` (`aluno_id`),
  ADD KEY `fk_nota_vinculo1_idx` (`vinculo_id`);

--
-- Indexes for table `questao`
--
ALTER TABLE `questao`
  ADD PRIMARY KEY (`questao_id`),
  ADD KEY `fk_questao_conteudo1_idx` (`conteudo_id`),
  ADD KEY `fk_questao_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_questao_disciplina1_idx` (`disciplina_id`),
  ADD KEY `fk_questao_ciencia1_idx` (`ciencia_id`);

--
-- Indexes for table `resposta_descritiva`
--
ALTER TABLE `resposta_descritiva`
  ADD PRIMARY KEY (`resposta_descritiva_id`),
  ADD KEY `fk_resposta_descritiva_questao1_idx` (`questao_id`);

--
-- Indexes for table `resposta_objetiva`
--
ALTER TABLE `resposta_objetiva`
  ADD PRIMARY KEY (`resposta_objetiva_id`),
  ADD KEY `fk_resposta_objetiva_questao1_idx` (`questao_id`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`turma_id`),
  ADD KEY `fk_turma_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `vinculo`
--
ALTER TABLE `vinculo`
  ADD PRIMARY KEY (`vinculo_id`),
  ADD KEY `fk_vinculo_turma1_idx` (`turma_id`),
  ADD KEY `fk_vinculo_aluno1_idx` (`aluno_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `aluno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `arquivo`
--
ALTER TABLE `arquivo`
  MODIFY `arquivo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `avaliacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ciencia`
--
ALTER TABLE `ciencia`
  MODIFY `ciencia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `conteudo`
--
ALTER TABLE `conteudo`
  MODIFY `conteudo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `disciplina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `questao`
--
ALTER TABLE `questao`
  MODIFY `questao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resposta_descritiva`
--
ALTER TABLE `resposta_descritiva`
  MODIFY `resposta_descritiva_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resposta_objetiva`
--
ALTER TABLE `resposta_objetiva`
  MODIFY `resposta_objetiva_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `turma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vinculo`
--
ALTER TABLE `vinculo`
  MODIFY `vinculo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_pessoa_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `arquivo`
--
ALTER TABLE `arquivo`
  ADD CONSTRAINT `fk_arquivo_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_arquivo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`turma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `conteudo`
--
ALTER TABLE `conteudo`
  ADD CONSTRAINT `fk_conteudo_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `diario`
--
ALTER TABLE `diario`
  ADD CONSTRAINT `fk_table1_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`aluno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table1_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`turma_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table1_vinculo1` FOREIGN KEY (`vinculo_id`) REFERENCES `vinculo` (`vinculo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_ciencia1` FOREIGN KEY (`ciencia_id`) REFERENCES `ciencia` (`ciencia_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`aluno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_avaliacao1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`avaliacao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_vinculo1` FOREIGN KEY (`vinculo_id`) REFERENCES `vinculo` (`vinculo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `questao`
--
ALTER TABLE `questao`
  ADD CONSTRAINT `fk_questao_ciencia1` FOREIGN KEY (`ciencia_id`) REFERENCES `ciencia` (`ciencia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questao_conteudo1` FOREIGN KEY (`conteudo_id`) REFERENCES `conteudo` (`conteudo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questao_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questao_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `resposta_descritiva`
--
ALTER TABLE `resposta_descritiva`
  ADD CONSTRAINT `fk_resposta_descritiva_questao1` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`questao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `resposta_objetiva`
--
ALTER TABLE `resposta_objetiva`
  ADD CONSTRAINT `fk_resposta_objetiva_questao1` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`questao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `vinculo`
--
ALTER TABLE `vinculo`
  ADD CONSTRAINT `fk_vinculo_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`aluno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vinculo_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`turma_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
