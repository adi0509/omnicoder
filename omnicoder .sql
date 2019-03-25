CREATE TABLE `r1detail` (
  `ip` varchar(16) NOT NULL,
  `marks` int(11) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `pwd` varchar(10) DEFAULT NULL,
  `submitTime` datetime DEFAULT NULL,
  `loginStatus` int(11) DEFAULT NULL,
  `selected` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `round2` (
  `ip` varchar(18) DEFAULT NULL,
  `newip` varchar(18) NOT NULL,
  `submitStatus` int(11) DEFAULT NULL,
  `username` varchar(5) DEFAULT NULL,
  `submitTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `solution` (
  `ip` varchar(20) NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) NOT NULL,
  `q3` int(11) NOT NULL,
  `q4` int(11) NOT NULL,
  `q5` int(11) NOT NULL,
  `q6` int(11) NOT NULL,
  `q7` int(11) NOT NULL,
  `q8` int(11) NOT NULL,
  `q9` int(11) NOT NULL,
  `q10` int(11) NOT NULL,
  `q11` int(11) NOT NULL,
  `q12` int(11) NOT NULL,
  `q13` int(11) NOT NULL,
  `q14` int(11) NOT NULL,
  `q15` int(11) NOT NULL,
  `q16` int(11) NOT NULL,
  `q17` int(11) NOT NULL,
  `q18` int(11) NOT NULL,
  `q19` int(11) NOT NULL,
  `q20` int(11) NOT NULL,
  `submit` int(11) DEFAULT '0',
  `submitTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `student` (
  `ip` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `college` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `language` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `r1detail`
  ADD PRIMARY KEY (`ip`);

ALTER TABLE `round2`
  ADD PRIMARY KEY (`newip`);

ALTER TABLE `solution`
  ADD PRIMARY KEY (`ip`);

ALTER TABLE `student`
  ADD PRIMARY KEY (`ip`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);
