SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `apartmentID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `eu_price` double(10,2) NOT NULL,
  `description` text NOT NULL,
  `expires_on` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `dat_ins` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`apartmentID`, `name`, `eu_price`, `description`, `expires_on`, `deleted`, `contact`, `dat_ins`) VALUES
(1, 'Meine erste Wohnung', 840.00, 'Diese Wohnung ist besonders sicher.', '0000-00-00 00:00:00', 0, 'patricks1987@web.de', '0000-00-00 00:00:00'),
(2, 'Meine zweite Wohnung', 440.00, 'Diese Wohnung ist besonders günstig.', '0000-00-00 00:00:00', 0, 'patricks1987@web.de', '0000-00-00 00:00:00'),
(4, 'Meine vierte Wohnung', 140.00, 'Diese Wohnung ist besonders klein.', '0000-00-00 00:00:00', 0, 'patricks1987@web.de', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`apartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `apartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
