<?php

use yii\db\Schema;

class m140323_185215_create_admin_table extends \yii\db\Migration
{
    private $tableName = 'teresa_admin';
    private $fkName = 'admin_admin';
    public function up()
    {
    	$this->createTable($this->tableName, [
    		'id' => 'smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
    		'name' => 'varchar(50) COLLATE utf8_bin NOT NULL',
    		'surname' => 'varchar(50) COLLATE utf8_bin DEFAULT NULL',
    		'avatar' => 'varchar(200) COLLATE utf8_bin DEFAULT NULL',
    		'loginname' => 'varchar(20) COLLATE utf8_bin NOT NULL',
    		'pswd' => 'varchar(128) COLLATE utf8_bin NOT NULL',
    		'createdby' => 'smallint(5) unsigned',
    		'timecreated' => 'datetime NOT NULL',
    		'updatedby' => 'smallint(5) unsigned DEFAULT NULL',
    		'timeupdated' => 'datetime DEFAULT NULL',
    		'lastlogin' => 'datetime DEFAULT NULL',
    	]);
    	echo "Table " . $this->tableName . " is created.\n";
    	$this->addForeignKey($this->fkName, $this->tableName, 'createdby', 
    		$this->tableName, 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkName is added to $this->tableName.\n";
    }

    public function down()
    {
    	$this->dropForeignKey($this->fkName, $this->tableName);
    	echo "Foreign key $this->fkName is dropped from $this->tableName.\n";
    	$this->dropTable($this->tableName);
    	echo "Table $this->tableName is dropped.\n";
    	return true;
    }

}
