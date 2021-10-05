-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2019 at 12:49 PM
-- Server version: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcc_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2018_09_01_050128_ori_mast_plans', 1),
(3, '2018_09_25_122253_create_ori_default_profile_fields_table', 1),
(4, '2018_10_01_000000_create_ori_company_profiles_table', 1),
(5, '2018_10_01_000000_create_ori_countries_table', 1),
(6, '2018_10_01_000000_create_ori_country_ph_code_table', 1),
(7, '2018_10_01_000001_create_ori_mast_lead_source_type_table', 1),
(8, '2018_10_01_000001_create_ori_roles_table', 1),
(9, '2018_10_01_000001_create_ori_state_table', 1),
(10, '2018_10_01_000001_create_ori_users_table', 1),
(11, '2018_10_01_000001_create_querry_status_table', 1),
(12, '2018_10_01_000001_ori_mast_customer_nature', 1),
(13, '2018_10_01_000001_ori_mast_priority', 1),
(14, '2018_10_01_000002_create_ori_customer_profiles_table', 1),
(15, '2018_10_01_000002_create_ori_district_table', 1),
(16, '2018_10_01_000002_create_ori_mast_lead_sources_table', 1),
(17, '2018_10_01_000002_ori_mast_faq_category_table', 1),
(18, '2018_10_01_000002_ori_mast_query_type_table', 1),
(19, '2018_10_01_000002_update_mast_faq_category_table', 1),
(20, '2018_10_01_000003_create_query_status__relations_table', 1),
(21, '2018_10_01_000003_ori_mast_templates_table', 1),
(22, '2018_10_01_052430_create_password_histories_table', 1),
(23, '2018_10_01_052430_create_password_securities_table', 1),
(24, '2018_10_01_100721_create_ori_user_logs_table', 1),
(25, '2018_10_01_110550_create_ori_customer_profile_fields_table', 1),
(26, '2018_10_01_110551_create_ori_customer_profile_meta_table', 1),
(27, '2018_10_01_110552_create_ori_customer_profile_log_table', 1),
(28, '2018_10_01_130239_update_ori_users_role_table', 1),
(29, '2018_10_03_060700_create_ori_faqs_table', 1),
(30, '2018_10_04_080849_create_ori_common_sms_email_table', 1),
(31, '2018_10_05_062823_create_cc_permissions_table', 1),
(32, '2018_10_06_091436_create_ori_groups_table', 1),
(33, '2018_10_06_093948_ori_mast_query_category_relation_table', 1),
(34, '2018_10_08_053702_create_ori_customer_profile_meta_log_table', 1),
(35, '2018_10_08_100000_update_ori_groups_table', 1),
(36, '2018_10_09_120824_create_ori_questions_table', 1),
(37, '2018_10_10_093808_create_ori_fb_settings_table', 1),
(38, '2018_10_10_105727_create_ori_channels_table', 1),
(39, '2018_10_10_110241_create_ori_company_channels_table', 1),
(40, '2018_10_11_100000_update_ori_customer_profiles_log_table', 1),
(41, '2018_10_11_100000_update_ori_customer_profiles_table', 1),
(42, '2018_10_11_102129_create_ori_api_call_logs_table', 1),
(43, '2018_10_11_133358_create_ori_fb_details_table', 1),
(44, '2018_10_11_133413_create_ori_fb_details_log_table', 1),
(45, '2018_10_11_133430_create_ori_fb_question_details_table', 1),
(46, '2018_10_12_042340_create_ori_group_contacts_table', 1),
(47, '2018_10_12_043350_create_ori_fb_question_details_log_table', 1),
(48, '2018_10_12_050605_create_ori_chat_thread_table', 1),
(49, '2018_10_12_052430_alter_ori_helpdesk_table', 1),
(50, '2018_10_12_052430_alter_ori_lead_followups_table', 1),
(51, '2018_10_12_052431_alter_ori_helpdesk_log_table', 1),
(52, '2018_10_12_052431_alter_ori_lead_followups_log_table', 1),
(53, '2018_10_12_065149_update_ori_group_contacts', 1),
(54, '2018_10_12_070753_update_ori_group_contacts_2', 1),
(55, '2018_10_12_092827_remove_chit_id', 1),
(56, '2018_10_12_130421_create_ori_fb_feedback_request_table', 1),
(57, '2018_10_13_000000_update_ori_fb_details', 1),
(58, '2018_10_14_113823_create_ori_batch_process_table', 1),
(59, '2018_10_15_000000_update_ori_customer_profile_fields', 1),
(60, '2018_10_15_050554_create_ori_mast_package_table', 1),
(61, '2018_10_15_061144_create_ori_chat_thread_logs_table', 1),
(62, '2018_10_15_110921_create_ori_email_fetchs_table', 1),
(63, '2018_10_15_110923_create_ori_email_fetchs_attachments_table', 1),
(64, '2018_10_15_130239_update_ori_helpdesk_log_table', 1),
(65, '2018_10_15_130239_update_ori_helpdesk_table', 1),
(66, '2018_10_17_000000_update_ori_fb_question_details', 1),
(67, '2018_10_24_125718_create_ori_fb_questions_table', 1),
(68, '2018_10_24_125719_add_foreign_keys_to_ori_fb_questions_table', 1),
(69, '2018_11_09_113312_create_ori_automated_process_batch_expiry_table', 1),
(70, '2018_11_09_113312_create_ori_automated_process_batch_table', 1),
(71, '2018_11_09_113312_create_ori_automated_process_stages_table', 1),
(72, '2018_11_09_113313_create_ori_automated_process_log_table', 1),
(73, '2018_11_09_113313_create_ori_automated_process_relations_table', 1),
(74, '2018_11_12_105046_create_ori_cron_logs_table', 1),
(75, '2018_11_12_105048_add_foreign_keys_to_ori_cron_logs_table', 1),
(76, '2018_11_12_115800_create_ori_intimations_table', 1),
(77, '2018_11_12_115800_create_ori_notifications_list_table', 1),
(78, '2018_11_12_115800_create_ori_notifications_roles_relations_table', 1),
(79, '2018_11_12_132323_ori_company_meta', 1),
(80, '2018_11_14_045348_create_ori_cmp_contacts', 1),
(81, '2018_11_14_061120_create_ori_cmp_contacts_meta', 1),
(82, '2018_11_14_091627_update_ori_group_contacts_3', 1),
(83, '2018_11_15_132639_create_ori_survey_settings_table', 1),
(84, '2018_11_15_132641_add_foreign_keys_to_ori_survey_settings_table', 1),
(85, '2018_11_15_132706_create_ori_survey_question_settings_table', 1),
(86, '2018_11_15_132707_add_foreign_keys_to_ori_survey_question_settings_table', 1),
(87, '2018_11_16_043841_create_ori_campaigns_table', 1),
(88, '2018_11_16_050340_create_ori_campaign_groups_table', 1),
(89, '2018_11_16_053127_create_ori_campaigns_meta_table', 1),
(90, '2018_11_16_093214_add_status_to_intimations', 1),
(91, '2018_11_19_000000_update_ori_fb_details_log', 1),
(92, '2018_11_19_103748_add_link_to_ori_intimation', 1),
(93, '2018_11_19_132221_create_ori_campaign_batches_table', 1),
(94, '2018_11_20_045420_create_ori_survey_details_table', 1),
(95, '2018_11_20_045421_add_foreign_keys_to_ori_survey_details_table', 1),
(96, '2018_11_20_045451_create_ori_survey_question_details_table', 1),
(97, '2018_11_20_045453_add_foreign_keys_to_ori_survey_question_details_table', 1),
(98, '2018_11_20_065819_create_ori_campaign_batch_groups_table', 1),
(99, '2018_11_20_072504_update_ori_campaign_batches_table', 1),
(100, '2018_11_20_092014_update_ori_campaign_batches_table_2', 1),
(101, '2018_11_20_113315_update_ori_common_sms_email2', 1),
(102, '2018_11_20_124536_add_foreign_key_to_email_fetch', 1),
(103, '2018_11_21_055614_add_flag_to_notifications', 1),
(104, '2018_11_21_085825_update_ori_common_sms_email3', 1),
(105, '2018_11_21_111533_create_ori_sendgrid_response_table', 1),
(106, '2018_11_22_110211_create_ori_autodial_schedules_table', 1),
(107, '2018_11_23_071914_create_ori_chat_feedback_count_table', 1),
(108, '2018_11_26_072752_create_ori_group_excel_import_batches_table', 1),
(109, '2018_11_26_104213_ori_cmp_reg_payments', 1),
(110, '2018_11_26_114703_ori_cmp_reg_payments_log', 1),
(111, '2018_11_27_064346_create_ori_channel_gateway_table', 1),
(112, '2018_11_27_064347_add_foreign_keys_to_ori_channel_gateway_table', 1),
(113, '2018_11_27_101820_create_ori_customer_fcms_table', 1),
(114, '2018_11_27_111015_add_columns_to_common_sms_email', 1),
(115, '2018_11_27_111015_add_columns_to_plan_table', 1),
(116, '2018_11_27_122814_create_ori_mast_plans_duration_table', 1),
(117, '2018_11_27_130000_add_columns_to_duration_table', 1),
(118, '2018_11_28_053329_ori_company_subscriptions', 1),
(119, '2018_11_28_100422_create_ori_company_channel_gateway_table', 1),
(120, '2018_11_28_100423_add_foreign_keys_to_ori_company_channel_gateway_table', 1),
(121, '2018_11_29_000000_update_ori_survey_question_details', 1),
(122, '2018_11_29_054751_update_ori_group_contacts_4', 1),
(123, '2018_11_29_114617_create_jobs_table', 1),
(124, '2018_11_29_114936_create_failed_jobs_table', 1),
(125, '2018_12_03_054204_add_columns_to_reg_payment_table', 1),
(126, '2018_12_03_063627_create_ori_tabs_table', 1),
(127, '2018_12_03_063628_add_foreign_keys_to_ori_tabs_table', 1),
(128, '2018_12_03_063723_add_columns_to_reg_payment_log_table', 1),
(129, '2018_12_03_134354_create_ori_group_excel_import_failed_rows_table', 1),
(130, '2018_12_04_000000_update_ori_customer_profile_fields1', 1),
(131, '2018_12_04_000000_update_ori_customer_profile_meta', 1),
(132, '2018_12_04_000000_update_ori_default_profile_fields', 1),
(133, '2018_12_04_051031_update_ori_group_excel_import_batches_table', 1),
(134, '2018_12_06_044010_add_columns_to_ori_company_profile', 1),
(135, '2018_12_06_072535_update_ori_fb_questions_table', 1),
(136, '2018_12_06_084726_create_ori_attachments_table', 1),
(137, '2018_12_06_092323_create_ori_emailfetch_company_table', 1),
(138, '2018_12_06_122000_create_ori_campaign_query_status_table', 1),
(139, '2018_12_06_122001_add_foreign_keys_to_ori_campaign_query_status_table', 1),
(140, '2018_12_07_090354_ori_mast_coupon_codes', 1),
(141, '2018_12_07_093227_add_columns_to_ori_mast_plans', 1),
(142, '2018_12_07_100246_update_ori_batch_process_table', 1),
(143, '2018_12_13_042822_add_columns_to_ori_cmp_reg_payments', 1),
(144, '2018_12_13_042904_add_columns_to_ori_cmp_reg_payments_log', 1),
(145, '2018_12_13_042934_add_columns_to_ori_company_subscriptions', 1),
(146, '2018_12_15_090000_create_ori_auto_reply_category_table', 1),
(147, '2018_12_15_090558_create_ori_auto_reply_table', 1),
(148, '2018_12_18_072906_create_ori_location_settings_table', 1),
(149, '2018_12_18_073125_create_ori_localbodytype_table', 1),
(150, '2018_12_18_073157_create_ori_localbody_table', 1),
(151, '2018_12_18_073255_create_ori_field_types_table', 1),
(152, '2018_12_19_000000_update_ori_customer_profile_fields2', 1),
(153, '2018_12_19_100000_update_ori_customer_profile_log_table1', 1),
(154, '2018_12_19_100000_update_ori_customer_profiles_table1', 1),
(155, '2019_01_03_073101_alter_ori_faqs_table', 1),
(156, '2019_01_04_054937_update_ori_cmp_contacts_table', 1),
(157, '2019_01_04_095313_create_ori_automated_process_table', 1),
(158, '2019_01_04_110048_add_updaterfields_to_autoprocess', 1),
(159, '2019_01_09_071601_add_department_to_ori_automated_process', 1),
(160, '2019_01_09_072416_add_is_first_to_ori_automated_process', 1),
(161, '2019_01_09_085406_add_parent_id_to_ori_automated_process', 1),
(162, '2019_01_10_075846_create_ori_basic_templates_table', 1),
(163, '2019_01_10_133021_update_ori_users_table', 1),
(164, '2019_01_10_133234_update_ori_users_tables', 1),
(165, '2019_01_17_074320_update_ori_batch_process_table_2', 1),
(166, '2019_01_7_100000_update_ori_customer_profile_log_table2', 1),
(167, '2019_03_03_000000_add_columns_to_helpdesk_table', 1),
(168, '2019_03_03_111111_add_columns_to_helpdesk_log_table', 1),
(169, '2019_03_03_333333_add_columns_to_query_type_table', 1),
(170, '2019_101_07_100000_update_ori_customer_profiles_table2', 1),
(171, '2019_01_07_052322_ori_mast_designations', 2),
(172, '2019_01_07_102446_ori_dept_designation_relation', 2),
(173, '2019_01_08_124416_add_columns_to_ori_users', 2),
(174, '2019_01_10_093853_update_localbody_ori_user_table', 2),
(175, '2019_01_18_122121_update_ori_cmp_contacts_2', 3),
(176, '2019_03_10_111122_update_localbody_ori_helpdesk_table', 3),
(177, '2019_03_10_111133_update_localbody_ori_helpdesk_log_table', 3),
(178, '2018_11_30_000000_update_ori_common_sms_email', 4),
(179, '2019_03_10_111144_update_localbody_ori_lead_followups_table', 4),
(180, '2019_03_10_111155_update_localbody_ori_lead_followups_log_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ori_api_call_logs`
--

CREATE TABLE `ori_api_call_logs` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputs` longtext COLLATE utf8mb4_unicode_ci,
  `headers` longtext COLLATE utf8mb4_unicode_ci,
  `output` longtext COLLATE utf8mb4_unicode_ci,
  `error_msg` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_attachments`
--

CREATE TABLE `ori_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `attachable_id` int(11) NOT NULL,
  `attachable_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_autodial_schedules`
--

CREATE TABLE `ori_autodial_schedules` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime_init` date NOT NULL,
  `datetime_end` date NOT NULL,
  `daytime_init` time NOT NULL,
  `daytime_end` time NOT NULL,
  `retries` int(11) DEFAULT NULL,
  `agent_group_id` int(11) DEFAULT NULL,
  `max_canales` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_autodial_schedules`
--

INSERT INTO `ori_autodial_schedules` (`id`, `cmpny_id`, `name`, `datetime_init`, `datetime_end`, `daytime_init`, `daytime_end`, `retries`, `agent_group_id`, `max_canales`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'auto dial one', '2018-01-01', '2018-12-30', '06:00:00', '08:00:00', NULL, 1, NULL, 1, NULL, NULL, '2018-01-16 18:30:00', '2018-01-31 09:44:12', NULL),
(2, 2, ' two auto dial', '2018-01-01', '2018-01-18', '07:00:00', '18:00:00', NULL, 2, NULL, 1, NULL, NULL, '2018-01-30 18:30:00', '2018-01-31 10:59:29', NULL),
(3, 2, 'dial test three', '2018-01-09', '2018-01-25', '11:00:00', '10:00:00', NULL, 3, NULL, 1, NULL, NULL, '2018-01-30 18:30:00', '2018-01-31 11:07:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_automated_process`
--

CREATE TABLE `ori_automated_process` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `process_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 sms, 2 email, 3 manual call, 4 autodial',
  `department` int(11) DEFAULT NULL,
  `is_first` int(11) DEFAULT NULL,
  `intimation_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(format:- flag-value), flag 1-district, 2-department, 3-designation, 4-taluk',
  `intimation_cc_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(format:- flag-value), flag 1-district, 2-department, 3-designation, 4-taluk',
  `intimation_to_param` int(11) NOT NULL DEFAULT '1' COMMENT '0 - from conditions on intimation_to field in current table, 1 - intimation_to from helpdesk',
  `response_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_neg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_time` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_time` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_time_param` int(11) NOT NULL DEFAULT '1' COMMENT '1 - minutes, 2 - hours, 3 - days',
  `expiry_time_param` int(11) NOT NULL DEFAULT '1' COMMENT '1 - minutes, 2 - hours, 3 - days',
  `expiry_flag` int(11) DEFAULT '0' COMMENT '0 - as per expiry time, 1 - from helpdesk table',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'referred from cc_mail_categories',
  `closed` int(11) DEFAULT '0' COMMENT 'closed stage',
  `parent_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_automated_process`
--

INSERT INTO `ori_automated_process` (`id`, `cmpny_id`, `process_name`, `action`, `department`, `is_first`, `intimation_to`, `intimation_cc_to`, `intimation_to_param`, `response_pos`, `response_neg`, `action_time`, `expiry_time`, `action_time_param`, `expiry_time_param`, `expiry_flag`, `content`, `closed`, `parent_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Civil supplies related intimation on complaint registration', '2', 1, 1, '1-1,2-1,3-1,4-1', '1-1,2-5,3-0,4-1', 1, NULL, '2', '5', '20', 1, 3, 1, '1', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Civil supplies related intimation 2 days before due date', '2', 1, NULL, '1-1,2-1,3-1,4-1', NULL, 0, NULL, '3', '5', '2', 1, 3, 1, '1', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Civil supplies related intimation on due date', '2', 1, NULL, '1-1,2-1,3-1,4-1', '1-1,2-1,3-0,4-1', 0, NULL, '4', '5', '2', 1, 3, 0, '1', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'Civil supplies related intimation after due date', '2', 1, NULL, '1-1,2-1,3-1,4-1', '1-1,2-1,3-0,4-1', 0, NULL, '4', '5', '2', 1, 3, 0, '1', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'Civil supplies related intimation closed', '2', 1, NULL, '1-1,2-1,3-1,4-1', '1-1,2-1,3-0,4-1', 0, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_automated_process_batch`
--

CREATE TABLE `ori_automated_process_batch` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `last_relation_id` int(11) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_automated_process_batch_expiry`
--

CREATE TABLE `ori_automated_process_batch_expiry` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `last_relation_id` int(11) DEFAULT NULL,
  `action_expiry_time` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_automated_process_log`
--

CREATE TABLE `ori_automated_process_log` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `auto_process_id` int(11) DEFAULT NULL,
  `action_created_time` datetime DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `action_expiry_time` datetime DEFAULT NULL,
  `field1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_field` text COLLATE utf8mb4_unicode_ci,
  `security_flag` int(11) DEFAULT NULL,
  `security_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_automated_process_relations`
--

CREATE TABLE `ori_automated_process_relations` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `auto_process_id` int(11) DEFAULT NULL,
  `action_created_time` datetime DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `action_expiry_time` datetime DEFAULT NULL,
  `field1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for mail',
  `field5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for call',
  `mail_field` text COLLATE utf8mb4_unicode_ci COMMENT '	json encoded value for mail parameters replacement',
  `security_flag` int(11) DEFAULT NULL,
  `security_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_automated_process_stages`
--

CREATE TABLE `ori_automated_process_stages` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `stage_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_automated_process_stages`
--

INSERT INTO `ori_automated_process_stages` (`id`, `cmpny_id`, `stage_name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Lead to customer', NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Idle for customer', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_auto_reply`
--

CREATE TABLE `ori_auto_reply` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `auto_reply_category_id` int(10) UNSIGNED NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_auto_reply_category`
--

CREATE TABLE `ori_auto_reply_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_basic_templates`
--

CREATE TABLE `ori_basic_templates` (
  `id` int(11) NOT NULL,
  `template_type` int(11) DEFAULT NULL COMMENT '1 sms, 2 mail',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_basic_templates`
--

INSERT INTO `ori_basic_templates` (`id`, `template_type`, `subject`, `content`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Escalation Intimation Mail', '<p>Dear [[ First Name ]],</p>\r\n<p>Escalation summary report is given below.</p>\r\n<p>[[ table ]]</p>', NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Escalation Intimation SMS', '<p>Dear [[ First Name ]],</p>\r\n<p>Escalation summary report is given below.</p>\r\n<p>[[ table ]]</p>', NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Escalation due date approaching for agent', '<p>Dear [[ First Name ]],</p>\r\n<p>Escalations on following dockets are approaching it\'s due date.</p>\r\n<p>[[ table ]]</p>', NULL, NULL, NULL, NULL, NULL),
(4, 1, 'Escalation due date approaching for agent sms', 'Escalation due date is approching for following dockets [[ table ]] ', NULL, NULL, NULL, NULL, NULL),
(5, 2, 'Escalation due date expired for agent ', '<p>Dear [[ First Name ]],</p>\r\n<p>Escalations on following dockets have been expired.</p>\r\n<p>[[ table ]]</p>', NULL, NULL, NULL, NULL, NULL),
(6, 1, 'Escalation due date expired for agent sms', 'Escalation on dockets [[ table ]] have been expired ', NULL, NULL, NULL, NULL, NULL),
(7, 2, 'Escalation Closed', '<p>Dear [[ First Name ]],</p>\r\n<p>Please see the closed escalation details</p>\r\n<p>[[ table ]]</p>', NULL, NULL, NULL, NULL, NULL),
(8, 2, 'Content Missing For Sales Automation!!!', '<p>Dear Admin,</p>\r\n<p>Mail content is missing for the following auto process [[ Auto_process ]] with stage id [[ Auto_process_id ]]. Please do the necessary as soon as possible.</p>\r\n', NULL, NULL, NULL, NULL, NULL),
(9, 2, 'Auto Mail Response', '<p>Dear <span>[[ First Name ]]</span>,</p>\r\n<p>Your mail has been received. We will contact you back soon.</p>', NULL, NULL, NULL, NULL, NULL),
(10, 2, 'Sales Automation Leads Mail', 'Sales automation leads mail', NULL, NULL, NULL, NULL, NULL),
(11, 1, 'Sales Automation Leads SMS', 'Sales automation leads SMS', NULL, NULL, NULL, NULL, NULL),
(12, 1, 'Sales Automation Leads Manual Call', 'Sales automation leads Manual Call', NULL, NULL, NULL, NULL, NULL),
(13, 1, 'Sales Automation Leads Autodial', 'Sales automation leads Autodial', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_batch_process`
--

CREATE TABLE `ori_batch_process` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `process_type` int(11) NOT NULL DEFAULT '0' COMMENT 'Referred from batch process types section in constants file',
  `searched_criteria` text COLLATE utf8mb4_unicode_ci COMMENT 'Serialized json containing search criteria data',
  `exclude_list` text COLLATE utf8mb4_unicode_ci COMMENT 'Comma separated list of contact ids to be excluded',
  `include_list` text COLLATE utf8mb4_unicode_ci COMMENT 'Comma separated list of contact ids to be included',
  `target_count` int(11) NOT NULL DEFAULT '0',
  `processed_count` int(11) NOT NULL DEFAULT '0',
  `last_processed_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `file_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Processing',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_batch_process`
--

INSERT INTO `ori_batch_process` (`id`, `cmpny_id`, `process_type`, `searched_criteria`, `exclude_list`, `include_list`, `target_count`, `processed_count`, `last_processed_id`, `group_id`, `campaign_id`, `file_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '{\"search_keywords\":null,\"startdate\":null,\"enddate\":null}', '', NULL, 0, 0, 2, 1, NULL, '', 1, 2, 2, '2018-11-20 23:13:53', '2018-11-21 04:44:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_campaigns`
--

CREATE TABLE `ori_campaigns` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_type` int(11) DEFAULT '1' COMMENT '1 - Notificational, 2 - Promotional, 3 - Transactional',
  `goal_stage` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_campaigns`
--

INSERT INTO `ori_campaigns` (`id`, `cmpny_id`, `name`, `campaign_type`, `goal_stage`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Orisys Campaign 1', 2, NULL, 1, 2, 2, '2018-11-20 23:17:57', '2018-11-20 23:17:57', NULL),
(2, 2, 'Orisys Campaign 2', 3, NULL, 1, 2, 2, '2018-11-20 23:19:04', '2018-11-20 23:19:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_campaigns_meta`
--

CREATE TABLE `ori_campaigns_meta` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL COMMENT 'refered from ori_campaigns',
  `source_type` bigint(20) DEFAULT NULL,
  `source_id` bigint(20) NOT NULL,
  `budget` int(11) DEFAULT NULL,
  `field1` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field3` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field1_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field2_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field3_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_campaigns_meta`
--

INSERT INTO `ori_campaigns_meta` (`id`, `cmpny_id`, `campaign_id`, `source_type`, `source_id`, `budget`, `field1`, `field2`, `field3`, `field1_description`, `field2_description`, `field3_description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2018-11-20 23:17:57', '2018-11-20 23:17:57', NULL),
(2, 2, 2, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2018-11-20 23:19:04', '2018-11-20 23:19:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_campaign_batches`
--

CREATE TABLE `ori_campaign_batches` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `campaign_id` int(11) DEFAULT NULL,
  `campaign_type` int(11) DEFAULT NULL COMMENT '1 - Notificational, 2 - Promotional, 3 - Transactional',
  `autodial_schedule_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'batch title',
  `goal_stage` int(11) DEFAULT NULL,
  `enq_priority` int(11) NOT NULL DEFAULT '0',
  `total_target_count` int(11) DEFAULT NULL COMMENT 'total campaign members count',
  `processed_count` int(11) DEFAULT NULL,
  `last_processed_id` int(11) DEFAULT NULL,
  `obc_type` int(11) DEFAULT NULL COMMENT 'referred from cc_query_type',
  `obc_category` int(11) DEFAULT NULL COMMENT 'referred from cc_faq_categories',
  `encoding_type` int(11) DEFAULT NULL,
  `from_period` date DEFAULT NULL,
  `to_period` date DEFAULT NULL,
  `survey_id` bigint(20) DEFAULT NULL,
  `obc_subcategory` int(11) DEFAULT NULL,
  `channel_type` int(11) DEFAULT NULL COMMENT 'Refered from ori_channels',
  `status` int(11) DEFAULT NULL COMMENT '1. Completed, 2. Processing',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_campaign_batch_groups`
--

CREATE TABLE `ori_campaign_batch_groups` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL COMMENT 'Referred from ori_campaign_batches',
  `group_id` int(10) UNSIGNED NOT NULL COMMENT 'Referred from ori_groups',
  `status` int(11) NOT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_campaign_groups`
--

CREATE TABLE `ori_campaign_groups` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL COMMENT 'Referred from ori_campaigns',
  `group_id` int(10) UNSIGNED NOT NULL COMMENT 'Referred from ori_groups',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_campaign_groups`
--

INSERT INTO `ori_campaign_groups` (`id`, `cmpny_id`, `campaign_id`, `group_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 1, 2, 2, '2018-11-20 23:17:57', '2018-11-20 23:17:57', NULL),
(2, 2, 2, 2, 1, 2, 2, '2018-11-20 23:19:04', '2018-11-20 23:19:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_campaign_query_status`
--

CREATE TABLE `ori_campaign_query_status` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `query_type` int(11) DEFAULT NULL,
  `query_status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_channels`
--

CREATE TABLE `ori_channels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_channels`
--

INSERT INTO `ori_channels` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SMS', 1, 1, 1, '2018-10-09 18:30:00', NULL, NULL),
(2, 'Email', 1, 1, 1, '2018-10-09 18:30:00', NULL, NULL),
(3, 'Manual Call', 1, 1, 1, '2018-10-16 18:30:00', NULL, NULL),
(4, 'Auto Dial', 1, 1, 1, '2018-10-16 18:30:00', NULL, NULL),
(5, 'Chat', 1, 1, 1, '2018-10-16 18:30:00', NULL, NULL),
(6, 'Push Messages', 1, 1, 1, '2018-10-16 18:30:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_channel_gateway`
--

CREATE TABLE `ori_channel_gateway` (
  `id` int(11) NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_channel_gateway`
--

INSERT INTO `ori_channel_gateway` (`id`, `channel_id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'PHP', 2, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', '2018-11-26 18:30:00'),
(2, 2, 'Gmail', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(3, 2, 'Mailgun', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(4, 2, 'SendGrid', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(5, 2, 'SMTP', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(6, 1, 'ElitBuzz', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(7, 1, 'ValueFirst', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(8, 2, 'Mailchimp', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL),
(9, 1, 'ESMS', 1, 1, 1, '2018-11-26 18:30:00', '2018-11-26 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_chat_feedback_count`
--

CREATE TABLE `ori_chat_feedback_count` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `agent_id` int(11) NOT NULL,
  `excellent` int(11) DEFAULT NULL,
  `good` int(11) DEFAULT NULL,
  `average` int(11) DEFAULT NULL,
  `bad` int(11) DEFAULT NULL,
  `very_bad` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_chat_thread`
--

CREATE TABLE `ori_chat_thread` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `cust_id` bigint(20) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `lead_source_id` bigint(20) NOT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_chat_thread_logs`
--

CREATE TABLE `ori_chat_thread_logs` (
  `id` bigint(20) NOT NULL,
  `thread_id` bigint(20) NOT NULL COMMENT 'Referred from ori_chat_thread table',
  `cmpny_id` int(11) DEFAULT NULL,
  `chat_from` bigint(20) NOT NULL,
  `chat_to` bigint(20) NOT NULL,
  `chat_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_from_type` int(11) NOT NULL COMMENT '1-Customer, 2-Agent',
  `status` int(11) DEFAULT '1' COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_cmp_contacts`
--

CREATE TABLE `ori_cmp_contacts` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1-Male,2-Female,3-Transgender',
  `dob` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_nature` int(11) DEFAULT NULL,
  `aadhar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pancard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `source` int(11) DEFAULT NULL COMMENT '1- crm, 2- bulk upload',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_cmp_contacts`
--

INSERT INTO `ori_cmp_contacts` (`id`, `cmpny_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `email`, `country_code`, `mobile`, `gender`, `dob`, `address`, `customer_nature`, `aadhar`, `pancard`, `passport`, `country_id`, `state_id`, `district_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `source`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', NULL, '9562540883', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, '2018-11-21 04:44:30', '2018-11-21 04:44:30', NULL),
(2, 2, 2, 'Akhil', NULL, 'M', 'akhil.murukan@orisys.in', NULL, '9633662214', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, '2018-11-21 04:44:30', '2018-11-20 23:16:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_cmp_contacts_meta`
--

CREATE TABLE `ori_cmp_contacts_meta` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `contact_id` bigint(20) NOT NULL COMMENT 'Referred from ori_cmp_contacts',
  `field_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_id` bigint(20) DEFAULT NULL COMMENT 'Referred from profile_field',
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_cmp_reg_payments`
--

CREATE TABLE `ori_cmp_reg_payments` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL COMMENT 'Reffered from ori_cmp_profiles',
  `plan_id` int(11) DEFAULT NULL COMMENT 'Reffered from ori_mast_plans',
  `amount` double(50,2) DEFAULT NULL,
  `discount_off` double(50,2) DEFAULT NULL COMMENT 'percent',
  `coupon_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_discount` double(50,2) DEFAULT NULL,
  `order_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_period` int(11) DEFAULT NULL COMMENT 'monthly',
  `payment_mode` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_cmp_reg_payments`
--

INSERT INTO `ori_cmp_reg_payments` (`id`, `cmpny_id`, `plan_id`, `amount`, `discount_off`, `coupon_code`, `total_discount`, `order_id`, `tracking_id`, `subscription_period`, `payment_mode`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 4, NULL, NULL, NULL, NULL, '635422355', '107482187338', 1, 'Debit Card', 'Success', NULL, NULL, NULL, NULL, NULL),
(3, 2, 4, NULL, NULL, NULL, NULL, '635422355', '107482187338', 1, 'Debit Card', 'Success', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_cmp_reg_payments_log`
--

CREATE TABLE `ori_cmp_reg_payments_log` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL COMMENT 'Reffered from ori_cmp_profiles',
  `plan_id` int(11) DEFAULT NULL COMMENT 'Reffered from ori_mast_plans',
  `amount` double(50,2) DEFAULT NULL,
  `discount_off` double(50,2) DEFAULT NULL COMMENT 'percent',
  `coupon_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_discount` double(50,2) DEFAULT NULL,
  `order_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_period` int(11) DEFAULT NULL COMMENT 'monthly',
  `payment_mode` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_details` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_cmp_reg_payments_log`
--

INSERT INTO `ori_cmp_reg_payments_log` (`id`, `cmpny_id`, `plan_id`, `amount`, `discount_off`, `coupon_code`, `total_discount`, `order_id`, `tracking_id`, `subscription_period`, `payment_mode`, `transaction_details`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, NULL, NULL, NULL, NULL, '635422355', '107482187338', 1, 'Debit Card', NULL, 'Success', NULL, NULL, NULL, NULL, NULL),
(2, 2, 4, NULL, NULL, NULL, NULL, '635422355', '107482187338', 1, 'Debit Card', NULL, 'Success', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_common_sms_email`
--

CREATE TABLE `ori_common_sms_email` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `authentication` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'static key',
  `follow_id` int(11) DEFAULT NULL,
  `customer_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL COMMENT 'referred from cmp_details table',
  `autodial_schedule_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL COMMENT 'referred from cmp_contact_lists table',
  `sms_type` int(11) DEFAULT NULL COMMENT '1-OTP,2-Transaction,3-Promotional,4-Followup,5-New Enquiry from profile,6- Resend email sms from crm',
  `communication_type` int(11) DEFAULT NULL COMMENT '1 - Notificational, 2 - Promotional, 3 - Transactional',
  `encoding_type` int(11) DEFAULT NULL,
  `communication_gateway` int(11) DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_type` int(11) DEFAULT NULL COMMENT '1-sms,2-email',
  `content` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc` text COLLATE utf8mb4_unicode_ci,
  `response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'response',
  `mail_response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_ref_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `random_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `mobile_verified` int(11) NOT NULL DEFAULT '2',
  `email_verified` int(11) NOT NULL DEFAULT '2',
  `batch_id` int(11) DEFAULT NULL,
  `survey_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_survey_details',
  `group_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Referred from ori_groups',
  `auto_process_id` int(11) DEFAULT NULL,
  `auto_process_rel_id` int(11) DEFAULT NULL,
  `current_stage` int(11) DEFAULT NULL,
  `goal_stage` int(11) DEFAULT NULL,
  `goal_stage_date` datetime DEFAULT NULL,
  `campaign_efficiency` int(11) DEFAULT NULL,
  `converted_process_id` int(11) DEFAULT NULL,
  `converted_process_parent_id` int(11) DEFAULT NULL,
  `process` int(11) DEFAULT NULL COMMENT '1- feedback, 2- Survey',
  `status` int(11) NOT NULL COMMENT '1 - sent,2- not sent',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_company_channels`
--

CREATE TABLE `ori_company_channels` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL COMMENT 'Refered from ori_channels',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Processing',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_company_channel_gateway`
--

CREATE TABLE `ori_company_channel_gateway` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_company_meta`
--

CREATE TABLE `ori_company_meta` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `meta_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_company_meta`
--

INSERT INTO `ori_company_meta` (`id`, `cmpny_id`, `meta_name`, `meta_value`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 're_open_status', '4', 1, 2, 2, '2018-11-13 06:36:52', '2019-01-23 23:54:32', NULL),
(2, 2, 'after_re_open', '2', 1, 2, 2, '2018-11-13 06:36:52', '2018-11-13 08:11:59', NULL),
(5, 2, 'chat_agent', '4', 1, 2, 2, '2018-11-13 08:09:51', '2018-11-13 08:09:51', NULL),
(6, 2, 'open_status', '1', 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:36:02', NULL),
(7, 2, 'chat_ticket', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(8, 2, 'agent', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(9, 2, 'set_crm_source', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(10, 2, 'set_crm_automation_source', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(11, 2, 'set_unattended_call_source', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(12, 2, 'sales_automation_lead_stage', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(13, 2, 'auto_stage_activation', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(14, 2, 'sales_automation_failure_mailid', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(15, 2, 'mail_server_host_1', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(16, 2, 'mail_server_username_1', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(17, 2, 'mail_server_password_1', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(18, 2, 'push_key', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(19, 2, 'enquiry_email', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(20, 2, 'enquiry_sms', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(21, 2, 'esc_intimations_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(22, 2, 'esc_intimations_sms', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(23, 2, 'esc_going_to_expire_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(24, 2, 'esc_going_to_expire_sms', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(25, 2, 'esc_expired_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(26, 2, 'lead_src_type_chat', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(27, 2, 'outbound_caller_id', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(28, 2, 'esc_expired_sms', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(29, 2, 'esc_close_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(30, 2, 'content_missing_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(31, 2, 'auto_mail_response', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(32, 2, 'chat_transcript_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(33, 2, 'chat_ticket_open_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(34, 2, 'chat_ticket_closed_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(35, 2, 'feedback_mail', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(36, 2, 'feedback_sms', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(37, 2, 'set_manual_call_query_type', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(38, 2, 'set_abandoned_category', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(39, 2, 'set_after_hour_category', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL),
(40, 2, 'set_holiday_category', NULL, 1, 2, 2, '2019-01-23 03:35:52', '2019-01-23 03:35:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_company_profiles`
--

CREATE TABLE `ori_company_profiles` (
  `id` int(11) NOT NULL,
  `ori_cmp_org_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_pincode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ori_cmp_org_plan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active 2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_company_profiles`
--

INSERT INTO `ori_company_profiles` (`id`, `ori_cmp_org_name`, `ori_cmp_org_email`, `ori_cmp_org_phone`, `ori_cmp_org_address`, `ori_cmp_org_country_code`, `ori_cmp_org_mobile`, `ori_cmp_org_city`, `ori_cmp_org_state`, `ori_cmp_org_pincode`, `ori_cmp_org_country`, `ori_cmp_org_plan`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Oricom', 'admin@oricom.in', '8086800203', 'D3,6th floor,Bhavani Building,Technopark,Trivandrum', NULL, NULL, NULL, NULL, NULL, NULL, 4, '2018-10-07 18:30:00', NULL, NULL, 1),
(2, 'orisys', 'admin@orisys.in', '9963528741', 'Trivandrum', NULL, NULL, NULL, NULL, NULL, NULL, 4, '2018-10-07 18:30:00', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ori_company_subscriptions`
--

CREATE TABLE `ori_company_subscriptions` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL COMMENT 'Reffered from ori_cmp_profiles',
  `plan_id` int(11) DEFAULT NULL COMMENT 'Reffered from ori_mast_plans',
  `transaction_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(50,2) DEFAULT NULL,
  `discount_amount` double(50,2) DEFAULT NULL,
  `subscription_start_date` datetime DEFAULT NULL,
  `subscription_exp_date` datetime DEFAULT NULL,
  `extended_expiry_date` datetime DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_company_subscriptions`
--

INSERT INTO `ori_company_subscriptions` (`id`, `cmpny_id`, `plan_id`, `transaction_id`, `amount`, `discount_amount`, `subscription_start_date`, `subscription_exp_date`, `extended_expiry_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 2, 4, '700000691', NULL, NULL, '2018-12-03 12:04:52', '2019-06-03 12:04:52', '2018-12-03 12:04:52', 'Subscribed', NULL, NULL, NULL, NULL, NULL),
(7, 1, 4, '700000691', NULL, NULL, '2018-12-03 12:04:52', '2019-01-03 12:04:52', '2018-12-03 12:04:52', 'Subscribed', NULL, NULL, NULL, NULL, NULL),
(9, 1, 4, '700000691', NULL, NULL, '2018-12-03 12:04:52', '2019-01-03 12:04:52', '2018-12-10 12:04:52', 'Subscribed', NULL, NULL, NULL, NULL, NULL),
(10, 1, 4, '700000691', NULL, NULL, '2018-12-03 12:04:52', '2019-01-03 12:04:52', '2019-01-06 12:04:52', 'Subscribed', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_countries`
--

CREATE TABLE `ori_countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active 2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_countries`
--

INSERT INTO `ori_countries` (`id`, `country_name`, `created_at`, `status`) VALUES
(1, 'India', '2017-07-20 00:00:00', 1),
(2, 'UAE', '2017-07-20 00:00:00', 1),
(3, 'Saudi Arabia', '2017-07-20 00:00:00', 1),
(4, 'Oman', '2017-07-20 00:00:00', 1),
(5, 'Qatar', '2017-07-20 00:00:00', 1),
(6, 'Kuwait', '2017-07-20 00:00:00', 1),
(7, 'Bahrain', '2017-07-20 00:00:00', 1),
(8, 'Iran', '2017-07-20 00:00:00', 1),
(9, 'Iraq', '2017-07-20 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ori_country_ph_code`
--

CREATE TABLE `ori_country_ph_code` (
  `ph_id` int(11) NOT NULL,
  `iso` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nicename` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_cron_logs`
--

CREATE TABLE `ori_cron_logs` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `api` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_msg` text COLLATE utf8mb4_unicode_ci,
  `call_start_time` datetime DEFAULT NULL,
  `call_end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_customer_fcms`
--

CREATE TABLE `ori_customer_fcms` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) NOT NULL COMMENT 'Referred from ori_customer_profile',
  `fcmRegId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imeiNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_customer_profiles`
--

CREATE TABLE `ori_customer_profiles` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1-Male,2-Female,3-Transgender',
  `dob` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_nature` int(11) DEFAULT NULL,
  `source` int(11) DEFAULT NULL COMMENT '1- crm, 2- bulk upload',
  `profile_status` int(11) DEFAULT NULL COMMENT '1- lead, 2- customer',
  `aadhar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pancard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_customer_profiles`
--

INSERT INTO `ori_customer_profiles` (`id`, `cmpny_id`, `first_name`, `middle_name`, `last_name`, `email`, `country_code`, `mobile`, `gender`, `dob`, `address`, `customer_nature`, `source`, `profile_status`, `aadhar`, `pancard`, `passport`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 2, '2018-10-15 00:17:06', '2019-01-19 01:15:17', NULL),
(2, 2, 'Akhil', NULL, 'M', 'akhil.murukan@orisys.in', '+91', '9633662214', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2018-10-15 00:18:52', '2018-10-15 00:18:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_customer_profile_fields`
--

CREATE TABLE `ori_customer_profile_fields` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `field_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1- Default profile fields, 2- Custom  fields',
  `required` int(11) DEFAULT NULL COMMENT '1- Reuired,  2 - Not required',
  `label` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_field` int(11) DEFAULT NULL COMMENT '1- yes, 2- No',
  `is_unique` int(11) DEFAULT NULL COMMENT '1- Unique field, 2- Not unique',
  `field_type` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_default_profile_fields',
  `tab_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_customer_profile_fields`
--

INSERT INTO `ori_customer_profile_fields` (`id`, `cmpny_id`, `field_name`, `type`, `required`, `label`, `report_field`, `is_unique`, `field_type`, `field_id`, `tab_id`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'first_name', 1, 1, 'First Name', 1, NULL, NULL, 1, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-11-14 07:12:37', NULL),
(2, 2, 'email', 1, NULL, 'Email', 1, 1, 4, 3, 1, 1, 1, 1, 1, '2018-09-28 18:30:00', '2018-11-14 07:12:51', NULL),
(3, 2, 'mobile', 1, 1, 'Mobile', 1, 1, 3, 4, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-09-28 23:31:11', NULL),
(4, 2, 'aadhar', 1, 1, 'Aadhar', 1, 2, 13, 12, 1, NULL, 2, 1, 1, '2018-09-28 18:30:00', '2019-01-24 00:16:44', NULL),
(5, 2, 'pancard', 1, 2, 'Pan Card', 1, 2, 14, 13, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-09-28 23:31:11', NULL),
(7, 2, 'last_name', 1, 1, 'Last Name', 1, 2, NULL, 2, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-09-28 23:31:11', NULL),
(8, 2, 'dob', 1, NULL, 'DOB', NULL, NULL, NULL, 5, 1, 1, 2, 1, 1, '2018-09-28 18:30:00', '2018-11-14 07:53:24', NULL),
(9, 2, 'address', 1, 2, 'Address', 2, 2, NULL, 6, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-11-14 07:50:40', NULL),
(10, 2, 'profile_status', 1, 2, 'Profile Status', 2, 2, NULL, NULL, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-11-14 07:50:40', NULL),
(11, 2, 'source', 1, 2, 'Lead Source', 2, 2, NULL, NULL, 1, NULL, 1, 1, 1, '2018-09-28 18:30:00', '2018-11-14 07:50:40', NULL),
(12, 2, 'country_id', 1, NULL, 'Country', NULL, NULL, NULL, 8, 1, 3, 1, 2, 2, '2019-01-18 06:37:41', '2019-01-18 06:37:41', NULL),
(13, 2, 'state_id', 1, NULL, 'State', NULL, NULL, NULL, 9, 1, 3, 1, 2, 2, '2019-01-18 06:37:55', '2019-01-18 06:37:55', NULL),
(14, 2, 'district_id', 1, NULL, 'District', NULL, NULL, NULL, 10, 1, 3, 1, 2, 2, '2019-01-18 06:38:04', '2019-01-18 06:38:04', NULL),
(15, 2, 'local_body_type', 1, NULL, 'Local Body Type', NULL, NULL, NULL, 11, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(16, 2, 'muncipality_id', 3, NULL, 'Muncipality', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(17, 2, 'corporation_id', 3, NULL, 'Corporation', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(18, 2, 'panchayath_type', 3, NULL, 'Panchayath Type', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(19, 2, 'district_panchayath_id', 3, NULL, 'District Panchayath', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(20, 2, 'block_panchayath_id', 3, NULL, 'Block Panchayath', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(21, 2, 'grama_panchayath_id', 3, NULL, 'Grama Panchayath', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(22, 2, 'panchayath_id', 3, NULL, 'Panchayath', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-18 06:38:10', '2019-01-29 04:30:19', NULL),
(23, 2, 'taluk_id', 3, NULL, 'Taluk', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-21 01:56:37', '2019-01-29 04:30:19', NULL),
(24, 2, 'village_id', 3, NULL, 'Village', NULL, NULL, NULL, NULL, 1, 3, 2, 2, 2, '2019-01-21 01:56:37', '2019-01-29 04:30:19', NULL),
(25, 2, 'mobileww', 2, NULL, 'Mobileww', NULL, NULL, NULL, NULL, 2, 1, 1, 2, 2, '2019-01-23 03:44:10', '2019-01-23 03:44:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_customer_profile_log`
--

CREATE TABLE `ori_customer_profile_log` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `cmpny_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1-Male,2-Female,3-Transgender',
  `dob` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_nature` int(11) DEFAULT NULL,
  `source` int(11) DEFAULT NULL COMMENT '1- crm, 2- bulk upload',
  `profile_status` int(11) DEFAULT NULL COMMENT '1- lead, 2- customer',
  `aadhar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pancard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_customer_profile_log`
--

INSERT INTO `ori_customer_profile_log` (`id`, `user_id`, `cmpny_id`, `first_name`, `middle_name`, `last_name`, `email`, `country_code`, `mobile`, `gender`, `dob`, `address`, `customer_nature`, `source`, `profile_status`, `aadhar`, `pancard`, `passport`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-19 01:15:17', '2019-01-19 01:15:17', NULL),
(2, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-19 01:16:02', '2019-01-19 01:16:02', NULL),
(3, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-19 01:17:12', '2019-01-19 01:17:12', NULL),
(4, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-21 00:37:22', '2019-01-21 00:37:22', NULL),
(5, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-21 00:37:34', '2019-01-21 00:37:34', NULL),
(6, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-21 00:41:18', '2019-01-21 00:41:18', NULL),
(7, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-21 02:24:39', '2019-01-21 02:24:39', NULL),
(8, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, '232323232323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-21 03:35:09', '2019-01-21 03:35:09', NULL),
(9, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-29 04:32:39', '2019-01-29 04:32:39', NULL),
(10, 1, 2, 'Reshma', NULL, 'R', 'reshma.rajan@orisys.in', '+91', '9562540883', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2019-01-29 04:32:51', '2019-01-29 04:32:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_customer_profile_meta`
--

CREATE TABLE `ori_customer_profile_meta` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `field_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_id` bigint(20) DEFAULT NULL COMMENT 'Referred from profile_field',
  `relation_id` int(11) DEFAULT NULL,
  `tab_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_customer_profile_meta`
--

INSERT INTO `ori_customer_profile_meta` (`id`, `cmpny_id`, `user_id`, `field_name`, `value`, `field_id`, `relation_id`, `tab_id`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'mobileww', '', 25, NULL, 2, NULL, 1, 2, 2, '2019-01-29 04:32:39', '2019-01-29 04:32:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_customer_profile_meta_log`
--

CREATE TABLE `ori_customer_profile_meta_log` (
  `id` bigint(20) NOT NULL,
  `profile_meta_id` bigint(20) DEFAULT NULL COMMENT 'Refered from ori_customer_profile_meta',
  `cmpny_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `field_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_id` bigint(20) DEFAULT NULL COMMENT 'Referred from profile_field',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_default_profile_fields`
--

CREATE TABLE `ori_default_profile_fields` (
  `id` int(11) NOT NULL,
  `field_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_label` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_default_profile_fields`
--

INSERT INTO `ori_default_profile_fields` (`id`, `field_name`, `field_label`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'first_name', 'First Name', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'last_name', 'Last Name', 2, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'email', 'Email', 2, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'mobile', 'Mobile', 2, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'dob', 'DOB', 3, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'address', 'Address', 4, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'middle_name', 'Middle Name', 1, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'country_id', 'Country', 3, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'state_id', 'State', 3, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'district_id', 'District', 3, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'local_body_type', 'Local Body Type', 3, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'aadhar', 'Aadhar', 3, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'pancard', 'Pancard', 3, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'passport', 'Passport', 3, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_district`
--

CREATE TABLE `ori_district` (
  `country_code` int(11) NOT NULL,
  `state_code` int(11) NOT NULL DEFAULT '0',
  `district_code` int(11) NOT NULL DEFAULT '0',
  `district_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dist_abbr` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_emailfetch_company`
--

CREATE TABLE `ori_emailfetch_company` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `meta_name` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_email_fetchs`
--

CREATE TABLE `ori_email_fetchs` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `email_id` bigint(20) DEFAULT NULL COMMENT '0 - outgoing mails',
  `thread_id` bigint(20) NOT NULL,
  `from` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `message` text COLLATE utf8mb4_unicode_ci,
  `received_date` datetime DEFAULT NULL,
  `submit_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 - Complaint submitted  0 complaint not submitted',
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '1 - Read, 0 - Unread',
  `answered` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 - Answered',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_email_fetchs`
--

INSERT INTO `ori_email_fetchs` (`id`, `cmpny_id`, `email_id`, `thread_id`, `from`, `from_name`, `subject`, `message`, `received_date`, `submit_status`, `read_status`, `answered`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 'rejeesh.nair@orisys.in', 'Rejeesh Nair <rejeesh.nair@orisys.in>', 'Test Sub2', '4oCLZ2ZkZyBmZGcgZGZnZmQgZGZn4oCLDQo', '2017-08-07 03:23:26', 0, 0, NULL, NULL, NULL, '2017-08-09 04:42:25', '2018-10-15 05:44:42', NULL),
(2, 2, 2, 2, 'rejeesh.nair@orisys.in', 'Rejeesh Nair <rejeesh.nair@orisys.in>', 'Test SUb3', 'Content3', '2017-08-07 03:25:38', 0, 0, NULL, NULL, NULL, '2017-08-09 04:42:26', '2018-10-15 05:44:42', NULL),
(3, 2, 3, 3, 'rejeesh.nair@orisys.in', 'Rejeesh Nair <rejeesh.nair@orisys.in>', 'Sub4', '4oCLVGVzdCBjb250ZW504oCLDQo', '2017-08-07 03:54:22', 0, 0, NULL, NULL, NULL, '2017-08-09 04:42:27', '2018-10-15 05:44:42', NULL),
(4, 2, 4, 4, 'rejeesh.nair@orisys.in', 'Rejeesh Nair <rejeesh.nair@orisys.in>', 'Sub5', 'Content5', '2017-08-07 06:42:25', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:27', '2018-10-15 01:23:25', NULL),
(5, 2, 5, 5, 'akhil.murukan@orisys.in', 'Akhil Murukan <akhil.murukan@orisys.in>', 'test email from akhil', 'hai\r\n\nOn Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>\r\nwrote:\r\n\n> Hi, Orisys\r\n> please find the attached document\r\n>\r\n> --\r\n> Regards,\r\n> *AKHIL MURUKAN*\r\n> Software Engineer\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>\r\n\n\n-- \r\nRegards,\r\n*AKHIL MURUKAN*\r\nSoftware Engineer\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-07 09:12:36', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:28', '2018-10-15 01:19:41', NULL),
(6, 2, 6, 5, 'akhil.murukan@orisys.in', 'Akhil Murukan <akhil.murukan@orisys.in>', 'test email from akhil', 'haiiiiiiiiiii\r\n\nOn Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\nwrote:\r\n\n> hai\r\n>\r\n> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>\r\n> wrote:\r\n>\r\n>> Hi, Orisys\r\n>> please find the attached document\r\n>>\r\n>> --\r\n>> Regards,\r\n>> *AKHIL MURUKAN*\r\n>> Software Engineer\r\n>>\r\n>>\r\n>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>> ​\r\n>> \"Driven by People, Technology & Values\"\r\n>> ​\r\n>>\r\n>> ​​\r\n>> Floor (-\r\n>> ​2​\r\n>> ), Thejaswini, Technopark\r\n>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>\r\n>>\r\n>> ​   Office ​\r\n>> : +91\r\n>> ​​04714015757\r\n>> ​   Web\r\n>> :\r\n>> ​​\r\n>> ​\r\n>> www.orisys.in​\r\n>>\r\n>> ​   Blog  :​\r\n>> ​www.orisys.in/blog\r\n>>\r\n>>\r\n>> Disclaimer : This email and any files transmitted with it are\r\n>> confidential and intended solely for the use of the individual or entity to\r\n>> whom they are addressed. If you have received this email in error please\r\n>> notify us. This message contains confidential information and is intended\r\n>> only for the individual named. If you are not the named addressee you\r\n>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>> and delete this e-mail from your system. If you are not the intended\r\n>> recipient you are notified that disclosing, copying, distributing or taking\r\n>> any action in reliance on the contents of this information is strictly\r\n>> prohibited.\r\n>>\r\n>>\r\n>\r\n>\r\n> --\r\n> Regards,\r\n> *AKHIL MURUKAN*\r\n> Software Engineer\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>\r\n\n\n-- \r\nRegards,\r\n*AKHIL MURUKAN*\r\nSoftware Engineer\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-08 06:36:46', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:30', '2018-10-15 01:19:41', NULL),
(7, 2, 7, 5, 'akhil.murukan@orisys.in', 'Akhil Murukan <akhil.murukan@orisys.in>', 'test email from akhil', 'fgfgsdgds\r\n\nOn Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\nwrote:\r\n\n> haiiiiiiiiiii\r\n>\r\n> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n> wrote:\r\n>\r\n>> hai\r\n>>\r\n>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>> wrote:\r\n>>\r\n>>> Hi, Orisys\r\n>>> please find the attached document\r\n>>>\r\n>>> --\r\n>>> Regards,\r\n>>> *AKHIL MURUKAN*\r\n>>> Software Engineer\r\n>>>\r\n>>>\r\n>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>> ​\r\n>>> \"Driven by People, Technology & Values\"\r\n>>> ​\r\n>>>\r\n>>> ​​\r\n>>> Floor (-\r\n>>> ​2​\r\n>>> ), Thejaswini, Technopark\r\n>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>\r\n>>>\r\n>>> ​   Office ​\r\n>>> : +91\r\n>>> ​​04714015757\r\n>>> ​   Web\r\n>>> :\r\n>>> ​​\r\n>>> ​\r\n>>> www.orisys.in​\r\n>>>\r\n>>> ​   Blog  :​\r\n>>> ​www.orisys.in/blog\r\n>>>\r\n>>>\r\n>>> Disclaimer : This email and any files transmitted with it are\r\n>>> confidential and intended solely for the use of the individual or entity to\r\n>>> whom they are addressed. If you have received this email in error please\r\n>>> notify us. This message contains confidential information and is intended\r\n>>> only for the individual named. If you are not the named addressee you\r\n>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>> and delete this e-mail from your system. If you are not the intended\r\n>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>> any action in reliance on the contents of this information is strictly\r\n>>> prohibited.\r\n>>>\r\n>>>\r\n>>\r\n>>\r\n>> --\r\n>> Regards,\r\n>> *AKHIL MURUKAN*\r\n>> Software Engineer\r\n>>\r\n>>\r\n>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>> ​\r\n>> \"Driven by People, Technology & Values\"\r\n>> ​\r\n>>\r\n>> ​​\r\n>> Floor (-\r\n>> ​2​\r\n>> ), Thejaswini, Technopark\r\n>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>\r\n>>\r\n>> ​   Office ​\r\n>> : +91\r\n>> ​​04714015757\r\n>> ​   Web\r\n>> :\r\n>> ​​\r\n>> ​\r\n>> www.orisys.in​\r\n>>\r\n>> ​   Blog  :​\r\n>> ​www.orisys.in/blog\r\n>>\r\n>>\r\n>> Disclaimer : This email and any files transmitted with it are\r\n>> confidential and intended solely for the use of the individual or entity to\r\n>> whom they are addressed. If you have received this email in error please\r\n>> notify us. This message contains confidential information and is intended\r\n>> only for the individual named. If you are not the named addressee you\r\n>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>> and delete this e-mail from your system. If you are not the intended\r\n>> recipient you are notified that disclosing, copying, distributing or taking\r\n>> any action in reliance on the contents of this information is strictly\r\n>> prohibited.\r\n>>\r\n>>\r\n>\r\n>\r\n> --\r\n> Regards,\r\n> *AKHIL MURUKAN*\r\n> Software Engineer\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>\r\n\n\n-- \r\nRegards,\r\n*AKHIL MURUKAN*\r\nSoftware Engineer\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-08 07:35:07', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:32', '2018-10-15 01:19:41', NULL),
(8, 2, 8, 5, 'akhil.murukan@orisys.in', 'Akhil Murukan <akhil.murukan@orisys.in>', 'test email from akhil', 'hai,\r\n\nOn Tue, Aug 8, 2017 at 1:05 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\nwrote:\r\n\n> fgfgsdgds\r\n>\r\n> On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n> wrote:\r\n>\r\n>> haiiiiiiiiiii\r\n>>\r\n>> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>> wrote:\r\n>>\r\n>>> hai\r\n>>>\r\n>>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>>> wrote:\r\n>>>\r\n>>>> Hi, Orisys\r\n>>>> please find the attached document\r\n>>>>\r\n>>>> --\r\n>>>> Regards,\r\n>>>> *AKHIL MURUKAN*\r\n>>>> Software Engineer\r\n>>>>\r\n>>>>\r\n>>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>>> ​\r\n>>>> \"Driven by People, Technology & Values\"\r\n>>>> ​\r\n>>>>\r\n>>>> ​​\r\n>>>> Floor (-\r\n>>>> ​2​\r\n>>>> ), Thejaswini, Technopark\r\n>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>>\r\n>>>>\r\n>>>> ​   Office ​\r\n>>>> : +91\r\n>>>> ​​04714015757\r\n>>>> ​   Web\r\n>>>> :\r\n>>>> ​​\r\n>>>> ​\r\n>>>> www.orisys.in​\r\n>>>>\r\n>>>> ​   Blog  :​\r\n>>>> ​www.orisys.in/blog\r\n>>>>\r\n>>>>\r\n>>>> Disclaimer : This email and any files transmitted with it are\r\n>>>> confidential and intended solely for the use of the individual or entity to\r\n>>>> whom they are addressed. If you have received this email in error please\r\n>>>> notify us. This message contains confidential information and is intended\r\n>>>> only for the individual named. If you are not the named addressee you\r\n>>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>>> and delete this e-mail from your system. If you are not the intended\r\n>>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>>> any action in reliance on the contents of this information is strictly\r\n>>>> prohibited.\r\n>>>>\r\n>>>>\r\n>>>\r\n>>>\r\n>>> --\r\n>>> Regards,\r\n>>> *AKHIL MURUKAN*\r\n>>> Software Engineer\r\n>>>\r\n>>>\r\n>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>> ​\r\n>>> \"Driven by People, Technology & Values\"\r\n>>> ​\r\n>>>\r\n>>> ​​\r\n>>> Floor (-\r\n>>> ​2​\r\n>>> ), Thejaswini, Technopark\r\n>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>\r\n>>>\r\n>>> ​   Office ​\r\n>>> : +91\r\n>>> ​​04714015757\r\n>>> ​   Web\r\n>>> :\r\n>>> ​​\r\n>>> ​\r\n>>> www.orisys.in​\r\n>>>\r\n>>> ​   Blog  :​\r\n>>> ​www.orisys.in/blog\r\n>>>\r\n>>>\r\n>>> Disclaimer : This email and any files transmitted with it are\r\n>>> confidential and intended solely for the use of the individual or entity to\r\n>>> whom they are addressed. If you have received this email in error please\r\n>>> notify us. This message contains confidential information and is intended\r\n>>> only for the individual named. If you are not the named addressee you\r\n>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>> and delete this e-mail from your system. If you are not the intended\r\n>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>> any action in reliance on the contents of this information is strictly\r\n>>> prohibited.\r\n>>>\r\n>>>\r\n>>\r\n>>\r\n>> --\r\n>> Regards,\r\n>> *AKHIL MURUKAN*\r\n>> Software Engineer\r\n>>\r\n>>\r\n>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>> ​\r\n>> \"Driven by People, Technology & Values\"\r\n>> ​\r\n>>\r\n>> ​​\r\n>> Floor (-\r\n>> ​2​\r\n>> ), Thejaswini, Technopark\r\n>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>\r\n>>\r\n>> ​   Office ​\r\n>> : +91\r\n>> ​​04714015757\r\n>> ​   Web\r\n>> :\r\n>> ​​\r\n>> ​\r\n>> www.orisys.in​\r\n>>\r\n>> ​   Blog  :​\r\n>> ​www.orisys.in/blog\r\n>>\r\n>>\r\n>> Disclaimer : This email and any files transmitted with it are\r\n>> confidential and intended solely for the use of the individual or entity to\r\n>> whom they are addressed. If you have received this email in error please\r\n>> notify us. This message contains confidential information and is intended\r\n>> only for the individual named. If you are not the named addressee you\r\n>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>> and delete this e-mail from your system. If you are not the intended\r\n>> recipient you are notified that disclosing, copying, distributing or taking\r\n>> any action in reliance on the contents of this information is strictly\r\n>> prohibited.\r\n>>\r\n>>\r\n>\r\n>\r\n> --\r\n> Regards,\r\n> *AKHIL MURUKAN*\r\n> Software Engineer\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>\r\n\n\n-- \r\nRegards,\r\n*AKHIL MURUKAN*\r\nSoftware Engineer\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-08 08:54:21', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:33', '2018-10-15 01:19:41', NULL),
(9, 2, 9, 5, 'akhil.murukan@orisys.in', 'Akhil Murukan <akhil.murukan@orisys.in>', 'test email from akhil', 'hiiii\r\n\nOn Tue, Aug 8, 2017 at 2:24 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\nwrote:\r\n\n> hai,\r\n>\r\n> On Tue, Aug 8, 2017 at 1:05 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n> wrote:\r\n>\r\n>> fgfgsdgds\r\n>>\r\n>> On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>> wrote:\r\n>>\r\n>>> haiiiiiiiiiii\r\n>>>\r\n>>> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>>> wrote:\r\n>>>\r\n>>>> hai\r\n>>>>\r\n>>>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>>>> wrote:\r\n>>>>\r\n>>>>> Hi, Orisys\r\n>>>>> please find the attached document\r\n>>>>>\r\n>>>>> --\r\n>>>>> Regards,\r\n>>>>> *AKHIL MURUKAN*\r\n>>>>> Software Engineer\r\n>>>>>\r\n>>>>>\r\n>>>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>>>> ​\r\n>>>>> \"Driven by People, Technology & Values\"\r\n>>>>> ​\r\n>>>>>\r\n>>>>> ​​\r\n>>>>> Floor (-\r\n>>>>> ​2​\r\n>>>>> ), Thejaswini, Technopark\r\n>>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>>>\r\n>>>>>\r\n>>>>> ​   Office ​\r\n>>>>> : +91\r\n>>>>> ​​04714015757\r\n>>>>> ​   Web\r\n>>>>> :\r\n>>>>> ​​\r\n>>>>> ​\r\n>>>>> www.orisys.in​\r\n>>>>>\r\n>>>>> ​   Blog  :​\r\n>>>>> ​www.orisys.in/blog\r\n>>>>>\r\n>>>>>\r\n>>>>> Disclaimer : This email and any files transmitted with it are\r\n>>>>> confidential and intended solely for the use of the individual or entity to\r\n>>>>> whom they are addressed. If you have received this email in error please\r\n>>>>> notify us. This message contains confidential information and is intended\r\n>>>>> only for the individual named. If you are not the named addressee you\r\n>>>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>>>> and delete this e-mail from your system. If you are not the intended\r\n>>>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>>>> any action in reliance on the contents of this information is strictly\r\n>>>>> prohibited.\r\n>>>>>\r\n>>>>>\r\n>>>>\r\n>>>>\r\n>>>> --\r\n>>>> Regards,\r\n>>>> *AKHIL MURUKAN*\r\n>>>> Software Engineer\r\n>>>>\r\n>>>>\r\n>>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>>> ​\r\n>>>> \"Driven by People, Technology & Values\"\r\n>>>> ​\r\n>>>>\r\n>>>> ​​\r\n>>>> Floor (-\r\n>>>> ​2​\r\n>>>> ), Thejaswini, Technopark\r\n>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>>\r\n>>>>\r\n>>>> ​   Office ​\r\n>>>> : +91\r\n>>>> ​​04714015757\r\n>>>> ​   Web\r\n>>>> :\r\n>>>> ​​\r\n>>>> ​\r\n>>>> www.orisys.in​\r\n>>>>\r\n>>>> ​   Blog  :​\r\n>>>> ​www.orisys.in/blog\r\n>>>>\r\n>>>>\r\n>>>> Disclaimer : This email and any files transmitted with it are\r\n>>>> confidential and intended solely for the use of the individual or entity to\r\n>>>> whom they are addressed. If you have received this email in error please\r\n>>>> notify us. This message contains confidential information and is intended\r\n>>>> only for the individual named. If you are not the named addressee you\r\n>>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>>> and delete this e-mail from your system. If you are not the intended\r\n>>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>>> any action in reliance on the contents of this information is strictly\r\n>>>> prohibited.\r\n>>>>\r\n>>>>\r\n>>>\r\n>>>\r\n>>> --\r\n>>> Regards,\r\n>>> *AKHIL MURUKAN*\r\n>>> Software Engineer\r\n>>>\r\n>>>\r\n>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>> ​\r\n>>> \"Driven by People, Technology & Values\"\r\n>>> ​\r\n>>>\r\n>>> ​​\r\n>>> Floor (-\r\n>>> ​2​\r\n>>> ), Thejaswini, Technopark\r\n>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>\r\n>>>\r\n>>> ​   Office ​\r\n>>> : +91\r\n>>> ​​04714015757\r\n>>> ​   Web\r\n>>> :\r\n>>> ​​\r\n>>> ​\r\n>>> www.orisys.in​\r\n>>>\r\n>>> ​   Blog  :​\r\n>>> ​www.orisys.in/blog\r\n>>>\r\n>>>\r\n>>> Disclaimer : This email and any files transmitted with it are\r\n>>> confidential and intended solely for the use of the individual or entity to\r\n>>> whom they are addressed. If you have received this email in error please\r\n>>> notify us. This message contains confidential information and is intended\r\n>>> only for the individual named. If you are not the named addressee you\r\n>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>> and delete this e-mail from your system. If you are not the intended\r\n>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>> any action in reliance on the contents of this information is strictly\r\n>>> prohibited.\r\n>>>\r\n>>>\r\n>>\r\n>>\r\n>> --\r\n>> Regards,\r\n>> *AKHIL MURUKAN*\r\n>> Software Engineer\r\n>>\r\n>>\r\n>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>> ​\r\n>> \"Driven by People, Technology & Values\"\r\n>> ​\r\n>>\r\n>> ​​\r\n>> Floor (-\r\n>> ​2​\r\n>> ), Thejaswini, Technopark\r\n>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>\r\n>>\r\n>> ​   Office ​\r\n>> : +91\r\n>> ​​04714015757\r\n>> ​   Web\r\n>> :\r\n>> ​​\r\n>> ​\r\n>> www.orisys.in​\r\n>>\r\n>> ​   Blog  :​\r\n>> ​www.orisys.in/blog\r\n>>\r\n>>\r\n>> Disclaimer : This email and any files transmitted with it are\r\n>> confidential and intended solely for the use of the individual or entity to\r\n>> whom they are addressed. If you have received this email in error please\r\n>> notify us. This message contains confidential information and is intended\r\n>> only for the individual named. If you are not the named addressee you\r\n>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>> and delete this e-mail from your system. If you are not the intended\r\n>> recipient you are notified that disclosing, copying, distributing or taking\r\n>> any action in reliance on the contents of this information is strictly\r\n>> prohibited.\r\n>>\r\n>>\r\n>\r\n>\r\n> --\r\n> Regards,\r\n> *AKHIL MURUKAN*\r\n> Software Engineer\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>\r\n\n\n-- \r\nRegards,\r\n*AKHIL MURUKAN*\r\nSoftware Engineer\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-08 08:58:08', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:34', '2018-10-15 01:19:41', NULL),
(10, 2, 10, 5, 'akhil.murukan@orisys.in', 'Akhil Murukan <akhil.murukan@orisys.in>', 'test email from akhil', 'chumma\r\n\nOn Tue, Aug 8, 2017 at 2:28 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\nwrote:\r\n\n> hiiii\r\n>\r\n> On Tue, Aug 8, 2017 at 2:24 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n> wrote:\r\n>\r\n>> hai,\r\n>>\r\n>> On Tue, Aug 8, 2017 at 1:05 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>> wrote:\r\n>>\r\n>>> fgfgsdgds\r\n>>>\r\n>>> On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>>> wrote:\r\n>>>\r\n>>>> haiiiiiiiiiii\r\n>>>>\r\n>>>> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>\r\n>>>> wrote:\r\n>>>>\r\n>>>>> hai\r\n>>>>>\r\n>>>>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in\r\n>>>>> > wrote:\r\n>>>>>\r\n>>>>>> Hi, Orisys\r\n>>>>>> please find the attached document\r\n>>>>>>\r\n>>>>>> --\r\n>>>>>> Regards,\r\n>>>>>> *AKHIL MURUKAN*\r\n>>>>>> Software Engineer\r\n>>>>>>\r\n>>>>>>\r\n>>>>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>>>>> ​\r\n>>>>>> \"Driven by People, Technology & Values\"\r\n>>>>>> ​\r\n>>>>>>\r\n>>>>>> ​​\r\n>>>>>> Floor (-\r\n>>>>>> ​2​\r\n>>>>>> ), Thejaswini, Technopark\r\n>>>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>>>>\r\n>>>>>>\r\n>>>>>> ​   Office ​\r\n>>>>>> : +91\r\n>>>>>> ​​04714015757\r\n>>>>>> ​   Web\r\n>>>>>> :\r\n>>>>>> ​​\r\n>>>>>> ​\r\n>>>>>> www.orisys.in​\r\n>>>>>>\r\n>>>>>> ​   Blog  :​\r\n>>>>>> ​www.orisys.in/blog\r\n>>>>>>\r\n>>>>>>\r\n>>>>>> Disclaimer : This email and any files transmitted with it are\r\n>>>>>> confidential and intended solely for the use of the individual or entity to\r\n>>>>>> whom they are addressed. If you have received this email in error please\r\n>>>>>> notify us. This message contains confidential information and is intended\r\n>>>>>> only for the individual named. If you are not the named addressee you\r\n>>>>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>>>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>>>>> and delete this e-mail from your system. If you are not the intended\r\n>>>>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>>>>> any action in reliance on the contents of this information is strictly\r\n>>>>>> prohibited.\r\n>>>>>>\r\n>>>>>>\r\n>>>>>\r\n>>>>>\r\n>>>>> --\r\n>>>>> Regards,\r\n>>>>> *AKHIL MURUKAN*\r\n>>>>> Software Engineer\r\n>>>>>\r\n>>>>>\r\n>>>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>>>> ​\r\n>>>>> \"Driven by People, Technology & Values\"\r\n>>>>> ​\r\n>>>>>\r\n>>>>> ​​\r\n>>>>> Floor (-\r\n>>>>> ​2​\r\n>>>>> ), Thejaswini, Technopark\r\n>>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>>>\r\n>>>>>\r\n>>>>> ​   Office ​\r\n>>>>> : +91\r\n>>>>> ​​04714015757\r\n>>>>> ​   Web\r\n>>>>> :\r\n>>>>> ​​\r\n>>>>> ​\r\n>>>>> www.orisys.in​\r\n>>>>>\r\n>>>>> ​   Blog  :​\r\n>>>>> ​www.orisys.in/blog\r\n>>>>>\r\n>>>>>\r\n>>>>> Disclaimer : This email and any files transmitted with it are\r\n>>>>> confidential and intended solely for the use of the individual or entity to\r\n>>>>> whom they are addressed. If you have received this email in error please\r\n>>>>> notify us. This message contains confidential information and is intended\r\n>>>>> only for the individual named. If you are not the named addressee you\r\n>>>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>>>> and delete this e-mail from your system. If you are not the intended\r\n>>>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>>>> any action in reliance on the contents of this information is strictly\r\n>>>>> prohibited.\r\n>>>>>\r\n>>>>>\r\n>>>>\r\n>>>>\r\n>>>> --\r\n>>>> Regards,\r\n>>>> *AKHIL MURUKAN*\r\n>>>> Software Engineer\r\n>>>>\r\n>>>>\r\n>>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>>> ​\r\n>>>> \"Driven by People, Technology & Values\"\r\n>>>> ​\r\n>>>>\r\n>>>> ​​\r\n>>>> Floor (-\r\n>>>> ​2​\r\n>>>> ), Thejaswini, Technopark\r\n>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>>\r\n>>>>\r\n>>>> ​   Office ​\r\n>>>> : +91\r\n>>>> ​​04714015757\r\n>>>> ​   Web\r\n>>>> :\r\n>>>> ​​\r\n>>>> ​\r\n>>>> www.orisys.in​\r\n>>>>\r\n>>>> ​   Blog  :​\r\n>>>> ​www.orisys.in/blog\r\n>>>>\r\n>>>>\r\n>>>> Disclaimer : This email and any files transmitted with it are\r\n>>>> confidential and intended solely for the use of the individual or entity to\r\n>>>> whom they are addressed. If you have received this email in error please\r\n>>>> notify us. This message contains confidential information and is intended\r\n>>>> only for the individual named. If you are not the named addressee you\r\n>>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>>> and delete this e-mail from your system. If you are not the intended\r\n>>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>>> any action in reliance on the contents of this information is strictly\r\n>>>> prohibited.\r\n>>>>\r\n>>>>\r\n>>>\r\n>>>\r\n>>> --\r\n>>> Regards,\r\n>>> *AKHIL MURUKAN*\r\n>>> Software Engineer\r\n>>>\r\n>>>\r\n>>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>>> ​\r\n>>> \"Driven by People, Technology & Values\"\r\n>>> ​\r\n>>>\r\n>>> ​​\r\n>>> Floor (-\r\n>>> ​2​\r\n>>> ), Thejaswini, Technopark\r\n>>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>>\r\n>>>\r\n>>> ​   Office ​\r\n>>> : +91\r\n>>> ​​04714015757\r\n>>> ​   Web\r\n>>> :\r\n>>> ​​\r\n>>> ​\r\n>>> www.orisys.in​\r\n>>>\r\n>>> ​   Blog  :​\r\n>>> ​www.orisys.in/blog\r\n>>>\r\n>>>\r\n>>> Disclaimer : This email and any files transmitted with it are\r\n>>> confidential and intended solely for the use of the individual or entity to\r\n>>> whom they are addressed. If you have received this email in error please\r\n>>> notify us. This message contains confidential information and is intended\r\n>>> only for the individual named. If you are not the named addressee you\r\n>>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>>> and delete this e-mail from your system. If you are not the intended\r\n>>> recipient you are notified that disclosing, copying, distributing or taking\r\n>>> any action in reliance on the contents of this information is strictly\r\n>>> prohibited.\r\n>>>\r\n>>>\r\n>>\r\n>>\r\n>> --\r\n>> Regards,\r\n>> *AKHIL MURUKAN*\r\n>> Software Engineer\r\n>>\r\n>>\r\n>> *  OrisysIndia Consultancy Services LLP​.​*\r\n>> ​\r\n>> \"Driven by People, Technology & Values\"\r\n>> ​\r\n>>\r\n>> ​​\r\n>> Floor (-\r\n>> ​2​\r\n>> ), Thejaswini, Technopark\r\n>>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>>\r\n>>\r\n>> ​   Office ​\r\n>> : +91\r\n>> ​​04714015757\r\n>> ​   Web\r\n>> :\r\n>> ​​\r\n>> ​\r\n>> www.orisys.in​\r\n>>\r\n>> ​   Blog  :​\r\n>> ​www.orisys.in/blog\r\n>>\r\n>>\r\n>> Disclaimer : This email and any files transmitted with it are\r\n>> confidential and intended solely for the use of the individual or entity to\r\n>> whom they are addressed. If you have received this email in error please\r\n>> notify us. This message contains confidential information and is intended\r\n>> only for the individual named. If you are not the named addressee you\r\n>> should not disseminate, distribute or copy this e-mail. Please notify the\r\n>> sender immediately by e-mail if you have received this e-mail by mistake\r\n>> and delete this e-mail from your system. If you are not the intended\r\n>> recipient you are notified that disclosing, copying, distributing or taking\r\n>> any action in reliance on the contents of this information is strictly\r\n>> prohibited.\r\n>>\r\n>>\r\n>\r\n>\r\n> --\r\n> Regards,\r\n> *AKHIL MURUKAN*\r\n> Software Engineer\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>\r\n\n\n-- \r\nRegards,\r\n*AKHIL MURUKAN*\r\nSoftware Engineer\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-08 09:03:30', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:35', '2018-10-15 01:19:41', NULL),
(11, 2, 11, 11, 'arun.jaganathan@orisys.in', 'Arun Jaganathan <arun.jaganathan@orisys.in>', 'test mail', 'Hi,\r\nPlease ignore this test mail....\r\nTesting purpose please ignore;\r\n\n-- \r\n*Thanks and Regards,*\r\n*Arun Jaganathan*', '2017-08-08 09:11:52', 0, 1, NULL, NULL, NULL, '2017-08-09 04:42:38', '2018-10-15 05:44:42', NULL),
(12, 2, 12, 12, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'mail from chinnu', 'test testtesttesttesttesttesttesttesttesttesttest\r\n-- \r\n\nRegards,\r\n\n\n*​*Chinnu L\r\n\n​\r\nTeam Lead-Web Team\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n​   Mob   ​\r\n:\r\n​\r\n​\r\n+91 (0)\r\n​9995381265\r\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-08 09:44:52', 0, 0, NULL, NULL, NULL, '2017-08-09 04:42:39', '2018-10-15 05:44:42', NULL),
(13, 2, 13, 13, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'test mail from chinnu', 'Test mail Test mail Test mail Test mail Test mail Test mail Test mail Test\r\nmail Test mail Test mail Test mail Test mail Test mail\r\n\n-- \r\n\nRegards,', '2017-08-08 10:09:45', 0, 0, NULL, NULL, NULL, '2017-08-09 04:42:39', '2018-10-15 05:44:42', NULL),
(20, 2, 17, 17, 'devika.devarajan+3@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'enquiry regarding payment of nri chity', 'Lorem Ipsum* is simply dummy text of the printing and typesetting industry.\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the\r\n1500s, when an unknown printer took a galley of type and scrambled it to\r\nmake a type specimen book. It has survived not only five centuries, but\r\nalso the leap into electronic typesetting, remaining essentially unchanged.\r\nIt was popularised in the 1960s with the release of Letras\r\n\n\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-10 11:17:44', 0, 0, NULL, NULL, NULL, '2017-08-10 05:48:00', '2018-10-15 05:44:42', NULL),
(21, 2, 15, 15, 'devika.devarajan+2@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'enquiry regarding nri chitty', 'Hi,\r\n\n*Lorem Ipsum* is simply dummy text of the printing and typesetting\r\nindustry. Lorem Ipsum has been the industry\'s standard dummy text ever\r\nsince the 1500s, when an unknown printer took a galley of type and\r\nscrambled it to make a type specimen book.\r\nIt has survived not only five centuries, but also the leap into electronic\r\ntypesetting, remaining essentially unchanged. It was popularised in the\r\n1960s with the release of Letraset sheets containing Lorem Ipsum passages,\r\nand more recently with desktop publishing software like Aldus PageMaker\r\nincluding versions of Lorem Ipsum.\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-10 10:53:57', 0, 1, NULL, NULL, NULL, '2017-08-10 06:18:17', '2018-10-15 05:17:35', NULL);
INSERT INTO `ori_email_fetchs` (`id`, `cmpny_id`, `email_id`, `thread_id`, `from`, `from_name`, `subject`, `message`, `received_date`, `submit_status`, `read_status`, `answered`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 2, 16, 15, 'devika.devarajan+1@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'enquiry regarding nri chitty', 'HI,\r\n\n\nഒരു ചിട്ടി ഒരു വ്യക്തിയോ സ്ഥാപനമോ ആണ് നടത്തുന്നത്. ഈ സ്ഥാപനത്തെ ഫോർമാൻ\r\nഎന്നു വിളിക്കുന്നു.\r\n\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.\r\n\n\nOn 10 August 2017 at 16:23, Devika Devarajan <devika.devarajan@orisys.in>\r\nwrote:\r\n\n> Hi,\r\n>\r\n> *Lorem Ipsum* is simply dummy text of the printing and typesetting\r\n> industry. Lorem Ipsum has been the industry\'s standard dummy text ever\r\n> since the 1500s, when an unknown printer took a galley of type and\r\n> scrambled it to make a type specimen book.\r\n> It has survived not only five centuries, but also the leap into electronic\r\n> typesetting, remaining essentially unchanged. It was popularised in the\r\n> 1960s with the release of Letraset sheets containing Lorem Ipsum passages,\r\n> and more recently with desktop publishing software like Aldus PageMaker\r\n> including versions of Lorem Ipsum.\r\n>\r\n> Regards,\r\n>\r\n>\r\n> *Devika Devarajan*\r\n> Software Tester\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>', '2017-08-10 11:04:57', 0, 1, NULL, NULL, NULL, '2017-08-10 06:18:18', '2018-10-15 05:17:35', NULL),
(23, 2, 14, 12, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'mail from chinnu', 'sdffffffff\r\n\nOn Tue, Aug 8, 2017 at 3:14 PM, Chinnu L <chinnu.l@orisys.in> wrote:\r\n\n>\r\n> test testtesttesttesttesttesttesttesttesttesttest\r\n> --\r\n>\r\n> Regards,\r\n>\r\n>\r\n> *​*Chinnu L\r\n>\r\n> ​\r\n> Team Lead-Web Team\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n> ​   Mob   ​\r\n> :\r\n> ​\r\n> ​\r\n> +91 (0)\r\n> ​9995381265\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n\n\n\n-- \r\n\nRegards,\r\n\n\n*​*Chinnu L\r\n\n​\r\nTeam Lead-Web Team\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n​   Mob   ​\r\n:\r\n​\r\n​\r\n+91 (0)\r\n​9995381265\r\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-09 06:58:54', 0, 0, NULL, NULL, NULL, '2017-08-10 06:28:24', '2018-10-15 05:44:42', NULL),
(24, 2, 18, 18, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'Testing email fetch', '*Lorem Ipsum* is simply dummy text of the printing and typesetting\r\nindustry. Lorem Ipsum has been the industry\'s standard dummy text ever\r\nsince the 1500s, when an unknown printer took a galley of type and\r\nscrambled it to make a type specimen book. It has survived not only five\r\ncenturies,\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-23 10:49:04', 0, 0, NULL, NULL, NULL, '2017-08-23 05:19:50', '2018-10-15 05:44:42', NULL),
(25, 2, 19, 18, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'Testing email fetch', 'Testing\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.\r\n\n\nOn 23 August 2017 at 10:48, Devika Devarajan <devika.devarajan@orisys.in>\r\nwrote:\r\n\n> *Lorem Ipsum* is simply dummy text of the printing and typesetting\r\n> industry. Lorem Ipsum has been the industry\'s standard dummy text ever\r\n> since the 1500s, when an unknown printer took a galley of type and\r\n> scrambled it to make a type specimen book. It has survived not only five\r\n> centuries,\r\n>\r\n> Regards,\r\n>\r\n>\r\n> *Devika Devarajan*\r\n> Software Tester\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>', '2017-08-23 10:58:33', 0, 0, NULL, NULL, NULL, '2017-08-23 05:28:38', '2018-10-15 05:44:42', NULL),
(26, 2, 20, 20, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'enquiry regarding NRI chit availble', 'It is a long established fact that a reader will be distracted by the\r\nreadable content of a page when looking at its layout. The point of using\r\nLorem Ipsum is that it has a more-or-less normal distribution of letters,\r\nas opposed to using \'Content here, content here\', making it look like\r\nreadable English. Many desktop publishing packages and web page editors now\r\nuse Lorem Ipsum as their default model text, and a search for \'lorem ipsum\'\r\nwill uncover many web sites still in their infancy. Various versions have\r\nevolved over the years, sometimes by accident, sometimes on purpose\r\n(injected humour and the like).\r\n\n\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-23 11:00:31', 0, 0, NULL, NULL, NULL, '2017-08-23 05:31:05', '2018-10-15 05:44:42', NULL),
(27, 2, 21, 20, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'enquiry regarding NRI chit availble', 'dfhfdh\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.\r\n\n\nOn 23 August 2017 at 11:00, Devika Devarajan <devika.devarajan@orisys.in>\r\nwrote:\r\n\n> It is a long established fact that a reader will be distracted by the\r\n> readable content of a page when looking at its layout. The point of using\r\n> Lorem Ipsum is that it has a more-or-less normal distribution of letters,\r\n> as opposed to using \'Content here, content here\', making it look like\r\n> readable English. Many desktop publishing packages and web page editors now\r\n> use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\'\r\n> will uncover many web sites still in their infancy. Various versions have\r\n> evolved over the years, sometimes by accident, sometimes on purpose\r\n> (injected humour and the like).\r\n>\r\n>\r\n>\r\n> Regards,\r\n>\r\n>\r\n> *Devika Devarajan*\r\n> Software Tester\r\n>\r\n>\r\n> *  OrisysIndia Consultancy Services LLP​.​*\r\n> ​\r\n> \"Driven by People, Technology & Values\"\r\n> ​\r\n>\r\n> ​​\r\n> Floor (-\r\n> ​2​\r\n> ), Thejaswini, Technopark\r\n>     Thiruvananthapuram, Kerala, India, PIN 695 581\r\n>\r\n>\r\n> ​   Office ​\r\n> : +91\r\n> ​​04714015757\r\n> ​   Web\r\n> :\r\n> ​​\r\n> ​\r\n> www.orisys.in​\r\n>\r\n> ​   Blog  :​\r\n> ​www.orisys.in/blog\r\n>\r\n>\r\n> Disclaimer : This email and any files transmitted with it are confidential\r\n> and intended solely for the use of the individual or entity to whom they\r\n> are addressed. If you have received this email in error please notify us.\r\n> This message contains confidential information and is intended only for the\r\n> individual named. If you are not the named addressee you should not\r\n> disseminate, distribute or copy this e-mail. Please notify the sender\r\n> immediately by e-mail if you have received this e-mail by mistake and\r\n> delete this e-mail from your system. If you are not the intended recipient\r\n> you are notified that disclosing, copying, distributing or taking any\r\n> action in reliance on the contents of this information is strictly\r\n> prohibited.\r\n>\r\n>', '2017-08-23 11:02:29', 0, 0, NULL, NULL, NULL, '2017-08-23 05:35:36', '2018-10-15 05:44:42', NULL),
(28, 2, 22, 22, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'test1', 'sdgsgf\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-08-23 11:02:43', 0, 0, NULL, NULL, NULL, '2017-08-23 05:35:37', '2018-10-15 05:44:42', NULL),
(29, 2, 23, 23, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'testing attachments', '<div dir=\"ltr\"><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\">testing attachments</div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div><div class=\"gmail_signature\" data-smartmail=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\">Regards,<br><br></span></td></tr><tr><td style=\"border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td></td></tr></tbody></table><br><div style=\"font-size:12.8000001907349px\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"color:rgb(50,50,50);font-family:Arial,Helvetica,sans-serif;font-size:8pt;line-height:9pt\"><tbody><tr><td><font face=\"verdana, sans-serif\"><span style=\"font-size:13.3333330154419px\"><b>Devika Devarajan</b></span></font><span style=\"color:rgb(112,113,115);font-family:verdana,sans-serif;font-size:12px\"><br>Software Tester<br></span><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"172\" style=\"border-collapse:collapse;width:129pt\"><tbody><tr height=\"20\" style=\"height:15.0pt\">\r\n<td height=\"20\" width=\"108\" style=\"height:15.0pt;width:81pt\"><img src=\"http://orisys.in/orisys_logo.png\"><br></td>\r\n<td width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-family:Arial,Helvetica,sans-serif;font-size:10pt\"><b><div style=\"font-family:verdana,sans-serif;display:inline\">  OrisysIndia Consultancy Services LLP​</div>.<br><div style=\"font-family:verdana,sans-serif;display:inline\">​</div></b></span><span style=\"font-family:verdana,sans-serif;line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"font-family:Arial,Helvetica,sans-serif;line-height:9pt\"><div style=\"font-family:verdana,sans-serif;display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-family:Arial,Helvetica,sans-serif;font-size:10pt\"><b><div style=\"font-family:verdana,sans-serif;display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​​   </div>Floor (-<div style=\"font-family:verdana,sans-serif;display:inline\">​2​</div>), Thejaswini, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, India, PIN 695 581</td></tr></tbody></table><br style=\"font-family:Arial,Helvetica,sans-serif;font-size:10.6666669845581px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><br></td><td><div style=\"font-family:verdana,sans-serif;display:inline\"><br></div></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"font-family:verdana,sans-serif;display:inline\">​<span style=\"font-size:10.6666669845581px;line-height:13.3333330154419px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Web   </div>:</td><td><div style=\"font-family:verdana,sans-serif;display:inline\">​​</div><div style=\"font-family:verdana,sans-serif;display:inline\">​</div><span style=\"font-family:verdana,sans-serif;font-size:10.6666669845581px;line-height:13.3333330154419px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.orisys.in</a>​</span></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Blog  :​</div></td><td><div style=\"font-family:verdana,sans-serif;display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.orisys.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table><div style=\"color:rgb(34,34,34);font-size:12.8000001907349px;line-height:normal\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td style=\"border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(200,200,200)\"><br></td></tr></tbody></table></div><div style=\"color:rgb(34,34,34);font-size:12.8000001907349px;line-height:normal\"><div style=\"font-family:verdana,sans-serif\"><div> <br></div><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></div></div></td></tr><tr><td><br></td></tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>\r\n</div>', '2017-08-23 11:38:24', 0, 0, NULL, NULL, NULL, '2017-08-23 06:08:42', '2018-10-15 05:44:42', NULL),
(30, 2, 0, 12, 'oriesmarti@gmail.com', 'KSFE', 'mail from chinnu', 'test mail', '2017-08-23 15:18:07', 0, 0, NULL, NULL, NULL, '2017-08-23 09:48:07', '2018-10-15 05:44:42', NULL),
(31, 2, 0, 12, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'mail from chinnu', 'test test', '2017-08-23 16:31:48', 0, 0, NULL, NULL, NULL, '2017-08-23 11:01:48', '2018-10-15 05:44:42', NULL),
(32, 2, 0, 12, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'mail from chinnu', 'testttt', '2017-08-23 18:07:00', 0, 0, NULL, NULL, NULL, '2017-08-23 12:37:00', '2018-10-15 05:44:42', NULL),
(33, 2, 0, 5, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'test email from akhil', 'hhhiiiiiiii', '2017-08-23 18:18:26', 0, 1, NULL, NULL, NULL, '2017-08-23 12:48:26', '2018-10-15 01:19:41', NULL),
(34, 2, 0, 5, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'test email from akhil', 'hhhiiiiiiii', '2017-08-23 18:18:30', 0, 1, NULL, NULL, NULL, '2017-08-23 12:48:30', '2018-10-15 01:19:41', NULL),
(35, 2, 0, 5, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'test email from akhil', 'hhhiiiiiiii', '2017-08-23 18:18:30', 0, 1, NULL, NULL, NULL, '2017-08-23 12:48:30', '2018-10-15 01:19:41', NULL),
(36, 2, 24, 24, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'testing email fetching', '<div dir=\"ltr\"><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\">Hi,</div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><strong style=\"margin:0px;padding:0px;color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify\">Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><span style=\"color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify\"><br></span></div><div><div class=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\">Regards,<br><br></span></td></tr><tr><td style=\"border-bottom:1px solid rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td></td></tr></tbody></table><br><div style=\"font-size:12.8px\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"color:rgb(50,50,50);font-family:Arial,Helvetica,sans-serif;font-size:8pt;line-height:9pt\"><tbody><tr><td><font face=\"verdana, sans-serif\"><span style=\"font-size:13.3333px\"><b>Devika Devarajan</b></span></font><span style=\"color:rgb(112,113,115);font-family:verdana,sans-serif;font-size:12px\"><br>Software Tester<br></span><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"172\" style=\"border-collapse:collapse;width:129pt\"><tbody><tr height=\"20\" style=\"height:15pt\">\n<td height=\"20\" width=\"108\" style=\"height:15pt;width:81pt\"><img src=\"http://orisys.in/orisys_logo.png\"><br></td>\n<td width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-family:Arial,Helvetica,sans-serif;font-size:10pt\"><b><div style=\"font-family:verdana,sans-serif;display:inline\">  OrisysIndia Consultancy Services LLP​</div>.<br><div style=\"font-family:verdana,sans-serif;display:inline\">​</div></b></span><span style=\"font-family:verdana,sans-serif;line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"font-family:Arial,Helvetica,sans-serif;line-height:9pt\"><div style=\"font-family:verdana,sans-serif;display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-family:Arial,Helvetica,sans-serif;font-size:10pt\"><b><div style=\"font-family:verdana,sans-serif;display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​​   </div>Floor (-<div style=\"font-family:verdana,sans-serif;display:inline\">​2​</div>), Thejaswini, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, India, PIN 695 581</td></tr></tbody></table><br style=\"font-family:Arial,Helvetica,sans-serif;font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><br></td><td><div style=\"font-family:verdana,sans-serif;display:inline\"><br></div></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"font-family:verdana,sans-serif;display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Web   </div>:</td><td><div style=\"font-family:verdana,sans-serif;display:inline\">​​</div><div style=\"font-family:verdana,sans-serif;display:inline\">​</div><span style=\"font-family:verdana,sans-serif;font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.orisys.in</a>​</span></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Blog  :​</div></td><td><div style=\"font-family:verdana,sans-serif;display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.orisys.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table><div style=\"color:rgb(34,34,34);font-size:12.8px;line-height:normal\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td style=\"border-bottom:1px solid rgb(200,200,200)\"><br></td></tr></tbody></table></div><div style=\"color:rgb(34,34,34);font-size:12.8px;line-height:normal\"><div style=\"font-family:verdana,sans-serif\"><div> <br></div><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></div></div></td></tr><tr><td><br></td></tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>\n</div>', '2017-08-25 12:50:27', 0, 0, NULL, NULL, NULL, '2017-08-25 07:21:09', '2018-10-15 05:44:42', NULL),
(37, 2, 0, 24, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'testing email fetching', 'hi recieved your enquiry. please send your basic details including phone number to register', '2017-08-25 12:52:19', 0, 0, NULL, NULL, NULL, '2017-08-25 07:22:19', '2018-10-15 05:44:42', NULL),
(38, 2, 25, 24, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'testing email fetching', 'hai,\r\n\nName : Devika Devarajan , Phone num : 9946364521 ,\r\nAnjilimoottil house , palackathakidi P o , kunnamthanam\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.\r\n\n\nOn 25 August 2017 at 12:52, KSFE <oriesmarti@gmail.com> wrote:\r\n\n> hi recieved your enquiry. please send your basic details including phone\r\n> number to register\r\n>\r\n> --\r\n>\r\n> Best Regards\r\n> ------------------------------\r\n> © 2017 | All Rights Reserved.\r\n> test@gmail.com | www.ksfe.com\r\n>', '2017-08-25 12:56:13', 0, 0, NULL, NULL, NULL, '2017-08-25 07:26:57', '2018-10-15 05:44:42', NULL),
(39, 2, 0, 24, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'testing email fetching', 'ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ്', '2017-08-25 13:02:37', 0, 0, NULL, NULL, NULL, '2017-08-25 07:32:37', '2018-10-15 05:44:42', NULL),
(40, 2, 0, 24, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'testing email fetching', 'dsfdsf', '2017-08-25 13:06:45', 0, 0, NULL, NULL, NULL, '2017-08-25 07:36:45', '2018-10-15 05:44:42', NULL),
(41, 2, 30, 30, 'arun.raj@orisys.in', 'Arun Raj <arun.raj@orisys.in>', 'Invitation: FRaise App Discussion @ Thu Sep 21, 2017 3pm - 3:30pm (Arun Raj)', '<div dir=\"ltr\"><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div class=\"gmail_quote\">---------- Forwarded message ----------<br>From: <b class=\"gmail_sendername\">Amruth Raj R</b> <span dir=\"ltr\">&lt;<a href=\"mailto:amruth.raj@orisys.in\">amruth.raj@orisys.in</a>&gt;</span><br>Date: Wed, Sep 20, 2017 at 9:30 PM<br>Subject: Invitation: FRaise App Discussion @ Thu Sep 21, 2017 3pm - 3:30pm (Arun Raj)<br>To: <a href=\"mailto:arun.raj@orisys.in\">arun.raj@orisys.in</a>, Binny V A &lt;<a href=\"mailto:binnyva@makeadiff.in\">binnyva@makeadiff.in</a>&gt;, <a href=\"mailto:anand.a@orisys.in\">anand.a@orisys.in</a>, <a href=\"mailto:rejeesh.nair@orisys.in\">rejeesh.nair@orisys.in</a>, Jithin Nedumala &lt;<a href=\"mailto:jithin@makeadiff.in\">jithin@makeadiff.in</a>&gt;, Rajesh Balan &lt;<a href=\"mailto:rajesh.balan@orisys.in\">rajesh.balan@orisys.in</a>&gt;, <a href=\"mailto:nishant@makeadiff.in\">nishant@makeadiff.in</a><br><br><br><span><span style=\"display:none\"></span><span><div><table cellspacing=\"0\" cellpadding=\"8\" border=\"0\" summary=\"\" style=\"width:100%;font-family:Arial,Sans-serif;border:1px Solid #ccc;border-width:1px 2px 2px 1px;background-color:#fff\"><tbody><tr><td><div style=\"padding:2px\"><span></span><div style=\"float:right;font-weight:bold;font-size:13px\"> <a href=\"https://www.google.com/calendar/event?action=VIEW&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en\" style=\"color:#20c;white-space:nowrap\" target=\"_blank\">more details »</a><br></div><h3 style=\"padding:0 0 6px 0;margin:0;font-family:Arial,Sans-serif;font-size:16px;font-weight:bold;color:#222\"><span>FRaise App Discussion</span></h3><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" summary=\"Event details\"><tbody><tr><td style=\"padding:0 1em 10px 0;font-family:Arial,Sans-serif;font-size:13px;color:#888;white-space:nowrap\" valign=\"top\"><div><i style=\"font-style:normal\">When</i></div></td><td style=\"padding-bottom:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\" valign=\"top\"><time datetime=\"20170921T093000Z\"></time><time datetime=\"20170921T100000Z\"></time>Thu Sep 21, 2017 3pm – 3:30pm <span style=\"color:#888\">India Standard Time</span></td></tr><tr><td style=\"padding:0 1em 10px 0;font-family:Arial,Sans-serif;font-size:13px;color:#888;white-space:nowrap\" valign=\"top\"><div><i style=\"font-style:normal\">Calendar</i></div></td><td style=\"padding-bottom:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\" valign=\"top\">Arun Raj</td></tr><tr><td style=\"padding:0 1em 10px 0;font-family:Arial,Sans-serif;font-size:13px;color:#888;white-space:nowrap\" valign=\"top\"><div><i style=\"font-style:normal\">Who</i></div></td><td style=\"padding-bottom:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\" valign=\"top\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\"><a href=\"mailto:amruth.raj@orisys.in\" target=\"_blank\">amruth.raj@orisys.in</a></span></span><span></span><span style=\"font-size:11px;color:#888\"> - organizer</span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\">Binny V A</span></span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\"><a href=\"mailto:anand.a@orisys.in\" target=\"_blank\">anand.a@orisys.in</a></span></span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\"><a href=\"mailto:rejeesh.nair@orisys.in\" target=\"_blank\">rejeesh.nair@orisys.in</a></span></span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\">Jithin Nedumala</span></span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\">Arun Raj</span></span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\">Rajesh Balan</span></span></div></div></td></tr><tr><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><span style=\"font-family:Courier New,monospace\">•</span></td><td style=\"padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222\"><div><div style=\"margin:0 0 0.3em 0\"><span><span class=\"notranslate\"><a href=\"mailto:nishant@makeadiff.in\" target=\"_blank\">nishant@makeadiff.in</a></span></span></div></div></td></tr></tbody></table></td></tr></tbody></table></div><p style=\"color:#222;font-size:13px;margin:0\"><span style=\"color:#888\">Going?   </span><strong><span><span><a href=\"https://www.google.com/calendar/event?action=RESPOND&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;rst=1&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en\" style=\"color:#20c;white-space:nowrap\" target=\"_blank\">Yes</a></span></span><span style=\"margin:0 0.4em;font-weight:normal\"> - </span><span><span><a href=\"https://www.google.com/calendar/event?action=RESPOND&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;rst=3&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en\" style=\"color:#20c;white-space:nowrap\" target=\"_blank\">Maybe</a></span></span><span style=\"margin:0 0.4em;font-weight:normal\"> - </span><span><span><a href=\"https://www.google.com/calendar/event?action=RESPOND&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;rst=2&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en\" style=\"color:#20c;white-space:nowrap\" target=\"_blank\">No</a></span></span></strong>    <a href=\"https://www.google.com/calendar/event?action=VIEW&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en\" style=\"color:#20c;white-space:nowrap\" target=\"_blank\">more options »</a></p></td></tr><tr><td style=\"background-color:#f6f6f6;color:#888;border-top:1px Solid #ccc;font-family:Arial,Sans-serif;font-size:11px\"><p>Invitation from <a href=\"https://www.google.com/calendar/\" target=\"_blank\">Google Calendar</a></p><p>You are receiving this email at the account <a href=\"mailto:arun.raj@orisys.in\" target=\"_blank\">arun.raj@orisys.in</a> because you are subscribed for invitations on calendar Arun Raj.</p><p>To stop receiving these emails, please log in to <a href=\"https://www.google.com/calendar/\" target=\"_blank\">https://www.google.com/<wbr>calendar/</a> and change your notification settings for this calendar.</p><p>Forwarding this invitation could allow any recipient to modify your RSVP response. <a href=\"https://support.google.com/calendar/answer/37135#forwarding\" target=\"_blank\">Learn More</a>.</p></td></tr></tbody></table></div></span></span></div><br><br clear=\"all\"><div><br></div>-- <br><div class=\"gmail_signature\" data-smartmail=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div>Arun Raj R</div><div>CEO,</div><div><b>OrisysIndia Consultancy Services LLP</b><br></div><div><a href=\"mailto:sales@orisys.in\" target=\"_blank\">sales@orisys.in</a><br><a href=\"http://www.orisys.in/\" target=\"_blank\">www.orisys.in</a></div><div><br></div><div>M: +919946014345 O: +918086800203</div><div>skype:arungv </div><div><br></div><div><a href=\"https://www.linkedin.com/in/arunrajr\" target=\"_blank\">LinkedIn</a></div><div><br></div><div><img width=\"200\" height=\"54\" src=\"http://orisys.in/Orisys_Christmas-Logo.png\"><br><i><font size=\"1\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</font></i></div></div></div></div></div></div></div>\r\n</div>', '2017-09-27 02:28:58', 0, 0, NULL, NULL, NULL, '2017-09-27 09:29:01', '2018-10-15 05:44:42', NULL),
(53, 2, 32, 32, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'Testing', 'Hi,\r\n\nWelcome to ooty\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-09-29 09:49:21', 0, 1, NULL, NULL, NULL, '2017-09-29 04:36:20', '2018-10-15 05:16:59', NULL),
(54, 2, 33, 33, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'Testing_email', 'hi,\r\n\ntesting mail template\r\n\nRegards,\r\n\n\n*Devika Devarajan*\r\nSoftware Tester\r\n\n\n*  OrisysIndia Consultancy Services LLP​.​*\r\n​\r\n\"Driven by People, Technology & Values\"\r\n​\r\n\n​​\r\nFloor (-\r\n​2​\r\n), Thejaswini, Technopark\r\nThiruvananthapuram, Kerala, India, PIN 695 581\r\n\n\n​   Office ​\r\n: +91\r\n​​04714015757\r\n​   Web\r\n:\r\n​​\r\n​\r\nwww.orisys.in​\r\n\n​   Blog  :​\r\n​www.orisys.in/blog\r\n\n\nDisclaimer : This email and any files transmitted with it are confidential\r\nand intended solely for the use of the individual or entity to whom they\r\nare addressed. If you have received this email in error please notify us.\r\nThis message contains confidential information and is intended only for the\r\nindividual named. If you are not the named addressee you should not\r\ndisseminate, distribute or copy this e-mail. Please notify the sender\r\nimmediately by e-mail if you have received this e-mail by mistake and\r\ndelete this e-mail from your system. If you are not the intended recipient\r\nyou are notified that disclosing, copying, distributing or taking any\r\naction in reliance on the contents of this information is strictly\r\nprohibited.', '2017-09-29 09:57:34', 0, 1, NULL, NULL, NULL, '2017-09-29 04:36:21', '2019-01-21 23:24:59', NULL);
INSERT INTO `ori_email_fetchs` (`id`, `cmpny_id`, `email_id`, `thread_id`, `from`, `from_name`, `subject`, `message`, `received_date`, `submit_status`, `read_status`, `answered`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(55, 2, 34, 34, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', 'hai ,\r\n\ntest', '2017-09-29 10:19:42', 0, 1, NULL, NULL, NULL, '2017-09-29 04:50:12', '2019-01-21 23:24:55', NULL),
(56, 2, 0, 34, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'testing', 'ok process completed.', '2017-09-29 10:20:57', 0, 1, NULL, NULL, NULL, '2017-09-29 04:50:57', '2019-01-21 23:24:55', NULL),
(57, 2, 0, 34, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'testing', 'please provide your phone number', '2017-09-29 10:22:20', 0, 1, NULL, NULL, NULL, '2017-09-29 04:52:20', '2019-01-21 23:24:55', NULL),
(58, 2, 35, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '8129972384\r\n\nOn Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:\r\n\n> please provide your phone number\r\n>\r\n> --\r\n>\r\n> Best Regards\r\n> ------------------------------\r\n> © 2017 | All Rights Reserved.\r\n> test@gmail.com | www.ksfe.com\r\n>', '2017-09-29 10:23:22', 0, 1, NULL, NULL, NULL, '2017-09-29 04:54:26', '2018-10-15 00:55:29', NULL),
(59, 2, 36, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', 'testing\r\n\nOn Fri, Sep 29, 2017 at 10:23 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n\n> 8129972384\r\n>\r\n> On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:\r\n>\r\n>> please provide your phone number\r\n>>\r\n>> --\r\n>>\r\n>> Best Regards\r\n>> ------------------------------\r\n>> © 2017 | All Rights Reserved.\r\n>> test@gmail.com | www.ksfe.com\r\n>>\r\n>\r\n>', '2017-09-29 10:25:22', 0, 1, NULL, NULL, NULL, '2017-09-29 04:57:03', '2018-10-15 00:55:29', NULL),
(60, 2, 37, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', 'hello testing in process\r\n\nOn Fri, Sep 29, 2017 at 10:25 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n\n> testing\r\n>\r\n> On Fri, Sep 29, 2017 at 10:23 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n>\r\n>> 8129972384\r\n>>\r\n>> On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:\r\n>>\r\n>>> please provide your phone number\r\n>>>\r\n>>> --\r\n>>>\r\n>>> Best Regards\r\n>>> ------------------------------\r\n>>> © 2017 | All Rights Reserved.\r\n>>> test@gmail.com | www.ksfe.com\r\n>>>\r\n>>\r\n>>\r\n>', '2017-09-29 10:27:43', 0, 1, NULL, NULL, NULL, '2017-09-29 04:58:52', '2018-10-15 00:55:29', NULL),
(61, 2, 38, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', 'retest\r\n\nOn Fri, Sep 29, 2017 at 10:27 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n\n> hello testing in process\r\n>\r\n> On Fri, Sep 29, 2017 at 10:25 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n>\r\n>> testing\r\n>>\r\n>> On Fri, Sep 29, 2017 at 10:23 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n>>\r\n>>> 8129972384\r\n>>>\r\n>>> On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:\r\n>>>\r\n>>>> please provide your phone number\r\n>>>>\r\n>>>> --\r\n>>>>\r\n>>>> Best Regards\r\n>>>> ------------------------------\r\n>>>> © 2017 | All Rights Reserved.\r\n>>>> test@gmail.com | www.ksfe.com\r\n>>>>\r\n>>>\r\n>>>\r\n>>\r\n>', '2017-09-29 10:29:27', 0, 1, NULL, NULL, NULL, '2017-09-29 04:59:39', '2018-10-15 00:55:29', NULL),
(62, 2, 39, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '4LSV4LWBICprdSogPSDwn5iG8J+YgvCfmIXwn4648J+PlfCfmrrwn4yL4LSVDQo', '2017-09-29 10:53:47', 0, 1, NULL, NULL, NULL, '2017-09-29 05:24:06', '2018-10-15 00:55:29', NULL),
(63, 2, 40, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '4LSVDQoNCjIwMTctMDktMjkgMTA6NTMgR01UKzA1OjMwIEpheWFqaXRoIEouSiA8amF5YWd0aEBn\r\nbWFpbC5jb20+Og0KDQo+DQo+DQo+IOC0leC1gSAqa3UqID0g8J+YhvCfmILwn5iF8J+OuPCfj5Xw\r\nn5q68J+Mi+C0lQ0KPg0K', '2017-09-29 10:56:08', 0, 1, NULL, NULL, NULL, '2017-09-29 05:26:24', '2018-10-15 00:55:29', NULL),
(64, 2, 41, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '<div dir=\"ltr\">image<div class=\"gmail_extra\"><br><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div class=\"gmail_extra\"><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\"><div class=\"gmail_extra\"><br></div></div>\r\n</blockquote></div><br></div>\r\n</blockquote></div><br></div></div>', '2017-09-29 11:00:45', 0, 1, NULL, NULL, NULL, '2017-09-29 05:31:14', '2018-10-15 00:55:29', NULL),
(65, 2, 42, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '<div dir=\"ltr\">gifs</div><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <span dir=\"ltr\">&lt;<a href=\"mailto:jayagth@gmail.com\" target=\"_blank\">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\">image<div class=\"gmail_extra\"><br><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div class=\"gmail_extra\"><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\"><div class=\"gmail_extra\"><br></div></div>\r\n</blockquote></div><br></div>\r\n</blockquote></div><br></div></div>\r\n</blockquote></div><br></div>', '2017-09-29 11:03:41', 0, 1, NULL, NULL, NULL, '2017-09-29 05:34:04', '2018-10-15 00:55:29', NULL),
(66, 2, 43, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '<div dir=\"ltr\">pdf</div><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Fri, Sep 29, 2017 at 11:03 AM, Jayajith J.J <span dir=\"ltr\">&lt;<a href=\"mailto:jayagth@gmail.com\" target=\"_blank\">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\">gifs</div><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <span dir=\"ltr\">&lt;<a href=\"mailto:jayagth@gmail.com\" target=\"_blank\">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\">image<div class=\"gmail_extra\"><br><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div class=\"gmail_extra\"><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\"><div class=\"gmail_extra\"><br></div></div>\r\n</blockquote></div><br></div>\r\n</blockquote></div><br></div></div>\r\n</blockquote></div><br></div>\r\n</blockquote></div><br></div>', '2017-09-29 11:07:02', 0, 1, NULL, NULL, NULL, '2017-09-29 05:37:37', '2018-10-15 00:55:29', NULL),
(67, 2, 44, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', '<div dir=\"ltr\">docx</div><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Fri, Sep 29, 2017 at 11:07 AM, Jayajith J.J <span dir=\"ltr\">&lt;<a href=\"mailto:jayagth@gmail.com\" target=\"_blank\">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\">pdf</div><div class=\"HOEnZb\"><div class=\"h5\"><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Fri, Sep 29, 2017 at 11:03 AM, Jayajith J.J <span dir=\"ltr\">&lt;<a href=\"mailto:jayagth@gmail.com\" target=\"_blank\">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\">gifs</div><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <span dir=\"ltr\">&lt;<a href=\"mailto:jayagth@gmail.com\" target=\"_blank\">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\">image<div class=\"gmail_extra\"><br><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div class=\"gmail_extra\"><div class=\"gmail_quote\"><blockquote class=\"gmail_quote\" style=\"margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir=\"ltr\"><div class=\"gmail_extra\"><br></div></div>\r\n</blockquote></div><br></div>\r\n</blockquote></div><br></div></div>\r\n</blockquote></div><br></div>\r\n</blockquote></div><br></div>\r\n</div></div></blockquote></div><br></div>', '2017-09-29 11:11:01', 0, 1, NULL, NULL, NULL, '2017-09-29 05:41:44', '2018-10-15 00:55:29', NULL),
(68, 2, 45, 35, 'jayagth@gmail.com', '\"Jayajith J.J\" <jayagth@gmail.com>', 'testing', 'Hai* hello** testing done*\r\n\nOn Fri, Sep 29, 2017 at 11:10 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n\n> docx\r\n>\r\n> On Fri, Sep 29, 2017 at 11:07 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n>\r\n>> pdf\r\n>>\r\n>> On Fri, Sep 29, 2017 at 11:03 AM, Jayajith J.J <jayagth@gmail.com> wrote:\r\n>>\r\n>>> gifs\r\n>>>\r\n>>> On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <jayagth@gmail.com>\r\n>>> wrote:\r\n>>>\r\n>>>> image\r\n>>>>\r\n>>>>\r\n>>>>>>\r\n>>>>>\r\n>>>>\r\n>>>\r\n>>\r\n>', '2017-09-29 11:20:00', 0, 1, NULL, NULL, NULL, '2017-09-29 05:50:18', '2018-10-15 00:55:29', NULL),
(70, 2, 47, 47, 'devarajandevika24@gmail.com', 'Devika Devarajan <devarajandevika24@gmail.com>', 'help me', 'Hi,\r\n\nCould you please help me with the kyc verification steps\r\n\n--\r\nThanks And Regards,\r\n\n\n*Devika Devarajan*', '2017-09-29 12:01:03', 0, 1, NULL, NULL, NULL, '2017-09-29 07:10:47', '2019-01-21 23:24:52', NULL),
(71, 2, 0, 47, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'help me', 'choose an agent and go to the agent with the generated code. submit all documents', '2017-09-29 13:45:26', 0, 1, NULL, NULL, NULL, '2017-09-29 08:15:26', '2019-01-21 23:24:52', NULL),
(128, 2, 48, 48, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'ടെസ്റ്റ് മെയിൽ', '<div dir=\"ltr\"><div>ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ് <br></div>-- <br><div class=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div style=\"font-size:12.8px;font-family:verdana,sans-serif\"><br></div></div><div style=\"font-size:12.8px\"><div style=\"font-family:arial,sans-serif;font-size:12.8px\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\">Regards,<br><br></font></span></td></tr><tr><td style=\"border-bottom:1px solid rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-size:8pt;line-height:9pt\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\"><b><div style=\"display:inline\">​<br></div></b><font color=\"#000000\"><font style=\"font-size:12.8px;line-height:normal\">Chinnu L</font><font style=\"font-size:12.8px;line-height:normal\"> </font><font style=\"font-size:12.8px;line-height:normal\"> </font></font><b><div style=\"display:inline\"><br></div></b></font></span></td></tr><tr><td><span style=\"padding:0px;margin:0px;font-size:9pt\"><div style=\"display:inline\"><font face=\"verdana, sans-serif\"><div style=\"color:rgb(112,113,115);display:inline\">​</div><span style=\"font-size:12.8px;line-height:normal\"><font color=\"#444444\">Team Lead-Web Team</font></span><br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"239\" style=\"color:rgb(112,113,115);border-collapse:collapse;width:179pt\"><tbody><tr height=\"36\" style=\"height:27pt\"><td height=\"36\" align=\"right\" width=\"175\" style=\"height:27pt;width:131pt\"><img src=\"http://orisys.in/orisys_logo.png\"> <br></td><td align=\"right\" width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-size:10pt\"><b><div style=\"display:inline\">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style=\"display:inline\">​</div></b></span><span style=\"line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"line-height:9pt\"><div style=\"display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-size:10pt\"><b><div style=\"display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"display:inline\">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style=\"text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><div style=\"display:inline\">​   Mob   ​</div>:</td><td><div style=\"display:inline\">​<div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\">+91 (0) </span><div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​9995381265</div><span style=\"font-size:8pt;line-height:10pt\"> </span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Web   </div>:</td><td><div style=\"display:inline\">​​</div><div style=\"display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style=\"display:inline\">​   Blog  :​</div></td><td><div style=\"display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style=\"border-bottom:1px solid rgb(200,200,200)\"><font face=\"verdana, sans-serif\"><br></font></td></tr></tbody></table></div><div style=\"font-size:12.8px\"><div><div><font face=\"verdana, sans-serif\"> <br></font></div><font face=\"verdana, sans-serif\"><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>\r\n</div>', '2017-10-16 03:26:03', 0, 1, NULL, NULL, NULL, '2017-10-17 13:10:22', '2018-10-15 05:44:42', NULL),
(129, 2, 49, 49, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'ടെസ്റ്റ് മെയിൽ2', '<div dir=\"ltr\"><br clear=\"all\"><div><span style=\"font-size:12.8px\">ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ് </span></div>\r\n</div>\r\n', '2017-10-16 06:17:57', 0, 0, NULL, NULL, NULL, '2017-10-17 13:10:23', '2018-10-15 05:44:42', NULL),
(130, 2, 50, 50, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'test', '<div dir=\"ltr\">test test<br clear=\"all\"><div><br></div>-- <br><div class=\"gmail_signature\" data-smartmail=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div style=\"font-size:12.8000001907349px;font-family:verdana,sans-serif\"><br></div></div><div style=\"font-size:12.8px\"><div style=\"font-family:arial,sans-serif;font-size:12.8px\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\">Regards,<br><br></font></span></td></tr><tr><td style=\"border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-size:8pt;line-height:9pt\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\"><b><div style=\"display:inline\">​<br></div></b><font color=\"#000000\"><font style=\"font-size:12.8px;line-height:normal\">Chinnu L</font><font style=\"font-size:12.8px;line-height:normal\"> </font><font style=\"font-size:12.8px;line-height:normal\"> </font></font><b><div style=\"display:inline\"><br></div></b></font></span></td></tr><tr><td><span style=\"padding:0px;margin:0px;font-size:9pt\"><div style=\"display:inline\"><font face=\"verdana, sans-serif\"><div style=\"color:rgb(112,113,115);display:inline\">​</div><span style=\"font-size:12.8px;line-height:normal\"><font color=\"#444444\">Team Lead-Web Team</font></span><br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"239\" style=\"color:rgb(112,113,115);border-collapse:collapse;width:179pt\"><tbody><tr height=\"36\" style=\"height:27pt\"><td height=\"36\" align=\"right\" width=\"175\" style=\"height:27pt;width:131pt\"><img src=\"http://orisys.in/orisys_logo.png\"> <br></td><td align=\"right\" width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-size:10pt\"><b><div style=\"display:inline\">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style=\"display:inline\">​</div></b></span><span style=\"line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"line-height:9pt\"><div style=\"display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-size:10pt\"><b><div style=\"display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"display:inline\">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style=\"text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><div style=\"display:inline\">​   Mob   ​</div>:</td><td><div style=\"display:inline\">​<div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\">+91 (0) </span><div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​9995381265</div><span style=\"font-size:8pt;line-height:10pt\"> </span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Web   </div>:</td><td><div style=\"display:inline\">​​</div><div style=\"display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style=\"display:inline\">​   Blog  :​</div></td><td><div style=\"display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style=\"border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(200,200,200)\"><font face=\"verdana, sans-serif\"><br></font></td></tr></tbody></table></div><div style=\"font-size:12.8px\"><div><div><font face=\"verdana, sans-serif\"> <br></font></div><font face=\"verdana, sans-serif\"><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>\r\n</div>', '2017-10-16 06:58:20', 0, 0, NULL, NULL, NULL, '2017-10-17 13:10:23', '2018-10-15 05:44:42', NULL),
(131, 2, 51, 51, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'testing html', '<div dir=\"ltr\"><strong style=\"margin:0px;padding:0px;color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify\">Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span><br clear=\"all\"><div><br></div>-- <br><div class=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div style=\"font-size:12.8px;font-family:verdana,sans-serif\"><br></div></div><div style=\"font-size:12.8px\"><div style=\"font-family:arial,sans-serif;font-size:12.8px\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\">Regards,<br><br></font></span></td></tr><tr><td style=\"border-bottom:1px solid rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-size:8pt;line-height:9pt\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\"><b><div style=\"display:inline\">​<br></div></b><font color=\"#000000\"><font style=\"font-size:12.8px;line-height:normal\">Chinnu L</font><font style=\"font-size:12.8px;line-height:normal\"> </font><font style=\"font-size:12.8px;line-height:normal\"> </font></font><b><div style=\"display:inline\"><br></div></b></font></span></td></tr><tr><td><span style=\"padding:0px;margin:0px;font-size:9pt\"><div style=\"display:inline\"><font face=\"verdana, sans-serif\"><div style=\"color:rgb(112,113,115);display:inline\">​</div><span style=\"font-size:12.8px;line-height:normal\"><font color=\"#444444\">Team Lead-Web Team</font></span><br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"239\" style=\"color:rgb(112,113,115);border-collapse:collapse;width:179pt\"><tbody><tr height=\"36\" style=\"height:27pt\"><td height=\"36\" align=\"right\" width=\"175\" style=\"height:27pt;width:131pt\"><img src=\"http://orisys.in/orisys_logo.png\"> <br></td><td align=\"right\" width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-size:10pt\"><b><div style=\"display:inline\">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style=\"display:inline\">​</div></b></span><span style=\"line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"line-height:9pt\"><div style=\"display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-size:10pt\"><b><div style=\"display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"display:inline\">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style=\"text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><div style=\"display:inline\">​   Mob   ​</div>:</td><td><div style=\"display:inline\">​<div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\">+91 (0) </span><div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​9995381265</div><span style=\"font-size:8pt;line-height:10pt\"> </span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Web   </div>:</td><td><div style=\"display:inline\">​​</div><div style=\"display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style=\"display:inline\">​   Blog  :​</div></td><td><div style=\"display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style=\"border-bottom:1px solid rgb(200,200,200)\"><font face=\"verdana, sans-serif\"><br></font></td></tr></tbody></table></div><div style=\"font-size:12.8px\"><div><div><font face=\"verdana, sans-serif\"> <br></font></div><font face=\"verdana, sans-serif\"><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>\r\n</div>', '2017-10-17 05:39:41', 0, 0, NULL, NULL, NULL, '2017-10-17 13:10:24', '2018-10-15 05:44:42', NULL),
(132, 2, 52, 48, 'chinnu.l@orisys.in', 'Chinnu L <chinnu.l@orisys.in>', 'ടെസ്റ്റ് മെയിൽ', '<div dir=\"ltr\"><span style=\"font-size:12.8px\">ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  </span><span style=\"font-size:12.8px\">ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  </span><br><div class=\"gmail_extra\"><br><div class=\"gmail_quote\">On Mon, Oct 16, 2017 at 3:26 PM, Chinnu L <span dir=\"ltr\">&lt;<a href=\"mailto:chinnu.l@orisys.in\" target=\"_blank\">chinnu.l@orisys.in</a>&gt;</span> wrote:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\"><div dir=\"ltr\"><div>ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ് <br></div>-- <br><div class=\"gmail-m_-7751595880041415137gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div style=\"font-size:12.8px;font-family:verdana,sans-serif\"><br></div></div><div style=\"font-size:12.8px\"><div style=\"font-family:arial,sans-serif;font-size:12.8px\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\">Regards,<br><br></font></span></td></tr><tr><td style=\"border-bottom:1px solid rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-size:8pt;line-height:9pt\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\"><b><div style=\"display:inline\">​<br></div></b><font color=\"#000000\"><font style=\"font-size:12.8px;line-height:normal\">Chinnu L</font><font style=\"font-size:12.8px;line-height:normal\"> </font><font style=\"font-size:12.8px;line-height:normal\"> </font></font><b><div style=\"display:inline\"><br></div></b></font></span></td></tr><tr><td><span style=\"padding:0px;margin:0px;font-size:9pt\"><div style=\"display:inline\"><font face=\"verdana, sans-serif\"><div style=\"color:rgb(112,113,115);display:inline\">​</div><span style=\"font-size:12.8px;line-height:normal\"><font color=\"#444444\">Team Lead-Web Team</font></span><br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"239\" style=\"color:rgb(112,113,115);border-collapse:collapse;width:179pt\"><tbody><tr height=\"36\" style=\"height:27pt\"><td height=\"36\" align=\"right\" width=\"175\" style=\"height:27pt;width:131pt\"><img src=\"http://orisys.in/orisys_logo.png\"> <br></td><td align=\"right\" width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-size:10pt\"><b><div style=\"display:inline\">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style=\"display:inline\">​</div></b></span><span style=\"line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"line-height:9pt\"><div style=\"display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-size:10pt\"><b><div style=\"display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"display:inline\">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style=\"text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><div style=\"display:inline\">​   Mob   ​</div>:</td><td><div style=\"display:inline\">​<div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\">+91 (0) </span><div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​9995381265</div><span style=\"font-size:8pt;line-height:10pt\"> </span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Web   </div>:</td><td><div style=\"display:inline\">​​</div><div style=\"display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style=\"display:inline\">​   Blog  :​</div></td><td><div style=\"display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style=\"border-bottom:1px solid rgb(200,200,200)\"><font face=\"verdana, sans-serif\"><br></font></td></tr></tbody></table></div><div style=\"font-size:12.8px\"><div><div><font face=\"verdana, sans-serif\"> <br></font></div><font face=\"verdana, sans-serif\"><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>\r\n</div>\r\n</blockquote></div><br><br clear=\"all\"><div><br></div>-- <br><div class=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div dir=\"ltr\"><div><div style=\"font-size:12.8px;font-family:verdana,sans-serif\"><br></div></div><div style=\"font-size:12.8px\"><div style=\"font-family:arial,sans-serif;font-size:12.8px\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\">Regards,<br><br></font></span></td></tr><tr><td style=\"border-bottom:1px solid rgb(184,32,37)\"></td></tr><tr><td></td></tr><tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-size:8pt;line-height:9pt\"><tbody><tr><td><span style=\"padding:0px;margin:0px;font-size:10pt\"><font face=\"verdana, sans-serif\"><b><div style=\"display:inline\">​<br></div></b><font color=\"#000000\"><font style=\"font-size:12.8px;line-height:normal\">Chinnu L</font><font style=\"font-size:12.8px;line-height:normal\"> </font><font style=\"font-size:12.8px;line-height:normal\"> </font></font><b><div style=\"display:inline\"><br></div></b></font></span></td></tr><tr><td><span style=\"padding:0px;margin:0px;font-size:9pt\"><div style=\"display:inline\"><font face=\"verdana, sans-serif\"><div style=\"color:rgb(112,113,115);display:inline\">​</div><span style=\"font-size:12.8px;line-height:normal\"><font color=\"#444444\">Team Lead-Web Team</font></span><br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"239\" style=\"color:rgb(112,113,115);border-collapse:collapse;width:179pt\"><tbody><tr height=\"36\" style=\"height:27pt\"><td height=\"36\" align=\"right\" width=\"175\" style=\"height:27pt;width:131pt\"><img src=\"http://orisys.in/orisys_logo.png\"> <br></td><td align=\"right\" width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-size:10pt\"><b><div style=\"display:inline\">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style=\"display:inline\">​</div></b></span><span style=\"line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"line-height:9pt\"><div style=\"display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-size:10pt\"><b><div style=\"display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"display:inline\">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style=\"text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><div style=\"display:inline\">​   Mob   ​</div>:</td><td><div style=\"display:inline\">​<div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\">+91 (0) </span><div style=\"font-size:10.6667px;line-height:13.3333px;display:inline\">​9995381265</div><span style=\"font-size:8pt;line-height:10pt\"> </span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"display:inline\">​   Web   </div>:</td><td><div style=\"display:inline\">​​</div><div style=\"display:inline\">​</div><span style=\"font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style=\"display:inline\">​   Blog  :​</div></td><td><div style=\"display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style=\"border-bottom:1px solid rgb(200,200,200)\"><font face=\"verdana, sans-serif\"><br></font></td></tr></tbody></table></div><div style=\"font-size:12.8px\"><div><div><font face=\"verdana, sans-serif\"> <br></font></div><font face=\"verdana, sans-serif\"><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>\r\n</div></div>', '2017-10-19 11:31:35', 0, 1, NULL, NULL, NULL, '2017-10-19 06:01:49', '2018-10-15 05:44:42', NULL),
(133, 2, 53, 53, 'devika.devarajan@orisys.in', 'Devika Devarajan <devika.devarajan@orisys.in>', 'hai', '<div dir=\"ltr\"><div class=\"gmail_default\"><font face=\"verdana, sans-serif\">ചിട്ടിയി;ല്‍ എങ്ങനെ ചേരാം ?</font><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br></div><div class=\"gmail_default\" style=\"font-family:verdana,sans-serif\"><br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr style=\"font-size:9pt\"><td><span style=\"padding:0px;margin:0px;font-size:10pt\">Regards,<br><br></span></td></tr><tr style=\"font-size:9pt\"><td style=\"border-bottom:1px solid rgb(184,32,37)\"></td></tr><tr style=\"font-size:9pt\"><td></td></tr><tr style=\"font-size:9pt\"></tr></tbody></table></div><div><div class=\"gmail_signature\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><br><div style=\"font-size:12.8px\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><div dir=\"ltr\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"color:rgb(50,50,50);font-family:Arial,Helvetica,sans-serif;font-size:8pt;line-height:9pt\"><tbody><tr><td><font face=\"verdana, sans-serif\"><span style=\"font-size:13.3333px\"><b>Devika Devarajan</b></span></font><span style=\"color:rgb(112,113,115);font-family:verdana,sans-serif;font-size:12px\"><br>Software Tester<br></span><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"172\" style=\"border-collapse:collapse;width:129pt\"><tbody><tr height=\"20\" style=\"height:15pt\">\r\n<td height=\"20\" width=\"108\" style=\"height:15pt;width:81pt\"><img src=\"http://orisys.in/orisys_logo.png\"><br></td>\r\n<td width=\"64\" style=\"width:48pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"line-height:9pt;font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap\"><tbody><tr><td><span style=\"font-family:Arial,Helvetica,sans-serif;font-size:10pt\"><b><div style=\"font-family:verdana,sans-serif;display:inline\">  OrisysIndia Consultancy Services LLP​</div>.<br><div style=\"font-family:verdana,sans-serif;display:inline\">​</div></b></span><span style=\"font-family:verdana,sans-serif;line-height:normal;white-space:normal\"><div style=\"font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline\">​  </div><font color=\"#000000\" size=\"1\">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style=\"font-family:Arial,Helvetica,sans-serif;line-height:9pt\"><div style=\"font-family:verdana,sans-serif;display:inline\"><font color=\"#000000\" size=\"1\">​</font></div></span><span style=\"font-family:Arial,Helvetica,sans-serif;font-size:10pt\"><b><div style=\"font-family:verdana,sans-serif;display:inline\"><br></div></b></span></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​​   </div>Floor (-<div style=\"font-family:verdana,sans-serif;display:inline\">​2​</div>), Thejaswini, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, India, PIN 695 581</td></tr></tbody></table><br style=\"font-family:Arial,Helvetica,sans-serif;font-size:10.6667px;white-space:nowrap;line-height:4pt\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap;line-height:10pt\"><tbody><tr><td width=\"35\"><br></td><td><div style=\"font-family:verdana,sans-serif;display:inline\"><br></div></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Office ​</div>:</td><td>+91  <div style=\"font-family:verdana,sans-serif;display:inline\">​<span style=\"font-size:10.6667px;line-height:13.3333px\">​04714015757</span><br></div></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Web   </div>:</td><td><div style=\"font-family:verdana,sans-serif;display:inline\">​​</div><div style=\"font-family:verdana,sans-serif;display:inline\">​</div><span style=\"font-family:verdana,sans-serif;font-size:10.6667px;line-height:13.3333px\"><a href=\"http://www.orisys.in/\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.orisys.in</a>​</span></td></tr><tr><td><div style=\"font-family:verdana,sans-serif;display:inline\">​   Blog  :​</div></td><td><div style=\"font-family:verdana,sans-serif;display:inline\">​<a href=\"http://www.orisys.in/blog\" style=\"color:rgb(17,85,204)\" target=\"_blank\">www.orisys.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table><div style=\"color:rgb(34,34,34);font-size:12.8px;line-height:normal\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)\"><tbody><tr><td style=\"border-bottom:1px solid rgb(200,200,200)\"><br></td></tr></tbody></table></div><div style=\"color:rgb(34,34,34);font-size:12.8px;line-height:normal\"><div style=\"font-family:verdana,sans-serif\"><div> <br></div><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><span style=\"font-size:small\"></span></div></font><font color=\"#666666\" style=\"font-size:x-small\"><div style=\"text-align:center\"><div style=\"text-align:left\">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></div></div></td></tr><tr><td><br></td></tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>\r\n</div>', '2017-10-20 12:59:01', 0, 1, NULL, NULL, NULL, '2017-10-20 07:30:10', '2019-01-30 01:45:09', NULL),
(134, 2, 0, 53, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'hai', 'ചിട്ടിയി;ല്‍ എങ്ങനെ ചേരാം ?', '2017-10-20 13:01:06', 0, 1, NULL, NULL, NULL, '2017-10-20 07:31:06', '2019-01-30 01:45:09', NULL),
(135, 2, 0, 11, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'test mail', 'test', '2017-11-16 14:17:47', 0, 1, NULL, NULL, NULL, '2017-11-16 08:47:47', '2018-10-15 05:44:42', NULL);
INSERT INTO `ori_email_fetchs` (`id`, `cmpny_id`, `email_id`, `thread_id`, `from`, `from_name`, `subject`, `message`, `received_date`, `submit_status`, `read_status`, `answered`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(136, 2, 0, 11, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'test mail', 'test123', '2017-11-16 14:18:52', 0, 1, NULL, NULL, NULL, '2017-11-16 08:48:52', '2018-10-15 05:44:42', NULL),
(137, 2, 0, 11, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'SECURITIES GENERALLY ACCEPTED BY THE KSFE', '<p></p>\n<p>Dear&nbsp;[[ First Name ]],</p>\n<p></p>\n<p>As you requested, please see the details below&nbsp;</p>\n<p></p>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>SECURITIES GENERALLY ACCEPTED BY THE&nbsp;<i>KSFE</i></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>The&nbsp;<b>K</b>erala&nbsp;<b>S</b>tate&nbsp;<b>F</b>inancial&nbsp;<b>E</b>nterprises offers financial assistance under various Schemes. These schemes are listed below:<br><br>&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color=\"#006600\" style=\"color: #006600;\">Chitty Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consumer/Vehicle Loan</span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Special Car Loan</span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><br><br></span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KSFE Personal Loan</span></strong></span></p>\n<div align=\"justify\">\n<p><span color=\"#006600\" style=\"color: #006600;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gold Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trade Finance</span></strong></span></p>\n<p><span color=\"#006600\" style=\"color: #006600;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Flexy Trade Loan</span></strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KSFE Housing Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pass Book Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fixed Deposit Loan</span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;</span></span><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br>In addition to the above, the&nbsp;<strong>Chitty Scheme</strong>, which is the backbone of the Company, has an advance aspect built into it. The payment of prize money in chitties is actually an advance given to the subscriber by the Company.</span></p>\n</div>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Advances under all the above mentioned schemes can be made only against security of one type or the other, so as to ensure the repayment of the advance, along with interest. Thus in the context of&nbsp;<b><i>KSFE</i></b>&nbsp;advances, or for that matter; in the context of advances by any other institutions, securities can be defined as follows:</span></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">\"Anything, such as salary recovery undertaking, landed property, deposit receipts, etc., that is deposited or pledged as a guarantee for the fulfillment of an undertaking regarding the repayment of an advance, along with interest thereon, to be forfeited in case of default\".</span></p>\n</div>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The various types of securities accepted by the&nbsp;<b><i>KSFE</i></b>&nbsp;for its different schemes are the following:</span></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para1\">&nbsp;Personal Security&nbsp;</a></span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(Not applicable to Flexy Trade Loan and Special Car Loan</span><span color=\"#006600\" style=\"color: #006600;\">)<br></span><strong><span color=\"#006600\" style=\"color: #006600;\"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para2\">Fixed Deposits of KSFE and Other Bank Deposits</a></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para3\">Short Term Deposits of KSFE</a></span></strong></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deposit-in-Trust of KSFE</span></strong></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para4\">&nbsp;L.I.C. Policy</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para5\">Bank Guarantee</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para6\">&nbsp;Pass Book of Non-prized Chitties of KSFE</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para7\">National Savings Certificates VIII Issue</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para8\" target=\"_self\">Kissan Vikas Patra</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para9\">NRI Deposits</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para10\">Property Security</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para11\">Gold Ornaments</a></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para12\">Sugama Security&nbsp;</a></span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para13\">Combined Security</a></span></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>Details regarding these securities and an outline of &nbsp;&nbsp;the documentation involved are given below:<br><br><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para1\"></a>PERSONAL SECURITY&nbsp;</span></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>&nbsp;</b><br><br>Personal security is accepted for future liability upto Rs.12-lakhs. Employees of Central/ State/ Quasi-Government Departments/ Undertakings, employees of Government / Aided schools/ Plus two schools, colleges and employees of Nationalised/ Scheduled Banks and certain Co-operative institutions are generally accepted as sureties by the Company for&nbsp; its various schemes.&nbsp;<br></span></p>\n</div>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>1. SALARY AND MINIMUM SALARY</b></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;salary&rdquo; for this purpose include Basic pay plus D.A. (Dearness Allowance) and adhoc DA/increase and P.P (Personal Pay), if any.</span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;Minimum Salary\"</span><br><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp; Only full-time permanent employees who are drawing a minimum net-salary&nbsp; of Rs.5000/- will be accepted as sureties/guarantors.</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\">2. CLASSIFICATION OF SURETIES</span></b></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SREG&rdquo; (Salary Recovery Enforceable Group)<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SRNEG (Salary Recovery Non-Enforceable Group)</span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><br><br><span color=\"#006600\" style=\"color: #006600;\">3. Salary Requirement Norms&nbsp;</span></b></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SREG employees:The SREG surety (s)/guarantor(s) offered should have a minimum/combined salary of 10% of the future liability.<br><br>b)&nbsp; &nbsp;SRNEG employees:<br><br>The SRNEG surety(s)/guarantor(s) offered should have a minimum/combined salary of 12.5% of the future liability.<br><br>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Combination of Sureties/guarantors<br><br>When SREG employee and SRNEG employee are jointly offered as sureties/ guarantors they should have a combined minimum salary of 12.5% of the future liability.</span></p>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>4.&nbsp; General Conditions.</b></span><br><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(a)&nbsp;&nbsp; Sureties should be permanent residents of and working in Kerala State.<br><br>(b)&nbsp; They should be permanent/ officiating full time employees.<br><br>(c)&nbsp; The sureties should have at least&nbsp; 6 months service left for retirement after the termination of&nbsp; the period of liability.<br><br><strong><span color=\"#006600\" style=\"color: #006600;\">SELF SURETY</span></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>SREG and SRNEG employees who are chitty subscribers/Loanees can avail of the facility of self surety/guarantee, up to a liability of Rs.3,00,000/- in all schemes, with minimum net-salary of Rs.5000/- on the condition that total recovery of the applicant doesnot exceed 60% including the monthly gross instalment amount of the chitty/loan/advance applied for. However for future liability upto Rs.4,00,000/- ,personal surety is accepted on the basis of salary certificate as well as marks as per score card.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>SINGLE SURETY<br></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><br></strong>Single surety is accepted in all the schemes:<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(a) Upto a liability of Rs. 300,000/- if the principal debtor is unemployed, provided the surety is from SREG with minimum net-salary of Rs.5000/-.on the condition that total recovery of the surety doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.<br><br></span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(b) Upto a liability of Rs.700000/-, where the principal debtor is from SREG, provided both the principal debtor and surety have separate minimum net-salary of Rs.5000/-.on the condition that total recovery of the principal debtor doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.</span></p>\n<p>&nbsp;</p>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>I.&nbsp;&nbsp;&nbsp;<a name=\"para2\"></a>FIXED DEPOSIT</strong></span><br><br></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Fixed deposits with Nationalised Banks, Scheduled Banks, District Co-operative Banks, Co-operative Banks or any other Banks, having deposit insurance coverage and fixed deposits with&nbsp;<b><i>KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>II.<a name=\"para3\"></a>&nbsp;&nbsp;SHORT TERM DEPOSIT</strong></span><br><br></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Short Term deposits with<b><i>&nbsp;KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>\n</div>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para4\"></a>III.&nbsp;&nbsp; L.I.C POLICY</span><br><br></b></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">LIC Policies, the surrender value of which, are equal to the future liability of the loan/chitty can be accepted as security. The LIC policy accepted as security in such cases can be in the name of applicant/subscriber or in the name of spouse or in the name of any other person. In such cases the policy should be assigned in favour of the company and the policy holder should be a co-bounden in the agreement.</span></p>\n</div>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><a name=\"para5\"></a>IV.&nbsp;BANK GUARANTEE</strong></span><br><br></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Government Securities and Bank Guarantee can be accepted as valid security. The Bank Guarantee should cover an amount equal to one instalment more than the future liability. Also it should be valid for a period not less than three months after the termination of the liability.</span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para6\"></a>V.&nbsp;&nbsp;PASS BOOK OF NON-PRIZED CHITTIES</span></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>The Passbook of non-prized chitties can be accepted as security for the future liability of schemes.</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br></span></p>\n</div>\n<div align=\"justify\"></div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para7\"></a>VI.&nbsp;&nbsp; NATIONAL SAVINGS CERTIFICATE (VIII ISSUE)</span><br><br></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">NSC will be accepted as valid security, on the following conditions:<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">At the time of acceptance, the issue price (face value) of the NSC&rsquo;s (VIII issue), should cover the future liability, ie. principal plus interest in case of advances and sum total of future instalments in the case of chitties. The interest for the loan amount is to be calculated till the maturity of the instrument or the remaining period of loan, whichever is longer.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Forms prescribed by the Post Office are used for noting the lien.<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para8\"></a>VII.&nbsp;&nbsp;&nbsp;KISSAN VIKAS PATRA</span><br><br></b></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The future liability for which Kisan Vikas Patra can be accepted as security is determined as follows:</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>1.&nbsp;&nbsp; In case the Kissan Vikas Patra is offered as security before the expiry of 30 months after the issue of the&nbsp;&nbsp;&nbsp; same, the certificate will be accepted for a future liability not exceeding 75% of the value of the certificate (i.e, purchase price).</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br clear=\"all\"></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">2.&nbsp; If the Kissan Vikas Patra is offered as security after 30 months (i.e, expiry of lock in period) of the issue of the same, the certificate will be accepted as security for future liability worth the premature closure value of the certificate on the date of acceptance of the same as security.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><a name=\"para9\"></a>VIII.&nbsp;&nbsp; N.R.I. DEPOSITS</strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>The NRI, NRO, FCNR and NRNR deposits can be accepted as security to our various schemes, provided.</span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br>a)&nbsp; The deposit receipts are properly discharged and company&rsquo;s lien noted on it.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">b)&nbsp; The Bank, in which the&nbsp; deposit is kept, agrees to close it and make required payment to&nbsp;&nbsp;&nbsp;<b><i>KSFE</i></b>. even &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;before maturity, on demand.<br><a name=\"para10\"></a><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">IX.&nbsp;&nbsp;&nbsp; PROPERTY SECURITY</span><br><br></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Property security inside the State of Kerala can be accepted as security, provided the title of the owner over the property is clear. The following documents will have to be presented while submitting property as security.</span>&nbsp;<br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title Deeds and prior documents in original (for the past 13 years)</span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><strong><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Encumbrance certificate for the past 13 years</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Land Tax Receipt for the current year</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Building Tax Receipt, if there is a building on the property.&nbsp;</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Possession and enjoyment certificate</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location Certificate and Sketch of the property.</span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"></span></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para11\"></a>X.&nbsp;&nbsp;&nbsp; GOLD SECURITY</span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Gold ornaments can be accepted as security towards future liablity in all schemes.</span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para12\"></a>XI.&nbsp;&nbsp;&nbsp; SUGAMA SECURITY</span></strong></span></p>\n<p><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" color=\"#006600\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"></span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Outstanding balance in Sugama account can be accepted as security for future liability in chitty/loan schemes. The deposit amount should at least cover the future liability. For the balance in Sugama Security account, interest @ 5.5% will be allowed. Monthly instalment can be adjusted from the account. The main advantage of the scheme is that the customer can release his documents pledged and also earn interest on the amount outstanding in this account.</span></p>\n</div>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><a name=\"para13\"></a>XII.&nbsp;&nbsp;&nbsp;COMBINED SECURITY</strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>A subscriber/loanee is allowed to offer one or more types of acceptable security at a time, in combination, subject to certain rules and regulations.</span></p>\n</div>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\">Norms for our Schemes</span><br><br></b></span></p>\n<table border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n<tbody>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/chitty.htm\">Chitty</a></b></span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of future liability (instalments to be remitted) in the case of&nbsp;&nbsp; SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination.</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/chittyloan.htm\">New Chitty Loan</a></b></span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of loan amount in case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/vechile.htm\">Consumer/ Vehicle Loan</a></b></span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of future liability (Advance + Finance charge) in the case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" height=\"24\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/trade.htm\">Trade Financing Scheme</a></b></span>&nbsp;<span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;</span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of loan amount of SREG sureties.</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/customer.htm\">Reliable Customer Loan</a></b></span>&nbsp;<span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;</span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The amount to be secured under RCL will be the future liability i.e. principal plus interest. There are no separate security norms.</span></td>\n</tr>\n</tbody>\n</table>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The security norms in vogue are applicable. However mutual surety will not be accepted.&nbsp; In the case of immovable property immovable property valuation is half times of the market value..</span></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The applicant should execute a loan agreement on stamp paper worth Rs.200/- in the prescribed format.</span></p>\n</div>', '2017-11-17 15:35:19', 0, 1, NULL, NULL, NULL, '2017-11-17 10:05:19', '2018-10-15 05:44:42', NULL),
(138, 2, 0, 11, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'test', '<p><span>Hi Arun Jaganathan <arun.jaganathan@orisys.in></span></p>\n<p><span></span></p>\n<p><span></span></p>\n<table border=\"1\" style=\"border-color: #4c4c4c; width: 100%;\">\n<tbody>\n<tr><th>Chit Name</th><th>Amount</th><th>Installment</th><th>Sub Amount</th><th>Announce Date</th><th>Duration</th></tr>\n<tr>\n<td>KSFE NRI CHIT17</td>\n<td>900000.00</td>\n<td>90</td>\n<td>10000</td>\n<td>10/10/2018</td>\n<td>Monthly</td>\n</tr>\n</tbody>\n</table>', '2017-11-17 15:43:56', 0, 1, NULL, NULL, NULL, '2017-11-17 10:13:56', '2018-10-15 05:44:42', NULL);
INSERT INTO `ori_email_fetchs` (`id`, `cmpny_id`, `email_id`, `thread_id`, `from`, `from_name`, `subject`, `message`, `received_date`, `submit_status`, `read_status`, `answered`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(139, 2, 0, 53, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'SECURITIES GENERALLY ACCEPTED BY THE KSFE  updated', '<p></p>\n<p>Dear&nbsp;Devika Devarajan <devika.devarajan@orisys.in>,</p>\n<p></p>\n<p>As you requested, please see the details below&nbsp;</p>\n<p></p>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>SECURITIES GENERALLY ACCEPTED BY THE&nbsp;<i>KSFE</i></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>The&nbsp;<b>K</b>erala&nbsp;<b>S</b>tate&nbsp;<b>F</b>inancial&nbsp;<b>E</b>nterprises offers financial assistance under various Schemes. These schemes are listed below:<br><br>&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color=\"#006600\" style=\"color: #006600;\">Chitty Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consumer/Vehicle Loan</span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Special Car Loan</span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><br><br></span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KSFE Personal Loan</span></strong></span></p>\n<div align=\"justify\">\n<p><span color=\"#006600\" style=\"color: #006600;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gold Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trade Finance</span></strong></span></p>\n<p><span color=\"#006600\" style=\"color: #006600;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Flexy Trade Loan</span></strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KSFE Housing Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pass Book Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fixed Deposit Loan</span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;</span></span><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br>In addition to the above, the&nbsp;<strong>Chitty Scheme</strong>, which is the backbone of the Company, has an advance aspect built into it. The payment of prize money in chitties is actually an advance given to the subscriber by the Company.</span></p>\n</div>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Advances under all the above mentioned schemes can be made only against security of one type or the other, so as to ensure the repayment of the advance, along with interest. Thus in the context of&nbsp;<b><i>KSFE</i></b>&nbsp;advances, or for that matter; in the context of advances by any other institutions, securities can be defined as follows:</span></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">\"Anything, such as salary recovery undertaking, landed property, deposit receipts, etc., that is deposited or pledged as a guarantee for the fulfillment of an undertaking regarding the repayment of an advance, along with interest thereon, to be forfeited in case of default\".</span></p>\n</div>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The various types of securities accepted by the&nbsp;<b><i>KSFE</i></b>&nbsp;for its different schemes are the following:</span></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para1\">&nbsp;Personal Security&nbsp;</a></span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(Not applicable to Flexy Trade Loan and Special Car Loan</span><span color=\"#006600\" style=\"color: #006600;\">)<br></span><strong><span color=\"#006600\" style=\"color: #006600;\"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para2\">Fixed Deposits of KSFE and Other Bank Deposits</a></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para3\">Short Term Deposits of KSFE</a></span></strong></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deposit-in-Trust of KSFE</span></strong></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para4\">&nbsp;L.I.C. Policy</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para5\">Bank Guarantee</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para6\">&nbsp;Pass Book of Non-prized Chitties of KSFE</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para7\">National Savings Certificates VIII Issue</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para8\" target=\"_self\">Kissan Vikas Patra</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para9\">NRI Deposits</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para10\">Property Security</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para11\">Gold Ornaments</a></span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para12\">Sugama Security&nbsp;</a></span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.ksfe.com/securities.htm#para13\">Combined Security</a></span></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>Details regarding these securities and an outline of &nbsp;&nbsp;the documentation involved are given below:<br><br><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para1\"></a>PERSONAL SECURITY&nbsp;</span></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>&nbsp;</b><br><br>Personal security is accepted for future liability upto Rs.12-lakhs. Employees of Central/ State/ Quasi-Government Departments/ Undertakings, employees of Government / Aided schools/ Plus two schools, colleges and employees of Nationalised/ Scheduled Banks and certain Co-operative institutions are generally accepted as sureties by the Company for&nbsp; its various schemes.&nbsp;<br></span></p>\n</div>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>1. SALARY AND MINIMUM SALARY</b></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;salary&rdquo; for this purpose include Basic pay plus D.A. (Dearness Allowance) and adhoc DA/increase and P.P (Personal Pay), if any.</span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;Minimum Salary\"</span><br><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp; Only full-time permanent employees who are drawing a minimum net-salary&nbsp; of Rs.5000/- will be accepted as sureties/guarantors.</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\">2. CLASSIFICATION OF SURETIES</span></b></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SREG&rdquo; (Salary Recovery Enforceable Group)<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SRNEG (Salary Recovery Non-Enforceable Group)</span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><br><br><span color=\"#006600\" style=\"color: #006600;\">3. Salary Requirement Norms&nbsp;</span></b></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SREG employees:The SREG surety (s)/guarantor(s) offered should have a minimum/combined salary of 10% of the future liability.<br><br>b)&nbsp; &nbsp;SRNEG employees:<br><br>The SRNEG surety(s)/guarantor(s) offered should have a minimum/combined salary of 12.5% of the future liability.<br><br>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Combination of Sureties/guarantors<br><br>When SREG employee and SRNEG employee are jointly offered as sureties/ guarantors they should have a combined minimum salary of 12.5% of the future liability.</span></p>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>4.&nbsp; General Conditions.</b></span><br><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(a)&nbsp;&nbsp; Sureties should be permanent residents of and working in Kerala State.<br><br>(b)&nbsp; They should be permanent/ officiating full time employees.<br><br>(c)&nbsp; The sureties should have at least&nbsp; 6 months service left for retirement after the termination of&nbsp; the period of liability.<br><br><strong><span color=\"#006600\" style=\"color: #006600;\">SELF SURETY</span></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>SREG and SRNEG employees who are chitty subscribers/Loanees can avail of the facility of self surety/guarantee, up to a liability of Rs.3,00,000/- in all schemes, with minimum net-salary of Rs.5000/- on the condition that total recovery of the applicant doesnot exceed 60% including the monthly gross instalment amount of the chitty/loan/advance applied for. However for future liability upto Rs.4,00,000/- ,personal surety is accepted on the basis of salary certificate as well as marks as per score card.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>SINGLE SURETY<br></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><br></strong>Single surety is accepted in all the schemes:<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(a) Upto a liability of Rs. 300,000/- if the principal debtor is unemployed, provided the surety is from SREG with minimum net-salary of Rs.5000/-.on the condition that total recovery of the surety doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.<br><br></span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">(b) Upto a liability of Rs.700000/-, where the principal debtor is from SREG, provided both the principal debtor and surety have separate minimum net-salary of Rs.5000/-.on the condition that total recovery of the principal debtor doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.</span></p>\n<p>&nbsp;</p>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>I.&nbsp;&nbsp;&nbsp;<a name=\"para2\"></a>FIXED DEPOSIT</strong></span><br><br></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Fixed deposits with Nationalised Banks, Scheduled Banks, District Co-operative Banks, Co-operative Banks or any other Banks, having deposit insurance coverage and fixed deposits with&nbsp;<b><i>KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong>II.<a name=\"para3\"></a>&nbsp;&nbsp;SHORT TERM DEPOSIT</strong></span><br><br></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Short Term deposits with<b><i>&nbsp;KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>\n</div>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para4\"></a>III.&nbsp;&nbsp; L.I.C POLICY</span><br><br></b></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">LIC Policies, the surrender value of which, are equal to the future liability of the loan/chitty can be accepted as security. The LIC policy accepted as security in such cases can be in the name of applicant/subscriber or in the name of spouse or in the name of any other person. In such cases the policy should be assigned in favour of the company and the policy holder should be a co-bounden in the agreement.</span></p>\n</div>\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><a name=\"para5\"></a>IV.&nbsp;BANK GUARANTEE</strong></span><br><br></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Government Securities and Bank Guarantee can be accepted as valid security. The Bank Guarantee should cover an amount equal to one instalment more than the future liability. Also it should be valid for a period not less than three months after the termination of the liability.</span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para6\"></a>V.&nbsp;&nbsp;PASS BOOK OF NON-PRIZED CHITTIES</span></strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>The Passbook of non-prized chitties can be accepted as security for the future liability of schemes.</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br></span></p>\n</div>\n<div align=\"justify\"></div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para7\"></a>VI.&nbsp;&nbsp; NATIONAL SAVINGS CERTIFICATE (VIII ISSUE)</span><br><br></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">NSC will be accepted as valid security, on the following conditions:<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">At the time of acceptance, the issue price (face value) of the NSC&rsquo;s (VIII issue), should cover the future liability, ie. principal plus interest in case of advances and sum total of future instalments in the case of chitties. The interest for the loan amount is to be calculated till the maturity of the instrument or the remaining period of loan, whichever is longer.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Forms prescribed by the Post Office are used for noting the lien.<br><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para8\"></a>VII.&nbsp;&nbsp;&nbsp;KISSAN VIKAS PATRA</span><br><br></b></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The future liability for which Kisan Vikas Patra can be accepted as security is determined as follows:</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>1.&nbsp;&nbsp; In case the Kissan Vikas Patra is offered as security before the expiry of 30 months after the issue of the&nbsp;&nbsp;&nbsp; same, the certificate will be accepted for a future liability not exceeding 75% of the value of the certificate (i.e, purchase price).</span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br clear=\"all\"></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">2.&nbsp; If the Kissan Vikas Patra is offered as security after 30 months (i.e, expiry of lock in period) of the issue of the same, the certificate will be accepted as security for future liability worth the premature closure value of the certificate on the date of acceptance of the same as security.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><a name=\"para9\"></a>VIII.&nbsp;&nbsp; N.R.I. DEPOSITS</strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>The NRI, NRO, FCNR and NRNR deposits can be accepted as security to our various schemes, provided.</span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br>a)&nbsp; The deposit receipts are properly discharged and company&rsquo;s lien noted on it.<br></span></p>\n</div>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">b)&nbsp; The Bank, in which the&nbsp; deposit is kept, agrees to close it and make required payment to&nbsp;&nbsp;&nbsp;<b><i>KSFE</i></b>. even &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;before maturity, on demand.<br><a name=\"para10\"></a><br></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">IX.&nbsp;&nbsp;&nbsp; PROPERTY SECURITY</span><br><br></strong></span><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Property security inside the State of Kerala can be accepted as security, provided the title of the owner over the property is clear. The following documents will have to be presented while submitting property as security.</span>&nbsp;<br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title Deeds and prior documents in original (for the past 13 years)</span></strong></span><span color=\"#006600\" style=\"color: #006600;\"><strong><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Encumbrance certificate for the past 13 years</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Land Tax Receipt for the current year</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Building Tax Receipt, if there is a building on the property.&nbsp;</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Possession and enjoyment certificate</span><br><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location Certificate and Sketch of the property.</span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"></span></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para11\"></a>X.&nbsp;&nbsp;&nbsp; GOLD SECURITY</span></strong></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Gold ornaments can be accepted as security towards future liablity in all schemes.</span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><span color=\"#006600\" style=\"color: #006600;\"><a name=\"para12\"></a>XI.&nbsp;&nbsp;&nbsp; SUGAMA SECURITY</span></strong></span></p>\n<p><strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" color=\"#006600\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"></span></strong><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Outstanding balance in Sugama account can be accepted as security for future liability in chitty/loan schemes. The deposit amount should at least cover the future liability. For the balance in Sugama Security account, interest @ 5.5% will be allowed. Monthly instalment can be adjusted from the account. The main advantage of the scheme is that the customer can release his documents pledged and also earn interest on the amount outstanding in this account.</span></p>\n</div>\n<div align=\"justify\">\n<p><span color=\"#006600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><strong><a name=\"para13\"></a>XII.&nbsp;&nbsp;&nbsp;COMBINED SECURITY</strong></span>&nbsp;<span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><br><br>A subscriber/loanee is allowed to offer one or more types of acceptable security at a time, in combination, subject to certain rules and regulations.</span></p>\n</div>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><span color=\"#006600\" style=\"color: #006600;\">Norms for our Schemes</span><br><br></b></span></p>\n<table border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n<tbody>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b>a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/chitty.htm\">Chitty</a></b></span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of future liability (instalments to be remitted) in the case of&nbsp;&nbsp; SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination.</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/chittyloan.htm\">New Chitty Loan</a></b></span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of loan amount in case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/vechile.htm\">Consumer/ Vehicle Loan</a></b></span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of future liability (Advance + Finance charge) in the case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" height=\"24\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/trade.htm\">Trade Financing Scheme</a></b></span>&nbsp;<span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;</span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">10% of loan amount of SREG sureties.</span></td>\n</tr>\n<tr valign=\"middle\" bgcolor=\"#D9FFF2\">\n<td width=\"66\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>\n<td class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"><b><a href=\"http://www.ksfe.com/customer.htm\">Reliable Customer Loan</a></b></span>&nbsp;<span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">&nbsp;</span></td>\n<td width=\"304\" class=\"Normal\"><span size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The amount to be secured under RCL will be the future liability i.e. principal plus interest. There are no separate security norms.</span></td>\n</tr>\n</tbody>\n</table>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The security norms in vogue are applicable. However mutual surety will not be accepted.&nbsp; In the case of immovable property immovable property valuation is half times of the market value..</span></p>\n<div align=\"justify\">\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">The applicant should execute a loan agreement on stamp paper worth Rs.200/- in the prescribed format.</span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\">Devika Devarajan <devika.devarajan@orisys.in></span></p>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"></span></p>\n<table border=\"1\" style=\"border-color: #4c4c4c; width: 100%;\">\n<tbody>\n<tr><th>Chit Name</th><th>Amount</th><th>Installment</th><th>Sub Amount</th><th>Announce Date</th><th>Duration</th></tr>\n<tr>\n<td>NRI CHIT17/22</td>\n<td>360000.00</td>\n<td>36</td>\n<td>10000</td>\n<td>10/10/2018</td>\n<td>Monthly</td>\n</tr>\n</tbody>\n</table>\n<p><span face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;\"></span></p>\n</div>', '2017-11-21 12:29:24', 0, 1, NULL, NULL, NULL, '2017-11-21 06:59:24', '2019-01-30 01:45:09', NULL),
(140, 2, 0, 53, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'I hear that now a days KSFE Chitty scheme opens its door to NRI\'s also?', '<p><span>Yes. Now NRI\'s can also join chitties offered by KSFE as per notification no. 227 dated 13/4/2015 in the gazette of government of India. For this, they may go through the various denominations of chitties offered by our various Branches and select the type for their requirement. Then they may download the chitty application form, which can be obtained from our website. Take the printout in duplicate and fill up the personal details called for in the last page of the application form. After putting signature on both forms, they may send them to the concerned branches. The address and phone number of branches are provided in our website. The amount for first installment may be transferred by the mode internet banking, money transfer service of WUMT/Xpress Money, for which KSFE has an agreement. The installment can also be remitted directly in the branch in cash/cheque on behalf of the subscriber. For internet banking, the account no. and IFSC code of the branches may be obtained by contacting the concerned branch over phone or email.</span></p>', '2017-11-21 12:43:16', 0, 1, NULL, NULL, NULL, '2017-11-21 07:13:16', '2019-01-30 01:45:09', NULL),
(141, 2, 0, 53, 'oriesmarti@gmail.com', 'KSFE <oriesmarti@gmail.com>', 'I hear that now a days KSFE Chitty scheme opens its door to NRI\'s also?', '<p>Hi&nbsp;Devika Devarajan <devika.devarajan@orisys.in></p>\n<p>Yes. Now NRI\'s can also join chitties offered by KSFE as per notification no. 227 dated 13/4/2015 in the gazette of government of India. For this, they may go through the various denominations of chitties offered by our various Branches and select the type for their requirement. Then they may download the chitty application form, which can be obtained from our website. Take the printout in duplicate and fill up the personal details called for in the last page of the application form. After putting signature on both forms, they may send them to the concerned branches. The address and phone number of branches are provided in our website. The amount for first installment may be transferred by the mode internet banking, money transfer service of WUMT/Xpress Money, for which KSFE has an agreement. The installment can also be remitted directly in the branch in cash/cheque on behalf of the subscriber. For internet banking, the account no. and IFSC code of the branches may be obtained by contacting the concerned branch over phone or email.</p>\n<p>Thank You</p>\n<p>Devika Devarajan <devika.devarajan@orisys.in> Devika Devarajan <devika.devarajan@orisys.in>&nbsp;</p>', '2017-11-21 12:49:33', 0, 1, NULL, NULL, NULL, '2017-11-21 07:19:33', '2019-01-30 01:45:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_email_fetchs_attachments`
--

CREATE TABLE `ori_email_fetchs_attachments` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `attachment_id` bigint(20) NOT NULL COMMENT 'id in cc_email_fetchs',
  `file_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_email_fetchs_attachments`
--

INSERT INTO `ori_email_fetchs_attachments` (`id`, `cmpny_id`, `attachment_id`, `file_name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 5, '5-Fairy-forest (1).jpg', NULL, NULL, '2017-08-09 04:42:30', '2018-10-15 05:45:07', NULL),
(2, 2, 6, '6-sightsavers (2).sql', NULL, NULL, '2017-08-09 04:42:31', '2018-10-15 05:45:07', NULL),
(3, 2, 6, '6-login (2).sql', NULL, NULL, '2017-08-09 04:42:31', '2018-10-15 05:45:07', NULL),
(4, 2, 7, '7-sightsavers.sql', NULL, NULL, '2017-08-09 04:42:32', '2018-10-15 05:45:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_faqs`
--

CREATE TABLE `ori_faqs` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `query_type_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `faq_cat_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `query_title_lang1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query_title_lang2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_lang1` text COLLATE utf8mb4_unicode_ci,
  `question_lang2` text COLLATE utf8mb4_unicode_ci,
  `answer_lang1` text COLLATE utf8mb4_unicode_ci,
  `answer_lang2` text COLLATE utf8mb4_unicode_ci,
  `answer_lang1_short` text COLLATE utf8mb4_unicode_ci,
  `answer_lang2_short` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `added_from` int(11) DEFAULT NULL COMMENT '1:web, 2:web import',
  `filename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `show_in_chat_auto_reply` int(11) NOT NULL DEFAULT '2' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_faqs`
--

INSERT INTO `ori_faqs` (`id`, `cmpny_id`, `query_type_id`, `faq_cat_id`, `query_title_lang1`, `query_title_lang2`, `question_lang1`, `question_lang2`, `answer_lang1`, `answer_lang2`, `answer_lang1_short`, `answer_lang2_short`, `keywords`, `added_from`, `filename`, `sort_order`, `status`, `show_in_chat_auto_reply`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 5, NULL, NULL, 'how can i contact you?', NULL, '<p>how can i contact you?</p>', NULL, '<p>Please contact with www.oricoms.com</p>', NULL, 'Please contact with www.oricoms.com', 'how can i contact you?', NULL, NULL, 1, 1, 2, 2, 2, '2018-11-14 23:34:13', '2019-01-24 03:11:31', NULL),
(2, 2, 6, NULL, NULL, 'how to solve technical issue on registration form?', NULL, '<p>how to solve technical issue on registration form?</p>', NULL, '<p>Please clear your website cache</p>', NULL, 'Please clear your website cache', 'how to solve technical issue on registration form?', NULL, NULL, 1, 1, 2, 2, 2, '2018-11-14 23:37:28', '2019-01-24 03:13:19', NULL),
(3, 2, 6, 2, 'hhhhhhhhhhh', NULL, '<p>ghjgg</p>', '<p>ghjgg</p>', '<p>hj</p>', '<p>hj</p>', NULL, NULL, 'hhhhhhhhhhh', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 03:19:44', '2019-01-24 03:19:44', NULL),
(4, 2, 5, 2, 'ela', NULL, '<p>ttttttttttttttt</p>', '<p>ttttttttttttttt</p>', '<p>ttttttttttttttttttttttt</p>', '<p>ttttttttttttttttttttttt</p>', NULL, NULL, 'ela', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 03:24:38', '2019-01-24 03:24:38', NULL),
(5, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:09:26', '2019-01-24 05:09:26', NULL),
(6, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:09:47', '2019-01-24 05:09:47', NULL),
(7, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:09:58', '2019-01-24 05:09:58', NULL),
(8, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:11:02', '2019-01-24 05:11:02', NULL),
(9, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:11:34', '2019-01-24 05:11:34', NULL),
(10, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:12:00', '2019-01-24 05:12:00', NULL),
(11, 2, 5, 1, 'wewee', NULL, '<p>weew&nbsp;</p>', '<p>weew&nbsp;</p>', '<p>wewe&nbsp;</p>', '<p>wewe&nbsp;</p>', NULL, NULL, 'wewee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:12:21', '2019-01-24 05:12:21', NULL),
(12, 2, 5, 2, 'eee', NULL, '<p>fhfhg</p>', '<p>fhfhg</p>', '<p>fghgh&nbsp;</p>', '<p>fghgh&nbsp;</p>', NULL, NULL, 'eee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:14:08', '2019-01-24 05:14:08', NULL),
(13, 2, 5, 2, 'eee', NULL, '<p>fhfhg</p>', '<p>fhfhg</p>', '<p>fghgh&nbsp;</p>', '<p>fghgh&nbsp;</p>', NULL, NULL, 'eee', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:14:32', '2019-01-24 05:14:32', NULL),
(14, 2, 5, 2, 'bbbb', NULL, '<p>dfgdg</p>', '<p>dfgdg</p>', '<p>dfg</p>', '<p>dfg</p>', NULL, NULL, 'bbbb', NULL, NULL, 1, 2, 2, 2, 2, '2019-01-24 05:45:02', '2019-01-24 05:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_details`
--

CREATE TABLE `ori_fb_details` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `reference_id` int(11) DEFAULT NULL COMMENT 'For Web reference id should be taken from followup table id, for chat reference id should be threadid',
  `thread_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_chat_thread',
  `call_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'only for ivr',
  `fb_type` int(11) DEFAULT NULL COMMENT 'Refered from ori_channels',
  `comments` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_details_log`
--

CREATE TABLE `ori_fb_details_log` (
  `id` bigint(20) NOT NULL,
  `fb_det_id` bigint(20) DEFAULT NULL COMMENT 'referred from ori_fb_details',
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `reference_id` int(11) DEFAULT NULL COMMENT 'For Web reference id should be taken from followup table id, for chat reference id should be threadid',
  `thread_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_chat_thread',
  `call_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'only for ivr',
  `fb_type` int(11) DEFAULT NULL COMMENT 'Refered from ori_channels',
  `comments` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_feedback_request`
--

CREATE TABLE `ori_fb_feedback_request` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) NOT NULL COMMENT 'Referred from cc_customer_profile',
  `helpdesk_id` int(11) DEFAULT NULL COMMENT 'refers ori_helpdesk',
  `fb_type` int(11) DEFAULT NULL COMMENT 'Refered from ori_channels',
  `action_time` datetime DEFAULT NULL,
  `common_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_common_sms_email',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_questions`
--

CREATE TABLE `ori_fb_questions` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `feedback_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_fb_settings',
  `eng_qstn_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_questions',
  `mal_qstn_id` int(11) DEFAULT NULL COMMENT 'Referred from fReferre from ori_questions',
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_question_details`
--

CREATE TABLE `ori_fb_question_details` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `fb_det_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_fb_details',
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_question_details_log`
--

CREATE TABLE `ori_fb_question_details_log` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `fb_question_id` bigint(20) DEFAULT NULL COMMENT 'Reffered from ori_fb_question_details',
  `fb_det_id` bigint(20) DEFAULT NULL COMMENT 'Referred from fb_details',
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_fb_settings`
--

CREATE TABLE `ori_fb_settings` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `question_ids` text COLLATE utf8mb4_unicode_ci,
  `fb_type` int(11) DEFAULT NULL COMMENT '1- SMS,2- Email',
  `query_type` int(11) DEFAULT NULL,
  `fb_status` text COLLATE utf8mb4_unicode_ci,
  `action_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'action time should be in minute',
  `action_type` int(11) DEFAULT NULL COMMENT '1- Hour, 2 - Minute',
  `is_comment` int(11) NOT NULL DEFAULT '2' COMMENT '1- Need Comment Box , 2 - no need comment  box',
  `is_rating` int(11) NOT NULL DEFAULT '2' COMMENT '1- Need  rating feature, 2 - no need rating',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_field_types`
--

CREATE TABLE `ori_field_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expression` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_length` int(11) DEFAULT NULL,
  `max_length` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_field_types`
--

INSERT INTO `ori_field_types` (`id`, `name`, `type`, `expression`, `min_length`, `max_length`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'text', 'text', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'dropdown', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'mobile', 'text', '[a-zA-Z0-9-]+', 3, 13, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'email', 'email', '[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'datepicker', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'datetime', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'timepicker', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'textarea', 'textarea', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'checkbox', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'radio', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'multiselect', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'url', 'text', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'aadhar', 'text', '[a-zA-Z0-9-]+', 12, 12, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'pancard', 'text', '[a-zA-Z0-9-]+', 10, 10, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'passport', 'text', '[a-zA-Z0-9-]+', 8, 12, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_groups`
--

CREATE TABLE `ori_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_count` int(11) NOT NULL DEFAULT '0',
  `stage_id` int(11) DEFAULT NULL COMMENT 'cmp_automated_process:parent_id',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Processing',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_groups`
--

INSERT INTO `ori_groups` (`id`, `cmpny_id`, `name`, `total_count`, `stage_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Orisys Group 1', 2, NULL, 1, 2, 2, '2018-11-20 23:13:32', '2018-11-21 04:44:33', NULL),
(2, 2, 'Orisys Group 2', 0, NULL, 1, 2, 2, '2018-11-20 23:15:45', '2018-11-20 23:15:45', NULL),
(3, 2, 'Orisys Test Excel Group', 0, NULL, 1, 2, 2, '2018-12-04 22:49:03', '2018-12-04 22:49:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_group_contacts`
--

CREATE TABLE `ori_group_contacts` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_group_contacts`
--

INSERT INTO `ori_group_contacts` (`id`, `cmpny_id`, `group_id`, `contact_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 1, 2, 2, '2018-11-21 04:44:30', '2018-11-21 04:44:30', NULL),
(2, 2, 1, 2, 1, 2, 2, '2018-11-21 04:44:31', '2018-11-21 04:44:31', NULL),
(3, 2, 2, 2, 1, 2, 2, '2018-11-20 23:16:36', '2018-11-20 23:16:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_group_excel_import_batches`
--

CREATE TABLE `ori_group_excel_import_batches` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL COMMENT 'Referred from ori_groups',
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_map` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_source` bigint(20) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `skip_existing_contacts` tinyint(4) DEFAULT NULL,
  `add_to_leads` tinyint(4) DEFAULT NULL,
  `last_processed_id` int(11) DEFAULT NULL COMMENT 'Last processed row id',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Processing',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_group_excel_import_failed_rows`
--

CREATE TABLE `ori_group_excel_import_failed_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `batch_process_id` int(10) UNSIGNED NOT NULL COMMENT 'Reffered from ori_group_excel_import_batch table',
  `row_id` int(11) NOT NULL,
  `row_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `failure_type` int(11) NOT NULL COMMENT '1. Validation failure',
  `failure_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_helpdesk`
--

CREATE TABLE `ori_helpdesk` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `docket_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `remainder_date` datetime DEFAULT NULL,
  `req_title` text COLLATE utf8mb4_unicode_ci,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `short_message` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query_type` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `sub_query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `customer_nature` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_customer_nature',
  `priority` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_priority',
  `ard_no` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'additional fields',
  `location` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'additional fields',
  `need_followup` int(11) DEFAULT NULL COMMENT '1-need 2-not needed',
  `lead_source_id` bigint(20) DEFAULT NULL COMMENT 'Referred from 	ori_mast_lead_sources ',
  `query_status` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_status ',
  `escalation_status` int(11) DEFAULT NULL,
  `escalate` int(11) DEFAULT NULL COMMENT 'Referred from ori_users',
  `escalation_deadline` int(11) DEFAULT NULL,
  `escalation_due_date` datetime DEFAULT NULL,
  `take_up_status` int(11) NOT NULL DEFAULT '0' COMMENT '0-default 1-moved to takeup 2-escalate updated',
  `call_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outbound_calls` int(11) NOT NULL DEFAULT '0' COMMENT '0- Normal followups, 1- outbound calls',
  `batch_id` int(11) DEFAULT NULL COMMENT 'referred from cmp_process_batches',
  `agent_id` int(11) DEFAULT NULL,
  `attended_by` int(11) DEFAULT NULL,
  `assigned_agent` int(11) NOT NULL DEFAULT '0',
  `feedback_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_helpdesk`
--

INSERT INTO `ori_helpdesk` (`id`, `cmpny_id`, `customer_id`, `docket_number`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `remainder_date`, `req_title`, `question`, `answer`, `short_message`, `query_type`, `query_category`, `sub_query_category`, `customer_nature`, `priority`, `ard_no`, `location`, `need_followup`, `lead_source_id`, `query_status`, `escalation_status`, `escalate`, `escalation_deadline`, `escalation_due_date`, `take_up_status`, `call_id`, `outbound_calls`, `batch_id`, `agent_id`, `attended_by`, `assigned_agent`, `feedback_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>sdf</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-24 06:05:22', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2018-10-31 00:13:29', '2019-01-24 00:35:37', NULL),
(2, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>sdf</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 2, NULL, '2019-01-24 06:07:30', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-19 01:15:17', '2019-01-24 00:37:42', NULL),
(3, 2, 1, 'GCC//19012019/313685421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jg', '<p>hjgh</p>', '', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 2, NULL, '2019-01-19 06:46:03', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-19 01:16:03', '2019-01-19 01:16:03', NULL),
(4, 2, 1, 'GCC//19012019/210588855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-31 00:00:00', 'sgfsdgs', '<p>sdgf</p>', '<p>sfdg</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 2, 1, 2, NULL, '2019-01-19 06:47:13', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-19 01:17:13', '2019-01-19 01:17:13', NULL),
(5, 2, 1, 'GCC//21012019/18091542', 1, 2, 3, NULL, NULL, 1, NULL, NULL, 4, NULL, 124, NULL, NULL, NULL, 'dddddddddd', '<p>dddddddddddd</p>', '<p>ghjgh</p>', NULL, 5, 2, 3, 2, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-24 04:58:27', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 00:41:18', '2019-01-23 23:55:59', NULL),
(6, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', '<p>1111</p>', '<p>dfg</p>', NULL, 5, 2, 3, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-24 06:01:45', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 02:24:39', '2019-01-24 00:33:32', NULL),
(7, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>sdf</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-24 06:05:01', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 03:35:09', '2019-01-24 00:35:10', NULL),
(8, 2, 1, 'GCC//29012019/370473592', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aaaaaaaa', '<p>a</p>', '<p>a</p>', NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-01-29 10:02:51', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-29 04:32:51', '2019-01-29 04:32:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_helpdesk_log`
--

CREATE TABLE `ori_helpdesk_log` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `docket_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `remainder_date` datetime DEFAULT NULL,
  `req_title` text COLLATE utf8mb4_unicode_ci,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `short_message` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query_type` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `sub_query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `customer_nature` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_customer_nature',
  `priority` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_priority',
  `ard_no` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'additional fields',
  `location` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'additional fields',
  `need_followup` int(11) DEFAULT NULL COMMENT '1-need 2-not needed',
  `lead_source_id` bigint(20) DEFAULT NULL COMMENT 'Referred from 	ori_mast_lead_sources ',
  `query_status` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_status ',
  `escalation_status` int(11) DEFAULT NULL,
  `escalate` int(11) DEFAULT NULL COMMENT 'Referred from ori_users',
  `escalation_deadline` int(11) DEFAULT NULL,
  `escalation_due_date` datetime DEFAULT NULL,
  `take_up_status` int(11) NOT NULL DEFAULT '0' COMMENT '0-default 1-moved to takeup 2-escalate updated',
  `call_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outbound_calls` int(11) NOT NULL DEFAULT '0' COMMENT '0- Normal followups, 1- outbound calls',
  `batch_id` int(11) DEFAULT NULL COMMENT 'referred from cmp_process_batches',
  `agent_id` int(11) DEFAULT NULL,
  `attended_by` int(11) DEFAULT NULL,
  `assigned_agent` int(11) NOT NULL DEFAULT '0',
  `feedback_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_helpdesk_log`
--

INSERT INTO `ori_helpdesk_log` (`id`, `cmpny_id`, `customer_id`, `docket_number`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `remainder_date`, `req_title`, `question`, `answer`, `short_message`, `query_type`, `query_category`, `sub_query_category`, `customer_nature`, `priority`, `ard_no`, `location`, `need_followup`, `lead_source_id`, `query_status`, `escalation_status`, `escalate`, `escalation_deadline`, `escalation_due_date`, `take_up_status`, `call_id`, `outbound_calls`, `batch_id`, `agent_id`, `attended_by`, `assigned_agent`, `feedback_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>Test complaint answer</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2018-10-31 00:13:29', '2018-10-31 00:13:29', NULL),
(2, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>fghfg</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 2, NULL, '2019-01-19 06:45:17', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-19 01:15:17', '2019-01-19 01:15:17', NULL),
(3, 2, 1, 'GCC//19012019/313685421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jg', '<p>hjgh</p>', '', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 2, NULL, '2019-01-19 06:46:03', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-19 01:16:03', '2019-01-19 01:16:03', NULL),
(4, 2, 1, 'GCC//19012019/210588855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-31 00:00:00', 'sgfsdgs', '<p>sdgf</p>', '<p>sfdg</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 2, 1, 2, NULL, '2019-01-19 06:47:13', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-19 01:17:13', '2019-01-19 01:17:13', NULL),
(5, 2, 1, 'GCC//21012019/18091542', 1, 2, 3, NULL, NULL, 1, NULL, NULL, 4, NULL, 124, NULL, NULL, NULL, 'dddddddddd', '<p>dddddddddddd</p>', '<p>dddddddddddddd</p>', NULL, 5, 2, 3, 2, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-21 06:11:18', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 00:41:18', '2019-01-21 00:41:18', NULL),
(6, 2, 1, 'GCC//21012019/129240555', 1, 2, 14, 1192, NULL, 1, NULL, NULL, 4, NULL, 94, NULL, NULL, NULL, '1111', '<p>1111</p>', '<p>1111</p>', NULL, 5, 2, 3, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-21 07:54:39', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 02:24:39', '2019-01-21 02:24:39', NULL),
(7, 2, 1, 'GCC//21012019/1425000233', 1, 2, 14, NULL, NULL, 1, NULL, NULL, 4, NULL, 94, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>444</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-21 09:05:09', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 03:35:09', '2019-01-21 03:35:09', NULL),
(8, 2, 1, 'GCC//21012019/1425000233', 1, 2, 15, NULL, NULL, 2, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>ssssssss</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-21 10:05:22', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 04:35:22', '2019-01-21 04:35:22', NULL),
(9, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>jjjjjjjjjjj</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-21 10:06:57', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 04:36:57', '2019-01-21 04:36:57', NULL),
(10, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', '<p>1111</p>', '<p>dfgdfgdf</p>', NULL, 5, 2, 3, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-21 10:12:18', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-21 04:42:18', '2019-01-21 04:42:18', NULL),
(11, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>vbnv</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 07:20:26', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 01:50:26', '2019-01-23 01:50:26', NULL),
(12, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'hhhhhhhhh', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:06:37', '2019-01-23 02:06:37', NULL),
(13, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'hhhhhhhhh', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:06:37', '2019-01-23 02:06:37', NULL),
(14, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>asa</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 07:38:28', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 02:08:28', '2019-01-23 02:08:28', NULL),
(15, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'asasas', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:08:46', '2019-01-23 02:08:46', NULL),
(16, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'asasas', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:08:46', '2019-01-23 02:08:46', NULL),
(17, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>asas</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 07:39:07', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 02:09:08', '2019-01-23 02:09:08', NULL),
(18, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'xddfgdfg', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:12:46', '2019-01-23 02:12:46', NULL),
(19, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'xddfgdfg', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:12:46', '2019-01-23 02:12:46', NULL),
(20, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:14:53', '2019-01-23 02:14:53', NULL),
(21, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 02:14:54', '2019-01-23 02:14:54', NULL),
(22, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:19:48', '2019-01-23 03:19:48', NULL),
(23, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:19:48', '2019-01-23 03:19:48', NULL),
(24, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:20:37', '2019-01-23 03:20:37', NULL),
(25, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:20:37', '2019-01-23 03:20:37', NULL),
(26, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, '22222222', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:26:42', '2019-01-23 03:26:42', NULL),
(27, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, '22222222', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:26:42', '2019-01-23 03:26:42', NULL),
(28, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'ccc', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:27:26', '2019-01-23 03:27:26', NULL),
(29, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'ccc', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:27:26', '2019-01-23 03:27:26', NULL),
(30, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'p', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:28:01', '2019-01-23 03:28:01', NULL),
(31, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'p', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:28:01', '2019-01-23 03:28:01', NULL),
(32, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'sdsfd', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:30:24', '2019-01-23 03:30:24', NULL),
(33, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'sdsfd', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:30:24', '2019-01-23 03:30:24', NULL),
(34, 2, 1, 'GCC//19012019/210588855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-31 00:00:00', 'sgfsdgs', NULL, 'cccccccccccc', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:37:34', '2019-01-23 03:37:34', NULL),
(35, 2, 1, 'GCC//19012019/210588855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-31 00:00:00', 'sgfsdgs', NULL, 'cccccccccccc', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:37:34', '2019-01-23 03:37:34', NULL),
(36, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'sssssssssss', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:40:14', '2019-01-23 03:40:14', NULL),
(37, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'sssssssssss', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:40:14', '2019-01-23 03:40:14', NULL),
(38, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'qqqqqqq', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:41:21', '2019-01-23 03:41:21', NULL),
(39, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'qqqqqqq', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:41:21', '2019-01-23 03:41:21', NULL),
(40, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'wwwwwwwww', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:41:43', '2019-01-23 03:41:43', NULL),
(41, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'wwwwwwwww', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:41:43', '2019-01-23 03:41:43', NULL),
(42, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'wwwwwwwww', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:41:57', '2019-01-23 03:41:57', NULL),
(43, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'wwwwwwwww', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:41:58', '2019-01-23 03:41:58', NULL),
(44, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'aaaaaa', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:57:19', '2019-01-23 03:57:19', NULL),
(45, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'aaaaaa', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:57:19', '2019-01-23 03:57:19', NULL),
(46, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'dddddddddddd', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:57:38', '2019-01-23 03:57:38', NULL),
(47, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'dddddddddddd', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:57:38', '2019-01-23 03:57:38', NULL),
(48, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'cccccccccccccc', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:58:24', '2019-01-23 03:58:24', NULL),
(49, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'cccccccccccccc', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 03:58:24', '2019-01-23 03:58:24', NULL),
(50, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'ttttttttttt', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 04:01:03', '2019-01-23 04:01:03', NULL),
(51, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'ttttttttttt', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 04:01:03', '2019-01-23 04:01:03', NULL),
(52, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>ssssssssss</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 09:37:39', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 04:07:39', '2019-01-23 04:07:39', NULL),
(53, 2, 1, 'GCC//19012019/313685421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jg', NULL, 'x', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 04:16:39', '2019-01-23 04:16:39', NULL),
(54, 2, 1, 'GCC//19012019/313685421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jg', NULL, 'x', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 04:16:39', '2019-01-23 04:16:39', NULL),
(55, 2, 1, 'GCC//19012019/313685421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jg', NULL, 'x', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 04:16:46', '2019-01-23 04:16:46', NULL),
(56, 2, 1, 'GCC//19012019/313685421', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jg', NULL, 'x', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 04:16:46', '2019-01-23 04:16:46', NULL),
(57, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'uuuuuu', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 05:52:30', '2019-01-23 05:52:30', NULL),
(58, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'uuuuuu', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 05:52:30', '2019-01-23 05:52:30', NULL),
(59, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'uuuuuu', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 05:52:34', '2019-01-23 05:52:34', NULL),
(60, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'uuuuuu', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 05:52:34', '2019-01-23 05:52:34', NULL),
(61, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>erer</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 11:25:22', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 05:55:22', '2019-01-23 05:55:22', NULL),
(62, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>hjkh</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 11:27:24', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 05:57:24', '2019-01-23 05:57:24', NULL),
(63, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, '77777', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 05:58:31', '2019-01-23 05:58:31', NULL),
(64, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, '77777', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 05:58:31', '2019-01-23 05:58:31', NULL),
(65, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'iiiiiiiiiiiii', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:34:13', '2019-01-23 06:34:13', NULL),
(66, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'iiiiiiiiiiiii', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:34:13', '2019-01-23 06:34:13', NULL),
(67, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>asasa</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:05:49', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:35:49', '2019-01-23 06:35:49', NULL),
(68, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'vvvvvvvvvv', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:36:01', '2019-01-23 06:36:01', NULL),
(69, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'vvvvvvvvvv', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:36:01', '2019-01-23 06:36:01', NULL),
(70, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>fgfgh</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:07:03', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:37:03', '2019-01-23 06:37:03', NULL),
(71, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, '4444444444444', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:37:25', '2019-01-23 06:37:25', NULL),
(72, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, '4444444444444', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:37:25', '2019-01-23 06:37:25', NULL),
(73, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>dsf</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:08:46', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:38:46', '2019-01-23 06:38:46', NULL),
(74, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:45:23', '2019-01-23 06:45:23', NULL),
(75, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:45:23', '2019-01-23 06:45:23', NULL),
(76, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>ljklkl</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:17:51', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:47:51', '2019-01-23 06:47:51', NULL),
(77, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'uiouiouio', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:48:10', '2019-01-23 06:48:10', NULL),
(78, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'uiouiouio', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:48:10', '2019-01-23 06:48:10', NULL),
(79, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>ghjgj</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:24:32', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:54:32', '2019-01-23 06:54:32', NULL),
(80, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'ghjghj', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:54:42', '2019-01-23 06:54:42', NULL),
(81, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'ghjghj', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:54:42', '2019-01-23 06:54:42', NULL),
(82, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>xzxz</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:26:17', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:56:17', '2019-01-23 06:56:17', NULL),
(83, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:56:31', '2019-01-23 06:56:31', NULL),
(84, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:56:31', '2019-01-23 06:56:31', NULL),
(85, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>sdf</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:29:05', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 06:59:06', '2019-01-23 06:59:06', NULL),
(86, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:59:16', '2019-01-23 06:59:16', NULL),
(87, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 06:59:16', '2019-01-23 06:59:16', NULL),
(88, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>dfgdfg</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:32:10', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:02:10', '2019-01-23 07:02:10', NULL),
(89, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:02:50', '2019-01-23 07:02:50', NULL),
(90, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:02:50', '2019-01-23 07:02:50', NULL),
(91, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>asas</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:33:34', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:03:34', '2019-01-23 07:03:34', NULL),
(92, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, '111111111111111', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:04:17', '2019-01-23 07:04:17', NULL),
(93, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, '111111111111111', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:04:17', '2019-01-23 07:04:17', NULL),
(94, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>asdsd</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:34:26', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:04:26', '2019-01-23 07:04:26', NULL),
(95, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'xxxxxxx', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:11:22', '2019-01-23 07:11:22', NULL),
(96, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'xxxxxxx', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:11:22', '2019-01-23 07:11:22', NULL),
(97, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>zxzx</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-23 12:41:46', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:11:46', '2019-01-23 07:11:46', NULL),
(98, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'aaaaaaaaa', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:11:58', '2019-01-23 07:11:58', NULL),
(99, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'aaaaaaaaa', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:11:58', '2019-01-23 07:11:58', NULL),
(100, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>vbnvn</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 12:43:38', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:13:38', '2019-01-23 07:13:38', NULL),
(101, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'vbnvbn', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:13:49', '2019-01-23 07:13:49', NULL),
(102, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'vbnvbn', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:13:49', '2019-01-23 07:13:49', NULL),
(103, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>gh</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-23 12:46:36', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:16:36', '2019-01-23 07:16:36', NULL),
(104, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'aaaaaa', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:45:47', '2019-01-23 07:45:47', NULL),
(105, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'aaaaaa', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:45:47', '2019-01-23 07:45:47', NULL),
(106, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>ss</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 13:18:08', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:48:08', '2019-01-23 07:48:08', NULL),
(107, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:48:21', '2019-01-23 07:48:21', NULL),
(108, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'qqqqqqqqq', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:48:21', '2019-01-23 07:48:21', NULL),
(109, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>s</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 13:19:51', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:49:51', '2019-01-23 07:49:51', NULL),
(110, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, '555', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:50:04', '2019-01-23 07:50:04', NULL),
(111, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, '555', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:50:04', '2019-01-23 07:50:04', NULL),
(112, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>dfsd</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-23 13:23:32', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 07:53:32', '2019-01-23 07:53:32', NULL),
(113, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'sdsdsd', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:53:42', '2019-01-23 07:53:42', NULL),
(114, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'sdsdsd', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 07:53:42', '2019-01-23 07:53:42', NULL),
(115, 2, 1, 'GCC//21012019/18091542', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dddddddddd', '<p>dddddddddddd</p>', '<p>ghjgh</p>', NULL, 5, 2, 3, 2, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 04:58:27', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 23:28:27', '2019-01-23 23:28:27', NULL),
(116, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>sdsd</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-24 05:07:40', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 23:37:40', '2019-01-23 23:37:40', NULL),
(117, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'reason for reeee', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 23:38:08', '2019-01-23 23:38:08', NULL),
(118, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'reason for reeee', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 23:38:08', '2019-01-23 23:38:08', NULL),
(119, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>gjgjhj</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-24 05:09:18', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-23 23:39:18', '2019-01-23 23:39:18', NULL),
(120, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'ticket not closed properly', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 23:39:45', '2019-01-23 23:39:45', NULL),
(121, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'ticket not closed properly', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 23:39:45', '2019-01-23 23:39:45', NULL),
(122, 2, 1, 'GCC//21012019/18091542', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dddddddddd', NULL, 'strong reason', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 23:55:59', '2019-01-23 23:55:59', NULL),
(123, 2, 1, 'GCC//21012019/18091542', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dddddddddd', NULL, 'strong reason', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-23 23:55:59', '2019-01-23 23:55:59', NULL),
(124, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>sdf</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 05:32:30', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:02:30', '2019-01-24 00:02:30', NULL),
(125, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'ddddddddddd', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:03:31', '2019-01-24 00:03:31', NULL),
(126, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'ddddddddddd', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:03:31', '2019-01-24 00:03:31', NULL),
(127, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>dsffg</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 05:33:57', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:03:57', '2019-01-24 00:03:57', NULL),
(128, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 's', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:04:07', '2019-01-24 00:04:07', NULL),
(129, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 's', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:04:07', '2019-01-24 00:04:07', NULL),
(130, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>asa</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 05:35:35', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:05:36', '2019-01-24 00:05:36', NULL),
(131, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'aaaaaaa', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:05:43', '2019-01-24 00:05:43', NULL),
(132, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'aaaaaaa', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:05:43', '2019-01-24 00:05:43', NULL),
(133, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>asa</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 05:38:07', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:08:07', '2019-01-24 00:08:07', NULL),
(134, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'qqqqq', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:08:26', '2019-01-24 00:08:26', NULL),
(135, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'qqqqq', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:08:26', '2019-01-24 00:08:26', NULL),
(136, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', '<p>1111</p>', '<p>asdas</p>', NULL, 5, 2, 3, 1, 1, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 05:41:43', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:11:43', '2019-01-24 00:11:43', NULL),
(137, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'vvvvvvvvvvvv', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:11:55', '2019-01-24 00:11:55', NULL),
(138, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'vvvvvvvvvvvv', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:11:55', '2019-01-24 00:11:55', NULL),
(139, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', '<p>1111</p>', '<p>sd</p>', NULL, 5, 2, 3, 1, 1, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 05:42:17', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:12:17', '2019-01-24 00:12:17', NULL),
(140, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'ssssss', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:12:35', '2019-01-24 00:12:35', NULL),
(141, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'ssssss', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:12:35', '2019-01-24 00:12:35', NULL),
(142, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>fg</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 06:01:37', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:31:37', '2019-01-24 00:31:37', NULL);
INSERT INTO `ori_helpdesk_log` (`id`, `cmpny_id`, `customer_id`, `docket_number`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `remainder_date`, `req_title`, `question`, `answer`, `short_message`, `query_type`, `query_category`, `sub_query_category`, `customer_nature`, `priority`, `ard_no`, `location`, `need_followup`, `lead_source_id`, `query_status`, `escalation_status`, `escalate`, `escalation_deadline`, `escalation_due_date`, `take_up_status`, `call_id`, `outbound_calls`, `batch_id`, `agent_id`, `attended_by`, `assigned_agent`, `feedback_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(143, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', '<p>1111</p>', '<p>dfg</p>', NULL, 5, 2, 3, 1, 1, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 06:01:45', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:31:45', '2019-01-24 00:31:45', NULL),
(144, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'eeeeeee', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:33:01', '2019-01-24 00:33:01', NULL),
(145, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'eeeeeee', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:33:01', '2019-01-24 00:33:01', NULL),
(146, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'eeee', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:33:32', '2019-01-24 00:33:32', NULL),
(147, 2, 1, 'GCC//21012019/129240555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', NULL, 'eeee', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:33:32', '2019-01-24 00:33:32', NULL),
(148, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>sfsd</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-24 06:03:42', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:33:42', '2019-01-24 00:33:42', NULL),
(149, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'dfdff', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:34:00', '2019-01-24 00:34:00', NULL),
(150, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'dfdff', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:34:00', '2019-01-24 00:34:00', NULL),
(151, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>df</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-24 06:04:10', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:34:10', '2019-01-24 00:34:10', NULL),
(152, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'df', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:34:16', '2019-01-24 00:34:16', NULL),
(153, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'df', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:34:16', '2019-01-24 00:34:16', NULL),
(154, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', '<p>4444</p>', '<p>sdf</p>', NULL, 5, 2, NULL, 2, 3, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 06:05:01', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:35:01', '2019-01-24 00:35:01', NULL),
(155, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'bbbbbbbb', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:35:10', '2019-01-24 00:35:10', NULL),
(156, 2, 1, 'GCC//21012019/1425000233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444', NULL, 'bbbbbbbb', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:35:10', '2019-01-24 00:35:10', NULL),
(157, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', '<p>Test complaint question</p>', '<p>sdf</p>', 'Test complaint answer short', 5, 2, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-24 06:05:22', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:35:22', '2019-01-24 00:35:22', NULL),
(158, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'bbbb', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:35:37', '2019-01-24 00:35:37', NULL),
(159, 2, 1, '2009310472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test complaint', NULL, 'bbbb', 'Test complaint answer short', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:35:37', '2019-01-24 00:35:37', NULL),
(160, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', '<p>fgfg</p>', '<p>sdf</p>', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 2, NULL, '2019-01-24 06:07:30', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-24 00:37:30', '2019-01-24 00:37:30', NULL),
(161, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'bbbbbbbbbbbb', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:37:42', '2019-01-24 00:37:42', NULL),
(162, 2, 1, 'GCC//19012019/1148266919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fgh', NULL, 'bbbbbbbbbbbb', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 1, 2, 2, '2019-01-24 00:37:42', '2019-01-24 00:37:42', NULL),
(163, 2, 1, 'GCC//29012019/370473592', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aaaaaaaa', '<p>a</p>', '<p>a</p>', NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-01-29 10:02:51', 0, NULL, 0, NULL, NULL, 2, 0, NULL, 1, 2, 2, '2019-01-29 04:32:51', '2019-01-29 04:32:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_intimations`
--

CREATE TABLE `ori_intimations` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_users',
  `channel` int(11) DEFAULT NULL COMMENT '1 SMS, 2 Email, 3 Internal',
  `time_interval` int(11) DEFAULT NULL COMMENT '1 Immediate, 2 Daily, 3 Weekly, 4 Monthly, 5 Internal immediate, 6 Superior',
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_intimations`
--

INSERT INTO `ori_intimations` (`id`, `cmpny_id`, `user_id`, `channel`, `time_interval`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 2, 6, NULL, NULL, NULL, '2018-09-24 04:59:15', '2018-09-24 04:59:15', NULL),
(3, 2, 1, 1, 6, NULL, NULL, NULL, '2018-09-26 04:55:22', '2018-09-26 04:55:22', NULL),
(4, 2, 1, 3, 5, NULL, NULL, NULL, '2018-09-26 04:55:22', '2018-09-26 04:55:22', NULL),
(5, 2, 2, 1, 1, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(6, 2, 2, 1, 2, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(7, 2, 2, 1, 3, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(8, 2, 2, 1, 4, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(9, 2, 2, 2, 1, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(10, 2, 2, 2, 2, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(11, 2, 2, 2, 3, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL),
(12, 2, 2, 2, 4, 1, 2, 2, '2019-01-21 03:47:07', '2019-01-21 03:47:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_lead_followups`
--

CREATE TABLE `ori_lead_followups` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `docket_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `remainder_date` datetime DEFAULT NULL,
  `req_title` text COLLATE utf8mb4_unicode_ci,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `short_message` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query_type` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `sub_query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `customer_nature` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_customer_nature',
  `priority` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_priority',
  `need_followup` int(11) DEFAULT NULL COMMENT '1-need 2-not needed',
  `lead_source_id` bigint(20) DEFAULT NULL COMMENT 'Referred from 	ori_mast_lead_sources ',
  `query_status` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_status ',
  `escalation_status` int(11) DEFAULT NULL,
  `escalate` int(11) DEFAULT NULL COMMENT 'Referred from ori_users',
  `escalation_deadline` int(11) DEFAULT NULL,
  `escalation_due_date` datetime DEFAULT NULL,
  `take_up_status` int(11) NOT NULL DEFAULT '0' COMMENT '0-default 1-moved to takeup 2-escalate updated',
  `call_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outbound_calls` int(11) NOT NULL DEFAULT '0' COMMENT '0- Normal followups, 1- outbound calls',
  `batch_id` int(11) DEFAULT NULL COMMENT 'referred from cmp_process_batches',
  `agent_id` int(11) DEFAULT NULL,
  `attended_by` int(11) DEFAULT NULL,
  `assigned_agent` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_lead_followups`
--

INSERT INTO `ori_lead_followups` (`id`, `cmpny_id`, `customer_id`, `docket_number`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `remainder_date`, `req_title`, `question`, `answer`, `short_message`, `query_type`, `query_category`, `sub_query_category`, `customer_nature`, `priority`, `need_followup`, `lead_source_id`, `query_status`, `escalation_status`, `escalate`, `escalation_deadline`, `escalation_due_date`, `take_up_status`, `call_id`, `outbound_calls`, `batch_id`, `agent_id`, `attended_by`, `assigned_agent`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '246053156', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test followup', '<p>Test followup question</p>', '<p>sdfsdf</p>', 'Test followup answer short', 9, 1, NULL, 2, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 2, 0, 1, 2, 2, '2018-10-31 00:25:24', '2019-01-24 00:37:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_lead_followups_log`
--

CREATE TABLE `ori_lead_followups_log` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_customer_profile',
  `docket_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `remainder_date` datetime DEFAULT NULL,
  `req_title` text COLLATE utf8mb4_unicode_ci,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `short_message` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query_type` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `sub_query_category` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `customer_nature` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_customer_nature',
  `priority` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_priority',
  `need_followup` int(11) DEFAULT NULL COMMENT '1-need 2-not needed',
  `lead_source_id` bigint(20) DEFAULT NULL COMMENT 'Referred from 	ori_mast_lead_sources ',
  `query_status` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_status ',
  `escalation_status` int(11) DEFAULT NULL,
  `escalate` int(11) DEFAULT NULL COMMENT 'Referred from ori_users',
  `escalation_deadline` int(11) DEFAULT NULL,
  `escalation_due_date` datetime DEFAULT NULL,
  `take_up_status` int(11) NOT NULL DEFAULT '0' COMMENT '0-default 1-moved to takeup 2-escalate updated',
  `call_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outbound_calls` int(11) NOT NULL DEFAULT '0' COMMENT '0- Normal followups, 1- outbound calls',
  `batch_id` int(11) DEFAULT NULL COMMENT 'referred from cmp_process_batches',
  `agent_id` int(11) DEFAULT NULL,
  `attended_by` int(11) DEFAULT NULL,
  `assigned_agent` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_lead_followups_log`
--

INSERT INTO `ori_lead_followups_log` (`id`, `cmpny_id`, `customer_id`, `docket_number`, `country_id`, `state_id`, `district_id`, `taluk_id`, `village_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `remainder_date`, `req_title`, `question`, `answer`, `short_message`, `query_type`, `query_category`, `sub_query_category`, `customer_nature`, `priority`, `need_followup`, `lead_source_id`, `query_status`, `escalation_status`, `escalate`, `escalation_deadline`, `escalation_due_date`, `take_up_status`, `call_id`, `outbound_calls`, `batch_id`, `agent_id`, `attended_by`, `assigned_agent`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '882563849', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test followup', '<p>Test followup question</p>', '<p>Test followup answer</p>', 'Test followup answer short', 9, 1, NULL, 2, 1, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 2, 0, 1, 2, 2, '2018-10-31 00:25:24', '2018-10-31 00:25:24', NULL),
(2, 2, 1, '246053156', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test followup', '<p>Test followup question</p>', '<p>sdfsdf</p>', 'Test followup answer short', 9, 1, NULL, 2, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, 1, NULL, NULL, '2019-01-24 00:37:19', '2019-01-24 00:37:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_localbody`
--

CREATE TABLE `ori_localbody` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `localbodyTypeId` int(11) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1- Active,2- Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_localbody`
--

INSERT INTO `ori_localbody` (`id`, `name`, `district_id`, `localbodyTypeId`, `parent_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thiruvananthapuram', 14, 3, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Kollam', 8, 3, 0, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Kochi', 4, 3, 0, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Thrissur', 15, 3, 0, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Kozhikode', 10, 3, 0, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Kannur', 6, 3, 0, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'Alappuzha', 3, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Chengannur', 3, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Cherthala', 3, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'Haripad', 3, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'Kayamkulam', 3, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'Mavelikkara', 3, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'Aluva', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'Angamaly', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'Eloor', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'Kalamassery', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(17, 'Koothattukulam', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(18, 'Kothamangalam', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(19, 'Maradu', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(20, 'Muvattupuzha', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(21, 'Paravur', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(22, 'Perumbavoor', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(23, 'Piravom', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(24, 'Thrikkakara', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(25, 'Thrippunithura', 4, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(26, 'Thodupuzha', 5, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(27, 'Anthoor', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(28, 'Iritty', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(29, 'Koothuparamba', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(30, 'Mattannur', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(31, 'Panoor', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(32, 'Payyannur', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(33, 'Sreekandapuram', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(34, 'Taliparamba', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(35, 'Thalassery', 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(36, 'Kanhangad', 7, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(37, 'Kasaragod', 7, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(38, 'Nileshwar', 7, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(39, 'Karunagappally', 8, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(40, 'Kottarakara', 8, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(41, 'Paravoor', 8, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(42, 'Punalur', 8, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(43, 'Changanassery', 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(44, 'Erattupetta', 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(45, 'Ettumanoor', 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(46, 'Kottayam', 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(47, 'Palai', 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(48, 'Vaikom', 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(49, 'Feroke', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(50, 'Koduvally', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(51, 'koyilandy', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(52, 'Mukkam', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(53, 'Payyoli', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(54, 'Ramanattukara', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(55, 'Vatakara', 0, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(56, 'Kondotty', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(57, 'Kottakkal', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(58, 'Malappuram', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(59, 'Manjeri', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(60, 'Nilambur', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(61, 'Parappanangadi', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(62, 'Perinthalmanna', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(63, 'Ponnani', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(64, 'Tanur', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(65, 'Tirur', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(66, 'Tirurangadi', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(67, 'Valanchery', 11, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(68, 'Cherpulassery', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(69, 'Chittur-Thathamangalam', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(70, 'Mannarkad', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(71, 'Ottappalam', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(72, 'Palakkad', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(73, 'Pattambi', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(74, 'Shoranur', 12, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(75, 'Adoor', 13, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(76, 'Pandalam', 13, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(77, 'Pathanamthitta', 13, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(78, 'Thiruvalla', 13, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(79, 'Attingal', 14, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(80, 'Nedumangad', 14, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(81, 'Neyyattinkara', 14, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(82, 'Varkala', 14, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(83, 'Chalakudy', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(84, 'Chavakkad', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(85, 'Guruvayoor', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(86, 'Irinjalakuda', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(87, 'Kodungallur', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(88, 'Kunnamkulam', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(89, 'Wadakanchery', 15, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(90, 'Kalpetta', 16, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(91, 'Kattappana', 16, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(92, 'Mananthavady', 16, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(93, 'Sulthan Bathery', 16, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(94, 'Varkala', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(95, 'Kilimanoor', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(96, 'Chirayinkeezh', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(97, 'Vamanapuram', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(98, 'Vellanad', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(99, 'Nedumangad', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(100, 'Pothencode', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(101, 'Nemom', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(102, 'Perumkadavila', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(103, 'Athiyannoor', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(104, 'Parassala', 14, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(105, 'Oachira', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(106, 'Sasthamcotta', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(107, 'Vettikavala', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(108, 'Pathanapuram', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(109, 'Anchal', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(110, 'Kottarakara', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(111, 'Chittumala', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(112, 'Chavara', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(113, 'Mukhathala', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(114, 'Ithikkara', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(115, 'Chadayamangalam', 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(116, 'Mallappally', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(117, 'Pulikeezhu', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(118, 'Koipuram', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(119, 'Elanthoor', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(120, 'Ranni', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(121, 'Konni', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(122, 'Pandalam', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(123, 'Parakkode', 13, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(124, 'Thycattussery', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(125, 'Pattanakkad', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(126, 'Kanjikuzhy', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(127, 'Aryad', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(128, 'Ambalappuzha', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(129, 'Champakulam', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(130, 'Veliyanad', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(131, 'Chengannur', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(132, 'Haripad', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(133, 'Mavelikara', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(134, 'Bharanickavu', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(135, 'Muthukulam', 3, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(136, 'Vaikom', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(137, 'Kaduthuruthy', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(138, 'Ettumanoor', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(139, 'Uzhavoor', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(140, 'Lalam', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(141, 'Erattupetta', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(142, 'Pampady', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(143, 'Pallom', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(144, 'Madappally', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(145, 'Vazhoor', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(146, 'Kanjirappally', 9, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(147, 'Adimaly', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(148, 'Devikulam', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(149, 'Nedumkandam', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(150, 'Elemdesam', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(151, 'Idukki', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(152, 'Kattappana', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(153, 'Thodupuzha', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(154, 'Azhutha', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(155, 'Paravur', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(156, 'Alangad', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(157, 'Angamaly', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(158, 'Koovappady', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(159, 'Vazhakulam', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(160, 'Edappally', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(161, 'Vypin', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(162, 'Palluruthy', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(163, 'Mulanthuruthy', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(164, 'Vadavucode', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(165, 'Kothamangalam', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(166, 'Pampakuda', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(167, 'Parakkadavu', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(168, 'Muvattupuzha', 4, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(169, 'Chavakkad', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(170, 'Chowannur', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(171, 'Wadakanchery', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(172, 'Pazhayannur', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(173, 'Ollukkara', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(174, 'Puzhakkal', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(175, 'Mullassery', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(176, 'Thalikulam', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(177, 'Anthikad', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(178, 'Cherpu', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(179, 'Kodakara', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(180, 'Irinjalakuda', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(181, 'Vellangallur', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(182, 'Mathilakam', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(183, 'Mala', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(184, 'Chalakudy', 15, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(185, 'Trithala', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(186, 'Pattambi', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(187, 'Ottapalam', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(188, 'Sreekrishnapuram', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(189, 'Mannarkad', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(190, 'Attappady', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(191, 'Palakkad', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(192, 'Kuzhalmannam', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(193, 'Chittur', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(194, 'Kollengode', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(195, 'Nemmara', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(196, 'Alathur', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(197, 'Malampuzha', 12, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(198, 'Nilambur', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(199, 'Kalikavu', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(200, 'Wandoor', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(201, 'Kondotty', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(202, 'Areacode', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(203, 'Malappuram', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(204, 'Perinthalmanna', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(205, 'Mankada', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(206, 'Kuttippuram', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(207, 'Vengara', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(208, 'Tirurangadi', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(209, 'Tanur', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(210, 'Tirur', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(211, 'Ponnani', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(212, 'Perumpadappa', 11, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(213, 'Vatakara', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(214, 'Tuneri', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(215, 'Kunnummal', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(216, 'Thodannur', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(217, 'Melady', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(218, 'Perambra', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(219, 'Balussery', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(220, 'Panthalayani', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(221, 'Chelannur', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(222, 'Koduvally', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(223, 'Kunnamangalam', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(224, 'Kozhikkode', 0, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(225, 'Mananthavady', 16, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(226, 'Panamaram', 16, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(227, 'Sulthan Bathery', 16, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(228, 'Kalpetta', 16, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(229, 'Payyannur', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(230, 'Kalliasseri', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(231, 'Taliparamba', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(232, 'Irikkur', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(233, 'Kannur', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(234, 'Edakkad', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(235, 'Thalassery', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(236, 'Panoor', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(237, 'Kuthuparamba', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(238, 'Iritty', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(239, 'Peravoor', 6, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(240, 'Manjeshwar', 7, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(241, 'Karadka', 7, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(242, 'Kasaragod', 7, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(243, 'Kanhangad', 7, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(244, 'Parappa', 7, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(245, 'Nileshwar', 7, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(246, 'Chemmaruthy', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(247, 'Edava', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(248, 'Elakamon', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(249, 'Manamboor', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(250, 'Ottoor', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(251, 'Cherunniyoor', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(252, 'Vettoor', 14, 1, 94, 1, NULL, NULL, NULL, NULL, NULL),
(253, 'Kilimanoor', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(254, 'Pazhayakunnumel', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(255, 'Karavaram', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(256, 'Madavoor', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(257, 'Pallickal', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(258, 'Nagaroor', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(259, 'Navaikulam', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(260, 'Pulimath', 14, 1, 95, 1, NULL, NULL, NULL, NULL, NULL),
(261, 'Anchuthengu', 14, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(262, 'Vakkom', 14, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(263, 'Chirayinkeezhu', 14, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(264, 'Kizhuvilam', 14, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(265, 'Mudakkal', 14, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(266, 'Kadakkavoor', 14, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(267, 'Kallara', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(268, 'Nellanad', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(269, 'Pullampara', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(270, 'Vamanapuram', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(271, 'Pangode', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(272, 'Nanniyode', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(273, 'Peringammala', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(274, 'Manickal', 14, 1, 97, 1, NULL, NULL, NULL, NULL, NULL),
(275, 'Aryanad', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(276, 'Poovachal', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(277, 'Vellanad', 0, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(278, 'Vithura', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(279, 'Uzhamalakkal', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(280, 'Kuttichal', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(281, 'Tholicode', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(282, 'Kattakada', 14, 1, 98, 1, NULL, NULL, NULL, NULL, NULL),
(283, 'Anad', 14, 1, 99, 1, NULL, NULL, NULL, NULL, NULL),
(284, 'Aruvikkara', 14, 1, 99, 1, NULL, NULL, NULL, NULL, NULL),
(285, 'Panavoor', 14, 1, 99, 1, NULL, NULL, NULL, NULL, NULL),
(286, 'Karakulam', 14, 1, 99, 1, NULL, NULL, NULL, NULL, NULL),
(287, 'Vembayam', 14, 1, 99, 1, NULL, NULL, NULL, NULL, NULL),
(288, 'Andoorkonam', 14, 1, 100, 1, NULL, NULL, NULL, NULL, NULL),
(289, 'Kadinamkulam', 14, 1, 100, 1, NULL, NULL, NULL, NULL, NULL),
(290, 'Mangalapuram', 14, 1, 100, 1, NULL, NULL, NULL, NULL, NULL),
(291, 'Pothencode', 14, 1, 100, 1, NULL, NULL, NULL, NULL, NULL),
(292, 'Azhoor', 14, 1, 100, 1, NULL, NULL, NULL, NULL, NULL),
(293, 'Balaramapuram', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(294, 'Pallichal', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(295, 'Maranalloor', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(296, 'Malayinkeezh', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(297, 'Vilappil', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(298, 'Vilavoorkal', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(299, 'Kalliyoor', 14, 1, 101, 1, NULL, NULL, NULL, NULL, NULL),
(300, 'Perumkadavila', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(301, 'Kollayil', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(302, 'Ottasekharamangalam', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(303, 'Aryancode', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(304, 'Kallikkadu', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(305, 'Kunnathukal', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(306, 'Vellarada', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(307, 'Amboori', 14, 1, 102, 1, NULL, NULL, NULL, NULL, NULL),
(308, 'Athiyannoor', 14, 1, 103, 1, NULL, NULL, NULL, NULL, NULL),
(309, 'Kanjiramkulam', 14, 1, 103, 1, NULL, NULL, NULL, NULL, NULL),
(310, 'Karumkulam', 14, 1, 103, 1, NULL, NULL, NULL, NULL, NULL),
(311, 'Kottukal', 0, 1, 103, 1, NULL, NULL, NULL, NULL, NULL),
(312, 'Venganoor', 14, 1, 103, 1, NULL, NULL, NULL, NULL, NULL),
(313, 'Chenkal', 14, 1, 104, 1, NULL, NULL, NULL, NULL, NULL),
(314, 'Karode', 14, 1, 104, 1, NULL, NULL, NULL, NULL, NULL),
(315, 'Kulathoor', 14, 1, 104, 1, NULL, NULL, NULL, NULL, NULL),
(316, 'Parassala', 14, 1, 104, 1, NULL, NULL, NULL, NULL, NULL),
(317, 'Thirupuram', 14, 1, 104, 1, NULL, NULL, NULL, NULL, NULL),
(318, 'Poovar', 8, 1, 104, 1, NULL, NULL, NULL, NULL, NULL),
(319, 'Oachira', 8, 1, 105, 1, NULL, NULL, NULL, NULL, NULL),
(320, 'Kulasekharapuram', 8, 1, 105, 1, NULL, NULL, NULL, NULL, NULL),
(321, 'Clappana', 8, 1, 105, 1, NULL, NULL, NULL, NULL, NULL),
(322, 'Thazhava', 8, 1, 105, 1, NULL, NULL, NULL, NULL, NULL),
(323, 'Alappad', 8, 1, 105, 1, NULL, NULL, NULL, NULL, NULL),
(324, 'Thodiyoor', 8, 1, 105, 1, NULL, NULL, NULL, NULL, NULL),
(325, 'Sasthamcotta', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(326, 'West Kallada', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(327, 'Sooranad South', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(328, 'Poruvazhy', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(329, 'Kunnathoor', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(330, 'Sooranad North', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(331, 'Mynagappally', 8, 1, 106, 1, NULL, NULL, NULL, NULL, NULL),
(332, 'Ummannoor', 8, 1, 107, 1, NULL, NULL, NULL, NULL, NULL),
(333, 'Vettikavala', 8, 1, 107, 1, NULL, NULL, NULL, NULL, NULL),
(334, 'Melila', 8, 1, 107, 1, NULL, NULL, NULL, NULL, NULL),
(335, 'Mylom', 8, 1, 107, 1, NULL, NULL, NULL, NULL, NULL),
(336, 'Kulakkada', 8, 1, 107, 1, NULL, NULL, NULL, NULL, NULL),
(337, 'Pavithreswaram', 8, 1, 107, 1, NULL, NULL, NULL, NULL, NULL),
(338, 'Vilakkudy', 8, 1, 108, 1, NULL, NULL, NULL, NULL, NULL),
(339, 'Thalavoor', 8, 1, 108, 1, NULL, NULL, NULL, NULL, NULL),
(340, 'Piravanthoor', 8, 1, 108, 1, NULL, NULL, NULL, NULL, NULL),
(341, 'Pattazhi Vadakkekara', 8, 1, 108, 1, NULL, NULL, NULL, NULL, NULL),
(342, 'Pattazhi', 8, 1, 108, 1, NULL, NULL, NULL, NULL, NULL),
(343, 'Pathanapuram', 8, 1, 108, 1, NULL, NULL, NULL, NULL, NULL),
(344, 'Kulathupuzha', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(345, 'Yeroor', 0, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(346, 'Alayamon', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(347, 'Anchal', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(348, 'Edamulackal', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(349, 'Karavaloor', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(350, 'Thenmala', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(351, 'Aryankavu', 8, 1, 109, 1, NULL, NULL, NULL, NULL, NULL),
(352, 'Veliyam', 8, 1, 110, 1, NULL, NULL, NULL, NULL, NULL),
(353, 'Pooyappally', 8, 1, 110, 1, NULL, NULL, NULL, NULL, NULL),
(354, 'Kareepra', 8, 1, 110, 1, NULL, NULL, NULL, NULL, NULL),
(355, 'Ezhukone', 8, 1, 110, 1, NULL, NULL, NULL, NULL, NULL),
(356, 'Neduvathoor', 8, 1, 110, 1, NULL, NULL, NULL, NULL, NULL),
(357, 'Perinad', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(358, 'Kundara', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(359, 'East Kallada', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(360, 'Perayam', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(361, 'Munroethuruth', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(362, 'Panayam', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(363, 'Thrikkaruva', 8, 1, 111, 1, NULL, NULL, NULL, NULL, NULL),
(364, 'Thekkumbhagom', 8, 1, 112, 1, NULL, NULL, NULL, NULL, NULL),
(365, 'Chavara', 8, 1, 112, 1, NULL, NULL, NULL, NULL, NULL),
(366, 'Thevalakkara', 8, 1, 112, 1, NULL, NULL, NULL, NULL, NULL),
(367, 'Panmana', 8, 1, 112, 1, NULL, NULL, NULL, NULL, NULL),
(368, 'Neendakara', 8, 1, 112, 1, NULL, NULL, NULL, NULL, NULL),
(369, 'Mayyanad', 8, 1, 113, 1, NULL, NULL, NULL, NULL, NULL),
(370, 'Thrikkovilvattom', 8, 1, 113, 1, NULL, NULL, NULL, NULL, NULL),
(371, 'Kottamkara', 8, 1, 113, 1, NULL, NULL, NULL, NULL, NULL),
(372, 'Elampalloor', 8, 1, 113, 1, NULL, NULL, NULL, NULL, NULL),
(373, 'Nedumpana', 8, 1, 113, 1, NULL, NULL, NULL, NULL, NULL),
(374, 'Poothakulam', 8, 1, 114, 1, NULL, NULL, NULL, NULL, NULL),
(375, 'Kalluvathukkal', 8, 1, 114, 1, NULL, NULL, NULL, NULL, NULL),
(376, 'Chathannoor', 8, 1, 114, 1, NULL, NULL, NULL, NULL, NULL),
(377, 'Adichanalloor', 8, 1, 114, 1, NULL, NULL, NULL, NULL, NULL),
(378, 'Chirakkara', 8, 1, 114, 1, NULL, NULL, NULL, NULL, NULL),
(379, 'Chithara', 0, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(380, 'Kadakkal', 8, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(381, 'Chadayamangalam', 8, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(382, 'Ittiva', 8, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(383, 'Velinalloor', 8, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(384, 'Elamadu', 8, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(385, 'Nilamel', 8, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(386, 'Kummil', 13, 1, 115, 1, NULL, NULL, NULL, NULL, NULL),
(387, 'Anicadu', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(388, 'Kaviyoor', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(389, 'Kottanad', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(390, 'Kottangal', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(391, 'Kallooppara', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(392, 'Kunnamthanam', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(393, 'Mallappally', 13, 1, 116, 1, NULL, NULL, NULL, NULL, NULL),
(394, 'Kadapra', 13, 1, 117, 1, NULL, NULL, NULL, NULL, NULL),
(395, 'Kuttoor', 13, 1, 117, 1, NULL, NULL, NULL, NULL, NULL),
(396, 'Niranam', 13, 1, 117, 1, NULL, NULL, NULL, NULL, NULL),
(397, 'Nedumpuram', 13, 1, 117, 1, NULL, NULL, NULL, NULL, NULL),
(398, 'Peringara', 13, 1, 117, 1, NULL, NULL, NULL, NULL, NULL),
(399, 'Ayroor', 13, 1, 118, 1, NULL, NULL, NULL, NULL, NULL),
(400, 'Eraviperoor', 13, 1, 118, 1, NULL, NULL, NULL, NULL, NULL),
(401, 'Koipuram', 13, 1, 118, 1, NULL, NULL, NULL, NULL, NULL),
(402, 'Thottappuzhassery', 13, 1, 118, 1, NULL, NULL, NULL, NULL, NULL),
(403, 'Ezhumattoor', 13, 1, 118, 1, NULL, NULL, NULL, NULL, NULL),
(404, 'Puramattom', 13, 1, 118, 1, NULL, NULL, NULL, NULL, NULL),
(405, 'Omalloor', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(406, 'Chenneerkara', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(407, 'Elanthoor', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(408, 'Cherukole', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(409, 'Kozhencherry', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(410, 'Mallappuzhassery', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(411, 'Naranganam', 13, 1, 119, 1, NULL, NULL, NULL, NULL, NULL),
(412, 'Ranni Pazhavangadi', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(413, 'Ranni', 0, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(414, 'Ranni Angadi', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(415, 'Ranni Perunadu', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(416, 'Vadaserikara', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(417, 'Chittar', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(418, 'Seethathodu', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(419, 'Naranammoozhy', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(420, 'Vechoochira', 13, 1, 120, 1, NULL, NULL, NULL, NULL, NULL),
(421, 'Konni', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(422, 'Aruvappulam', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(423, 'Pramadom', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(424, 'Mylapra', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(425, 'Vallicode', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(426, 'Thannithodu', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(427, 'Malayalapuzha', 13, 1, 121, 1, NULL, NULL, NULL, NULL, NULL),
(428, 'Pandalam Thekkekara', 13, 1, 122, 1, NULL, NULL, NULL, NULL, NULL),
(429, 'Thumpamon', 13, 1, 122, 1, NULL, NULL, NULL, NULL, NULL),
(430, 'Aranmula', 13, 1, 122, 1, NULL, NULL, NULL, NULL, NULL),
(431, 'Mezhuveli', 13, 1, 122, 1, NULL, NULL, NULL, NULL, NULL),
(432, 'Kulanada', 13, 1, 122, 1, NULL, NULL, NULL, NULL, NULL),
(433, 'Enadimangalam', 13, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(434, 'Erathu', 13, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(435, 'Ezhamkulam', 13, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(436, 'Kadampanad', 13, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(437, 'Kalanjoor', 13, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(438, 'Kodumon', 13, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(439, 'Pallickal', 3, 1, 123, 1, NULL, NULL, NULL, NULL, NULL),
(440, 'Arookutty', 3, 1, 124, 1, NULL, NULL, NULL, NULL, NULL),
(441, 'Chennam Pallippuram', 3, 1, 124, 1, NULL, NULL, NULL, NULL, NULL),
(442, 'Panavally', 3, 1, 124, 1, NULL, NULL, NULL, NULL, NULL),
(443, 'Perumpalam', 3, 1, 124, 1, NULL, NULL, NULL, NULL, NULL),
(444, 'Thycattussery', 3, 1, 124, 1, NULL, NULL, NULL, NULL, NULL),
(445, 'Vayalar', 3, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(446, 'Pattanakkad', 3, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(447, 'Thuravoor', 0, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(448, 'Kuthiathod', 3, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(449, 'Kodamthuruth', 3, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(450, 'Ezhupunna', 3, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(451, 'Aroor', 3, 1, 125, 1, NULL, NULL, NULL, NULL, NULL),
(452, 'Mararikulam North', 3, 1, 126, 1, NULL, NULL, NULL, NULL, NULL),
(453, 'Kanjikuzhy', 3, 1, 126, 1, NULL, NULL, NULL, NULL, NULL),
(454, 'Thanneermukkom', 3, 1, 126, 1, NULL, NULL, NULL, NULL, NULL),
(455, 'Cherthala South', 3, 1, 126, 1, NULL, NULL, NULL, NULL, NULL),
(456, 'Kadakkarappally', 3, 1, 126, 1, NULL, NULL, NULL, NULL, NULL),
(457, 'Aryad', 3, 1, 127, 1, NULL, NULL, NULL, NULL, NULL),
(458, 'Mannancherry', 3, 1, 127, 1, NULL, NULL, NULL, NULL, NULL),
(459, 'Mararikulam South', 3, 1, 127, 1, NULL, NULL, NULL, NULL, NULL),
(460, 'Muhamma', 3, 1, 127, 1, NULL, NULL, NULL, NULL, NULL),
(461, 'Purakkad', 3, 1, 128, 1, NULL, NULL, NULL, NULL, NULL),
(462, 'Ambalappuzha South', 3, 1, 128, 1, NULL, NULL, NULL, NULL, NULL),
(463, 'Ambalappuzha North', 3, 1, 128, 1, NULL, NULL, NULL, NULL, NULL),
(464, 'Punnapra South', 3, 1, 128, 1, NULL, NULL, NULL, NULL, NULL),
(465, 'Punnapra North', 3, 1, 128, 1, NULL, NULL, NULL, NULL, NULL),
(466, 'Thalavady', 3, 1, 129, 1, NULL, NULL, NULL, NULL, NULL),
(467, 'Edathua', 3, 1, 129, 1, NULL, NULL, NULL, NULL, NULL),
(468, 'Thakazhy', 3, 1, 129, 1, NULL, NULL, NULL, NULL, NULL),
(469, 'Nedumudi', 3, 1, 129, 1, NULL, NULL, NULL, NULL, NULL),
(470, 'Champakulam', 3, 1, 129, 1, NULL, NULL, NULL, NULL, NULL),
(471, 'Kainakary', 3, 1, 129, 1, NULL, NULL, NULL, NULL, NULL),
(472, 'Muttar', 3, 1, 130, 1, NULL, NULL, NULL, NULL, NULL),
(473, 'Veliyanad', 3, 1, 130, 1, NULL, NULL, NULL, NULL, NULL),
(474, 'Neelamperoor', 3, 1, 130, 1, NULL, NULL, NULL, NULL, NULL),
(475, 'Kavalam', 3, 1, 130, 1, NULL, NULL, NULL, NULL, NULL),
(476, 'Pulincunnoo', 3, 1, 130, 1, NULL, NULL, NULL, NULL, NULL),
(477, 'Ramankary', 3, 1, 130, 1, NULL, NULL, NULL, NULL, NULL),
(478, 'Mulakuzha', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(479, 'Venmoney', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(480, 'Cheriyanad', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(481, 'Ala', 0, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(482, 'Puliyoor', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(483, 'Budhanoor', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(484, 'Pandanad', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(485, 'Thiruvanvandoor', 3, 1, 131, 1, NULL, NULL, NULL, NULL, NULL),
(486, 'Karthikappally', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(487, 'Thrikkunnappuzha', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(488, 'Kumarapuram', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(489, 'Karuvatta', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(490, 'Pallippad', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(491, 'Cheruthana', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(492, 'Veeyapuram', 3, 1, 132, 1, NULL, NULL, NULL, NULL, NULL),
(493, 'Mavelikara Thekkekara', 3, 1, 133, 1, NULL, NULL, NULL, NULL, NULL),
(494, 'Chettikulangara', 3, 1, 133, 1, NULL, NULL, NULL, NULL, NULL),
(495, 'Chennithala-Thripperumthura', 3, 1, 133, 1, NULL, NULL, NULL, NULL, NULL),
(496, 'Thazhakara', 3, 1, 133, 1, NULL, NULL, NULL, NULL, NULL),
(497, 'Mannar', 3, 1, 133, 1, NULL, NULL, NULL, NULL, NULL),
(498, 'Nooranad', 3, 1, 134, 1, NULL, NULL, NULL, NULL, NULL),
(499, 'Vallikunnam', 3, 1, 134, 1, NULL, NULL, NULL, NULL, NULL),
(500, 'Bharanickavu', 3, 1, 134, 1, NULL, NULL, NULL, NULL, NULL),
(501, 'Mavelikara Thamarakulam', 3, 1, 134, 1, NULL, NULL, NULL, NULL, NULL),
(502, 'Chunakara', 3, 1, 134, 1, NULL, NULL, NULL, NULL, NULL),
(503, 'Palamel', 3, 1, 134, 1, NULL, NULL, NULL, NULL, NULL),
(504, 'Pathiyoor', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(505, 'Kandalloor', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(506, 'Cheppad', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(507, 'Muthukulam', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(508, 'Arattupuzha', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(509, 'Krishnapuram', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(510, 'Devikulangara', 3, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(511, 'Chingoli', 9, 1, 135, 1, NULL, NULL, NULL, NULL, NULL),
(512, 'Thalayazham', 9, 1, 136, 1, NULL, NULL, NULL, NULL, NULL),
(513, 'Chempu', 9, 1, 136, 1, NULL, NULL, NULL, NULL, NULL),
(514, 'Maravanthuruthu', 9, 1, 136, 1, NULL, NULL, NULL, NULL, NULL),
(515, 'TV Puram', 0, 1, 136, 1, NULL, NULL, NULL, NULL, NULL),
(516, 'Vechoor', 9, 1, 136, 1, NULL, NULL, NULL, NULL, NULL),
(517, 'Udayanapuram', 9, 1, 136, 1, NULL, NULL, NULL, NULL, NULL),
(518, 'Kaduthuruthy', 9, 1, 137, 1, NULL, NULL, NULL, NULL, NULL),
(519, 'Kallara', 9, 1, 137, 1, NULL, NULL, NULL, NULL, NULL),
(520, 'Mulakulam', 9, 1, 137, 1, NULL, NULL, NULL, NULL, NULL),
(521, 'Neezhoor', 9, 1, 137, 1, NULL, NULL, NULL, NULL, NULL),
(522, 'Thalayolaparambu', 9, 1, 137, 1, NULL, NULL, NULL, NULL, NULL),
(523, 'Velloor', 9, 1, 137, 1, NULL, NULL, NULL, NULL, NULL),
(524, 'Aymanam', 9, 1, 138, 1, NULL, NULL, NULL, NULL, NULL),
(525, 'Athirampuzha', 9, 1, 138, 1, NULL, NULL, NULL, NULL, NULL),
(526, 'Arpookara', 9, 1, 138, 1, NULL, NULL, NULL, NULL, NULL),
(527, 'Neendoor', 9, 1, 138, 1, NULL, NULL, NULL, NULL, NULL),
(528, 'Kumarakam', 9, 1, 138, 1, NULL, NULL, NULL, NULL, NULL),
(529, 'Thiruvarppu', 9, 1, 138, 1, NULL, NULL, NULL, NULL, NULL),
(530, 'Kadaplamattom', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(531, 'Marangattupilly', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(532, 'Kanakkary', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(533, 'Veliyannoor', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(534, 'Kuravilangad', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(535, 'Uzhavoor', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(536, 'Ramapuram', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(537, 'Manjoor', 9, 1, 139, 1, NULL, NULL, NULL, NULL, NULL),
(538, 'Bharananganam', 9, 1, 140, 1, NULL, NULL, NULL, NULL, NULL),
(539, 'Karoor', 9, 1, 140, 1, NULL, NULL, NULL, NULL, NULL),
(540, 'Kozhuvanal', 9, 1, 140, 1, NULL, NULL, NULL, NULL, NULL),
(541, 'Kadanad', 9, 1, 140, 1, NULL, NULL, NULL, NULL, NULL),
(542, 'Meenachil', 9, 1, 140, 1, NULL, NULL, NULL, NULL, NULL),
(543, 'Mutholy', 9, 1, 140, 1, NULL, NULL, NULL, NULL, NULL),
(544, 'Melukavu', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(545, 'Moonnilavu', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(546, 'Poonjar', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(547, 'Poonjar Thekkekara', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(548, 'Thalappalam', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(549, 'Teekoy', 0, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(550, 'Thalanad', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(551, 'Thidanad', 9, 1, 141, 1, NULL, NULL, NULL, NULL, NULL),
(552, 'Akalakunnam', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(553, 'Elikulam', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(554, 'Kooroppada', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(555, 'Pampady', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(556, 'Pallikkathode', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(557, 'Meenadom', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(558, 'Kidangoor', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(559, 'Manarcad', 9, 1, 142, 1, NULL, NULL, NULL, NULL, NULL),
(560, 'Ayarkunnam', 9, 1, 143, 1, NULL, NULL, NULL, NULL, NULL),
(561, 'Puthuppally', 9, 1, 143, 1, NULL, NULL, NULL, NULL, NULL),
(562, 'Panachikkad', 9, 1, 143, 1, NULL, NULL, NULL, NULL, NULL),
(563, 'Vijayapuram', 9, 1, 143, 1, NULL, NULL, NULL, NULL, NULL),
(564, 'Kurichy', 9, 1, 143, 1, NULL, NULL, NULL, NULL, NULL),
(565, 'Madappally', 9, 1, 144, 1, NULL, NULL, NULL, NULL, NULL),
(566, 'Paippad', 9, 1, 144, 1, NULL, NULL, NULL, NULL, NULL),
(567, 'Thrickodithanam', 9, 1, 144, 1, NULL, NULL, NULL, NULL, NULL),
(568, 'Vakathanam', 9, 1, 144, 1, NULL, NULL, NULL, NULL, NULL),
(569, 'Vazhappally', 9, 1, 144, 1, NULL, NULL, NULL, NULL, NULL),
(570, 'Chirakkadavu', 9, 1, 145, 1, NULL, NULL, NULL, NULL, NULL),
(571, 'Kangazha', 9, 1, 145, 1, NULL, NULL, NULL, NULL, NULL),
(572, 'Nedumkunnam', 9, 1, 145, 1, NULL, NULL, NULL, NULL, NULL),
(573, 'Vellavoor', 9, 1, 145, 1, NULL, NULL, NULL, NULL, NULL),
(574, 'Vazhoor', 9, 1, 145, 1, NULL, NULL, NULL, NULL, NULL),
(575, 'Karukachal', 9, 1, 145, 1, NULL, NULL, NULL, NULL, NULL),
(576, 'Erumeli', 9, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(577, 'Kanjirappally', 9, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(578, 'Koottickal', 9, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(579, 'Manimala', 9, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(580, 'Mundakayam', 9, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(581, 'Parathodu', 9, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(582, 'Koruthodu', 0, 1, 146, 1, NULL, NULL, NULL, NULL, NULL),
(583, 'Adimaly', 0, 1, 147, 1, NULL, NULL, NULL, NULL, NULL),
(584, 'Konnathady', 0, 1, 147, 1, NULL, NULL, NULL, NULL, NULL),
(585, 'Bisonvalley', 0, 1, 147, 1, NULL, NULL, NULL, NULL, NULL),
(586, 'Vellathooval', 0, 1, 147, 1, NULL, NULL, NULL, NULL, NULL),
(587, 'Pallivasal', 0, 1, 147, 1, NULL, NULL, NULL, NULL, NULL),
(588, 'Marayoor', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(589, 'Munnar', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(590, 'Kanthalloor', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(591, 'Vattavada', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(592, 'Santhanpara', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(593, 'Chinnakanal', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(594, 'Mankulam', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(595, 'Devikulam', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(596, 'Edamalakudi', 0, 1, 148, 1, NULL, NULL, NULL, NULL, NULL),
(597, 'Pampadumpara', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(598, 'Senapathy', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(599, 'Karunapuram', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(600, 'Rajakkad', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(601, 'Nedumkandam', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(602, 'Udumbanchola', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(603, 'Rajakumary', 0, 1, 149, 1, NULL, NULL, NULL, NULL, NULL),
(604, 'Vannappuram', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(605, 'Udumbanoor', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(606, 'Kodikulam', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(607, 'Alakode', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(608, 'Velliyamattom', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(609, 'Karimannoor', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(610, 'Kudayathoor', 0, 1, 150, 1, NULL, NULL, NULL, NULL, NULL),
(611, 'Idukki Kanjikuzhy', 0, 1, 151, 1, NULL, NULL, NULL, NULL, NULL),
(612, 'Vathikudy', 0, 1, 151, 1, NULL, NULL, NULL, NULL, NULL),
(613, 'Arakulam', 0, 1, 151, 1, NULL, NULL, NULL, NULL, NULL),
(614, 'Kamakshy', 0, 1, 151, 1, NULL, NULL, NULL, NULL, NULL),
(615, 'Vazhathope', 0, 1, 151, 1, NULL, NULL, NULL, NULL, NULL),
(616, 'Mariyapuram', 0, 1, 151, 1, NULL, NULL, NULL, NULL, NULL),
(617, 'Upputhara', 0, 1, 152, 1, NULL, NULL, NULL, NULL, NULL),
(618, 'Vandanmedu', 0, 1, 152, 1, NULL, NULL, NULL, NULL, NULL),
(619, 'Kanchiyar', 0, 1, 152, 1, NULL, NULL, NULL, NULL, NULL),
(620, 'Erattayar', 0, 1, 152, 1, NULL, NULL, NULL, NULL, NULL),
(621, 'Ayyappan Coil', 0, 1, 152, 1, NULL, NULL, NULL, NULL, NULL),
(622, 'Chakkupallam', 0, 1, 152, 1, NULL, NULL, NULL, NULL, NULL),
(623, 'Muttom', 0, 1, 153, 1, NULL, NULL, NULL, NULL, NULL),
(624, 'Kumaramangalam', 0, 1, 153, 1, NULL, NULL, NULL, NULL, NULL),
(625, 'Edavetty', 0, 1, 153, 1, NULL, NULL, NULL, NULL, NULL),
(626, 'Karimkunnam', 0, 1, 153, 1, NULL, NULL, NULL, NULL, NULL),
(627, 'Manakkad', 0, 1, 153, 1, NULL, NULL, NULL, NULL, NULL),
(628, 'Purapuzha', 0, 1, 153, 1, NULL, NULL, NULL, NULL, NULL),
(629, 'Peruvanthanam', 0, 1, 154, 1, NULL, NULL, NULL, NULL, NULL),
(630, 'Kumily', 0, 1, 154, 1, NULL, NULL, NULL, NULL, NULL),
(631, 'Kokkayar', 0, 1, 154, 1, NULL, NULL, NULL, NULL, NULL),
(632, 'Peermade', 0, 1, 154, 1, NULL, NULL, NULL, NULL, NULL),
(633, 'Elappara', 0, 1, 154, 1, NULL, NULL, NULL, NULL, NULL),
(634, 'Vandiperiyar', 4, 1, 154, 1, NULL, NULL, NULL, NULL, NULL),
(635, 'Chendamangalam', 4, 1, 155, 1, NULL, NULL, NULL, NULL, NULL),
(636, 'Kottuvally', 4, 1, 155, 1, NULL, NULL, NULL, NULL, NULL),
(637, 'Ezhikkara', 4, 1, 155, 1, NULL, NULL, NULL, NULL, NULL),
(638, 'Vadakkekkara', 4, 1, 155, 1, NULL, NULL, NULL, NULL, NULL),
(639, 'Chittattukara', 4, 1, 155, 1, NULL, NULL, NULL, NULL, NULL),
(640, 'Karumallur', 4, 1, 156, 1, NULL, NULL, NULL, NULL, NULL),
(641, 'Varapuzha', 4, 1, 156, 1, NULL, NULL, NULL, NULL, NULL),
(642, 'Alangad', 4, 1, 156, 1, NULL, NULL, NULL, NULL, NULL),
(643, 'Kadungalloor', 4, 1, 156, 1, NULL, NULL, NULL, NULL, NULL),
(644, 'Mookkannur', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(645, 'Thuravoor', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(646, 'Manjapra', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(647, 'Karukutty', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(648, 'Ayyampuzha', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(649, 'Kanjoor', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(650, 'Kalady', 4, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(651, 'Malayattoor Neeleeswaram', 0, 1, 157, 1, NULL, NULL, NULL, NULL, NULL),
(652, 'Asamannoor', 4, 1, 158, 1, NULL, NULL, NULL, NULL, NULL),
(653, 'Mudakuzha', 4, 1, 158, 1, NULL, NULL, NULL, NULL, NULL),
(654, 'Vengoor', 4, 1, 158, 1, NULL, NULL, NULL, NULL, NULL),
(655, 'Rayamangalam', 4, 1, 158, 1, NULL, NULL, NULL, NULL, NULL),
(656, 'Koovappady', 4, 1, 158, 1, NULL, NULL, NULL, NULL, NULL),
(657, 'Okkal', 4, 1, 158, 1, NULL, NULL, NULL, NULL, NULL),
(658, 'Vengola', 4, 1, 159, 1, NULL, NULL, NULL, NULL, NULL),
(659, 'Vazhakulam', 4, 1, 159, 1, NULL, NULL, NULL, NULL, NULL),
(660, 'Kizhakkambalam', 4, 1, 159, 1, NULL, NULL, NULL, NULL, NULL),
(661, 'Choornikkara', 4, 1, 159, 1, NULL, NULL, NULL, NULL, NULL),
(662, 'Edathala', 4, 1, 159, 1, NULL, NULL, NULL, NULL, NULL),
(663, 'Keezhmad', 4, 1, 159, 1, NULL, NULL, NULL, NULL, NULL),
(664, 'Kadamakudy', 4, 1, 160, 1, NULL, NULL, NULL, NULL, NULL),
(665, 'Cheranalloor', 4, 1, 160, 1, NULL, NULL, NULL, NULL, NULL),
(666, 'Mulavukad', 4, 1, 160, 1, NULL, NULL, NULL, NULL, NULL),
(667, 'Elankunnapuzha', 4, 1, 160, 1, NULL, NULL, NULL, NULL, NULL),
(668, 'Narakal', 4, 1, 161, 1, NULL, NULL, NULL, NULL, NULL),
(669, 'Nayarambalam', 4, 1, 161, 1, NULL, NULL, NULL, NULL, NULL),
(670, 'Edavanakkad', 4, 1, 161, 1, NULL, NULL, NULL, NULL, NULL),
(671, 'Pallippuram', 4, 1, 161, 1, NULL, NULL, NULL, NULL, NULL),
(672, 'Kuzhuppilly', 4, 1, 161, 1, NULL, NULL, NULL, NULL, NULL),
(673, 'Chellanam', 4, 1, 162, 1, NULL, NULL, NULL, NULL, NULL),
(674, 'Kumbalanghi', 4, 1, 162, 1, NULL, NULL, NULL, NULL, NULL),
(675, 'Kumbalam', 4, 1, 162, 1, NULL, NULL, NULL, NULL, NULL),
(676, 'Udayamperoor', 4, 1, 163, 1, NULL, NULL, NULL, NULL, NULL),
(677, 'Mulanthuruthy', 4, 1, 163, 1, NULL, NULL, NULL, NULL, NULL),
(678, 'Chottanikkara', 4, 1, 163, 1, NULL, NULL, NULL, NULL, NULL),
(679, 'Edakkattuvayal', 4, 1, 163, 1, NULL, NULL, NULL, NULL, NULL),
(680, 'Amballoor', 4, 1, 163, 1, NULL, NULL, NULL, NULL, NULL),
(681, 'Maneed', 4, 1, 163, 1, NULL, NULL, NULL, NULL, NULL),
(682, 'Poothrikka', 4, 1, 164, 1, NULL, NULL, NULL, NULL, NULL),
(683, 'Thiruvaniyoor', 4, 1, 164, 1, NULL, NULL, NULL, NULL, NULL),
(684, 'Vadavucode Puthencruz', 4, 1, 164, 1, NULL, NULL, NULL, NULL, NULL),
(685, 'Mazhuvannoor', 0, 1, 164, 1, NULL, NULL, NULL, NULL, NULL),
(686, 'Aikaranad', 4, 1, 164, 1, NULL, NULL, NULL, NULL, NULL),
(687, 'Kunnathunad', 4, 1, 164, 1, NULL, NULL, NULL, NULL, NULL),
(688, 'Paingottoor', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(689, 'Nellikuzhi', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(690, 'Pindimana', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(691, 'Kottappady', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(692, 'Kavalangad', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(693, 'Varappetty', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(694, 'Keerampara', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(695, 'Pothanicad', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(696, 'Pallarimangalam', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(697, 'Kuttampuzha', 4, 1, 165, 1, NULL, NULL, NULL, NULL, NULL),
(698, 'Elanji', 4, 1, 166, 1, NULL, NULL, NULL, NULL, NULL),
(699, 'Thirumarady', 4, 1, 166, 1, NULL, NULL, NULL, NULL, NULL),
(700, 'Palakuzha', 4, 1, 166, 1, NULL, NULL, NULL, NULL, NULL),
(701, 'Pampakuda', 4, 1, 166, 1, NULL, NULL, NULL, NULL, NULL),
(702, 'Ramamangalam', 4, 1, 166, 1, NULL, NULL, NULL, NULL, NULL),
(703, 'Puthenvelikkara', 4, 1, 167, 1, NULL, NULL, NULL, NULL, NULL),
(704, 'Chengamanad', 4, 1, 167, 1, NULL, NULL, NULL, NULL, NULL),
(705, 'Nedumbassery', 4, 1, 167, 1, NULL, NULL, NULL, NULL, NULL),
(706, 'Parakkadavu', 4, 1, 167, 1, NULL, NULL, NULL, NULL, NULL),
(707, 'Kunnukara', 4, 1, 167, 1, NULL, NULL, NULL, NULL, NULL),
(708, 'Sreemoolanagaram', 4, 1, 167, 1, NULL, NULL, NULL, NULL, NULL),
(709, 'Avoly', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(710, 'Arakuzha', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(711, 'Valakom', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(712, 'Paipra', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(713, 'Kalloorkad', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(714, 'Ayavana', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(715, 'Manjalloor', 4, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(716, 'Marady', 15, 1, 168, 1, NULL, NULL, NULL, NULL, NULL),
(717, 'Kadappuram', 15, 1, 169, 1, NULL, NULL, NULL, NULL, NULL),
(718, 'Orumanayur', 15, 1, 169, 1, NULL, NULL, NULL, NULL, NULL),
(719, 'Punnayur', 0, 1, 169, 1, NULL, NULL, NULL, NULL, NULL),
(720, 'Punnayurkulam', 15, 1, 169, 1, NULL, NULL, NULL, NULL, NULL),
(721, 'Vadakkekkad', 15, 1, 169, 1, NULL, NULL, NULL, NULL, NULL),
(722, 'Choondal', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(723, 'Chowannur', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(724, 'Kadavallur', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(725, 'Kandanassery', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(726, 'Kattakampal', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(727, 'Porkulam', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(728, 'Kadangode', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(729, 'Velur', 15, 1, 170, 1, NULL, NULL, NULL, NULL, NULL),
(730, 'Desamangalam', 15, 1, 171, 1, NULL, NULL, NULL, NULL, NULL),
(731, 'Erumapetty', 15, 1, 171, 1, NULL, NULL, NULL, NULL, NULL),
(732, 'Mullurkara', 15, 1, 171, 1, NULL, NULL, NULL, NULL, NULL),
(733, 'Thekkumkara', 15, 1, 171, 1, NULL, NULL, NULL, NULL, NULL),
(734, 'Varavoor', 15, 1, 171, 1, NULL, NULL, NULL, NULL, NULL),
(735, 'Chelakkara', 15, 1, 172, 1, NULL, NULL, NULL, NULL, NULL),
(736, 'Vallathol Nagar', 15, 1, 172, 1, NULL, NULL, NULL, NULL, NULL),
(737, 'Kondazhy', 15, 1, 172, 1, NULL, NULL, NULL, NULL, NULL),
(738, 'Panjal', 15, 1, 172, 1, NULL, NULL, NULL, NULL, NULL),
(739, 'Pazhayannur', 15, 1, 172, 1, NULL, NULL, NULL, NULL, NULL),
(740, 'Thiruvilwamala', 15, 1, 172, 1, NULL, NULL, NULL, NULL, NULL),
(741, 'Madakkathara', 15, 1, 173, 1, NULL, NULL, NULL, NULL, NULL),
(742, 'Nadathara', 15, 1, 173, 1, NULL, NULL, NULL, NULL, NULL),
(743, 'Pananchery', 15, 1, 173, 1, NULL, NULL, NULL, NULL, NULL),
(744, 'Puthur', 15, 1, 173, 1, NULL, NULL, NULL, NULL, NULL),
(745, 'Adat', 15, 1, 174, 1, NULL, NULL, NULL, NULL, NULL),
(746, 'Avanur', 15, 1, 174, 1, NULL, NULL, NULL, NULL, NULL),
(747, 'Kaiparambu', 15, 1, 174, 1, NULL, NULL, NULL, NULL, NULL),
(748, 'Mulakunnathukavu', 15, 1, 174, 1, NULL, NULL, NULL, NULL, NULL),
(749, 'Tholur', 15, 1, 174, 1, NULL, NULL, NULL, NULL, NULL),
(750, 'Kolazhy', 15, 1, 174, 1, NULL, NULL, NULL, NULL, NULL),
(751, 'Elavally', 15, 1, 175, 1, NULL, NULL, NULL, NULL, NULL),
(752, 'Mullassery', 15, 1, 175, 1, NULL, NULL, NULL, NULL, NULL),
(753, 'Pavaratty', 0, 1, 175, 1, NULL, NULL, NULL, NULL, NULL),
(754, 'Venkitangu', 15, 1, 175, 1, NULL, NULL, NULL, NULL, NULL),
(755, 'Engandiyur', 15, 1, 176, 1, NULL, NULL, NULL, NULL, NULL),
(756, 'Vatanappally', 15, 1, 176, 1, NULL, NULL, NULL, NULL, NULL),
(757, 'Thalikulam', 15, 1, 176, 1, NULL, NULL, NULL, NULL, NULL),
(758, 'Nattika', 15, 1, 176, 1, NULL, NULL, NULL, NULL, NULL),
(759, 'Valapad', 15, 1, 176, 1, NULL, NULL, NULL, NULL, NULL),
(760, 'Anthikad', 15, 1, 177, 1, NULL, NULL, NULL, NULL, NULL),
(761, 'Thanniyam', 15, 1, 177, 1, NULL, NULL, NULL, NULL, NULL),
(762, 'Chazhur', 15, 1, 177, 1, NULL, NULL, NULL, NULL, NULL),
(763, 'Manalur', 15, 1, 177, 1, NULL, NULL, NULL, NULL, NULL),
(764, 'Arimpur', 15, 1, 177, 1, NULL, NULL, NULL, NULL, NULL),
(765, 'Avinissery', 15, 1, 178, 1, NULL, NULL, NULL, NULL, NULL),
(766, 'Cherpu', 15, 1, 178, 1, NULL, NULL, NULL, NULL, NULL),
(767, 'Paralam', 15, 1, 178, 1, NULL, NULL, NULL, NULL, NULL),
(768, 'Vallachira', 15, 1, 178, 1, NULL, NULL, NULL, NULL, NULL),
(769, 'Alagappanagar', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(770, 'Kodakara', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(771, 'Mattathur', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(772, 'Nenmanikkara', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(773, 'Pudukad', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(774, 'Thrikkur', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(775, 'Varandarappilly', 15, 1, 179, 1, NULL, NULL, NULL, NULL, NULL),
(776, 'Karalam', 15, 1, 180, 1, NULL, NULL, NULL, NULL, NULL),
(777, 'Kattoor', 15, 1, 180, 1, NULL, NULL, NULL, NULL, NULL),
(778, 'Muriyad', 15, 1, 180, 1, NULL, NULL, NULL, NULL, NULL),
(779, 'Parappukkara', 15, 1, 180, 1, NULL, NULL, NULL, NULL, NULL),
(780, 'Padiyur', 15, 1, 181, 1, NULL, NULL, NULL, NULL, NULL),
(781, 'Poomangalam', 15, 1, 181, 1, NULL, NULL, NULL, NULL, NULL),
(782, 'Puthenchira', 15, 1, 181, 1, NULL, NULL, NULL, NULL, NULL),
(783, 'Vellangallur', 15, 1, 181, 1, NULL, NULL, NULL, NULL, NULL),
(784, 'Velukara', 15, 1, 181, 1, NULL, NULL, NULL, NULL, NULL),
(785, 'Edathiruthy', 15, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(786, 'Kaipamangalam', 15, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(787, 'Mathilakam', 0, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(788, 'Perinjanam', 15, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(789, 'Sreenarayanapuram', 15, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(790, 'Edavilangu', 15, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(791, 'Eriyad', 15, 1, 182, 1, NULL, NULL, NULL, NULL, NULL),
(792, 'Aloor', 15, 1, 183, 1, NULL, NULL, NULL, NULL, NULL),
(793, 'Annamanada', 15, 1, 183, 1, NULL, NULL, NULL, NULL, NULL),
(794, 'Kuzhur', 15, 1, 183, 1, NULL, NULL, NULL, NULL, NULL),
(795, 'Mala', 15, 1, 183, 1, NULL, NULL, NULL, NULL, NULL),
(796, 'Poyya', 15, 1, 183, 1, NULL, NULL, NULL, NULL, NULL),
(797, 'Kadukutty', 15, 1, 184, 1, NULL, NULL, NULL, NULL, NULL),
(798, 'Kodassery', 15, 1, 184, 1, NULL, NULL, NULL, NULL, NULL),
(799, 'Koratty', 15, 1, 184, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ori_localbody` (`id`, `name`, `district_id`, `localbodyTypeId`, `parent_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(800, 'Meloor', 15, 1, 184, 1, NULL, NULL, NULL, NULL, NULL),
(801, 'Pariyaram', 15, 1, 184, 1, NULL, NULL, NULL, NULL, NULL),
(802, 'Athirappilly', 12, 1, 184, 1, NULL, NULL, NULL, NULL, NULL),
(803, 'Anakkara', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(804, 'Chalissery', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(805, 'Kappur', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(806, 'Nagalassery', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(807, 'Pattithara', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(808, 'Thirumittacode', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(809, 'Trithala', 12, 1, 185, 1, NULL, NULL, NULL, NULL, NULL),
(810, 'Koppam', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(811, 'Kulukkallur', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(812, 'Muthuthala', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(813, 'Ongallur', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(814, 'Paruthur', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(815, 'Thiruvegappura', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(816, 'Vilayur', 12, 1, 186, 1, NULL, NULL, NULL, NULL, NULL),
(817, 'Ambalappara', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(818, 'Ananganadi', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(819, 'Chalavara', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(820, 'Lakkidi - Perur', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(821, 'Vaniamkulam', 0, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(822, 'Trikkaderi', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(823, 'Vallapuzha', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(824, 'Nellaya', 12, 1, 187, 1, NULL, NULL, NULL, NULL, NULL),
(825, 'Kadampazhipuram', 12, 1, 188, 1, NULL, NULL, NULL, NULL, NULL),
(826, 'Karimpuzha', 12, 1, 188, 1, NULL, NULL, NULL, NULL, NULL),
(827, 'Pookkottukavu', 12, 1, 188, 1, NULL, NULL, NULL, NULL, NULL),
(828, 'Sreekrishnapuram', 12, 1, 188, 1, NULL, NULL, NULL, NULL, NULL),
(829, 'Vellinezhi', 12, 1, 188, 1, NULL, NULL, NULL, NULL, NULL),
(830, 'Karakurussi', 12, 1, 188, 1, NULL, NULL, NULL, NULL, NULL),
(831, 'Alanallur', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(832, 'Karimba', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(833, 'Kottopadam', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(834, 'Kumaramputhur', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(835, 'Kanhirapuzha', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(836, 'Thachanattukara', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(837, 'Tachampara', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(838, 'Thenkara', 12, 1, 189, 1, NULL, NULL, NULL, NULL, NULL),
(839, 'Agali', 12, 1, 190, 1, NULL, NULL, NULL, NULL, NULL),
(840, 'Pudur', 12, 1, 190, 1, NULL, NULL, NULL, NULL, NULL),
(841, 'Sholayoor', 12, 1, 190, 1, NULL, NULL, NULL, NULL, NULL),
(842, 'Keralassery', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(843, 'Kongad', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(844, 'Mankara', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(845, 'Mannur', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(846, 'Mundur', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(847, 'Parali', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(848, 'Pirayiri', 12, 1, 191, 1, NULL, NULL, NULL, NULL, NULL),
(849, 'Kottayi', 12, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(850, 'Kuthanur', 12, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(851, 'Kuzhalmannam', 12, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(852, 'Mathur', 12, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(853, 'Peringottukurissi', 12, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(854, 'Thenkurissi', 12, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(855, 'Kannadi', 0, 1, 192, 1, NULL, NULL, NULL, NULL, NULL),
(856, 'Eruthenpathy', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(857, 'Kozhinjampara', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(858, 'Nallepilly', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(859, 'Perumatty', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(860, 'Vadakarapathy', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(861, 'Elappully', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(862, 'Polpully', 12, 1, 193, 1, NULL, NULL, NULL, NULL, NULL),
(863, 'Kollengode', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(864, 'Koduvayur', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(865, 'Muthalamada', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(866, 'Pudunagaram', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(867, 'Vadavannur', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(868, 'Pattanchery', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(869, 'Peruvemba', 12, 1, 194, 1, NULL, NULL, NULL, NULL, NULL),
(870, 'Ayalur', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(871, 'Nelliyampathy', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(872, 'Elavancherry', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(873, 'Pallassana', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(874, 'Melarcode', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(875, 'Nemmara', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(876, 'Vandazhy', 12, 1, 195, 1, NULL, NULL, NULL, NULL, NULL),
(877, 'Alathur', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(878, 'Erimayur', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(879, 'Kavassery', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(880, 'Kizhakkencherry', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(881, 'Puducode', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(882, 'Tarur', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(883, 'Vadakkenchery', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(884, 'Kannambra', 12, 1, 196, 1, NULL, NULL, NULL, NULL, NULL),
(885, 'Akathethara', 12, 1, 197, 1, NULL, NULL, NULL, NULL, NULL),
(886, 'Malampuzha', 12, 1, 197, 1, NULL, NULL, NULL, NULL, NULL),
(887, 'Marutharode', 12, 1, 197, 1, NULL, NULL, NULL, NULL, NULL),
(888, 'Puduppariyaram', 12, 1, 197, 1, NULL, NULL, NULL, NULL, NULL),
(889, 'Pudusseri', 0, 1, 197, 1, NULL, NULL, NULL, NULL, NULL),
(890, 'Kodumbu', 11, 1, 197, 1, NULL, NULL, NULL, NULL, NULL),
(891, 'Chaliyar', 11, 1, 198, 1, NULL, NULL, NULL, NULL, NULL),
(892, 'Chungathara', 11, 1, 198, 1, NULL, NULL, NULL, NULL, NULL),
(893, 'Moothedam', 11, 1, 198, 1, NULL, NULL, NULL, NULL, NULL),
(894, 'Vazhikkadavu', 11, 1, 198, 1, NULL, NULL, NULL, NULL, NULL),
(895, 'Edakkara', 11, 1, 198, 1, NULL, NULL, NULL, NULL, NULL),
(896, 'Pothukallu', 11, 1, 198, 1, NULL, NULL, NULL, NULL, NULL),
(897, 'Amarambalam', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(898, 'Karulai', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(899, 'Kalikavu', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(900, 'Chokkad', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(901, 'Karuvarakundu', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(902, 'Tuvvur', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(903, 'Edappatta', 11, 1, 199, 1, NULL, NULL, NULL, NULL, NULL),
(904, 'Mampad', 11, 1, 200, 1, NULL, NULL, NULL, NULL, NULL),
(905, 'Pandikkad', 11, 1, 200, 1, NULL, NULL, NULL, NULL, NULL),
(906, 'Porur', 11, 1, 200, 1, NULL, NULL, NULL, NULL, NULL),
(907, 'Thrikkalangodu', 11, 1, 200, 1, NULL, NULL, NULL, NULL, NULL),
(908, 'Thiruvali', 11, 1, 200, 1, NULL, NULL, NULL, NULL, NULL),
(909, 'Wandoor', 11, 1, 200, 1, NULL, NULL, NULL, NULL, NULL),
(910, 'Chelembra', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(911, 'Cherukavu', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(912, 'Pallikkal', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(913, 'Vazhayur', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(914, 'Vazhakkad', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(915, 'Pulikkal', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(916, 'Muthuvalloor', 11, 1, 201, 1, NULL, NULL, NULL, NULL, NULL),
(917, 'Urangattiri', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(918, 'Kavanur', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(919, 'Keezhuparamba', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(920, 'Pulpatta', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(921, 'Cheacode', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(922, 'Kuzhimanna', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(923, 'Areacode', 0, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(924, 'Edavanna', 11, 1, 202, 1, NULL, NULL, NULL, NULL, NULL),
(925, 'Anakkayam', 11, 1, 203, 1, NULL, NULL, NULL, NULL, NULL),
(926, 'Morayur', 11, 1, 203, 1, NULL, NULL, NULL, NULL, NULL),
(927, 'Ponmala', 11, 1, 203, 1, NULL, NULL, NULL, NULL, NULL),
(928, 'Pookkottur', 11, 1, 203, 1, NULL, NULL, NULL, NULL, NULL),
(929, 'Kodur', 11, 1, 203, 1, NULL, NULL, NULL, NULL, NULL),
(930, 'Othukkungal', 11, 1, 203, 1, NULL, NULL, NULL, NULL, NULL),
(931, 'Aliparamba', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(932, 'Elamkulam', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(933, 'Melattur', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(934, 'Keezhattur', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(935, 'Thazhekkode', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(936, 'Vettathur', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(937, 'Pulamanthole', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(938, 'Angadippuram', 11, 1, 204, 1, NULL, NULL, NULL, NULL, NULL),
(939, 'Kuruva', 11, 1, 205, 1, NULL, NULL, NULL, NULL, NULL),
(940, 'Mankada', 11, 1, 205, 1, NULL, NULL, NULL, NULL, NULL),
(941, 'Makkaraparamba', 11, 1, 205, 1, NULL, NULL, NULL, NULL, NULL),
(942, 'Moorkkanad', 11, 1, 205, 1, NULL, NULL, NULL, NULL, NULL),
(943, 'Koottilangadi', 11, 1, 205, 1, NULL, NULL, NULL, NULL, NULL),
(944, 'Puzhakkattiri', 11, 1, 205, 1, NULL, NULL, NULL, NULL, NULL),
(945, 'Athavanad', 11, 1, 206, 1, NULL, NULL, NULL, NULL, NULL),
(946, 'Edayur', 11, 1, 206, 1, NULL, NULL, NULL, NULL, NULL),
(947, 'Irimbiliyam', 11, 1, 206, 1, NULL, NULL, NULL, NULL, NULL),
(948, 'Marakkara', 11, 1, 206, 1, NULL, NULL, NULL, NULL, NULL),
(949, 'Kuttipuram', 11, 1, 206, 1, NULL, NULL, NULL, NULL, NULL),
(950, 'Kalpakanchery', 11, 1, 206, 1, NULL, NULL, NULL, NULL, NULL),
(951, 'Abdurahiman Nagar', 11, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(952, 'Edarikode', 11, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(953, 'Parappur', 11, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(954, 'Thennala', 11, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(955, 'Vengara', 11, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(956, 'Kannamangalam', 11, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(957, 'Oorakam', 0, 1, 207, 1, NULL, NULL, NULL, NULL, NULL),
(958, 'Thenhipalam', 11, 1, 208, 1, NULL, NULL, NULL, NULL, NULL),
(959, 'Vallikkunnu', 11, 1, 208, 1, NULL, NULL, NULL, NULL, NULL),
(960, 'Moonniyur', 11, 1, 208, 1, NULL, NULL, NULL, NULL, NULL),
(961, 'Nannambra', 11, 1, 208, 1, NULL, NULL, NULL, NULL, NULL),
(962, 'Peruvalloor', 11, 1, 208, 1, NULL, NULL, NULL, NULL, NULL),
(963, 'Cheriyamundam', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(964, 'Ozhur', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(965, 'Tanalur', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(966, 'Valavannur', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(967, 'Ponmundam', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(968, 'Niramaruthur', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(969, 'Perumanna Klari', 11, 1, 209, 1, NULL, NULL, NULL, NULL, NULL),
(970, 'Purathur', 11, 1, 210, 1, NULL, NULL, NULL, NULL, NULL),
(971, 'Thalakkad', 11, 1, 210, 1, NULL, NULL, NULL, NULL, NULL),
(972, 'Triprangode', 11, 1, 210, 1, NULL, NULL, NULL, NULL, NULL),
(973, 'Vettom', 11, 1, 210, 1, NULL, NULL, NULL, NULL, NULL),
(974, 'Thirunavaya', 11, 1, 210, 1, NULL, NULL, NULL, NULL, NULL),
(975, 'Mangalam', 11, 1, 210, 1, NULL, NULL, NULL, NULL, NULL),
(976, 'Tavanur', 11, 1, 211, 1, NULL, NULL, NULL, NULL, NULL),
(977, 'Vattamkulam', 11, 1, 211, 1, NULL, NULL, NULL, NULL, NULL),
(978, 'Edapal', 11, 1, 211, 1, NULL, NULL, NULL, NULL, NULL),
(979, 'Kaladi', 11, 1, 211, 1, NULL, NULL, NULL, NULL, NULL),
(980, 'Alamkode', 11, 1, 212, 1, NULL, NULL, NULL, NULL, NULL),
(981, 'Maranchery', 11, 1, 212, 1, NULL, NULL, NULL, NULL, NULL),
(982, 'Nannammukku', 11, 1, 212, 1, NULL, NULL, NULL, NULL, NULL),
(983, 'Perumpadappa', 11, 1, 212, 1, NULL, NULL, NULL, NULL, NULL),
(984, 'Veliancode', 0, 1, 212, 1, NULL, NULL, NULL, NULL, NULL),
(985, 'Azhiyur', 0, 1, 213, 1, NULL, NULL, NULL, NULL, NULL),
(986, 'Chorode', 0, 1, 213, 1, NULL, NULL, NULL, NULL, NULL),
(987, 'Eramala', 0, 1, 213, 1, NULL, NULL, NULL, NULL, NULL),
(988, 'Onchiyam', 0, 1, 213, 1, NULL, NULL, NULL, NULL, NULL),
(989, 'Chekkiad', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(990, 'Edacheri', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(991, 'Purameri', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(992, 'Tuneri', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(993, 'Valayam', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(994, 'Vanimal', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(995, 'Nadapuram', 0, 1, 214, 1, NULL, NULL, NULL, NULL, NULL),
(996, 'Kunnummal', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(997, 'Kayakkody', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(998, 'Kavilumpara', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(999, 'Kuttiadi', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(1000, 'Maruthonkara', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(1001, 'Velom', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(1002, 'Narippatta', 0, 1, 215, 1, NULL, NULL, NULL, NULL, NULL),
(1003, 'Ayancheri', 0, 1, 216, 1, NULL, NULL, NULL, NULL, NULL),
(1004, 'Villiappally', 0, 1, 216, 1, NULL, NULL, NULL, NULL, NULL),
(1005, 'Maniyur', 0, 1, 216, 1, NULL, NULL, NULL, NULL, NULL),
(1006, 'Thiruvallur', 0, 1, 216, 1, NULL, NULL, NULL, NULL, NULL),
(1007, 'Thurayur', 0, 1, 217, 1, NULL, NULL, NULL, NULL, NULL),
(1008, 'Keezhariyur', 0, 1, 217, 1, NULL, NULL, NULL, NULL, NULL),
(1009, 'Thikkodi', 0, 1, 217, 1, NULL, NULL, NULL, NULL, NULL),
(1010, 'Meppayur', 0, 1, 217, 1, NULL, NULL, NULL, NULL, NULL),
(1011, 'Cheruvannur', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1012, 'Nochad', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1013, 'Changaroth', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1014, 'Kayanna', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1015, 'Koothali', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1016, 'Perambra', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1017, 'Chakkittapara', 0, 1, 218, 1, NULL, NULL, NULL, NULL, NULL),
(1018, 'Balussery', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1019, 'Naduvannur', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1020, 'Ulliyeri', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1021, 'Kottur', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1022, 'Unnikulum', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1023, 'Panangad', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1024, 'Koorachundu', 0, 1, 219, 1, NULL, NULL, NULL, NULL, NULL),
(1025, 'Chemanchery', 0, 1, 220, 1, NULL, NULL, NULL, NULL, NULL),
(1026, 'Arikkulam', 0, 1, 220, 1, NULL, NULL, NULL, NULL, NULL),
(1027, 'Moodadi', 0, 1, 220, 1, NULL, NULL, NULL, NULL, NULL),
(1028, 'Chengottukavu', 0, 1, 220, 1, NULL, NULL, NULL, NULL, NULL),
(1029, 'Atholi', 0, 1, 220, 1, NULL, NULL, NULL, NULL, NULL),
(1030, 'Kakkodi', 0, 1, 221, 1, NULL, NULL, NULL, NULL, NULL),
(1031, 'Chelannur', 0, 1, 221, 1, NULL, NULL, NULL, NULL, NULL),
(1032, 'Kakkur', 0, 1, 221, 1, NULL, NULL, NULL, NULL, NULL),
(1033, 'Nanminda', 0, 1, 221, 1, NULL, NULL, NULL, NULL, NULL),
(1034, 'Narikunni', 0, 1, 221, 1, NULL, NULL, NULL, NULL, NULL),
(1035, 'Thalakulathur', 0, 1, 221, 1, NULL, NULL, NULL, NULL, NULL),
(1036, 'Thiruvambadi', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1037, 'Koodaranhi', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1038, 'Kizhakkoth', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1039, 'Madavoor', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1040, 'Puduppady', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1041, 'Thamarassery', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1042, 'Omassery', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1043, 'Kattippara', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1044, 'Kodanchery', 0, 1, 222, 1, NULL, NULL, NULL, NULL, NULL),
(1045, 'Kodiyathur', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1046, 'Kuruvattoor', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1047, 'Mavoor', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1048, 'Karassery', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1049, 'Kunnamangalam', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1050, 'Chathamangalam', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1051, 'Peruvayal', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1052, 'Perumanna', 0, 1, 223, 1, NULL, NULL, NULL, NULL, NULL),
(1053, 'Kadalundi', 0, 1, 224, 1, NULL, NULL, NULL, NULL, NULL),
(1054, 'Olavanna', 16, 1, 224, 1, NULL, NULL, NULL, NULL, NULL),
(1055, 'Vellamunda', 16, 1, 225, 1, NULL, NULL, NULL, NULL, NULL),
(1056, 'Thirunelly', 16, 1, 225, 1, NULL, NULL, NULL, NULL, NULL),
(1057, 'Thondernad', 16, 1, 225, 1, NULL, NULL, NULL, NULL, NULL),
(1058, 'Edavaka', 16, 1, 225, 1, NULL, NULL, NULL, NULL, NULL),
(1059, 'Thavinhal', 0, 1, 225, 1, NULL, NULL, NULL, NULL, NULL),
(1060, 'Panamaram', 16, 1, 226, 1, NULL, NULL, NULL, NULL, NULL),
(1061, 'Poothadi', 16, 1, 226, 1, NULL, NULL, NULL, NULL, NULL),
(1062, 'Mullankolly', 16, 1, 226, 1, NULL, NULL, NULL, NULL, NULL),
(1063, 'Pulpally', 16, 1, 226, 1, NULL, NULL, NULL, NULL, NULL),
(1064, 'Kaniyambetta', 16, 1, 226, 1, NULL, NULL, NULL, NULL, NULL),
(1065, 'Meenangadi', 16, 1, 227, 1, NULL, NULL, NULL, NULL, NULL),
(1066, 'Nenmeni', 16, 1, 227, 1, NULL, NULL, NULL, NULL, NULL),
(1067, 'Ambalavayal', 16, 1, 227, 1, NULL, NULL, NULL, NULL, NULL),
(1068, 'Noolpuzha', 16, 1, 227, 1, NULL, NULL, NULL, NULL, NULL),
(1069, 'Kottathara', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1070, 'Vengappally', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1071, 'Vythiri', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1072, 'Muttil', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1073, 'Pozhuthana', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1074, 'Thariode', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1075, 'Padinharathara', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1076, 'Meppadi', 16, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1077, 'Muppainad', 6, 1, 228, 1, NULL, NULL, NULL, NULL, NULL),
(1078, 'Kunhimangalam', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1079, 'Ramanthali', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1080, 'Karivellur Peralam', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1081, 'Kankol - Alappadamba', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1082, 'Eramam Kuttur', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1083, 'Peringome Vayakkara', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1084, 'Cherupuzha', 6, 1, 229, 1, NULL, NULL, NULL, NULL, NULL),
(1085, 'Cheruthazham', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1086, 'Ezhome', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1087, 'Madayi', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1088, 'Mattool', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1089, 'Cherukunnu', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1090, 'Kalliasseri', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1091, 'Kannapuram', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1092, 'Narath', 6, 1, 230, 1, NULL, NULL, NULL, NULL, NULL),
(1093, 'Pattuvam', 0, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1094, 'Chengalayi', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1095, 'Kurumathur', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1096, 'Pariyaram', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1097, 'Chapparapadava', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1098, 'Naduvil', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1099, 'Udayagiri', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1100, 'Alakode', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1101, 'Kadannappally Panapuzha', 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1102, 'Eruvessy', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1103, 'Irikkur', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1104, 'Malappattam', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1105, 'Payyavoor', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1106, 'Kuttiattoor', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1107, 'Mayyil', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1108, 'Padiyoor', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1109, 'Ulikkal', 6, 1, 232, 1, NULL, NULL, NULL, NULL, NULL),
(1110, 'Chirakkal', 6, 1, 233, 1, NULL, NULL, NULL, NULL, NULL),
(1111, 'Valapattanam', 6, 1, 233, 1, NULL, NULL, NULL, NULL, NULL),
(1112, 'Azhikode', 6, 1, 233, 1, NULL, NULL, NULL, NULL, NULL),
(1113, 'Pappinisseri', 6, 1, 233, 1, NULL, NULL, NULL, NULL, NULL),
(1114, 'Kadambur', 6, 1, 234, 1, NULL, NULL, NULL, NULL, NULL),
(1115, 'Chembilode', 6, 1, 234, 1, NULL, NULL, NULL, NULL, NULL),
(1116, 'Munderi', 6, 1, 234, 1, NULL, NULL, NULL, NULL, NULL),
(1117, 'Peralassery', 6, 1, 234, 1, NULL, NULL, NULL, NULL, NULL),
(1118, 'Kolachery', 6, 1, 234, 1, NULL, NULL, NULL, NULL, NULL),
(1119, 'Dharmadam', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1120, 'Eranholi', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1121, 'Pinarayi', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1122, 'New Mahe', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1123, 'Muzhappilangad', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1124, 'Anjarakandy', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1125, 'Vengad', 6, 1, 235, 1, NULL, NULL, NULL, NULL, NULL),
(1126, 'Kadirur', 6, 1, 236, 1, NULL, NULL, NULL, NULL, NULL),
(1127, 'Chokli', 0, 1, 236, 1, NULL, NULL, NULL, NULL, NULL),
(1128, 'Mokeri', 6, 1, 236, 1, NULL, NULL, NULL, NULL, NULL),
(1129, 'Panniyannur', 6, 1, 236, 1, NULL, NULL, NULL, NULL, NULL),
(1130, 'Triprangottoor', 6, 1, 237, 1, NULL, NULL, NULL, NULL, NULL),
(1131, 'Chittariparamba', 6, 1, 237, 1, NULL, NULL, NULL, NULL, NULL),
(1132, 'Kunnothuparamba', 6, 1, 237, 1, NULL, NULL, NULL, NULL, NULL),
(1133, 'Mangattidam', 6, 1, 237, 1, NULL, NULL, NULL, NULL, NULL),
(1134, 'Pattiam', 6, 1, 237, 1, NULL, NULL, NULL, NULL, NULL),
(1135, 'Kottayam', 6, 1, 237, 1, NULL, NULL, NULL, NULL, NULL),
(1136, 'Aralam', 6, 1, 238, 1, NULL, NULL, NULL, NULL, NULL),
(1137, 'Ayyankunnu', 6, 1, 238, 1, NULL, NULL, NULL, NULL, NULL),
(1138, 'Keezhallur', 6, 1, 238, 1, NULL, NULL, NULL, NULL, NULL),
(1139, 'Thillankery', 6, 1, 238, 1, NULL, NULL, NULL, NULL, NULL),
(1140, 'Koodali', 6, 1, 238, 1, NULL, NULL, NULL, NULL, NULL),
(1141, 'Payam', 6, 1, 238, 1, NULL, NULL, NULL, NULL, NULL),
(1142, 'Kanichar', 6, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1143, 'Kelakam', 6, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1144, 'Kottiyoor', 6, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1145, 'Muzhakkunnu', 6, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1146, 'Kolayad', 6, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1147, 'Malur', 6, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1148, 'Peravoor', 7, 1, 239, 1, NULL, NULL, NULL, NULL, NULL),
(1149, 'Mangalpady', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1150, 'Vorkady', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1151, 'Puthige', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1152, 'Meenja', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1153, 'Manjeshwar', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1154, 'Paivalike', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1155, 'Enmakaje', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1156, 'Bellur', 7, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1157, 'Kumbadaje', 7, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1158, 'Muliyar', 7, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1159, 'Karadka', 7, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1160, 'Delampady', 7, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1161, 'Bedadka', 0, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1162, 'Kuttikol', 7, 1, 241, 1, NULL, NULL, NULL, NULL, NULL),
(1163, 'Chengala', 7, 1, 242, 1, NULL, NULL, NULL, NULL, NULL),
(1164, 'Chemnad', 7, 1, 242, 1, NULL, NULL, NULL, NULL, NULL),
(1165, 'Madhur', 7, 1, 242, 1, NULL, NULL, NULL, NULL, NULL),
(1166, 'Mogral Puthur', 7, 1, 242, 1, NULL, NULL, NULL, NULL, NULL),
(1167, 'Badiadka', 7, 1, 242, 1, NULL, NULL, NULL, NULL, NULL),
(1168, 'Kumbla', 7, 1, 242, 1, NULL, NULL, NULL, NULL, NULL),
(1169, 'Udma', 7, 1, 243, 1, NULL, NULL, NULL, NULL, NULL),
(1170, 'Ajanur', 7, 1, 243, 1, NULL, NULL, NULL, NULL, NULL),
(1171, 'Madikai', 7, 1, 243, 1, NULL, NULL, NULL, NULL, NULL),
(1172, 'Pallikere', 7, 1, 243, 1, NULL, NULL, NULL, NULL, NULL),
(1173, 'Pullur Periya', 7, 1, 243, 1, NULL, NULL, NULL, NULL, NULL),
(1174, 'Balal', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1175, 'Kodom Belur', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1176, 'Panathady', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1177, 'Kallar', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1178, 'East Eleri', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1179, 'West Eleri', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1180, 'Kinanoor - Karinthalam', 7, 1, 244, 1, NULL, NULL, NULL, NULL, NULL),
(1181, 'Cheruvathur', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1182, 'Kayyur Cheemeni', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1183, 'Pilicode', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1184, 'Trikarpur', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1185, 'Valiyaparamba', 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1186, 'Padne', 0, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1187, 'Thiruvananthapuram', 14, 5, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1188, 'Kollam', 8, 5, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1189, 'Alappuzha', 3, 5, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1190, 'Kannur', 6, 5, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1191, 'Kozhikode', 10, 5, 0, 1, NULL, NULL, NULL, NULL, NULL),
(1192, 'Trivandrum taluk', 14, 7, 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_localbodytype`
--

CREATE TABLE `ori_localbodytype` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1- Active,2- Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_localbodytype`
--

INSERT INTO `ori_localbodytype` (`id`, `type`, `parent_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Panchayath', 0, 1, NULL, NULL, '2015-03-17 18:30:00', NULL, NULL),
(2, 'Municipality', 0, 1, NULL, NULL, '2015-03-17 18:30:00', NULL, NULL),
(3, 'Municipal Corporation', 0, 1, NULL, NULL, '2015-03-17 18:30:00', NULL, NULL),
(4, 'Block Panchayath', 1, 1, NULL, NULL, '2015-12-31 18:30:00', NULL, NULL),
(5, 'District Panchayath', 1, 1, NULL, NULL, '2015-12-31 18:30:00', NULL, NULL),
(6, 'Grama Panchayath', 1, 1, NULL, NULL, '2015-12-31 18:30:00', NULL, NULL),
(7, 'Taluk', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Village', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_location_settings`
--

CREATE TABLE `ori_location_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1- Active,2- Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_location_settings`
--

INSERT INTO `ori_location_settings` (`id`, `type`, `name`, `parent`, `child`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'country', 'India', 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'state', 'Kerala', 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'district', 'Alappuzha', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'district', 'Ernakulam', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'district', 'Idukki', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'district', 'Kannur', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'district', 'Kasargod', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'district', 'Kollam', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'district', 'Kottayam', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'district', 'Kozhikode', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'district', 'Malappuram', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'district', 'Palakkad', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'district', 'Pathanamthitta', 2, 3, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'district', 'Thiruvananthapuram', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'district', 'Thrissur', 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'district', 'Wayanad', 2, 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_coupon_codes`
--

CREATE TABLE `ori_mast_coupon_codes` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `coupon_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disc_flag` int(11) DEFAULT NULL COMMENT '1- Percent,2- Rupees',
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Monthly',
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_coupon_codes`
--

INSERT INTO `ori_mast_coupon_codes` (`id`, `plan_id`, `coupon_name`, `coupon_code`, `discount`, `disc_flag`, `duration`, `valid_from`, `valid_to`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 4, 'ABC', 'SP010', '10', 1, '1', '2018-12-01 00:00:00', '2018-12-29 00:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(4, 4, 'ABCD', 'SP020', '20', 1, '1', '2018-12-31 00:00:00', '2019-01-22 00:00:00', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_customer_nature`
--

CREATE TABLE `ori_mast_customer_nature` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_nature` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_customer_nature`
--

INSERT INTO `ori_mast_customer_nature` (`id`, `cmpny_id`, `customer_nature`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Hot', 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Warm', 0, 1, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Cold', 0, 1, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'Less Interest', 0, 1, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'DND', 0, 1, NULL, NULL, NULL, NULL, NULL),
(6, 1, 'Hot', 0, 1, NULL, NULL, NULL, NULL, NULL),
(7, 1, 'Warm', 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_designations`
--

CREATE TABLE `ori_mast_designations` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `designation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_faq_categories`
--

CREATE TABLE `ori_mast_faq_categories` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1 - FAQ, 2 - CALL',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_faq_categories`
--

INSERT INTO `ori_mast_faq_categories` (`id`, `cmpny_id`, `category_name`, `parent_category_id`, `sort_order`, `status`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'KYC', NULL, 0, 1, 0, NULL, NULL, '2018-10-10 18:30:00', NULL, NULL),
(2, 2, 'Registration', NULL, 0, 1, 0, NULL, NULL, '2018-10-10 18:30:00', NULL, NULL),
(3, 2, 'Profile Page', 2, 0, 1, 0, NULL, NULL, '2018-10-10 18:30:00', NULL, NULL),
(4, 1, 'c1 - KYC', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_lead_sources`
--

CREATE TABLE `ori_mast_lead_sources` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_source_type_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_mast_lead_source_type table',
  `source_key` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_lead_sources`
--

INSERT INTO `ori_mast_lead_sources` (`id`, `cmpny_id`, `name`, `lead_source_type_id`, `source_key`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Facebookchat', 8, '1#bC9#bD3?uM2/dH1#fb', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(2, 1, 'Whatsappchat', 4, '8cHxmmUl$bSHT$z', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(3, 1, 'Facebookchat', 4, '3hHmophL$FdrThd', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(4, 2, 'Whatsappchat', 8, '*B6)Z3m](P\"ZUfi', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(5, 2, 'Feedback', 9, '4g~Z<rdv6mAb![@', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(6, 1, 'Feedback', 10, 'CXBb##5R?x1B\".e', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_lead_source_type`
--

CREATE TABLE `ori_mast_lead_source_type` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `source_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_lead_source_type`
--

INSERT INTO `ori_mast_lead_source_type` (`id`, `cmpny_id`, `source_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Social Media', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(2, 1, 'News Paper', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(3, 1, 'TV Channels', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(4, 1, 'Chat Application', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(5, 2, 'Social Media', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(6, 2, 'News Paper', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(7, 2, 'TV Channels', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(8, 2, 'Chat Application', 1, NULL, NULL, '2018-10-11 18:30:00', '2018-10-11 18:30:00', NULL),
(9, 2, 'CRM', 1, NULL, NULL, '2018-11-12 18:30:00', '2018-11-12 18:30:00', NULL),
(10, 2, 'CRM', 1, NULL, NULL, '2018-11-12 18:30:00', '2018-11-12 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_package`
--

CREATE TABLE `ori_mast_package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_type` int(11) DEFAULT NULL,
  `permission_under_package` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_package`
--

INSERT INTO `ori_mast_package` (`id`, `package_name`, `package_type`, `permission_under_package`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'permission management', 4, 'a:1:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}}', 1, 1, 1, '2018-11-16 07:44:58', '2018-11-16 07:44:58', NULL),
(2, 'package management', 4, 'a:1:{i:0;a:2:{s:13:\"permission_id\";s:2:\"45\";s:15:\"permission_name\";s:18:\"package management\";}}', 1, 1, 1, '2018-11-16 07:45:14', '2018-11-16 07:45:14', NULL),
(3, 'role management', 4, 'a:1:{i:0;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}}', 1, 1, 1, '2018-11-16 07:45:26', '2018-11-16 07:45:26', NULL),
(4, 'user management', 4, 'a:2:{i:0;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"37\";s:15:\"permission_name\";s:14:\"changepassword\";}}', 1, 1, 1, '2018-11-16 07:45:37', '2019-01-28 06:28:23', NULL),
(5, 'plan management', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}}', 1, 1, 1, '2018-11-16 07:46:46', '2018-11-16 07:46:46', NULL),
(6, 'query type management', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}}', 1, 1, 1, '2018-11-16 07:47:25', '2018-11-16 07:47:25', NULL),
(7, 'query status management', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}}', 1, 1, 1, '2018-11-16 07:48:11', '2018-11-16 07:48:11', NULL),
(8, 'customer nature', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}}', 1, 1, 1, '2018-11-16 07:48:31', '2018-11-22 01:29:28', NULL),
(9, 'customer priority', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}}', 1, 1, 1, '2018-11-16 07:48:56', '2018-11-16 07:48:56', NULL),
(10, 'settings view', 4, 'a:3:{i:0;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"98\";s:15:\"permission_name\";s:13:\"chat settings\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"99\";s:15:\"permission_name\";s:19:\"escalation settings\";}}', 1, 1, 1, '2018-11-16 07:49:35', '2019-01-29 23:28:04', NULL),
(11, 'faq management', 4, 'a:5:{i:0;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}}', 1, 1, 1, '2018-11-16 07:50:00', '2018-11-16 07:50:00', NULL),
(12, 'template management', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}}', 1, 1, 1, '2018-11-16 07:50:22', '2018-11-16 07:50:22', NULL),
(13, 'profile management', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"90\";s:15:\"permission_name\";s:21:\"profile customization\";}i:3;a:2:{s:13:\"permission_id\";s:3:\"100\";s:15:\"permission_name\";s:16:\"designation list\";}}', 1, 1, 1, '2018-11-16 07:52:20', '2019-01-30 01:48:30', NULL),
(14, 'lead management', 4, 'a:1:{i:0;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}}', 1, 1, 1, '2018-11-16 07:52:36', '2018-11-16 07:52:36', NULL),
(15, 'task list', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"43\";s:15:\"permission_name\";s:12:\"escalated to\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"92\";s:15:\"permission_name\";s:8:\"escalate\";}}', 1, 1, 1, '2018-11-16 07:53:26', '2019-01-19 01:13:55', NULL),
(16, 'help desk', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"43\";s:15:\"permission_name\";s:12:\"escalated to\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"44\";s:15:\"permission_name\";s:13:\"followup view\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"47\";s:15:\"permission_name\";s:16:\"Followups Reopen\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"48\";s:15:\"permission_name\";s:21:\"followup history edit\";}}', 1, 1, 1, '2018-11-16 07:54:11', '2018-11-21 05:42:12', NULL),
(17, 'survey management', 4, 'a:2:{i:0;a:2:{s:13:\"permission_id\";s:2:\"46\";s:15:\"permission_name\";s:17:\"survey management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"49\";s:15:\"permission_name\";s:13:\"survey report\";}}', 1, 1, 1, '2018-11-21 07:46:27', '2018-11-21 07:46:27', NULL),
(18, 'feedback management', 4, 'a:2:{i:0;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"50\";s:15:\"permission_name\";s:15:\"feedback report\";}}', 1, 1, 1, '2018-11-21 07:47:07', '2018-11-21 07:47:45', NULL),
(19, 'lead source management', 4, 'a:8:{i:0;a:2:{s:13:\"permission_id\";s:2:\"51\";s:15:\"permission_name\";s:23:\"lead source type create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"52\";s:15:\"permission_name\";s:21:\"lead source type edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"53\";s:15:\"permission_name\";s:21:\"lead source type list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"54\";s:15:\"permission_name\";s:23:\"lead source type delete\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"55\";s:15:\"permission_name\";s:18:\"lead source create\";}i:5;a:2:{s:13:\"permission_id\";s:2:\"56\";s:15:\"permission_name\";s:16:\"lead source edit\";}i:6;a:2:{s:13:\"permission_id\";s:2:\"57\";s:15:\"permission_name\";s:16:\"lead source list\";}i:7;a:2:{s:13:\"permission_id\";s:2:\"58\";s:15:\"permission_name\";s:18:\"lead source delete\";}}', 1, 1, 1, '2018-11-22 00:06:10', '2018-11-22 00:06:10', NULL),
(20, 'question management', 4, 'a:1:{i:0;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}}', 1, 1, 1, '2018-11-22 00:17:23', '2018-11-22 00:17:54', NULL),
(21, 'campaign management', 4, 'a:5:{i:0;a:2:{s:13:\"permission_id\";s:2:\"42\";s:15:\"permission_name\";s:19:\"campaign management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"71\";s:15:\"permission_name\";s:15:\"campaign create\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"72\";s:15:\"permission_name\";s:13:\"campaign edit\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"73\";s:15:\"permission_name\";s:13:\"campaign list\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"74\";s:15:\"permission_name\";s:15:\"campaign delete\";}}', 1, 1, 1, '2018-11-22 00:33:15', '2018-11-30 00:34:04', NULL),
(22, 'sales automation', 4, 'a:5:{i:0;a:2:{s:13:\"permission_id\";s:2:\"59\";s:15:\"permission_name\";s:23:\"sales automation create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"60\";s:15:\"permission_name\";s:21:\"sales automation edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"61\";s:15:\"permission_name\";s:21:\"sales automation list\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"62\";s:15:\"permission_name\";s:23:\"sales automation delete\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"94\";s:15:\"permission_name\";s:13:\"outbound call\";}}', 1, 1, 1, '2018-11-22 00:36:28', '2019-01-28 06:32:01', NULL),
(23, 'intimation settings', 4, 'a:4:{i:0;a:2:{s:13:\"permission_id\";s:2:\"63\";s:15:\"permission_name\";s:26:\"intimation settings create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"64\";s:15:\"permission_name\";s:24:\"intimation settings edit\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"91\";s:15:\"permission_name\";s:12:\"company meta\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"93\";s:15:\"permission_name\";s:15:\"channel gateway\";}}', 1, 1, 1, '2018-11-22 04:27:01', '2019-01-28 01:42:14', NULL),
(24, 'notifications', 4, 'a:1:{i:0;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}}', 1, 1, 1, '2018-11-22 04:32:48', '2018-11-22 04:32:48', NULL),
(25, 'group management', 4, 'a:7:{i:0;a:2:{s:13:\"permission_id\";s:2:\"66\";s:15:\"permission_name\";s:16:\"group management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"67\";s:15:\"permission_name\";s:12:\"group create\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"68\";s:15:\"permission_name\";s:10:\"group edit\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"69\";s:15:\"permission_name\";s:10:\"group list\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"70\";s:15:\"permission_name\";s:12:\"group delete\";}i:5;a:2:{s:13:\"permission_id\";s:2:\"84\";s:15:\"permission_name\";s:17:\"group lead import\";}i:6;a:2:{s:13:\"permission_id\";s:2:\"85\";s:15:\"permission_name\";s:18:\"group excel import\";}}', 1, 1, 1, '2018-11-30 00:35:11', '2018-11-30 00:35:11', NULL),
(26, 'campaign reports', 4, 'a:9:{i:0;a:2:{s:13:\"permission_id\";s:2:\"75\";s:15:\"permission_name\";s:29:\"campaign email delivery graph\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"76\";s:15:\"permission_name\";s:32:\"campaign batch efficiency report\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"77\";s:15:\"permission_name\";s:27:\"campaign email batch report\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"78\";s:15:\"permission_name\";s:27:\"campaign sms delivery graph\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"79\";s:15:\"permission_name\";s:25:\"campaign sms batch report\";}i:5;a:2:{s:13:\"permission_id\";s:2:\"80\";s:15:\"permission_name\";s:30:\"campaign autodial status graph\";}i:6;a:2:{s:13:\"permission_id\";s:2:\"81\";s:15:\"permission_name\";s:30:\"campaign autodial batch report\";}i:7;a:2:{s:13:\"permission_id\";s:2:\"82\";s:15:\"permission_name\";s:32:\"campaign manualcall status graph\";}i:8;a:2:{s:13:\"permission_id\";s:2:\"83\";s:15:\"permission_name\";s:32:\"campaign manualcall batch report\";}}', 1, 1, 1, '2018-11-30 00:36:43', '2018-11-30 00:36:43', NULL),
(27, 'tab management', 4, 'a:7:{i:0;a:2:{s:13:\"permission_id\";s:2:\"86\";s:15:\"permission_name\";s:19:\"customer tab create\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"87\";s:15:\"permission_name\";s:19:\"customer tab delete\";}i:2;a:2:{s:13:\"permission_id\";s:2:\"88\";s:15:\"permission_name\";s:17:\"customer tab edit\";}i:3;a:2:{s:13:\"permission_id\";s:2:\"89\";s:15:\"permission_name\";s:17:\"customer tab list\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"95\";s:15:\"permission_name\";s:18:\"chat configuration\";}i:5;a:2:{s:13:\"permission_id\";s:2:\"96\";s:15:\"permission_name\";s:26:\"view auto reply categories\";}i:6;a:2:{s:13:\"permission_id\";s:2:\"97\";s:15:\"permission_name\";s:15:\"auto reply list\";}}', 1, 1, 1, '2018-12-05 07:44:31', '2019-01-28 06:43:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_plans`
--

CREATE TABLE `ori_mast_plans` (
  `id` int(11) NOT NULL,
  `plan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_des` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'percent',
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_plans`
--

INSERT INTO `ori_mast_plans` (`id`, `plan`, `plan_des`, `discount`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Silver', 'oricom trial version product(Silver)', '10', 1, 1, 1, 1, '2018-11-13 00:45:28', '2018-11-26 06:25:59', NULL),
(2, 'Gold', 'oricom trial version product(Gold)', '20', 2, 1, 1, 1, '2018-11-13 00:45:37', '2018-11-13 00:45:37', NULL),
(3, 'Platinum', 'oricom trial version product(Platinum)', '30', 3, 1, 1, 1, '2018-11-13 00:45:43', '2018-11-13 00:45:43', NULL),
(4, 'Diamond', 'oricom trial version product(Diamond)', '40', 4, 1, 1, 1, '2018-11-13 00:45:49', '2018-11-13 00:45:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_plans_duration`
--

CREATE TABLE `ori_mast_plans_duration` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_plans_duration`
--

INSERT INTO `ori_mast_plans_duration` (`id`, `plan_id`, `amount`, `duration`, `start_date`, `end_date`, `status`, `sort_order`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 100, '1 month', '2018-12-28 13:28:45', '2019-01-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 200, '1 month', '2018-11-28 00:00:00', '2018-12-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 200, '1 month', '2018-12-28 13:28:45', '2019-01-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 300, '1 month', '2018-11-28 00:00:00', '2018-12-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 3, 300, '1 month', '2018-12-28 13:28:45', '2019-01-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 3, 400, '1 month', '2018-11-28 00:00:00', '2018-12-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 4, 400, '1 month', '2018-12-28 13:28:45', '2019-01-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 4, 500, '1 month', '2018-11-28 00:00:00', '2018-12-28 00:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_priority`
--

CREATE TABLE `ori_mast_priority` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_priority`
--

INSERT INTO `ori_mast_priority` (`id`, `cmpny_id`, `name`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'low', 0, 1, 2, NULL, '2018-10-30 18:30:00', NULL, NULL),
(2, 2, 'medium', 0, 1, 2, NULL, '2018-10-30 18:30:00', NULL, NULL),
(3, 2, 'high', 0, 1, 2, NULL, '2018-10-30 18:30:00', NULL, NULL),
(4, 1, 'low', 0, 1, 1, NULL, '2018-10-30 18:30:00', NULL, NULL),
(5, 1, 'medium', 0, 1, 1, NULL, '2018-10-30 18:30:00', NULL, NULL),
(6, 1, 'high', 0, 1, 1, NULL, '2018-10-30 18:30:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_query_category_relation`
--

CREATE TABLE `ori_mast_query_category_relation` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `query_type_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `category_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_faq_categories',
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_query_category_relation`
--

INSERT INTO `ori_mast_query_category_relation` (`id`, `cmpny_id`, `query_type_id`, `category_id`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 5, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 5, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(3, 2, 6, 2, 0, 1, NULL, NULL, NULL, NULL, NULL),
(4, 1, 8, 4, 0, 1, NULL, NULL, NULL, NULL, NULL),
(5, 2, 9, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(6, 2, 9, 2, 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_query_designation_relation`
--

CREATE TABLE `ori_mast_query_designation_relation` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `query_type_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_query_type',
  `designation_id` int(11) DEFAULT NULL COMMENT 'Referred from ori_mast_designations',
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_query_status`
--

CREATE TABLE `ori_mast_query_status` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_close` int(11) DEFAULT NULL COMMENT '1-Closed 2-Other',
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_query_status`
--

INSERT INTO `ori_mast_query_status` (`id`, `cmpny_id`, `name`, `color`, `is_close`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Open', 'FF0000', 0, 0, 1, 2, 2, '2018-10-30 18:30:00', '2019-01-19 00:36:02', NULL),
(2, 2, 'Processing', '0000FF', 0, 0, 1, 2, 2, '2018-10-30 18:30:00', '2019-01-23 05:27:57', NULL),
(3, 2, 'Closed', '0000FF', 1, 0, 1, 2, 2, '2018-10-30 18:30:00', '2019-01-23 01:50:16', NULL),
(4, 2, 'Re-open', '000000', 0, 0, 2, 2, 2, '2019-01-23 23:50:51', '2019-01-23 23:50:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_query_status_relation`
--

CREATE TABLE `ori_mast_query_status_relation` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `query_type_id` int(11) NOT NULL COMMENT 'Referred from ori_mast_query_type',
  `query_status_id` int(11) NOT NULL COMMENT 'Referred from ori_mast_query_status',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1- Active, 2- Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_query_status_relation`
--

INSERT INTO `ori_mast_query_status_relation` (`id`, `cmpny_id`, `query_type_id`, `query_status_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 2, 5, 1, 1, 2, 2, '2019-01-19 00:36:02', '2019-01-19 00:36:02', NULL),
(8, 2, 9, 1, 1, 2, 2, '2019-01-19 00:36:02', '2019-01-19 00:36:02', NULL),
(9, 2, 6, 1, 1, 2, 2, '2019-01-19 00:36:02', '2019-01-19 00:36:02', NULL),
(10, 2, 5, 3, 1, 2, 2, '2019-01-23 01:50:17', '2019-01-23 01:50:17', NULL),
(11, 2, 9, 3, 1, 2, 2, '2019-01-23 01:50:17', '2019-01-23 01:50:17', NULL),
(12, 2, 6, 3, 1, 2, 2, '2019-01-23 01:50:17', '2019-01-23 01:50:17', NULL),
(13, 2, 5, 2, 1, 2, 2, '2019-01-23 05:27:57', '2019-01-23 05:27:57', NULL),
(14, 2, 9, 2, 1, 2, 2, '2019-01-23 05:27:57', '2019-01-23 05:27:57', NULL),
(15, 2, 6, 2, 1, 2, 2, '2019-01-23 05:27:57', '2019-01-23 05:27:57', NULL),
(16, 2, 5, 4, 2, 2, 2, '2019-01-23 23:50:51', '2019-01-23 23:50:51', NULL),
(17, 2, 9, 4, 2, 2, 2, '2019-01-23 23:50:51', '2019-01-23 23:50:51', NULL),
(18, 2, 6, 4, 2, 2, 2, '2019-01-23 23:50:51', '2019-01-23 23:50:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_query_type`
--

CREATE TABLE `ori_mast_query_type` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `query_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'additional fields',
  `short_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'additional fields',
  `type` int(11) DEFAULT '2' COMMENT '1-Tickets 2-Followups',
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_mast_query_type`
--

INSERT INTO `ori_mast_query_type` (`id`, `cmpny_id`, `query_type`, `slug`, `short_code`, `type`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 2, 'Complaints', NULL, NULL, 1, 0, 1, NULL, NULL, '2018-10-09 18:30:00', NULL, NULL),
(6, 2, 'Service Request', NULL, NULL, 1, 0, 1, NULL, NULL, '2018-10-09 18:30:00', NULL, NULL),
(7, 1, 'Complaints', NULL, NULL, 1, 0, 1, NULL, NULL, '2018-10-09 18:30:00', NULL, NULL),
(8, 1, 'Service Request', NULL, NULL, 1, 0, 1, NULL, NULL, '2018-10-09 18:30:00', NULL, NULL),
(9, 2, 'Lead Followup', NULL, NULL, 2, 0, 1, NULL, NULL, '2018-10-09 18:30:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_mast_templates`
--

CREATE TABLE `ori_mast_templates` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT ' 1- SMS, 2- EMAIL',
  `is_show` int(11) NOT NULL DEFAULT '2' COMMENT '1- displayed in listing page, 2- Not displayed in listing',
  `sort_order` int(11) DEFAULT '0',
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_notifications_list`
--

CREATE TABLE `ori_notifications_list` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `link` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_flag` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_notifications_list`
--

INSERT INTO `ori_notifications_list` (`id`, `cmpny_id`, `title`, `comment`, `from_date`, `to_date`, `role`, `link`, `download_flag`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-19 01:15:18', '2019-01-19 01:15:18', NULL),
(2, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-19 01:16:03', '2019-01-19 01:16:03', NULL),
(3, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-19 01:17:13', '2019-01-19 01:17:13', NULL),
(4, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-23 07:11:47', '2019-01-23 07:11:47', NULL),
(5, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-23 07:16:36', '2019-01-23 07:16:36', NULL),
(6, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-23 23:37:40', '2019-01-23 23:37:40', NULL),
(7, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-23 23:39:18', '2019-01-23 23:39:18', NULL),
(8, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-24 00:33:42', '2019-01-24 00:33:42', NULL),
(9, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-24 00:34:10', '2019-01-24 00:34:10', NULL),
(10, 2, 'Escalation Intimations', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/profile/0/1', 2, 2, 2, '2019-01-24 00:37:30', '2019-01-24 00:37:30', NULL),
(11, 2, 'Suggest FAQ', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/faqs13/edit', 2, 2, 2, '2019-01-24 05:14:32', '2019-01-24 05:14:32', NULL),
(12, 2, 'Suggest FAQ', 'View', NULL, NULL, NULL, 'http://127.0.0.1:8000/faqs/14/edit', 2, 2, 2, '2019-01-24 05:45:02', '2019-01-24 05:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_notifications_roles_relations`
--

CREATE TABLE `ori_notifications_roles_relations` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'referred from ori_users',
  `notification_id` int(11) DEFAULT NULL COMMENT 'referred fron ori_notifications_list',
  `status` int(11) DEFAULT NULL COMMENT '2 not viewed , 1 viewed',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_notifications_roles_relations`
--

INSERT INTO `ori_notifications_roles_relations` (`id`, `cmpny_id`, `user_id`, `notification_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 1, 1, 2, 2, '2019-01-19 01:15:18', '2019-01-24 03:26:30', NULL),
(2, 2, 2, 2, 1, 2, 2, '2019-01-19 01:16:03', '2019-01-24 03:26:30', NULL),
(3, 2, 2, 3, 1, 2, 2, '2019-01-19 01:17:13', '2019-01-24 03:26:30', NULL),
(4, 2, 2, 4, 1, 2, 2, '2019-01-23 07:11:47', '2019-01-24 03:26:30', NULL),
(5, 2, 2, 5, 1, 2, 2, '2019-01-23 07:16:36', '2019-01-24 03:26:30', NULL),
(6, 2, 2, 6, 1, 2, 2, '2019-01-23 23:37:40', '2019-01-24 03:26:30', NULL),
(7, 2, 2, 7, 1, 2, 2, '2019-01-23 23:39:18', '2019-01-24 03:26:30', NULL),
(8, 2, 2, 8, 1, 2, 2, '2019-01-24 00:33:42', '2019-01-24 03:26:29', NULL),
(9, 2, 2, 9, 1, 2, 2, '2019-01-24 00:34:10', '2019-01-24 03:26:29', NULL),
(10, 2, 2, 10, 1, 2, 2, '2019-01-24 00:37:30', '2019-01-24 03:26:29', NULL),
(11, 2, 2, 11, 2, 2, 2, '2019-01-24 05:14:32', '2019-01-24 05:14:32', NULL),
(12, 2, 3, 11, 1, 2, 2, '2019-01-24 05:14:32', '2019-01-24 05:58:55', NULL),
(13, 2, 4, 11, 2, 2, 2, '2019-01-24 05:14:32', '2019-01-24 05:14:32', NULL),
(14, 2, 2, 12, 2, 2, 2, '2019-01-24 05:45:02', '2019-01-24 05:45:02', NULL),
(15, 2, 3, 12, 1, 2, 2, '2019-01-24 05:45:02', '2019-01-24 05:58:55', NULL),
(16, 2, 4, 12, 2, 2, 2, '2019-01-24 05:45:02', '2019-01-24 05:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_password_histories`
--

CREATE TABLE `ori_password_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_password_resets`
--

CREATE TABLE `ori_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_password_securities`
--

CREATE TABLE `ori_password_securities` (
  `id` int(10) UNSIGNED NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `password_expiry_days` int(11) DEFAULT NULL,
  `password_updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_permissions`
--

CREATE TABLE `ori_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_permissions`
--

INSERT INTO `ori_permissions` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'permission management', '2018-10-13 03:05:32', '2018-10-13 03:05:32', 2, 2, NULL),
(2, 'role management', '2018-10-13 03:05:48', '2018-10-13 03:05:48', 2, 2, NULL),
(3, 'user management', '2018-10-13 03:08:27', '2018-10-13 03:08:27', 2, 2, NULL),
(4, 'plan create', '2018-10-13 03:12:36', '2018-10-13 03:12:36', 2, 2, NULL),
(5, 'plan edit', '2018-10-13 03:12:46', '2018-10-13 03:12:46', 2, 2, NULL),
(6, 'plan list', '2018-10-13 03:12:54', '2018-10-13 03:12:54', 2, 2, NULL),
(7, 'plan delete', '2018-10-13 03:13:49', '2018-10-13 03:13:49', 2, 2, NULL),
(8, 'query type create', '2018-10-13 03:17:28', '2018-10-13 03:17:28', 2, 2, NULL),
(9, 'query type edit', '2018-10-13 03:17:48', '2018-10-13 03:17:48', 2, 2, NULL),
(10, 'query type list', '2018-10-13 03:17:57', '2018-10-13 03:17:57', 2, 2, NULL),
(11, 'query type delete', '2018-10-13 03:18:05', '2018-10-13 03:18:05', 2, 2, NULL),
(12, 'query status create', '2018-10-13 03:19:40', '2018-10-13 03:19:40', 2, 2, NULL),
(13, 'query status edit', '2018-10-13 03:44:54', '2018-10-13 03:44:54', 2, 2, NULL),
(14, 'query status list', '2018-10-13 03:45:05', '2018-10-13 03:45:05', 2, 2, NULL),
(15, 'query status delete', '2018-10-13 03:45:13', '2018-10-13 03:45:13', 2, 2, NULL),
(16, 'customer nature create', '2018-10-13 03:46:11', '2018-10-13 03:46:11', 2, 2, NULL),
(17, 'customer nature edit', '2018-10-13 03:46:27', '2018-10-13 03:46:27', 2, 2, NULL),
(18, 'customer nature list', '2018-10-13 03:47:19', '2018-10-13 03:47:19', 2, 2, NULL),
(19, 'customer nature delete', '2018-10-13 03:47:31', '2018-10-13 03:47:31', 2, 2, NULL),
(20, 'customer priority create', '2018-10-13 03:53:07', '2018-10-13 03:53:07', 2, 2, NULL),
(21, 'customer priority edit', '2018-10-13 03:53:16', '2018-10-13 03:53:16', 2, 2, NULL),
(22, 'customer priority list', '2018-10-13 03:53:33', '2018-10-13 03:53:33', 2, 2, NULL),
(23, 'customer priority delete', '2018-10-13 03:53:41', '2018-10-13 03:53:41', 2, 2, NULL),
(24, 'faq create', '2018-10-13 03:54:28', '2018-10-13 03:54:28', 2, 2, NULL),
(25, 'faq edit', '2018-10-13 03:54:37', '2018-10-13 03:54:37', 2, 2, NULL),
(26, 'faq list', '2018-10-13 03:54:46', '2018-10-13 03:54:46', 2, 2, NULL),
(27, 'faq delete', '2018-10-13 03:54:54', '2018-10-13 03:54:54', 2, 2, NULL),
(28, 'view faq categories', '2018-10-13 03:55:42', '2018-10-13 03:55:42', 2, 2, NULL),
(29, 'settings view', '2018-10-13 03:56:04', '2018-10-13 03:56:04', 2, 2, NULL),
(30, 'template create', '2018-10-13 03:57:23', '2018-10-13 03:57:23', 2, 2, NULL),
(31, 'template edit', '2018-10-13 03:57:41', '2018-10-13 03:57:41', 2, 2, NULL),
(32, 'template list', '2018-10-13 03:57:49', '2018-10-13 03:57:49', 2, 2, NULL),
(33, 'template delete', '2018-10-13 03:58:33', '2018-10-13 03:58:33', 2, 2, NULL),
(34, 'profile create', '2018-10-13 04:00:15', '2018-10-13 04:00:15', 2, 2, NULL),
(35, 'profile view', '2018-10-13 04:00:25', '2018-10-13 04:00:25', 2, 2, NULL),
(36, 'lead list', '2018-10-13 04:01:05', '2018-10-13 04:01:05', 2, 2, NULL),
(37, 'changepassword', '2018-10-13 04:01:19', '2018-10-13 04:01:19', 2, 2, NULL),
(38, 'question management', '2018-10-13 04:02:11', '2018-10-13 04:02:11', 2, 2, NULL),
(39, 'feedback settings', '2018-10-13 04:02:34', '2018-10-13 04:02:34', 2, 2, NULL),
(40, 'service request all list', '2018-10-13 04:03:09', '2018-10-13 04:03:09', 2, 2, NULL),
(41, 'escalation summary chart', '2018-10-13 04:03:24', '2018-10-13 04:03:24', 2, 2, NULL),
(42, 'campaign management', '2018-10-13 04:54:49', '2018-10-13 04:54:49', 2, 2, NULL),
(43, 'escalated to', '2018-11-13 02:06:14', '2018-11-13 02:06:14', 2, 2, NULL),
(44, 'followup view', '2018-11-13 02:06:30', '2018-11-13 02:06:30', 2, 2, NULL),
(45, 'emailfetch', '2018-11-13 02:06:32', '2018-11-13 02:06:32', 2, 2, NULL),
(46, 'survey management', '2018-11-13 02:10:01', '2018-11-13 02:10:01', 2, 2, NULL),
(47, 'Followups Reopen', '2018-11-21 05:41:30', '2018-11-21 05:41:30', 1, 1, NULL),
(48, 'followup history edit', '2018-11-21 05:41:44', '2018-11-21 05:41:44', 1, 1, NULL),
(49, 'survey report', '2018-11-21 07:45:42', '2018-11-21 07:45:42', 1, 1, NULL),
(50, 'feedback report', '2018-11-21 07:47:26', '2018-11-21 07:47:26', 1, 1, NULL),
(51, 'lead source type create', '2018-11-21 07:50:15', '2018-11-21 07:50:15', 1, 1, NULL),
(52, 'lead source type edit', '2018-11-21 07:50:23', '2018-11-21 07:50:23', 1, 1, NULL),
(53, 'lead source type list', '2018-11-21 07:50:30', '2018-11-21 07:50:30', 1, 1, NULL),
(54, 'lead source type delete', '2018-11-21 07:50:38', '2018-11-21 07:50:38', 1, 1, NULL),
(55, 'lead source create', '2018-11-21 07:51:06', '2018-11-21 07:51:06', 1, 1, NULL),
(56, 'lead source edit', '2018-11-21 07:51:14', '2018-11-21 07:51:14', 1, 1, NULL),
(57, 'lead source list', '2018-11-21 07:51:20', '2018-11-21 07:51:20', 1, 1, NULL),
(58, 'lead source delete', '2018-11-21 07:51:26', '2018-11-21 07:51:26', 1, 1, NULL),
(59, 'sales automation create', '2018-11-22 00:30:36', '2018-11-22 00:30:36', 1, 1, NULL),
(60, 'sales automation edit', '2018-11-22 00:30:45', '2018-11-22 00:30:45', 1, 1, NULL),
(61, 'sales automation list', '2018-11-22 00:30:51', '2018-11-22 00:30:51', 1, 1, NULL),
(62, 'sales automation delete', '2018-11-22 00:30:59', '2018-11-22 00:30:59', 1, 1, NULL),
(63, 'intimation settings create', '2018-11-22 04:26:06', '2018-11-22 04:26:06', 1, 1, NULL),
(64, 'intimation settings edit', '2018-11-22 04:26:11', '2018-11-22 04:26:11', 1, 1, NULL),
(65, 'notification list', '2018-11-22 04:32:06', '2018-11-22 04:32:06', 1, 1, NULL),
(66, 'group management', '2018-11-29 23:17:32', '2018-11-29 23:18:27', 1, 1, NULL),
(67, 'group create', '2018-11-29 23:18:45', '2018-11-29 23:18:45', 1, 1, NULL),
(68, 'group edit', '2018-11-29 23:19:19', '2018-11-29 23:19:19', 1, 1, NULL),
(69, 'group list', '2018-11-29 23:20:34', '2018-11-29 23:20:34', 1, 1, NULL),
(70, 'group delete', '2018-11-29 23:21:00', '2018-11-29 23:21:00', 1, 1, NULL),
(71, 'campaign create', '2018-11-29 23:32:21', '2018-11-29 23:32:21', 1, 1, NULL),
(72, 'campaign edit', '2018-11-29 23:32:37', '2018-11-29 23:32:37', 1, 1, NULL),
(73, 'campaign list', '2018-11-29 23:32:54', '2018-11-29 23:32:54', 1, 1, NULL),
(74, 'campaign delete', '2018-11-29 23:33:09', '2018-11-29 23:33:09', 1, 1, NULL),
(75, 'campaign email delivery graph', '2018-11-30 00:21:21', '2018-11-30 00:21:21', 1, 1, NULL),
(76, 'campaign batch efficiency report', '2018-11-30 00:21:33', '2018-11-30 00:21:33', 1, 1, NULL),
(77, 'campaign email batch report', '2018-11-30 00:21:44', '2018-11-30 00:21:44', 1, 1, NULL),
(78, 'campaign sms delivery graph', '2018-11-30 00:22:00', '2018-11-30 00:22:00', 1, 1, NULL),
(79, 'campaign sms batch report', '2018-11-30 00:22:15', '2018-11-30 00:22:15', 1, 1, NULL),
(80, 'campaign autodial status graph', '2018-11-30 00:22:26', '2018-11-30 00:22:26', 1, 1, NULL),
(81, 'campaign autodial batch report', '2018-11-30 00:22:39', '2018-11-30 00:22:39', 1, 1, NULL),
(82, 'campaign manualcall status graph', '2018-11-30 00:22:52', '2018-11-30 00:22:52', 1, 1, NULL),
(83, 'campaign manualcall batch report', '2018-11-30 00:23:03', '2018-11-30 00:23:03', 1, 1, NULL),
(84, 'group lead import', '2018-11-30 00:31:28', '2018-11-30 00:31:28', 1, 1, NULL),
(85, 'group excel import', '2018-11-30 00:31:40', '2018-11-30 00:31:40', 1, 1, NULL),
(86, 'customer tab create', '2018-12-05 07:44:02', '2018-12-05 07:44:02', 1, 1, NULL),
(87, 'customer tab delete', '2018-12-05 07:44:06', '2018-12-05 07:44:06', 1, 1, NULL),
(88, 'customer tab edit', '2018-12-05 07:44:10', '2018-12-05 07:44:10', 1, 1, NULL),
(89, 'customer tab list', '2018-12-05 07:44:14', '2018-12-05 07:44:14', 1, 1, NULL),
(90, 'profile customization', '2019-01-18 06:35:57', '2019-01-18 06:35:57', 1, 1, NULL),
(91, 'company meta', '2019-01-18 06:36:05', '2019-01-18 06:36:05', 1, 1, NULL),
(92, 'escalate', '2019-01-19 01:13:33', '2019-01-19 01:13:33', 1, 1, NULL),
(93, 'channel gateway', '2019-01-28 01:41:38', '2019-01-28 01:41:38', 1, 1, NULL),
(94, 'outbound call', '2019-01-28 06:31:39', '2019-01-28 06:31:39', 1, 1, NULL),
(95, 'chat configuration', '2019-01-28 06:42:34', '2019-01-28 06:42:34', 1, 1, NULL),
(96, 'view auto reply categories', '2019-01-28 06:42:45', '2019-01-28 06:42:45', 1, 1, NULL),
(97, 'auto reply list', '2019-01-28 06:42:51', '2019-01-28 06:42:51', 1, 1, NULL),
(98, 'chat settings', '2019-01-29 23:27:37', '2019-01-29 23:27:37', 1, 1, NULL),
(99, 'escalation settings', '2019-01-29 23:27:45', '2019-01-29 23:27:45', 1, 1, NULL),
(100, 'designation list', '2019-01-30 01:48:13', '2019-01-30 01:48:13', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_questions`
--

CREATE TABLE `ori_questions` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `questions` text COLLATE utf8mb4_unicode_ci,
  `language_type` int(11) DEFAULT NULL COMMENT '1-  English,2- Malayalam',
  `option1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option3` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option4` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option5` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option6` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` int(11) DEFAULT NULL,
  `survey` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Processing',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_questions`
--

INSERT INTO `ori_questions` (`id`, `cmpny_id`, `questions`, `language_type`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `feedback`, `survey`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Are you interested ?', 1, 'yes', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2018-10-11 03:31:04', '2018-10-11 03:31:04', NULL),
(2, 2, 'Question 1?', 1, 'op1', 'op2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2018-10-11 03:31:21', '2018-10-11 03:31:21', NULL),
(3, 2, 'നിങ്ങൾ ഞങ്ങളുടെ സേവനങ്ങളിൽ തൃപ്തരാണോ?', 2, 'അതെ', 'അല്ല', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 3, '2018-11-19 07:29:21', '2018-11-22 00:33:45', NULL),
(8, 2, 'ചോദ്യം ഒന്ന്', 2, 'ഉത്തരം1', 'ഉത്തരം2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 3, '2018-11-22 00:34:25', '2018-11-22 00:34:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_roles`
--

CREATE TABLE `ori_roles` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_permission` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contains serialized array of permission ids-Referred from cc_permission	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_roles`
--

INSERT INTO `ori_roles` (`id`, `cmpny_id`, `role`, `access_permission`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Super Administrator', 'a:92:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"45\";s:15:\"permission_name\";s:10:\"emailfetch\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:9;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"90\";s:15:\"permission_name\";s:21:\"profile customization\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:40;a:2:{s:13:\"permission_id\";s:2:\"43\";s:15:\"permission_name\";s:12:\"escalated to\";}i:41;a:2:{s:13:\"permission_id\";s:2:\"92\";s:15:\"permission_name\";s:8:\"escalate\";}i:42;a:2:{s:13:\"permission_id\";s:2:\"44\";s:15:\"permission_name\";s:13:\"followup view\";}i:43;a:2:{s:13:\"permission_id\";s:2:\"47\";s:15:\"permission_name\";s:16:\"Followups Reopen\";}i:44;a:2:{s:13:\"permission_id\";s:2:\"48\";s:15:\"permission_name\";s:21:\"followup history edit\";}i:45;a:2:{s:13:\"permission_id\";s:2:\"46\";s:15:\"permission_name\";s:17:\"survey management\";}i:46;a:2:{s:13:\"permission_id\";s:2:\"49\";s:15:\"permission_name\";s:13:\"survey report\";}i:47;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:48;a:2:{s:13:\"permission_id\";s:2:\"50\";s:15:\"permission_name\";s:15:\"feedback report\";}i:49;a:2:{s:13:\"permission_id\";s:2:\"51\";s:15:\"permission_name\";s:23:\"lead source type create\";}i:50;a:2:{s:13:\"permission_id\";s:2:\"52\";s:15:\"permission_name\";s:21:\"lead source type edit\";}i:51;a:2:{s:13:\"permission_id\";s:2:\"53\";s:15:\"permission_name\";s:21:\"lead source type list\";}i:52;a:2:{s:13:\"permission_id\";s:2:\"54\";s:15:\"permission_name\";s:23:\"lead source type delete\";}i:53;a:2:{s:13:\"permission_id\";s:2:\"55\";s:15:\"permission_name\";s:18:\"lead source create\";}i:54;a:2:{s:13:\"permission_id\";s:2:\"56\";s:15:\"permission_name\";s:16:\"lead source edit\";}i:55;a:2:{s:13:\"permission_id\";s:2:\"57\";s:15:\"permission_name\";s:16:\"lead source list\";}i:56;a:2:{s:13:\"permission_id\";s:2:\"58\";s:15:\"permission_name\";s:18:\"lead source delete\";}i:57;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:58;a:2:{s:13:\"permission_id\";s:2:\"42\";s:15:\"permission_name\";s:19:\"campaign management\";}i:59;a:2:{s:13:\"permission_id\";s:2:\"71\";s:15:\"permission_name\";s:15:\"campaign create\";}i:60;a:2:{s:13:\"permission_id\";s:2:\"72\";s:15:\"permission_name\";s:13:\"campaign edit\";}i:61;a:2:{s:13:\"permission_id\";s:2:\"73\";s:15:\"permission_name\";s:13:\"campaign list\";}i:62;a:2:{s:13:\"permission_id\";s:2:\"74\";s:15:\"permission_name\";s:15:\"campaign delete\";}i:63;a:2:{s:13:\"permission_id\";s:2:\"59\";s:15:\"permission_name\";s:23:\"sales automation create\";}i:64;a:2:{s:13:\"permission_id\";s:2:\"60\";s:15:\"permission_name\";s:21:\"sales automation edit\";}i:65;a:2:{s:13:\"permission_id\";s:2:\"61\";s:15:\"permission_name\";s:21:\"sales automation list\";}i:66;a:2:{s:13:\"permission_id\";s:2:\"62\";s:15:\"permission_name\";s:23:\"sales automation delete\";}i:67;a:2:{s:13:\"permission_id\";s:2:\"63\";s:15:\"permission_name\";s:26:\"intimation settings create\";}i:68;a:2:{s:13:\"permission_id\";s:2:\"64\";s:15:\"permission_name\";s:24:\"intimation settings edit\";}i:69;a:2:{s:13:\"permission_id\";s:2:\"91\";s:15:\"permission_name\";s:12:\"company meta\";}i:70;a:2:{s:13:\"permission_id\";s:2:\"93\";s:15:\"permission_name\";s:15:\"channel gateway\";}i:71;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}i:72;a:2:{s:13:\"permission_id\";s:2:\"66\";s:15:\"permission_name\";s:16:\"group management\";}i:73;a:2:{s:13:\"permission_id\";s:2:\"67\";s:15:\"permission_name\";s:12:\"group create\";}i:74;a:2:{s:13:\"permission_id\";s:2:\"68\";s:15:\"permission_name\";s:10:\"group edit\";}i:75;a:2:{s:13:\"permission_id\";s:2:\"69\";s:15:\"permission_name\";s:10:\"group list\";}i:76;a:2:{s:13:\"permission_id\";s:2:\"70\";s:15:\"permission_name\";s:12:\"group delete\";}i:77;a:2:{s:13:\"permission_id\";s:2:\"84\";s:15:\"permission_name\";s:17:\"group lead import\";}i:78;a:2:{s:13:\"permission_id\";s:2:\"85\";s:15:\"permission_name\";s:18:\"group excel import\";}i:79;a:2:{s:13:\"permission_id\";s:2:\"75\";s:15:\"permission_name\";s:29:\"campaign email delivery graph\";}i:80;a:2:{s:13:\"permission_id\";s:2:\"76\";s:15:\"permission_name\";s:32:\"campaign batch efficiency report\";}i:81;a:2:{s:13:\"permission_id\";s:2:\"77\";s:15:\"permission_name\";s:27:\"campaign email batch report\";}i:82;a:2:{s:13:\"permission_id\";s:2:\"78\";s:15:\"permission_name\";s:27:\"campaign sms delivery graph\";}i:83;a:2:{s:13:\"permission_id\";s:2:\"79\";s:15:\"permission_name\";s:25:\"campaign sms batch report\";}i:84;a:2:{s:13:\"permission_id\";s:2:\"80\";s:15:\"permission_name\";s:30:\"campaign autodial status graph\";}i:85;a:2:{s:13:\"permission_id\";s:2:\"81\";s:15:\"permission_name\";s:30:\"campaign autodial batch report\";}i:86;a:2:{s:13:\"permission_id\";s:2:\"82\";s:15:\"permission_name\";s:32:\"campaign manualcall status graph\";}i:87;a:2:{s:13:\"permission_id\";s:2:\"83\";s:15:\"permission_name\";s:32:\"campaign manualcall batch report\";}i:88;a:2:{s:13:\"permission_id\";s:2:\"86\";s:15:\"permission_name\";s:19:\"customer tab create\";}i:89;a:2:{s:13:\"permission_id\";s:2:\"87\";s:15:\"permission_name\";s:19:\"customer tab delete\";}i:90;a:2:{s:13:\"permission_id\";s:2:\"88\";s:15:\"permission_name\";s:17:\"customer tab edit\";}i:91;a:2:{s:13:\"permission_id\";s:2:\"89\";s:15:\"permission_name\";s:17:\"customer tab list\";}}', 1, 1, '2017-08-04 04:33:37', '2019-01-28 06:26:59', NULL),
(2, 2, 'Administrator', 'a:100:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"45\";s:15:\"permission_name\";s:10:\"emailfetch\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"37\";s:15:\"permission_name\";s:14:\"changepassword\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:9;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:10;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"98\";s:15:\"permission_name\";s:13:\"chat settings\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"99\";s:15:\"permission_name\";s:19:\"escalation settings\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"90\";s:15:\"permission_name\";s:21:\"profile customization\";}i:40;a:2:{s:13:\"permission_id\";s:3:\"100\";s:15:\"permission_name\";s:16:\"designation list\";}i:41;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:42;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:43;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:44;a:2:{s:13:\"permission_id\";s:2:\"43\";s:15:\"permission_name\";s:12:\"escalated to\";}i:45;a:2:{s:13:\"permission_id\";s:2:\"92\";s:15:\"permission_name\";s:8:\"escalate\";}i:46;a:2:{s:13:\"permission_id\";s:2:\"44\";s:15:\"permission_name\";s:13:\"followup view\";}i:47;a:2:{s:13:\"permission_id\";s:2:\"47\";s:15:\"permission_name\";s:16:\"Followups Reopen\";}i:48;a:2:{s:13:\"permission_id\";s:2:\"48\";s:15:\"permission_name\";s:21:\"followup history edit\";}i:49;a:2:{s:13:\"permission_id\";s:2:\"46\";s:15:\"permission_name\";s:17:\"survey management\";}i:50;a:2:{s:13:\"permission_id\";s:2:\"49\";s:15:\"permission_name\";s:13:\"survey report\";}i:51;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:52;a:2:{s:13:\"permission_id\";s:2:\"50\";s:15:\"permission_name\";s:15:\"feedback report\";}i:53;a:2:{s:13:\"permission_id\";s:2:\"51\";s:15:\"permission_name\";s:23:\"lead source type create\";}i:54;a:2:{s:13:\"permission_id\";s:2:\"52\";s:15:\"permission_name\";s:21:\"lead source type edit\";}i:55;a:2:{s:13:\"permission_id\";s:2:\"53\";s:15:\"permission_name\";s:21:\"lead source type list\";}i:56;a:2:{s:13:\"permission_id\";s:2:\"54\";s:15:\"permission_name\";s:23:\"lead source type delete\";}i:57;a:2:{s:13:\"permission_id\";s:2:\"55\";s:15:\"permission_name\";s:18:\"lead source create\";}i:58;a:2:{s:13:\"permission_id\";s:2:\"56\";s:15:\"permission_name\";s:16:\"lead source edit\";}i:59;a:2:{s:13:\"permission_id\";s:2:\"57\";s:15:\"permission_name\";s:16:\"lead source list\";}i:60;a:2:{s:13:\"permission_id\";s:2:\"58\";s:15:\"permission_name\";s:18:\"lead source delete\";}i:61;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:62;a:2:{s:13:\"permission_id\";s:2:\"42\";s:15:\"permission_name\";s:19:\"campaign management\";}i:63;a:2:{s:13:\"permission_id\";s:2:\"71\";s:15:\"permission_name\";s:15:\"campaign create\";}i:64;a:2:{s:13:\"permission_id\";s:2:\"72\";s:15:\"permission_name\";s:13:\"campaign edit\";}i:65;a:2:{s:13:\"permission_id\";s:2:\"73\";s:15:\"permission_name\";s:13:\"campaign list\";}i:66;a:2:{s:13:\"permission_id\";s:2:\"74\";s:15:\"permission_name\";s:15:\"campaign delete\";}i:67;a:2:{s:13:\"permission_id\";s:2:\"59\";s:15:\"permission_name\";s:23:\"sales automation create\";}i:68;a:2:{s:13:\"permission_id\";s:2:\"60\";s:15:\"permission_name\";s:21:\"sales automation edit\";}i:69;a:2:{s:13:\"permission_id\";s:2:\"61\";s:15:\"permission_name\";s:21:\"sales automation list\";}i:70;a:2:{s:13:\"permission_id\";s:2:\"62\";s:15:\"permission_name\";s:23:\"sales automation delete\";}i:71;a:2:{s:13:\"permission_id\";s:2:\"94\";s:15:\"permission_name\";s:13:\"outbound call\";}i:72;a:2:{s:13:\"permission_id\";s:2:\"63\";s:15:\"permission_name\";s:26:\"intimation settings create\";}i:73;a:2:{s:13:\"permission_id\";s:2:\"64\";s:15:\"permission_name\";s:24:\"intimation settings edit\";}i:74;a:2:{s:13:\"permission_id\";s:2:\"91\";s:15:\"permission_name\";s:12:\"company meta\";}i:75;a:2:{s:13:\"permission_id\";s:2:\"93\";s:15:\"permission_name\";s:15:\"channel gateway\";}i:76;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}i:77;a:2:{s:13:\"permission_id\";s:2:\"66\";s:15:\"permission_name\";s:16:\"group management\";}i:78;a:2:{s:13:\"permission_id\";s:2:\"67\";s:15:\"permission_name\";s:12:\"group create\";}i:79;a:2:{s:13:\"permission_id\";s:2:\"68\";s:15:\"permission_name\";s:10:\"group edit\";}i:80;a:2:{s:13:\"permission_id\";s:2:\"69\";s:15:\"permission_name\";s:10:\"group list\";}i:81;a:2:{s:13:\"permission_id\";s:2:\"70\";s:15:\"permission_name\";s:12:\"group delete\";}i:82;a:2:{s:13:\"permission_id\";s:2:\"84\";s:15:\"permission_name\";s:17:\"group lead import\";}i:83;a:2:{s:13:\"permission_id\";s:2:\"85\";s:15:\"permission_name\";s:18:\"group excel import\";}i:84;a:2:{s:13:\"permission_id\";s:2:\"75\";s:15:\"permission_name\";s:29:\"campaign email delivery graph\";}i:85;a:2:{s:13:\"permission_id\";s:2:\"76\";s:15:\"permission_name\";s:32:\"campaign batch efficiency report\";}i:86;a:2:{s:13:\"permission_id\";s:2:\"77\";s:15:\"permission_name\";s:27:\"campaign email batch report\";}i:87;a:2:{s:13:\"permission_id\";s:2:\"78\";s:15:\"permission_name\";s:27:\"campaign sms delivery graph\";}i:88;a:2:{s:13:\"permission_id\";s:2:\"79\";s:15:\"permission_name\";s:25:\"campaign sms batch report\";}i:89;a:2:{s:13:\"permission_id\";s:2:\"80\";s:15:\"permission_name\";s:30:\"campaign autodial status graph\";}i:90;a:2:{s:13:\"permission_id\";s:2:\"81\";s:15:\"permission_name\";s:30:\"campaign autodial batch report\";}i:91;a:2:{s:13:\"permission_id\";s:2:\"82\";s:15:\"permission_name\";s:32:\"campaign manualcall status graph\";}i:92;a:2:{s:13:\"permission_id\";s:2:\"83\";s:15:\"permission_name\";s:32:\"campaign manualcall batch report\";}i:93;a:2:{s:13:\"permission_id\";s:2:\"86\";s:15:\"permission_name\";s:19:\"customer tab create\";}i:94;a:2:{s:13:\"permission_id\";s:2:\"87\";s:15:\"permission_name\";s:19:\"customer tab delete\";}i:95;a:2:{s:13:\"permission_id\";s:2:\"88\";s:15:\"permission_name\";s:17:\"customer tab edit\";}i:96;a:2:{s:13:\"permission_id\";s:2:\"89\";s:15:\"permission_name\";s:17:\"customer tab list\";}i:97;a:2:{s:13:\"permission_id\";s:2:\"95\";s:15:\"permission_name\";s:18:\"chat configuration\";}i:98;a:2:{s:13:\"permission_id\";s:2:\"96\";s:15:\"permission_name\";s:26:\"view auto reply categories\";}i:99;a:2:{s:13:\"permission_id\";s:2:\"97\";s:15:\"permission_name\";s:15:\"auto reply list\";}}', 2, 2, '2017-08-04 04:33:37', '2019-01-30 01:48:45', NULL),
(3, 2, 'Domain Expert', 'a:40:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:9;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"37\";s:15:\"permission_name\";s:14:\"changepassword\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}}', 2, 2, '2017-08-26 05:34:00', '2018-11-07 03:03:44', NULL),
(4, 2, 'Chat-Agent', 'a:41:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:9;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:40;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}}', 2, 2, '2018-06-29 07:27:05', '2019-01-24 05:58:18', NULL),
(5, 2, 'Manager', 'a:41:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:9;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"37\";s:15:\"permission_name\";s:14:\"changepassword\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:40;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}}', 2, 2, '2017-08-08 03:53:59', '2018-08-28 23:17:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_sendgrid_response`
--

CREATE TABLE `ori_sendgrid_response` (
  `id` bigint(20) NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_stamp` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sg_message_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_ref_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_full_response` text COLLATE utf8mb4_unicode_ci,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-active 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_state`
--

CREATE TABLE `ori_state` (
  `country_code` int(11) NOT NULL,
  `state_code` int(11) NOT NULL DEFAULT '0',
  `state_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_survey_details`
--

CREATE TABLE `ori_survey_details` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL COMMENT 'Referred from cc_customer_profile',
  `contact_id` bigint(20) DEFAULT NULL,
  `survey_id` bigint(20) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL COMMENT 'Referred from cmp_details',
  `batch_id` int(11) DEFAULT NULL COMMENT 'Referred from cmp_process_batches',
  `common_id` bigint(20) DEFAULT NULL COMMENT 'Referred from cc_common_email_sms',
  `type` int(11) DEFAULT NULL COMMENT '1- SMS,2- Email, ',
  `language_type` int(11) DEFAULT NULL COMMENT '1-  English,2- Malayalam',
  `status` int(11) DEFAULT NULL COMMENT '1- Active,2- Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_survey_question_details`
--

CREATE TABLE `ori_survey_question_details` (
  `id` bigint(20) NOT NULL,
  `survey_det_id` bigint(20) DEFAULT NULL COMMENT 'Referred from cc_survey_details',
  `question_id` int(11) DEFAULT NULL COMMENT 'Referred from cc_survey_question_master',
  `relation_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_survey_question_settings',
  `answer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_survey_question_settings`
--

CREATE TABLE `ori_survey_question_settings` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `survey_id` bigint(20) DEFAULT NULL COMMENT 'Referred from ori_survey_sertting',
  `qstn_id_lang1` int(11) DEFAULT NULL COMMENT 'Referred from ori_questions',
  `qstn_id_lang2` int(11) DEFAULT NULL COMMENT 'Referred from fReferre from ori_questions',
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_survey_settings`
--

CREATE TABLE `ori_survey_settings` (
  `id` bigint(20) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `survey_name_lang1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_name_lang2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_lang1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_lang2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_lang1` int(11) DEFAULT NULL,
  `is_lang2` int(11) DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ori_tabs`
--

CREATE TABLE `ori_tabs` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1- tab containing normal fileds,2- tab containing repeatable fields',
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-Active,2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_tabs`
--

INSERT INTO `ori_tabs` (`id`, `cmpny_id`, `name`, `type`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Basic Details', 3, 0, 1, 2, 2, '2018-12-05 01:17:20', '2018-12-05 01:19:48', NULL),
(2, 2, 'Communication', 1, 0, 1, 2, 2, '2018-12-05 01:17:44', '2018-12-05 01:19:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_users`
--

CREATE TABLE `ori_users` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `local_body_type` int(11) DEFAULT NULL,
  `muncipality_id` int(11) DEFAULT NULL,
  `corporation_id` int(11) DEFAULT NULL,
  `panchayath_type` int(11) DEFAULT NULL,
  `district_panchayath_id` int(11) DEFAULT NULL,
  `block_panchayath_id` int(11) DEFAULT NULL,
  `grama_panchayath_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL COMMENT 'Reffered from ori_mast_query_types',
  `designation` int(11) DEFAULT NULL COMMENT 'Reffered from ori_mast_designation',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contains serialized array of role ids-Referred from ori_roles',
  `remember_token` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_permission` text COLLATE utf8mb4_unicode_ci,
  `logged_in` int(11) DEFAULT NULL,
  `session_id` text COLLATE utf8mb4_unicode_ci,
  `last_logged_in_at` datetime DEFAULT NULL,
  `chat_login_time` datetime DEFAULT NULL,
  `current_chat_count` int(11) DEFAULT NULL,
  `chat_flag` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active 2-Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_users`
--

INSERT INTO `ori_users` (`id`, `cmpny_id`, `name`, `email`, `username`, `chat_name`, `phone`, `address`, `country_id`, `state_id`, `district_id`, `local_body_type`, `muncipality_id`, `corporation_id`, `panchayath_type`, `district_panchayath_id`, `block_panchayath_id`, `grama_panchayath_id`, `panchayath_id`, `department`, `designation`, `password`, `extension`, `role_id`, `remember_token`, `access_permission`, `logged_in`, `session_id`, `last_logged_in_at`, `chat_login_time`, `current_chat_count`, `chat_flag`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Oricom', 'admin@oricom.in', 'oricom', 'oricom', '80868000203', 'D3,6th floor, Bhavani Building, Technopark,Trivandrum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WAujBoWDvGcA0lIzvJqBT.xhIJIPLLWoFlXs8x3dYXoAmduVbJGZy', NULL, 'a:1:{i:0;s:1:\"1\";}', '7j5q8VLeoyw2YFv3xStdT4g9MFJYFBrVPkfs8hQappbohS88H49b15oZhZrU', 'a:91:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"45\";s:15:\"permission_name\";s:10:\"emailfetch\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:9;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"90\";s:15:\"permission_name\";s:21:\"profile customization\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:40;a:2:{s:13:\"permission_id\";s:2:\"43\";s:15:\"permission_name\";s:12:\"escalated to\";}i:41;a:2:{s:13:\"permission_id\";s:2:\"92\";s:15:\"permission_name\";s:8:\"escalate\";}i:42;a:2:{s:13:\"permission_id\";s:2:\"44\";s:15:\"permission_name\";s:13:\"followup view\";}i:43;a:2:{s:13:\"permission_id\";s:2:\"47\";s:15:\"permission_name\";s:16:\"Followups Reopen\";}i:44;a:2:{s:13:\"permission_id\";s:2:\"48\";s:15:\"permission_name\";s:21:\"followup history edit\";}i:45;a:2:{s:13:\"permission_id\";s:2:\"46\";s:15:\"permission_name\";s:17:\"survey management\";}i:46;a:2:{s:13:\"permission_id\";s:2:\"49\";s:15:\"permission_name\";s:13:\"survey report\";}i:47;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:48;a:2:{s:13:\"permission_id\";s:2:\"50\";s:15:\"permission_name\";s:15:\"feedback report\";}i:49;a:2:{s:13:\"permission_id\";s:2:\"51\";s:15:\"permission_name\";s:23:\"lead source type create\";}i:50;a:2:{s:13:\"permission_id\";s:2:\"52\";s:15:\"permission_name\";s:21:\"lead source type edit\";}i:51;a:2:{s:13:\"permission_id\";s:2:\"53\";s:15:\"permission_name\";s:21:\"lead source type list\";}i:52;a:2:{s:13:\"permission_id\";s:2:\"54\";s:15:\"permission_name\";s:23:\"lead source type delete\";}i:53;a:2:{s:13:\"permission_id\";s:2:\"55\";s:15:\"permission_name\";s:18:\"lead source create\";}i:54;a:2:{s:13:\"permission_id\";s:2:\"56\";s:15:\"permission_name\";s:16:\"lead source edit\";}i:55;a:2:{s:13:\"permission_id\";s:2:\"57\";s:15:\"permission_name\";s:16:\"lead source list\";}i:56;a:2:{s:13:\"permission_id\";s:2:\"58\";s:15:\"permission_name\";s:18:\"lead source delete\";}i:57;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:58;a:2:{s:13:\"permission_id\";s:2:\"42\";s:15:\"permission_name\";s:19:\"campaign management\";}i:59;a:2:{s:13:\"permission_id\";s:2:\"71\";s:15:\"permission_name\";s:15:\"campaign create\";}i:60;a:2:{s:13:\"permission_id\";s:2:\"72\";s:15:\"permission_name\";s:13:\"campaign edit\";}i:61;a:2:{s:13:\"permission_id\";s:2:\"73\";s:15:\"permission_name\";s:13:\"campaign list\";}i:62;a:2:{s:13:\"permission_id\";s:2:\"74\";s:15:\"permission_name\";s:15:\"campaign delete\";}i:63;a:2:{s:13:\"permission_id\";s:2:\"59\";s:15:\"permission_name\";s:23:\"sales automation create\";}i:64;a:2:{s:13:\"permission_id\";s:2:\"60\";s:15:\"permission_name\";s:21:\"sales automation edit\";}i:65;a:2:{s:13:\"permission_id\";s:2:\"61\";s:15:\"permission_name\";s:21:\"sales automation list\";}i:66;a:2:{s:13:\"permission_id\";s:2:\"62\";s:15:\"permission_name\";s:23:\"sales automation delete\";}i:67;a:2:{s:13:\"permission_id\";s:2:\"63\";s:15:\"permission_name\";s:26:\"intimation settings create\";}i:68;a:2:{s:13:\"permission_id\";s:2:\"64\";s:15:\"permission_name\";s:24:\"intimation settings edit\";}i:69;a:2:{s:13:\"permission_id\";s:2:\"91\";s:15:\"permission_name\";s:12:\"company meta\";}i:70;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}i:71;a:2:{s:13:\"permission_id\";s:2:\"66\";s:15:\"permission_name\";s:16:\"group management\";}i:72;a:2:{s:13:\"permission_id\";s:2:\"67\";s:15:\"permission_name\";s:12:\"group create\";}i:73;a:2:{s:13:\"permission_id\";s:2:\"68\";s:15:\"permission_name\";s:10:\"group edit\";}i:74;a:2:{s:13:\"permission_id\";s:2:\"69\";s:15:\"permission_name\";s:10:\"group list\";}i:75;a:2:{s:13:\"permission_id\";s:2:\"70\";s:15:\"permission_name\";s:12:\"group delete\";}i:76;a:2:{s:13:\"permission_id\";s:2:\"84\";s:15:\"permission_name\";s:17:\"group lead import\";}i:77;a:2:{s:13:\"permission_id\";s:2:\"85\";s:15:\"permission_name\";s:18:\"group excel import\";}i:78;a:2:{s:13:\"permission_id\";s:2:\"75\";s:15:\"permission_name\";s:29:\"campaign email delivery graph\";}i:79;a:2:{s:13:\"permission_id\";s:2:\"76\";s:15:\"permission_name\";s:32:\"campaign batch efficiency report\";}i:80;a:2:{s:13:\"permission_id\";s:2:\"77\";s:15:\"permission_name\";s:27:\"campaign email batch report\";}i:81;a:2:{s:13:\"permission_id\";s:2:\"78\";s:15:\"permission_name\";s:27:\"campaign sms delivery graph\";}i:82;a:2:{s:13:\"permission_id\";s:2:\"79\";s:15:\"permission_name\";s:25:\"campaign sms batch report\";}i:83;a:2:{s:13:\"permission_id\";s:2:\"80\";s:15:\"permission_name\";s:30:\"campaign autodial status graph\";}i:84;a:2:{s:13:\"permission_id\";s:2:\"81\";s:15:\"permission_name\";s:30:\"campaign autodial batch report\";}i:85;a:2:{s:13:\"permission_id\";s:2:\"82\";s:15:\"permission_name\";s:32:\"campaign manualcall status graph\";}i:86;a:2:{s:13:\"permission_id\";s:2:\"83\";s:15:\"permission_name\";s:32:\"campaign manualcall batch report\";}i:87;a:2:{s:13:\"permission_id\";s:2:\"86\";s:15:\"permission_name\";s:19:\"customer tab create\";}i:88;a:2:{s:13:\"permission_id\";s:2:\"87\";s:15:\"permission_name\";s:19:\"customer tab delete\";}i:89;a:2:{s:13:\"permission_id\";s:2:\"88\";s:15:\"permission_name\";s:17:\"customer tab edit\";}i:90;a:2:{s:13:\"permission_id\";s:2:\"89\";s:15:\"permission_name\";s:17:\"customer tab list\";}}', 1, 'Lo01TaxYykcn9v1dMnSkFOPNQKOt6EhCkTfq3eW0', '2019-01-30 04:57:26', NULL, 0, 1, 1, NULL, NULL, '2018-10-05 01:21:53', '2019-01-29 23:27:26', NULL),
(2, 2, 'orisys', 'admin@orisys.in', 'admin', 'admin', '9895588804', 'Mani Bhavan ,PLRA F9 Panickers Lane, Sasthamangalam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ji.XpC0z6eYQ/9vcxSiAruQwWGv4h436GOphBUB0lQPdxGZ/gT58a', NULL, 'a:1:{i:0;s:1:\"2\";}', 'uJbGshLtLcc4H90DSpYX5UizAlZHJqMn5qPjLeNiZ4sAC2a0TCwo7P8yj1iN', 'a:100:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:2:\"45\";s:15:\"permission_name\";s:10:\"emailfetch\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:4;a:2:{s:13:\"permission_id\";s:2:\"37\";s:15:\"permission_name\";s:14:\"changepassword\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:9;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:10;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"98\";s:15:\"permission_name\";s:13:\"chat settings\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"99\";s:15:\"permission_name\";s:19:\"escalation settings\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"90\";s:15:\"permission_name\";s:21:\"profile customization\";}i:40;a:2:{s:13:\"permission_id\";s:3:\"100\";s:15:\"permission_name\";s:16:\"designation list\";}i:41;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:42;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:43;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:44;a:2:{s:13:\"permission_id\";s:2:\"43\";s:15:\"permission_name\";s:12:\"escalated to\";}i:45;a:2:{s:13:\"permission_id\";s:2:\"92\";s:15:\"permission_name\";s:8:\"escalate\";}i:46;a:2:{s:13:\"permission_id\";s:2:\"44\";s:15:\"permission_name\";s:13:\"followup view\";}i:47;a:2:{s:13:\"permission_id\";s:2:\"47\";s:15:\"permission_name\";s:16:\"Followups Reopen\";}i:48;a:2:{s:13:\"permission_id\";s:2:\"48\";s:15:\"permission_name\";s:21:\"followup history edit\";}i:49;a:2:{s:13:\"permission_id\";s:2:\"46\";s:15:\"permission_name\";s:17:\"survey management\";}i:50;a:2:{s:13:\"permission_id\";s:2:\"49\";s:15:\"permission_name\";s:13:\"survey report\";}i:51;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:52;a:2:{s:13:\"permission_id\";s:2:\"50\";s:15:\"permission_name\";s:15:\"feedback report\";}i:53;a:2:{s:13:\"permission_id\";s:2:\"51\";s:15:\"permission_name\";s:23:\"lead source type create\";}i:54;a:2:{s:13:\"permission_id\";s:2:\"52\";s:15:\"permission_name\";s:21:\"lead source type edit\";}i:55;a:2:{s:13:\"permission_id\";s:2:\"53\";s:15:\"permission_name\";s:21:\"lead source type list\";}i:56;a:2:{s:13:\"permission_id\";s:2:\"54\";s:15:\"permission_name\";s:23:\"lead source type delete\";}i:57;a:2:{s:13:\"permission_id\";s:2:\"55\";s:15:\"permission_name\";s:18:\"lead source create\";}i:58;a:2:{s:13:\"permission_id\";s:2:\"56\";s:15:\"permission_name\";s:16:\"lead source edit\";}i:59;a:2:{s:13:\"permission_id\";s:2:\"57\";s:15:\"permission_name\";s:16:\"lead source list\";}i:60;a:2:{s:13:\"permission_id\";s:2:\"58\";s:15:\"permission_name\";s:18:\"lead source delete\";}i:61;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:62;a:2:{s:13:\"permission_id\";s:2:\"42\";s:15:\"permission_name\";s:19:\"campaign management\";}i:63;a:2:{s:13:\"permission_id\";s:2:\"71\";s:15:\"permission_name\";s:15:\"campaign create\";}i:64;a:2:{s:13:\"permission_id\";s:2:\"72\";s:15:\"permission_name\";s:13:\"campaign edit\";}i:65;a:2:{s:13:\"permission_id\";s:2:\"73\";s:15:\"permission_name\";s:13:\"campaign list\";}i:66;a:2:{s:13:\"permission_id\";s:2:\"74\";s:15:\"permission_name\";s:15:\"campaign delete\";}i:67;a:2:{s:13:\"permission_id\";s:2:\"59\";s:15:\"permission_name\";s:23:\"sales automation create\";}i:68;a:2:{s:13:\"permission_id\";s:2:\"60\";s:15:\"permission_name\";s:21:\"sales automation edit\";}i:69;a:2:{s:13:\"permission_id\";s:2:\"61\";s:15:\"permission_name\";s:21:\"sales automation list\";}i:70;a:2:{s:13:\"permission_id\";s:2:\"62\";s:15:\"permission_name\";s:23:\"sales automation delete\";}i:71;a:2:{s:13:\"permission_id\";s:2:\"94\";s:15:\"permission_name\";s:13:\"outbound call\";}i:72;a:2:{s:13:\"permission_id\";s:2:\"63\";s:15:\"permission_name\";s:26:\"intimation settings create\";}i:73;a:2:{s:13:\"permission_id\";s:2:\"64\";s:15:\"permission_name\";s:24:\"intimation settings edit\";}i:74;a:2:{s:13:\"permission_id\";s:2:\"91\";s:15:\"permission_name\";s:12:\"company meta\";}i:75;a:2:{s:13:\"permission_id\";s:2:\"93\";s:15:\"permission_name\";s:15:\"channel gateway\";}i:76;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}i:77;a:2:{s:13:\"permission_id\";s:2:\"66\";s:15:\"permission_name\";s:16:\"group management\";}i:78;a:2:{s:13:\"permission_id\";s:2:\"67\";s:15:\"permission_name\";s:12:\"group create\";}i:79;a:2:{s:13:\"permission_id\";s:2:\"68\";s:15:\"permission_name\";s:10:\"group edit\";}i:80;a:2:{s:13:\"permission_id\";s:2:\"69\";s:15:\"permission_name\";s:10:\"group list\";}i:81;a:2:{s:13:\"permission_id\";s:2:\"70\";s:15:\"permission_name\";s:12:\"group delete\";}i:82;a:2:{s:13:\"permission_id\";s:2:\"84\";s:15:\"permission_name\";s:17:\"group lead import\";}i:83;a:2:{s:13:\"permission_id\";s:2:\"85\";s:15:\"permission_name\";s:18:\"group excel import\";}i:84;a:2:{s:13:\"permission_id\";s:2:\"75\";s:15:\"permission_name\";s:29:\"campaign email delivery graph\";}i:85;a:2:{s:13:\"permission_id\";s:2:\"76\";s:15:\"permission_name\";s:32:\"campaign batch efficiency report\";}i:86;a:2:{s:13:\"permission_id\";s:2:\"77\";s:15:\"permission_name\";s:27:\"campaign email batch report\";}i:87;a:2:{s:13:\"permission_id\";s:2:\"78\";s:15:\"permission_name\";s:27:\"campaign sms delivery graph\";}i:88;a:2:{s:13:\"permission_id\";s:2:\"79\";s:15:\"permission_name\";s:25:\"campaign sms batch report\";}i:89;a:2:{s:13:\"permission_id\";s:2:\"80\";s:15:\"permission_name\";s:30:\"campaign autodial status graph\";}i:90;a:2:{s:13:\"permission_id\";s:2:\"81\";s:15:\"permission_name\";s:30:\"campaign autodial batch report\";}i:91;a:2:{s:13:\"permission_id\";s:2:\"82\";s:15:\"permission_name\";s:32:\"campaign manualcall status graph\";}i:92;a:2:{s:13:\"permission_id\";s:2:\"83\";s:15:\"permission_name\";s:32:\"campaign manualcall batch report\";}i:93;a:2:{s:13:\"permission_id\";s:2:\"86\";s:15:\"permission_name\";s:19:\"customer tab create\";}i:94;a:2:{s:13:\"permission_id\";s:2:\"87\";s:15:\"permission_name\";s:19:\"customer tab delete\";}i:95;a:2:{s:13:\"permission_id\";s:2:\"88\";s:15:\"permission_name\";s:17:\"customer tab edit\";}i:96;a:2:{s:13:\"permission_id\";s:2:\"89\";s:15:\"permission_name\";s:17:\"customer tab list\";}i:97;a:2:{s:13:\"permission_id\";s:2:\"95\";s:15:\"permission_name\";s:18:\"chat configuration\";}i:98;a:2:{s:13:\"permission_id\";s:2:\"96\";s:15:\"permission_name\";s:26:\"view auto reply categories\";}i:99;a:2:{s:13:\"permission_id\";s:2:\"97\";s:15:\"permission_name\";s:15:\"auto reply list\";}}', 1, 'kaDaCmvT8hz3V4iunmfer7ZnyPMUGQtxbtyFL6rz', '2019-01-30 04:47:57', NULL, 0, 1, 1, NULL, NULL, '2018-10-05 07:59:35', '2019-01-30 01:49:03', NULL),
(3, 2, 'Tagent', 'testagent@gmail.com', 'tagent', 'tagent', '1234567890', 'TVM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$HR/iBcF7hF6acQJD.yfWbuvsGWaTkncUEdXEkdoLQn37exJL7j5Na', NULL, 'a:1:{i:0;s:1:\"4\";}', 'oOeTEZX0PdncNyDSG3590YfyevhGeFtncOosG621er7s407mg4jLdUW9usV8', 'a:41:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:9;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:40;a:2:{s:13:\"permission_id\";s:2:\"65\";s:15:\"permission_name\";s:17:\"notification list\";}}', 1, 'gu6QbZnsenocazLgeEjePGBHMlQ7lCCSuds2aVpN', '2019-01-24 11:26:12', NULL, 0, 1, 1, NULL, NULL, '2018-11-13 07:16:28', '2019-01-24 05:58:45', NULL),
(4, 2, 'Agent', 'agent1@gmail.com', 'agent1', 'agent1', '1234567890', 'TVM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$qAC/yDSZFjgHfeSHbMdgK.sRUHTwInVEm5ukaygii7ZWAcsoGgQga', NULL, 'a:1:{i:0;s:1:\"4\";}', NULL, 'a:41:{i:0;a:2:{s:13:\"permission_id\";s:1:\"1\";s:15:\"permission_name\";s:21:\"permission management\";}i:1;a:2:{s:13:\"permission_id\";s:1:\"2\";s:15:\"permission_name\";s:15:\"role management\";}i:2;a:2:{s:13:\"permission_id\";s:1:\"3\";s:15:\"permission_name\";s:15:\"user management\";}i:3;a:2:{s:13:\"permission_id\";s:1:\"4\";s:15:\"permission_name\";s:11:\"plan create\";}i:4;a:2:{s:13:\"permission_id\";s:1:\"5\";s:15:\"permission_name\";s:9:\"plan edit\";}i:5;a:2:{s:13:\"permission_id\";s:1:\"6\";s:15:\"permission_name\";s:9:\"plan list\";}i:6;a:2:{s:13:\"permission_id\";s:1:\"7\";s:15:\"permission_name\";s:11:\"plan delete\";}i:7;a:2:{s:13:\"permission_id\";s:1:\"8\";s:15:\"permission_name\";s:17:\"query type create\";}i:8;a:2:{s:13:\"permission_id\";s:1:\"9\";s:15:\"permission_name\";s:15:\"query type edit\";}i:9;a:2:{s:13:\"permission_id\";s:2:\"10\";s:15:\"permission_name\";s:15:\"query type list\";}i:10;a:2:{s:13:\"permission_id\";s:2:\"11\";s:15:\"permission_name\";s:17:\"query type delete\";}i:11;a:2:{s:13:\"permission_id\";s:2:\"12\";s:15:\"permission_name\";s:19:\"query status create\";}i:12;a:2:{s:13:\"permission_id\";s:2:\"13\";s:15:\"permission_name\";s:17:\"query status edit\";}i:13;a:2:{s:13:\"permission_id\";s:2:\"14\";s:15:\"permission_name\";s:17:\"query status list\";}i:14;a:2:{s:13:\"permission_id\";s:2:\"15\";s:15:\"permission_name\";s:19:\"query status delete\";}i:15;a:2:{s:13:\"permission_id\";s:2:\"16\";s:15:\"permission_name\";s:22:\"customer nature create\";}i:16;a:2:{s:13:\"permission_id\";s:2:\"17\";s:15:\"permission_name\";s:20:\"customer nature edit\";}i:17;a:2:{s:13:\"permission_id\";s:2:\"18\";s:15:\"permission_name\";s:20:\"customer nature list\";}i:18;a:2:{s:13:\"permission_id\";s:2:\"19\";s:15:\"permission_name\";s:22:\"customer nature delete\";}i:19;a:2:{s:13:\"permission_id\";s:2:\"20\";s:15:\"permission_name\";s:24:\"customer priority create\";}i:20;a:2:{s:13:\"permission_id\";s:2:\"21\";s:15:\"permission_name\";s:22:\"customer priority edit\";}i:21;a:2:{s:13:\"permission_id\";s:2:\"22\";s:15:\"permission_name\";s:22:\"customer priority list\";}i:22;a:2:{s:13:\"permission_id\";s:2:\"23\";s:15:\"permission_name\";s:24:\"customer priority delete\";}i:23;a:2:{s:13:\"permission_id\";s:2:\"24\";s:15:\"permission_name\";s:10:\"faq create\";}i:24;a:2:{s:13:\"permission_id\";s:2:\"25\";s:15:\"permission_name\";s:8:\"faq edit\";}i:25;a:2:{s:13:\"permission_id\";s:2:\"26\";s:15:\"permission_name\";s:8:\"faq list\";}i:26;a:2:{s:13:\"permission_id\";s:2:\"27\";s:15:\"permission_name\";s:10:\"faq delete\";}i:27;a:2:{s:13:\"permission_id\";s:2:\"28\";s:15:\"permission_name\";s:19:\"view faq categories\";}i:28;a:2:{s:13:\"permission_id\";s:2:\"29\";s:15:\"permission_name\";s:13:\"settings view\";}i:29;a:2:{s:13:\"permission_id\";s:2:\"30\";s:15:\"permission_name\";s:15:\"template create\";}i:30;a:2:{s:13:\"permission_id\";s:2:\"31\";s:15:\"permission_name\";s:13:\"template edit\";}i:31;a:2:{s:13:\"permission_id\";s:2:\"32\";s:15:\"permission_name\";s:13:\"template list\";}i:32;a:2:{s:13:\"permission_id\";s:2:\"33\";s:15:\"permission_name\";s:15:\"template delete\";}i:33;a:2:{s:13:\"permission_id\";s:2:\"34\";s:15:\"permission_name\";s:14:\"profile create\";}i:34;a:2:{s:13:\"permission_id\";s:2:\"35\";s:15:\"permission_name\";s:12:\"profile view\";}i:35;a:2:{s:13:\"permission_id\";s:2:\"36\";s:15:\"permission_name\";s:9:\"lead list\";}i:36;a:2:{s:13:\"permission_id\";s:2:\"37\";s:15:\"permission_name\";s:14:\"changepassword\";}i:37;a:2:{s:13:\"permission_id\";s:2:\"38\";s:15:\"permission_name\";s:19:\"question management\";}i:38;a:2:{s:13:\"permission_id\";s:2:\"39\";s:15:\"permission_name\";s:17:\"feedback settings\";}i:39;a:2:{s:13:\"permission_id\";s:2:\"40\";s:15:\"permission_name\";s:24:\"service request all list\";}i:40;a:2:{s:13:\"permission_id\";s:2:\"41\";s:15:\"permission_name\";s:24:\"escalation summary chart\";}}', 0, 'XMKFCRAIpUyHwAv2UH2QxVsobUoMXEneQcuCXXm6', '2018-11-16 06:37:39', NULL, 0, 1, 1, NULL, NULL, '2018-11-16 01:06:57', '2018-11-16 01:07:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ori_user_logs`
--

CREATE TABLE `ori_user_logs` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ori_user_logs`
--

INSERT INTO `ori_user_logs` (`id`, `cmpny_id`, `user_id`, `ipaddress`, `location`, `related_to`, `message`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-18 06:33:29', '2019-01-18 06:33:29'),
(2, NULL, 1, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-18 06:33:39', '2019-01-18 06:33:39'),
(3, NULL, 1, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-18 06:36:51', '2019-01-18 06:36:51'),
(4, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-18 06:36:57', '2019-01-18 06:36:57'),
(5, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-19 00:35:18', '2019-01-19 00:35:18'),
(6, NULL, 2, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-19 01:13:11', '2019-01-19 01:13:11'),
(7, NULL, 1, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-19 01:13:16', '2019-01-19 01:13:16'),
(8, NULL, 1, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-19 01:13:58', '2019-01-19 01:13:58'),
(9, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-19 01:14:02', '2019-01-19 01:14:02'),
(10, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-20 23:17:43', '2019-01-20 23:17:43'),
(11, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-21 23:10:38', '2019-01-21 23:10:38'),
(12, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-23 00:33:24', '2019-01-23 00:33:24'),
(13, NULL, 2, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-23 04:55:23', '2019-01-23 04:55:23'),
(14, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-23 04:55:30', '2019-01-23 04:55:30'),
(15, NULL, 2, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-23 04:55:34', '2019-01-23 04:55:34'),
(16, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-23 04:55:38', '2019-01-23 04:55:38'),
(17, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-23 23:19:54', '2019-01-23 23:19:54'),
(18, NULL, 2, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-24 05:45:18', '2019-01-24 05:45:18'),
(19, NULL, 1, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-24 05:45:24', '2019-01-24 05:45:24'),
(20, NULL, 1, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-24 05:54:07', '2019-01-24 05:54:07'),
(21, NULL, 1, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-24 05:54:10', '2019-01-24 05:54:10'),
(22, NULL, 1, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-24 05:54:34', '2019-01-24 05:54:34'),
(23, NULL, 3, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-24 05:56:12', '2019-01-24 05:56:12'),
(24, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-24 05:57:54', '2019-01-24 05:57:54'),
(25, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-28 00:47:19', '2019-01-28 00:47:19'),
(26, NULL, 1, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-28 01:39:27', '2019-01-28 01:39:27'),
(27, NULL, 2, '127.0.0.1', '', 'logout', 'you are logged out', '2019-01-28 06:26:11', '2019-01-28 06:26:11'),
(28, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-28 06:27:04', '2019-01-28 06:27:04'),
(29, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-28 23:00:17', '2019-01-28 23:00:17'),
(30, NULL, 2, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-29 23:17:57', '2019-01-29 23:17:57'),
(31, NULL, 1, '127.0.0.1', '', 'login', 'you are loggedin', '2019-01-29 23:27:26', '2019-01-29 23:27:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`(191));

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_api_call_logs`
--
ALTER TABLE `ori_api_call_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_attachments`
--
ALTER TABLE `ori_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_attachments_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_attachments_created_by_foreign` (`created_by`),
  ADD KEY `ori_attachments_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `ori_autodial_schedules`
--
ALTER TABLE `ori_autodial_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_autodial_schedules_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_automated_process`
--
ALTER TABLE `ori_automated_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_automated_process_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_automated_process_batch`
--
ALTER TABLE `ori_automated_process_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_automated_process_batch_expiry`
--
ALTER TABLE `ori_automated_process_batch_expiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_automated_process_log`
--
ALTER TABLE `ori_automated_process_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_automated_process_relations`
--
ALTER TABLE `ori_automated_process_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_automated_process_stages`
--
ALTER TABLE `ori_automated_process_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_auto_reply`
--
ALTER TABLE `ori_auto_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_auto_reply_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_auto_reply_auto_reply_category_id_foreign` (`auto_reply_category_id`);

--
-- Indexes for table `ori_auto_reply_category`
--
ALTER TABLE `ori_auto_reply_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_auto_reply_category_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_basic_templates`
--
ALTER TABLE `ori_basic_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_batch_process`
--
ALTER TABLE `ori_batch_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_batch_process_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_batch_process_group_id_foreign` (`group_id`),
  ADD KEY `ori_batch_process_created_by_foreign` (`created_by`),
  ADD KEY `ori_batch_process_updated_by_foreign` (`updated_by`),
  ADD KEY `ori_batch_process_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `ori_campaigns`
--
ALTER TABLE `ori_campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_campaigns_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_campaigns_created_by_foreign` (`created_by`),
  ADD KEY `ori_campaigns_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `ori_campaigns_meta`
--
ALTER TABLE `ori_campaigns_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_campaigns_meta_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_campaigns_meta_campaign_id_foreign` (`campaign_id`),
  ADD KEY `ori_campaigns_meta_source_type_foreign` (`source_type`),
  ADD KEY `ori_campaigns_meta_source_id_foreign` (`source_id`),
  ADD KEY `ori_campaigns_meta_created_by_foreign` (`created_by`),
  ADD KEY `ori_campaigns_meta_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `ori_campaign_batches`
--
ALTER TABLE `ori_campaign_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_campaign_batches_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_campaign_batches_campaign_id_foreign` (`campaign_id`),
  ADD KEY `ori_campaign_batches_survey_id_foreign` (`survey_id`),
  ADD KEY `ori_campaign_batches_created_by_foreign` (`created_by`),
  ADD KEY `ori_campaign_batches_channel_type_foreign` (`channel_type`),
  ADD KEY `ori_campaign_batches_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `ori_campaign_batch_groups`
--
ALTER TABLE `ori_campaign_batch_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_campaign_batch_groups_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_campaign_batch_groups_batch_id_foreign` (`batch_id`),
  ADD KEY `ori_campaign_batch_groups_group_id_foreign` (`group_id`),
  ADD KEY `ori_campaign_batch_groups_created_by_foreign` (`created_by`);

--
-- Indexes for table `ori_campaign_groups`
--
ALTER TABLE `ori_campaign_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ori_campaign_groups_campaign_id_group_id_unique` (`campaign_id`,`group_id`),
  ADD KEY `ori_campaign_groups_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_campaign_groups_group_id_foreign` (`group_id`),
  ADD KEY `ori_campaign_groups_created_by_foreign` (`created_by`),
  ADD KEY `ori_campaign_groups_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `ori_campaign_query_status`
--
ALTER TABLE `ori_campaign_query_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_emailfetch_company_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_campaign_query_status_campaign_id_foreign` (`campaign_id`),
  ADD KEY `ori_campaign_query_status_batch_id_foreign` (`batch_id`),
  ADD KEY `ori_campaign_query_status_query_type_foreign` (`query_type`),
  ADD KEY `ori_campaign_query_status_query_status_foreign` (`query_status`);

--
-- Indexes for table `ori_channels`
--
ALTER TABLE `ori_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_channel_gateway`
--
ALTER TABLE `ori_channel_gateway`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indexes for table `ori_chat_feedback_count`
--
ALTER TABLE `ori_chat_feedback_count`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_chat_feedback_count_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `ori_chat_thread`
--
ALTER TABLE `ori_chat_thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_chat_thread_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_chat_thread_cust_id_foreign` (`cust_id`),
  ADD KEY `ori_chat_thread_agent_id_foreign` (`agent_id`),
  ADD KEY `ori_chat_thread_lead_source_id_foreign` (`lead_source_id`);

--
-- Indexes for table `ori_chat_thread_logs`
--
ALTER TABLE `ori_chat_thread_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_cmp_contacts`
--
ALTER TABLE `ori_cmp_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_cmp_contacts_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_cmp_contacts_user_id_foreign` (`user_id`),
  ADD KEY `ori_cmp_contacts_country_id_foreign` (`country_id`),
  ADD KEY `ori_cmp_contacts_state_id_foreign` (`state_id`),
  ADD KEY `ori_cmp_contacts_district_id_foreign` (`district_id`),
  ADD KEY `ori_cmp_contacts_local_body_type_foreign` (`local_body_type`),
  ADD KEY `ori_cmp_contacts_muncipality_id_foreign` (`muncipality_id`),
  ADD KEY `ori_cmp_contacts_corporation_id_foreign` (`corporation_id`),
  ADD KEY `ori_cmp_contacts_district_panchayath_id_foreign` (`district_panchayath_id`),
  ADD KEY `ori_cmp_contacts_block_panchayath_id_foreign` (`block_panchayath_id`),
  ADD KEY `ori_cmp_contacts_grama_panchayath_id_foreign` (`grama_panchayath_id`),
  ADD KEY `ori_cmp_contacts_panchayath_id_foreign` (`panchayath_id`);

--
-- Indexes for table `ori_cmp_contacts_meta`
--
ALTER TABLE `ori_cmp_contacts_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_cmp_contacts_meta_field_id_foreign` (`field_id`),
  ADD KEY `ori_cmp_contacts_meta_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_cmp_contacts_meta_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `ori_cmp_reg_payments`
--
ALTER TABLE `ori_cmp_reg_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_cmp_reg_payments_plan_id_foreign` (`plan_id`),
  ADD KEY `ori_cmp_reg_payments_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_cmp_reg_payments_log`
--
ALTER TABLE `ori_cmp_reg_payments_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_cmp_reg_payments_log_plan_id_foreign` (`plan_id`),
  ADD KEY `ori_cmp_reg_payments_log_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_common_sms_email`
--
ALTER TABLE `ori_common_sms_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_common_sms_email_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_common_sms_email_group_id_foreign` (`group_id`),
  ADD KEY `ori_common_sms_email_survey_id_foreign` (`survey_id`);

--
-- Indexes for table `ori_company_channels`
--
ALTER TABLE `ori_company_channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_questions_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_company_channels_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `ori_company_channel_gateway`
--
ALTER TABLE `ori_company_channel_gateway`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmpny_id` (`cmpny_id`),
  ADD KEY `channel_id` (`gateway_id`);

--
-- Indexes for table `ori_company_meta`
--
ALTER TABLE `ori_company_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_company_meta_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_company_profiles`
--
ALTER TABLE `ori_company_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_company_profiles_ori_cmp_org_plan_foreign` (`ori_cmp_org_plan`);

--
-- Indexes for table `ori_company_subscriptions`
--
ALTER TABLE `ori_company_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_company_subscriptions_plan_id_foreign` (`plan_id`),
  ADD KEY `ori_company_subscriptions_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_countries`
--
ALTER TABLE `ori_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_country_ph_code`
--
ALTER TABLE `ori_country_ph_code`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `ori_cron_logs`
--
ALTER TABLE `ori_cron_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmpny_id` (`cmpny_id`);

--
-- Indexes for table `ori_customer_fcms`
--
ALTER TABLE `ori_customer_fcms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_fcms_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_customer_fcms_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `ori_customer_profiles`
--
ALTER TABLE `ori_customer_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_profiles_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_customer_profiles_country_id_foreign` (`country_id`),
  ADD KEY `ori_customer_profiles_state_id_foreign` (`state_id`),
  ADD KEY `ori_customer_profiles_district_id_foreign` (`district_id`),
  ADD KEY `ori_customer_profiles_local_body_type_foreign` (`local_body_type`),
  ADD KEY `ori_customer_profiles_muncipality_id_foreign` (`muncipality_id`),
  ADD KEY `ori_customer_profiles_corporation_id_foreign` (`corporation_id`),
  ADD KEY `ori_customer_profiles_district_panchayath_id_foreign` (`district_panchayath_id`),
  ADD KEY `ori_customer_profiles_block_panchayath_id_foreign` (`block_panchayath_id`),
  ADD KEY `ori_customer_profiles_grama_panchayath_id_foreign` (`grama_panchayath_id`),
  ADD KEY `ori_customer_profiles_panchayath_id_foreign` (`panchayath_id`);

--
-- Indexes for table `ori_customer_profile_fields`
--
ALTER TABLE `ori_customer_profile_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_profile_fields_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_customer_profile_fields_field_id_foreign` (`field_id`),
  ADD KEY `ori_customer_profile_fields_tab_id_foreign` (`tab_id`),
  ADD KEY `ori_customer_profile_fields_field_type_foreign` (`field_type`);

--
-- Indexes for table `ori_customer_profile_log`
--
ALTER TABLE `ori_customer_profile_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_profile_log_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_customer_profile_log_user_id_foreign` (`user_id`),
  ADD KEY `ori_customer_profile_log_country_id_foreign` (`country_id`),
  ADD KEY `ori_customer_profile_log_state_id_foreign` (`state_id`),
  ADD KEY `ori_customer_profile_log_district_id_foreign` (`district_id`),
  ADD KEY `ori_customer_profile_log_local_body_type_foreign` (`local_body_type`),
  ADD KEY `ori_customer_profile_log_muncipality_id_foreign` (`muncipality_id`),
  ADD KEY `ori_customer_profile_log_corporation_id_foreign` (`corporation_id`),
  ADD KEY `ori_customer_profile_log_district_panchayath_id_foreign` (`district_panchayath_id`),
  ADD KEY `ori_customer_profile_log_block_panchayath_id_foreign` (`block_panchayath_id`),
  ADD KEY `ori_customer_profile_log_grama_panchayath_id_foreign` (`grama_panchayath_id`),
  ADD KEY `ori_customer_profile_log_panchayath_id_foreign` (`panchayath_id`);

--
-- Indexes for table `ori_customer_profile_meta`
--
ALTER TABLE `ori_customer_profile_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_profile_meta_user_id_foreign` (`user_id`),
  ADD KEY `ori_customer_profile_meta_field_id_foreign` (`field_id`),
  ADD KEY `ori_customer_profile_meta_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_customer_profile_meta_tab_id_foreign` (`tab_id`);

--
-- Indexes for table `ori_customer_profile_meta_log`
--
ALTER TABLE `ori_customer_profile_meta_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_profile_meta_log_user_id_foreign` (`user_id`),
  ADD KEY `ori_customer_profile_meta_log_field_id_foreign` (`field_id`),
  ADD KEY `ori_customer_profile_meta_log_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_customer_profile_meta_log_profile_meta_id_foreign` (`profile_meta_id`);

--
-- Indexes for table `ori_default_profile_fields`
--
ALTER TABLE `ori_default_profile_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_district`
--
ALTER TABLE `ori_district`
  ADD PRIMARY KEY (`country_code`,`state_code`,`district_code`);

--
-- Indexes for table `ori_emailfetch_company`
--
ALTER TABLE `ori_emailfetch_company`
  ADD KEY `ori_emailfetch_company_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_email_fetchs`
--
ALTER TABLE `ori_email_fetchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_email_fetchs_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_email_fetchs_attachments`
--
ALTER TABLE `ori_email_fetchs_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachment_id` (`attachment_id`),
  ADD KEY `ori_email_fetchs_attachments_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_faqs`
--
ALTER TABLE `ori_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `query_type_id` (`query_type_id`),
  ADD KEY `faq_cat_id` (`faq_cat_id`),
  ADD KEY `ori_faqs_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_fb_details`
--
ALTER TABLE `ori_fb_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_fb_details_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_fb_details_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_fb_details_fb_type_foreign` (`fb_type`),
  ADD KEY `ori_fb_details_reference_id_foreign` (`reference_id`),
  ADD KEY `ori_fb_details_thread_id_foreign` (`thread_id`);

--
-- Indexes for table `ori_fb_details_log`
--
ALTER TABLE `ori_fb_details_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_fb_details_log_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_fb_details_log_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_fb_details_log_fb_type_foreign` (`fb_type`),
  ADD KEY `ori_fb_details_log_fb_det_id_foreign` (`fb_det_id`),
  ADD KEY `ori_fb_details_log_reference_id_foreign` (`reference_id`),
  ADD KEY `ori_fb_details_log_thread_id_foreign` (`thread_id`);

--
-- Indexes for table `ori_fb_feedback_request`
--
ALTER TABLE `ori_fb_feedback_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_fb_feedback_request_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_fb_feedback_request_fb_type_foreign` (`fb_type`),
  ADD KEY `ori_fb_feedback_request_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_fb_feedback_request_helpdesk_id_foreign` (`helpdesk_id`),
  ADD KEY `ori_fb_feedback_request_common_id_foreign` (`common_id`);

--
-- Indexes for table `ori_fb_questions`
--
ALTER TABLE `ori_fb_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_id_2` (`feedback_id`),
  ADD KEY `eng_qstn_id` (`eng_qstn_id`),
  ADD KEY `mal_qstn_id` (`mal_qstn_id`),
  ADD KEY `ori_fb_questions_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_fb_question_details`
--
ALTER TABLE `ori_fb_question_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_fb_question_details_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_fb_question_details_fb_det_id_foreign` (`fb_det_id`),
  ADD KEY `ori_fb_question_details_question_id_foreign` (`question_id`);

--
-- Indexes for table `ori_fb_question_details_log`
--
ALTER TABLE `ori_fb_question_details_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_fb_question_details_log_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_fb_question_details_log_fb_det_id_foreign` (`fb_det_id`),
  ADD KEY `ori_fb_question_details_log_question_id_foreign` (`question_id`),
  ADD KEY `ori_fb_question_details_log_fb_question_id_foreign` (`fb_question_id`);

--
-- Indexes for table `ori_fb_settings`
--
ALTER TABLE `ori_fb_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_fb_settings_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_field_types`
--
ALTER TABLE `ori_field_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_groups`
--
ALTER TABLE `ori_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_groups_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_groups_created_by_foreign` (`created_by`);

--
-- Indexes for table `ori_group_contacts`
--
ALTER TABLE `ori_group_contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ori_group_contacts_contact_id_group_id_deleted_at_unique` (`contact_id`,`group_id`,`deleted_at`),
  ADD UNIQUE KEY `contact_group_unique` (`contact_id`,`group_id`,`deleted_at`),
  ADD KEY `ori_group_contacts_group_id_foreign` (`group_id`),
  ADD KEY `ori_group_contacts_created_by_foreign` (`created_by`),
  ADD KEY `ori_group_contacts_updated_by_foreign` (`updated_by`),
  ADD KEY `ori_group_contacts_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_group_excel_import_batches`
--
ALTER TABLE `ori_group_excel_import_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_group_excel_import_batches_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_group_excel_import_batches_group_id_foreign` (`group_id`),
  ADD KEY `ori_group_excel_import_batches_lead_source_foreign` (`lead_source`),
  ADD KEY `ori_group_excel_import_batches_created_by_foreign` (`created_by`),
  ADD KEY `ori_group_excel_import_batches_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `ori_group_excel_import_failed_rows`
--
ALTER TABLE `ori_group_excel_import_failed_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_group_excel_import_failed_rows_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_group_excel_import_failed_rows_batch_process_id_foreign` (`batch_process_id`);

--
-- Indexes for table `ori_helpdesk`
--
ALTER TABLE `ori_helpdesk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_helpdesk_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_helpdesk_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_helpdesk_query_type_foreign` (`query_type`),
  ADD KEY `ori_helpdesk_query_category_foreign` (`query_category`),
  ADD KEY `ori_helpdesk_sub_query_category_foreign` (`sub_query_category`),
  ADD KEY `ori_helpdesk_customer_nature_foreign` (`customer_nature`),
  ADD KEY `ori_helpdesk_priority_foreign` (`priority`),
  ADD KEY `ori_helpdesk_lead_source_id_foreign` (`lead_source_id`),
  ADD KEY `ori_helpdesk_escalate_foreign` (`escalate`),
  ADD KEY `ori_helpdesk_feedback_id_foreign` (`feedback_id`),
  ADD KEY `ori_helpdesk_query_status_foreign` (`id`);

--
-- Indexes for table `ori_helpdesk_log`
--
ALTER TABLE `ori_helpdesk_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_helpdesk_log_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_helpdesk_log_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_helpdesk_log_query_type_foreign` (`query_type`),
  ADD KEY `ori_helpdesk_log_query_category_foreign` (`query_category`),
  ADD KEY `ori_helpdesk_log_sub_query_category_foreign` (`sub_query_category`),
  ADD KEY `ori_helpdesk_log_customer_nature_foreign` (`customer_nature`),
  ADD KEY `ori_helpdesk_log_priority_foreign` (`priority`),
  ADD KEY `ori_helpdesk_log_lead_source_id_foreign` (`lead_source_id`),
  ADD KEY `ori_helpdesk_log_query_status_foreign` (`query_status`),
  ADD KEY `ori_helpdesk_log_escalate_foreign` (`escalate`),
  ADD KEY `ori_helpdesk_log_feedback_id_foreign` (`feedback_id`);

--
-- Indexes for table `ori_intimations`
--
ALTER TABLE `ori_intimations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_intimations_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_intimations_user_id_foreign` (`user_id`);

--
-- Indexes for table `ori_lead_followups`
--
ALTER TABLE `ori_lead_followups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_lead_followups_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_lead_followups_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_lead_followups_query_type_foreign` (`query_type`),
  ADD KEY `ori_lead_followups_query_category_foreign` (`query_category`),
  ADD KEY `ori_lead_followups_sub_query_category_foreign` (`sub_query_category`),
  ADD KEY `ori_lead_followups_customer_nature_foreign` (`customer_nature`),
  ADD KEY `ori_lead_followups_priority_foreign` (`priority`),
  ADD KEY `ori_lead_followups_lead_source_id_foreign` (`lead_source_id`),
  ADD KEY `ori_lead_followups_query_status_foreign` (`query_status`),
  ADD KEY `ori_lead_followups_escalate_foreign` (`escalate`);

--
-- Indexes for table `ori_lead_followups_log`
--
ALTER TABLE `ori_lead_followups_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_lead_followups_log_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_lead_followups_log_customer_id_foreign` (`customer_id`),
  ADD KEY `ori_lead_followups_log_query_type_foreign` (`query_type`),
  ADD KEY `ori_lead_followups_log_query_category_foreign` (`query_category`),
  ADD KEY `ori_lead_followups_log_sub_query_category_foreign` (`sub_query_category`),
  ADD KEY `ori_lead_followups_log_customer_nature_foreign` (`customer_nature`),
  ADD KEY `ori_lead_followups_log_priority_foreign` (`priority`),
  ADD KEY `ori_lead_followups_log_lead_source_id_foreign` (`lead_source_id`),
  ADD KEY `ori_lead_followups_log_query_status_foreign` (`query_status`),
  ADD KEY `ori_lead_followups_log_escalate_foreign` (`escalate`);

--
-- Indexes for table `ori_localbody`
--
ALTER TABLE `ori_localbody`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_localbodytype`
--
ALTER TABLE `ori_localbodytype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_location_settings`
--
ALTER TABLE `ori_location_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_mast_coupon_codes`
--
ALTER TABLE `ori_mast_coupon_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_coupon_codes_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `ori_mast_customer_nature`
--
ALTER TABLE `ori_mast_customer_nature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_customer_nature_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_designations`
--
ALTER TABLE `ori_mast_designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_designations_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_faq_categories`
--
ALTER TABLE `ori_mast_faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_faq_categories_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_lead_sources`
--
ALTER TABLE `ori_mast_lead_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_lead_sources_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_mast_lead_sources_lead_source_type_id_foreign` (`lead_source_type_id`);

--
-- Indexes for table `ori_mast_lead_source_type`
--
ALTER TABLE `ori_mast_lead_source_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_lead_source_type_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_package`
--
ALTER TABLE `ori_mast_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_package_package_type_foreign` (`package_type`);

--
-- Indexes for table `ori_mast_plans`
--
ALTER TABLE `ori_mast_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_mast_plans_duration`
--
ALTER TABLE `ori_mast_plans_duration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `ori_mast_priority`
--
ALTER TABLE `ori_mast_priority`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_priority_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_query_category_relation`
--
ALTER TABLE `ori_mast_query_category_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_query_category_relation_query_type_id_foreign` (`query_type_id`),
  ADD KEY `ori_mast_query_category_relation_category_id_foreign` (`category_id`),
  ADD KEY `ori_mast_query_category_relation_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_query_designation_relation`
--
ALTER TABLE `ori_mast_query_designation_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_query_designation_relation_query_type_id_foreign` (`query_type_id`),
  ADD KEY `ori_mast_query_designation_relation_designation_id_foreign` (`designation_id`),
  ADD KEY `ori_mast_query_designation_relation_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_query_status`
--
ALTER TABLE `ori_mast_query_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_query_status_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_query_status_relation`
--
ALTER TABLE `ori_mast_query_status_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_query_status_relation_query_type_id_foreign` (`query_type_id`),
  ADD KEY `ori_mast_query_status_relation_query_status_id_foreign` (`query_status_id`),
  ADD KEY `ori_mast_query_status_relation_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_query_type`
--
ALTER TABLE `ori_mast_query_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_query_type_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_mast_templates`
--
ALTER TABLE `ori_mast_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_mast_templates_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_notifications_list`
--
ALTER TABLE `ori_notifications_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_notifications_list_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_notifications_roles_relations`
--
ALTER TABLE `ori_notifications_roles_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_notifications_roles_relations_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_notifications_roles_relations_user_id_foreign` (`user_id`),
  ADD KEY `ori_notifications_roles_relations_notification_id_foreign` (`notification_id`);

--
-- Indexes for table `ori_password_histories`
--
ALTER TABLE `ori_password_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_password_histories_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_password_resets`
--
ALTER TABLE `ori_password_resets`
  ADD KEY `ori_password_resets_email_index` (`email`),
  ADD KEY `ori_password_resets_token_index` (`token`);

--
-- Indexes for table `ori_password_securities`
--
ALTER TABLE `ori_password_securities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_password_securities_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_permissions`
--
ALTER TABLE `ori_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ori_questions`
--
ALTER TABLE `ori_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_questions_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_roles`
--
ALTER TABLE `ori_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_roles_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_sendgrid_response`
--
ALTER TABLE `ori_sendgrid_response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail_ref_id` (`mail_ref_id`);

--
-- Indexes for table `ori_state`
--
ALTER TABLE `ori_state`
  ADD PRIMARY KEY (`country_code`,`state_code`);

--
-- Indexes for table `ori_survey_details`
--
ALTER TABLE `ori_survey_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmpny_id` (`cmpny_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `contact_id` (`contact_id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `common_id` (`common_id`);

--
-- Indexes for table `ori_survey_question_details`
--
ALTER TABLE `ori_survey_question_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_det_id` (`survey_det_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `ori_survey_question_details_relation_id_foreign` (`relation_id`);

--
-- Indexes for table `ori_survey_question_settings`
--
ALTER TABLE `ori_survey_question_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmpny_id` (`cmpny_id`),
  ADD KEY `ori_survey_question_settings_ibfk_1` (`survey_id`),
  ADD KEY `eng_qstn_id` (`qstn_id_lang1`),
  ADD KEY `mal_qstn_id` (`qstn_id_lang2`);

--
-- Indexes for table `ori_survey_settings`
--
ALTER TABLE `ori_survey_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmpny_id` (`cmpny_id`);

--
-- Indexes for table `ori_tabs`
--
ALTER TABLE `ori_tabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_customer_profiles_cmpny_id_foreign` (`cmpny_id`);

--
-- Indexes for table `ori_users`
--
ALTER TABLE `ori_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ori_users_email_unique` (`email`),
  ADD UNIQUE KEY `ori_users_username_unique` (`username`),
  ADD KEY `ori_users_cmpny_id_foreign` (`cmpny_id`),
  ADD KEY `ori_users_country_id_foreign` (`country_id`),
  ADD KEY `ori_users_state_id_foreign` (`state_id`),
  ADD KEY `ori_users_district_id_foreign` (`district_id`),
  ADD KEY `ori_users_local_body_type_foreign` (`local_body_type`),
  ADD KEY `ori_users_muncipality_id_foreign` (`muncipality_id`),
  ADD KEY `ori_users_corporation_id_foreign` (`corporation_id`),
  ADD KEY `ori_users_district_panchayath_id_foreign` (`district_panchayath_id`),
  ADD KEY `ori_users_block_panchayath_id_foreign` (`block_panchayath_id`),
  ADD KEY `ori_users_grama_panchayath_id_foreign` (`grama_panchayath_id`),
  ADD KEY `ori_users_panchayath_id_foreign` (`panchayath_id`),
  ADD KEY `ori_users_department_foreign` (`department`),
  ADD KEY `ori_users_designation_foreign` (`designation`);

--
-- Indexes for table `ori_user_logs`
--
ALTER TABLE `ori_user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ori_user_logs_cmpny_id_foreign` (`cmpny_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `ori_api_call_logs`
--
ALTER TABLE `ori_api_call_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_attachments`
--
ALTER TABLE `ori_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_autodial_schedules`
--
ALTER TABLE `ori_autodial_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ori_automated_process`
--
ALTER TABLE `ori_automated_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ori_automated_process_batch`
--
ALTER TABLE `ori_automated_process_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_automated_process_batch_expiry`
--
ALTER TABLE `ori_automated_process_batch_expiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_automated_process_log`
--
ALTER TABLE `ori_automated_process_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_automated_process_relations`
--
ALTER TABLE `ori_automated_process_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_automated_process_stages`
--
ALTER TABLE `ori_automated_process_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_auto_reply`
--
ALTER TABLE `ori_auto_reply`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_auto_reply_category`
--
ALTER TABLE `ori_auto_reply_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_basic_templates`
--
ALTER TABLE `ori_basic_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ori_batch_process`
--
ALTER TABLE `ori_batch_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ori_campaigns`
--
ALTER TABLE `ori_campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_campaigns_meta`
--
ALTER TABLE `ori_campaigns_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_campaign_batches`
--
ALTER TABLE `ori_campaign_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_campaign_batch_groups`
--
ALTER TABLE `ori_campaign_batch_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_campaign_groups`
--
ALTER TABLE `ori_campaign_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_campaign_query_status`
--
ALTER TABLE `ori_campaign_query_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_channels`
--
ALTER TABLE `ori_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ori_channel_gateway`
--
ALTER TABLE `ori_channel_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ori_chat_feedback_count`
--
ALTER TABLE `ori_chat_feedback_count`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_chat_thread`
--
ALTER TABLE `ori_chat_thread`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_chat_thread_logs`
--
ALTER TABLE `ori_chat_thread_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_cmp_contacts`
--
ALTER TABLE `ori_cmp_contacts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_cmp_contacts_meta`
--
ALTER TABLE `ori_cmp_contacts_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_cmp_reg_payments`
--
ALTER TABLE `ori_cmp_reg_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ori_cmp_reg_payments_log`
--
ALTER TABLE `ori_cmp_reg_payments_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_common_sms_email`
--
ALTER TABLE `ori_common_sms_email`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_company_channels`
--
ALTER TABLE `ori_company_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_company_channel_gateway`
--
ALTER TABLE `ori_company_channel_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_company_meta`
--
ALTER TABLE `ori_company_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `ori_company_profiles`
--
ALTER TABLE `ori_company_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_company_subscriptions`
--
ALTER TABLE `ori_company_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ori_countries`
--
ALTER TABLE `ori_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ori_cron_logs`
--
ALTER TABLE `ori_cron_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_customer_fcms`
--
ALTER TABLE `ori_customer_fcms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_customer_profiles`
--
ALTER TABLE `ori_customer_profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_customer_profile_fields`
--
ALTER TABLE `ori_customer_profile_fields`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ori_customer_profile_log`
--
ALTER TABLE `ori_customer_profile_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ori_customer_profile_meta`
--
ALTER TABLE `ori_customer_profile_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ori_customer_profile_meta_log`
--
ALTER TABLE `ori_customer_profile_meta_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_default_profile_fields`
--
ALTER TABLE `ori_default_profile_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ori_email_fetchs`
--
ALTER TABLE `ori_email_fetchs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `ori_email_fetchs_attachments`
--
ALTER TABLE `ori_email_fetchs_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ori_faqs`
--
ALTER TABLE `ori_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ori_fb_details`
--
ALTER TABLE `ori_fb_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_fb_details_log`
--
ALTER TABLE `ori_fb_details_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_fb_feedback_request`
--
ALTER TABLE `ori_fb_feedback_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_fb_questions`
--
ALTER TABLE `ori_fb_questions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_fb_question_details`
--
ALTER TABLE `ori_fb_question_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_fb_question_details_log`
--
ALTER TABLE `ori_fb_question_details_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_fb_settings`
--
ALTER TABLE `ori_fb_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_field_types`
--
ALTER TABLE `ori_field_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ori_groups`
--
ALTER TABLE `ori_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ori_group_contacts`
--
ALTER TABLE `ori_group_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ori_group_excel_import_batches`
--
ALTER TABLE `ori_group_excel_import_batches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_group_excel_import_failed_rows`
--
ALTER TABLE `ori_group_excel_import_failed_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_helpdesk`
--
ALTER TABLE `ori_helpdesk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ori_helpdesk_log`
--
ALTER TABLE `ori_helpdesk_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
--
-- AUTO_INCREMENT for table `ori_intimations`
--
ALTER TABLE `ori_intimations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ori_lead_followups`
--
ALTER TABLE `ori_lead_followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ori_lead_followups_log`
--
ALTER TABLE `ori_lead_followups_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_localbody`
--
ALTER TABLE `ori_localbody`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1193;
--
-- AUTO_INCREMENT for table `ori_localbodytype`
--
ALTER TABLE `ori_localbodytype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ori_location_settings`
--
ALTER TABLE `ori_location_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ori_mast_coupon_codes`
--
ALTER TABLE `ori_mast_coupon_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ori_mast_customer_nature`
--
ALTER TABLE `ori_mast_customer_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ori_mast_designations`
--
ALTER TABLE `ori_mast_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_mast_faq_categories`
--
ALTER TABLE `ori_mast_faq_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ori_mast_lead_sources`
--
ALTER TABLE `ori_mast_lead_sources`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ori_mast_lead_source_type`
--
ALTER TABLE `ori_mast_lead_source_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ori_mast_package`
--
ALTER TABLE `ori_mast_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `ori_mast_plans`
--
ALTER TABLE `ori_mast_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ori_mast_plans_duration`
--
ALTER TABLE `ori_mast_plans_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `ori_mast_priority`
--
ALTER TABLE `ori_mast_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ori_mast_query_category_relation`
--
ALTER TABLE `ori_mast_query_category_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ori_mast_query_designation_relation`
--
ALTER TABLE `ori_mast_query_designation_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_mast_query_status`
--
ALTER TABLE `ori_mast_query_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ori_mast_query_status_relation`
--
ALTER TABLE `ori_mast_query_status_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ori_mast_query_type`
--
ALTER TABLE `ori_mast_query_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ori_mast_templates`
--
ALTER TABLE `ori_mast_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_notifications_list`
--
ALTER TABLE `ori_notifications_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ori_notifications_roles_relations`
--
ALTER TABLE `ori_notifications_roles_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ori_password_histories`
--
ALTER TABLE `ori_password_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_password_securities`
--
ALTER TABLE `ori_password_securities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_permissions`
--
ALTER TABLE `ori_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `ori_questions`
--
ALTER TABLE `ori_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ori_roles`
--
ALTER TABLE `ori_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ori_sendgrid_response`
--
ALTER TABLE `ori_sendgrid_response`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_survey_details`
--
ALTER TABLE `ori_survey_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_survey_question_details`
--
ALTER TABLE `ori_survey_question_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_survey_question_settings`
--
ALTER TABLE `ori_survey_question_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_survey_settings`
--
ALTER TABLE `ori_survey_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ori_tabs`
--
ALTER TABLE `ori_tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ori_users`
--
ALTER TABLE `ori_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ori_user_logs`
--
ALTER TABLE `ori_user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ori_attachments`
--
ALTER TABLE `ori_attachments`
  ADD CONSTRAINT `ori_attachments_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_attachments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_attachments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_autodial_schedules`
--
ALTER TABLE `ori_autodial_schedules`
  ADD CONSTRAINT `ori_autodial_schedules_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_auto_reply`
--
ALTER TABLE `ori_auto_reply`
  ADD CONSTRAINT `ori_auto_reply_auto_reply_category_id_foreign` FOREIGN KEY (`auto_reply_category_id`) REFERENCES `ori_auto_reply_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_auto_reply_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_auto_reply_category`
--
ALTER TABLE `ori_auto_reply_category`
  ADD CONSTRAINT `ori_auto_reply_category_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_batch_process`
--
ALTER TABLE `ori_batch_process`
  ADD CONSTRAINT `ori_batch_process_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `ori_campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_batch_process_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_batch_process_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_batch_process_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `ori_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_batch_process_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_campaigns`
--
ALTER TABLE `ori_campaigns`
  ADD CONSTRAINT `ori_campaigns_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_campaigns_meta`
--
ALTER TABLE `ori_campaigns_meta`
  ADD CONSTRAINT `ori_campaigns_meta_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `ori_campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_meta_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_meta_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_meta_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_meta_source_type_foreign` FOREIGN KEY (`source_type`) REFERENCES `ori_mast_lead_source_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaigns_meta_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_campaign_batches`
--
ALTER TABLE `ori_campaign_batches`
  ADD CONSTRAINT `ori_campaign_batches_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `ori_campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batches_channel_type_foreign` FOREIGN KEY (`channel_type`) REFERENCES `ori_channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batches_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batches_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batches_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `ori_survey_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batches_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_campaign_batch_groups`
--
ALTER TABLE `ori_campaign_batch_groups`
  ADD CONSTRAINT `ori_campaign_batch_groups_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `ori_campaign_batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batch_groups_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batch_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_batch_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `ori_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_campaign_groups`
--
ALTER TABLE `ori_campaign_groups`
  ADD CONSTRAINT `ori_campaign_groups_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `ori_campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_groups_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `ori_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_groups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_campaign_query_status`
--
ALTER TABLE `ori_campaign_query_status`
  ADD CONSTRAINT `ori_campaign_query_status_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `ori_campaign_batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_query_status_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `ori_campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_query_status_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_query_status_query_status_foreign` FOREIGN KEY (`query_status`) REFERENCES `ori_mast_query_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_campaign_query_status_query_type_foreign` FOREIGN KEY (`query_type`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_channel_gateway`
--
ALTER TABLE `ori_channel_gateway`
  ADD CONSTRAINT `channel_id` FOREIGN KEY (`channel_id`) REFERENCES `ori_channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_chat_feedback_count`
--
ALTER TABLE `ori_chat_feedback_count`
  ADD CONSTRAINT `ori_chat_feedback_count_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_chat_thread`
--
ALTER TABLE `ori_chat_thread`
  ADD CONSTRAINT `ori_chat_thread_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_chat_thread_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_chat_thread_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_chat_thread_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_cmp_contacts`
--
ALTER TABLE `ori_cmp_contacts`
  ADD CONSTRAINT `ori_cmp_contacts_block_panchayath_id_foreign` FOREIGN KEY (`block_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_corporation_id_foreign` FOREIGN KEY (`corporation_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_district_panchayath_id_foreign` FOREIGN KEY (`district_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_grama_panchayath_id_foreign` FOREIGN KEY (`grama_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_local_body_type_foreign` FOREIGN KEY (`local_body_type`) REFERENCES `ori_localbodytype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_muncipality_id_foreign` FOREIGN KEY (`muncipality_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_panchayath_id_foreign` FOREIGN KEY (`panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_cmp_contacts_meta`
--
ALTER TABLE `ori_cmp_contacts_meta`
  ADD CONSTRAINT `ori_cmp_contacts_meta_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_meta_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `ori_cmp_contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_contacts_meta_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `ori_customer_profile_fields` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_cmp_reg_payments`
--
ALTER TABLE `ori_cmp_reg_payments`
  ADD CONSTRAINT `ori_cmp_reg_payments_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_reg_payments_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_cmp_reg_payments_log`
--
ALTER TABLE `ori_cmp_reg_payments_log`
  ADD CONSTRAINT `ori_cmp_reg_payments_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_cmp_reg_payments_log_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_common_sms_email`
--
ALTER TABLE `ori_common_sms_email`
  ADD CONSTRAINT `ori_common_sms_email_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_common_sms_email_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `ori_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_common_sms_email_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `ori_survey_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_company_channels`
--
ALTER TABLE `ori_company_channels`
  ADD CONSTRAINT `ori_company_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `ori_channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_company_channels_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_company_channel_gateway`
--
ALTER TABLE `ori_company_channel_gateway`
  ADD CONSTRAINT `cmpny_id` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gateway_id` FOREIGN KEY (`gateway_id`) REFERENCES `ori_channel_gateway` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_company_meta`
--
ALTER TABLE `ori_company_meta`
  ADD CONSTRAINT `ori_company_meta_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_company_profiles`
--
ALTER TABLE `ori_company_profiles`
  ADD CONSTRAINT `ori_company_profiles_ori_cmp_org_plan_foreign` FOREIGN KEY (`ori_cmp_org_plan`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_company_subscriptions`
--
ALTER TABLE `ori_company_subscriptions`
  ADD CONSTRAINT `ori_company_subscriptions_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_company_subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_cron_logs`
--
ALTER TABLE `ori_cron_logs`
  ADD CONSTRAINT `ori_cron_logs_ibfk_1` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`);

--
-- Constraints for table `ori_customer_fcms`
--
ALTER TABLE `ori_customer_fcms`
  ADD CONSTRAINT `ori_customer_fcms_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_fcms_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_customer_profiles`
--
ALTER TABLE `ori_customer_profiles`
  ADD CONSTRAINT `ori_customer_profiles_block_panchayath_id_foreign` FOREIGN KEY (`block_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_corporation_id_foreign` FOREIGN KEY (`corporation_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_district_panchayath_id_foreign` FOREIGN KEY (`district_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_grama_panchayath_id_foreign` FOREIGN KEY (`grama_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_local_body_type_foreign` FOREIGN KEY (`local_body_type`) REFERENCES `ori_localbodytype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_muncipality_id_foreign` FOREIGN KEY (`muncipality_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_panchayath_id_foreign` FOREIGN KEY (`panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profiles_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_customer_profile_fields`
--
ALTER TABLE `ori_customer_profile_fields`
  ADD CONSTRAINT `ori_customer_profile_fields_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_fields_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `ori_default_profile_fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_fields_field_type_foreign` FOREIGN KEY (`field_type`) REFERENCES `ori_field_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_fields_tab_id_foreign` FOREIGN KEY (`tab_id`) REFERENCES `ori_tabs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_customer_profile_log`
--
ALTER TABLE `ori_customer_profile_log`
  ADD CONSTRAINT `ori_customer_profile_log_block_panchayath_id_foreign` FOREIGN KEY (`block_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_corporation_id_foreign` FOREIGN KEY (`corporation_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_district_panchayath_id_foreign` FOREIGN KEY (`district_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_grama_panchayath_id_foreign` FOREIGN KEY (`grama_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_local_body_type_foreign` FOREIGN KEY (`local_body_type`) REFERENCES `ori_localbodytype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_muncipality_id_foreign` FOREIGN KEY (`muncipality_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_panchayath_id_foreign` FOREIGN KEY (`panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_customer_profile_meta`
--
ALTER TABLE `ori_customer_profile_meta`
  ADD CONSTRAINT `ori_customer_profile_meta_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_meta_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `ori_customer_profile_fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_meta_tab_id_foreign` FOREIGN KEY (`tab_id`) REFERENCES `ori_tabs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_meta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_customer_profile_meta_log`
--
ALTER TABLE `ori_customer_profile_meta_log`
  ADD CONSTRAINT `ori_customer_profile_meta_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_meta_log_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `ori_customer_profile_fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_meta_log_profile_meta_id_foreign` FOREIGN KEY (`profile_meta_id`) REFERENCES `ori_customer_profile_meta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_customer_profile_meta_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_emailfetch_company`
--
ALTER TABLE `ori_emailfetch_company`
  ADD CONSTRAINT `ori_emailfetch_company_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_email_fetchs`
--
ALTER TABLE `ori_email_fetchs`
  ADD CONSTRAINT `ori_email_fetchs_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_email_fetchs_attachments`
--
ALTER TABLE `ori_email_fetchs_attachments`
  ADD CONSTRAINT `ori_email_fetchs_attachments_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `ori_email_fetchs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_email_fetchs_attachments_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_faqs`
--
ALTER TABLE `ori_faqs`
  ADD CONSTRAINT `ori_faqs_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_faqs_faq_cat_id_foreign` FOREIGN KEY (`faq_cat_id`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_faqs_query_type_id_foreign` FOREIGN KEY (`query_type_id`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_fb_details`
--
ALTER TABLE `ori_fb_details`
  ADD CONSTRAINT `ori_fb_details_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_fb_type_foreign` FOREIGN KEY (`fb_type`) REFERENCES `ori_channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `ori_helpdesk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `ori_chat_thread` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_fb_details_log`
--
ALTER TABLE `ori_fb_details_log`
  ADD CONSTRAINT `ori_fb_details_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_log_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_log_fb_det_id_foreign` FOREIGN KEY (`fb_det_id`) REFERENCES `ori_fb_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_log_fb_type_foreign` FOREIGN KEY (`fb_type`) REFERENCES `ori_channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_log_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `ori_helpdesk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_details_log_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `ori_chat_thread` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_fb_feedback_request`
--
ALTER TABLE `ori_fb_feedback_request`
  ADD CONSTRAINT `ori_fb_feedback_request_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_feedback_request_common_id_foreign` FOREIGN KEY (`common_id`) REFERENCES `ori_common_sms_email` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_feedback_request_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_feedback_request_fb_type_foreign` FOREIGN KEY (`fb_type`) REFERENCES `ori_channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_feedback_request_helpdesk_id_foreign` FOREIGN KEY (`helpdesk_id`) REFERENCES `ori_helpdesk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_fb_questions`
--
ALTER TABLE `ori_fb_questions`
  ADD CONSTRAINT `ori_fb_questions_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_questions_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `ori_fb_settings` (`id`),
  ADD CONSTRAINT `ori_fb_questions_ibfk_2` FOREIGN KEY (`eng_qstn_id`) REFERENCES `ori_questions` (`id`),
  ADD CONSTRAINT `ori_fb_questions_ibfk_3` FOREIGN KEY (`mal_qstn_id`) REFERENCES `ori_questions` (`id`);

--
-- Constraints for table `ori_fb_question_details`
--
ALTER TABLE `ori_fb_question_details`
  ADD CONSTRAINT `ori_fb_question_details_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_question_details_fb_det_id_foreign` FOREIGN KEY (`fb_det_id`) REFERENCES `ori_fb_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_question_details_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ori_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_fb_question_details_log`
--
ALTER TABLE `ori_fb_question_details_log`
  ADD CONSTRAINT `ori_fb_question_details_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_question_details_log_fb_det_id_foreign` FOREIGN KEY (`fb_det_id`) REFERENCES `ori_fb_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_question_details_log_fb_question_id_foreign` FOREIGN KEY (`fb_question_id`) REFERENCES `ori_fb_question_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_fb_question_details_log_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `ori_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_fb_settings`
--
ALTER TABLE `ori_fb_settings`
  ADD CONSTRAINT `ori_fb_settings_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_groups`
--
ALTER TABLE `ori_groups`
  ADD CONSTRAINT `ori_groups_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_group_contacts`
--
ALTER TABLE `ori_group_contacts`
  ADD CONSTRAINT `ori_group_contacts_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_contacts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `ori_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_contacts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_group_excel_import_batches`
--
ALTER TABLE `ori_group_excel_import_batches`
  ADD CONSTRAINT `ori_group_excel_import_batches_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_excel_import_batches_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_excel_import_batches_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `ori_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_excel_import_batches_lead_source_foreign` FOREIGN KEY (`lead_source`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_excel_import_batches_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_group_excel_import_failed_rows`
--
ALTER TABLE `ori_group_excel_import_failed_rows`
  ADD CONSTRAINT `ori_group_excel_import_failed_rows_batch_process_id_foreign` FOREIGN KEY (`batch_process_id`) REFERENCES `ori_group_excel_import_batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_group_excel_import_failed_rows_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_helpdesk`
--
ALTER TABLE `ori_helpdesk`
  ADD CONSTRAINT `ori_helpdesk_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_customer_nature_foreign` FOREIGN KEY (`customer_nature`) REFERENCES `ori_mast_customer_nature` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_escalate_foreign` FOREIGN KEY (`escalate`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_feedback_id_foreign` FOREIGN KEY (`feedback_id`) REFERENCES `ori_fb_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_priority_foreign` FOREIGN KEY (`priority`) REFERENCES `ori_mast_priority` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_query_category_foreign` FOREIGN KEY (`query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_query_type_foreign` FOREIGN KEY (`query_type`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_sub_query_category_foreign` FOREIGN KEY (`sub_query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_helpdesk_log`
--
ALTER TABLE `ori_helpdesk_log`
  ADD CONSTRAINT `ori_helpdesk_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_customer_nature_foreign` FOREIGN KEY (`customer_nature`) REFERENCES `ori_mast_customer_nature` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_escalate_foreign` FOREIGN KEY (`escalate`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_feedback_id_foreign` FOREIGN KEY (`feedback_id`) REFERENCES `ori_fb_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_priority_foreign` FOREIGN KEY (`priority`) REFERENCES `ori_mast_priority` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_query_category_foreign` FOREIGN KEY (`query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_query_status_foreign` FOREIGN KEY (`query_status`) REFERENCES `ori_mast_query_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_query_type_foreign` FOREIGN KEY (`query_type`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_helpdesk_log_sub_query_category_foreign` FOREIGN KEY (`sub_query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_intimations`
--
ALTER TABLE `ori_intimations`
  ADD CONSTRAINT `ori_intimations_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_intimations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_lead_followups`
--
ALTER TABLE `ori_lead_followups`
  ADD CONSTRAINT `ori_lead_followups_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_customer_nature_foreign` FOREIGN KEY (`customer_nature`) REFERENCES `ori_mast_customer_nature` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_escalate_foreign` FOREIGN KEY (`escalate`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_priority_foreign` FOREIGN KEY (`priority`) REFERENCES `ori_mast_priority` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_query_category_foreign` FOREIGN KEY (`query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_query_status_foreign` FOREIGN KEY (`query_status`) REFERENCES `ori_mast_query_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_query_type_foreign` FOREIGN KEY (`query_type`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_sub_query_category_foreign` FOREIGN KEY (`sub_query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_lead_followups_log`
--
ALTER TABLE `ori_lead_followups_log`
  ADD CONSTRAINT `ori_lead_followups_log_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_customer_nature_foreign` FOREIGN KEY (`customer_nature`) REFERENCES `ori_mast_customer_nature` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_escalate_foreign` FOREIGN KEY (`escalate`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `ori_mast_lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_priority_foreign` FOREIGN KEY (`priority`) REFERENCES `ori_mast_priority` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_query_category_foreign` FOREIGN KEY (`query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_query_status_foreign` FOREIGN KEY (`query_status`) REFERENCES `ori_mast_query_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_query_type_foreign` FOREIGN KEY (`query_type`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_lead_followups_log_sub_query_category_foreign` FOREIGN KEY (`sub_query_category`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_coupon_codes`
--
ALTER TABLE `ori_mast_coupon_codes`
  ADD CONSTRAINT `ori_mast_coupon_codes_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_customer_nature`
--
ALTER TABLE `ori_mast_customer_nature`
  ADD CONSTRAINT `ori_mast_customer_nature_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_designations`
--
ALTER TABLE `ori_mast_designations`
  ADD CONSTRAINT `ori_mast_designations_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_faq_categories`
--
ALTER TABLE `ori_mast_faq_categories`
  ADD CONSTRAINT `ori_mast_faq_categories_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_lead_sources`
--
ALTER TABLE `ori_mast_lead_sources`
  ADD CONSTRAINT `ori_mast_lead_sources_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_lead_sources_lead_source_type_id_foreign` FOREIGN KEY (`lead_source_type_id`) REFERENCES `ori_mast_lead_source_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_lead_source_type`
--
ALTER TABLE `ori_mast_lead_source_type`
  ADD CONSTRAINT `ori_mast_lead_source_type_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_package`
--
ALTER TABLE `ori_mast_package`
  ADD CONSTRAINT `ori_mast_package_package_type_foreign` FOREIGN KEY (`package_type`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_plans_duration`
--
ALTER TABLE `ori_mast_plans_duration`
  ADD CONSTRAINT `ori_mast_plans_duration_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `ori_mast_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_priority`
--
ALTER TABLE `ori_mast_priority`
  ADD CONSTRAINT `ori_mast_priority_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_query_category_relation`
--
ALTER TABLE `ori_mast_query_category_relation`
  ADD CONSTRAINT `ori_mast_query_category_relation_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ori_mast_faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_query_category_relation_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_query_category_relation_query_type_id_foreign` FOREIGN KEY (`query_type_id`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_query_designation_relation`
--
ALTER TABLE `ori_mast_query_designation_relation`
  ADD CONSTRAINT `ori_mast_query_designation_relation_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_query_designation_relation_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `ori_mast_designations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_query_designation_relation_query_type_id_foreign` FOREIGN KEY (`query_type_id`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_query_status`
--
ALTER TABLE `ori_mast_query_status`
  ADD CONSTRAINT `ori_mast_query_status_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_query_status_relation`
--
ALTER TABLE `ori_mast_query_status_relation`
  ADD CONSTRAINT `ori_mast_query_status_relation_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_query_status_relation_query_status_id_foreign` FOREIGN KEY (`query_status_id`) REFERENCES `ori_mast_query_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_mast_query_status_relation_query_type_id_foreign` FOREIGN KEY (`query_type_id`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_query_type`
--
ALTER TABLE `ori_mast_query_type`
  ADD CONSTRAINT `ori_mast_query_type_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_mast_templates`
--
ALTER TABLE `ori_mast_templates`
  ADD CONSTRAINT `ori_mast_templates_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_notifications_list`
--
ALTER TABLE `ori_notifications_list`
  ADD CONSTRAINT `ori_notifications_list_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_notifications_roles_relations`
--
ALTER TABLE `ori_notifications_roles_relations`
  ADD CONSTRAINT `ori_notifications_roles_relations_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_notifications_roles_relations_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `ori_notifications_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_notifications_roles_relations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ori_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_password_histories`
--
ALTER TABLE `ori_password_histories`
  ADD CONSTRAINT `ori_password_histories_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_password_securities`
--
ALTER TABLE `ori_password_securities`
  ADD CONSTRAINT `ori_password_securities_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_questions`
--
ALTER TABLE `ori_questions`
  ADD CONSTRAINT `ori_questions_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_roles`
--
ALTER TABLE `ori_roles`
  ADD CONSTRAINT `ori_roles_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_survey_details`
--
ALTER TABLE `ori_survey_details`
  ADD CONSTRAINT `ori_survey_details_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `ori_survey_settings` (`id`),
  ADD CONSTRAINT `ori_survey_details_ibfk_2` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`),
  ADD CONSTRAINT `ori_survey_details_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `ori_customer_profiles` (`id`),
  ADD CONSTRAINT `ori_survey_details_ibfk_4` FOREIGN KEY (`common_id`) REFERENCES `ori_common_sms_email` (`id`),
  ADD CONSTRAINT `ori_survey_details_ibfk_5` FOREIGN KEY (`campaign_id`) REFERENCES `ori_campaigns` (`id`),
  ADD CONSTRAINT `ori_survey_details_ibfk_6` FOREIGN KEY (`contact_id`) REFERENCES `ori_cmp_contacts` (`id`),
  ADD CONSTRAINT `ori_survey_details_ibfk_7` FOREIGN KEY (`batch_id`) REFERENCES `ori_campaign_batches` (`id`);

--
-- Constraints for table `ori_survey_question_details`
--
ALTER TABLE `ori_survey_question_details`
  ADD CONSTRAINT `ori_survey_question_details_ibfk_1` FOREIGN KEY (`survey_det_id`) REFERENCES `ori_survey_details` (`id`),
  ADD CONSTRAINT `ori_survey_question_details_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `ori_questions` (`id`),
  ADD CONSTRAINT `ori_survey_question_details_relation_id_foreign` FOREIGN KEY (`relation_id`) REFERENCES `ori_survey_question_settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_survey_question_settings`
--
ALTER TABLE `ori_survey_question_settings`
  ADD CONSTRAINT `ori_survey_question_settings_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `ori_survey_settings` (`id`),
  ADD CONSTRAINT `ori_survey_question_settings_ibfk_2` FOREIGN KEY (`qstn_id_lang1`) REFERENCES `ori_questions` (`id`),
  ADD CONSTRAINT `ori_survey_question_settings_ibfk_3` FOREIGN KEY (`qstn_id_lang2`) REFERENCES `ori_questions` (`id`),
  ADD CONSTRAINT `ori_survey_question_settings_ibfk_4` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`);

--
-- Constraints for table `ori_survey_settings`
--
ALTER TABLE `ori_survey_settings`
  ADD CONSTRAINT `ori_survey_settings_ibfk_1` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`);

--
-- Constraints for table `ori_tabs`
--
ALTER TABLE `ori_tabs`
  ADD CONSTRAINT `ori_tabs_ibfk_1` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ori_users`
--
ALTER TABLE `ori_users`
  ADD CONSTRAINT `ori_users_block_panchayath_id_foreign` FOREIGN KEY (`block_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_corporation_id_foreign` FOREIGN KEY (`corporation_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_department_foreign` FOREIGN KEY (`department`) REFERENCES `ori_mast_query_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_designation_foreign` FOREIGN KEY (`designation`) REFERENCES `ori_mast_designations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_district_panchayath_id_foreign` FOREIGN KEY (`district_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_grama_panchayath_id_foreign` FOREIGN KEY (`grama_panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_local_body_type_foreign` FOREIGN KEY (`local_body_type`) REFERENCES `ori_localbodytype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_muncipality_id_foreign` FOREIGN KEY (`muncipality_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_panchayath_id_foreign` FOREIGN KEY (`panchayath_id`) REFERENCES `ori_localbody` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ori_users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `ori_location_settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ori_user_logs`
--
ALTER TABLE `ori_user_logs`
  ADD CONSTRAINT `ori_user_logs_cmpny_id_foreign` FOREIGN KEY (`cmpny_id`) REFERENCES `ori_company_profiles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
