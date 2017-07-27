<?php
$installer = $this;
$installer->startSetup();
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('brainium_store')};
CREATE TABLE {$this->getTable('brainium_store')} (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Store Id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Store Title',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Store Url',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT 'Store File Name',
  `description` text NOT NULL COMMENT 'Store Content',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Store Status',
  `created_time` datetime DEFAULT NULL COMMENT 'Store Created Time',
  `update_time` datetime DEFAULT NULL COMMENT 'Store Update Time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8 COMMENT='Store Image Table';
");
$installer->endSetup(); 