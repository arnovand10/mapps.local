SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE 'rooms' (
  'id' int(11) NOT NULL,
  'number' int(11) NOT NULL,
  'vrij' boolean NOT NULL,
  'personen' int(11) NOT NULL,
  'balkon' boolean NOT NULL,
  'bad' boolean NOT NULL,
  'airco' boolean NOT NULL,
  'televisie' boolean NOT NULL,
  'wifi' boolean NOT NULL,
  'minibar' boolean NOT NULL,


) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
--
-- Indexes for table `students`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;