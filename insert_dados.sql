

INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("1","Ciências exatas e da terra");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("1","Matemática","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Algebra","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Análise","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geometria e Topologia","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Matemática Aplicada","1");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("2","Probabilidade e Estatística","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Probabiblidade","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Estatística","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Probabiblidade e Estatistica Aplicadas","2");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("3","Ciência da Computação","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria da computação","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Matemática da Computação","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Metodologias e Técnicas da Computação","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sistemas de Computação","3");


INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("4","Astronomia","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Astronomia de Posição e Mecânica Celeste","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Astrofísica Estelar","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Astrofísica do Meio Interestelar","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Astrofísica Extragaláctica","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Astrofísica do Sistema Solar","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Instrumentação Astronômica","4");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("5","Física","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Física Geral","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Áreas Clássicas de Fenomenologia e suas Aplicações","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Física das Partículas Elementares e Campos","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Física Nuclear","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Física Atômica e Molécular","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Física dos Fluidos, Física de Plasmas e Descargas Elétricas","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Física da Matéria Condensada","5");


INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("6","Química","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Química Orgânica","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Química Inorgânica","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Físico-Química","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Química Analítica","6");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("7","GeoCiências","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geofísica","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Meteorologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geodesia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geografia Física","7");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("8","Oceanografia","1");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Oceanografia Biológica","8");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Oceanografia Física","8");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Oceanografia Química","8");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Oceanografia Geológica","8");

/*END CIENCIAS EXATAS E DA TERRA */

/*BEGIN  CIENCIAS BIOLÓGICAS*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("2","Ciências Biológicas");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("9","Biologia Geral","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tudo","9");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("10","Genética","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Genética Quantitativa","10");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Genética Molecular e de Microorganismos","10");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Genética Vegetal","10");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Genética Animal","10");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Genética Humana e Médica","10");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Mutagênese","10");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("11","Botânica","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Paleobotânica","11");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Morfologia Vegetal","11");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia Vegetal","11");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Taxonomia Vegetal","11");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fitogeografia","11");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Botânica Aplicada","11");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("12","Zoologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Paleozoologia","12");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Morfologia dos Grupos Recentes","12");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia dos Grupos Recentes","12");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Comportamento Animal","12");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Taxonomia dos Grupos Recentes","12");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Zoologia Aplicada","12");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("13","Ecologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ecologia Teórica","13");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ecologia de Ecossistemas","13");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ecologia Aplicada","13");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("14","Morfologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Citologia e Biologia Celular","14");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Embriologia","14");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Histologia","14");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Anatomia","14");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("15","Fisiologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia Geral","15");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia de Órgãos e Sistemas","15");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia do Esforço","15");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia Comparada","15");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("16","Bioquímica","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Química de Macromoléculas","16");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Bioquímica de Microorganismos","16");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Metabolismo e Bioenergética","16");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Biologia Molecular","16");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enzimologia","16");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("17","Biofísica","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Biofísica Molecular","17");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Biofísica Celular","17");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Biofísica de Processos e Sistemas","17");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Radiologia e Fotobiologia","17");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("18","Farmacologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacologia Geral","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacologia Autonômica","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Neuropsicofarmacologia","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacologia Cardiorenal","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacologia Bioquímica e Molecular","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Etnofarmacologia","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Toxicologia","18");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacologia Clínica","18");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("19","Imunologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Imunoquímica","19");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Imunologia Celular","19");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Imunogenética","19");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Imunologia Aplicada","19");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("20","Microbiologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Biologia e Fisiologia dos Microorganismos","20");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Microbiologia Aplicada","20");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("21","Parasitologia","2");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Protozoologia de Parasitos","21");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Helmintologia de Parasitos","21");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Entomologia e Malacologia de Parasitos e Vetores","21");
/* END CIENCIAS BIOLOGICAS */


