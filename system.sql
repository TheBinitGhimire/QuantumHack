-- phpMiniAdmin dump 1.9.190822
-- Datetime: 2020-08-29 06:16:20
-- Host: 
-- Database: system

/*!40030 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

DROP TABLE IF EXISTS `CloseUser`;
CREATE TABLE `CloseUser` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `fellow_id` int(10) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `CloseUser` DISABLE KEYS */;
/*!40000 ALTER TABLE `CloseUser` ENABLE KEYS */;

DROP TABLE IF EXISTS `UserLocation`;
CREATE TABLE `UserLocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lon` longtext COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `UserLocation` DISABLE KEYS */;
INSERT INTO `UserLocation` VALUES ('1','asd.com','27.266657','1.555','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `UserLocation` ENABLE KEYS */;

DROP TABLE IF EXISTS `hospitals`;
CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lng` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `hospitals` DISABLE KEYS */;
INSERT INTO `hospitals` VALUES ('1','Hospital 1','bharatpurhospital','76caa5c591e794d1475edfc8a0439155','27.681878682802477','84.43437701500115'),('2','Hospital 2','cmc','8010fd0f87d3aaa0ea48aa78948c081e','27.685176865284728','84.43003887837084'),('3','Hospital 3','nsh','9f49742c156aa63b21ad6d99e9e6a5d4','27.680089911553107','27.680089911553107');
/*!40000 ALTER TABLE `hospitals` ENABLE KEYS */;

DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` text COLLATE utf8_unicode_ci NOT NULL,
  `lng` text COLLATE utf8_unicode_ci NOT NULL,
  `information` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES ('1','B. P. Koirala Memorial Cancer Hospital','27.663488082810126','84.41656551500067','B. P. Koirala Memorial Cancer Hospital (BPKMCH) is the first national cancer centre of its kind for the fight against cancer in Nepal. The felt need of the hour was a competent establishment that would be able to fulfil the need of the people of Nepal. In a country rife with poverty, illiteracy the harsh geographical terrain and almost negligible access to basic health facilities, this institution is envisioned to bridge that gap. Though there are no national survey records, it is estimated that deaths due to cancer are approximated at 120 per 100,000. And the assumption is that there are 35000 to 40000 cancer patients in the country at any given space of time. This hospital provides high-quality services for the prevention, diagnosis, treatment and research on Cancer, and to gain self-reliance in human resource required for the same.','http://www.bpkmch.org.np/','+977-056-524501','Bharatpur-7, Chitwan'),('2','Bir Hospital','27.704824882792966','85.31146271500164','Bir Hospital is the oldest and one of the busiest hospitals in Nepal. It was established in 1947 B.S by Bir Shumsher Jang Bahadur Rana. It is located at the center of Kathmandu city. The hospital is run by the National Academy of Medical Sciences, a government agency since 2003.','https://en.wikipedia.org/wiki/Bir_Hospital','+977-01-4221119','Kanti Path, Kathmandu'),('3','Narayani Samudayik Hospital','27.6816279','84.4304948','The NPI Narayani Samudayik Hospital was established in 2005 AD driven by the Vision to provide best medical healthcare to the people of Chitwan and its neighboring district so that the people be treated well as they were compelled to travel out of even for minor treatment.','https://www.npihospital.com/','+977-056-525517','Chitwan, Nepal'),('4','Chitwan Medical College','27.6853178','84.4282418','Chitwan Medical College is committed to serve patient with word class quality health services at an affordable cost. CMC is dedicated to leadership and excellence in advancing the prevention, diagnosis and treatment of disease and injury.','http://www.cmc.edu.np/','+977-056-532933','Bharatpur-13, Chitwan, Nepal'),('5','Bharatpur Hospital','27.6818787','84.434377','Bharatpur Hospital is the governmental hospital in chitwan district.This hospital provide high quality services for the prevention, diagnosis, treatment and research on general desease, and to gain self-reliance in human resource required for the same.','http://bharatpurhospital.gov.np','+977-056-527959','Bharatpur, Chitwan'),('6','College of Medical Sciences','27.6836007','84.4339779','The International Society for Medical Education Private Limited (ISME) and the Ministry of Education (MoE), Government of Nepal signed an agreement of the 8th day of August 1993 giving birth to the College of Medical Sciences-Nepal at Bharatpur, Chitwan (Dist.) and has undergone lot of modifications since than providing affordable advanced quality health care services and medical education. The College of Medical Sciences was established under the leadership of Mr. Nagendar K. Pampati, MBA, Chairman & CEO of ISME Pvt. Ltd.\r\n','http://cmsnepal.edu.np','+977-056-524203','Bharatpur, Chitwan, Nepal'),('7','Chitwan Hospital Pvt. Ltd','27.6822041','84.4320253','Chitwan Hospital Pvt. Ltd. (CHPL) was established in2059 B.S. with the visionary leadership of Dr. Vijaya Paudel. to give Best medical services in chitwan for the paitent comming from all over Nepal Starting with 15 Beds and 18 staffs, now the hospital is running 55 bedded multispecialty services, which includes almost all the medical, surgical and investigation services with more than 100 Staffs of  different categories.','http://chitwanhospital.com.np','+977-056-527101','Bharatpur-10, Chaubiskothi, Chitwan'),('8','Manakamana Hospital','27.6786697','84.4315103','We attempted to provide one of the best health care service in Bharatpur to satisfy patient’s requirement. Our hospital building is built to provide the most convenient space for patients. Our clinical specialists are competent in knowledge and experience. We have cool and calm environment with ample parking inside the hospital.\r\n','http://manakamanahospital.com','+977-056-520180','Bharatpur-8, Amar Marga, Chitwan'),('9','Manipal Teaching Hospital','28.2007351','83.9708847','On 18th October 1992, a historic agreement was signed between the-then His Majesty’s Government of Nepal and the Manipal Education and Medical Group for setting up a medical college. The Manipal College of Medical Sciences (MCOMS), affiliated to Kathmandu University was set up at Pokhara in 1994 with an MBBS program. It was the first private institution to establish a medical college in Nepal. Further to this, the 750 bed Manipal Teaching Hospital (MTH), Pokhara commenced in 1998. The college and hospital have been set up with modern facilities for modern education and health delivery.','http://manipal.edu.np','+977-061-526416','Pokhara - 16, Kaski , Nepal'),('10','Patan Hospital','27.668302','85.3183796','Patan Hospital is a teaching hospital for the Patan Academy of Health Sciences. Patan Hospital is one of the largest hospitals in Nepal. It uses modern equipment and facilities to provide treatment for almost 320,000 outpatients and 20,000 inpatients every year.','http://www.pahs.edu.np/','+977-01-5522295','Satdobato Marg, Lagankhel, Lalitpur'),('11','Chauraha Hospital Pvt. Ltd.','27.6940135','83.4231287','It is located at Kalikanagar, Butwal. They provide 24 hours emergency and ambulance services.','https://khozinfo.com/chauraha-hospital-pvt-ltd/','+977-071-415001','Mahadev Marg, Butwal, Nepal'),('12','Tulsipur City Hospital','28.1307315','82.0174576','Tulsipur City Hospital is a recently established hospital in Tulsipur to provide best helth service all over located area.','http://tulsipuronline.com/directory/place/tulsipur-city-hospital/','+977-082-523222','tulsipur,nepal');
/*!40000 ALTER TABLE `information` ENABLE KEYS */;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `verified` bit(1) NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('12','binit','binit@hack.it','98133731337','098f6bcd4621d373cade4e832627b4f6','1','TSOvT7I='),('24','Rahul','rahul@hack.it','98313371337','098f6bcd4621d373cade4e832627b4f6','0','zgHInJDdJd5X'),('31','abcdef','abcdef@hack.it','9800011111','098f6bcd4621d373cade4e832627b4f6','0','VIrDXZpO'),('30','binit1','binit1@hack.it','9811100000','098f6bcd4621d373cade4e832627b4f6','0','Esk7CEyS');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;


-- phpMiniAdmin dump end
