/**
MIT License

Copyright (c) 2016 Michael Lant, Bogdan Pshonyak, Yegor Shemereko

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */

--
-- Table structure for table 'users'
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (user_id)
);

--
-- User insertion into 'users'
--

INSERT INTO `users` (`email`, `password`) VALUES
('test@greenriver.edu', SHA1('Password01'));

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `body` text NOT NULL
);

--
-- Initialize student resources
--

INSERT INTO `resources` (`body`) VALUES (
  "<p>Student Resources Go Here</p>"
);

--
-- Table structure for table `postings`
--

CREATE TABLE IF NOT EXISTS `postings` (
  `post_id` int AUTO_INCREMENT PRIMARY KEY,
  `company` varchar(40) NOT NULL,
  `url` varchar(500) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `hours_per_week` int(2) DEFAULT '0',
  `location` varchar(30) NOT NULL,
  `category` varchar(40) NOT NULL,
  `qualifications` text NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `post_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  `expiration_date` timestamp DEFAULT '0000-00-00 00:00:00'
);


--
-- Dumping data for table `postings`
--

INSERT INTO `postings` (`post_id`, `company`, `url`, `title`, `description`, `paid`, `hours_per_week`, `location`, `category`, `qualifications`, `deleted`, `post_date`, `email`, `expiration_date`) VALUES
(4, 'Hewlett Packard ', 'http://careers.hpe.com/washington/engineering-jobs', 'Software Development Intern Cloud', '<p>Are you naturally inquisitive always taking things apart to see what makes them tick and how they can be improved? Do you want to work on very large scale cloud systems? Have you ever installed systems and configured them and said &lsquo;I can make this way better&rsquo;. Well than your chance has finally arrived. We are looking for somebody that helps us create the maps for this uncharted territory.</p>\r\n<p>About HPE Converged Cloud</p>\r\n<p>Based on OpenStack technology, #HPEHelion Converged Cloud is the world&rsquo;s premier OpenStack-based cloud technology platform for private, public, and hybrid cloud delivery. HPE Helion Cloud is one of the fastest growing divisions within HPE, building and delivering a portfolio of innovative #cloud solutions. Helion extends beyond just cloud to become the very fabric of an enterprise.</p>\r\n<p>Helion has a mission to develop a hybrid cloud delivery model that lets customers choose the optimal mix of private, managed, and public clouds to accelerate innovation and business success. Our goal is to provide the next generation of cloud infrastructure, platform services and cloud solutions for developers, ISVs, and businesses of all sizes.</p>\r\n<p>This comprehensive suite of services is supported by a user-friendly experience, backed by a long-term, winning strategy and HPE''s proven track-record in technology leadership. We recognize that open and interoperable cloud infrastructure and services are foundational in delivering the next generation of cloud-based services. It is our belief that through close collaboration with the developer community and capitalizing on the strength of HPE''s technology portfolio we can deliver a seamless and secure experience for customers.</p>\r\n<p>About the team</p>\r\n<p>We are a small team that is passionate about delivering cloud based platform and developer services such as Cloud Foundry, DNS, Load Balancing, Big Data, Database, and Messaging to our customers. We are primarily based in Seattle but have team members in many different countries.</p>', 0, 25, 'Seattle, WA', 'Software Development', '<p>What We Need:</p>\r\n<p>&bull;Computer Science majors who have completed their third year of study</p>\r\n<p>&bull;Experience building large software systems</p>\r\n<p>&bull;Ability to work with minimal supervision</p>\r\n<p>&bull;Excellent programming skills, Python experience is required</p>\r\n<p>&bull;Experience with cloud computing platforms, preferably OpenStack and Cloud Foundry</p>\r\n<p>HPE has been a consistent leader in defining the next generation computing platforms, and we are doing this again with #HPEHelion and the next-generation open source computing platform. More than 2,000 enterprise customers and 37% of the Fortune 100 use our cloud solutions today and serve as the foundation for HPE Helion. HPE is the #1 private cloud provider in the world. We are a leader in OpenStack and Cloud Foundry foundations and communities. HPE is committed to investing billions of dollars in HPE Helion products, services, technologies and programs, and the global reach of HPE Helion, over the next three years.</p>', 0, '2016-07-06 09:30:24', '', '0000-00-00 00:00:00');
(5, 'ALDO GROUP', 'http://www.internships.com/it/itcomputer-systems-intern-i1703263', 'IT/Computer Systems Intern', '<p>ALDO Group is well known for its commitment to society. We place a premium on being a good corporate citizen by working to enrich the communities in which we live and work. Over the years, we have supported many vital philanthropic causes such as War Child, YouthAIDS, CANFAR, Youth Fusion and the Cure Foundation &ndash; and that&rsquo;s just to name a few. The ALDO Group vision is to be a world-leading creator and operator of desirable footwear and accessory brands by delighting our customer, relentlessly pursuing profitable growth and always acting with our founder''s values of love, respect and integrity. <br /><br />POSITIONS AVAILABLE: <br /><br />Data Entry, Front Desk, Editorial / Journalism Intern Customer Service, Communication Intern, Accounting Intern, Office Assistant, Administrative, Social Media Intern,Public Relations, IT, Human Resources, Marketing Health care Intern,and Sales.</p>', 0, 20, 'Grover Beach, CA', 'IT Operations', '<ul>\r\n<li>Understand how computers and software can increase efficiency</li>\r\n<li>Have IT competency in the following: (Insert relevant terms)</li>\r\n<li>Possess skills in analyzing, formulating, trouble-shooting, and synthesizing</li>\r\n</ul>', 0, '2016-07-06 09:39:35', '', '0000-00-00 00:00:00');