/*BEGIN  ENGENHARIAS*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("3","Engenharias");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("22","Engenharia Civil","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Construção Civil","22");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Estruturas","22");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geotécnica","22");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia Hidráulica","22");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Infra-Estrutura de Transportes","22");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Construção Civil","22");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("23","Engenharia de Minas","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Pesquisa Mineral","23");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Lavra","23");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tratamento de Minérios","23");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("24","Engenharia de Materiais e Metalúrgica","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Instalações e Equipamentos Metalúrgicos","24");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Metalurgia Extrativa","24");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Metalurgia de Transformação","24");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Metalurgia Física","24");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Materiais não Metálicos","24");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("25","Engenharia Elétrica","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Materiais Elétricos","25");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Medidas Elétricas, Magnéticas e Eletrônicas; Instrumentação","25");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Circuitos Elétricos, Magnéticos e Eletrônicos","25");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sistemas Elétricos de Potência","25");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Eletrônica Industrial, Sistemas e Controles Eletrônicos","25");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Telecomunicações","25");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("26","Engenharia Mecânica","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fenômenos de Transporte","26");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia Térmica","26");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Mecânica dos Sólidos","26");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Projetos de Máquinas","26");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Processo de Fabricação","26");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("27","Engenharia Química","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Processos Industriais de Engenharia Química","27");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Operações Industriais e Equipamentos para Engenharia Química","27");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tecnologia Química","27");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("28","Engenharia Sanitária","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Recursos Hídricos","28");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tratamento de Águas de Abastecimento e Residuárias","28");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Saneamento Básico","28");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sanemanto Ambiental","28");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("29","Engenharia de Produção","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Gerência de Produção","29");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Pesquisa Operacional","29");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia de Produto","29");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia Econômica","29");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("30","Engenharia Nuclear","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Aplicações de Radioisotopos","30");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fusão Controlada","30");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Combustível Nuclear","30");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("31","Engenharia de Transportes","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Planejamento de Transportes","31");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Veículos e Equipamentos de Controle","31");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Operações de Transportes","31");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("32","Engenharia Naval e Oceânica","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Hidrodinâmica de Navios e Sistemas Oceânicos","32");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Estruturas Navais e Oceânicas","32");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Máquinas Maríticas","32");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Projeto de Navios e Sistema Oceânicos","32");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tecnologia de Construção Naval e de Sistemas Oceânicos","32");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("33","Engenharia Aeroespacial","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Aerodinâmica","33");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Dinâmica de Vôo","33");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Estruturas Aeroespaciais","33");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Materiais e Processos para Engenharia Aeronáutica e Aeroespacial","33");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Propulsão Aeroespacial","33");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sistemas Aeroespaciais","33");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("34","Engenharia Biomédica","3");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Bioengenharia","34");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia Médica","34");

/* END CIENCIAS Engenharias */


/*BEGIN  CIENCIAS DA SAUDE*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("4","Ciências da Saúde");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("35","Medicina","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Clínica Médica","35");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Cirurgia","35");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Saúde Materno-Infantil","35");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Anatomia Patológica e Patologia Clínica","35");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Radiologia Médica","35");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Medicina Legal e Deontologia","35");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("36","Odontologia","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Clínica Odontológica","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ortogontia","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Odontopediatria","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Periodontia","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Endodontia","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Radiologia Odontológica","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Odontologia Social e Preventiva","36");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Materiais Odontológicos","36");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("37","Farmácia","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacotecnia","37");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Farmacognosia","37");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Análise Toxicológica","37");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Análise e Controle e Medicamentos","37");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Bromatologia","37");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("38","Enfermagem","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enfermagem Médico-Cirúrgica","38");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enfermagem Obstétrica","38");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enfermagem Pediátrica","38");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enfermagem Psiquiátrica","38");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enfermagem de Doenças Contagiosas","38");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Enfermagem da Saúde Pública","38");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("39","Nutrição","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Bioquímica da Nutrição","39");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Dietética","39");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Análise Nutricional de População","39");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Desnutrição e Desenvolvimento Fisiológico","39");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("40","Saúde Coletiva","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Epidemiologia","40");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Saúde Pública","40");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Medicina Preventiva","40");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("41","Fonoaudiologia","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","41");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("42","Fisioterapia e Terapia Ocupacional","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","42");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("43","Educação Física","4");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","43");

/* END CIENCIAS CIENCIAS DA SAUDE */


