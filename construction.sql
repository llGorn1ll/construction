-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 17 2025 г., 19:06
-- Версия сервера: 8.0.34-26-beget-1-1
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `v908115t_wedding`
--

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio_images`
--
-- Создание: Май 20 2025 г., 16:36
-- Последнее обновление: Июл 14 2025 г., 19:46
--

DROP TABLE IF EXISTS `portfolio_images`;
CREATE TABLE `portfolio_images` (
  `id` int NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `image_path`) VALUES
(63, 'uploads/img1.png'),
(64, 'uploads/img2.png'),
(65, 'uploads/img3.png'),
(66, 'uploads/img4.png'),
(67, 'uploads/img5.png'),
(68, 'uploads/img6.png'),
(69, 'uploads/img7.png'),
(70, 'uploads/img8.png'),
(71, 'uploads/img9.png'),
(72, 'uploads/img10.png'),
(73, 'uploads/img11.png'),
(74, 'uploads/img12.png'),
(75, 'uploads/img13.png'),
(76, 'uploads/img14.png'),
(77, 'uploads/img15.png'),
(78, 'uploads/img16.png'),
(79, 'uploads/img17.png'),
(80, 'uploads/img18.png'),
(81, 'uploads/img19.png'),
(82, 'uploads/img20.png'),
(83, 'uploads/img21.png'),
(84, 'uploads/img22.png'),
(85, 'uploads/img23.png'),
(89, 'uploads/img24.png');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--
-- Создание: Май 20 2025 г., 16:36
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `type`) VALUES
(1, 'Строительство домов из СИП панелей'),
(2, 'Разработка дизайна'),
(3, 'Каркасные дома'),
(4, 'Сантехнические услуги'),
(5, 'Разработка проекта'),
(6, 'Услуги электриков'),
(7, 'Строительные работы'),
(8, 'Отделка под ключ');

-- --------------------------------------------------------

--
-- Структура таблицы `statements`
--
-- Создание: Май 20 2025 г., 16:36
--

DROP TABLE IF EXISTS `statements`;
CREATE TABLE `statements` (
  `statements_id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` text NOT NULL,
  `services_id` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `file` varchar(255) NOT NULL,
  `dateOfApplication` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `statements`
--

INSERT INTO `statements` (`statements_id`, `user_id`, `description`, `services_id`, `status_id`, `file`, `dateOfApplication`) VALUES
(27, 7, 'домина', 1, 1, 'uploads/OculusScreenshot1729702061.jpeg', '2025-04-26 12:07:18'),
(28, 7, 'апап', 4, 1, 'uploads/Снимок экрана 2024-03-17 200217.png', '2025-04-26 12:09:41'),
(29, 7, 'а', 3, 1, 'без файла', '2025-04-26 12:09:55'),
(30, 7, 'вв', 4, 1, 'uploads/Снимок экрана 2023-11-14 095846.png', '2025-04-26 12:10:09'),
(31, 7, '88005553535', 3, 1, 'без файла', '2025-04-26 12:11:27'),
(32, 7, 'а', 8, 1, 'без файла', '2025-04-26 12:15:19'),
(33, 7, 'а', 2, 2, 'без файла', '2025-04-26 12:18:01'),
(34, 7, 'вапвап', 2, 3, 'без файла', '2025-04-26 12:18:06'),
(36, 7, 'fg', 2, 1, 'без файла', '2025-04-26 12:21:38'),
(37, 7, 'gfgdfg', 2, 3, 'uploads/Снимок экрана 2023-11-01 221621.png', '2025-04-26 12:21:50'),
(38, 7, 'ууууууууууу', 2, 3, 'без файла', '2025-04-28 14:15:31'),
(39, 7, '1736', 2, 3, 'без файла', '2025-04-28 14:36:46'),
(40, 6, 'андрей это ты', 3, 1, 'uploads/Снимок экрана 2023-11-26 144053.png', '2025-05-02 22:51:45'),
(41, 7, 'не надо фото ', 2, 1, 'uploads/рефератГорга.docx', '2025-05-02 22:53:56'),
(42, 7, '7867867', 2, 2, 'uploads/AnyDesk.exe', '2025-05-02 22:57:50'),
(43, 7, 'еетст уведы', 1, 1, 'без файла', '2025-05-05 12:25:01'),
(44, 7, '1234567890-=', 7, 1, 'без файла', '2025-05-11 17:14:15'),
(45, 7, 'тестовое сообщенрие', 6, 1, 'без файла', '2025-05-11 17:22:29'),
(46, 7, 'ertertert', 6, 1, 'без файла', '2025-05-11 17:28:00'),
(47, 7, 'тест файла номер 1', 4, 1, 'uploads/OculusScreenshot1729702061.jpeg', '2025-05-11 17:52:39'),
(48, 7, 'тест 5', 5, 1, 'uploads/results (1).pdf', '2025-05-11 17:59:17'),
(49, 7, '123', 2, 1, 'uploads/gor-shat.sql', '2025-05-11 18:22:12'),
(50, 7, '12374344', 5, 1, 'uploads/gor-shat.sql', '2025-05-11 18:22:35'),
(51, 7, '3123aasd', 1, 1, 'uploads/Снимок экрана 2025-05-11 155027.png', '2025-05-11 18:30:35'),
(52, 7, 'ntnt', 4, 1, 'uploads/Снимок экрана 2023-10-23 012421.png', '2025-05-12 11:47:58'),
(53, 7, 'тест малого размера файла файла', 3, 1, 'uploads/Снимок экрана 2025-05-10 233620.png', '2025-05-12 11:53:19'),
(54, 7, 'тест большого малого файла', 2, 2, 'uploads/Снимок экрана 2025-05-11 155011.png', '2025-05-12 11:58:53'),
(55, 12, 'проверка сообщения на почту ainzoalgown2020@gmail.com', 6, 2, 'uploads/Снимок экрана 2025-05-13 231206.png', '2025-05-15 14:22:01'),
(56, 12, 'проверка сообщения без файла ', 3, 2, 'без файла', '2025-05-15 14:27:15'),
(57, 12, 'теперь с файлом', 1, 2, 'uploads/OculusScreenshot1729702061.jpeg', '2025-05-15 14:27:35'),
(58, 7, 'тестовая отправка ', 8, 2, 'без файла', '2025-05-19 19:26:48'),
(59, 6, 'тест каркас дома', NULL, 2, 'uploads/Снимок экрана 2023-10-21 005340.png', '2025-05-20 19:03:01'),
(60, 6, 'тест строй работы без файла ', NULL, 4, 'без файла', '2025-05-20 19:03:22'),
(61, 13, 'Хочу дом', NULL, 2, 'без файла', '2025-06-15 15:37:47'),
(62, 13, 'ДООООм', NULL, 2, 'uploads/demo5.sql', '2025-06-15 15:39:15'),
(63, 14, 'я богдан', NULL, 2, 'uploads/PHPMailer-master.zip', '2025-06-15 17:18:48'),
(64, 7, 'TEETSTFile ', NULL, 1, 'uploads/gor-shat.sql', '2025-06-16 13:57:51'),
(65, 7, 'test select', NULL, 1, 'без файла', '2025-06-16 14:09:57'),
(66, 7, 'ntcnbhejdf', 4, 1, 'без файла', '2025-06-16 14:10:39'),
(67, 7, '16-06', 5, 1, 'без файла', '2025-06-16 14:15:27'),
(68, 7, ' 16-06-25', NULL, 1, 'без файла', '2025-06-16 14:16:24'),
(69, 7, '23123', NULL, 1, 'без файла', '2025-06-16 14:18:45'),
(70, 7, 'тестовое ', 3, 1, 'uploads/gor-shat.sql', '2025-06-16 14:23:41');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--
-- Создание: Май 20 2025 г., 16:36
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `type`) VALUES
(1, 'В рассмотрении'),
(2, 'Ожидайте звонка'),
(3, 'Принято'),
(4, 'Выполнено '),
(5, 'Отклонено');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Май 20 2025 г., 16:36
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `isAdmin` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `surname`, `name`, `patronymic`, `email`, `telephone`, `isAdmin`) VALUES
(6, '123', '$2y$10$2EUEa0a4khkqPY8FVf40qOw8PiCMPYiM4JD6zyFK0cneMqFwLupie', '123', '123', '123', '123@123.ru', '+7 (231)-123-12-31', 0),
(7, 'admin', '$2y$10$ZTtAYHmjb7GyizcS59U31OasOIGkl4jXznp50xG6ubxXDEU..kXKm', 'admin', 'admin', 'admin', 'admin@admin.admin', '+7 (234)-234-23-42', 1),
(8, '321', '$2y$10$vmA/606qy7HvQyMUAoI.wuokxT.yy3p4QiPwFGbaIyZYMUuWcoNJe', '321', '321', '321', '1312312@123123.com', '+7 (123)-123-12-31', 0),
(9, 'ываыав', '$2y$10$r7PAIA7/6rjboF79k2pGGuGEOtT6UUQiCTwXvAjyHp76MU2SOTzqq', 'аываы', 'аыва', 'ываыа', '2@@fd.g', '+7 (321)-312-31-23', 0),
(10, 'dfgdfgf', '$2y$10$W8utJfKOkhA9JqZc5UzWfOTasqQiEpKVf.ZthD1jnHkjnXca4IwHe', 'dfg dfg', 'dfg dfg', 'df gdfg dffg', 'dgdfgdg', '+7 (212)-312-31-23', 0),
(11, 'dfsdfewf', '$2y$10$a4eE0IA4IzoUuPTN/jjKWujJCuZ6fTO46PbW5bZJWvLfWnLh9dvCu', 'sdfsdfsdf', 'sdfsdfsfd', 'sdfsfdsdf', 'sfdsfdsfd$@123.4', '+7 (123)-123-12-31', 0),
(12, 'aaaaaa', '$2y$10$vnCvTceD9We8zJUvXK110u3pAxTxo6yDVnohb1TMvqVAljoimwwWK', 'a1nz', 'oal', 'gown', 'ainzoalgown2020@gmail.com', '+7 (900)-000-00-01', 0),
(13, 'gorga', '$2y$10$PIfHT6LTb0rLFMsAtXfLHeOfXx3I7akwQ6ssBYhPauSoEqgv.f1Nu', 'gorga', 'nikita', 'sergeevich', 'gorganikita02@gmail.com', '+7 (908)-116-29-23', 0),
(14, 'bogdan', '$2y$10$GQCF.otQKpGE2wACFglzqugJA2IpuCW.lnGbCTp/04I./jnSnzhoi', 'bogdan', 'bogdan', 'bogdan', 'sebro124@gmail.com', '+7 (333)-222-66-66', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`statements_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `services_id` (`services_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `statements`
--
ALTER TABLE `statements`
  MODIFY `statements_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `statements`
--
ALTER TABLE `statements`
  ADD CONSTRAINT `statements_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `statements_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `statements_ibfk_3` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
