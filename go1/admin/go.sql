-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 12:20 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `go`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`password`) VALUES
('$2y$10$9zs7FXvsjaNAB1A/W2YRe.XoA9RYS5Lly.3FBKO8zao'),
('$2y$10$sztZkAbO0CpEmWD6jxkgAu7ar1r9w3RREShLI.7YKBI'),
('123456');

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE IF NOT EXISTS `admin1` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`admin_id`, `username`, `password`) VALUES
(1, 'poojan07', '123');

-- --------------------------------------------------------

--
-- Table structure for table `battery`
--

CREATE TABLE IF NOT EXISTS `battery` (
  `battery_id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `removable` tinyint(1) DEFAULT '0',
  `talk_time` varchar(50) DEFAULT NULL,
  `wireless_charging` tinyint(1) DEFAULT '0',
  `quick_charging` tinyint(1) DEFAULT '0',
  `usb_type_c` tinyint(1) DEFAULT '0',
  `device_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`battery_id`),
  KEY `fk_device_id` (`device_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `battery`
--

INSERT INTO `battery` (`battery_id`, `capacity`, `type`, `removable`, `talk_time`, `wireless_charging`, `quick_charging`, `usb_type_c`, `device_id`, `created_at`, `updated_at`) VALUES
(1, '4500 mAh', 'Li-Polymer', 0, '-', 0, 1, 1, 2, '2024-11-20 14:06:16', '2024-11-20 14:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE IF NOT EXISTS `camera` (
  `camera_id` int(11) NOT NULL AUTO_INCREMENT,
  `camera` varchar(100) NOT NULL,
  `resolution` varchar(50) NOT NULL,
  `autofocus` varchar(100) DEFAULT NULL,
  `ois` tinyint(1) DEFAULT '0',
  `flash` tinyint(1) DEFAULT '0',
  `image_resolution` varchar(50) DEFAULT NULL,
  `settings` text,
  `shooting_modes` text,
  `camera_features` text,
  `video_recording` tinyint(1) DEFAULT '0',
  `video_recording_features` text,
  `camera_setup` varchar(100) DEFAULT NULL,
  `device_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`camera_id`),
  KEY `fk_camera_device_id` (`device_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE IF NOT EXISTS `design` (
  `design_id` int(11) NOT NULL AUTO_INCREMENT,
  `height` varchar(50) NOT NULL,
  `width` varchar(50) NOT NULL,
  `thickness` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `device_id` int(11) NOT NULL,
  `build_material` varchar(100) DEFAULT NULL,
  `colours` varchar(200) DEFAULT NULL,
  `waterproof` tinyint(1) DEFAULT '0',
  `ruggedness` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`design_id`),
  KEY `fk_design_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `brand`, `model_name`, `created_at`, `updated_at`) VALUES
