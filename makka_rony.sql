-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 09:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makka`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` int(10) UNSIGNED NOT NULL,
  `en_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `en_name`, `ar_name`) VALUES
(1, 'Airline 1 En', 'Airline 1 Ar'),
(2, 'Airline 2 En', 'Airline 2 Ar');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int(11) UNSIGNED NOT NULL,
  `city` int(10) UNSIGNED NOT NULL,
  `en_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('source','destination') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `city`, `en_name`, `ar_name`, `type`, `created_at`) VALUES
(8, 1, 'Malisia Airport EN', 'Malisia Airport AR', 'source', 1654164614),
(9, 2, 'Ryadh AIRPORT EN', 'Ryadh AIRPORT AR', 'destination', 1654164643);

-- --------------------------------------------------------

--
-- Table structure for table `arrival_assesment`
--

CREATE TABLE `arrival_assesment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `flight_id` int(11) UNSIGNED NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_score` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arrival_assesment`
--

INSERT INTO `arrival_assesment` (`id`, `user_id`, `flight_id`, `lang`, `json`, `avg_score`, `created_at`) VALUES
(15, 14, 19, 'en', '{\"employment_interaction\":\"Satisfactory\",\"clarity_procedure\":\"Unsatisfactory\",\"service_provided\":\"Unsatisfactory\"}', 67, 1654168120),
(16, 1, 18, 'en', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\"}', 50, 1654520607),
(17, 1, 18, 'indo', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Yes\",\"service_provided\":\"Somewhat\"}', 67, 1654520620),
(18, 1, 18, 'indo', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\"}', 33, 1654520630),
(19, 1, 18, 'malay', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Yes\",\"service_provided\":\"Not\"}', 50, 1654520642),
(20, 1, 18, 'pak', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\"}', 50, 1654520661),
(21, 1, 18, 'pak', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\"}', 50, 1654520799),
(22, 1, 18, 'arb', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\"}', 50, 1654520808),
(23, 1, 18, 'bng', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\"}', 50, 1654520847);

-- --------------------------------------------------------

--
-- Table structure for table `arrival_form`
--

CREATE TABLE `arrival_form` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) UNSIGNED DEFAULT NULL,
  `json` longtext DEFAULT NULL,
  `passengers` varchar(255) NOT NULL,
  `average_waiting_to_sterile` int(11) NOT NULL,
  `average_waiting_inspection` int(11) NOT NULL,
  `average_luggage_arrive` int(11) NOT NULL,
  `average_bus_ride` int(11) NOT NULL,
  `duration_pilgrims` int(11) NOT NULL,
  `flight_delay` int(11) NOT NULL,
  `unmarked_buses` int(11) NOT NULL,
  `accidents` int(11) NOT NULL,
  `buses_ready_to_pilgrims` int(11) NOT NULL,
  `buses_with_mecca_logo` int(11) NOT NULL,
  `sick_cases` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arrival_form`
--

