<?php

use yii\db\Schema;

class m140323_190223_create_manufacturer_table extends \yii\db\Migration
{
	private $tableName = 'teresa_manufacturer';
	private $fkAddedBy = 'manufacturerAddedBy';
	private $fkUpdatedBy = 'manufacturerUpdatedBy';
	public function up()
	{
		$this->createTable($this->tableName, [
			'id' => 'INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'fullName' => 'VARCHAR(150)',
			'shortName' => 'VARCHAR(30)',
			'url' => 'VARCHAR(255)',
			'description' => 'TEXT',
			'addedBy' => 'SMALLINT(5) unsigned',
			'creationTime' => 'DATETIME NOT NULL',
			'updatedBy' => 'SMALLINT(5) unsigned DEFAULT NULL',
			'updateTime' => 'DATETIME DEFAULT NULL',
		]);
		echo "Table $this->tableName is created.\n";
		$this->addForeignKey($this->fkAddedBy, $this->tableName, 'addedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkAddedBy is added to $this->tableName.\n";
		$this->addForeignKey($this->fkUpdatedBy, $this->tableName, 'updatedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkUpdatedBy is added to $this->tableName.\n";

	}

	public function down()
	{
		$this->dropForeignKey($this->fkUpdatedBy, $this->tableName);
		echo "Foreign key $this->fkUpdatedBy is dropped from $this->tableName.\n";
		$this->dropForeignKey($this->fkAddedBy, $this->tableName);
		echo "Foreign key $this->fkAddedBy is dropped from $this->tableName.\n";
		$this->dropTable($this->tableName);
		echo "Table  $this->tableName is dropped.\n";
		return true;
	}
}