/*BEGIN  CIENCIAS AGRARIAS*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("5","Ciências Agrárias");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("44","Agronomia","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ciência do Solo","44");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fitossanidade","44");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fitotecnia","44");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Floricultura, Parques e Jardins","44");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Agrometeorologia","44");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Extensão Rural","44");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("45","Recuros Florestais e Engenharia Florestal","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Silvicultura","45");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Manejo Florestal","45");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Técnicas e Operações Florestais","45");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tecnologia e Utilização de Produtos Florestais","45");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Conservação da Natureza","45");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Energia de Biomassa Florestal","45");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("46","Engenharia Agrícola","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Máquinas e Implementos Agrícolas","46");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia de Água e Solo","46");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia de Processamento de Produtos Agrícolas","46");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Construções Rurais e Ambiência","46");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Energização Rural","46");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("47","Zootecnia","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ecologia dos Animais Domésticos e Etologia","47");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Genética e Melhoramento dos Animais Domésticos","47");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Nutrição e Alimentação Animal","47");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Pastagem e Forragicultura","47");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Produção Animal","47");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("48","Medicina Veterinária","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Clínica e Cirugia Animal","48");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Medicina Veterinária Preventiva","48");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Patologia Animal","48");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Reprodução Animal","48");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Inspeção de Produtos de Origem Animal","48");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("49","Recursos Pesqueiros e Engenharia de Pesca","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Recursos Pesqueiros Marinhos","49");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Recursos Pesqueiros de Águas Interiores","49");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Aquicultura","49");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia de Pesca","49");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("50","Ciência e Tecnologia de Alimentos","5");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ciência de Alimentos","50");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tecnologia de Alimentos","50");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Engenharia de Alimentos","50");

/* END CIENCIAS CIENCIAS AGRARIAS */


/*BEGIN  CIENCIAS SOCIAIS APLICADAS*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("6","Ciências Sociais Aplicadas");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("51","Direito","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria do Direito","51");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Direito Público","51");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Direito Privado","51");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Direitos Especiais","51");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("52","Administração","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Administração de Empresas","52");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Administração Pública","52");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Administração de Setores Específicos","52");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ciências Contáveis","52");


INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("53","Economia","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria Economica","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Métodos Quantitativos em Economia","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economia Monetária e Fiscal","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Crescimento, Flutuações e Planejamento Econômico","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economia Internacional","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economia de Recursos Humanos","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economia Industrial","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economia do Bem-Estar Social","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economia Regional e Urbana","53");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Economias Agrária e dos Recursos Naturais","53");


INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("54","Arquitetura e Urbanismo","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos de Arquitetura e Urbanismo","54");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Projeto de Arquitetura e Urbanismo","54");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tecnologia de Arquitetura e Urbanismo","54");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Paisagismo","54");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("55","Planejamento Urbano e Regional","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos do Planejamento Urbano e Regional","55");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Métodos e Técnicas do Planejamento Urbano e Regional","55");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Serviços Urbanos e Regionais","55");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("56","Demografia","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Distribuição Espacial","56");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tendência Populacional","56");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Componentes de Dinâmica Demográfica","56");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Nupcialidade e Família","56");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Demografia Histórica","56");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Política Pública e População","56");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fontes de Dados Demográficos","56");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("57","Ciência da Informação","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria da Informação","57");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Biblioteconomia","57");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Arquivologia","57");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("58","Museologia","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","58");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("59","Comunicação","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria da Comunicação","59");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Jornalismo e Editoração","59");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Rádio e Televisão","59");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Relações Públicas e Propaganda","59");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Comunicação Visual","59");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("60","Serviço Social","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos do Serviço Social","60");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Serviço Social Aplicado","60");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("61","Economia Doméstica","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","61");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("62","Desenho Industrial","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Programação Visual","62");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Desenho de Produto","62");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("63","Turismo","6");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","63");


/* END CIENCIAS CIENCIAS APLICADAS */


