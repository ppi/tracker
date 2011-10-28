-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: issue_tracker
-- ------------------------------------------------------
-- Server version	5.1.49-1ubuntu8.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_user_id` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  `ticket_type` enum('feature_request','bug','enhancement') NOT NULL,
  `severity` enum('minor','major','critical') NOT NULL,
  `status` enum('open','assigned','closed') NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (11,'Ticket View',3,3,1283725315,'feature_request','minor','open','Find out this mad wrapping problem for the Created field.',3),(20,'sendMail()',3,3,1284555495,'feature_request','minor','open','Fix the syntax errors in PPI_Model_Helper::sendMail();\r\n\r\nRevise where to put it. maybe PPI_Mail ?\r\n\r\n-----\r\nFixed and moved. Updated the helper to alias the new location PPI_Mail::sendMail();',1),(27,'Email sending',3,0,1291668236,'enhancement','minor','open','<p>Look into \"subscribe\" functionality and the ability to unsubscribe.</p>\r\n<p>If you create a ticket, you\'re automatically subscribed.</p>\r\n<p>Something like this:</p>\r\n<p>\r\n<pre><code class=\"php\">// override\r\nfunction insert($data) {\r\n    $iTicketID = parent::insert($data);\r\n    // Subscribe code here. Need to make a new DB table for subscriptions.\r\n    return $iTicketID;\r\n}</code></pre>\r\n</p>\r\n<p>&nbsp;</p>',1),(26,'Implementation of Disk based cache aka PPI_Cache_Disk',7,0,1291667857,'feature_request','minor','open','<p>There\'s already an implementation for APC and Memcached but APC fails under fcgi or fcgid and Memcached is a central cache system which is not used on small scale apps.</p>\r\n<p>I think a file based cache with excellent performance would really really be helpful!</p>',1),(23,'Add PPI_Controller->set()',3,5,1291420443,'enhancement','minor','open','<p>Add PPI_Controller-&gt;set()  This will let users append to the current view variables, then you can just do $this-&gt;load()  --- Update --- This has been implemented, tested but not applied to a live environment for full testing. -&gt;set() can take array or scalar values as the key.</p>',1),(24,'Permalinks for comments',3,10,1291645722,'enhancement','minor','open','<p>Create a permalink HREF that people can copy the url <a href=\"#comment45\">Permalink</a></p>\r\n<p>Hook in the hidden <a name=\"2comment45\"></a></p>\r\n<p>&nbsp;</p>',3),(25,'Attach files to tickets',3,8,1291646299,'enhancement','minor','open','<p>Ability to attach a file to the ticket upon creation, post-creation.</p>\r\n<p>Ability to attach a file to a comment.</p>',3),(28,'Check view file existance.',3,0,1291725218,'enhancement','minor','open','<div>\r\n<pre><span style=\"font-family: monospace;\">Add a file_exists() check to the view renderer before it tries to include it</span></pre>\r\n</div>',1),(29,'Add syntax highlighter',3,3,1291762077,'enhancement','minor','assigned','<p>Update the admin create ticket page to put in the syntax highlighter.</p>\r\n<p>Remove the HTML icon from the WYSIWYG</p>',3),(30,'Wrap view output in output buffering',3,0,1291762354,'feature_request','minor','open','<p>Wrap view output in output buffering so that we can do a try{} catch{} and display the general exception page on its own and not half-way into a view output.</p>',1),(31,'Admin User Addedit - Validate unique data.',3,0,1291825640,'enhancement','minor','open','<p>Validate the users email address _and_ their \"usernameField\" value.</p>\r\n<p>This means&nbsp;whether&nbsp;they have the <strong>$config-&gt;system-&gt;usernameField </strong>is set to \'username\' or \'email\' it will make sure that it\'s unique.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',2),(32,'Admin User Addedit - Escalate Privileges',3,0,1291825925,'bug','minor','open','<p>Check that the role_id of the user that\'s being created/updated is not higher than the current user\'s ID.</p>\r\n<p>Something like this:</p>\r\n<p>\r\n<pre><code class=\"php\">if($this-&gt;getAuthData(false)-&gt;role_id &lt; $formInfo[\'role_id\'])) {\r\n    throw new PPI_Exception(\'Permission error: You cannot modify user privileges higher than your own\');\r\n}</code></pre>\r\n</p>',2),(33,'PPI Admin - User Delete',3,3,1291923371,'bug','minor','closed','<p><strong>Make it restrictive for users to delete themselves.</strong></p>',2),(34,'PPI User Add/Edit Password Validation',3,0,1291923823,'enhancement','minor','open','<p>Make sure the <strong>usernameField</strong> does not match the password.</p>',2),(35,'Exception Page Changes',3,0,1292583571,'enhancement','minor','open','<p>Make this in the app space.</p>\r\n<p>Pass in data info the template file such as file, line, backtrace, mysql backtrace and such.</p>',1),(36,'Email Log',3,0,1293056946,'enhancement','minor','open','<p>When an email is sent through the mailing function, log it to the database. Also check a config value for forcing of email logging on/off.</p>\r\n<p>This can now be pulled into the admin panel UI and displayed to the administrator.</p>\r\n<p>Something like:\r\n<pre><code class=\"php\">function sendMail() {\r\n      $mail = new PPI_Mail();\r\n      $ret = $mail-&gt;send();\r\n      $oLog = new PPI_Model_Log();\r\n      $oLog-&gt;logMail(array(\'stuff for the db\'));\r\n      return $ret;\r\n}</code></pre>\r\n</p>\r\n<p>&nbsp;</p>',2),(37,'New Auth Layer',3,0,1293564673,'enhancement','minor','open','<p>Each authentication module must conform to the following interface.</p>\r\n<p>\r\n<pre><code class=\"php\">interface PPI_Auth_Interface {\r\n    function login($username, $password);\r\n    function verify($username, $password);\r\n    function register($userdata);\r\n    function logout();\r\n    function changePass();\r\n    function generatePassword();\r\n}\r\n</code></pre>\r\n</p>\r\n<p>The class PPI_Auth that is the main auth class will have the ability to register authentication modules and perform the associative actions on them such as register, login, add a module</p>\r\n<p>\r\n<pre><code class=\"php\">class PPI_Auth {\r\n    protected $_modules = array();\r\n    function addModule(PPI_Auth_Interface $module) {\r\n         $this-&gt;_modules[] = $module;\r\n    }\r\n    function login($username, $password) {\r\n        foreach($this-&gt;_modules as $module) {\r\n            $module-&gt;login($username, $password);\r\n        }\r\n    }\r\n    function register($userdata) {\r\n        foreach($this-&gt;_modules as $module) {\r\n            $module-&gt;register($userdata);\r\n        }\r\n    }\r\n}</code></pre>\r\n</p>',1),(38,'Need multi-project support',3,0,1293748471,'feature_request','minor','open','<p>Need to have multi-project support so you can have tickets for the \"framework\" and tickets for the \"skeleton app\".</p>\r\n<p>Each project can have its own localised milestones (versions) to allow for better categorisation of tickets.</p>\r\n<p>When multi-project is implemented, then a new ticket for milestones should be made.</p>\r\n<p>&nbsp;</p>\r\n<p>Need to ammend the ticket table adding a new field \"project_id\" and a new table called \"project\"</p>\r\n<p>Fields for table project:</p>\r\n<p>id,</p>\r\n<p>title (string) ,</p>\r\n<p>leader (created user id),</p>\r\n<p>created (timestamp),</p>\r\n<p>last_activity (timestamp)</p>\r\n<p>&nbsp;</p>',3),(39,'PPI_Autoloader prefixes',3,0,1293936984,'feature_request','minor','open','<p>Have the ability to add custom prefixes in the bootstrap for PPI_Autoloader, currently we only have PPI_* and APP_* as standard.</p>\r\n<p>\r\n<pre><code class=\"php\">PPI_Autoload::setPrefix(array(\r\n    \'Zend_\' =&gt; SYSPATH . \'Vendor/Zend/\',\r\n    \'Doctrine_\' =&gt; SYSPATH . \'Vendor/Doctrine/\'\r\n));</code></pre>\r\n</p>\r\n<p>Then from the autoloader we can store the prefixes in a class prop.</p>\r\n<p>\r\n<pre><code class=\"php\">function setPrefix(array $p_aPrefixes) {\r\n    $this-&gt;_prefixes = $this-&gt;_prefixes + $p_aPrefixes;\r\n    // or use merge\r\n    $this-&gt;_prefixes = array_merge($this-&gt;_prefixes, $p_aPrefixes);\r\n}</code></pre>\r\n</p>\r\n<p>Then when we try to autoload we just go over the prefixes.</p>\r\n<p>\r\n<pre><code class=\"php\">foreach($this-&gt;_prefixes as $prefix) {\r\n    if(strpos($prefix, $className) !== false) {\r\n        // Load class\r\n    }\r\n}</code></pre>\r\n</p>',1),(40,'test title',3,0,1295295945,'feature_request','minor','open','<p>DBFJSKDFS\r\n<pre><code class=\"php\">functioin foo() {\r\n\r\necho \"hoo\";\r\n}</code></pre>\r\n</p>\r\n<p>FPSDJF</p>\r\n<p>SDJF[ODSJ</p>\r\n<p>FSDJF</p>\r\n<p>SDJF</p>',5);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_category`