INSERT INTO `arrival_form` (`id`, `flight_id`, `json`, `passengers`, `average_waiting_to_sterile`, `average_waiting_inspection`, `average_luggage_arrive`, `average_bus_ride`, `duration_pilgrims`, `flight_delay`, `unmarked_buses`, `accidents`, `buses_ready_to_pilgrims`, `buses_with_mecca_logo`, `sick_cases`, `created_at`) VALUES
(14, 19, '{\"flight_delay\":\"delay\",\"date\":\"2022-06-05\",\"arrival_city\":\"2\",\"flight_number\":\"KRISHNA F 78\",\"number_of_staffs\":\"5\",\"number_of_counter_custom_staffs\":\"5\",\"passengers\":\"5\",\"arrival_time\":\"19:45\",\"take_off_place\":\"1\",\"expected_arrival_time\":\"20:45\",\"average_waiting_time_unitil_access\":\"5134\",\"average_waiting_time_unitil_end_of_inspection\":\"52314\",\"average_waiting_until_sorting_system\":\"51245\",\"how_long_does_luggage_arrive_at\":\"5230\",\"duration_of_arrival_pilgrims\":\"5\",\"number_of_buses_operated_to_transport_pilgrims\":\"51\",\"number_of_buses_operating_with_mecca_logo\":\"56\",\"are_there_unmarked_buses\":\"yes\",\"are_there_any_accidents\":\"no\",\"number_of_cases\":\"5\",\"challenges\":\"5sdf\",\"solutions\":\"5fd34\",\"recommendations\":\"5sdfgh\",\"reviews\":\"5g32\"}', '5', 308040, 3138840, 313800, 3074700, 300, 0, 1, 0, 51, 56, 5, 1654607723),
(15, 18, '{\"flight_delay\":\"delay\",\"date\":\"2022-06-16\",\"arrival_city\":\"2\",\"flight_number\":\"FLIGHT 123\",\"number_of_staffs\":\"25\",\"number_of_counter_custom_staffs\":\"25\",\"passengers\":\"25\",\"arrival_time\":\"14:21\",\"take_off_place\":\"1\",\"expected_arrival_time\":\"14:22\",\"average_waiting_time_unitil_access\":\"23:25:25\",\"average_waiting_time_unitil_end_of_inspection\":\"02:23:45\",\"average_waiting_until_sorting_system\":\"23:20:22\",\"how_long_does_luggage_arrive_at\":\"23:20:22\",\"first_hajji_arrived_time\":\"13:22\",\"last_hajji_arrived_time\":\"15:22\",\"first_bus_leave_time\":\"08:22\",\"number_of_buses_operated_to_transport_pilgrims\":\"25\",\"number_of_buses_operating_with_mecca_logo\":\"25\",\"are_there_unmarked_buses\":\"yes\",\"are_there_any_accidents\":\"yes\",\"number_of_cases\":\"2513\",\"challenges\":\"asd\",\"solutions\":\"asd\",\"recommendations\":\"asd\",\"reviews\":\"\"}', '25', 84325, 8625, 84022, 84022, 0, 0, 1, 1, 25, 25, 2513, 1654757574);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `en_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('source','destination') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `en_name`, `ar_name`, `type`) VALUES
(1, 'Malisia', 'City 1 Ar', 'source'),
(2, 'Riyadh', 'City 2 Ar', 'destination');

-- --------------------------------------------------------

--
-- Table structure for table `counter_timing`
--

CREATE TABLE `counter_timing` (
  `id` int(10) UNSIGNED NOT NULL,
  `flight` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `type` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter_timing`
--

INSERT INTO `counter_timing` (`id`, `flight`, `date`, `time`, `type`) VALUES
(8, 18, '2022-06-02', 1654165170, 'open'),
(9, 18, '2022-06-02', 1654166371, 'close'),
(10, 19, '2022-06-02', 1654167642, 'open'),
(11, 19, '2022-06-02', 1654167887, 'close'),
(12, 20, '2022-06-03', 1654266640, 'open'),
(13, 20, '2022-06-03', 1654266643, 'close'),
(14, 21, '2022-06-07', 1654583483, 'open'),
(15, 21, '2022-06-07', 1654583490, 'close'),
(16, 22, '2022-06-07', 1654583647, 'open'),
(17, 22, '2022-06-07', 1654583679, 'close'),
(18, 23, '2022-06-07', 1654584137, 'open'),
(19, 23, '2022-06-07', 1654584234, 'close');

-- --------------------------------------------------------

--
-- Table structure for table `departure_assesment`
--

