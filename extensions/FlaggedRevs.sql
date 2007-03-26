-- (c) Joerg Baach
-- Table structure for table `revisiontags`
-- This stores expanded revision wikitext caches
-- along with rating/user/notes data
CREATE TABLE /*$wgDBprefix*/flaggedrevs (
  fr_id int(10) NOT NULL auto_increment,
  fr_page_id int(10) NOT NULL,
  fr_rev_id int(10) NOT NULL,
  fr_cache mediumblob NOT NULL default '',
  fr_acc int(2) NOT NULL,
  fr_dep int(2) NOT NULL,
  fr_sty int(2) NOT NULL,
  fr_user int(5) NOT NULL,
  fr_timestamp char(14) NOT NULL,
  fr_comment mediumblob default NULL,

  PRIMARY KEY fr_rev_id (fr_rev_id),  
  UNIQUE KEY (fr_id),
  INDEX fr_page_rev (fr_page_id,fr_rev_id),
  INDEX fr_acc_dep_sty (fr_acc,fr_dep,fr_sty)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Revision Tags Extension' AUTO_INCREMENT=0;

-- This stores image usage for the stable image directory
-- along with rating/user/notes data
CREATE TABLE /*$wgDBprefix*/flaggedimages (
  fi_id int(10) NOT NULL auto_increment,
  fi_name varchar(255) NOT NULL,
  fi_rev_id int(10) NOT NULL,
  
  PRIMARY KEY (fi_name,fi_rev_id),
  UNIQUE KEY (fi_id),
  INDEX fi_name (fi_name)
) TYPE=InnoDB;