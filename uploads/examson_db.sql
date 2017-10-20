-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2016 at 05:30 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `examson_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `exon_all_exam`
--

CREATE TABLE IF NOT EXISTS `exon_all_exam` (
`id` int(11) NOT NULL,
  `exam_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `no_of_question` int(5) NOT NULL,
  `duration` int(5) NOT NULL,
  `subject_ids` text CHARACTER SET utf8 NOT NULL,
  `question_ids` text CHARACTER SET utf8 NOT NULL,
  `exam_type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `model_test_sub_cat` int(11) NOT NULL,
  `model_test_status` tinyint(1) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `edited_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `exon_all_exam`
--

INSERT INTO `exon_all_exam` (`id`, `exam_name`, `no_of_question`, `duration`, `subject_ids`, `question_ids`, `exam_type`, `status`, `is_delete`, `created_at`, `user_id`, `creator_id`, `model_test_sub_cat`, `model_test_status`, `editor_id`, `edited_at`) VALUES
(1, 'BCS-34', 8, 25, '', ',1,2,3,4,5,6,7,8,', 1, 0, 0, '2015-04-28 16:07:03', 0, 1, 2, 1, 1, '2015-04-28 21:24:16'),
(3, 'BCS-33', 8, 20, '', ',1,2,3,4,6,7,8,9,', 1, 0, 0, '2015-04-28 21:17:40', 0, 1, 2, 1, 1, '2015-04-28 22:08:39'),
(4, 'Janata Bank', 5, 50, '', ',5,6,1,2,3,', 1, 0, 0, '2015-04-28 22:09:47', 0, 1, 3, 1, 0, '0000-00-00 00:00:00'),
(5, 'General Exam', 50, 25, '{"1":25,"2":25}', ',2,4,3,1,8,7,9,', 0, 1, 0, '2015-04-28 22:14:29', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'General Exam', 100, 25, '{"1":100}', ',3,2,1,4,', 0, 1, 0, '2015-04-29 21:43:58', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'General Exam', 25, 100, '{"1":25}', ',5,6,', 0, 1, 0, '2015-04-29 21:45:33', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'General Exam 1', 50, 20, '{"1":50}', ',6,5,', 0, 1, 0, '2015-04-29 23:09:19', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'General Exam', 20, 25, '{"1":20}', ',6,5,', 0, 0, 0, '2015-04-30 22:11:44', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'General Exam', 50, 25, '{"1":50}', ',6,5,', 0, 0, 0, '2015-05-02 21:03:47', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'General Exam', 50, 10, '{"1":50}', ',6,5,3,4,2,1,', 0, 0, 0, '2015-05-02 22:48:39', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'General Exam', 50, 5, '{"1":50}', ',5,6,', 0, 0, 0, '2015-05-09 21:55:21', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'General Exam', 100, 5, '{"1":100}', ',6,5,', 0, 0, 0, '2015-05-09 22:14:32', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'My test exam', 50, 25, '{"2":25,"1":25}', ',8,7,9,6,5,', 0, 0, 0, '2015-05-14 21:27:31', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'General Exam 1', 50, 25, '{"1":25,"2":25}', ',5,6,7,8,9,', 0, 0, 0, '2015-05-14 21:28:18', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'My test exam', 50, 5, '{"1":50}', ',2,3,1,4,', 0, 0, 0, '2015-05-14 23:16:59', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'test today', 50, 100, '{"1":50}', ',2,1,4,3,', 0, 0, 0, '2015-05-14 23:21:52', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'General Exam', 50, 25, '{"1":50}', ',2,4,1,3,', 0, 0, 0, '2015-05-15 00:11:19', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'My test ', 25, 20, '{"1":25}', ',5,6,', 0, 0, 0, '2015-05-15 00:18:10', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'My test exam', 50, 25, '{"8":50}', ',10,', 0, 0, 0, '2015-05-23 20:59:52', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'DU Test', 50, 20, '{"8":50}', ',10,', 0, 0, 0, '2015-05-23 21:00:52', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'DU Test', 50, 5, '{"8":50}', ',10,', 0, 0, 0, '2015-05-23 21:01:17', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'General Exam', 100, 25, '{"1":100}', ',5,6,', 0, 0, 0, '2015-05-23 21:02:16', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'DU Test', 50, 25, '{"1":50}', ',1,4,2,3,', 0, 0, 0, '2015-05-23 21:04:03', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'DU Test', 50, 25, '{"8":50}', ',10,', 0, 0, 0, '2015-05-23 21:04:55', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'DU Test', 50, 50, '{"8":50}', ',10,', 0, 0, 0, '2015-05-26 21:53:24', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'DU Test', 25, 20, '{"1":25}', ',5,6,', 0, 0, 0, '2015-05-26 21:54:09', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'General Exam', 100, 25, '{"1":100}', ',6,5,', 0, 0, 0, '2015-05-26 22:00:00', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'DU Test', 50, 20, '{"8":50}', ',10,', 0, 0, 0, '2015-05-26 22:00:23', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 'DU Test', 100, 25, '{"8":100}', ',10,', 0, 0, 0, '2015-05-26 22:09:41', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 'dfvaf', 20, 25, '{"8":20}', ',10,', 0, 0, 0, '2015-05-26 22:57:49', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(32, 'sdfghj', 50, 20, '{"8":50}', ',10,', 0, 0, 0, '2015-05-26 23:17:05', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(33, 'General Exam', 50, 25, '{"8":50}', ',10,', 0, 0, 0, '2015-05-26 23:46:56', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(34, 'General Exam', 50, 25, '{"8":50}', ',10,', 0, 0, 0, '2015-05-26 23:48:59', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(35, 'huhuhuu', 100, 25, '{"8":100}', ',10,', 0, 0, 0, '2015-05-26 23:50:39', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(36, 'Tester', 50, 25, '{"8":25,"1":25}', ',10,4,2,3,1,', 0, 0, 0, '2015-05-26 23:51:20', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(37, 'fvsfdbsdfb', 50, 25, '{"8":50}', ',10,', 0, 0, 0, '2015-05-26 23:51:57', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(38, 'ddddddddddddd', 100, 25, '{"8":100}', ',10,', 0, 0, 0, '2015-05-27 00:27:19', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(39, 'new exam', 50, 25, '{"8":50}', ',10,', 0, 0, 0, '2015-05-29 12:01:30', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'DU Test', 50, 30, '{"8":50}', ',10,', 0, 0, 0, '2015-05-29 17:33:09', 3, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(41, 'After ModifyWW', 50, 120, '{"8":"10"}', ',10,', 1, 0, 0, '2015-06-03 14:57:30', 0, 1, 6, 1, 0, '0000-00-00 00:00:00'),
(42, 'After Modify 2', 20, 120, '{"1":"5","2":"5","3":"5"}', ',2,3,1,6,5,7,8,9,', 1, 0, 0, '2015-06-01 22:46:49', 0, 1, 7, 1, 0, '0000-00-00 00:00:00'),
(43, 'After Modify 3', 20, 25, '{"8":"25"}', ',10,', 1, 0, 0, '2015-06-03 11:50:46', 0, 1, 4, 1, 0, '0000-00-00 00:00:00'),
(44, 'After Modifing', 52, 122, '{"1":"52","2":"62","3":"72"}', ',5,3,2,6,1,9,8,7,', 1, 0, 1, '2015-06-03 14:54:03', 0, 1, 6, 1, 0, '0000-00-00 00:00:00'),
(45, 'Tasin', 25, 20, '{"8":"5"}', ',10,', 1, 0, 0, '2015-06-03 15:01:36', 0, 1, 6, 1, 0, '0000-00-00 00:00:00'),
(46, 'Model test ', 120, 20, '{"4":"3","5":"5","6":"7"}', ',', 1, 0, 0, '2015-06-03 19:15:02', 0, 1, 8, 1, 0, '0000-00-00 00:00:00'),
(47, 'adfadsfad', 23, 33, '{"8":23}', ',,', 0, 0, 0, '2015-12-17 17:05:52', 5, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(48, 'sdvsd', 23, 33, '{"8":23}', ',10,', 0, 0, 0, '2015-12-17 17:07:49', 5, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exon_all_exam_result`
--

CREATE TABLE IF NOT EXISTS `exon_all_exam_result` (
`id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_answers` varchar(100) NOT NULL,
  `original_answers` varchar(100) NOT NULL,
  `correct_incorrect_status` varchar(100) NOT NULL,
  `total_question` int(5) NOT NULL,
  `total_correct` int(5) NOT NULL,
  `total_incorrect` int(5) NOT NULL,
  `total_not_answered` int(5) NOT NULL,
  `time_spend` int(11) NOT NULL,
  `attempt_time` int(11) NOT NULL,
  `previous_score` float NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `examed_on` datetime NOT NULL,
  `assign_by` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `exon_all_exam_result`
--

INSERT INTO `exon_all_exam_result` (`id`, `exam_id`, `user_id`, `user_answers`, `original_answers`, `correct_incorrect_status`, `total_question`, `total_correct`, `total_incorrect`, `total_not_answered`, `time_spend`, `attempt_time`, `previous_score`, `exam_type`, `examed_on`, `assign_by`) VALUES
(1, 3, 3, '{"1":"2","2":"5","3":"8","4":"11","6":"14","7":"17","8":"18","9":"20"}', '{"1":"3","2":"5","3":"8","4":"10","6":"15","7":"17","8":"18","9":"20"}', '{"1":0,"2":1,"3":1,"4":0,"6":0,"7":1,"8":1,"9":1}', 8, 5, 3, 0, 0, 1, 0, '1', '2015-05-09 23:24:31', 3),
(2, 3, 3, '{"1":"2","2":"5","3":"8","4":"10","6":"15","7":"16","8":"18","9":"20"}', '{"1":"3","2":"5","3":"8","4":"10","6":"15","7":"17","8":"18","9":"20"}', '{"1":0,"2":1,"3":1,"4":1,"6":1,"7":0,"8":1,"9":1}', 8, 6, 2, 0, 0, 2, 5, '1', '2015-05-09 23:25:31', 3),
(3, 16, 3, '{"2":"0","3":"8","1":"1","4":"10"}', '{"2":"5","3":"8","1":"3","4":"10"}', '{"2":0,"3":1,"1":0,"4":1}', 4, 2, 2, 0, 1, 1, 0, '2', '2015-05-14 23:18:51', 5),
(4, 18, 3, '{"2":"5","4":"11","1":"2","3":"8"}', '{"2":"5","4":"10","1":"3","3":"8"}', '{"2":1,"4":0,"1":0,"3":1}', 4, 2, 2, 0, 0, 1, 0, '2', '2015-05-15 00:16:48', 7),
(5, 19, 3, '{"5":"0","6":"14"}', '{"5":"12","6":"15"}', '{"5":0,"6":0}', 2, 0, 2, 0, 0, 1, 0, '2', '2015-05-15 00:18:19', 8),
(6, 3, 3, '{"1":"1","2":"5","3":"7","4":"11","6":"15","7":"16","8":"18","9":"20"}', '{"1":"3","2":"5","3":"8","4":"10","6":"15","7":"17","8":"18","9":"20"}', '{"1":0,"2":1,"3":0,"4":0,"6":1,"7":0,"8":1,"9":1}', 8, 4, 4, 0, 1, 3, 6, '1', '2015-05-18 22:41:38', 9),
(7, 23, 3, '{"5":"12","6":"14"}', '{"5":"12","6":"15"}', '{"5":1,"6":0}', 2, 1, 1, 0, 0, 1, 0, '2', '2015-05-23 21:02:38', 13),
(8, 30, 0, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-26 22:09:55', 20),
(9, 31, 3, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-26 23:13:18', 21),
(10, 34, 3, '{"10":"0"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-26 23:50:12', 24),
(11, 35, 3, '{"10":"0"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-26 23:50:49', 25),
(12, 36, 3, '{"10":"22","4":"10","2":"4","3":"7","1":"1"}', '{"10":"23","4":"10","2":"5","3":"8","1":"3"}', '{"10":0,"4":1,"2":0,"3":0,"1":0}', 5, 1, 4, 0, 0, 1, 0, '2', '2015-05-26 23:51:40', 26),
(13, 37, 3, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-26 23:52:06', 27),
(14, 38, 3, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-27 00:27:26', 28),
(15, 39, 3, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-29 12:01:42', 29),
(16, 40, 3, '{"10":"24"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-05-29 17:33:43', 30),
(17, 1, 3, '{"1":"2","2":"5","3":"9","4":"10","5":"12","6":"15","7":"0","8":"19"}', '{"1":"3","2":"5","3":"8","4":"10","5":"12","6":"15","7":"17","8":"18"}', '{"1":0,"2":1,"3":0,"4":1,"5":1,"6":1,"7":0,"8":0}', 8, 4, 4, 0, 4, 1, 0, '1', '2015-05-29 17:42:54', 31),
(18, 15, 3, '{"5":"13","6":"0","7":"0","8":"18","9":"0"}', '{"5":"12","6":"15","7":"17","8":"18","9":"20"}', '{"5":0,"6":0,"7":0,"8":1,"9":0}', 5, 1, 4, 0, 0, 1, 0, '0', '2015-05-29 17:46:03', 4),
(19, 42, 3, '{"2":"5","3":"7","1":"2","6":"15","5":"13","7":"17","8":"18","9":"21"}', '{"2":"5","3":"8","1":"3","6":"15","5":"12","7":"17","8":"18","9":"20"}', '{"2":1,"3":0,"1":0,"6":1,"5":0,"7":1,"8":1,"9":0}', 8, 4, 4, 0, 0, 1, 0, '1', '2015-06-03 19:35:28', 33),
(20, 45, 3, '{"10":"23"}', '{"10":"23"}', '{"10":1}', 1, 1, 0, 0, 0, 1, 0, '1', '2015-06-03 19:36:36', 34),
(21, 41, 3, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '1', '2015-06-03 21:26:08', 35),
(22, 42, 3, '{"2":"0","3":"0","1":"0","6":"0","5":"0","7":"0","8":"0","9":"0"}', '{"2":"5","3":"8","1":"3","6":"15","5":"12","7":"17","8":"18","9":"20"}', '{"2":0,"3":0,"1":0,"6":0,"5":0,"7":0,"8":0,"9":0}', 8, 0, 8, 0, 0, 2, 4, '1', '2015-06-03 21:27:12', 36),
(23, 46, 3, '{"":"0"}', '{"":""}', '{"":""}', 1, 0, 0, 1, 0, 1, 0, '1', '2015-06-03 21:28:39', 37),
(24, 42, 3, '{"2":"4","3":"0","1":"0","6":"0","5":"12","7":"0","8":"0","9":"21"}', '{"2":"5","3":"8","1":"3","6":"15","5":"12","7":"17","8":"18","9":"20"}', '{"2":0,"3":0,"1":0,"6":0,"5":1,"7":0,"8":0,"9":0}', 8, 1, 7, 0, 0, 3, 0, '1', '2015-06-03 21:29:25', 38),
(25, 17, 3, '{"2":"5","1":"3","4":"11","3":"9"}', '{"2":"5","1":"3","4":"10","3":"8"}', '{"2":1,"1":1,"4":0,"3":0}', 4, 2, 2, 0, 0, 1, 0, '0', '2015-06-05 01:06:32', 6),
(26, 48, 5, '{"10":"22"}', '{"10":"23"}', '{"10":0}', 1, 0, 1, 0, 0, 1, 0, '2', '2015-12-17 17:08:06', 41);

-- --------------------------------------------------------

--
-- Table structure for table `exon_assigned_exam`
--

CREATE TABLE IF NOT EXISTS `exon_assigned_exam` (
`id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `assign_at` datetime NOT NULL,
  `exam_status` tinyint(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `exon_assigned_exam`
--

INSERT INTO `exon_assigned_exam` (`id`, `exam_id`, `assign_by`, `assign_to`, `assign_at`, `exam_status`) VALUES
(1, 3, 3, 3, '2015-05-09 23:24:05', 1),
(2, 3, 3, 3, '2015-05-09 23:24:58', 1),
(3, 14, 0, 0, '2015-05-14 21:27:31', 0),
(4, 15, 3, 3, '2015-05-14 21:28:18', 1),
(5, 16, 3, 3, '2015-05-14 23:16:59', 1),
(6, 17, 3, 3, '2015-05-14 23:21:52', 1),
(7, 18, 3, 3, '2015-05-15 00:11:19', 1),
(8, 19, 3, 3, '2015-05-15 00:18:10', 1),
(9, 3, 3, 3, '2015-05-18 22:39:45', 1),
(10, 20, 0, 0, '2015-05-23 20:59:52', 0),
(11, 21, 0, 0, '2015-05-23 21:00:52', 0),
(12, 22, 0, 0, '2015-05-23 21:01:17', 0),
(13, 23, 3, 3, '2015-05-23 21:02:16', 1),
(14, 24, 0, 0, '2015-05-23 21:04:03', 0),
(15, 25, 0, 0, '2015-05-23 21:04:55', 0),
(16, 26, 0, 0, '2015-05-26 21:53:24', 0),
(17, 27, 0, 0, '2015-05-26 21:54:09', 0),
(18, 28, 3, 3, '2015-05-26 22:00:00', 2),
(19, 29, 0, 0, '2015-05-26 22:00:23', 0),
(20, 30, 0, 0, '2015-05-26 22:09:42', 1),
(21, 31, 0, 0, '2015-05-26 22:57:49', 0),
(22, 32, 0, 0, '2015-05-26 23:17:05', 0),
(23, 33, 3, 3, '2015-05-26 23:46:56', 0),
(24, 34, 3, 3, '2015-05-26 23:48:59', 1),
(25, 35, 3, 3, '2015-05-26 23:50:39', 1),
(26, 36, 3, 3, '2015-05-26 23:51:20', 1),
(27, 37, 3, 3, '2015-05-26 23:51:57', 1),
(28, 38, 3, 3, '2015-05-27 00:27:19', 1),
(29, 39, 3, 3, '2015-05-29 12:01:30', 1),
(30, 40, 3, 3, '2015-05-29 17:33:09', 1),
(31, 1, 3, 3, '2015-05-29 17:38:04', 1),
(32, 42, 3, 3, '2015-06-03 19:22:00', 0),
(33, 42, 3, 3, '2015-06-03 19:30:08', 1),
(34, 45, 3, 3, '2015-06-03 19:36:27', 1),
(35, 41, 3, 3, '2015-06-03 21:26:00', 1),
(36, 42, 3, 3, '2015-06-03 21:27:01', 1),
(37, 46, 3, 3, '2015-06-03 21:27:56', 1),
(38, 42, 3, 3, '2015-06-03 21:29:03', 1),
(39, 42, 3, 3, '2015-06-05 01:13:14', 2),
(40, 47, 5, 5, '2015-12-17 17:05:52', 2),
(41, 48, 5, 5, '2015-12-17 17:07:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exon_chapter`
--

CREATE TABLE IF NOT EXISTS `exon_chapter` (
`id` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `published` tinyint(2) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `ordering` int(3) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `is_delete` tinyint(2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `exon_chapter`
--

INSERT INTO `exon_chapter` (`id`, `chapter_name`, `published`, `meta_description`, `meta_keyword`, `ordering`, `subject_id`, `created_at`, `edited_at`, `creator_id`, `editor_id`, `is_delete`) VALUES
(1, 'General Knowledge', 1, '', '', 3, 1, '2015-04-28 15:06:25', '0000-00-00 00:00:00', 1, 0, 0),
(2, 'Math', 1, '', '', 1, 1, '2015-04-28 15:06:50', '0000-00-00 00:00:00', 1, 0, 0),
(3, 'English', 1, '', '', 1, 1, '2015-04-28 15:07:06', '0000-00-00 00:00:00', 1, 0, 0),
(4, 'Fundamental', 1, '', '', 2, 2, '2015-04-28 15:27:18', '0000-00-00 00:00:00', 1, 0, 0),
(5, '( ক ) ইউনিট ২০১৪', 1, '', '', 4, 8, '2015-05-23 20:53:58', '2015-05-23 20:54:31', 1, 1, 0),
(6, '( খ ) ইউনিট ২০১৪', 1, '', '', 5, 8, '2015-05-23 20:54:55', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_custom_sessions`
--

CREATE TABLE IF NOT EXISTS `exon_custom_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exon_custom_sessions`
--

INSERT INTO `exon_custom_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('48d768c0e881b4784538c3367469ce06', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1432663838, 'a:1:{s:11:"present_url";s:48:"http://localhost/examson/exam-center/create_exam";}'),
('96197d0f718faec98eb8e22686e7703c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36', 1432663939, 'a:1:{s:11:"present_url";s:48:"http://localhost/examson/exam-center/create_exam";}');

-- --------------------------------------------------------

--
-- Table structure for table `exon_during_exam_state`
--

CREATE TABLE IF NOT EXISTS `exon_during_exam_state` (
`sequence_exam_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `sequence_number` int(11) NOT NULL,
  `is_current` tinyint(1) NOT NULL,
  `is_answered` tinyint(1) NOT NULL,
  `is_not_answered` tinyint(1) NOT NULL,
  `is_marked` tinyint(1) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `exon_during_exam_state`
--

INSERT INTO `exon_during_exam_state` (`sequence_exam_id`, `exam_id`, `user_id`, `question_id`, `sequence_number`, `is_current`, `is_answered`, `is_not_answered`, `is_marked`, `answer_id`, `assign_id`) VALUES
(14, 28, 3, 6, 1, 1, 0, 0, 0, 0, 18),
(15, 28, 3, 5, 2, 0, 0, 0, 0, 0, 18),
(16, 42, 3, 2, 1, 1, 0, 0, 0, 0, 39),
(17, 42, 3, 3, 2, 0, 0, 0, 0, 0, 39),
(18, 42, 3, 1, 3, 0, 0, 0, 0, 0, 39),
(19, 42, 3, 6, 4, 0, 0, 0, 0, 0, 39),
(20, 42, 3, 5, 5, 0, 0, 0, 0, 0, 39),
(21, 42, 3, 7, 6, 0, 0, 0, 0, 0, 39),
(22, 42, 3, 8, 7, 0, 0, 0, 0, 0, 39),
(23, 42, 3, 9, 8, 0, 0, 0, 0, 0, 39),
(24, 47, 5, 0, 1, 1, 0, 0, 0, 0, 40);

-- --------------------------------------------------------

--
-- Table structure for table `exon_exam_result_relation`
--

CREATE TABLE IF NOT EXISTS `exon_exam_result_relation` (
  `exam_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exon_exam_result_relation`
--

INSERT INTO `exon_exam_result_relation` (`exam_id`, `result_id`) VALUES
(3, 1),
(3, 2),
(16, 3),
(18, 4),
(19, 5),
(3, 6),
(23, 7),
(30, 8),
(31, 9),
(34, 10),
(35, 11),
(36, 12),
(37, 13),
(38, 14),
(39, 15),
(40, 16),
(1, 17),
(15, 18),
(42, 19),
(45, 20),
(41, 21),
(42, 22),
(46, 23),
(42, 24),
(17, 25),
(48, 26);

-- --------------------------------------------------------

--
-- Table structure for table `exon_main_category`
--

CREATE TABLE IF NOT EXISTS `exon_main_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `item_type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  `creator_id` int(11) DEFAULT '0',
  `editor_id` int(11) NOT NULL,
  `is_delete` tinyint(2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `exon_main_category`
--

INSERT INTO `exon_main_category` (`id`, `name`, `alias`, `link`, `item_type`, `published`, `parent_id`, `meta_description`, `meta_keyword`, `sublevel`, `ordering`, `created_at`, `edited_at`, `creator_id`, `editor_id`, `is_delete`) VALUES
(1, 'বিশ্ববিদ্যালয়/মেডিকেল ভর্তি পরীক্ষা ', 'বিশ্ববিদ্যালয়/মেডিকেল ভর্তি পরীক্ষা ', '#', '', 1, 0, 'বিশ্ববিদ্যালয়/মেডিকেল ভর্তি পরীক্ষা ', 'বিশ্ববিদ্যালয়/মেডিকেল ভর্তি পরীক্ষা ', 0, 0, '2015-04-28 14:48:07', '2015-05-23 20:50:53', 1, 1, 0),
(2, 'Job', 'job', '#', '', 1, 0, '    ', '    ', 0, 0, '2015-04-28 14:48:46', '0000-00-00 00:00:00', 1, 0, 0),
(3, 'Class VIII -XII', 'class viii -xii', '#', '', 1, 0, '  Class VIII -XII', '  Class VIII -XII', 0, 0, '2015-04-28 14:49:39', '0000-00-00 00:00:00', 1, 0, 0),
(4, 'Previous Year', 'previous year', '#', '', 1, 0, '  Previous Year', '  Previous Year', 0, 0, '2015-04-28 14:50:10', '0000-00-00 00:00:00', 1, 0, 0),
(5, 'Class VIII', 'class viii', '#', '', 1, 3, '  ', '  ', 0, 0, '2015-04-28 14:53:12', '0000-00-00 00:00:00', 1, 0, 0),
(6, 'সকল বিশ্ববিদ্যালয়', 'সকল বিশ্ববিদ্যালয়', '#', '', 1, 1, '    সকল বিশ্ববিদ্যালয়', '    সকল বিশ্ববিদ্যালয়', 0, 0, '2015-04-28 14:55:32', '2015-05-23 20:51:40', 1, 1, 0),
(7, 'All Job', 'all job', '#', '', 1, 2, '  ', '  ', 0, 0, '2015-04-28 14:57:42', '0000-00-00 00:00:00', 1, 0, 0),
(8, 'Class IX', 'class ix', '#', '', 1, 3, '  ', '  ', 0, 0, '2015-04-28 15:01:35', '0000-00-00 00:00:00', 1, 0, 0),
(9, 'Class X', 'class x', '#', '', 1, 3, '  ', '  ', 0, 0, '2015-04-28 15:02:14', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_model_test_category`
--

CREATE TABLE IF NOT EXISTS `exon_model_test_category` (
`id` int(11) NOT NULL,
  `category_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `location_id` int(4) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edited_at` datetime NOT NULL,
  `editor_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `exon_model_test_category`
--

INSERT INTO `exon_model_test_category` (`id`, `category_name`, `location_id`, `published`, `created_at`, `creator_id`, `edited_at`, `editor_id`, `is_delete`) VALUES
(1, 'Addmission', 1, 1, '2015-01-15 23:10:09', 1, '2015-06-03 11:50:12', 1, 0),
(2, 'BCS', 1, 1, '2015-01-15 23:32:35', 1, '2015-01-17 22:14:34', 1, 0),
(3, 'Bank Job', 1, 1, '2015-01-17 22:04:44', 1, '2015-04-28 22:09:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_model_test_sub_cat`
--

CREATE TABLE IF NOT EXISTS `exon_model_test_sub_cat` (
`id` int(11) NOT NULL,
  `sub_cat_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edited_at` datetime NOT NULL,
  `editor_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `exon_model_test_sub_cat`
--

INSERT INTO `exon_model_test_sub_cat` (`id`, `sub_cat_name`, `category_id`, `created_at`, `creator_id`, `edited_at`, `editor_id`, `is_delete`) VALUES
(4, 'test', 1, '2015-05-30 22:37:37', 1, '2015-06-03 11:49:47', 1, 0),
(5, 'Tests', 2, '2015-05-30 23:09:45', 1, '2015-05-30 23:15:52', 1, 1),
(6, 'Hellos', 1, '2015-05-31 20:47:22', 1, '2015-06-03 11:49:37', 1, 0),
(7, 'Test1', 2, '2015-06-03 19:11:20', 1, '0000-00-00 00:00:00', 0, 0),
(8, 'Sonali Bank', 3, '2015-06-03 19:14:32', 1, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_permissions`
--

CREATE TABLE IF NOT EXISTS `exon_permissions` (
`permission_id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `permission_alias` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `exon_permissions`
--

INSERT INTO `exon_permissions` (`permission_id`, `permission`, `permission_alias`, `description`, `created_on`, `edited_on`, `group_id`, `status`) VALUES
(1, 'Manage Home', 'manage_home', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, 'Add User', 'add_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(3, 'Edit User', 'edit_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(4, 'Manager User', 'manager_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(5, 'Delete User', 'delete_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(6, 'Manage Role', 'manage_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(7, 'Add Role', 'add_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(8, 'Edit Role', 'edit_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(9, 'Delete Role', 'delete_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(10, 'Manage Permission', 'manage_permission', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 4, 0),
(11, 'Add Permission', 'add_permission', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 4, 0),
(12, 'Manager Supplier', 'manager_supplier', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 5, 0),
(13, 'Add Supplier', 'add_supplier', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 5, 0),
(14, 'Edit Supplier', 'edit_supplier', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 5, 0),
(15, 'Delete Supplier', 'delete_supplier', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 5, 0),
(16, 'Export CSV File', 'export_csv_file', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 5, 0),
(17, 'Import CSV File', 'import_csv_file', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 5, 0),
(18, 'Manager Current Rate', 'manager_current_rate', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 6, 0),
(20, 'Edit Current Rate', 'edit_current_rate', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 6, 0),
(22, 'Edit Profile', 'edit_profile', '', '2014-03-11 00:00:00', '0000-00-00 00:00:00', 2, 0),
(23, 'Change Password', 'change_password', '', '2014-03-11 00:00:00', '0000-00-00 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_permission_groups`
--

CREATE TABLE IF NOT EXISTS `exon_permission_groups` (
`group_id` int(11) NOT NULL,
  `group` varchar(100) NOT NULL,
  `group_alias` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `exon_permission_groups`
--

INSERT INTO `exon_permission_groups` (`group_id`, `group`, `group_alias`, `status`) VALUES
(1, 'Home', 'home', 1),
(2, 'User', 'user', 1),
(3, 'Role', 'role', 1),
(4, 'Permission', 'permission', 1),
(5, 'Supplier', 'supplier', 1),
(6, 'Rate', 'rate', 1),
(7, 'Report', 'report', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exon_popular_model_test`
--

CREATE TABLE IF NOT EXISTS `exon_popular_model_test` (
  `exam_id` int(11) NOT NULL,
  `total_participate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exon_popular_model_test`
--

INSERT INTO `exon_popular_model_test` (`exam_id`, `total_participate`) VALUES
(1, 6),
(4, 1),
(3, 3),
(42, 3),
(45, 1),
(41, 1),
(46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exon_question`
--

CREATE TABLE IF NOT EXISTS `exon_question` (
`id` int(11) NOT NULL,
  `details` longtext CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `chapter_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edited_at` datetime NOT NULL,
  `editor_id` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `exon_question`
--

INSERT INTO `exon_question` (`id`, `details`, `image`, `image_path`, `chapter_id`, `created_at`, `creator_id`, `edited_at`, `editor_id`, `status`) VALUES
(1, 'Which writer came to India after life became difficult for her in Bangladesh after her novel Lajja was published?', NULL, NULL, 1, '2015-04-28 15:13:10', 1, '0000-00-00 00:00:00', 0, 1),
(2, 'When did Bangladesh become an independent country?', NULL, NULL, 1, '2015-04-28 15:15:35', 1, '0000-00-00 00:00:00', 0, 1),
(3, 'Which river of Bangladesh originates in Tibet?', NULL, NULL, 1, '2015-04-28 15:17:02', 1, '0000-00-00 00:00:00', 0, 1),
(4, '<span  "Arial Narrow","sans-serif"; mso-bidi-font-family: "Times New Roman"; mso-fareast-font-family: "Times New Roman";">Which  Day is the longest day in ayear?</span>', NULL, NULL, 1, '2015-04-28 15:20:49', 1, '0000-00-00 00:00:00', 0, 0),
(5, '<font color="black">The <b>father of English Poem</b> <b><font color="black">?</font></b></font>', NULL, NULL, 3, '2015-04-28 15:22:25', 1, '0000-00-00 00:00:00', 0, 1),
(6, '<font color="black">Most <b>famous satirist</b> in <b>English literature __</font>', NULL, NULL, 3, '2015-04-28 15:24:53', 1, '0000-00-00 00:00:00', 0, 1),
(7, '<span  "Arial Narrow","sans-serif"; mso-bidi-font-family: "Times New Roman"; mso-fareast-font-family: "Times New Roman";"> When the Bangla Search Engine PIPILILAstared?</span>', NULL, NULL, 4, '2015-04-28 15:28:20', 1, '0000-00-00 00:00:00', 0, 1),
(8, '<span  "Times New Roman","serif"; font-size: 12.0pt; mso-fareast-font-family: "Times New Roman";">WiFi Stand for ?<br></span>', NULL, NULL, 4, '2015-04-28 15:30:41', 1, '0000-00-00 00:00:00', 0, 1),
(9, 'RAM Stands for ?<br>', NULL, NULL, 4, '2015-04-28 15:32:27', 1, '0000-00-00 00:00:00', 0, 1),
(10, 'Which of the following would be the most appropriate title for the passage？', NULL, NULL, 5, '2015-05-23 20:59:27', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exon_question_answer`
--

CREATE TABLE IF NOT EXISTS `exon_question_answer` (
`answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_option_id` int(11) NOT NULL,
  `partial_answer` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `exon_question_answer`
--

INSERT INTO `exon_question_answer` (`answer_id`, `question_id`, `answer_option_id`, `partial_answer`) VALUES
(1, 1, 3, ''),
(2, 2, 5, ''),
(3, 3, 8, ''),
(4, 4, 10, ''),
(5, 5, 12, ''),
(6, 6, 15, ''),
(7, 7, 17, ''),
(8, 8, 18, ''),
(9, 9, 20, ''),
(10, 10, 23, '');

-- --------------------------------------------------------

--
-- Table structure for table `exon_question_options`
--

CREATE TABLE IF NOT EXISTS `exon_question_options` (
`id` int(11) NOT NULL,
  `option_details` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `ordering` int(6) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `exon_question_options`
--

INSERT INTO `exon_question_options` (`id`, `option_details`, `image`, `image_path`, `question_id`, `ordering`, `status`) VALUES
(1, 'Anita Desai', '', '', 1, 0, 1),
(2, 'Kiran Desai', '', '', 1, 0, 1),
(3, 'Taslima Nasreen', '', '', 1, 0, 1),
(4, 'Baluchistan', '', '', 2, 0, 1),
(5, 'East Pakistan', '', '', 2, 0, 1),
(6, 'Baltistan', '', '', 2, 0, 1),
(7, 'Tista', '', '', 3, 0, 1),
(8, 'Padma', '', '', 3, 0, 1),
(9, 'Surma', '', '', 3, 0, 1),
(10, '21 June', '', '', 4, 0, 1),
(11, '21 Jully', '', '', 4, 0, 1),
(12, 'Geoffrey Chaucer', '', '', 5, 0, 1),
(13, 'Michel John', '', '', 5, 0, 1),
(14, 'Geoffrey Chaucer', '', '', 6, 0, 1),
(15, 'Jonathan Swift', '', '', 6, 0, 1),
(16, '13th April, 2014', '', '', 7, 0, 1),
(17, '13th April, 2013', '', '', 7, 0, 1),
(18, 'Wireless Fidelity ', '', '', 8, 0, 1),
(19, 'Wireless Flexibility ', '', '', 8, 0, 1),
(20, 'Random access memory', '', '', 9, 0, 1),
(21, 'Random access modem', '', '', 9, 0, 1),
(22, 'International Banking Policies ', '', '', 10, 0, 1),
(23, 'The History of Monetary Exchange ', '', '', 10, 0, 1),
(24, 'The Development of Paper Currencies ', '', '', 10, 0, 1),
(25, 'Current Problems in the Economy ', '', '', 10, 0, 1),
(26, 'Electronic Money & Currency', '', '', 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exon_roles`
--

CREATE TABLE IF NOT EXISTS `exon_roles` (
`role_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `exon_roles`
--

INSERT INTO `exon_roles` (`role_id`, `role`, `status`) VALUES
(1, 'Administrator', 1),
(3, 'Top Management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exon_role_permission_relation`
--

CREATE TABLE IF NOT EXISTS `exon_role_permission_relation` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exon_subject`
--

CREATE TABLE IF NOT EXISTS `exon_subject` (
`id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `published` tinyint(2) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `ordering` int(3) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `is_delete` tinyint(2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `exon_subject`
--

INSERT INTO `exon_subject` (`id`, `subject_name`, `published`, `meta_description`, `meta_keyword`, `ordering`, `sub_category_id`, `created_at`, `edited_at`, `creator_id`, `editor_id`, `is_delete`) VALUES
(1, 'Bank Job', 1, '', '', 2, 7, '2015-04-28 14:58:44', '2015-04-28 16:05:10', 1, 1, 0),
(2, 'IT Job', 1, '', '', 1, 7, '2015-04-28 14:59:05', '0000-00-00 00:00:00', 1, 0, 0),
(3, 'University Job', 1, '', '', 3, 7, '2015-04-28 14:59:51', '0000-00-00 00:00:00', 1, 0, 0),
(4, 'General Math', 1, '', '', 1, 9, '2015-04-28 15:03:06', '0000-00-00 00:00:00', 1, 0, 0),
(5, 'English', 1, '', '', 2, 9, '2015-04-28 15:03:41', '0000-00-00 00:00:00', 1, 0, 0),
(6, 'Bangla', 1, '', '', 4, 9, '2015-04-28 15:04:04', '0000-00-00 00:00:00', 1, 0, 0),
(7, 'Bangla', 1, '', '', 8, 9, '2015-04-28 15:04:39', '0000-00-00 00:00:00', 1, 0, 1),
(8, 'ঢাকা বিশ্ববিদ্যালয়', 1, '', '', 4, 6, '2015-05-23 20:42:34', '2015-05-23 20:52:17', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_users`
--

CREATE TABLE IF NOT EXISTS `exon_users` (
`user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `designition` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `education_level` varchar(150) NOT NULL,
  `employment_status` varchar(150) NOT NULL,
  `status` int(2) NOT NULL,
  `last_edited_at` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `exon_users`
--

INSERT INTO `exon_users` (`user_id`, `created_at`, `last_name`, `first_name`, `designition`, `address`, `gender`, `image`, `image_path`, `date_of_birth`, `mobile`, `phone`, `education_level`, `employment_status`, `status`, `last_edited_at`) VALUES
(1, '0000-00-00 00:00:00', 'Ahmed', 'Mamun', 'Software Engineer', 'Dhaka', 0, '', '', '0000-00-00', '', '', '', '', 1, '0000-00-00'),
(2, '0000-00-00 00:00:00', 'Management', 'Top', 'Admin', 'Dhaka', 0, '', '', '0000-00-00', '', '', '', '', 1, '0000-00-00'),
(3, '0000-00-00 00:00:00', 'Ali', 'Haider Hossain', '', 'Madaripur,Dhaka,Bangladesh', 0, '', '', '2015-04-14', '01671583041', '', 'Bsc', 'Private Service', 1, '2015-04-17'),
(4, '2015-04-10 14:19:25', 'Bangla', 'Sonar', '', '', 0, '', '', '0000-00-00', '01712348349', '', '', '', 1, '0000-00-00'),
(5, '2015-12-17 16:52:31', 'Hasan', 'Ahamed', '', '', 0, '', '', '0000-00-00', '01000000000', '', '', '', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `exon_user_email_notifications`
--

CREATE TABLE IF NOT EXISTS `exon_user_email_notifications` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_exam` tinyint(1) NOT NULL,
  `send_exam` tinyint(1) NOT NULL,
  `send_exam_report` tinyint(1) NOT NULL,
  `monthly_newsletter` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `exon_user_email_notifications`
--

INSERT INTO `exon_user_email_notifications` (`id`, `user_id`, `assigned_exam`, `send_exam`, `send_exam_report`, `monthly_newsletter`) VALUES
(1, 3, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exon_user_login`
--

CREATE TABLE IF NOT EXISTS `exon_user_login` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `alternative_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `can_login` tinyint(1) NOT NULL,
  `edited_at` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `login_ip` varchar(64) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `exon_user_login`
--

INSERT INTO `exon_user_login` (`id`, `user_id`, `username`, `alternative_email`, `password`, `user_type`, `is_active`, `can_login`, `edited_at`, `last_login`, `security_code`, `login_ip`, `user_agent`) VALUES
(1, 1, 'admin@admin.com', '', 'ae4b1ba2aca3875dfab6c35be673ee66', 1, 1, 1, '0000-00-00 00:00:00', '2015-06-03 01:05:16', '', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),
(2, 2, 'top@management.com', '', '8dd57884e6505457c34f313c1154237f', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2014-10-22 01:06:15', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0'),
(3, 3, 'hasan@gmail.com', 'maamun7@gmail.com', '7cd427b93ae142a0bbce3a801862f50a', 2, 1, 1, '2015-04-12 23:58:11', '2015-06-15 07:57:47', '', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),
(4, 4, 'sonar@gmail.com', '', 'cf8c66305c4f5518b72907d1092d0fba', 2, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'd77943c8fe820c75e04edbd1128e1a4c', '', ''),
(5, 5, 'test@test.com', '', '7cd427b93ae142a0bbce3a801862f50a', 2, 1, 1, '0000-00-00 00:00:00', '2015-12-17 12:05:36', '', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0');

-- --------------------------------------------------------

--
-- Table structure for table `exon_user_role_relation`
--

CREATE TABLE IF NOT EXISTS `exon_user_role_relation` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `exon_user_role_relation`
--

INSERT INTO `exon_user_role_relation` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(3, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exon_all_exam`
--
ALTER TABLE `exon_all_exam`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_all_exam_result`
--
ALTER TABLE `exon_all_exam_result`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_assigned_exam`
--
ALTER TABLE `exon_assigned_exam`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_chapter`
--
ALTER TABLE `exon_chapter`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_custom_sessions`
--
ALTER TABLE `exon_custom_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `exon_during_exam_state`
--
ALTER TABLE `exon_during_exam_state`
 ADD PRIMARY KEY (`sequence_exam_id`);

--
-- Indexes for table `exon_main_category`
--
ALTER TABLE `exon_main_category`
 ADD PRIMARY KEY (`id`), ADD KEY `componentid` (`published`);

--
-- Indexes for table `exon_model_test_category`
--
ALTER TABLE `exon_model_test_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_model_test_sub_cat`
--
ALTER TABLE `exon_model_test_sub_cat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_permissions`
--
ALTER TABLE `exon_permissions`
 ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `exon_permission_groups`
--
ALTER TABLE `exon_permission_groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `exon_question`
--
ALTER TABLE `exon_question`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_question_answer`
--
ALTER TABLE `exon_question_answer`
 ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `exon_question_options`
--
ALTER TABLE `exon_question_options`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_roles`
--
ALTER TABLE `exon_roles`
 ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `exon_role_permission_relation`
--
ALTER TABLE `exon_role_permission_relation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_subject`
--
ALTER TABLE `exon_subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_users`
--
ALTER TABLE `exon_users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `exon_user_email_notifications`
--
ALTER TABLE `exon_user_email_notifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_user_login`
--
ALTER TABLE `exon_user_login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exon_user_role_relation`
--
ALTER TABLE `exon_user_role_relation`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exon_all_exam`
--
ALTER TABLE `exon_all_exam`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `exon_all_exam_result`
--
ALTER TABLE `exon_all_exam_result`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `exon_assigned_exam`
--
ALTER TABLE `exon_assigned_exam`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `exon_chapter`
--
ALTER TABLE `exon_chapter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `exon_during_exam_state`
--
ALTER TABLE `exon_during_exam_state`
MODIFY `sequence_exam_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `exon_main_category`
--
ALTER TABLE `exon_main_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `exon_model_test_category`
--
ALTER TABLE `exon_model_test_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exon_model_test_sub_cat`
--
ALTER TABLE `exon_model_test_sub_cat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `exon_permissions`
--
ALTER TABLE `exon_permissions`
MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `exon_permission_groups`
--
ALTER TABLE `exon_permission_groups`
MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `exon_question`
--
ALTER TABLE `exon_question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `exon_question_answer`
--
ALTER TABLE `exon_question_answer`
MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `exon_question_options`
--
ALTER TABLE `exon_question_options`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `exon_roles`
--
ALTER TABLE `exon_roles`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exon_role_permission_relation`
--
ALTER TABLE `exon_role_permission_relation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exon_subject`
--
ALTER TABLE `exon_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `exon_users`
--
ALTER TABLE `exon_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `exon_user_email_notifications`
--
ALTER TABLE `exon_user_email_notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `exon_user_login`
--
ALTER TABLE `exon_user_login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `exon_user_role_relation`
--
ALTER TABLE `exon_user_role_relation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
