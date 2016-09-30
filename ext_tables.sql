#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_fed_fcefile varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'be_groups'
#
CREATE TABLE be_groups (
  tx_fluidcontent_allowedfluidcontent mediumtext NOT NULL,
  tx_fluidcontent_deniedfluidcontent mediumtext NOT NULL
);