CREATE TABLE `departure_assesment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `flight_id` int(11) UNSIGNED NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_score` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departure_assesment`
--

INSERT INTO `departure_assesment` (`id`, `user_id`, `flight_id`, `lang`, `json`, `avg_score`, `created_at`) VALUES
(12, 13, 18, 'en', '{\"employment_interaction\":\"Satisfactory\",\"clarity_procedure\":\"Unsatisfactory\",\"service_provided\":\"Less Satisfying\"}', 50, 1654166012),
(13, 13, 18, 'en', '{\"employment_interaction\":\"Satisfactory\",\"clarity_procedure\":\"Satisfactory\",\"service_provided\":\"Satisfactory\"}', 100, 1654166097),
(14, 13, 18, 'en', '{\"employment_interaction\":\"Less Satisfying\",\"clarity_procedure\":\"Less Satisfying\",\"service_provided\":\"Less Satisfying\"}', 0, 1654166207),
(15, 13, 19, 'arb', '{\"employment_interaction\":\"\\u0631\\u0627\\u0636\\u064a\",\"clarity_procedure\":\"\\u0631\\u0627\\u0636\\u064a\",\"service_provided\":\"\\u0631\\u0627\\u0636\\u064a\"}', 100, 1654167791),
(16, 1, 18, 'arb', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Yes\",\"service_provided\":\"Yes\",\"awareness\":\"Yes\",\"makkah_hall\":\"Yes\"}', 100, 1654515668),
(17, 1, 18, 'arb', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Somewhat\",\"awareness\":\"Somewhat\",\"makkah_hall\":\"Somewhat\"}', 50, 1654515692),
(18, 1, 18, 'arb', '{\"employment_interaction\":\"Not\",\"clarity_procedure\":\"Not\",\"service_provided\":\"Not\",\"awareness\":\"Not\",\"makkah_hall\":\"Not\"}', 0, 1654515709),
(19, 1, 18, 'indo', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Yes\",\"service_provided\":\"Yes\",\"awareness\":\"Yes\",\"makkah_hall\":\"Yes\"}', 100, 1654516869),
(20, 1, 18, 'indo', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Somewhat\",\"awareness\":\"Somewhat\",\"makkah_hall\":\"Somewhat\"}', 50, 1654516883),
(21, 1, 18, 'indo', '{\"employment_interaction\":\"Not\",\"clarity_procedure\":\"Not\",\"service_provided\":\"Not\",\"awareness\":\"Not\",\"makkah_hall\":\"Not\"}', 0, 1654516914),
(22, 1, 18, 'malay', '{\"employment_interaction\":\"Yes\",\"clarity_procedure\":\"Yes\",\"service_provided\":\"Yes\",\"awareness\":\"Yes\",\"makkah_hall\":\"Yes\"}', 100, 1654516928),
(23, 1, 18, 'malay', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Somewhat\",\"awareness\":\"Somewhat\",\"makkah_hall\":\"Somewhat\"}', 50, 1654516949),
(24, 1, 18, 'malay', '{\"employment_interaction\":\"Not\",\"clarity_procedure\":\"Not\",\"service_provided\":\"Not\",\"awareness\":\"Not\",\"makkah_hall\":\"Not\"}', 0, 1654516960),
(25, 1, 18, 'bng', '{\"employment_interaction\":\"Somewhat\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Somewhat\",\"awareness\":\"Yes\",\"makkah_hall\":\"Not\"}', 50, 1654518473),
(26, 1, 18, 'bng', '{\"employment_interaction\":\"Comfortable\",\"clarity_procedure\":\"Somewhat\",\"service_provided\":\"Not\",\"awareness\":\"Yes\",\"makkah_hall\":\"Somewhat\"}', 60, 1654520492),
(27, 13, 22, 'malay', '{\"employment_interaction\":\"Not\",\"clarity_procedure\":\"Yes\",\"service_provided\":\"Somewhat\",\"awareness\":\"Yes\",\"makkah_hall\":\"Not\"}', 50, 1654583668);

-- --------------------------------------------------------

--
-- Table structure for table `departure_form`
--

CREATE TABLE `departure_form` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) UNSIGNED DEFAULT NULL,
  `json` longtext DEFAULT NULL,
  `passengers` varchar(255) NOT NULL,
  `working_counts` int(11) NOT NULL,
  `non_working_counts` int(11) NOT NULL,
  `counter_duration_in_sec` int(11) NOT NULL,
  `average_pilgrim_service` int(11) NOT NULL,
  `number_of_men` int(11) NOT NULL,
  `number_of_women` int(11) NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `number_of_cases` int(11) NOT NULL,
  `number_of_bags` int(11) NOT NULL,
  `number_of_fingerprint` int(11) NOT NULL,
  `communication_speed` int(11) NOT NULL,
  `connection_status` int(11) NOT NULL,
  `fingerprint_status` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departure_form`
