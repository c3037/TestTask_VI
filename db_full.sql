SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for couriers
-- ----------------------------
DROP TABLE IF EXISTS `couriers`;
CREATE TABLE `couriers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of couriers
-- ----------------------------
INSERT INTO `couriers` VALUES ('1', 'Иванов Иван Иванович');
INSERT INTO `couriers` VALUES ('2', 'Петров Пётр Петрович');
INSERT INTO `couriers` VALUES ('3', 'Сидоров Геннадий Михайлович');
INSERT INTO `couriers` VALUES ('4', 'Ляпина Юлия Владимировна');
INSERT INTO `couriers` VALUES ('5', 'Митрофанов Сергей Сергеевич');
INSERT INTO `couriers` VALUES ('6', 'Тихонова Татьяна Владимировна');
INSERT INTO `couriers` VALUES ('7', 'Железнов Сергей Владимирович');
INSERT INTO `couriers` VALUES ('8', 'Сергеев Тимофей Фёдорович');
INSERT INTO `couriers` VALUES ('9', 'Тамарина Ирина Викторовна');
INSERT INTO `couriers` VALUES ('10', 'Ляпин Дмитрий Васильевич');

-- ----------------------------
-- Table structure for regions
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `days_in` int(11) NOT NULL,
  `days_out` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES ('1', 'Санкт-Петербург', '2', '2');
INSERT INTO `regions` VALUES ('2', 'Уфа', '6', '4');
INSERT INTO `regions` VALUES ('3', 'Нижний Новгород', '3', '3');
INSERT INTO `regions` VALUES ('4', 'Владимир', '4', '6');
INSERT INTO `regions` VALUES ('5', 'Кострома', '4', '4');
INSERT INTO `regions` VALUES ('6', 'Екатеринбург', '8', '8');
INSERT INTO `regions` VALUES ('7', 'Ковров', '3', '3');
INSERT INTO `regions` VALUES ('8', 'Воронеж', '9', '3');
INSERT INTO `regions` VALUES ('9', 'Самара', '5', '4');
INSERT INTO `regions` VALUES ('10', 'Астрахань', '11', '9');

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courier` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `departure_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courier` (`courier`) USING BTREE,
  KEY `region` (`region`) USING BTREE,
  CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`courier`) REFERENCES `couriers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`region`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of schedule
-- ----------------------------
INSERT INTO `schedule` VALUES ('1', '1', '1', '2015-06-01');
INSERT INTO `schedule` VALUES ('2', '1', '2', '2015-06-05');
INSERT INTO `schedule` VALUES ('3', '1', '3', '2015-06-15');
INSERT INTO `schedule` VALUES ('4', '1', '5', '2015-06-23');
INSERT INTO `schedule` VALUES ('5', '1', '7', '2015-07-02');
INSERT INTO `schedule` VALUES ('6', '1', '1', '2015-07-08');
INSERT INTO `schedule` VALUES ('7', '1', '8', '2015-08-05');
INSERT INTO `schedule` VALUES ('8', '1', '9', '2015-08-20');
INSERT INTO `schedule` VALUES ('9', '1', '8', '2015-09-02');
INSERT INTO `schedule` VALUES ('10', '1', '7', '2015-09-18');
INSERT INTO `schedule` VALUES ('11', '1', '1', '2015-10-22');
INSERT INTO `schedule` VALUES ('12', '2', '2', '2015-07-09');
INSERT INTO `schedule` VALUES ('13', '2', '3', '2015-08-20');
INSERT INTO `schedule` VALUES ('14', '2', '4', '2015-08-29');
INSERT INTO `schedule` VALUES ('15', '2', '4', '2015-09-11');
INSERT INTO `schedule` VALUES ('16', '2', '7', '2015-10-31');
INSERT INTO `schedule` VALUES ('17', '7', '4', '2015-10-22');
INSERT INTO `schedule` VALUES ('18', '3', '3', '2015-08-05');
INSERT INTO `schedule` VALUES ('19', '4', '5', '2015-09-03');
INSERT INTO `schedule` VALUES ('20', '7', '9', '2015-10-01');
INSERT INTO `schedule` VALUES ('21', '10', '3', '2015-10-14');
INSERT INTO `schedule` VALUES ('22', '9', '10', '2015-07-01');
