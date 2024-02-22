-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/02/2024 às 21:14
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teamschedule_app_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`, `user_id`) VALUES
(69, 'teste', '', '2024-04-10 00:00:00', '2024-04-11 00:00:00', 25),
(136, 'teste', '', '2024-02-28 00:00:00', '2024-02-29 00:00:00', 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `page` varchar(32) NOT NULL,
  `prefix` varchar(6) NOT NULL,
  `en` longtext NOT NULL,
  `pt` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `languages`
--

INSERT INTO `languages` (`id`, `page`, `prefix`, `en`, `pt`) VALUES
(1, 'section_footer', 'tr_1', 'About Us', 'Sobre nós'),
(2, 'section_footer', 'tr_2', 'Support', 'Suporte'),
(3, 'section_footer', 'tr_3', 'Help', 'Ajuda'),
(4, 'section_footer', 'tr_4', 'Affiliates', 'Afiliados'),
(5, 'section_footer', 'tr_5', 'Plans', 'Planos'),
(6, 'section_footer', 'tr_6', 'Security', 'Segurança'),
(7, 'section_footer', 'tr_7', 'Terms', 'Termos'),
(8, 'section_footer', 'tr_8', 'Privacy', 'Privacidade'),
(9, 'section_footer', 'tr_9', '', ''),
(10, 'section_footer', 'tr_10', '', ''),
(11, 'section_footer', 'tr_11', '', ''),
(12, 'section_footer', 'tr_12', '', ''),
(13, 'section_footer', 'tr_13', '', ''),
(14, 'section_footer', 'tr_14', '', ''),
(15, 'section_footer', 'tr_15', '', ''),
(16, 'section_footer', 'tr_16', '', ''),
(17, 'page_login', 'tr_17', 'Sign In', 'Entrar'),
(18, 'page_login', 'tr_18', 'We are glad to see you again!', 'Estamos felizes em ver você novamente!'),
(19, 'page_login', 'tr_19', 'Email Address', 'Endereço de email'),
(20, 'page_login', 'tr_20', 'Enter Your Email', 'Digite seu e-mail'),
(21, 'page_login', 'tr_21', 'Password', 'Senha'),
(22, 'page_login', 'tr_22', 'Enter Password', 'Digite a senha'),
(23, 'page_login', 'tr_23', 'Remember Me', 'Lembre de mim'),
(24, 'page_login', 'tr_24', 'Forgot Password ?', 'Esqueceu a senha?'),
(25, 'page_login', 'tr_25', 'Sign In', 'Entrar'),
(26, 'page_login', 'tr_26', 'Don\'t have an account?', 'Não tem uma conta?'),
(27, 'page_login', 'tr_27', 'Sign Up', 'Inscrever-se'),
(28, 'page_signup', 'tr_28', 'Sign Up', 'Inscrever-se'),
(29, 'page_signup', 'tr_29', 'Your data will be safe with us.', 'Seus dados estarão seguros conosco.'),
(30, 'page_signup', 'tr_30', 'Full Name', 'Nome completo'),
(31, 'page_signup', 'tr_31', 'Enter Your Name', 'Digite seu nome'),
(32, 'page_signup', 'tr_32', 'Email Address', 'Endereço de email'),
(33, 'page_signup', 'tr_33', 'Enter Your Email', 'Digite seu e-mail'),
(34, 'page_signup', 'tr_34', 'Password', 'Senha'),
(35, 'page_signup', 'tr_35', 'Enter Password', 'Digite a senha'),
(36, 'page_signup', 'tr_36', 'Sign Up', 'Inscrever-se'),
(37, 'page_signup', 'tr_37', 'Already have an account?', 'Já tem uma conta?'),
(38, 'page_signup', 'tr_38', 'Log In', 'Conecte-se'),
(39, 'page_signup', 'tr_39', '', ''),
(40, 'page_signup', 'tr_40', '', ''),
(41, 'page_signup', 'tr_41', '', ''),
(42, 'page_signup', 'tr_42', '', ''),
(43, 'section_header', 'tr_43', 'Home', 'Home'),
(44, 'section_header', 'tr_44', 'About', 'Sobre'),
(45, 'section_header', 'tr_45', '', 'Diretórios'),
(46, 'section_header', 'tr_46', '', 'Shop'),
(47, 'section_header', 'tr_47', 'Contact', 'Contato'),
(48, 'section_header', 'tr_48', '', 'Entrar'),
(49, 'section_header', 'tr_49', '', 'Criar conta'),
(50, 'section_header', 'tr_50', '', 'Biolinks'),
(51, 'section_header', 'tr_51', '', 'Cartão de visitas'),
(52, 'section_header', 'tr_52', '', 'Catálogo de produtos'),
(53, 'section_header', 'tr_53', '', 'Cardápio'),
(54, 'section_header', 'tr_54', '', 'Convites'),
(55, 'section_header', 'tr_55', '', 'Mini site'),
(56, 'section_header', 'tr_56', '', 'Santinho digital'),
(57, 'section_header', 'tr_57', '', 'Cadastro de Pets'),
(58, 'section_header', 'tr_58', '', 'Pessoas'),
(59, 'section_header', 'tr_59', '', 'Empresas'),
(60, 'section_header', 'tr_60', '', 'Pets'),
(61, 'section_header', 'tr_61', '', ''),
(62, 'section_header', 'tr_62', '', ''),
(63, 'section_header', 'tr_63', '', ''),
(64, 'section_header', 'tr_64', '', ''),
(65, 'section_header', 'tr_65', '', ''),
(66, 'section_header', 'tr_66', '', ''),
(67, 'section_header', 'tr_67', '', ''),
(68, 'section_head', 'tr_68', '', ''),
(69, 'section_head', 'tr_69', '', ''),
(70, 'page_verify', 'tr_70', '', 'Validar E-mail'),
(71, 'page_verify', 'tr_71', '', 'Precisamos validar seu e-mail.'),
(72, 'page_verify', 'tr_72', '', 'Código de validação'),
(73, 'page_verify', 'tr_73', '', 'Digite o código recebido aqui!'),
(74, 'page_verify', 'tr_74', '', 'Enviar'),
(75, 'page_verify', 'tr_75', '', 'Não recebeu?'),
(76, 'page_verify', 'tr_76', '', 'Enviar novamente.'),
(77, 'page_verify', 'tr_77', '', 'Enviamos um código para o seu email. Se não achou o código na caixa principal, veja na caixa de spam...'),
(78, 'section_hero', 'tr_78', 'Do more with your single link in bio', 'Faça mais com<br> o seu <span class=\"text-primary\"><u>único  link</u></span> de bio!'),
(79, 'section_hero', 'tr_79', 'With PopTag you create a beautiful page for your TikTok and Instagram bio in a few easy steps. Drive traffic, track audience growth, sell digital products and secure more business, all in one link!', 'Com a PopTag você cria uma bela página para sua biografia do TikTok e Instagram em algumas etapas fáceis. Impulsione o tráfego, acompanhe o crescimento do público, venda produtos digitais e garanta mais negócios, tudo em um link!'),
(80, 'section_hero', 'tr_80', 'Create Now!', 'Criar Agora!'),
(81, 'section_hero', 'tr_81', 'Demonstration', 'Demonstração');

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `recovery_token`
--

CREATE TABLE `recovery_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `start_token` datetime DEFAULT NULL,
  `expiration_token` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `recovery_token`
