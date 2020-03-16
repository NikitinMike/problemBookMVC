-- set names 'utf8' COLLATE utf8_unicode_ci;

USE problembook;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email`    varchar(100) NOT NULL UNIQUE,
  `name`        varchar(250) DEFAULT NULL,
  `password`    varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `email`, `name`, `password`) VALUES
(1, 'admin', 'Administrator', '202cb962ac59075b964b07152d234b70');

CREATE TABLE `post` (     
  `id` int(11) PRIMARY KEY AUTO_INCREMENT, -- Unique ID
  `username` varchar(64),
  `email` varchar(128),
--   `title` text NOT NULL,     -- Title  
  `content` text NOT NULL,          -- Text 
  `status` int(11) NOT NULL,        -- Status  
--   `id_user` int(11) NOT NULL,       -- User's ID of Author
  `date_created` DATETIME DEFAULT   CURRENT_TIMESTAMP -- Creation date    
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci'
;

INSERT INTO post(`email`, `content`, `status`, `date_created`, `username`) VALUES
(
   '91ya@ya.ru',
   'Пожарных учат надевать штаны за три секунды. Сколько штанов успеет надеть хорошо обученный пожарный за пять минут?', 
   1, '2020-01-01 10:50','user1'),
(
   '82ya@ya.ru',
   'Два числа 5 и 3 пришли однажды в такое место, где валялось много разных разностей, и стали искать свою. Найди разность этих чисел.', 
   0, '2020-01-01 10:50','user2'),
(
   '73ya@ya.ru',
   'Толя поспорил с Колей, что съест 5 баночек гуталина, а съел только 3. Сколько баночек гуталина не смог осилить Толя?', 
   1, '2020-01-01 10:50','user3'),
(
   '64ya@ya.ru',
   'Воспитывая своего сына двоечника, папа изнашивает в год 2 брючных ремня. Сколько ремней износил папа за все одиннадцать лет учебы, если известно, что в пятом классе его сын дважды оставался на второй год?', 
   0, '2020-01-01 10:50','user4'),
(
   '55ya@ya.ru',
   'В специальный ящик можно уложить 68 куриных яиц. Если уминать их ногами, то поместится в 100 раз больше. Сколько уминаемых ногами яиц можно уложить в 3 таких же одинаковых ящика?', 
   1, '2020-01-01 10:50','user5'),
(
   '46ya@ya.ru',
   'В бублике 1 дырка, а в кренделе в два раза больше. На сколько меньше дырок в 7 бубликах, чем в 12 кренделях?', 
   0, '2020-01-01 10:50','user6'),
(
   '37ya@ya.ru',
   'Когда хозяин вышел в сад с ружьем, с одной яблони упало 4 соседа, а с другой на 3 соседа больше. Сколько соседей упало со второй яблони?', 
   1, '2020-01-01 10:50','user7'),
(
   '28ya@ya.ru',
   '14 детей учились плавать. Трое из них еще не умеют плавать, а двое уже утонули. Сколько детей уже научились плавать и еще не утонули?', 
   0, '2020-01-01 10:50','user8'),
(
   '19ya@ya.ru',
   'Если младенца Кузю взвесить вместе с бабушкой — получится 59 кг. Если взвесить бабушку без Кузи — получится 54 кг. Сколько весит Кузя без бабушки?', 
   1, '2020-01-01 10:50','user9')
;