/*BEGIN  CIENCIAS SOCIAIS HUMANAS*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("7","Ciências Humanas");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("64","Filosofia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("História da Filosofia","64");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Metafísica","64");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Lógica","64");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ética","64");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Epistemologia","64");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Filosofia Brasileira","64");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("65","Sociologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos da Sociologia","65");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sociologia do Conhecimento","65");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sociologia do Desenvolvimento","65");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sociologia Urbana","65");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sociologia Rural","65");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sociologia da Saúde","65");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Outras Sociologias Específicas","65");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("66","Antropologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria Antropológica","66");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Etnologia Indígena","66");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Antropologia Urbana","66");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Antropologia Rural","66");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Antropologia das Populações Afro-Brasileiras","66");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("67","Arqueologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria e Método em Arqueologia","67");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Arqueologia Pré-Histórica","67");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Arqueologia Histórica","67");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("68","História","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria e Filosofia da História","68");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("História Antiga e Medieval","68");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("História Moderna e Contemporânea","68");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("História da América","68");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("História das Ciências","68");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("69","Geografia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geografia Humana","69");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geografia Regional","69");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("70","Psicologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos e Medidas da Psicologia","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia Experimental","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia Fisiológica","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia Comparativa","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia Cognitiva","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia do Desenvolvimento Humano","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia do Ensino e da Aprendizagem","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicologia do Trabalho e Organizacional","70");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tratamento e Prevenção Psicológica","70");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("71","Educação","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos da Educação","71");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Administração Educacional","71");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Planejamento e Avaliação Educacional","71");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ensino-Aprendizagem","71");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Currículo","71");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Orientação e Aconselhamento","71");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Tópicos Específicos de Educação","71");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("72","Ciência Política","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria Política","72");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Estado e Governo","72");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Comportamento Político","72");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Políticas Públicas","72");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Política Internacional","72");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("73","Teologia","7");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("História da Teologia","73");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teologia Moral","73");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teologia Sistemática","73");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teologia Pastoral","73");

/* END CIENCIAS CIENCIAS HUMANASS */


/*BEGIN  CIENCIAS Linguistica letras e ates*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("8","Lingüística, Letras e Artes");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("74","Linguística","8");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria e Análise Linguística","74");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fisiologia da Linguagem","74");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Sociolinguística e Dialetologia","74");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Psicolinguística","74");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Linguística Aplicada","74");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("75","Linguística","8");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Língua Portuguesa","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Línguas Estrangeiras Modernas","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Língua Clássica","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teoria Literária","75"); 
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Literatura Brasileira","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Outras Literaturas Vernáculas","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Literaturas Estrangeiras Modernas","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Literaturas Clássicas","75");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Literatura Comparada","75");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("76","Artes","8");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fundamentos e Críticas das Artes","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Artes Plásticas","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Música","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Dança","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Teatro","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Ópera","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Fotografia","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Cinema","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Artes do Vídeo","76");
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Educação Artística","76");

/* END CIENCIAS LETRAS E ARTES */


/*BEGIN  CIENCIAS Outras*/
INSERT INTO  ciencia ( ciencia_id ,  descricao ) VALUES ("9","Outros");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("77","Administração Hospitalar","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","77");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("78","Administração Rural","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","78");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("79","Carreira Militar","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","79");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("80","Carreira Religiosa","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","80");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("81","Ciências","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","81");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("82","Biomedicina","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","82");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("83","Ciências Sociais","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","83");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("84","Ciências Autuariais","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","84");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("85","Decoração","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","85");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("86","Desenho de Moda","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","86");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("87","Desenho de Projetos","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","87");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("88","Diplomacia","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","88");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("89","Engenharia de Agrimensura","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","89");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("90","Engenharia de Armamentos","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","90");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("91","Engenharia Mecatrônica","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","91");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("92","Engenharia Têxtil","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","92");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("93","Estudos Sociais","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","93");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("94","História Natural","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","94");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("95","Química Industrial","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","95");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("96","Relações Internacionais","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","96");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("97","Relações Públicas","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","97");

INSERT INTO  disciplina ( disciplina_id ,  descricao ,  ciencia_id ) VALUES ("98","Secretariado Executivo","9");;
INSERT INTO  conteudo ( descricao ,  disciplina_id ) VALUES ("Geral","98");

