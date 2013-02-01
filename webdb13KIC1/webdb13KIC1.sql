-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 01 feb 2013 om 10:50
-- Serverversie: 5.1.61
-- PHP-versie: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `webdb13KIC1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `spam` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Gegevens worden uitgevoerd voor tabel `posts`
--

INSERT INTO `posts` (`post_id`, `subject_id`, `user_id`, `content`, `date_time`, `spam`) VALUES
(1, 1, 1, 'Hoi, alles is nog lekker leeg nietwaar?', '2013-01-31 13:58:21', 0),
(2, 1, 1, 'Zo al 2 members op dit forum. Wordt al aardig groot!', '2013-01-31 13:58:21', 0),
(3, 1, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(4, 2, 1, 'This message has been deleted ...', '2013-01-31 17:48:42', 0),
(5, 3, 1, 'Write message here...', '2013-01-31 13:58:21', 0),
(6, 3, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(7, 4, 1, 'Write message here...', '2013-01-31 13:58:21', 0),
(8, 5, 1, 'Write message here...', '2013-01-31 13:58:21', 0),
(9, 2, 1, '<strong>tekst</strong>', '2013-01-31 13:58:21', 0),
(10, 2, 1, '<table border="1px" bordercolor="#FFFFFF">\r\n<tr>\r\n<td>HTML tags</td>\r\n</tr>\r\n</table>\r\n\r\n', '2013-01-31 13:58:21', 0),
(11, 2, 1, 'Dit onderwerp krijgt als het goed is bijna een highlight', '2013-01-31 13:58:21', 0),
(12, 2, 1, 'nog een reactie erbij', '2013-01-31 13:58:21', 0),
(13, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(14, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(15, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(16, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(17, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(18, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(19, 2, 1, 'laatstepost', '2013-01-31 13:58:21', 0),
(43, 2, 6, 'Write reaction here...', '2013-01-31 17:48:55', 0),
(20, 6, 1, 'sdfasdfsadf', '2013-01-31 13:58:21', 0),
(21, 6, 1, 'oke', '2013-01-31 17:48:05', 0),
(22, 6, 1, 'i get it', '2013-01-31 13:58:21', 0),
(23, 6, 1, 'www.niggaflip.com', '2013-01-31 13:58:21', 0),
(24, 6, 1, '<a href="www.niggaflip.com" />', '2013-01-31 13:58:21', 0),
(25, 6, 1, '', '2013-01-31 13:58:21', 0),
(26, 6, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(27, 6, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(28, 6, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(29, 6, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(30, 6, 1, 'This message has been deleted ...', '2013-01-31 13:58:21', 0),
(31, 6, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(32, 7, 1, 'NEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEee\r\nPS: er zat een pepernoot in', '2013-01-31 13:58:21', 0),
(33, 4, 1, 'wow gaaf', '2013-01-31 13:58:21', 0),
(34, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(35, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(36, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(37, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(38, 2, 1, 'Write reaction here...', '2013-01-31 13:58:21', 0),
(39, 8, 1, 'wat kost een set schijfremmen voor een roda R300 uit 2006?', '2013-01-31 13:58:21', 0),
(40, 9, 1, 'Hoe gaat het?', '2013-01-31 13:58:21', 0),
(41, 6, 1, 'Write reaction here...czvzcv', '2013-01-31 13:58:21', 0),
(42, 8, 1, 'Een remschijf voor een Roda R300 uit 2006 kost 120 euro', '2013-01-31 13:58:21', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `checked` tinyint(4) NOT NULL DEFAULT '0',
  `highlight` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_name` (`subject_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `subjects`
--

INSERT INTO `subjects` (`subject_id`, `user_id`, `subject_name`, `category`, `checked`, `highlight`) VALUES
(1, 2, 'Een nieuwe start', 'car unrelated', 1, 0),
(2, 2, 'nieuw onderwerp', 'technical issues', 1, 1),
(3, 2, 'Test', 'technical issues', 3, 0),
(4, 2, 'Test1', 'cartalk', 1, 0),
(5, 2, 'Hi', 'technical issues', 3, 0),
(6, 39, 'Blaaa', 'technical issues', 3, 0),
(7, 38, 'Mijn band klapte', 'technical issues', 1, 0),
(8, 43, 'schijfrem', 'technical issues', 1, 0),
(9, 2, 'Hallo!', 'car unrelated', 3, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `avatar` varchar(24) NOT NULL,
  `quote` varchar(100) NOT NULL,
  `account_type` varchar(3) NOT NULL DEFAULT 'usr',
  `infix` varchar(10) NOT NULL,
  `personal_text` varchar(75) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `country` varchar(100) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `user_data`
--

INSERT INTO `user_data` (`user_id`, `username`, `password`, `email`, `name`, `surname`, `avatar`, `quote`, `account_type`, `infix`, `personal_text`, `age`, `gender`, `country`, `register_date`, `verified`) VALUES
(1, 'kyll', '$1$dZ20wDa3$eg7pZJh.usQyMuwoYUfAK/', 'kyllianbroers@live.nl', 'Kyllian', 'Broers', 'avatars/kyll.png', 'groovy baby, yeah!', 'adm', '', '', 0, '', '', '2013-01-31 13:58:57', 1),
(3, 'q', '$1$.k.vEBsr$Bd9di4uQ7O9jCru0g8JQB0', 'q@q.nl', 'q', 'q', 'images/avatar.png', '', 'usr', '', '', 0, '', '', '2013-01-31 14:10:23', 1),
(4, 'Mike', '$1$yfO3vsy.$kwzyhtxV0N5hBWUkVxrki1', 'michael-_-chen@outlook.com', 'Michael', 'Chen', 'Abstract-012007-1a.jpg', 'Bye!', 'usr', '', 'Welcome!', 20, '', 'Netherlands', '2013-01-31 14:31:30', 1),
(9, 'michael', '$1$z4Pj2Vh7$UpGpKRV.SqP9CASTBith9/', 'mickeywhc@hotmail.com', 'michael', 'chen', 'Abstract-012007-1a.jpg', 'Lets do this!', 'usr', '', '', 0, '0', '', '2013-01-31 23:12:35', 1),
(6, 'Jenny', '$1$qtatDAEk$sq3491ag7MhffGKFZv3LS/', 'jennifer.roeting@gmail.com', 'Jennifer', 'Roeting', 'avatars/Jenny.png', 'Roda is awesome', 'adm', '', 'Hallo allemaal', 21, 'female', 'Netherlands', '2013-01-31 17:44:08', 1),
(8, 'w', '$1$p9MF2D1c$3RXQPixJo3y1uzlShic9m0', 'w@w.nl', 'w', 'w', 'avatars/w.png', '', 'usr', '', '', 0, '', '', '2013-01-31 22:59:00', 1),
(10, 'TestAdmin', 'admin', '', '', '', '', '', 'adm', '', '', 0, '', '', '2013-02-01 09:36:45', 1),
(11, 'TestUser', 'user', '', '', '', '', '', 'usr', '', '', 0, '', '', '2013-02-01 09:37:25', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
