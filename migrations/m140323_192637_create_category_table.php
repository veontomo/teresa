<?php

use yii\db\Schema;

class m140323_192637_create_category_table extends \yii\db\Migration
{
    private $tableName = 'teresa_category';
    private $fkAddedBy = 'categoryAddedBy';
    private $fkUpdatedBy = 'categoryUpdatedBy';

    public function up()
    {
    	$this->createTable($this->tableName, [
    		'id' => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
    		'name' => 'VARCHAR(255)',
    		'parent' =>  'SMALLINT(5) UNSIGNED',
    		'description' =>  'TEXT',
    		'addedBy' => 'SMALLINT(5) UNSIGNED',
    		'creationTime' => 'DATETIME NOT NULL',
    		'updatedBy' => 'SMALLINT(5) UNSIGNED DEFAULT NULL',
    		'updateTime' => 'DATETIME DEFAULT NULL'
    	]);
    	echo "Table " . $this->tableName . " is created.\n";
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
    	echo "Table $this->tableName is dropped.\n";
    	return true;
    }
}