--

INSERT INTO `recovery_token` (`id`, `email`, `token`, `start_token`, `expiration_token`) VALUES
(9, 'admin@gmail.com', '3e25a52862b022da3ac81d5f6aee0330', '2023-09-03 18:18:25', '2023-09-04 18:18:25'),
(10, 'baggitech@gmail.com', '27955dc3c59d43ec9ffa88c7be1c6834', '2024-02-15 17:57:53', '2024-02-16 17:57:53'),
(11, 'eduardo.techbdc@gmail.com', '04b6aa795cfbfe5e72f2a58d8a09b8ed', '2024-02-15 17:49:25', '2024-02-16 17:49:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'main', '{\"title\":\"Your title\",\"default_language\":\"english\",\"default_timezone\":\"UTC\",\"index_url\":\"https://poptag.app\",\"terms_and_conditions_url\":\"\",\"privacy_policy_url\":\"\",\"not_found_url\":\"\",\"robots\":\"index, follow\",\"default_results_per_page\":25,\"default_order_type\":\"DESC\",\"auto_language_detection_is_enabled\":true,\"blog_is_enabled\":true,\"logo_email\":\"\",\"opengraph\":\"\",\"favicon\":\"favicon.png\",\"canonical\":\"https://poptag.app\",\"base_url\":\"https://poptag.app\"}'),
(2, 'users', '{\"email_confirmation\":false,\"register_is_enabled\":true,\"auto_delete_inactive_users\":0,\"user_deletion_reminder\":0}'),
(3, 'ads', '{\"header\":\"\",\"footer\":\"\",\"header_biolink\":\"\",\"footer_biolink\":\"\"}'),
(4, 'captcha', '{\"type\":\"basic\",\"recaptcha_public_key\":\"\",\"recaptcha_private_key\":\"\",\"login_is_enabled\":0,\"register_is_enabled\":0,\"lost_password_is_enabled\":0,\"resend_activation_is_enabled\":0}'),
(5, 'cron', '{\"key\":\"3e945d756e6ffd26b7c4117ed5af13b3\"}'),
(6, 'email_notifications', '{\"emails\":\"\",\"new_user\":\"0\",\"new_payment\":\"0\"}'),
(7, 'facebook', '{\"is_enabled\":\"0\",\"app_id\":\"\",\"app_secret\":\"\"}'),
(8, 'google', '{\"is_enabled\":\"0\",\"client_id\":\"\",\"client_secret\":\"\"}'),
(9, 'twitter', '{\"is_enabled\":\"0\",\"consumer_api_key\":\"\",\"consumer_api_secret\":\"\"}'),
(10, 'discord', '{\"is_enabled\":\"0\"}'),
(11, 'plan_custom', '{\"plan_id\":\"custom\",\"name\":\"Custom\",\"status\":1}'),
(12, 'plan_free', '{\"plan_id\":\"free\",\"name\":\"Free\",\"days\":null,\"status\":1,\"settings\":{\"additional_global_domains\":true,\"custom_url\":true,\"deep_links\":true,\"no_ads\":true,\"removable_branding\":true,\"custom_branding\":true,\"custom_colored_links\":true,\"statistics\":true,\"custom_backgrounds\":true,\"verified\":true,\"temporary_url_is_enabled\":true,\"seo\":true,\"utm\":true,\"socials\":true,\"fonts\":true,\"password\":true,\"sensitive_content\":true,\"leap_link\":true,\"api_is_enabled\":true,\"affiliate_is_enabled\":true,\"projects_limit\":10,\"pixels_limit\":10,\"biolinks_limit\":15,\"links_limit\":25,\"domains_limit\":1,\"enabled_biolink_blocks\":{\"link\":true,\"text\":true,\"image\":true,\"mail\":true,\"soundcloud\":true,\"spotify\":true,\"youtube\":true,\"twitch\":true,\"vimeo\":true,\"tiktok\":true,\"applemusic\":true,\"tidal\":true,\"anchor\":true,\"twitter_tweet\":true,\"instagram_media\":true,\"rss_feed\":true,\"custom_html\":true,\"vcard\":true,\"image_grid\":true,\"divider\":true}}}'),
(13, 'payment', '{\"is_enabled\":\"0\",\"type\":\"both\",\"brand_name\":\"phpBiolinks\",\"currency\":\"USD\", \"codes_is_enabled\": false}'),
(14, 'paypal', '{\"is_enabled\":\"0\",\"mode\":\"sandbox\",\"client_id\":\"\",\"secret\":\"\"}'),
(15, 'stripe', '{\"is_enabled\":\"0\",\"publishable_key\":\"\",\"secret_key\":\"\",\"webhook_secret\":\"\"}'),
(16, 'offline_payment', '{\"is_enabled\":\"0\",\"instructions\":\"Your offline payment instructions go here..\"}'),
(17, 'coinbase', '{\"is_enabled\":\"0\"}'),
(18, 'payu', '{\"is_enabled\":\"0\"}'),
(19, 'paystack', '{\"is_enabled\":\"0\"}'),
(20, 'razorpay', '{\"is_enabled\":\"0\"}'),
(21, 'mollie', '{\"is_enabled\":\"0\"}'),
(22, 'yookassa', '{\"is_enabled\":\"0\"}'),
(23, 'crypto_com', '{\"is_enabled\":\"0\"}'),
(24, 'paddle', '{\"is_enabled\":\"0\"}'),
(25, 'smtp', '{\"host\":\"\",\"from\":\"\",\"from_name\":\"\",\"encryption\":\"tls\",\"port\":\"587\",\"auth\":\"0\",\"username\":\"\",\"password\":\"\"}'),
(26, 'custom', '{\"head_js\":\"\",\"head_css\":\"\"}'),
(27, 'socials', '{\"facebook\":\"\",\"instagram\":\"\",\"twitter\":\"\",\"youtube\":\"\"}'),
(28, 'announcements', '{\"id\":\"\",\"content\":\"\",\"show_logged_in\":\"\",\"show_logged_out\":\"\"}'),
(29, 'business', '{\"invoice_is_enabled\":\"0\",\"name\":\"\",\"address\":\"\",\"city\":\"\",\"county\":\"\",\"zip\":\"\",\"country\":\"\",\"email\":\"\",\"phone\":\"\",\"tax_type\":\"\",\"tax_id\":\"\",\"custom_key_one\":\"\",\"custom_value_one\":\"\",\"custom_key_two\":\"\",\"custom_value_two\":\"\"}'),
(30, 'webhooks', '{\"user_new\": \"\", \"user_delete\": \"\"}'),
(31, 'cookie_consent', '{}'),
(32, 'links', '{\"branding\":\"by AltumCode\",\"shortener_is_enabled\":true,\"qr_codes_is_enabled\":true,\"biolinks_is_enabled\":true,\"files_is_enabled\":true,\"vcards_is_enabled\":true,\"directory_is_enabled\":true,\"directory_display\":\"verified\",\"domains_is_enabled\":true,\"main_domain_is_enabled\":true,\"blacklisted_domains\":\"\",\"blacklisted_keywords\":\"\",\"google_safe_browsing_is_enabled\":false,\"google_safe_browsing_api_key\":\"\",\"google_static_maps_is_enabled\":false,\"google_static_maps_api_key\":\"\",\"avatar_size_limit\":2,\"background_size_limit\":2,\"favicon_size_limit\":2,\"seo_image_size_limit\":2,\"thumbnail_image_size_limit\":2,\"image_size_limit\":2,\"audio_size_limit\":2,\"video_size_limit\":2,\"file_size_limit\":2,\"product_file_size_limit\":2}'),
(33, 'tools', ''),
(34, 'license', '{\"license\":\"\",\"type\":\"\"}'),
(35, 'product_info', '{\"version\":\"30.2.0\", \"code\":\"3020\"}'),
(36, 'preloader', 'disabled'),
(37, 'theme', '{\"default_theme_style\":\"light\",\"navbar_custom\":\"navbar-dark bg-primary border-0\",\"search_custom\":\"\",\"logo\":\"logo-light.png\",\"logo_sm\":\"logo-light-sm.png\"}'),
(38, 'twitter_og', '{\"card\":\"summary\",\"creator\":\"@PopTag_\",\"site\":\"@PopTag_\",\"domain\":\"poptag.app\",\"title\":\"@PopTag_ | Link na bio grátis e personalizado no Instagram\",\"description\":\"Crie agora o link na bio grátis! Deixe seu link do perfil incrível, personalize como quiser vários links no Instagram, TikTok e WhatsApp em único lugar!\",\"image\":\"ms-icon-144x144.png\"}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twofa_secret` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_phishing_code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `one_time_login_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_activation_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lost_password_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `plan_id` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `plan_expiration_date` datetime DEFAULT NULL,
  `plan_settings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_trial_done` tinyint(4) DEFAULT 0,
  `plan_expiry_reminder` tinyint(4) DEFAULT 0,
  `payment_subscription_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_processor` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_total_amount` float DEFAULT NULL,
  `payment_currency` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by_has_converted` tinyint(4) DEFAULT 0,
  `language` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'english',
  `timezone` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'UTC',
  `ip` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_user_agent` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_logins` int(11) DEFAULT 0,
  `user_deletion_reminder` tinyint(4) DEFAULT 0,
  `source` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'direct',
  `level` int(11) NOT NULL,
  `code_verify` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `billing`, `api_key`, `token`, `twofa_secret`, `anti_phishing_code`, `one_time_login_code`, `pending_email`, `email_activation_code`, `lost_password_code`, `type`, `verified`, `plan_id`, `plan_expiration_date`, `plan_settings`, `plan_trial_done`, `plan_expiry_reminder`, `payment_subscription_id`, `payment_processor`, `payment_total_amount`, `payment_currency`, `referral_key`, `referred_by`, `referred_by_has_converted`, `language`, `timezone`, `ip`, `country`, `last_activity`, `last_user_agent`, `total_logins`, `user_deletion_reminder`, `source`, `level`, `code_verify`) VALUES
(1, 'admin@gmail.com', '9b267f64fbfecc6fe57a4e51ebff29ecd3b84c10863a0847279cba076f776e3c', 'AltumCode', NULL, 'cc4c27ae1085ad965050c668c1f7bb7d', 'e7ef81a8614435cd3386075ecd7bb43eb466e43096ecb7b0aa18eab5f7102384', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'custom', '2030-01-01 12:00:00', '{\"additional_global_domains\":true,\"custom_url\":true,\"deep_links\":true,\"no_ads\":true,\"removable_branding\":true,\"custom_branding\":true,\"custom_colored_links\":true,\"statistics\":true,\"qr_is_enabled\":true,\"custom_backgrounds\":true,\"verified\":true,\"temporary_url_is_enabled\":true,\"seo\":true,\"utm\":true,\"fonts\":true,\"password\":true,\"sensitive_content\":true,\"leap_link\":true,\"api_is_enabled\":true,\"affiliate_is_enabled\":true,\"dofollow_is_enabled\":true,\"biolink_blocks_limit\":-1,\"projects_limit\":-1,\"pixels_limit\":-1,\"biolinks_limit\":-1,\"links_limit\":-1,\"domains_limit\":-1,\"track_links_retention\":-1,\"enabled_biolink_blocks\":{\"link\":true,\"heading\":true,\"paragraph\":true,\"avatar\":true,\"image\":true,\"socials\":true,\"mail\":true,\"soundcloud\":true,\"spotify\":true,\"youtube\":true,\"twitch\":true,\"vimeo\":true,\"tiktok\":true,\"applemusic\":true,\"tidal\":true,\"anchor\":true,\"twitter_tweet\":true,\"instagram_media\":true,\"rss_feed\":true,\"custom_html\":true,\"vcard\":true,\"image_grid\":true,\"divider\":true,\"faq\":true,\"discord\":true,\"facebook\":true,\"reddit\":true,\"audio\":true,\"video\":true,\"file\":true,\"countdown\":true,\"cta\":true,\"external_item\":true,\"share\":true,\"youtube_feed\":true}}', 0, 0, NULL, NULL, NULL, NULL, '96f3359c8a43dda4b9ad9bda57f1197f', NULL, 0, 'english', 'UTC', '::1', NULL, '2022-12-05 03:19:27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 2, 0, 'direct', 3, '604532'),
(25, 'baggitech@gmail.com', '9b267f64fbfecc6fe57a4e51ebff29ecd3b84c10863a0847279cba076f776e3c', 'Lazaro', NULL, NULL, '4c4fb7629f349a5e669d457fa03e23d1607b5e5d649f4a9ace3f30ea4c1bc946', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'english', 'UTC', NULL, NULL, NULL, NULL, 0, 0, 'direct', 1, '129750'),
(26, 'eduardo.techbdc@gmail.com', '9b267f64fbfecc6fe57a4e51ebff29ecd3b84c10863a0847279cba076f776e3c', 'Eduardo', NULL, NULL, '1d3ea248bbc115ee08023dcb5c9cacbede3c7a4034287d5187e0e85668ac88d2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'english', 'UTC', NULL, NULL, NULL, NULL, 0, 0, 'direct', 1, '583270');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Índices de tabela `recovery_token`
--
ALTER TABLE `recovery_token`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de tabela `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `recovery_token`
--
ALTER TABLE `recovery_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
