<?php

use yii\db\Schema;

class m140323_185215_create_admin_table extends \yii\db\Migration
{
    private $tableName = 'teresa_admin';
    private $fkAddedBy = 'adminAddedBy';
    private $fkUpdatedBy = 'adminUpdatedBy';
    public function up()
    {
    	$this->createTable($this->tableName, [
    		'id' => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
    		'name' => 'VARCHAR(50) COLLATE utf8_bin NOT NULL',
    		'surname' => 'VARCHAR(50) COLLATE utf8_bin DEFAULT NULL',
    		'avatar' => 'VARCHAR(200) COLLATE utf8_bin DEFAULT NULL',
    		'loginName' => 'VARCHAR(20) COLLATE utf8_bin NOT NULL UNIQUE',
    		'hash' => 'VARCHAR(256) COLLATE utf8_bin NOT NULL', // password hash
            'role' => 'TINYINT UNSIGNED',
    		'addedBy' => 'SMALLINT(5) UNSIGNED',
    		'creationTime' => 'DATETIME NOT NULL',
    		'updatedBy' => 'SMALLINT(5) UNSIGNED DEFAULT NULL',
    		'updateTime' => 'DATETIME DEFAULT NULL',
    		'lastLogin' => 'DATETIME DEFAULT NULL',
    	]);
    	echo "Table " . $this->tableName . " is created.\n";
    	$this->addForeignKey($this->fkAddedBy, $this->tableName, 'addedBy',
    		$this->tableName, 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkAddedBy is added to $this->tableName.\n";
    	$this->addForeignKey($this->fkUpdatedBy, $this->tableName, 'updatedBy',
    		$this->tableName, 'id', 'restrict', 'cascade');
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
