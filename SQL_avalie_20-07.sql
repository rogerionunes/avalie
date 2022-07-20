CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_usuario` enum('P','C','S') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=484 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cursos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nm_curso` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `turmas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_curso` bigint(20) unsigned NOT NULL,
  `nm_turma` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestre` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `turno` enum('M','T','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `turmas_id_curso_foreign` (`id_curso`),
  CONSTRAINT `turmas_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `disciplinas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_professor` bigint(20) unsigned NOT NULL,
  `nm_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `disciplinas_id_professor_foreign` (`id_professor`),
  CONSTRAINT `disciplinas_id_professor_foreign` FOREIGN KEY (`id_professor`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `turmas_disciplinas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `turma_id` bigint(20) unsigned NOT NULL,
  `disciplina_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `turmas_disciplinas_turma_id_foreign` (`turma_id`),
  KEY `turmas_disciplinas_disciplina_id_foreign` (`disciplina_id`),
  CONSTRAINT `turmas_disciplinas_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`),
  CONSTRAINT `turmas_disciplinas_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=404 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `avaliacoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_professor` bigint(20) unsigned NOT NULL,
  `id_curso` bigint(20) unsigned NOT NULL,
  `id_turma` bigint(20) unsigned NOT NULL,
  `id_disciplina` bigint(20) unsigned NOT NULL,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataValidade` datetime NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacoes_id_professor_foreign` (`id_professor`),
  KEY `avaliacoes_id_curso_foreign` (`id_curso`),
  KEY `avaliacoes_id_turma_foreign` (`id_turma`),
  KEY `avaliacoes_id_disciplina_foreign` (`id_disciplina`),
  CONSTRAINT `avaliacoes_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`),
  CONSTRAINT `avaliacoes_id_disciplina_foreign` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id`),
  CONSTRAINT `avaliacoes_id_professor_foreign` FOREIGN KEY (`id_professor`) REFERENCES `users` (`id`),
  CONSTRAINT `avaliacoes_id_turma_foreign` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `formularios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_curso` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_avaliacao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formularios_id_curso_foreign` (`id_curso`),
  CONSTRAINT `formularios_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `formularios_perguntas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_formulario` bigint(20) unsigned NOT NULL,
  `ordem` int(11) NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('notas','opcoes','texto') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloco` enum('DP','IA','O') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formularios_perguntas_id_formulario_foreign` (`id_formulario`),
  CONSTRAINT `formularios_perguntas_id_formulario_foreign` FOREIGN KEY (`id_formulario`) REFERENCES `formularios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=384 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `avaliacoes_notas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_id` bigint(20) unsigned NOT NULL,
  `pergunta_id` bigint(20) unsigned NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacoes_notas_avaliacao_id_foreign` (`avaliacao_id`),
  KEY `avaliacoes_notas_pergunta_id_foreign` (`pergunta_id`),
  CONSTRAINT `avaliacoes_notas_avaliacao_id_foreign` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacoes` (`id`),
  CONSTRAINT `avaliacoes_notas_pergunta_id_foreign` FOREIGN KEY (`pergunta_id`) REFERENCES `formularios_perguntas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5424 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;