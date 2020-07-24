--
-- Dumping data for table `projetos`
--

INSERT INTO `projetos` (`idprojetos`, `titulo`, `descricao`, `salario`, `cpffreela`, `imgurl`, `linguagem`, `dataentrega`, `cliente_cpf`) VALUES
(1, 'API NODE.JS', 'Uma aplicação que consiga acessar a API do IBGE que é disponibilizada gratuitamente.', '800', NULL, 'https://image.flaticon.com/icons/svg/892/892894.svg', 'JavaScript e Node.JS', '2021-12-30', 22234566111);

-- --------------------------------------------------------

--
-- Dumping data for table `reclamacoes`
--

INSERT INTO `reclamacoes` (`idreclamacoes`, `opniao`, `usuario_cpf`, `estrelas`) VALUES
(1, 'Esse site está ficando ótimo!', 12345487433, 5);

-- --------------------------------------------------------

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`cpf`, `nome`, `email`, `senha`, `datanascimento`, `telefone`, `experiencia`, `avatarurl`, `profissao`) VALUES
(10100111110, 'Caio Cichetti', 'caio_cichetti@outlook.com', 'e10adc3949ba59abbe56e057f20f883e', '2002-08-10', 19971480266, 'Experiente', 'https://image.flaticon.com/icons/svg/813/813445.svg', 'Desenvolvedor Back-end'),
(12345487433, 'Matheus Germano', 'matheus.ggcosta2014@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2003-10-10', 19984488004, 'Experiente', 'https://image.flaticon.com/icons/svg/449/449586.svg', 'Desenvolvedor front-end'),
(22234566111, 'Lucas Vinicius', 'lucas.lv405@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2002-10-10', 19987142390, 'Experiente', 'https://image.flaticon.com/icons/svg/813/813472.svg', 'Desenvolvedor front-end');
