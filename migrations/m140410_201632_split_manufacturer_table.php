<?php

use yii\db\Schema;

class m140410_201632_split_manufacturer_table extends \yii\db\Migration
{
    private $tableName = 'teresa_manufacturer';
 	private $tableNameLD = 'teresa_manufacturer_LD'; // language-dependent
 	private $fkAddedBy = 'manufacturerLDAddedBy';
 	private $fkUpdatedBy = 'manufacturerLDUpdatedBy';
 	private $fkLang = 'manufacturerLDlang';

    
    public function up()
    {
    	$this->dropColumn($this->tableName, 'fullName');
    	echo "Column fullName is dropped from $this->tableName.\n";
    	$this->dropColumn($this->tableName, 'shortName');
    	echo "Column shortName is dropped from $this->tableName.\n";
    	$this->dropColumn($this->tableName, 'description');
    	echo "Column description is dropped from $this->tableName.\n";

    	// [
    	// 	'id' => 'INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
    	// 	'fullName' => 'VARCHAR(150)',
    	// 	'shortName' => 'VARCHAR(30)',
    	// 	'url' => 'VARCHAR(255)',
    	// 	'description' => 'TEXT',
    	// 	'addedBy' => 'SMALLINT(5) unsigned',
    	// 	'creationTime' => 'DATETIME NOT NULL',
    	// 	'updatedBy' => 'SMALLINT(5) unsigned DEFAULT NULL',
    	// 	'updateTime' => 'DATETIME DEFAULT NULL',
    	// ]);


    	$this->createTable($this->tableNameLD, [
    		'id' => 'INT(6) UNSIGNED NOT NULL',
    		'attr' => 'VARCHAR(30)', // name of the attribute (e.g. "fullName", "description" )
    		'lang' => 'INT(3) UNSIGNED NOT NULL',
    		'value' => 'TEXT',
    		'addedBy' => 'SMALLINT(5) unsigned',
    		'creationTime' => 'DATETIME NOT NULL',
    		'updatedBy' => 'SMALLINT(5) unsigned DEFAULT NULL',
    		'updateTime' => 'DATETIME DEFAULT NULL',
    		]);
    	echo "Table $this->tableName is created.\n";
    	$this->addForeignKey($this->fkAddedBy, $this->tableNameLD, 'addedBy', 
    		'teresa_admin', 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkAddedBy is added to $this->tableNameLD.\n";
    	$this->addForeignKey($this->fkUpdatedBy, $this->tableNameLD, 'updatedBy', 
    		'teresa_admin', 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkUpdatedBy is added to $this->tableNameLD.\n";
    	$this->addForeignKey($this->fkLang, $this->tableNameLD, 'lang', 
    		'teresa_lang', 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkLang is added to $this->tableNameLD.\n";
    }

    public function down()
    {
    	$this->dropForeignKey($this->fkLang, $this->tableNameLD);
    	echo "Foreign key $this->fkLang is dropped from $this->tableNameLD.\n";
    	$this->dropForeignKey($this->fkUpdatedBy, $this->tableNameLD);
    	echo "Foreign key $this->fkUpdatedBy is dropped from $this->tableNameLD.\n";
    	$this->dropForeignKey($this->fkAddedBy, $this->tableNameLD);
    	echo "Foreign key $this->fkAddedBy is dropped from $this->tableNameLD.\n";

    	$this->dropTable($this->tableNameLD);
    	echo "Table $this->tableNameLD is dropped.\n";

    	$this->addColumn($this->tableName, 'description', 'TEXT');
    	echo "Column description is added $this->tableName.\n";

    	$this->addColumn($this->tableName, 'shortName', 'VARCHAR(30)');
    	echo "Column shortName is added $this->tableName.\n";

    	$this->addColumn($this->tableName, 'fullName', 'VARCHAR(150)');
    	echo "Column fullName is added $this->tableName.\n";

        return true;
    }
}
