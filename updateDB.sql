ALTER TABLE tt_users ADD COLUMN `att_id` int(10) unsigned after client_id

ALTER TABLE tt_log ADD COLUMN `approved` tinyint(1) unsigned DEFAULT 0