(2, 'oppo', 'F21 Pro', '2024-11-20 14:03:17', '2024-11-20 14:03:17'),
(3, 'poco', 'x4', '2024-11-20 14:32:36', '2024-11-20 14:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

CREATE TABLE IF NOT EXISTS `display` (
  `display_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_type` varchar(100) NOT NULL,
  `screen_size` varchar(50) NOT NULL,
  `resolution` varchar(50) NOT NULL,
  `peak_brightness` varchar(50) DEFAULT NULL,
  `refresh_rate` varchar(50) DEFAULT NULL,
  `aspect_ratio` varchar(50) DEFAULT NULL,
  `pixel_density` varchar(50) DEFAULT NULL,
  `screen_to_body_ratio` decimal(5,2) DEFAULT NULL,
  `screen_protection` varchar(100) DEFAULT NULL,
  `bezel_less_display` tinyint(1) DEFAULT '0',
  `touch_screen` tinyint(1) DEFAULT '1',
  `hdr_support` tinyint(1) DEFAULT '0',
  `device_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`display_id`),
  KEY `fk_display_device_id` (`device_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE IF NOT EXISTS `general` (
  `general_id` int(11) NOT NULL AUTO_INCREMENT,
  `launch_date` date NOT NULL,
  `operating_system` varchar(100) NOT NULL,
  `custom_ui` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`general_id`),
  KEY `fk_general_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `key_specs`
--

CREATE TABLE IF NOT EXISTS `key_specs` (
  `spec_id` int(11) NOT NULL AUTO_INCREMENT,
  `RAM` varchar(50) NOT NULL,
  `Processor` varchar(100) NOT NULL,
  `Rear_Camera` varchar(100) NOT NULL,
  `Front_Camera` varchar(100) NOT NULL,
  `Battery` varchar(50) NOT NULL,
  `Display` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`spec_id`),
  KEY `fk_key_specs_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `multimedia_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_radio` tinyint(1) DEFAULT '0',
  `stereo_speakers` tinyint(1) DEFAULT '0',
  `loudspeaker` tinyint(1) DEFAULT '0',
  `audio_jack` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`multimedia_id`),
  KEY `fk_multimedia_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `network_connectivity`
--

CREATE TABLE IF NOT EXISTS `network_connectivity` (
  `network_connectivity_id` int(11) NOT NULL AUTO_INCREMENT,
  `sim_slots` varchar(50) NOT NULL,
  `sim_size` varchar(50) NOT NULL,
  `network_support` varchar(100) NOT NULL,
  `volte` tinyint(1) DEFAULT '0',
  `sim_1` varchar(5000) DEFAULT NULL,
  `sim_2` varchar(5000) DEFAULT NULL,
  `sar_value` varchar(50) DEFAULT NULL,
  `wifi` tinyint(1) DEFAULT '0',
  `wifi_features` text,
  `wifi_calling` tinyint(1) DEFAULT '0',
  `bluetooth` varchar(50) DEFAULT NULL,
  `gps` tinyint(1) DEFAULT '0',
  `nfc` tinyint(1) DEFAULT '0',
  `usb_connectivity` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`network_connectivity_id`),
  KEY `fk_network_connectivity_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
  `performance_id` int(11) NOT NULL AUTO_INCREMENT,
  `chipset` varchar(100) NOT NULL,
  `CPU` varchar(100) NOT NULL,
  `architecture` varchar(50) NOT NULL,
  `fabrication` varchar(50) NOT NULL,
  `graphics` varchar(100) NOT NULL,
  `RAM` varchar(50) NOT NULL,
  `RAM_type` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`performance_id`),
  KEY `fk_performance_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE IF NOT EXISTS `sensors` (
  `sensor_id` int(11) NOT NULL AUTO_INCREMENT,
  `fingerprint_sensor` tinyint(1) DEFAULT '0',
  `fingerprint_sensor_position` varchar(50) DEFAULT NULL,
  `fingerprint_sensor_type` varchar(50) DEFAULT NULL,
  `other_sensors` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`sensor_id`),
  KEY `fk_sensors_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE IF NOT EXISTS `storage` (
  `storage_id` int(11) NOT NULL AUTO_INCREMENT,
  `internal_memory` varchar(50) NOT NULL,
  `expandable_memory` varchar(50) DEFAULT NULL,
  `user_available_storage` varchar(50) DEFAULT NULL,
  `storage_type` varchar(50) DEFAULT NULL,
  `usb_otg` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`storage_id`),
  KEY `fk_storage_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `battery`
--
ALTER TABLE `battery`
  ADD CONSTRAINT `fk_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `camera`
--
ALTER TABLE `camera`
  ADD CONSTRAINT `fk_camera_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `design`
--
ALTER TABLE `design`
  ADD CONSTRAINT `fk_design_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `display`
--
ALTER TABLE `display`
  ADD CONSTRAINT `fk_display_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `general`
--
ALTER TABLE `general`
  ADD CONSTRAINT `fk_general_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `key_specs`
--
ALTER TABLE `key_specs`
  ADD CONSTRAINT `fk_key_specs_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `fk_multimedia_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `network_connectivity`
--
ALTER TABLE `network_connectivity`
  ADD CONSTRAINT `fk_network_connectivity_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `fk_performance_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `fk_sensors_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

--
-- Constraints for table `storage`
--
ALTER TABLE `storage`
  ADD CONSTRAINT `fk_storage_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
