-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 02 2018 г., 16:07
-- Версия сервера: 10.1.34-MariaDB
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `journal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `master` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `area`
--

INSERT INTO `area` (`id`, `name`, `code`, `master`, `created_at`, `updated_at`) VALUES
(8, 'участок обрубки и термообработки', 'О', NULL, '2018-11-01 12:44:54', '2018-11-01 12:44:54'),
(9, 'плавильный участок', 'П', NULL, '2018-11-01 12:45:15', '2018-11-01 12:45:15'),
(10, 'участок формовки', 'Ф', NULL, '2018-11-01 12:45:32', '2018-11-01 12:45:32');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `area_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `description`, `area_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Оборудование 12', NULL, 8, 1, '2018-10-31 12:56:30', '2018-11-02 10:55:38'),
(2, 'rytu', NULL, 0, 1, '2018-10-31 22:55:39', '2018-11-02 10:45:58');

-- --------------------------------------------------------

--
-- Структура таблицы `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `less30min` tinyint(1) NOT NULL,
  `area_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `disrepair_description` varchar(255) DEFAULT NULL,
  `continues_used` tinyint(1) DEFAULT NULL,
  `manufacture_member_id` int(11) NOT NULL,
  `time_fixed` timestamp NULL DEFAULT NULL,
  `service_member_id` int(11) NOT NULL DEFAULT '0',
  `work_comment` varchar(255) DEFAULT NULL,
  `worktypes_id` int(11) DEFAULT '0',
  `master_comment` text,
  `service_comment` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `journal`
--

INSERT INTO `journal` (`id`, `less30min`, `area_id`, `equipment_id`, `disrepair_description`, `continues_used`, `manufacture_member_id`, `time_fixed`, `service_member_id`, `work_comment`, `worktypes_id`, `master_comment`, `service_comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 8, 1, 'Ничего не работает', NULL, 2, NULL, 1, 'kjgk hjk', 0, NULL, NULL, 0, '2018-11-02 11:15:23', '2018-11-02 11:15:23');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_05_30_000000_create_permission_role_table', 1),
(3, '2017_05_30_000000_create_permissions_table', 1),
(4, '2017_05_30_000000_create_role_user_table', 1),
(5, '2017_05_30_000000_create_roles_table', 1),
(6, '2017_05_30_000000_create_users_table', 1),
(7, '2018_10_21_144023_create_cards_table', 2),
(8, '2018_10_21_150951_create_balance_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manage_user', 'Управление пользователями', 'Управление пользователями', NULL, NULL),
(2, 'add_user', 'Добавить пользователя', 'Добавить пользователя', NULL, NULL),
(3, 'edit_user', 'Редактировать пользователя', 'Редактировать пользователя', NULL, NULL),
(4, 'delete_user', 'Удалить пользователя', 'Удалить пользователя', NULL, NULL),
(5, 'manage_role', 'Управление ролями', 'Управление ролями', NULL, NULL),
(6, 'add_role', 'Добавить роль', 'Добавить роль', NULL, NULL),
(7, 'edit_role', 'Изменить роль', 'Изменить роль', NULL, NULL),
(8, 'delete_role', 'Удалить роль', 'Удалить роль', NULL, NULL),
(9, 'manage_equipment', 'Просмотр оборудованием', 'Просмотр оборудованием', NULL, NULL),
(10, 'add_equipment', 'Добавлять оборудование', 'Добавлять оборудование', NULL, NULL),
(11, 'edit_equipment', 'Редактировать оборудование', 'Редактировать оборудование', NULL, NULL),
(12, 'delete_equipment', 'Удалять оборудование', 'Удалять оборудование', NULL, NULL),
(13, 'manage_area', 'Просмотр участков', 'Просмотр участков', NULL, NULL),
(14, 'add_area', 'Добавить участок', 'Добавить участок', NULL, NULL),
(15, 'edit_area', 'Редактировать участок', 'Редактировать участок', NULL, NULL),
(16, 'delete_area', 'Удалять участок', 'Удалять участок', NULL, NULL),
(17, 'admin', 'Администратор', 'Доступ к админке', NULL, NULL),
(18, 'applicant', 'Заявитель', 'Доступ к интерфейсу заявителя', NULL, NULL),
(19, 'performer', 'Исполнитель', 'Доступ к интерфейсу исполнителя', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(19, 3),
(18, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin User', NULL, NULL),
(2, 'applicant', 'Заявитель', 'Заявитель', NULL, '2018-11-02 07:20:27'),
(3, 'performer', 'Исполнитель', 'Исполнитель', '2018-10-31 10:04:20', '2018-11-02 08:32:48');

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_cd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key_cd`, `type`, `display_value`, `value`, `created_at`, `updated_at`) VALUES
(1, 'EMAIL', 'TEXT', 'email', 'vasya@yandex.ru', '2018-10-31 09:28:09', '2018-10-31 09:28:09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notifyDetectedFault` tinyint(1) NOT NULL DEFAULT '0',
  `notifyFaultFix` tinyint(1) NOT NULL DEFAULT '0',
  `area_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `type`, `name`, `email`, `password`, `avatar`, `provider`, `provider_id`, `remember_token`, `notifyDetectedFault`, `notifyFaultFix`, `area_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin', 'admin@yandex.ru', '$2y$10$WkbOVND7enabohOUqXkHS.hIhiTSyHqxIr9cP6iE7gJo8hInCS6oi', NULL, NULL, NULL, 'ZjGmTNAEEUJYXPPUFErf1aKS4buzT52mof9DJC1kQzCiTbpO6FwRYh5UNVS7', 0, 1, NULL, '2018-10-20 21:13:57', '2018-11-01 13:31:53'),
(2, 2, 'admin', 'user', 'user@yandex.ru', '$2y$10$VQyB2nyeIGCw4POMLc19Nej9n5Z7a4clu2aNVHnMwO3p3vrvk90rO', NULL, NULL, NULL, '0ykyPnhcFwBut8qtQIDMLsfYuU48fOWDgZZaBupQ1Zh5GxtaW7mJhWWS4snT', 1, 1, 8, '2018-11-02 05:33:52', '2018-11-02 10:47:16');

-- --------------------------------------------------------

--
-- Структура таблицы `worktypes`
--

CREATE TABLE `worktypes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `worktypes`
--

INSERT INTO `worktypes` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'заменили деталь/узел целиком на имеющуюся в наличие', '1', '2018-11-01 12:46:44', '2018-11-01 12:46:44'),
(2, 'заменили деталь/узел целиком на купленную', '2', '2018-11-01 12:46:54', '2018-11-01 12:46:54'),
(3, 'заменили деталь/узел целиком на изготовленную', '3', '2018-11-01 12:47:04', '2018-11-01 12:47:04'),
(4, 'отремонтировали своими силами', '4', '2018-11-01 12:47:16', '2018-11-01 12:47:16'),
(5, 'отремонтировали на базе сторонней организации', '5', '2018-11-01 12:47:26', '2018-11-01 12:47:26'),
(6, 'другое', '6', '2018-11-01 12:47:37', '2018-11-01 12:47:37');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `worktypes_id` (`worktypes_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_cd_unique` (`key_cd`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `worktypes`
--
ALTER TABLE `worktypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `worktypes`
--
ALTER TABLE `worktypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
