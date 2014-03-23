<?php

use yii\db\Schema;

class m140323_194523_create_product_table extends \yii\db\Migration
{
    private $tableName = 'teresa_product';
    private $fkAddedBy = 'productAddedBy';
    private $fkUpdatedBy = 'productUpdatedBy';
    public function up()
    {

    	$this->createTable($this->tableName, [
    		'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
    		'name' => 'VARCHAR(255)',
    		'manufacturer' =>  'INT(6) UNSIGNED',
    		'description' =>  'TEXT',
    		'mass' => 'DECIMAL(6,3)',
    		'lenght' =>  'INT(5)',
    		'width' => 'INT(5)',
    		'height' => 'INT(5)',
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
