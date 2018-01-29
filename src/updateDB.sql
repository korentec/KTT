ALTER TABLE tt_users ADD COLUMN IF NOT EXISTS `att_id` int(10) unsigned after client_id;

ALTER TABLE tt_log ADD COLUMN IF NOT EXISTS `approved` TINYINT(1) unsigned DEFAULT 0;
ALTER TABLE tt_log ADD COLUMN IF NOT EXISTS  `duration_dirty` TINYINT(1) NULL ;
ALTER TABLE tt_log ADD COLUMN IF NOT EXISTS  `start_dirty` TINYINT(1) NULL ;
ALTER TABLE tt_log ADD COLUMN IF NOT EXISTS  `comment_attendance` blob NULL ;




INSERT IGNORE INTO tt_general(`id`,`last_att_sync`) VALUES (1, null)
