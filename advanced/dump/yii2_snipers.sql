
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2_snipers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1561714020),
('moder', '8', 1561714020);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1561714020, 1561714020),
('moder', 1, NULL, NULL, NULL, 1561714020, 1561714020),
('TaskCreate', 2, NULL, NULL, NULL, 1561714020, 1561714020),
('TaskDelete', 2, NULL, NULL, NULL, 1561714020, 1561714020),
('TaskUpdate', 2, NULL, NULL, NULL, 1561714020, 1561714020);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'TaskCreate'),
('admin', 'TaskDelete'),
('admin', 'TaskUpdate'),
('moder', 'TaskCreate'),
('moder', 'TaskUpdate');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `channel` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `channel`, `message`, `user_id`, `created_at`) VALUES
(1, 'Task_1', 'Test', 2, '2019-07-04 15:58:33'),
(2, 'Task_1', 'Test', 1, '2019-07-04 15:59:01');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `title`, `content`, `user_id`) VALUES
(1, 'New message 1', 'hfhhhhhh hhhshhhdh', 1),
(3, 'Message 3', '333333333333333333333', 1),
(4, 'Message 4', '4444444444444444444', 1),
(5, 'Message 5', '55555555555555555555555', 1),
(6, 'Message 6', '6666666666666666666666666666', 1),
(7, 'Message 7', '77777777777777777777', 1),
(8, 'Message 8', '88888888888888888888888', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1561057021),
('m130524_201442_init', 1561057026),
('m140506_102106_rbac_init', 1561713983),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1561713983),
('m180523_151638_rbac_updates_indexes_without_prefix', 1561713983),
('m181129_173447_create_chat_table', 1562121018),
('m181206_180807_create_message_table', 1562809231),
('m190119_211940_create_task_statuses_table', 1561101039),
('m190119_212003_create_attachments_table', 1561102332),
('m190124_110200_add_verification_token_column_to_user_table', 1561057026),
('m190214_183602_create_telegram_offset_table', 1562759942),
('m190604_050756_create_tasks_table', 1561100968),
('m190621_092305_create_users_table', 1561109582),
('m190708_134431_create_projects_table', 1562760061);

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Название проекта',
  `description` varchar(255) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `creator_id`, `created`, `updated`) VALUES
(1, 'Таск трекер', 'Разработать таск трекер используя фреймворк Yii2.', 765641979, '2019-07-10 13:14:59', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Название задачи',
  `description` varchar(255) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `responsible_id` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `name`, `description`, `creator_id`, `responsible_id`, `deadline`, `status_id`, `created`, `updated`) VALUES
