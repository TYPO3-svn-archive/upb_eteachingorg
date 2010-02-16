#
# Table structure for table 'tx_upbeteachingorg_university_contacts_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_university_contacts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_upbeteachingorg_university_tool_mm'
#
#
CREATE TABLE tx_upbeteachingorg_university_tools_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(50) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_upbeteachingorg_university_toolportraits_mm'
#
#
CREATE TABLE tx_upbeteachingorg_university_toolportraits_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(50) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_upbeteachingorg_university'
#
CREATE TABLE tx_upbeteachingorg_university (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	name tinytext,
	news text,
	info text,
	url tinytext,
	elearningurl tinytext,
	newsfeedurl tinytext,
	contacts int(11) DEFAULT '0' NOT NULL,
       tools int(11) DEFAULT '0' NOT NULL,
	toolportraits int(11) DEFAULT '0' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_upbeteachingorg_contact'
#
CREATE TABLE tx_upbeteachingorg_contact (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	honorific_suffix tinytext,
	givenname tinytext,
	familyname tinytext,
	email tinytext,
	phone tinytext,
	url tinytext,
	photourl tinytext,
	generalcontact tinyint(3) DEFAULT '0' NOT NULL,
	role int(11) DEFAULT '0' NOT NULL,
	tools int(11) DEFAULT '0' NOT NULL,	
	portraits int(11) DEFAULT '0' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tx_upbeteachingorg_training_contacts_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_training_contacts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_upbeteachingorg_training'
#
CREATE TABLE tx_upbeteachingorg_training (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	summary tinytext,
	description text,
	location tinytext,
	url tinytext,
	dtstart int(11) DEFAULT '0' NOT NULL,
	dtend int(11) DEFAULT '0' NOT NULL,
	due int(11) DEFAULT '0' NOT NULL,
	category int(11) DEFAULT '0' NOT NULL,
	targetgroup text,
	price tinytext,
	certificate tinytext,
	content varchar(20) DEFAULT '' NOT NULL,
	contacts int(11) DEFAULT '0' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_upbeteachingorg_event'
#
CREATE TABLE tx_upbeteachingorg_event (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	summary tinytext,
	description text,
	location tinytext,
	url tinytext,
	dtstart int(11) DEFAULT '0' NOT NULL,
	dtend int(11) DEFAULT '0' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tx_upbeteachingorg_tool_categories_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_tool_categories_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_upbeteachingorg_tool_contacts_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_tool_contacts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_upbeteachingorg_tool'
#
CREATE TABLE tx_upbeteachingorg_tool (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	title tinytext,
	description text,
	url tinytext,
	categories int(11) DEFAULT '0' NOT NULL,
	contacts int(11) DEFAULT '0' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_upbeteachingorg_toolcategories'
#
CREATE TABLE tx_upbeteachingorg_toolcategories (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_upbeteachingorg_servicecategory'
#
CREATE TABLE tx_upbeteachingorg_servicecategory (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tx_upbeteachingorg_service_categories_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_service_categories_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_upbeteachingorg_service_contacts_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_service_contacts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_upbeteachingorg_service_tools_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_service_tools_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_upbeteachingorg_service_toolportraits_mm'
#
#
CREATE TABLE tx_upbeteachingorg_service_toolportraits_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_upbeteachingorg_service'
#
CREATE TABLE tx_upbeteachingorg_service (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	summary tinytext,
	description text,
	url tinytext,
	tags tinytext,
	serviceCategories int(11) DEFAULT '0' NOT NULL,
	contacts int(11) DEFAULT '0' NOT NULL,
	tool int(11) DEFAULT '0' NOT NULL,
	toolportrait int(11) DEFAULT '0' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tx_upbeteachingorg_project_department_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_project_department_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_upbeteachingorg_project_partners_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_project_partners_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_upbeteachingorg_project_partneruniversities_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_project_partneruniversities_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_upbeteachingorg_project_contacts_mm'
# 
#
CREATE TABLE tx_upbeteachingorg_project_contacts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_upbeteachingorg_project'
#
CREATE TABLE tx_upbeteachingorg_project (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	objectid tinytext,
	title tinytext,
	summary text,
	description text,
	url tinytext,
	state int(11) DEFAULT '0' NOT NULL,
	dtstart int(11) DEFAULT '0' NOT NULL,
	dtend int(11) DEFAULT '0' NOT NULL,
	type tinytext,
	resource tinytext,
	tags tinytext,
	department int(11) DEFAULT '0' NOT NULL,
	partners int(11) DEFAULT '0' NOT NULL,
	partneruniversities int(11) DEFAULT '0' NOT NULL,
	contacts int(11) DEFAULT '0' NOT NULL,
	category varchar(16) DEFAULT '' NOT NULL,
	syncid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_upbeteachingorg_projectdepartment'
#
CREATE TABLE tx_upbeteachingorg_projectdepartment (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_upbeteachingorg_projectpartner'
#
CREATE TABLE tx_upbeteachingorg_projectpartner (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_upbeteachingorg_role'
#
CREATE TABLE tx_upbeteachingorg_role (
        uid int(11) NOT NULL auto_increment,
        pid int(11) DEFAULT '0' NOT NULL,
        tstamp int(11) DEFAULT '0' NOT NULL,
        crdate int(11) DEFAULT '0' NOT NULL,
        cruser_id int(11) DEFAULT '0' NOT NULL,
        deleted tinyint(4) DEFAULT '0' NOT NULL,
        hidden tinyint(4) DEFAULT '0' NOT NULL,
        title tinytext,

        PRIMARY KEY (uid),
        KEY parent (pid)
);

#
# Table structure for table 'tx_upbeteachingorg_contact_roles_mm'
#
#
CREATE TABLE tx_upbeteachingorg_contact_roles_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_upbeteachingorg_contact_tools_mm'
#
#
CREATE TABLE tx_upbeteachingorg_contact_tools_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_upbeteachingorg_tool'
#
CREATE TABLE tx_upbeteachingorg_toolportraiteto (
        uid int(11) NOT NULL auto_increment,
        pid int(11) DEFAULT '0' NOT NULL,
        tstamp int(11) DEFAULT '0' NOT NULL,
        crdate int(11) DEFAULT '0' NOT NULL,
        cruser_id int(11) DEFAULT '0' NOT NULL,
        deleted tinyint(4) DEFAULT '0' NOT NULL,
        hidden tinyint(4) DEFAULT '0' NOT NULL,
        objectid tinytext,
        title tinytext,
	operating_field tinytext,
        description text,
	category varchar(255) DEFAULT '' NOT NULL,
	pros text,
	cons text,
	examples text,
	format text,
	producer tinytext,
	price tinytext,
	operating_system varchar(16) DEFAULT '' NOT NULL,
	level text,
	tutorials text,
	reference text,
	options text,
	syncid int(11) DEFAULT '0' NOT NULL,
        PRIMARY KEY (uid),
        KEY parent (pid)
);

#
# Table structure for table 'tx_upbeteachingorg_toolportrait'
#
CREATE TABLE tx_upbeteachingorg_toolportrait (
        uid int(11) NOT NULL auto_increment,
        pid int(11) DEFAULT '0' NOT NULL,
        tstamp int(11) DEFAULT '0' NOT NULL,
        crdate int(11) DEFAULT '0' NOT NULL,
        cruser_id int(11) DEFAULT '0' NOT NULL,
        deleted tinyint(4) DEFAULT '0' NOT NULL,
        hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,
        portrait_id int(11) DEFAULT '0' NOT NULL,
        contacts int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
        KEY parent (pid)
);

#
# Table structure for table 'tx_upbeteachingorg_toolportraiteto_categories_mm'
#
#
CREATE TABLE tx_upbeteachingorg_toolportraiteto_categories_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_upbeteachingorg_contact_roles_mm'
#
#
CREATE TABLE tx_upbeteachingorg_toolportrait_contacts_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_upbeteachingorg_university_contacts_mm'
#
#
CREATE TABLE tx_upbeteachingorg_contact_portraits_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_upbeteachingorg_conf'
#
#
CREATE TABLE tx_upbeteachingorg_conf (
	confname tinytext,
	confvalueString tinytext,
	confvalueInt int(11) DEFAULT '0' NOT NULL,
);
