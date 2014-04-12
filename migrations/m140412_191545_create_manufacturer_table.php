<?php

use yii\db\Schema;

class m140412_191545_create_manufacturer_table extends \yii\db\Migration
{
	private $tableName = 'teresa_manufacturer';
	private $tableNameAttrs = 'teresa_manufacturer_LDA'; // table that contains names of language-dependent attributes
	private $tableNameLD = 'teresa_manufacturer_LD';     // table that contains language-dependent data
	private $tableLang = 'teresa_lang'; 

	private $fkAddedBy = 'manufacturerAddedBy';
	private $fkUpdatedBy = 'manufacturerUpdatedBy';
	private $fkLDAddedBy = 'manufacturerLDAddedBy';
	private $fkLDUpdatedBy = 'manufacturerLDUpdatedBy';
	private $fkLang = 'manufacturerLDlang';
	private $fkAttr = 'manufacturerLDAttrs';
	private $fkToMain = 'manufacturerLDToMain'; 


	public function up()
	{
		$this->createTable($this->tableName, [
			'id' => 'INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			// 'fullName' => 'VARCHAR(150)',
			// 'shortName' => 'VARCHAR(30)',
			'url' => 'VARCHAR(255)',
			// 'description' => 'TEXT',
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


		// table that stores the names of the attributes that depend on language
		$this->createTable($this->tableNameAttrs, [
			'attribute' => 'VARCHAR(20) NOT NULL PRIMARY KEY'
		]);
		echo "Table $this->tableNameAttrs is created.\n";
		// populating the table with attributes which values depend on language 
		$this->insert($this->tableNameAttrs, ['attribute' => 'fullName']);
		echo "\"fullName\" is inserted in $this->tableName.\n";
		$this->insert($this->tableNameAttrs, ['attribute' => 'shortName']);
		echo "\"shortName\" is inserted in $this->tableName.\n";
		$this->insert($this->tableNameAttrs, ['attribute' => 'description']);
		echo "\"description\" is inserted in $this->tableName.\n";

		// creating table that stores language-dependent values 
		$this->createTable($this->tableNameLD, [
			'id' => 'INT(6) UNSIGNED NOT NULL', // bound to "id" of language-independent table record
			'attribute' => 'VARCHAR(20)',            // bound to "attributes" of table with attribute names
			'lang' => 'INT(3) UNSIGNED NOT NULL', // bound to values from language table
			'value' => 'TEXT',
			'addedBy' => 'SMALLINT(5) unsigned',
			'creationTime' => 'DATETIME NOT NULL',
			'updatedBy' => 'SMALLINT(5) unsigned DEFAULT NULL',
			'updateTime' => 'DATETIME DEFAULT NULL',
			'PRIMARY KEY (`id`, `attribute`, `lang`)'
			]);
		echo "Table $this->tableNameLD is created.\n";

		$this->addForeignKey($this->fkLDAddedBy, $this->tableNameLD, 'addedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkAddedBy is added to $this->tableNameLD.\n";

		$this->addForeignKey($this->fkLDUpdatedBy, $this->tableNameLD, 'updatedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkUpdatedBy is added to $this->tableNameLD.\n";

		$this->addForeignKey($this->fkLang, $this->tableNameLD, 'lang', 
			'teresa_lang', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkLang is added to $this->tableNameLD.\n";

		$this->addForeignKey($this->fkAttr, $this->tableNameLD, 'attribute', 
			$this->tableNameAttrs, 'attribute', 'restrict', 'cascade');
		echo "Foreign key $this->fkAttr is added to $this->tableNameLD.\n";

		$this->addForeignKey($this->fkToMain, $this->tableNameLD, 'id', 
			$this->tableName, 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkToMain is added to $this->tableNameLD.\n";
	}

	public function down()
	{
		$this->dropForeignKey($this->fkToMain, $this->tableNameLD);
		echo "Foreign key $this->fkToMain is dropped from $this->tableNameLD.\n";

		$this->dropForeignKey($this->fkAttr, $this->tableNameLD);
		echo "Foreign key $this->fkAttr is dropped from $this->tableNameLD.\n";

		$this->dropForeignKey($this->fkLang, $this->tableNameLD);
		echo "Foreign key $this->fkLang is dropped from $this->tableNameLD.\n";

		$this->dropForeignKey($this->fkLDUpdatedBy, $this->tableNameLD);
		echo "Foreign key $this->fkUpdatedBy is dropped from $this->tableName.\n";

		$this->dropForeignKey($this->fkLDAddedBy, $this->tableNameLD);
		echo "Foreign key $this->fkAddedBy is dropped from $this->tableName.\n";


		$this->dropTable($this->tableNameLD);
		echo "Table  $this->tableNameLD is dropped.\n";

		$this->dropTable($this->tableNameAttrs);
		echo "Table  $this->tableNameAttrs is dropped.\n";

		$this->dropForeignKey($this->fkUpdatedBy, $this->tableName);
		echo "Foreign key $this->fkUpdatedBy is droped from $this->tableName.\n";


		$this->dropForeignKey($this->fkAddedBy, $this->tableName);
		echo "Foreign key $this->fkAddedBy is dropped from $this->tableName.\n";


		$this->dropTable($this->tableName);
		echo "Table  $this->tableName is dropped.\n";

		return true;
	}

}
