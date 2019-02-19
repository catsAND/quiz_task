DROP TABLE IF EXISTS `quiz_list`;
CREATE TABLE IF NOT EXISTS `quiz_list` (
  `id` char(16) NOT NULL COMMENT 'id',
  `description` text NOT NULL COMMENT 'description',
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'status; 0 - not active, 1 - active',
  PRIMARY KEY (`id`),
  KEY `idx1` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table store all tests';

DROP TABLE IF EXISTS `quiz_list_trans`;
CREATE TABLE IF NOT EXISTS `quiz_list_trans` (
  `id` char(16) NOT NULL COMMENT 'quiz id',
  `lang` char(2) NOT NULL COMMENT 'language',
  `quiz` text COMMENT 'text',
  PRIMARY KEY (`id`,`lang`),
  CONSTRAINT `FK__quiz_list` FOREIGN KEY (`id`) REFERENCES `quiz_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Test translate';

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` char(16) NOT NULL COMMENT 'question id',
  `quiz_id` char(16) NOT NULL COMMENT 'quiz id',
  `description` text NOT NULL COMMENT 'question description',
  `weight` smallint(5) unsigned NOT NULL COMMENT 'order',
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'status; 0 - not active, 1 - active',
  PRIMARY KEY (`id`),
  KEY `idx1` (`quiz_id`),
  KEY `idx2` (`active`),
  KEY `idx3` (`weight`),
  CONSTRAINT `FK_quiz_questions_quiz_list` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Questions for tests';

DROP TABLE IF EXISTS `quiz_questions_trans`;
CREATE TABLE IF NOT EXISTS `quiz_questions_trans` (
  `id` char(16) NOT NULL COMMENT 'question id',
  `lang` char(2) NOT NULL COMMENT 'language',
  `question` text COMMENT 'text',
  PRIMARY KEY (`id`,`lang`),
  CONSTRAINT `FK_quiz_questions_trans_quiz_questions` FOREIGN KEY (`id`) REFERENCES `quiz_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Translation for questions';

DROP TABLE IF EXISTS `quiz_answers`;
CREATE TABLE IF NOT EXISTS `quiz_answers` (
  `id` smallint(5) unsigned NOT NULL COMMENT 'answer id',
  `question_id` char(16) NOT NULL COMMENT 'question id',
  `description` text NOT NULL COMMENT 'answer description',
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'status; 0 - not active, 1 - active',
  `correct` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - not correct, 1 - answer correct',
  PRIMARY KEY (`id`,`question_id`),
  KEY `idx1` (`question_id`),
  KEY `idx2` (`active`),
  CONSTRAINT `FK_quiz_answers_quiz_questions` FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Questions for tests';

DROP TABLE IF EXISTS `quiz_answers_trans`;
CREATE TABLE IF NOT EXISTS `quiz_answers_trans` (
  `id` smallint(5) unsigned NOT NULL COMMENT 'answer id',
  `question_id` char(16) NOT NULL COMMENT 'question id',
  `lang` char(2) NOT NULL COMMENT 'language',
  `answer` text COMMENT 'text',
  PRIMARY KEY (`id`,`question_id`,`lang`),
  KEY `FK_quiz_answers_trans_quiz_questions` (`question_id`),
  CONSTRAINT `FK_quiz_answers_trans_quiz_questions` FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_quiz_answers_trans_quiz_answers` FOREIGN KEY (`id`) REFERENCES `quiz_answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Translation for answers';

DROP TABLE IF EXISTS `quiz_users`;
CREATE TABLE IF NOT EXISTS `quiz_users` (
  `id` char(16) NOT NULL COMMENT 'user id',
  `quiz_id` char(16) NOT NULL COMMENT 'quiz id',
  `name` varchar(64) NOT NULL COMMENT 'user name',
  `ip` char(15) NOT NULL COMMENT 'user ip',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'timestamp when created',
  `finish_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'timestamp when user finished quiz',
  PRIMARY KEY (`id`),
  KEY `idx1` (`quiz_id`),
  CONSTRAINT `FK_users_quiz_list` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User list';

DROP TABLE IF EXISTS `quiz_users_answers`;
CREATE TABLE IF NOT EXISTS `quiz_users_answers` (
  `user_id` char(16) NOT NULL COMMENT 'user id',
  `answer_id` smallint(5) unsigned NOT NULL COMMENT 'answer id',
  `answer_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'answer date',
  PRIMARY KEY (`user_id`,`answer_id`),
  KEY `idx1` (`answer_id`),
  CONSTRAINT `FK_quiz_users_answers_quiz_answers` FOREIGN KEY (`answer_id`) REFERENCES `quiz_answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_answers_users` FOREIGN KEY (`user_id`) REFERENCES `quiz_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users answers';

INSERT INTO `quiz_list` (`id`, `description`, `active`) VALUES
	('1CCE7B14688FAD49', 'fourth test', '0'),
	('335B156A9061BCDA', 'first test', '1'),
	('4A54F2BF3CC9201A', 'second test', '1'),
	('9C3FD9BA34F023EF', 'third test', '1');

INSERT INTO `quiz_list_trans` (`id`, `lang`, `quiz`) VALUES
	('1CCE7B14688FAD49', 'en', 'fourth test'),
	('335B156A9061BCDA', 'en', 'first test'),
	('4A54F2BF3CC9201A', 'en', 'second test'),
	('9C3FD9BA34F023EF', 'en', 'third test');

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `description`, `weight`, `active`) VALUES
	('01F1058ADC713ADE', '9C3FD9BA34F023EF', 'question test3', 30, '1'),
	('04802C9F8D53289D', '335B156A9061BCDA', 'question test1', 30, '1'),
	('0DB9CFF235888D81', '4A54F2BF3CC9201A', 'question test2', 30, '1'),
	('13D1388A4BD62EB6', '9C3FD9BA34F023EF', 'question test3', 20, '1'),
	('36FEED1C7010EEF6', '9C3FD9BA34F023EF', 'question test3', 10, '1'),
	('3FA3326F5914741D', '1CCE7B14688FAD49', 'question test4', 10, '1'),
	('64AD61BBD78AF616', '4A54F2BF3CC9201A', 'question test2', 10, '1'),
	('8DD143A41FC3AC22', '1CCE7B14688FAD49', 'question test4', 20, '1'),
	('A3CE5703DE411421', '9C3FD9BA34F023EF', 'question test3', 40, '0'),
	('AA10BF5D6B65A09E', '9C3FD9BA34F023EF', 'question test3', 40, '1'),
	('BFE2113D543DACE1', '335B156A9061BCDA', 'question test1', 20, '1'),
	('D045DB3A3632DB7A', '4A54F2BF3CC9201A', 'question test2', 20, '1'),
	('D1BCE4F11B0CA530', '335B156A9061BCDA', 'question test1', 10, '1'),
	('DAAF6F5BDF4DD5A6', '4A54F2BF3CC9201A', 'question test2', 50, '1'),
	('E7E0686BC4D14A98', '4A54F2BF3CC9201A', 'question test2', 40, '1');

INSERT INTO `quiz_questions_trans` (`id`, `lang`, `question`) VALUES
	('01F1058ADC713ADE', 'en', 'Third question'),
	('04802C9F8D53289D', 'en', 'First question'),
	('0DB9CFF235888D81', 'en', 'Third question'),
	('13D1388A4BD62EB6', 'en', 'Second question'),
	('36FEED1C7010EEF6', 'en', 'First question'),
	('3FA3326F5914741D', 'en', 'First question'),
	('64AD61BBD78AF616', 'en', 'First question'),
	('8DD143A41FC3AC22', 'en', 'Second question'),
	('A3CE5703DE411421', 'en', 'Fiveth question is inactive'),
	('AA10BF5D6B65A09E', 'en', 'Fourth question with one inactive answer'),
	('BFE2113D543DACE1', 'en', 'Second question'),
	('D045DB3A3632DB7A', 'en', 'Second question'),
	('D1BCE4F11B0CA530', 'en', 'Third question'),
	('DAAF6F5BDF4DD5A6', 'en', 'Fiveth question'),
	('E7E0686BC4D14A98', 'en', 'Fourth question');

INSERT INTO `quiz_answers` (`id`, `question_id`, `description`, `active`, `correct`) VALUES
	(1, '01F1058ADC713ADE', 'question 3', '1', '0'),
	(1, '04802C9F8D53289D', 'question 1', '1', '0'),
	(1, '0DB9CFF235888D81', 'question 3', '1', '0'),
	(1, '13D1388A4BD62EB6', 'question 2', '1', '0'),
	(1, '36FEED1C7010EEF6', 'question 1', '1', '0'),
	(1, '3FA3326F5914741D', 'question 1', '1', '0'),
	(1, '64AD61BBD78AF616', 'question 1', '1', '0'),
	(1, '8DD143A41FC3AC22', 'question 2', '1', '0'),
	(1, 'A3CE5703DE411421', 'question 5', '1', '0'),
	(1, 'AA10BF5D6B65A09E', 'question 4', '1', '0'),
	(1, 'BFE2113D543DACE1', 'question 2', '1', '0'),
	(1, 'D045DB3A3632DB7A', 'question 2', '1', '0'),
	(1, 'D1BCE4F11B0CA530', 'question 3', '1', '0'),
	(1, 'DAAF6F5BDF4DD5A6', 'question 5', '1', '0'),
	(1, 'E7E0686BC4D14A98', 'question 4', '1', '0'),
	(2, '01F1058ADC713ADE', 'question 3', '1', '1'),
	(2, '04802C9F8D53289D', 'question 1', '1', '0'),
	(2, '0DB9CFF235888D81', 'question 3', '1', '1'),
	(2, '13D1388A4BD62EB6', 'question 2', '1', '1'),
	(2, '36FEED1C7010EEF6', 'question 1', '1', '1'),
	(2, '3FA3326F5914741D', 'question 1', '1', '0'),
	(2, '64AD61BBD78AF616', 'question 1', '1', '1'),
	(2, '8DD143A41FC3AC22', 'question 2', '1', '1'),
	(2, 'A3CE5703DE411421', 'question 5', '1', '1'),
	(2, 'AA10BF5D6B65A09E', 'question 4', '1', '1'),
	(2, 'BFE2113D543DACE1', 'question 2', '1', '0'),
	(2, 'D045DB3A3632DB7A', 'question 2', '1', '1'),
	(2, 'D1BCE4F11B0CA530', 'question 3', '1', '0'),
	(2, 'DAAF6F5BDF4DD5A6', 'question 5', '1', '1'),
	(2, 'E7E0686BC4D14A98', 'question 4', '1', '1'),
	(3, '01F1058ADC713ADE', 'question 3', '1', '0'),
	(3, '04802C9F8D53289D', 'question 1', '1', '0'),
	(3, '0DB9CFF235888D81', 'question 3', '1', '0'),
	(3, '13D1388A4BD62EB6', 'question 2', '1', '0'),
	(3, '36FEED1C7010EEF6', 'question 1', '1', '1'),
	(3, '3FA3326F5914741D', 'question 1', '1', '1'),
	(3, '8DD143A41FC3AC22', 'question 2', '1', '0'),
	(3, 'A3CE5703DE411421', 'question 5', '1', '0'),
	(3, 'AA10BF5D6B65A09E', 'question 4', '0', '0'),
	(3, 'BFE2113D543DACE1', 'question 2', '1', '0'),
	(3, 'D045DB3A3632DB7A', 'question 2', '1', '0'),
	(3, 'D1BCE4F11B0CA530', 'question 3', '1', '0'),
	(3, 'DAAF6F5BDF4DD5A6', 'question 5', '1', '0'),
	(3, 'E7E0686BC4D14A98', 'question 4', '1', '0'),
	(4, '04802C9F8D53289D', 'question 1', '1', '1'),
	(4, 'BFE2113D543DACE1', 'question 2', '1', '0'),
	(4, 'D1BCE4F11B0CA530', 'question 3', '1', '0'),
	(5, 'BFE2113D543DACE1', 'question 2', '1', '0'),
	(5, 'D1BCE4F11B0CA530', 'question 3', '1', '1'),
	(6, 'BFE2113D543DACE1', 'question 2', '1', '0'),
	(7, 'BFE2113D543DACE1', 'question 2', '1', '1');

INSERT INTO `quiz_answers_trans` (`id`, `question_id`, `lang`, `answer`) VALUES
	(1, '01F1058ADC713ADE', 'en', 'mollitia esse'),
	(1, '04802C9F8D53289D', 'en', 'correct answer'),
	(1, '0DB9CFF235888D81', 'en', 'mollitia esse'),
	(1, '13D1388A4BD62EB6', 'en', 'amet consectetur'),
	(1, '36FEED1C7010EEF6', 'en', 'lorem ipsum'),
	(1, '3FA3326F5914741D', 'en', 'lorem ipsum'),
	(1, '64AD61BBD78AF616', 'en', 'lorem ipsum'),
	(1, '8DD143A41FC3AC22', 'en', 'amet consectetur'),
	(1, 'A3CE5703DE411421', 'en', 'Beatae quam'),
	(1, 'AA10BF5D6B65A09E', 'en', 'Labore reprehenderit'),
	(1, 'BFE2113D543DACE1', 'en', 'correct answer'),
	(1, 'D045DB3A3632DB7A', 'en', 'amet consectetur'),
	(1, 'D1BCE4F11B0CA530', 'en', 'correct answer'),
	(1, 'DAAF6F5BDF4DD5A6', 'en', 'Beatae quam'),
	(1, 'E7E0686BC4D14A98', 'en', 'Labore reprehenderit'),
	(2, '01F1058ADC713ADE', 'en', 'provident placeat'),
	(2, '04802C9F8D53289D', 'en', 'incorrect answer'),
	(2, '0DB9CFF235888D81', 'en', 'provident placeat'),
	(2, '13D1388A4BD62EB6', 'en', 'adipisicing elit'),
	(2, '36FEED1C7010EEF6', 'en', 'dolor sit'),
	(2, '3FA3326F5914741D', 'en', 'dolor sit'),
	(2, '64AD61BBD78AF616', 'en', 'dolor sit'),
	(2, '8DD143A41FC3AC22', 'en', 'adipisicing elit'),
	(2, 'A3CE5703DE411421', 'en', 'asperiores aspernatur'),
	(2, 'AA10BF5D6B65A09E', 'en', 'iusto optio'),
	(2, 'BFE2113D543DACE1', 'en', 'incorrect answer'),
	(2, 'D045DB3A3632DB7A', 'en', 'adipisicing elit'),
	(2, 'D1BCE4F11B0CA530', 'en', 'incorrect answer'),
	(2, 'DAAF6F5BDF4DD5A6', 'en', 'asperiores aspernatur'),
	(2, 'E7E0686BC4D14A98', 'en', 'iusto optio'),
	(3, '01F1058ADC713ADE', 'en', 'cumque ratione'),
	(3, '04802C9F8D53289D', 'en', 'incorrect answer'),
	(3, '0DB9CFF235888D81', 'en', 'cumque ratione'),
	(3, '13D1388A4BD62EB6', 'en', 'Facere tempora'),
	(3, '36FEED1C7010EEF6', 'en', 'dolor sit'),
	(3, '3FA3326F5914741D', 'en', 'dolor sit'),
	(3, '8DD143A41FC3AC22', 'en', 'Facere tempora'),
	(3, 'A3CE5703DE411421', 'en', 'corrupti est'),
	(3, 'AA10BF5D6B65A09E', 'en', 'deleniti obcaecati'),
	(3, 'BFE2113D543DACE1', 'en', 'incorrect answer'),
	(3, 'D045DB3A3632DB7A', 'en', 'Facere tempora'),
	(3, 'D1BCE4F11B0CA530', 'en', 'incorrect answer'),
	(3, 'DAAF6F5BDF4DD5A6', 'en', 'corrupti est'),
	(3, 'E7E0686BC4D14A98', 'en', 'deleniti obcaecati'),
	(4, '04802C9F8D53289D', 'en', 'incorrect answer'),
	(4, 'BFE2113D543DACE1', 'en', 'incorrect answer'),
	(4, 'D1BCE4F11B0CA530', 'en', 'incorrect answer'),
	(5, 'BFE2113D543DACE1', 'en', 'incorrect answer'),
	(5, 'D1BCE4F11B0CA530', 'en', 'incorrect answer'),
	(6, 'BFE2113D543DACE1', 'en', 'incorrect answer'),
	(7, 'BFE2113D543DACE1', 'en', 'incorrect answer');