--

INSERT INTO `departure_form` (`id`, `flight_id`, `json`, `passengers`, `working_counts`, `non_working_counts`, `counter_duration_in_sec`, `average_pilgrim_service`, `number_of_men`, `number_of_women`, `number_of_seats`, `number_of_cases`, `number_of_bags`, `number_of_fingerprint`, `communication_speed`, `connection_status`, `fingerprint_status`, `created_at`) VALUES
(16, 18, '{\"date\":\"2022-06-02\",\"departure_city\":\"1\",\"flight_number\":\"FLIGHT 123\",\"passengers\":\"23\",\"departure_time\":\"2022-06-21\",\"arrival_city\":\"2\",\"arrival_time\":\"19:10\",\"working_counts\":\"10\",\"non_working_counts\":\"2\",\"average_pilgrim_waiting\":\"50\",\"average_pilgrim_service\":\"20\",\"counters_working_start_time\":\"19:11\",\"counters_working_end_time\":\"20:11\",\"number_of_men\":\"34\",\"number_of_women\":\"23\",\"number_of_seats\":\"45\",\"number_of_cases\":\"3\",\"number_of_people_fingerprinted\":\"5\",\"number_of_bags\":\"7\",\"fingerprint_status\":\"good\",\"connection_status\":\"excellent\",\"speed_of_communication\":\"weak\",\"challenges\":\"Cha\",\"treatment\":\"Treat\",\"recommendations\":\"Recomenda\",\"reviews\":\"Review\"}', '23', 10, 2, 0, 20, 34, 23, 45, 3, 7, 5, 0, 2, 1, 1654166685),
(17, 19, '{\"date\":\"2022-06-02\",\"departure_city\":\"1\",\"flight_number\":\"KRISHNA F 78\",\"passengers\":\"24\",\"departure_time\":\"2022-06-08\",\"arrival_city\":\"2\",\"arrival_time\":\"20:34\",\"working_counts\":\"34\",\"non_working_counts\":\"56\",\"average_pilgrim_waiting\":\"67\",\"average_pilgrim_service\":\"66\",\"counters_working_start_time\":\"20:35\",\"counters_working_end_time\":\"20:35\",\"number_of_men\":\"70\",\"number_of_women\":\"57\",\"number_of_seats\":\"80\",\"number_of_cases\":\"9\",\"number_of_people_fingerprinted\":\"3\",\"number_of_bags\":\"2\",\"fingerprint_status\":\"good\",\"connection_status\":\"excellent\",\"speed_of_communication\":\"weak\",\"challenges\":\"Challenge\",\"treatment\":\"Treatment\",\"recommendations\":\"asd\",\"reviews\":\"\"}', '24', 34, 56, 0, 30, 70, 57, 80, 9, 2, 3, 0, 2, 1, 1654167974),
(18, 18, '{\"date\":\"2022-06-03\",\"departure_city\":\"1\",\"flight_number\":\"FLIGHT 123\",\"passengers\":\"1232\",\"departure_time\":\"2222-12-31\",\"arrival_city\":\"2\",\"arrival_time\":\"14:31\",\"working_counts\":\"32\",\"non_working_counts\":\"33\",\"average_pilgrim_waiting\":1380,\"average_pilgrim_service\":1920,\"counters_working_start_time\":\"15:16\",\"counters_working_end_time\":\"17:19\",\"number_of_men\":\"123\",\"number_of_women\":\"32\",\"number_of_seats\":\"32\",\"number_of_cases\":\"32\",\"number_of_people_fingerprinted\":\"32\",\"number_of_bags\":\"23\",\"fingerprint_status\":\"excellent\",\"connection_status\":\"excellent\",\"speed_of_communication\":\"excellent\",\"challenges\":\"123\",\"treatment\":\"123\",\"recommendations\":\"123\",\"reviews\":\"123\"}', '1232', 32, 33, 7380, 56, 123, 32, 32, 32, 23, 32, 2, 2, 2, 1654249602),
(19, 18, '{\"date\":\"2022-06-27\",\"departure_city\":\"1\",\"flight_number\":\"FLIGHT 123\",\"passengers\":\"32\",\"departure_time\":\"2022-06-21T20:40\",\"arrival_city\":\"2\",\"arrival_time\":\"2022-06-22T20:40\",\"working_counts\":\"23\",\"non_working_counts\":\"32\",\"average_pilgrim_waiting\":\"32\",\"average_pilgrim_service\":\"2312\",\"counters_working_start_time\":\"15:21\",\"counters_working_end_time\":\"12:50\",\"number_of_men\":\"32\",\"number_of_women\":\"32\",\"number_of_seats\":\"23\",\"number_of_cases\":\"32\",\"number_of_people_fingerprinted\":\"23\",\"number_of_bags\":\"\",\"fingerprint_status\":\"excellent\",\"connection_status\":\"excellent\",\"speed_of_communication\":\"excellent\",\"challenges\":\"\",\"treatment\":\"\",\"recommendations\":\"\",\"reviews\":\"\"}', '32', 23, 32, 0, 89, 32, 32, 23, 32, 0, 23, 2, 2, 2, 1654356236),
(20, 21, '{\"date\":\"2022-07-09\",\"departure_city\":\"1\",\"flight_number\":\"AKASH876\",\"passengers\":\"873\",\"departure_time\":\"2022-06-15T12:03\",\"arrival_city\":\"2\",\"arrival_time\":\"2022-06-15T16:03\",\"working_counts\":\"783\",\"non_working_counts\":\"983\",\"average_pilgrim_waiting\":\"213\",\"average_pilgrim_service\":\"123\",\"counters_working_start_time\":\"20:03\",\"counters_working_end_time\":\"23:03\",\"number_of_men\":\"783\",\"number_of_women\":\"343\",\"number_of_seats\":\"787\",\"number_of_cases\":\"553\",\"number_of_people_fingerprinted\":\"830\",\"number_of_bags\":\"93\",\"fingerprint_status\":\"excellent\",\"connection_status\":\"weak\",\"speed_of_communication\":\"good\",\"challenges\":\"hiuhuihiu3\",\"treatment\":\"jiniuj3\",\"recommendations\":\"253\",\"reviews\":\"253\"}', '873', 783, 983, 10800, 7380, 783, 343, 787, 553, 93, 830, 1, 0, 2, 1654607568),
(22, 20, '{\"date\":\"2022-06-09\",\"departure_city\":\"1\",\"flight_number\":\"AKASH876\",\"passengers\":\"3\",\"departure_time\":\"2022-06-23T13:17\",\"arrival_city\":\"2\",\"arrival_time\":\"2022-06-14T13:17\",\"working_counts\":\"25\",\"non_working_counts\":\"52\",\"average_pilgrim_waiting\":\"25\",\"average_pilgrim_service\":\"25\",\"counters_working_start_time\":\"14:17\",\"counters_working_end_time\":\"15:17\",\"number_of_men\":\"25\",\"number_of_women\":\"25\",\"number_of_seats\":\"25\",\"number_of_cases\":\"25\",\"number_of_people_fingerprinted\":\"25\",\"number_of_bags\":\"25\",\"fingerprint_status\":\"good\",\"connection_status\":\"good\",\"speed_of_communication\":\"good\",\"challenges\":\"25\",\"treatment\":\"25\",\"recommendations\":\"\",\"reviews\":\"\"}', '3', 25, 52, 3600, 1500, 25, 25, 25, 25, 25, 25, 1, 1, 1, 1654588085),
(23, 20, '{\"date\":\"2022-06-24\",\"departure_city\":\"1\",\"flight_number\":\"AKASH876\",\"passengers\":\"25\",\"departure_time\":\"2022-06-09T13:04\",\"arrival_city\":\"2\",\"arrival_time\":\"2022-06-30T12:04\",\"working_counts\":\"25\",\"non_working_counts\":\"235\",\"average_pilgrim_waiting\":\"23:25:25\",\"average_pilgrim_service\":\"02:22:52\",\"counters_working_start_time\":\"12:32\",\"counters_working_end_time\":\"23:05\",\"number_of_men\":\"25\",\"number_of_women\":\"26\",\"number_of_seats\":\"26\",\"number_of_cases\":\"26\",\"number_of_people_fingerprinted\":\"256\",\"number_of_bags\":\"26\",\"fingerprint_status\":\"good\",\"connection_status\":\"weak\",\"speed_of_communication\":\"25\",\"challenges\":\"25\",\"treatment\":\"wad\",\"recommendations\":\"\",\"reviews\":\"\"}', '25', 25, 235, 37980, 8572, 25, 26, 26, 26, 26, 256, 0, 0, 1, 1654756511),
(24, 20, '{\"date\":\"2022-06-24\",\"departure_city\":\"1\",\"flight_number\":\"AKASH876\",\"passengers\":\"25\",\"departure_time\":\"2022-06-09T13:04\",\"arrival_city\":\"2\",\"arrival_time\":\"2022-06-30T12:04\",\"working_counts\":\"25\",\"non_working_counts\":\"235\",\"average_pilgrim_waiting\":\"23:25:25\",\"average_pilgrim_service\":\"02:22:52\",\"counters_working_start_time\":\"12:32\",\"counters_working_end_time\":\"23:05\",\"number_of_men\":\"25\",\"number_of_women\":\"26\",\"number_of_seats\":\"26\",\"number_of_cases\":\"26\",\"number_of_people_fingerprinted\":\"256\",\"number_of_bags\":\"26\",\"fingerprint_status\":\"good\",\"connection_status\":\"weak\",\"speed_of_communication\":\"25\",\"challenges\":\"25\",\"treatment\":\"wad\",\"recommendations\":\"\",\"reviews\":\"\"}', '25', 25, 235, 37980, 8572, 25, 26, 26, 26, 26, 256, 25, 0, 1, 1654756740);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline` int(10) UNSIGNED NOT NULL,
  `tdate` date NOT NULL,
  `ttime` time NOT NULL,
  `saudi_date` date DEFAULT NULL,
  `saudi_time` time DEFAULT NULL,
  `passengers` int(11) NOT NULL,
  `sairport` int(10) UNSIGNED NOT NULL,
  `dairport` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('not_opened','opened','check_in','check_out','closed','on_air','arrived','complete','invalid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `number`, `airline`, `tdate`, `ttime`, `saudi_date`, `saudi_time`, `passengers`, `sairport`, `dairport`, `status`, `created_at`) VALUES
(18, 'FLIGHT 123', 1, '2022-06-07', '18:47:00', '2022-06-12', '18:47:00', 32, 8, 9, 'complete', 1654165087),
(19, 'KRISHNA F 78', 1, '2002-12-04', '19:30:00', '2022-06-21', '19:30:00', 32, 8, 9, 'complete', 1654167636),
(20, 'AKASH876', 1, '2022-06-09', '12:31:00', '2022-06-24', '12:31:00', 32321, 8, 9, 'on_air', 1654266414),
(21, 'AKASH876', 1, '2022-06-08', '20:12:00', '2022-06-23', '23:08:00', 32, 8, 9, 'on_air', 1654267131),
(22, '215125', 1, '2022-06-15', '16:06:00', '2022-06-17', '17:05:00', 78, 8, 8, 'complete', 1654583643),
(23, 'rony987', 1, '2022-06-21', '17:11:00', '2022-06-09', '15:11:00', 25, 8, 8, 'complete', 1654584122);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` int(10) UNSIGNED NOT NULL,
  `info` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flight` int(10) UNSIGNED NOT NULL,
  `special` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_time` int(11) DEFAULT NULL,
  `check_out_time` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `info`, `flight`, `special`, `check_in_time`, `check_out_time`, `created_at`) VALUES
