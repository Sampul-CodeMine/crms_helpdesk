-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2023 at 11:38 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmrs_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_access_permissions`
--

CREATE TABLE `tab_access_permissions` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold permissions for users ';

--
-- Dumping data for table `tab_access_permissions`
--

INSERT INTO `tab_access_permissions` (`p_id`, `p_name`) VALUES
(1, 'support'),
(2, 'engineer'),
(3, 'analyst'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tab_account`
--

CREATE TABLE `tab_account` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_address` text COLLATE utf8_unicode_ci NOT NULL,
  `account_type` int(11) NOT NULL,
  `account_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_account`
--

INSERT INTO `tab_account` (`account_id`, `account_name`, `account_address`, `account_type`, `account_created`, `account_status`) VALUES
(1, 'Test Account 2', 'Test Account Address', 3, '2020-12-20 18:14:17', 1),
(2, 'Test Account', 'Sample Account Address', 1, '2020-12-20 18:14:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_account_type`
--

CREATE TABLE `tab_account_type` (
  `acct_id` int(11) NOT NULL,
  `acct_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `acct_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_account_type`
--

INSERT INTO `tab_account_type` (`acct_id`, `acct_name`, `acct_status`) VALUES
(1, 'Agency', 1),
(2, 'Bank', 1),
(3, 'Micro-Financed Bank', 1),
(4, 'QSP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_bank`
--

CREATE TABLE `tab_bank` (
  `b_id` int(11) NOT NULL,
  `bank_account` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_shortname` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `bank_address` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_email` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold bank information';

--
-- Dumping data for table `tab_bank`
--

INSERT INTO `tab_bank` (`b_id`, `bank_account`, `bank_name`, `bank_shortname`, `bank_address`, `bank_email`, `bank_status`) VALUES
(1, '0012349501', 'Test Bank', 'TBN', 'Bank Test Address', 'testbank@oop.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_companies`
--

CREATE TABLE `tab_companies` (
  `c_id` int(11) NOT NULL,
  `company_name` text COLLATE utf8_unicode_ci NOT NULL,
  `company_address` text COLLATE utf8_unicode_ci NOT NULL,
  `company_mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `company_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `c_state_id` int(11) NOT NULL,
  `c_region_id` int(11) NOT NULL,
  `c_country_id` int(11) NOT NULL,
  `company_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold company Information';

--
-- Dumping data for table `tab_companies`
--

INSERT INTO `tab_companies` (`c_id`, `company_name`, `company_address`, `company_mobile`, `company_email`, `c_state_id`, `c_region_id`, `c_country_id`, `company_status`) VALUES
(1, 'Sample Company', 'Sample Address', '1234-123-5647', 'company.one@pmsl.com', 5, 1, 161, 1),
(2, 'Teffyinfo Concepts', 'Another Company', '0802-222-3356', 'teffy@codemines.com', 11, 3, 161, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_engineer`
--

CREATE TABLE `tab_engineer` (
  `e_id` int(11) NOT NULL,
  `engr_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `engr_vendor_id` int(11) NOT NULL,
  `engr_mobile` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `engr_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `engr_region_id` int(11) NOT NULL,
  `engr_nation_id` int(11) NOT NULL,
  `engr_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `engr_location_id` int(11) NOT NULL,
  `engr_status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold and manage engineers';

--
-- Dumping data for table `tab_engineer`
--

INSERT INTO `tab_engineer` (`e_id`, `engr_name`, `engr_vendor_id`, `engr_mobile`, `engr_email`, `engr_region_id`, `engr_nation_id`, `engr_code`, `engr_location_id`, `engr_status`, `created`) VALUES
(1, 'Dukeson Ehigboria', 1, '0901-099-6324', 'd.ehis@pmsl.com', 3, 161, 'ENGR_4800', 1, 1, '2020-11-26 11:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `tab_locations`
--

CREATE TABLE `tab_locations` (
  `l_id` int(11) NOT NULL,
  `region_id` int(5) NOT NULL,
  `nation_id` int(11) NOT NULL,
  `location_email` text COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `inventory_email` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(5) NOT NULL,
  `phone_number` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `pin_code` int(9) NOT NULL,
  `repair_center_id` int(5) NOT NULL,
  `location_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold information for the different locations';

--
-- Dumping data for table `tab_locations`
--

INSERT INTO `tab_locations` (`l_id`, `region_id`, `nation_id`, `location_email`, `company_id`, `inventory_email`, `address`, `city`, `state_id`, `phone_number`, `pin_code`, `repair_center_id`, `location_name`, `location_status`) VALUES
(1, 1, 161, 'sample.location@mail.com', 1, 'sampleinventory@mail.com', 'Location Address', 'Ozubulu', 5, '0800-111-2213', 928, 1, 'Sample location', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_moving_msgs`
--

CREATE TABLE `tab_moving_msgs` (
  `id` int(11) NOT NULL,
  `msg_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to handle moving messages';

--
-- Dumping data for table `tab_moving_msgs`
--

INSERT INTO `tab_moving_msgs` (`id`, `msg_name`, `message`, `status`) VALUES
(1, 'Welcome Message', 'Welcome to the PMSL Incidence Management Web Application. Designed to manage incidences and adhere to the SLA (Service Level Agreement) of our Customers.', 1),
(2, 'PMSL Early Morning Sessions', 'Good morning colleague,\nThere will be an early morning session/meeting between the management of PMSL, the engineers and the Support / Service-Desk officers every Monday\nTime: 7:15AM - 8:30 AM.\nPlease be punctual.\nUpcountry engineers to join using the Google meet application while the Lagos state resident engineers are to come to the office to hook up live.\nThank you. Signed Management.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_nations`
--

CREATE TABLE `tab_nations` (
  `n_id` int(11) NOT NULL,
  `n_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `n_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold nations';

--
-- Dumping data for table `tab_nations`
--

INSERT INTO `tab_nations` (`n_id`, `n_code`, `n_name`) VALUES
(1, 'AFG', 'Afghanistan'),
(2, 'ALB', 'Albania'),
(3, 'DZA', 'Algeria'),
(4, 'ASM', 'American Samoa'),
(5, 'AND', 'Andorra'),
(6, 'AGO', 'Angola'),
(7, 'AIA', 'Anguilla'),
(8, 'ATA', 'Antarctica'),
(9, 'ATG', 'Antigua and Barbuda'),
(10, 'ARG', 'Argentina'),
(11, 'ARM', 'Armenia'),
(12, 'ABW', 'Aruba'),
(13, 'AUS', 'Australia'),
(14, 'AUT', 'Austria'),
(15, 'AZE', 'Azerbaijan'),
(16, 'BHS', 'Bahamas'),
(17, 'BHR', 'Bahrain'),
(18, 'BGD', 'Bangladesh'),
(19, 'BRB', 'Barbados'),
(20, 'BLR', 'Belarus'),
(21, 'BEL', 'Belgium'),
(22, 'BLZ', 'Belize'),
(23, 'BEN', 'Benin'),
(24, 'BMU', 'Bermuda'),
(25, 'BTN', 'Bhutan'),
(26, 'BOL', 'Bolivia'),
(27, 'BES', 'Bonaire'),
(28, 'BIH', 'Bosnia and Herzegovina'),
(29, 'BWA', 'Botswana'),
(30, 'BVT', 'Bouvet Island'),
(31, 'BRA', 'Brazil'),
(32, 'IOT', 'British Indian Ocean Territory'),
(33, 'BRN', 'Brunei Darussalam'),
(34, 'BGR', 'Bulgaria'),
(35, 'BFA', 'Burkina Faso'),
(36, 'BDI', 'Burundi'),
(37, 'CPV', 'Cabo Verde'),
(38, 'KHM', 'Cambodia'),
(39, 'CMR', 'Cameroon'),
(40, 'CAN', 'Canada'),
(41, 'CYM', 'Cayman Islands'),
(42, 'CAF', 'Central African Republic'),
(43, 'TCD', 'Chad'),
(44, 'CHL', 'Chile'),
(45, 'CHN', 'China'),
(46, 'CXR', 'Christmas Island'),
(47, 'CCK', 'Cocos (Keeling) Islands'),
(48, 'COL', 'Colombia'),
(49, 'COM', 'Comoros'),
(50, 'COD', 'Congo Democratic Republic'),
(51, 'COG', 'Congo'),
(52, 'COK', 'Cook Islands'),
(53, 'CRI', 'Costa Rica'),
(54, 'HRV', 'Croatia'),
(55, 'CUB', 'Cuba'),
(56, 'CUW', 'Curacao'),
(57, 'CYP', 'Cyprus'),
(58, 'CZE', 'Czechia'),
(59, 'CIV', 'Cote D\' Ivoire'),
(60, 'DNK', 'Denmark'),
(61, 'DJI', 'Djibouti'),
(62, 'DMA', 'Dominica'),
(63, 'DOM', 'Dominican Republic'),
(64, 'ECU', 'Ecuador'),
(65, 'EGY', 'Egypt'),
(66, 'SLV', 'El Salvador'),
(67, 'GNQ', 'Equatorial Guinea'),
(68, 'ERI', 'Eritrea'),
(69, 'EST', 'Estonia'),
(70, 'SWZ', 'Eswatini'),
(71, 'ETH', 'Ethiopia'),
(72, 'FLK', 'Falkland Islands'),
(73, 'FRO', 'Faroe Islands'),
(74, 'FJI', 'Fiji'),
(75, 'FIN', 'Finland'),
(76, 'FRA', 'France'),
(77, 'GUF', 'French Guiana'),
(78, 'PYF', 'French Polynesia'),
(79, 'ATF', 'French Southern Territories'),
(80, 'GAB', 'Gabon'),
(81, 'GMB', 'Gambia'),
(82, 'GEO', 'Georgia'),
(83, 'DEU', 'Germany'),
(84, 'GHA', 'Ghana'),
(85, 'GIB', 'Gibraltar'),
(86, 'GRC', 'Greece'),
(87, 'GRL', 'Greenland'),
(88, 'GRD', 'Grenada'),
(89, 'GLP', 'Guadeloupe'),
(90, 'GUM', 'Guam'),
(91, 'GTM', 'Guatemala'),
(92, 'GGY', 'Guernsey'),
(93, 'GIN', 'Guinea'),
(94, 'GNB', 'Guinea-Bissau'),
(95, 'GUY', 'Guyana'),
(96, 'HTI', 'Haiti'),
(97, 'HMD', 'Heard Island and McDonald Islands'),
(98, 'VAT', 'Holy City'),
(99, 'HND', 'Honduras'),
(100, 'HKG', 'Hong Kong'),
(101, 'HUN', 'Hungary'),
(102, 'ISL', 'Iceland'),
(103, 'IND', 'India'),
(104, 'IDN', 'Indonesia'),
(105, 'IRN', 'Iran (Islamic Republic)'),
(106, 'IRQ', 'Iraq'),
(107, 'IRL', 'Ireland'),
(108, 'IMN', 'Isle of Man'),
(109, 'ISR', 'Israel'),
(110, 'ITA', 'Italy'),
(111, 'JAM', 'Jamaica'),
(112, 'JPN', 'Japan'),
(113, 'JEY', 'Jersey'),
(114, 'JOR', 'Jordan'),
(115, 'KAZ', 'Kazakhstan'),
(116, 'KEN', 'Kenya'),
(117, 'KIR', 'Kiribati'),
(118, 'PRK', 'Korea (Democratic People\'s Republic)'),
(119, 'KOR', 'Korea'),
(120, 'KWT', 'Kuwait'),
(121, 'KGZ', 'Kyrgyzstan'),
(122, 'LAO', 'Lao People\'s Democratic Republic'),
(123, 'LVA', 'Latvia'),
(124, 'LBN', 'Lebanon'),
(125, 'LSO', 'Lesotho'),
(126, 'LBR', 'Liberia'),
(127, 'LBY', 'Libya'),
(128, 'LIE', 'Liechtenstein'),
(129, 'LTU', 'Lithuania'),
(130, 'LUX', 'Luxembourg'),
(131, 'MAC', 'Macao'),
(132, 'MDG', 'Madagascar'),
(133, 'MWI', 'Malawi'),
(134, 'MYS', 'Malaysia'),
(135, 'MDV', 'Maldives'),
(136, 'MLI', 'Mali'),
(137, 'MLT', 'Malta'),
(138, 'MHL', 'Marshall Islands'),
(139, 'MTQ', 'Martinique'),
(140, 'MRT', 'Mauritania'),
(141, 'MUS', 'Mauritius'),
(142, 'MYT', 'Mayotte'),
(143, 'MEX', 'Mexico'),
(144, 'FSM', 'Micronesia (Federated States)'),
(145, 'MDA', 'Moldova Republic'),
(146, 'MCO', 'Monaco'),
(147, 'MNG', 'Mongolia'),
(148, 'MNE', 'Montenegro'),
(149, 'MSR', 'Montserrat'),
(150, 'MAR', 'Morocco'),
(151, 'MOZ', 'Mozambique'),
(152, 'MMR', 'Myanmar'),
(153, 'NAM', 'Namibia'),
(154, 'NRU', 'Nauru'),
(155, 'NPL', 'Nepal'),
(156, 'NLD', 'Netherlands'),
(157, 'NCL', 'New Caledonia'),
(158, 'NZL', 'New Zealand'),
(159, 'NIC', 'Nicaragua'),
(160, 'NER', 'Niger'),
(161, 'NGA', 'Nigeria'),
(162, 'NIU', 'Niue'),
(163, 'NFK', 'Norfolk Island'),
(164, 'MNP', 'Northern Mariana Islands'),
(165, 'NOR', 'Norway'),
(166, 'OMN', 'Oman'),
(167, 'PAK', 'Pakistan'),
(168, 'PLW', 'Palau'),
(169, 'PSE', 'Palestine'),
(170, 'PAN', 'Panama'),
(171, 'PNG', 'Papua'),
(172, 'PRY', 'Paraguay'),
(173, 'PER', 'Peru'),
(174, 'PHL', 'Philippines'),
(175, 'PCN', 'Pitcairn'),
(176, 'POL', 'Poland'),
(177, 'PRT', 'Portugal'),
(178, 'PRI', 'Puerto Rico'),
(179, 'QAT', 'Qatar'),
(180, 'MKD', 'Republic of North Macedonia'),
(181, 'ROU', 'Romania'),
(182, 'RUS', 'Russian'),
(183, 'RWA', 'Rwanda'),
(184, 'REU', 'Reunion'),
(185, 'BLM', 'Saint Barthelemy'),
(186, 'SHN', 'Saint Helena'),
(187, 'KNA', 'Saint Kitts and Nevis'),
(188, 'LCA', 'Saint Lucia'),
(189, 'MAF', 'Saint Martin'),
(190, 'SPM', 'Saint Pierre and Miquelon'),
(191, 'VCT', 'Saint Vincent and the Grenadines'),
(192, 'WSM', 'Samoa'),
(193, 'SMR', 'San Marino'),
(194, 'STP', 'Sao Tome and Principe'),
(195, 'SAU', 'Saudi Arabia'),
(196, 'SEN', 'Senegal'),
(197, 'SRB', 'Serbia'),
(198, 'SYC', 'Seychelles'),
(199, 'SLE', 'Sierra Leone'),
(200, 'SGP', 'Singapore'),
(201, 'SXM', 'Sint Maarten (Dutch part)'),
(202, 'SVK', 'Slovakia'),
(203, 'SVN', 'Slovenia'),
(204, 'SLB', 'Solomon Islands'),
(205, 'SOM', 'Somalia'),
(206, 'ZAF', 'South Africa'),
(207, 'SGS', 'South Georgia and the South Sandwich Islands'),
(208, 'SSD', 'South Sudan'),
(209, 'ESP', 'Spain'),
(210, 'LKA', 'Sri Lanka'),
(211, 'SDN', 'Sudan'),
(212, 'SUR', 'Suriname'),
(213, 'SJM', 'Svalbard and Jan Mayen'),
(214, 'SWE', 'Sweden'),
(215, 'CHE', 'Switzerland'),
(216, 'SYR', 'Syrian (Arab Republic)'),
(217, 'TWN', 'Taiwan (Province of China)'),
(218, 'TJK', 'Tajikistan'),
(219, 'TZA', 'Tanzania'),
(220, 'THA', 'Thailand'),
(221, 'TLS', 'Timor-Leste'),
(222, 'TGO', 'Togo'),
(223, 'TKL', 'Tokelau'),
(224, 'TON', 'Tonga'),
(225, 'TTO', 'Trinidad and Tobago'),
(226, 'TUN', 'Tunisia'),
(227, 'TUR', 'Turkey'),
(228, 'TKM', 'Turkmenistan'),
(229, 'TCA', 'Turks and Caicos Islands'),
(230, 'TUV', 'Tuvalu'),
(231, 'UGA', 'Uganda'),
(232, 'UKR', 'Ukraine'),
(233, 'UAE', 'United Arab Emirates'),
(234, 'GBR', 'United Kingdom of Great'),
(235, 'UMI', 'United States Minor Outlying Islands'),
(236, 'USA', 'United States of America'),
(237, 'URY', 'Uruguay'),
(238, 'UZB', 'Uzbekistan'),
(239, 'VUT', 'Vanuatu'),
(240, 'VEN', 'Venezuela Bolivarian Republic'),
(241, 'VNM', 'Viet Nam'),
(242, 'VGB', 'Virgin Islands (British)'),
(243, 'VIR', 'Virgin Islands (U.S.)'),
(244, 'WLF', 'Wallis and Futuna'),
(245, 'ESH', 'Western Sahara'),
(246, 'YEM', 'Yemen'),
(247, 'ZMB', 'Zambia'),
(248, 'ZWE', 'Zimbabwe'),
(249, 'ALA', 'Aland Islands');

-- --------------------------------------------------------

--
-- Table structure for table `tab_regions`
--

CREATE TABLE `tab_regions` (
  `r_id` int(5) NOT NULL,
  `region_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region_email` text COLLATE utf8_unicode_ci NOT NULL,
  `region_nation_id` int(5) NOT NULL,
  `region_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold information about the different regions';

--
-- Dumping data for table `tab_regions`
--

INSERT INTO `tab_regions` (`r_id`, `region_name`, `region_email`, `region_nation_id`, `region_status`) VALUES
(1, 'South-East', 'south.east@pmsl.com.ng', 161, 1),
(2, 'South-West', 'south.west@pmsl.com.ng', 161, 1),
(3, 'South-South', 'south.south@pmsl.com.ng', 161, 1),
(4, 'North-Central', 'north.central@pmsl.com.ng', 161, 1),
(5, 'North-East', 'north.east@pmsl.com.ng', 161, 1),
(6, 'North-West', 'north.west@pmsl.com.ng', 161, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_repair_center`
--

CREATE TABLE `tab_repair_center` (
  `r_id` int(11) NOT NULL,
  `r_center_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `r_center_region_id` int(11) NOT NULL,
  `r_center_nation_id` int(11) NOT NULL,
  `r_center_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold the information of all the repair centers.';

--
-- Dumping data for table `tab_repair_center`
--

INSERT INTO `tab_repair_center` (`r_id`, `r_center_name`, `r_center_region_id`, `r_center_nation_id`, `r_center_status`) VALUES
(1, 'Onitsha Repair Center', 1, 161, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_states`
--

CREATE TABLE `tab_states` (
  `s_id` int(5) NOT NULL,
  `region_id` int(3) NOT NULL,
  `country_id` int(3) NOT NULL,
  `state_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold the states in the country ';

--
-- Dumping data for table `tab_states`
--

INSERT INTO `tab_states` (`s_id`, `region_id`, `country_id`, `state_name`, `state_status`) VALUES
(1, 1, 161, 'Abia', 1),
(2, 4, 161, 'Abuja FCT', 1),
(3, 5, 161, 'Adamawa', 1),
(4, 3, 161, 'Akwa Ibom', 1),
(5, 1, 161, 'Anambra', 1),
(6, 5, 161, 'Bauchi', 1),
(7, 3, 161, 'Bayelsa', 1),
(8, 4, 161, 'Benue', 1),
(9, 5, 161, 'Borno', 1),
(10, 3, 161, 'Cross River', 1),
(11, 3, 161, 'Delta', 1),
(12, 1, 161, 'Ebonyi', 1),
(13, 3, 161, 'Edo', 1),
(14, 2, 161, 'Ekiti', 1),
(15, 1, 161, 'Enugu', 1),
(16, 5, 161, 'Gombe', 1),
(17, 1, 161, 'Imo', 1),
(18, 6, 161, 'Jigawa', 1),
(19, 6, 161, 'Kaduna', 1),
(20, 6, 161, 'Kano', 1),
(21, 6, 161, 'Katsina', 1),
(22, 6, 161, 'Kebbi', 1),
(23, 4, 161, 'Kogi', 1),
(24, 4, 161, 'Kwara', 1),
(25, 2, 161, 'Lagos', 1),
(26, 4, 161, 'Nasarawa', 1),
(27, 4, 161, 'Niger', 1),
(28, 2, 161, 'Ogun', 1),
(29, 2, 161, 'Ondo', 1),
(30, 2, 161, 'Osun', 1),
(31, 2, 161, 'Oyo', 1),
(32, 4, 161, 'Plateau', 1),
(33, 3, 161, 'Rivers', 1),
(34, 6, 161, 'Sokoto', 1),
(35, 5, 161, 'Taraba', 1),
(36, 5, 161, 'Yobe', 1),
(37, 6, 161, 'Zamfara', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_users`
--

CREATE TABLE `tab_users` (
  `u_id` int(11) NOT NULL,
  `user_firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_dob` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_mobile` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8_unicode_ci NOT NULL,
  `user_city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(5) NOT NULL,
  `region_id` int(5) NOT NULL,
  `country_id` int(5) NOT NULL,
  `user_username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `plain_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold information of all the users in this project';

-- --------------------------------------------------------

--
-- Table structure for table `tab_vendors`
--

CREATE TABLE `tab_vendors` (
  `v_id` int(10) NOT NULL,
  `vendor_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_address` text COLLATE utf8_unicode_ci NOT NULL,
  `vendor_city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_state_id` int(5) NOT NULL,
  `vendor_region_id` int(11) NOT NULL,
  `vendor_nation_id` int(5) NOT NULL,
  `vendor_pincode` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_email` text COLLATE utf8_unicode_ci NOT NULL,
  `vendor_type_id` int(5) NOT NULL,
  `vendor_primary_contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_primary_contact_mobile` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_primary_contact_email` text COLLATE utf8_unicode_ci NOT NULL,
  `vendor_secondary_contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_secondary_contact_mobile` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_secondary_contact_email` text COLLATE utf8_unicode_ci NOT NULL,
  `vendor_status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to hold information about the vendors.';

--
-- Dumping data for table `tab_vendors`
--

INSERT INTO `tab_vendors` (`v_id`, `vendor_id`, `vendor_name`, `vendor_address`, `vendor_city`, `vendor_state_id`, `vendor_region_id`, `vendor_nation_id`, `vendor_pincode`, `vendor_email`, `vendor_type_id`, `vendor_primary_contact_name`, `vendor_primary_contact_mobile`, `vendor_primary_contact_email`, `vendor_secondary_contact_name`, `vendor_secondary_contact_mobile`, `vendor_secondary_contact_email`, `vendor_status`, `created`) VALUES
(1, 'VEN_1606', 'Precise Management Systems Ltd', '11 Eniyansoro Beyioku Street, Surulere', 'Surulere', 25, 2, 161, '0009-0000', 'support@pmsl.com.ng', 1, 'Darlington', '0002-112-3435', 'md@pmsl.com.ng', 'Madam', '1222-434-3834', 'ed@pmsl.com.ng', 1, '2020-11-26 12:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `tab_vendor_types`
--

CREATE TABLE `tab_vendor_types` (
  `v_t_id` int(11) NOT NULL,
  `v_t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `v_t_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `v_t_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Types of Vendors Table';

--
-- Dumping data for table `tab_vendor_types`
--

INSERT INTO `tab_vendor_types` (`v_t_id`, `v_t_name`, `v_t_desc`, `v_t_status`) VALUES
(1, 'Information Technology', 'Vendors that deal with Information and Communication Technology will be in this category', 1),
(2, 'Security Agency', 'This category of Vendor type is to handle agencies that deal with security.', 1),
(3, 'Financial Institution', 'Financial Institutions Vendor type goes here.', 1),
(4, 'House Keeping Agency', 'This Vendor handles issues related to House Keeping and the likes.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_access_permissions`
--
ALTER TABLE `tab_access_permissions`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tab_account`
--
ALTER TABLE `tab_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tab_account_type`
--
ALTER TABLE `tab_account_type`
  ADD PRIMARY KEY (`acct_id`);

--
-- Indexes for table `tab_bank`
--
ALTER TABLE `tab_bank`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tab_companies`
--
ALTER TABLE `tab_companies`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tab_engineer`
--
ALTER TABLE `tab_engineer`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tab_locations`
--
ALTER TABLE `tab_locations`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `tab_moving_msgs`
--
ALTER TABLE `tab_moving_msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_nations`
--
ALTER TABLE `tab_nations`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `tab_regions`
--
ALTER TABLE `tab_regions`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tab_repair_center`
--
ALTER TABLE `tab_repair_center`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tab_states`
--
ALTER TABLE `tab_states`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tab_users`
--
ALTER TABLE `tab_users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `tab_vendors`
--
ALTER TABLE `tab_vendors`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `tab_vendor_types`
--
ALTER TABLE `tab_vendor_types`
  ADD PRIMARY KEY (`v_t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_access_permissions`
--
ALTER TABLE `tab_access_permissions`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tab_account`
--
ALTER TABLE `tab_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tab_account_type`
--
ALTER TABLE `tab_account_type`
  MODIFY `acct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tab_bank`
--
ALTER TABLE `tab_bank`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_companies`
--
ALTER TABLE `tab_companies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tab_engineer`
--
ALTER TABLE `tab_engineer`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_locations`
--
ALTER TABLE `tab_locations`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_moving_msgs`
--
ALTER TABLE `tab_moving_msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tab_nations`
--
ALTER TABLE `tab_nations`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `tab_regions`
--
ALTER TABLE `tab_regions`
  MODIFY `r_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tab_repair_center`
--
ALTER TABLE `tab_repair_center`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_states`
--
ALTER TABLE `tab_states`
  MODIFY `s_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tab_users`
--
ALTER TABLE `tab_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_vendors`
--
ALTER TABLE `tab_vendors`
  MODIFY `v_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_vendor_types`
--
ALTER TABLE `tab_vendor_types`
  MODIFY `v_t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