--

DROP TABLE IF EXISTS `ticket_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_category`
--

LOCK TABLES `ticket_category` WRITE;
/*!40000 ALTER TABLE `ticket_category` DISABLE KEYS */;
INSERT INTO `ticket_category` VALUES (1,'Framework'),(2,'Skeleton App'),(3,'Issue Tracker'),(4,'eCommerce App'),(5,'Documentation'),(6,'Misc');
/*!40000 ALTER TABLE `ticket_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_comment`
--

DROP TABLE IF EXISTS `ticket_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` bigint(20) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_comment`
--

LOCK TABLES `ticket_comment` WRITE;
/*!40000 ALTER TABLE `ticket_comment` DISABLE KEYS */;
INSERT INTO `ticket_comment` VALUES (1,3,'<p>Test</p>',1291494811,23),(2,5,'<p>Will there be a magic function like __set to manipulate the data or take action?</p>',1291494883,23),(3,3,'<p>$this-&gt;set(\'key\', $val);</p>\r\n<p>or</p>\r\n<p>$this-&gt;set(array(\'key\' =&gt; $val, \'foo\' =&gt; $bar));</p>\r\n<p>which is the equiv of..</p>\r\n<p>$key = \'val\';</p>\r\n<p>$foo = \'bar\';</p>\r\n<p>$this-&gt;set(compact(\'key\', \'foo\'));</p>',1291494982,23),(4,6,'<p><strong>Little test comment.</strong></p>',1291496095,23),(5,3,'<p>Testing the new syntax highlighter.</p>\r\n<p>\r\n<pre><code class=\"php\">$this-&gt;set(\'key\', $val);\r\n\r\n// or\r\n$this-&gt;set(array(\'key\' =&gt; $val, \'foo\' =&gt; $bar));\r\n\r\n// or\r\n$key = \'val\';\r\n$foo = \'bar\';\r\n$this-&gt;set(compact(\'key\', \'foo\'));</code></pre>\r\n</p>',1291502086,23),(6,5,'<p>\r\n<pre><code class=\"php\">&lt;?php echo \'I\\\'m the modaeffing greatest\'; ?&gt;</code></pre>\r\n</p>',1291643970,23),(7,7,'<p>&nbsp;</p>\r\n<pre><strong><span style=\"font-family: monospace;\">DIRECTORY STRUCTURE FOR CACHE</span></strong></pre>\r\n<pre><span style=\"font-family: monospace;\">Assume that \'cache\' is the directory for cache files and $md is the hash of the key for this cache.</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><br /></span></pre>\r\n<pre><strong><span style=\"font-family: monospace;\">cache/#tagname#/md[0]/md[1]/md[0-31]</span></strong></pre>\r\n<pre><span style=\"font-family: monospace;\"><br /></span></pre>\r\n<pre><span style=\"font-family: monospace;\">for e.g</span></pre>\r\n<pre><span style=\"font-family: monospace;\">1) if the key is \'last10tweets\', $md = e116c2763de865f4f3bf24144bd4676e</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><strong>File:</strong> cache/default/e/1/</span><span style=\"font-family: monospace;\">e116c2763de865f4f3bf24144bd4676e</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><br /></span></pre>\r\n<pre><span style=\"font-family: monospace;\">2) if the key is \'</span><span style=\"font-family: monospace;\">last10tweets\' with a tag \'socialfeeds\', then:</span></pre>\r\n<pre><span style=\"font-family: monospace;\">&nbsp;</span><span style=\"font-family: monospace;\"><strong>File:</strong> cache/socialfeeds</span><span style=\"font-family: monospace;\">/e/1/</span><span style=\"font-family: monospace;\">e116c2763de865f4f3bf24144bd4676e</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><br /></span></pre>\r\n<pre><span style=\"font-family: monospace;\">3) if the key is \'</span><span style=\"font-family: monospace;\">last10tweets\' with two tags, \'socialfeeds\', \'sidebarwidget\', then two cache files will be created:</span></pre>\r\n<pre><span style=\"font-family: monospace;\">&nbsp;</span><span style=\"font-family: monospace;\"><strong>File:</strong> cache/socialfeeds</span><span style=\"font-family: monospace;\">/e/1/</span><span style=\"font-family: monospace;\">e116c2763de865f4f3bf24144bd4676e</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><strong>File:</strong> cache/sidebarwidget</span><span style=\"font-family: monospace;\">/e/1/</span><span style=\"font-family: monospace;\">e116c2763de865f4f3bf24144bd4676e</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><br /></span></pre>\r\n<pre><span style=\"font-family: monospace;\">No need of any kind of file extension for the actual file.</span></pre>\r\n<pre><span style=\"font-family: monospace;\">With this kind of directory structure, deleting a single key (with no tag), a single key(with a tag), or a single key(with multiple tags), or a tag, or multiple tags, or all the cache should be easy.</span></pre>\r\n<pre><span style=\"font-family: monospace;\"><br /></span></pre>\r\n<pre><strong><span style=\"font-family: monospace;\">FILE STRUCTURE FOR CACHE FILE</span></strong></pre>\r\n<pre>#header#\\r\\n#serialized content#</pre>\r\n<pre><br /></pre>\r\n<pre>#header# = expires_time[10 bytes]</pre>\r\n<pre>for future proof, #header = expires_time[10 bytes] | next param | next param | ....</pre>\r\n<pre><br /></pre>\r\n<pre>For checking for cache hit/miss, all we need to do is an fread(10) &lt; time()</pre>\r\n<pre><br /></pre>\r\n<pre><br /></pre>\r\n<p>&nbsp;</p>',1293121071,26),(8,3,'<p>This is in progress now.</p>',1293490856,26),(9,3,'<p>Initial implementation created:&nbsp;<a href=\"http://code.google.com/p/ppi-framework/source/browse/trunk/Cache/Disk.php\">http://code.google.com/p/ppi-framework/source/browse/trunk/Cache/Disk.php</a></p>\r\n<p>&nbsp;</p>',1293503914,26),(10,3,'<p>Also on the URL eg:&nbsp;<a href=\"http://ppiframework.com/support/ticket/view/24/Permalinks-for-comments\">http://ppiframework.com/support/ticket/view/24/Permalinks-for-comments</a></p>\r\n<p>Need to have a field to show who the ticket is assigned to.. currently it only shows you who it was \"repored by\"</p>\r\n<p>&nbsp;</p>',1293746458,24),(11,3,'<p>\r\n<pre><code class=\"php\">// Multiple adapter authentication (single sign on)\r\n$auth = new PPI_Auth();\r\n$auth-&gt;addAdapter(new PPI_Auth_MySql());\r\n$auth-&gt;addAdapter(new PPI_Auth_Wordpress());\r\nif($auth-&gt;verify($username, $password)) {\r\n   // Credential match\r\n}\r\n\r\n\r\n// Single adapter authentication.\r\n$config = array(\r\n    \'table\' =&gt; \'users\',\r\n    \'column\' =&gt; \'id\',\r\n    \'extra_clause\' =&gt; \'active = 1\'\r\n);\r\n$auth = PPI_Auth_MySql($config);\r\nif($auth-&gt;verify($username, $password)) {\r\n    \r\n}</code></pre>\r\n</p>',1293938145,37),(12,3,'<p>This has been temporary resolved by creating \"Ticket Categories\" instead of fully-featured projects.</p>',1295251126,38),(13,3,'<p>This has been done - autoloading libs with Zend working 100% with PEAR syntax</p>',1295296761,39);
/*!40000 ALTER TABLE `ticket_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `created` int(25) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `activation_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,4,1283013351,'Paul','Dragoonis','paul@dragoonis.com','1a8e9f5c880ace89adf4925b47e77db462fbe2e067acda1379c2',1,'MTI4MzAxMzM1MQ=='),(5,2,1291494772,'Sean','Koole','sean@seankoole.com','afcfb756b69d9690ee89b72bae116e999192a48dddf579202245',1,'MTI5MTQ5NDc3Mg=='),(6,2,1291495585,'Keith','M','aoeex@yahoo.com','14aa76f27eb3b686d97a88af2fc33de8b14cb55e6a11b0785550',1,'MTI5MTQ5NTU4NQ=='),(7,2,1291667627,'Dayson','Pais','dayson@epicwhale.org','a5f7c0f6aeafb0e0ae90fdc83b52360c1858f48c467e4d3fe221',1,'MTI5MTY2NzYyNw=='),(8,2,1291987930,'Ross','Moroney','code_ph0y@googlemail.com','f5173285c259fab5cd70678715138b8a003ff4c66b95c82b65d8',1,'MTI5MTk4NzkzMA=='),(9,2,1293564797,'Ryan','Cummins','mobile@zenmedia.co.uk','e6e5f377e2277f96d490461b65461dd47df214d238c2248e7240',1,'MTI5MzU2NDc5Nw=='),(10,2,1293564968,'Alfredo','Juarez','developer@asksoft.org','75fd27ebcd86c0860a9295a64b7936fad610bfdba6112c4dae5c',1,'MTI5MzU2NDk2OA=='),(11,2,1293767958,'test','test','test@test.com','c68b2e3d2747bf2650ccb3fa0870c3c4e29e4a10056781e8ec07',1,'MTI5Mzc2Nzk1OA=='),(12,2,1293967924,'James','Martinez','elloromtz@gmail.com','0a6575b80bade84ed78e767f7c008625a4d7b76524110bf3a81f',1,'MTI5Mzk2NzkyNA==');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-01-19 21:11:16