(1, 1, 'Task 1', 'Install Framework', 1, 2, '2019-07-11', 2, NULL, NULL),
(2, 1, 'Task 2', 'Create Migration', 1, 3, '2019-07-11', 3, NULL, NULL),
(3, 1, 'Task 3', 'Magic <a href=\'#\'> link </a>', 1, 4, '2019-07-18', 2, NULL, NULL),
(4, 1, 'Task 4', 'Magic', 1, 5, '2019-07-18', 2, NULL, NULL),
(5, 1, 'Task 5', 'Magic', 1, 6, '2019-07-18', 2, NULL, NULL),
(6, 1, 'Task 6', 'Magic', 1, 7, '2019-07-18', 2, NULL, NULL),
(7, 1, 'Task 7', 'Magic', 1, 8, '2019-07-18', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `task_attachments`
--

CREATE TABLE `task_attachments` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_attachments`
--

INSERT INTO `task_attachments` (`id`, `task_id`, `path`) VALUES
(1, 1, 'aXziHf8ULJR6aRCA5fQux0tvdgZu19lW.jpg'),
(2, 1, 'rU06-qNb4eSpVv0Y7QToxjJ1WfRQ5Se8.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `task_comments`
--

CREATE TABLE `task_comments` (
  `id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_comments`
--

INSERT INTO `task_comments` (`id`, `content`, `task_id`, `user_id`) VALUES
(1, 'Test', 1, 1),
(2, 'test', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `task_statuses`
--

CREATE TABLE `task_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_statuses`
--

INSERT INTO `task_statuses` (`id`, `name`) VALUES
(1, 'Новая'),
(2, 'В работе'),
(3, 'Выполнена'),
(4, 'Тестирование'),
(5, 'Доработка'),
(6, 'Закрыта');

-- --------------------------------------------------------

--
-- Структура таблицы `telegram_offset`
--

CREATE TABLE `telegram_offset` (
  `id` int(11) DEFAULT NULL,
  `timestamp_offset` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `telegram_offset`
--

INSERT INTO `telegram_offset` (`id`, `timestamp_offset`) VALUES
(196950289, '2019-07-10 10:31:14');

-- --------------------------------------------------------

--
-- Структура таблицы `telegram_subscribe`
--

CREATE TABLE `telegram_subscribe` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `channel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `telegram_subscribe`
--

INSERT INTO `telegram_subscribe` (`id`, `chat_id`, `channel`) VALUES
(1, 765641979, 'projects_create');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telegram_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `telegram_id`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'RBPVMDkJoSQfS1p0vMM_AFh8UBHRecbD', '$2y$13$fk8u7fRq6aSWCVZgEwy1D.3T9aws4UqJ3M7dwDPmbKN3LF.CNo1te', NULL, 'admin@task-tracker.site', NULL, 10, 1561111177, 1561111177, 'pf5rdIWQgqBlZ3rPzecL6ICnnjm04UeK_1561111177'),
(2, 'user', 'UK12lz8vhZBYFQvjdx8hFHp4VCUW1MTl', '$2y$13$PRgiWPpss58OTSRhAcNFTOWdluq0mIgjBiHIcU8RwlfRE6.7JJ2/O', NULL, 'user@task-tracker.site', NULL, 10, 1561111452, 1561111452, 'QzZ_seKMj0mcNQAbx7bgBd0zLxIwHKu0_1561111452'),
(3, 'Ivan', '4UhFhv0R7APHrj84GKH5B4m6TO-bE_wp', '$2y$13$gAu.0jjSs9JhFN0osNhZjOXpJ3EK1zk1ROT2SKmd4Z02yfIQf4hdS', NULL, 'ivan@task-tracker.site', NULL, 9, 1561111487, 1561111487, 'jLc4zarYnbDAecmDqC8hObxY9ZilOvdB_1561111487'),
(4, 'Vadim', 'qE6NlnJRX-5cIoRlv9IgFjfZssSlu4_C', '$2y$13$70q2H0zVLNg2eASaB3Qawu0JRFwCgZqT6RXy6s.R2SvRm3a4DG/nW', NULL, 'vadim@task-tracker.site', NULL, 9, 1561111528, 1561111528, 'RRrh6GC-HvRVCYQ5sjWEewKBT9TYnwxp_1561111528'),
(5, 'Sergey', 'EXmKygfOlMHK29K1teablvAtmW7cIf0X', '$2y$13$r3D05Ub6pG9Gs58C8niDouS6RxKooaa4/rpIpirTPKSt/tzLbYyuO', NULL, 'sergey@task-tracker.site', NULL, 9, 1561111565, 1561111565, 'qjijwGemaFD6Kt_RecDy_ajm52ddxw1F_1561111565'),
(6, 'Nikolay', 'X3FTJTRtHtfWzcGjQiqY2c_o_nhF9_5i', '$2y$13$c4AOXkmy39lu8qIuijaj6u/XpnaVOWtl9MNgKk1.KYnJiT/rkm3U2', NULL, 'nikolay@task-tracker.site', NULL, 9, 1561111603, 1561111603, 'kkzHqgd9bFzfgmzh98or3ih4I0Ssnt9k_1561111603'),
(7, 'Andrey', 'QVZQaF75DeMFr1mSOv8uT8LfOvrNq0p_', '$2y$13$O8pSc5jczRrpVF3ECmRj1u7HWNgjr5S0mS.2MHbFdlsoHKnrjcmE.', NULL, 'andrey@task-tracker.site', NULL, 9, 1561111646, 1561111646, 'aOB1kIldMQ7afNNqAmJfi8ajZUK_8Z3O_1561111646'),
(8, 'Alex', 'Q_j_M3kJ5E2OTkftNg2zKvMCRM2zRPH-', '$2y$13$F4MCKYIzfMnbbzs7ro65LumsshKgkzyvsFA3dg6RiNjxdop22EIdy', NULL, 'alex@task-tracker.site', NULL, 10, 1561111687, 1561111687, 'H4czP0qCw9V8L07JvyBtxjyiNhp_m7iY_1561111687');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_creator_idx` (`creator_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_creator_idx` (`creator_id`),
  ADD KEY `tasks_responsible_idx` (`responsible_id`),
  ADD KEY `tasks_status_idx` (`status_id`),
  ADD KEY `project_idx` (`project_id`);

--
-- Индексы таблицы `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_attachments_tasks` (`task_id`);

--
-- Индексы таблицы `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_tasks` (`task_id`),
  ADD KEY `fk_comments_users` (`user_id`);

--
-- Индексы таблицы `task_statuses`
--
ALTER TABLE `task_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `telegram_subscribe`
--
ALTER TABLE `telegram_subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chat_id` (`chat_id`),
  ADD KEY `channel_idx` (`channel`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `task_attachments`
--
ALTER TABLE `task_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `task_statuses`
--
ALTER TABLE `task_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `telegram_subscribe`
--
ALTER TABLE `telegram_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_responsible_id` FOREIGN KEY (`responsible_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_statuses` FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD CONSTRAINT `fk_attachments_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Ограничения внешнего ключа таблицы `task_comments`
--
ALTER TABLE `task_comments`
  ADD CONSTRAINT `fk_comments_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