(77, '#MR#MK123', 18, 'no', 1654165715, 1654165719, 1654165715),
(78, '##MR#MK10', 18, 'no', 1654165848, 1654165748, 1654165737),
(79, '#MR#MK345', 19, 'no', 1654167717, 1654167740, 1654167717);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('supervisor','employee','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_executive` tinyint(4) NOT NULL DEFAULT 0,
  `is_super` tinyint(4) NOT NULL DEFAULT 0,
  `airport` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `reset_token`, `type`, `is_executive`, `is_super`, `airport`, `created_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$NH0Xt0F4ofQjosOoqach0e/bPHt92pzjIzW4guhj.mBA/UZWem3vm', NULL, 'admin', 0, 0, 2, 1653371725),
(13, 'Source Supervisor', 'malisiasupervisor@mail.com', '$2y$10$8NrNFtjjklRFeDFTE1.kn.hZnqyaPdOCuerFiVXPARIAgn/f5uMXi', NULL, 'supervisor', 0, 0, 8, 1654164695),
(14, 'Supervisor Ryadh', 'ryadhsupervisor@mail.com', '$2y$10$JsvMzDhlfh3/mvATPwwZs.wNH0XRjZNwO3tSPsfA2OgE8P8L6j5FK', NULL, 'supervisor', 0, 0, 8, 1654164774),
(15, 'Malisia Scanner 1', 'ms1@mail.com', '$2y$10$QDBLHMfETdjbexajCB3ZFOJRkAvh6rsZDplXRqLXM1QC5C4nnHHJG', NULL, 'employee', 0, 0, 8, 1654164839),
(16, 'Malisia Scanner 2', 'ms2@mail.com', '$2y$10$i7EEQkAsqEkpSu4Xcr1LYOnUzecmLHtovN7TGTg.Polsa/bskedUO', NULL, 'employee', 0, 0, 8, 1654164858),
(17, 'Ryadh Scanner 1', 'rdh1@mail.com', NULL, NULL, 'employee', 0, 0, 8, 1654164839),
(18, 'Ryadh Scanner 2', 'rdh2@mail.com', NULL, NULL, 'employee', 0, 0, 8, 1654164858),
(19, 'Admin', 'executive@admin.com', '$2y$10$NH0Xt0F4ofQjosOoqach0e/bPHt92pzjIzW4guhj.mBA/UZWem3vm', NULL, 'admin', 1, 0, 2, 1653371725),
(20, 'Admin', 'superadmin@admin.com', '$2y$10$NH0Xt0F4ofQjosOoqach0e/bPHt92pzjIzW4guhj.mBA/UZWem3vm', NULL, 'admin', 0, 1, 2, 1653371725);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arrival_assesment`
--
ALTER TABLE `arrival_assesment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arrival_form`
--
ALTER TABLE `arrival_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter_timing`
--
ALTER TABLE `counter_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departure_assesment`
--
ALTER TABLE `departure_assesment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departure_form`
--
ALTER TABLE `departure_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `info` (`info`,`flight`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `arrival_assesment`
--
ALTER TABLE `arrival_assesment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `arrival_form`
--
ALTER TABLE `arrival_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `counter_timing`
--
ALTER TABLE `counter_timing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `departure_assesment`
--
ALTER TABLE `departure_assesment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `departure_form`
--
ALTER TABLE `departure_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
