/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `attends` (
  `ccode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Student_id` int(11) NOT NULL,
  `is_lec` int(11) NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fk_Attends_Students1_idx` (`Student_id`),
  KEY `fk_Attends_Courses1_idx` (`ccode`),
  CONSTRAINT `fk_Attends_Courses1_idx` FOREIGN KEY (`ccode`) REFERENCES `courses` (`ccode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Attends_Students1_idx` FOREIGN KEY (`Student_id`) REFERENCES `students` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `courses` (
  `ccode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cch` int(11) NOT NULL,
  `dmidterm` int(11) NOT NULL,
  `dlab` int(11) NOT NULL,
  `doral` int(11) NOT NULL,
  `dclass_work` int(11) NOT NULL,
  `dfinal` int(11) NOT NULL,
  `dtotal` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `courses_ccode_index` (`ccode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `departments` (
  `dep_id` int(11) NOT NULL,
  `dname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `dname_UNIQUE` (`dname`),
  UNIQUE KEY `did_UNIQUE` (`dep_id`),
  KEY `departments_dep_id_index` (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `enrolls` (
  `counter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Student_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `ccode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hmedterm_d` int(11) DEFAULT NULL,
  `hlab_d` int(11) DEFAULT NULL,
  `horal_d` int(11) DEFAULT NULL,
  `hclass_work_d` int(11) DEFAULT NULL,
  `hfinal_d` int(11) DEFAULT NULL,
  `htotal_d` int(11) DEFAULT NULL,
  `hpass` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature` int(11) NOT NULL,
  PRIMARY KEY (`counter`),
  KEY `enrolls_student_id_index` (`Student_id`),
  KEY `enrolls_semester_index` (`semester`),
  KEY `enrolls_year_index` (`year`),
  KEY `enrolls_ccode_index` (`ccode`),
  CONSTRAINT `fk_Enrolls_Courses1_idx` FOREIGN KEY (`ccode`) REFERENCES `courses` (`ccode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Enrolls_Students1_idx` FOREIGN KEY (`Student_id`) REFERENCES `students` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1341 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `feedbacks` (
  `User_id` int(11) NOT NULL,
  `ccode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fheader` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fbody` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fvote` int(11) DEFAULT NULL,
  `fid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`fid`),
  UNIQUE KEY `pid_UNIQUE` (`fid`),
  KEY `fk_Posts_User1_idx` (`User_id`),
  KEY `fk_Posts_Courses1_idx` (`ccode`),
  KEY `feedbacks_fid_index` (`fid`),
  CONSTRAINT `fk_Posts_Courses1_idx` FOREIGN KEY (`ccode`) REFERENCES `courses` (`ccode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Posts_Users1_idx` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `notification` (
  `nid` int(11) NOT NULL,
  `nbody` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nheader` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 warnning\n2 certificate\n3 etc ...',
  `created_on` datetime NOT NULL,
  `ntype` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  KEY `fk_Notification_User1_idx` (`User_id`),
  KEY `notification_nid_index` (`nid`),
  CONSTRAINT `fk_Notification_User1_idx` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pre_requests` (
  `ccode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_ccode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ccode`,`pr_ccode`),
  KEY `fk_Pre_request_Courses1_idx` (`ccode`),
  KEY `fk_Pre_request_Courses2_idx` (`pr_ccode`),
  CONSTRAINT `fk_Pre_request_Courses1_idx` FOREIGN KEY (`ccode`) REFERENCES `courses` (`ccode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Pre_request_Courses2_idx` FOREIGN KEY (`pr_ccode`) REFERENCES `courses` (`ccode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sections` (
  `Sec_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `sec_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`dep_id`,`Sec_id`),
  KEY `fk_Sections_Departments1_idx` (`dep_id`),
  KEY `sections_sec_id_index` (`Sec_id`),
  CONSTRAINT `fk_Sections_Departments1_idx` FOREIGN KEY (`dep_id`) REFERENCES `departments` (`dep_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `layer_value` int(11) NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_lec` int(11) NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `shcs` (
  `Sec_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `ccode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_theoretical_ratio` double NOT NULL,
  `c_elective` tinyint(4) NOT NULL,
  `c_semester` int(11) NOT NULL,
  `c_lvl` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Sec_id`,`dep_id`,`ccode`),
  KEY `fk_Shcs_Sections2_idx` (`dep_id`),
  KEY `fk_Shcs_Sections1_idx` (`Sec_id`),
  KEY `fk_Shcs_Courses1_idx` (`ccode`),
  CONSTRAINT `fk_Shcs_Courses1_idx` FOREIGN KEY (`ccode`) REFERENCES `courses` (`ccode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Shcs_Sections1_idx` FOREIGN KEY (`Sec_id`) REFERENCES `sections` (`Sec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Shcs_Sections2_idx` FOREIGN KEY (`dep_id`) REFERENCES `sections` (`dep_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `students` (
  `Student_id` int(11) NOT NULL,
  `roadmap` int(11) NOT NULL,
  `live_hour` int(11) NOT NULL,
  `c_gpa` double(8,2) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  `adv_id` int(11) DEFAULT NULL,
  `Dep_id` int(11) NOT NULL,
  `Sec_id` int(11) NOT NULL,
  KEY `fk_Student_Sections1_idx` (`Sec_id`,`Dep_id`),
  KEY `fk_S_Users1_idx` (`adv_id`),
  KEY `fk_S_Users2_idx` (`Student_id`),
  CONSTRAINT `fk_S_User2_idx` FOREIGN KEY (`adv_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_S_Users1_idx` FOREIGN KEY (`Student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Student_Sections1_idx` FOREIGN KEY (`Sec_id`) REFERENCES `sections` (`Sec_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rememberToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  UNIQUE KEY `acadmic_id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `users_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5001220 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `attends` (`ccode`, `Student_id`, `is_lec`, `date`, `created_at`, `updated_at`) VALUES
('comp106', 200, 1, '2021-05-23', '2021-05-23 09:42:53', '2021-05-23 09:42:53');
INSERT INTO `attends` (`ccode`, `Student_id`, `is_lec`, `date`, `created_at`, `updated_at`) VALUES
('comp415', 200, 1, '2021-05-23', '2021-05-23 12:16:38', '2021-05-23 12:16:38');
INSERT INTO `attends` (`ccode`, `Student_id`, `is_lec`, `date`, `created_at`, `updated_at`) VALUES
('comp205', 200, 1, '2021-05-23', '2021-05-23 19:18:32', '2021-05-23 19:18:32');

INSERT INTO `courses` (`ccode`, `cname`, `cch`, `dmidterm`, `dlab`, `doral`, `dclass_work`, `dfinal`, `dtotal`, `instructor`) VALUES
('COMP405', 'project1', 3, 40, 20, 0, 60, 90, '150', '');
INSERT INTO `courses` (`ccode`, `cname`, `cch`, `dmidterm`, `dlab`, `doral`, `dclass_work`, `dfinal`, `dtotal`, `instructor`) VALUES
('SAFS101', 'Safety and Security', 1, 0, 0, 0, 0, 50, '50', '');
INSERT INTO `courses` (`ccode`, `cname`, `cch`, `dmidterm`, `dlab`, `doral`, `dclass_work`, `dfinal`, `dtotal`, `instructor`) VALUES
('HURI101', 'human rights', 0, 0, 0, 0, 0, 50, '50', '');
INSERT INTO `courses` (`ccode`, `cname`, `cch`, `dmidterm`, `dlab`, `doral`, `dclass_work`, `dfinal`, `dtotal`, `instructor`) VALUES
('MATH101', 'Differentiation and Integration 1', 4, 72, 0, 8, 80, 120, '200', ''),
('PHYS101', 'Physics 1', 4, 32, 40, 8, 80, 120, '200', ''),
('CHEM101', 'Chemistry 1', 3, 37, 0, 8, 45, 105, '150', ''),
('CHEM103', 'Practical general chemistry', 1, 0, 0, 0, 0, 50, '50', ''),
('STAT101', 'Introduction to Statistics', 3, 37, 0, 8, 45, 105, '150', ''),
('ENGL102', 'English1 ', 2, 0, 0, 0, 0, 100, '100', ''),
('INCO102', 'Entrance into the computer', 1, 0, 0, 0, 0, 50, '50', ''),
('MATH102', 'Differentiation and Integration2', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH104', 'Basic concepts in mathematics', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH112', 'Mechanics 1', 3, 37, 0, 8, 45, 105, '150', ''),
('PHYS102', 'Physics2', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP108', 'CS for Math (Packages + Prog)', 3, 37, 15, 8, 60, 90, '150', ''),
('STAT102', 'probability theory 1', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP102', 'Introduction to computer ', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP104', 'Computer Programming 1 ', 3, 22, 30, 8, 60, 90, '150', ''),
('COMP106', 'Logic design', 3, 37, 0, 8, 45, 105, '150', ''),
('ENGL201', 'English2', 2, 0, 0, 0, 0, 100, '100', ''),
('MATH201', 'Mathematical analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH203', 'Linear algebra', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH211', 'Directional analysis and spans calc', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH213', 'Mechanics 2', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH207', 'History of mathematics', 1, 0, 0, 0, 0, 50, '50', ''),
('MATH205', 'Number theory', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT201', 'Statistics theory 1', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT205', 'Statistical Mathematics', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT207', 'Statistical Lab', 1, 0, 0, 0, 0, 50, '50', ''),
('COMP201', 'Algorithms Design and Analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP207', 'Database systems', 4, 52, 20, 8, 80, 120, '200', ''),
('STAT203', 'Statistical Methods 1', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT221', 'Introduction to time series', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT223', 'Statistical models', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP203', 'Accounts theory', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP205', 'Computer Programming 2', 3, 32, 20, 8, 60, 90, '150', ''),
('MATH202', 'Ordinary differential equations', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH204', 'Real analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH212', 'Electromagnetic theory', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH214', 'Mechanics  3', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH206', 'Game theory', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH208', 'Linear programming', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH222', 'Mathematical logic', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT228', 'Principles of probability theory', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT202', 'Statistics theory 2', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT206', 'Statistical Methods2', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT204', 'Prob.Methods in Oper. Research1', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT208', 'Principles of regression analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP202', 'Data structures', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP212', 'Advanced programming', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP204', 'computer networks', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP206', 'Web programming', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP208', 'Autonomous mechanisms theory', 3, 32, 20, 8, 60, 90, '150', ''),
('STAT222', 'Standard numbers', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT224', 'Intro to stat quality control', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP210', 'Drawing algorithms', 2, 22, 0, 8, 30, 70, '100', '');
INSERT INTO `courses` (`ccode`, `cname`, `cch`, `dmidterm`, `dlab`, `doral`, `dclass_work`, `dfinal`, `dtotal`, `instructor`) VALUES
('SCTH301', 'scientific thinking', 1, 0, 0, 0, 0, 50, '50', ''),
('MATH301', 'Abstract Algebra1', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH303', 'Numerical analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH311', 'Connected Media Mechanics', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH313', 'Quantum Mechanics 1', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH305', 'Differential geometry', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH307', 'Algorithm theory', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH331', 'Principles of calculating changes', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH317', 'Special Functions', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH319', 'Principles of Math Modeling', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT301', 'Statistical Inference 1', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT303', 'Random operations 1', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT305', 'Rank statistics', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT311', 'Modeling and simulation', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT315', 'Prob.Methods in Oper. Research', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP305', 'Complexity theory', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP307', 'Operating system theory', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP303', 'syntex and semantics of prog languages', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP309', 'Multimedia systems', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP311', 'Declarative languages', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP313', 'Software packages', 1, 0, 0, 0, 0, 50, '50', ''),
('STAT313', 'Demographic analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT317', 'Selected Topics in Industrial Statistics', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP301', 'Advanced programming', 3, 32, 20, 8, 60, 90, '150', ''),
('ETHR302', 'Ethics of scientific research', 1, 0, 0, 0, 0, 50, '50', ''),
('MATH302', 'General Topology', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH304', 'Measurement theory', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH312', 'Electrodynamics', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH314', 'Quantum Mechanics 2', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH306', 'Operations Research', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH308', 'Mathematical encryption', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH322', 'Scripting (Combinatorics)', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH316', 'Fluid Mechanics', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH318', 'Elasticity theory', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH332', 'The dynamics of gases', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT302', 'Statistical inference 2', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT304', 'Inspection methods', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT306', 'Nonparametric statistics', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT318', 'Selected Topics in Statistics 2', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT320', 'Regression analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT310', 'Discrimination theory', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT312', 'Survival Models Analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT314', 'The theory of suitability', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT322', 'Selected Topics in Econometrics', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP302', 'Scripting an algorithm', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP308', 'Encrypt', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP304', 'Compiler', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP306', 'Computer graphics', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP310', 'Advanced web programming', 2, 32, 20, 8, 60, 60, '120', ''),
('COMP312', 'Organizing files', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP314', 'Advanced database systems', 2, 22, 0, 8, 30, 70, '100', ''),
('SKIL401', 'Job skills', 1, 0, 0, 0, 0, 50, '50', ''),
('ENCU401', 'Environmental culture', 1, 0, 0, 0, 0, 50, '50', ''),
('GHDS401', 'Origins and history', 1, 0, 0, 0, 0, 50, '50', ''),
('MATH 401', 'Functional analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 403', 'Complex Analysis', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 411', 'Solids theory', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH413', 'Theory of Relativity', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH405', 'A pure mathematics research project', 4, 0, 0, 0, 0, 100, '100', ''),
('MATH407', 'Algebraic Geometry', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH409', 'Graphic theory', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH421', 'Numerical linear algebra', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH415', 'Biological Mathematics', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH423', 'Mathematics research project', 1, 0, 0, 0, 0, 50, '50', ''),
('STAT405', 'Design and analysis of experiments', 4, 42, 30, 8, 80, 120, '200', ''),
('STAT415', 'Multiple statistical analysis', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT401', 'Advanced distributions theory', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT403', 'Statistical packages', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP403', 'Parallel and distributed processing', 3, 17, 20, 8, 45, 105, '150', ''),
('COMP407', 'Image Processing', 3, 17, 20, 8, 45, 105, '150', ''),
('COMP411', 'Computational geometry', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP413', 'Selected topics in algorithms', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT411', 'Sequential analysis', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT417', 'Decision-making theory', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP409', 'Cyber security', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP415', 'Advanced Compiler', 3, 37, 0, 8, 45, 90, '135', ''),
('MATH 402', 'Abstract Algebra 2 (Rings and fields)', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 404', 'Partial differential equations', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 412', 'Statistical Mechanics', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 414', 'Space Mechanics', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 416', 'Applied Mathematics research project', 4, 37, 0, 8, 45, 105, '150', ''),
('MATH 418', 'Cosmology', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH 432', 'Quantum light', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH 434', 'Prophetic Quantum Mechanics', 2, 22, 0, 8, 30, 70, '100', ''),
('MATH 406', 'Advanced Linear Algebra', 3, 37, 0, 8, 45, 105, '150', ''),
('MATH 408', 'Selected topics in pure mathematics', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT404', 'Probability Theory 2', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT426', 'Statistical search', 3, 22, 30, 8, 60, 90, '150', ''),
('STAT406', 'Bayes Statistics', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT408', 'Time series', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP402', 'Vital information', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP418', 'Computer Project (For Double Specialization)', 3, 0, 0, 0, 0, 150, '150', ''),
('COMP412', 'Selected topics in information security', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP414', 'Selected topics in computing e', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP416', 'Data mining and the web', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT402', 'Research project', 4, 0, 0, 0, 0, 200, '200', ''),
('STAT412', 'Queues theory', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT416', 'Regeneration theory', 2, 22, 0, 8, 30, 70, '100', ''),
('STAT418', 'Random operations 2', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP404', 'Software Engineering', 3, 32, 20, 8, 60, 90, '150', ''),
('COMP406', 'Computer project b', 4, 0, 0, 0, 0, 200, '200', ''),
('COMP408', 'Advanced Topics in Artificial Intelligence', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP410', 'Computer vision', 3, 37, 0, 8, 45, 105, '150', ''),
('STAT418', 'Random operations 2', 2, 22, 0, 8, 30, 70, '100', ''),
('COMP404', 'Software Engineering ', 3, 37, 0, 8, 45, 90, '135', ''),
('COMP406', 'Computer project b', 4, 0, 0, 0, 0, 200, '200', ''),
('COMP408', 'Advanced Topics in Artificial Intelligence', 3, 37, 0, 8, 45, 105, '150', ''),
('COMP410', 'Computer vision', 3, 37, 0, 8, 45, 105, '150', ''),
('comp4019', 'ai azx', 3, 40, 20, 0, 60, 90, '150', 'dr_ashraf');

INSERT INTO `departments` (`dep_id`, `dname`) VALUES
(1, 'math1');
INSERT INTO `departments` (`dep_id`, `dname`) VALUES
(2, 'physics');
INSERT INTO `departments` (`dep_id`, `dname`) VALUES
(4, 'biology');
INSERT INTO `departments` (`dep_id`, `dname`) VALUES
(5, 'geology'),
(6, 'anatomy'),
(7, 'microbiology'),
(8, 'geo-physics'),
(9, 'bio-chemistry'),
(10, 'new geo'),
(109, 'new geo99'),
(1095454, 'new geo9954'),
(10954545, 'new geo99545885');

INSERT INTO `enrolls` (`counter`, `Student_id`, `semester`, `year`, `ccode`, `hmedterm_d`, `hlab_d`, `horal_d`, `hclass_work_d`, `hfinal_d`, `htotal_d`, `hpass`, `created_at`, `updated_at`, `signature`) VALUES
(1011, 200, 1, 2020, 'SAFS101', 0, 0, 0, 0, 50, 50, 1, NULL, '2021-05-26 18:29:56', 0);
INSERT INTO `enrolls` (`counter`, `Student_id`, `semester`, `year`, `ccode`, `hmedterm_d`, `hlab_d`, `horal_d`, `hclass_work_d`, `hfinal_d`, `htotal_d`, `hpass`, `created_at`, `updated_at`, `signature`) VALUES
(1021, 200, 1, 2020, 'HURI101', 0, 0, 0, 0, 50, 50, 1, NULL, '2021-05-26 18:29:56', 0);
INSERT INTO `enrolls` (`counter`, `Student_id`, `semester`, `year`, `ccode`, `hmedterm_d`, `hlab_d`, `horal_d`, `hclass_work_d`, `hfinal_d`, `htotal_d`, `hpass`, `created_at`, `updated_at`, `signature`) VALUES
(1031, 200, 1, 2020, 'MATH101', 72, 8, 0, 80, 120, 200, 1, NULL, '2021-05-26 18:29:56', 0);
INSERT INTO `enrolls` (`counter`, `Student_id`, `semester`, `year`, `ccode`, `hmedterm_d`, `hlab_d`, `horal_d`, `hclass_work_d`, `hfinal_d`, `htotal_d`, `hpass`, `created_at`, `updated_at`, `signature`) VALUES
(1041, 200, 1, 2020, 'PHYS101', 32, 8, 40, 80, 120, 200, 1, NULL, '2021-05-26 18:29:56', 0),
(1051, 200, 1, 2020, 'CHEM101', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1061, 200, 1, 2020, 'CHEM103', 0, 0, 0, 0, 50, 50, 1, NULL, '2021-05-26 18:29:56', 0),
(1071, 200, 1, 2020, 'STAT101', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1081, 200, 2, 2020, 'ENGL102', 0, 0, 0, 0, 100, 100, 1, NULL, '2021-05-26 18:29:56', 0),
(1091, 200, 2, 2020, 'INCO102', 0, 0, 0, 0, 50, 50, 1, NULL, '2021-05-26 18:29:56', 0),
(1101, 200, 2, 2020, 'MATH102', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1111, 200, 2, 2020, 'MATH104', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1121, 200, 2, 2020, 'MATH112', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1131, 200, 2, 2020, 'PHYS102', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1141, 200, 2, 2020, 'COMP108', 37, 8, 15, 60, 90, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1151, 200, 2, 2020, 'STAT102', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1161, 200, 2, 2020, 'COMP102', 32, 8, 20, 60, 90, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1171, 200, 2, 2020, 'COMP104', 22, 8, 30, 60, 90, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1181, 200, 2, 2020, 'COMP106', 37, 8, 0, 45, 105, 150, 1, NULL, '2021-05-26 18:29:56', 0),
(1191, 200, 1, 2020, 'ENGL201', 0, 0, 0, 0, 100, 100, 1, NULL, '2021-05-26 18:29:56', 0),
(1201, 200, 2, 2021, 'comp106', 10, NULL, 8, 18, 80, 98, 1, '2021-05-23 00:08:00', '2021-05-26 18:29:56', 100),
(1221, 1000, 2, 2021, 'comp108', NULL, NULL, NULL, 0, NULL, 0, 0, '2021-05-23 11:46:07', '2021-05-26 18:29:56', 0),
(1301, 99, 2, 2021, 'comp106', NULL, NULL, NULL, 0, NULL, 0, 0, '2021-05-26 18:14:37', '2021-05-26 18:29:56', 0),
(1311, 200, 2, 2021, 'comp104', NULL, NULL, NULL, 0, NULL, 0, 0, '2021-05-26 18:29:06', '2021-05-26 18:29:56', 0),
(1321, 200, 2, 2021, 'comp108', NULL, NULL, NULL, 0, NULL, 0, 0, '2021-05-26 18:29:13', '2021-05-26 18:29:57', 0),
(1331, 200, 2, 2021, 'comp102', NULL, NULL, NULL, 0, NULL, 0, 0, '2021-05-26 18:29:17', '2021-05-26 18:29:57', 0);

INSERT INTO `feedbacks` (`User_id`, `ccode`, `fheader`, `fbody`, `fvote`, `fid`) VALUES
(19980, 'COMP207', 'knl', 'kjh', NULL, 11);
INSERT INTO `feedbacks` (`User_id`, `ccode`, `fheader`, `fbody`, `fvote`, `fid`) VALUES
(19980, 'COMP207', 'knl', 'kjh', NULL, 21);
INSERT INTO `feedbacks` (`User_id`, `ccode`, `fheader`, `fbody`, `fvote`, `fid`) VALUES
(19980, 'COMP207', 'knl', 'kjh', NULL, 31);
INSERT INTO `feedbacks` (`User_id`, `ccode`, `fheader`, `fbody`, `fvote`, `fid`) VALUES
(19980, 'COMP207', 'شغاله يا ابراهيم', 'لا برضوا مش متاكد', NULL, 41),
(199901, 'COMP207', 'is it work from ui', 'yes it work', NULL, 81),
(199901, 'COMP207', 'المكنه ‏طلعت ‏قماش ‏', 'اه ‏يا ‏ريس ‏', NULL, 91),
(199901, 'COMP207', 'is it work', 'yes', NULL, 101),
(199901, 'COMP207', 'شغاله ‏من ‏ال ‏ui ‎', 'اه ‏شغاله ‏', NULL, 111),
(199901, 'COMP207', 'post a question', 'posted', NULL, 131),
(5001219, 'comp415', 'ازاى اقدر اجيب تقدير فى الكورس ده', 'حاول تقفل اعمال السنة و تذاكر ++c', NULL, 151);

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 25000, 'محمد', '2021-04-27 19:43:22', '2021-04-27 19:43:22');
INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(11, 25000, 'محمد', '2021-04-27 19:55:44', '2021-04-27 19:55:44');
INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(21, 10000, 'محمد', '2021-05-04 07:51:53', '2021-05-04 07:51:53');
INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(31, 100100, 'mostfaf kream', '2021-05-05 22:13:51', '2021-05-05 22:13:51'),
(41, 10000, 'mostfaf kream', '2021-05-05 23:18:29', '2021-05-05 23:18:29'),
(51, 200, 'mostfaf kream', '2021-05-05 23:23:03', '2021-05-05 23:23:03'),
(61, 10000, 'mostfaf kream', '2021-05-22 21:41:28', '2021-05-22 21:41:28'),
(71, 100100, 'hello world', '2021-05-22 22:44:20', '2021-05-22 22:44:20'),
(81, 100100, 'hello world', '2021-05-22 22:56:43', '2021-05-22 22:56:43'),
(91, 100100, 'مرحبا', '2021-05-22 23:06:00', '2021-05-22 23:06:00'),
(101, 100100, 'مرحبا بك الا .................', '2021-05-22 23:25:00', '2021-05-22 23:25:00'),
(111, 200, 'الى مصطفى ابراهيم ؟؟؟؟؟؟', '2021-05-23 08:19:39', '2021-05-23 08:19:39'),
(121, 200, 'لا إله إلا الله', '2021-05-23 10:18:49', '2021-05-23 10:18:49'),
(131, 100100, 'لا إله إلا الله', '2021-05-23 11:15:13', '2021-05-23 11:15:13'),
(141, 100100, 'لا إله إلا الله >>> محمد رسول الله', '2021-05-23 11:40:25', '2021-05-23 11:40:25'),
(151, 100100, 'لا إله إلا الله >>> محمد رسول الله صل الله على النبى', '2021-05-23 18:32:20', '2021-05-23 18:32:20');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_07_000000_create_Department_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2021_02_07_000001_create_Course_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2021_02_07_000002_create_User_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2021_02_07_000005_create_Section_table', 1),
(41, '2021_02_07_000006_create_Pre_request_table', 1),
(51, '2021_02_07_000007_create_Notification_table', 1),
(61, '2021_02_07_000009_create_Final_table_table', 1),
(71, '2021_02_07_000010_create_SHC_table', 1),
(81, '2021_02_07_000011_create_Student_table', 1),
(101, '2021_04_19_015804_create_messages_table', 1),
(111, '2021_04_19_165715_create_feadback_table', 1),
(161, '2021_04_23_214723_create_password_resets_table', 3),
(171, '2021_02_07_000012_create_Enroll_table', 4),
(181, '2021_04_19_175807_create_attends_table', 5),
(191, '2021_04_19_193058_create_session_table', 5);



INSERT INTO `password_resets` (`email`, `token`, `created_at`, `updated_at`) VALUES
('hema.1998.man1@gmail.com', '566042', '2021-05-04 07:51:47', NULL);
INSERT INTO `password_resets` (`email`, `token`, `created_at`, `updated_at`) VALUES
('student2@gmail.com', '346574', '2021-05-22 21:41:22', NULL);
INSERT INTO `password_resets` (`email`, `token`, `created_at`, `updated_at`) VALUES
('ibrahim_test10_@gmail.com', '758071', '2021-05-23 10:18:46', NULL);
INSERT INTO `password_resets` (`email`, `token`, `created_at`, `updated_at`) VALUES
('student@gmail.com', '742397', '2021-05-23 18:27:38', NULL);

INSERT INTO `pre_requests` (`ccode`, `pr_ccode`) VALUES
('COMP202', 'COMP104');
INSERT INTO `pre_requests` (`ccode`, `pr_ccode`) VALUES
('COMP205', 'COMP104');
INSERT INTO `pre_requests` (`ccode`, `pr_ccode`) VALUES
('COMP206', 'COMP104');
INSERT INTO `pre_requests` (`ccode`, `pr_ccode`) VALUES
('COMP212', 'COMP104'),
('COMP402', 'COMP201'),
('COMP410', 'COMP201'),
('COMP413', 'COMP201'),
('COMP301', 'COMP205'),
('COMP304', 'COMP205'),
('COMP306', 'COMP205'),
('COMP404', 'COMP205'),
('COMP410', 'COMP205'),
('COMP310', 'COMP206'),
('COMP314', 'COMP207'),
('COMP416', 'COMP207'),
('COMP304', 'COMP208'),
('COMP306', 'COMP212'),
('COMP402', 'COMP212'),
('COMP407', 'COMP212'),
('COMP411', 'COMP212'),
('COMP414', 'COMP212'),
('COMP415', 'COMP303'),
('COMP415', 'COMP304'),
('COMP409', 'COMP308'),
('COMP412', 'COMP308'),
('ENGL201', 'ENGL102'),
('MATH202', 'MATH102'),
('STAT205', 'MATH102'),
('MATH213', 'MATH112'),
('MATH 404', 'MATH202'),
('STAT310', 'MATH202'),
('MATH 406', 'MATH203'),
('MATH421', 'MATH203'),
('MATH 403', 'MATH204'),
('MATH304', 'MATH204'),
('STAT404', 'MATH204'),
('MATH312', 'MATH214'),
('MATH 402', 'MATH301'),
('STAT202', 'STAT101'),
('STAT203', 'STAT101'),
('STAT207', 'STAT101'),
('STAT221', 'STAT101'),
('STAT223', 'STAT101'),
('STAT224', 'STAT101'),
('STAT201', 'STAT102'),
('STAT313', 'STAT102'),
('STAT301', 'STAT202'),
('STAT305', 'STAT202'),
('STAT310', 'STAT202'),
('STAT311', 'STAT202'),
('STAT401', 'STAT202'),
('STAT404', 'STAT202'),
('STAT405', 'STAT203'),
('STAT315', 'STAT204'),
('STAT303', 'STAT205'),
('STAT320', 'STAT205'),
('STAT415', 'STAT205'),
('STAT416', 'STAT205'),
('STAT417', 'STAT301'),
('STAT408', 'STAT302'),
('STAT411', 'STAT302'),
('STAT412', 'STAT303'),
('STAT418', 'STAT303');

INSERT INTO `sections` (`Sec_id`, `dep_id`, `sec_name`) VALUES
(0, 1, 'all');
INSERT INTO `sections` (`Sec_id`, `dep_id`, `sec_name`) VALUES
(1, 1, 'pure math');
INSERT INTO `sections` (`Sec_id`, `dep_id`, `sec_name`) VALUES
(2, 1, 'cs ');
INSERT INTO `sections` (`Sec_id`, `dep_id`, `sec_name`) VALUES
(3, 1, 'pure stat'),
(4, 1, 'math cs'),
(5, 1, 'stat cs'),
(1, 2, 'phys'),
(2, 2, 'phys-cs'),
(3, 2, 'phys-chem'),
(4, 2, 'phys-bio'),
(5, 2, 'phys-quantam');

INSERT INTO `sessions` (`layer_value`, `token`, `ccode`, `is_lec`, `date`, `created_at`, `updated_at`) VALUES
(1, '123456', 'comp106', 1, '2021-05-23', '2021-05-23 12:13:56', '2021-05-23 12:13:56');
INSERT INTO `sessions` (`layer_value`, `token`, `ccode`, `is_lec`, `date`, `created_at`, `updated_at`) VALUES
(1, '12345688', 'comp415', 1, '2021-05-23', '2021-05-23 12:15:33', '2021-05-23 12:15:33');
INSERT INTO `sessions` (`layer_value`, `token`, `ccode`, `is_lec`, `date`, `created_at`, `updated_at`) VALUES
(1, 'tq3Ez7wD', 'COMP104', 1, '2021-05-26', '2021-05-26 17:53:49', '2021-05-26 17:53:49');

INSERT INTO `shcs` (`Sec_id`, `dep_id`, `ccode`, `c_theoretical_ratio`, `c_elective`, `c_semester`, `c_lvl`) VALUES
(0, 1, 'CHEM101', 80, 1, 1, '1');
INSERT INTO `shcs` (`Sec_id`, `dep_id`, `ccode`, `c_theoretical_ratio`, `c_elective`, `c_semester`, `c_lvl`) VALUES
(0, 1, 'CHEM103', 0, 1, 1, '1');
INSERT INTO `shcs` (`Sec_id`, `dep_id`, `ccode`, `c_theoretical_ratio`, `c_elective`, `c_semester`, `c_lvl`) VALUES
(0, 1, 'COMP102', 50, 1, 2, '1');
INSERT INTO `shcs` (`Sec_id`, `dep_id`, `ccode`, `c_theoretical_ratio`, `c_elective`, `c_semester`, `c_lvl`) VALUES
(0, 1, 'COMP104', 20, 1, 2, '1'),
(0, 1, 'COMP106', 50, 1, 2, '1'),
(0, 1, 'COMP108', 50, 1, 2, '1'),
(0, 1, 'ENGL102', 100, 1, 2, '1'),
(0, 1, 'ENGL201', 100, 1, 1, '2'),
(0, 1, 'HURI101', 100, 1, 1, '1'),
(0, 1, 'INCO102', 80, 1, 2, '1'),
(0, 1, 'MATH101', 100, 1, 1, '1'),
(0, 1, 'MATH102', 100, 1, 2, '1'),
(0, 1, 'MATH104', 100, 1, 2, '1'),
(0, 1, 'MATH112', 100, 1, 2, '1'),
(0, 1, 'PHYS101', 50, 1, 1, '1'),
(0, 1, 'PHYS102', 100, 1, 2, '1'),
(0, 1, 'SAFS101', 100, 1, 1, '1'),
(0, 1, 'STAT101', 80, 1, 1, '1'),
(0, 1, 'STAT102', 100, 1, 2, '1'),
(1, 1, 'COMP203', 100, 1, 1, '2'),
(1, 1, 'COMP205', 50, 1, 1, '2'),
(1, 1, 'COMP210', 100, 1, 2, '2'),
(1, 1, 'COMP301', 50, 1, 1, '3'),
(1, 1, 'COMP310', 50, 1, 2, '3'),
(1, 1, 'COMP312', 80, 1, 2, '3'),
(1, 1, 'COMP314', 80, 1, 2, '3'),
(1, 1, 'COMP406', 50, 1, 2, '4'),
(1, 1, 'COMP408', 80, 0, 2, '4'),
(1, 1, 'COMP409', 80, 1, 1, '4'),
(1, 1, 'COMP410', 80, 0, 2, '4'),
(1, 1, 'COMP415', 50, 1, 1, '4'),
(1, 1, 'ENCU401', 100, 0, 1, '4'),
(1, 1, 'ETHR302', 100, 1, 2, '3'),
(1, 1, 'GHDS401', 100, 0, 1, '4'),
(1, 1, 'MATH207', 100, 1, 1, '2'),
(1, 1, 'MATH211', 100, 1, 1, '2'),
(1, 1, 'MATH212', 100, 1, 2, '2'),
(1, 1, 'MATH213', 100, 1, 1, '2'),
(1, 1, 'MATH214', 100, 1, 2, '2'),
(1, 1, 'SCTH301', 100, 1, 1, '3'),
(1, 1, 'SKIL401', 100, 0, 1, '4'),
(1, 1, 'STAT203', 100, 1, 1, '2'),
(1, 1, 'STAT221', 100, 0, 1, '2'),
(1, 1, 'STAT223', 100, 0, 1, '2'),
(1, 1, 'STAT228', 100, 0, 2, '2'),
(2, 1, 'COMP201', 100, 0, 1, '2'),
(2, 1, 'COMP202', 50, 1, 2, '2'),
(2, 1, 'COMP204', 50, 0, 2, '2'),
(2, 1, 'COMP206', 50, 0, 2, '2'),
(2, 1, 'COMP207', 50, 0, 1, '2'),
(2, 1, 'COMP208', 80, 0, 2, '2'),
(2, 1, 'COMP212', 50, 1, 2, '2'),
(2, 1, 'COMP302', 100, 1, 2, '3'),
(2, 1, 'COMP303', 100, 0, 1, '3'),
(2, 1, 'COMP304', 50, 0, 2, '3'),
(2, 1, 'COMP305', 100, 1, 1, '3'),
(2, 1, 'COMP306', 50, 0, 2, '3'),
(2, 1, 'COMP307', 100, 1, 1, '3'),
(2, 1, 'COMP308', 100, 1, 2, '3'),
(2, 1, 'COMP309', 100, 0, 1, '3'),
(2, 1, 'COMP311', 100, 0, 1, '3'),
(2, 1, 'COMP313', 50, 0, 1, '3'),
(2, 1, 'COMP402', 80, 1, 2, '4'),
(2, 1, 'COMP403', 50, 1, 1, '4'),
(2, 1, 'COMP404', 50, 1, 2, '4'),
(2, 1, 'COMP407', 50, 0, 1, '4'),
(2, 1, 'COMP411', 80, 0, 1, '4'),
(2, 1, 'COMP412', 80, 0, 2, '4'),
(2, 1, 'COMP413', 80, 0, 1, '4'),
(2, 1, 'COMP414', 80, 0, 2, '4'),
(2, 1, 'COMP416', 80, 0, 2, '4'),
(2, 1, 'COMP418', 50, 1, 2, '4'),
(2, 1, 'MATH 401', 100, 1, 1, '4'),
(2, 1, 'MATH 402', 100, 1, 2, '4'),
(2, 1, 'MATH 403', 100, 1, 1, '4'),
(2, 1, 'MATH 404', 100, 1, 2, '4'),
(2, 1, 'MATH 406', 100, 0, 2, '4'),
(2, 1, 'MATH 408', 100, 0, 2, '4'),
(2, 1, 'MATH 411', 100, 1, 1, '4'),
(2, 1, 'MATH 412', 100, 1, 2, '4'),
(2, 1, 'MATH 414', 100, 1, 2, '4'),
(2, 1, 'MATH 416', 100, 1, 2, '4'),
(2, 1, 'MATH 418', 100, 0, 2, '4'),
(2, 1, 'MATH 432', 100, 0, 2, '4'),
(2, 1, 'MATH 434', 100, 0, 2, '4'),
(2, 1, 'MATH202', 100, 1, 2, '2'),
(2, 1, 'MATH204', 100, 1, 2, '2'),
(2, 1, 'MATH206', 100, 0, 2, '2'),
(2, 1, 'MATH208', 100, 0, 2, '2'),
(2, 1, 'MATH222', 100, 0, 2, '2'),
(2, 1, 'MATH302', 100, 1, 2, '3'),
(2, 1, 'MATH304', 100, 1, 2, '3');
INSERT INTO `shcs` (`Sec_id`, `dep_id`, `ccode`, `c_theoretical_ratio`, `c_elective`, `c_semester`, `c_lvl`) VALUES
(2, 1, 'MATH305', 100, 0, 1, '3'),
(2, 1, 'MATH306', 100, 0, 2, '3'),
(2, 1, 'MATH307', 100, 0, 1, '3'),
(2, 1, 'MATH308', 100, 0, 2, '3'),
(2, 1, 'MATH312', 100, 1, 2, '3'),
(2, 1, 'MATH314', 100, 1, 2, '3'),
(2, 1, 'MATH316', 100, 0, 2, '3'),
(2, 1, 'MATH317', 100, 0, 1, '3'),
(2, 1, 'MATH318', 100, 0, 2, '3'),
(2, 1, 'MATH319', 100, 0, 1, '3'),
(2, 1, 'MATH322', 100, 0, 2, '3'),
(2, 1, 'MATH331', 100, 0, 1, '3'),
(2, 1, 'MATH332', 100, 0, 2, '3'),
(2, 1, 'MATH405', 100, 1, 1, '4'),
(2, 1, 'MATH407', 100, 0, 1, '4'),
(2, 1, 'MATH409', 100, 0, 1, '4'),
(2, 1, 'MATH413', 100, 1, 1, '4'),
(2, 1, 'MATH415', 100, 0, 1, '4'),
(2, 1, 'MATH421', 100, 0, 1, '4'),
(2, 1, 'MATH423', 100, 1, 1, '4'),
(2, 1, 'STAT201', 100, 0, 1, '2'),
(2, 1, 'STAT204', 100, 0, 2, '2'),
(2, 1, 'STAT205', 100, 0, 1, '2'),
(2, 1, 'STAT207', 50, 0, 1, '2'),
(2, 1, 'STAT208', 100, 0, 2, '2'),
(2, 1, 'STAT222', 100, 0, 2, '2'),
(2, 1, 'STAT224', 100, 0, 2, '2'),
(2, 1, 'STAT301', 100, 1, 1, '3'),
(2, 1, 'STAT302', 100, 1, 2, '3'),
(2, 1, 'STAT303', 100, 1, 1, '3'),
(2, 1, 'STAT304', 100, 1, 2, '3'),
(2, 1, 'STAT305', 100, 0, 1, '3'),
(2, 1, 'STAT306', 100, 1, 2, '3'),
(2, 1, 'STAT310', 100, 0, 2, '3'),
(2, 1, 'STAT311', 100, 0, 1, '3'),
(2, 1, 'STAT312', 100, 0, 2, '3'),
(2, 1, 'STAT313', 100, 0, 1, '3'),
(2, 1, 'STAT314', 100, 0, 2, '3'),
(2, 1, 'STAT315', 100, 0, 1, '3'),
(2, 1, 'STAT317', 100, 0, 1, '3'),
(2, 1, 'STAT318', 100, 0, 2, '3'),
(2, 1, 'STAT320', 100, 1, 2, '3'),
(2, 1, 'STAT322', 100, 0, 2, '3'),
(2, 1, 'STAT401', 100, 0, 1, '4'),
(2, 1, 'STAT402', 50, 1, 2, '4'),
(2, 1, 'STAT403', 50, 0, 1, '4'),
(2, 1, 'STAT404', 100, 1, 2, '4'),
(2, 1, 'STAT405', 50, 1, 1, '4'),
(2, 1, 'STAT406', 50, 0, 2, '4'),
(2, 1, 'STAT408', 50, 0, 2, '4'),
(2, 1, 'STAT411', 100, 0, 1, '4'),
(2, 1, 'STAT412', 100, 0, 2, '4'),
(2, 1, 'STAT415', 100, 1, 1, '4'),
(2, 1, 'STAT416', 100, 0, 2, '4'),
(2, 1, 'STAT417', 100, 0, 1, '4'),
(2, 1, 'STAT418', 100, 0, 2, '4'),
(2, 1, 'STAT426', 50, 1, 2, '4'),
(3, 1, 'MATH201', 100, 1, 1, '2'),
(3, 1, 'MATH203', 100, 1, 1, '2'),
(3, 1, 'MATH205', 100, 0, 1, '2'),
(3, 1, 'MATH301', 100, 1, 1, '3'),
(3, 1, 'MATH303', 100, 1, 1, '3'),
(3, 1, 'MATH311', 100, 1, 1, '3'),
(3, 1, 'MATH313', 100, 1, 1, '3'),
(3, 1, 'STAT202', 100, 1, 2, '2'),
(3, 1, 'STAT206', 100, 1, 2, '2');

INSERT INTO `students` (`Student_id`, `roadmap`, `live_hour`, `c_gpa`, `lvl`, `adv_id`, `Dep_id`, `Sec_id`) VALUES
(200, 2, 12, 3.32, 2, 50012, 1, 2);
INSERT INTO `students` (`Student_id`, `roadmap`, `live_hour`, `c_gpa`, `lvl`, `adv_id`, `Dep_id`, `Sec_id`) VALUES
(1000, 1, 12, 0.00, 2, NULL, 1, 1);
INSERT INTO `students` (`Student_id`, `roadmap`, `live_hour`, `c_gpa`, `lvl`, `adv_id`, `Dep_id`, `Sec_id`) VALUES
(99, 1, 12, 0.00, 1, NULL, 1, 1);

INSERT INTO `users` (`id`, `phone`, `first_name`, `last_name`, `type`, `email`, `password`, `rememberToken`, `created_at`) VALUES
(2, '01092354630', 'kareem', 'omar', 1, 'kareem9@gmail.com', '$2y$10$1doG6ONH/draXivyONDS0eBI10GtImVEvc.fjhfMEUN0UFWZ06i96', NULL, '2021-05-20 09:38:15');
INSERT INTO `users` (`id`, `phone`, `first_name`, `last_name`, `type`, `email`, `password`, `rememberToken`, `created_at`) VALUES
(7, '01092354631', 'ashrf', 'mostafa', 2, 'drashrf@gmail.com', '$2y$10$tTVtPMoiCoQQl4I..rmmJe/j4mistzn.CdwpqCH39LqzbjzoUcZp.', NULL, '2021-05-21 14:35:08');
INSERT INTO `users` (`id`, `phone`, `first_name`, `last_name`, `type`, `email`, `password`, `rememberToken`, `created_at`) VALUES
(55, '01207453246', 'ibrahim', 'ahmed', 1, 'ibrahim@gmail.com', '$2y$10$F4OiJRIpOnIoklReFzRbQuJ3JK7IloAdDGA1t9BVJGwe.nhpIna.m', NULL, '2021-05-03 04:55:29');
INSERT INTO `users` (`id`, `phone`, `first_name`, `last_name`, `type`, `email`, `password`, `rememberToken`, `created_at`) VALUES
(99, '01111111157', 'ibrahim', 'ahmed ibrahim', 1, 'student9@gmail.com', '$2y$10$HrTleAEcQdtSjjlBIVbHOe7a2TIJpVogXuvODgNFzDkiQreja5qS.', NULL, '2021-05-26 18:11:15'),
(100, '01234567895', 'ahmed', 'aasdas32', 3, '1a254429@gmail.com', '$2y$10$9YwBRnsCPvZl/IzqQCktWOZrYyKj.jSYAvTt9muQCbP1oCVQjgdli', NULL, '2021-04-28 13:52:52'),
(200, '01111111177', 'ibrahim', 'ahmed ibrahim', 1, 'student@gmail.com', '$2y$10$cf2SRCgv1tMkXAHHIyHcZuJIfqa5O.8M3rJGiWrcQoBweehGmsXhW', NULL, '2021-05-23 00:05:33'),
(1000, '01111111171', 'ibrahim', 'ahmed ibrahim', 1, 's@gmail.com', '$2y$10$45h4eCiA.qU.wpTuX44KleTf4vx8oKDbmRT/NdkEF1hc66STDj2DO', NULL, '2021-05-23 07:27:03'),
(1998, '01207053244', 'ibrahim', 'ahmed', 3, 'hema.1998.man1@gmail.com', '$2y$10$.6hBtEAU3A8tUxi5JeJR7.EAWDIK0Qk3PiFMmfOPkRPI5c7H5ZCtu', NULL, '2021-04-28 13:55:42'),
(2000, '01155416501', 'mostafa', 'reda', 2, 'reda@gmail.com', '$2y$10$V3sr3VgmAdlmhlbOSkGJWOeSYwD2E/FAdUoaxWis4kurZkecxUULi', NULL, '2021-05-20 08:32:02'),
(5001, '01111111173', 'ibrahim', 'ahmed ibrahim', 2, 'advisor9999@gmail.com', '$2y$10$/ZFnII7.SLnx5d2iufIK6.C4QXnBehl9HMrbVxXDjT6ecmXUzWOAe', NULL, '2021-05-23 10:55:46'),
(19980, '01207053242', 'ibrahim', 'ahmed', 1, 'hema.1998.man11@gmail.com', '$2y$10$iiUoqnhH8uKBCm6rhUwoGOQePInFJiiRK5MvBVaYnieyv9mhxo1KW', NULL, '2021-04-29 03:00:49'),
(50012, '01111111176', 'ibrahim', 'ahmed ibrahim', 2, 'advisor99991@gmail.com', '$2y$10$T4w9.63mzMwP3dxmiat/B.h/OyeQzwu9lgsV2sdzHF8xYhMQzOqsa', NULL, '2021-05-23 11:08:57'),
(100100, '01207053233', 'admin', 'admin', 3, 'admin@gmail.com', '$2y$10$MCHP9t5a5tYhhWBIb6WJSeWTMFapSlOwsT4MKLdeUO3jPDS/GRL8K', NULL, '2021-05-04 03:08:32'),
(199901, '01234567893', 'student', 'student', 2, 'student2@gmail.com', '$2y$10$AGm6dJcaWGLt3h4qVyZol.XUPHXogeIGdLGTDpthpugcN8BCTFtWa', NULL, '2021-05-05 20:31:51'),
(199911, '01092354637', 'kareem', 'omar', 1, 'kareem@gmail.com', '$2y$10$XHCFAgEHG44zwCv1C9LhuuYF.JYNtWNbgdsMx5fDXxsc28qGy58Ny', NULL, '2021-05-20 09:36:56'),
(202120, '01111111119', 'ibrahim', 'ahmed ibrahim', 1, 'ibrahim_test1_@gmail.com', '$2y$10$2yCxaum6ah54FbpIuNLEwu/UbRgWA8kudAIJj1ZmgKg0m9QtKgrK2', NULL, '2021-05-22 22:17:06'),
(500121, '01111111165', 'ibrahim', 'ahmed ibrahim', 2, 'advisor999912@gmail.com', '$2y$10$gvVQAvAY5HsCfKkNrPIUDeco8lV7jJ02opwuPKg0J/tZgfLNcaEcG', NULL, '2021-05-23 11:17:23'),
(999999, '01552467750', 'ibrahim', 'ahmed', 3, 'admin1998@asu.com', '$2y$10$DE4agA8z/A3JWVBtgorpDeSh0ZSPqFIL.SO6fhEccNC6FDmg/ST8e', NULL, '2021-05-26 16:29:28'),
(2021209, '01111111118', 'ibrahim', 'ahmed ibrahim', 1, 'ibrahim_test10_@gmail.com', '$2y$10$r9VbFOepKkDml6laIKj0We9NPHAcQCpF4kl/5Q8ewx9mxizrIPbiy', NULL, '2021-05-22 22:35:49'),
(5001211, '01111111154', 'ibrahim', 'ahmed ibrahim', 2, 'advisor99@gmail.com', '$2y$10$1bLEL/1TxQq5e31/z0Wsg.f6RzWTmKlh1IVa/5uotwuVc1LiGTKbC', NULL, '2021-05-23 11:35:43'),
(5001219, '01111111151', 'ibrahim', 'ahmed ibrahim', 2, 'advisor@gmail.com', '$2y$10$hGefABiNFCYcnZs3rBlWl.SXtQH9xtW6f5ApS7hUq/EGs7Ud5znuW', NULL, '2021-05-23 18:27:02');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;