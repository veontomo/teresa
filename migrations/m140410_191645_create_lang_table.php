<?php

use yii\db\Schema;

class m140410_191645_create_lang_table extends \yii\db\Migration
{
	private $tableName = 'teresa_lang';
	private $adminTable = 'teresa_admin';
	private $fkAddedBy = 'langAddedBy';
	private $fkUpdatedBy = 'langUpdatedBy';

    public function up()
    {
    	$this->createTable($this->tableName, [
    		'id' => 'INT(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
    		'name' => 'VARCHAR(5)',
    		'description' => 'VARCHAR(100)',
    		'charset' => 'VARCHAR(10)',
    		// value to use in html with "lang" attribute
    		'lang' => 'VARCHAR(10)',   
    		'addedBy' => 'SMALLINT(5) unsigned',
    		'creationTime' => 'DATETIME NOT NULL',
    		'updatedBy' => 'SMALLINT(5) unsigned DEFAULT NULL',
    		'updateTime' => 'DATETIME DEFAULT NULL',
    	]);
    	echo "Table $this->tableName is created.\n";
    	$this->addForeignKey($this->fkAddedBy, $this->tableName, 'addedBy', 
    		$this->adminTable, 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkAddedBy is added to $this->tableName.\n";
    	$this->addForeignKey($this->fkUpdatedBy, $this->tableName, 'updatedBy', 
    		$this->adminTable, 'id', 'restrict', 'cascade');
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
