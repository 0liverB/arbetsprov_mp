<?php
$installer = $this;
$installer->startSetup();
$sql =<<<SQL
CREATE TABLE IF NOT EXISTS {$this->getTable('oliver_arbetsprov_invoicedata')} (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_ref` BIGINT(30) NOT NULL,
	`org_amount` DECIMAL(65,10) NOT NULL,
	`calc_amount` DECIMAL(65,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;
$installer->run($sql);

$installer->endSetup();
