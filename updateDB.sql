ALTER TABLE tt_users ADD COLUMN IF NOT EXISTS `att_id` int(10) unsigned after client_id;

ALTER TABLE tt_log ADD COLUMN IF NOT EXISTS `approved` tinyint(1) unsigned DEFAULT 0;

CREATE TABLE IF NOT EXISTS `att_log` (

  `id` bigint NOT NULL auto_increment, # time record id

  `timestamp` timestamp NOT NULL,      # modification timestamp

  `att_id` int(11) NOT NULL,          # att user id

  `date` date NOT NULL,                # date the record is for

  `time` time default NULL,           # record time (for example, 09:00)

  `in_out` tinyint(1) unsigned DEFAULT 0,   # in - 0, out - 1

  PRIMARY KEY (`id`)

);

CREATE TABLE IF NOT EXISTS `tt_general` (

  `id` bigint NOT NULL auto_increment, # record id

  `last_att_sync` timestamp NULL,      # modification timestamp

  PRIMARY KEY (`id`)

);
INSERT IGNORE INTO tt_general(`id`,`last_att_sync`) VALUES (1, null)

