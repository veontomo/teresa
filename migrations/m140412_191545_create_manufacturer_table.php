<?php

use yii\db\Schema;

class m140412_191545_create_manufacturer_table extends \yii\db\Migration
{
	private $name   = 'teresa_manufacturer';   // core table name
	private $attrs  = 'teresa_manufacturer_attrs';      // table name for language-dependent attributes
	private $values = 'teresa_manufacturer_values';     // table name for language-dependent values
	private $lang   = 'teresa_lang'; 	                // name of language table


	private $fkAddedBy = 'manufacturer_addedBy';
	private $fkUpdatedBy = 'manufacturer_updatedBy';
	private $fkValuesAddedBy = 'manufacturer_values_addedBy';
	private $fkValuesUpdatedBy = 'manufacturer_values_updatedBy';
	private $fkLang = 'manufacturer_values_lang';
	private $fkAttr = 'manufacturer_values_attrs';
	private $fkToCore = 'manufacturer_values_to_core'; 

	public function up()
	{
		$this->createTable($this->name, [
			'id'  => 'INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'url' => 'VARCHAR(255)',
			'addedBy' => 'SMALLINT(5) unsigned',
			'creationTime' => 'DATETIME NOT NULL',
			'updatedBy'  => 'SMALLINT(5) unsigned DEFAULT NULL',
			'updateTime' => 'DATETIME DEFAULT NULL',
		]);
		echo "Table $this->name is created.\n";
		$this->addForeignKey($this->fkAddedBy, $this->name, 'addedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkAddedBy is added to $this->name.\n";
		$this->addForeignKey($this->fkUpdatedBy, $this->name, 'updatedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkUpdatedBy is added to $this->name.\n";


		// table that stores the names of the attributes that depend on language
		$this->createTable($this->attrs, [
			'attribute' => 'VARCHAR(20) NOT NULL PRIMARY KEY'
		]);
		echo "Table $this->attrs is created.\n";
		// populating the table with attributes which values depend on language 
		$this->insert($this->attrs, ['attribute' => 'fullName']);
		echo "\"fullName\" is inserted in $this->attrs.\n";
		$this->insert($this->attrs, ['attribute' => 'shortName']);
		echo "\"shortName\" is inserted in $this->attrs.\n";
		$this->insert($this->attrs, ['attribute' => 'description']);
		echo "\"description\" is inserted in $this->attrs.\n";

		// creating table that stores language-dependent values 
		$this->createTable($this->values, [
			'id' => 'INT(6) UNSIGNED NOT NULL',   // bound to "id" of the core table record
			'attribute' => 'VARCHAR(20)',         // bound to "attribute" of the attribute table names
			'lang' => 'INT(3) UNSIGNED NOT NULL', // bound to values from language table
			'value' => 'TEXT',
			'addedBy' => 'SMALLINT(5) unsigned',
			'creationTime' => 'DATETIME NOT NULL',
			'updatedBy' => 'SMALLINT(5) unsigned DEFAULT NULL',
			'updateTime' => 'DATETIME DEFAULT NULL',
			'PRIMARY KEY (`id`, `attribute`, `lang`)'
			]);
		echo "Table $this->values is created.\n";

		$this->addForeignKey($this->fkValuesAddedBy, $this->values, 'addedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkAddedBy is added to $this->values.\n";

		$this->addForeignKey($this->fkValuesUpdatedBy, $this->values, 'updatedBy', 
			'teresa_admin', 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkUpdatedBy is added to $this->values.\n";

		$this->addForeignKey($this->fkLang, $this->values, 'lang', 
			$this->lang, 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkLang is added to $this->values.\n";

		$this->addForeignKey($this->fkAttr, $this->values, 'attribute', 
			$this->attrs, 'attribute', 'restrict', 'cascade');
		echo "Foreign key $this->fkAttr is added to $this->values.\n";

		$this->addForeignKey($this->fkToCore, $this->values, 'id', 
			$this->name, 'id', 'restrict', 'cascade');
		echo "Foreign key $this->fkToCore is added to $this->values.\n";
	}

	public function down()
	{
		$this->dropForeignKey($this->fkToCore, $this->values);
		echo "Foreign key $this->fkToCore is dropped from $this->values.\n";

		$this->dropForeignKey($this->fkAttr, $this->values);
		echo "Foreign key $this->fkAttr is dropped from $this->values.\n";

		$this->dropForeignKey($this->fkLang, $this->values);
		echo "Foreign key $this->fkLang is dropped from $this->values.\n";

		$this->dropForeignKey($this->fkValuesUpdatedBy, $this->values);
		echo "Foreign key $this->fkUpdatedBy is dropped from $this->values.\n";

		$this->dropForeignKey($this->fkValuesAddedBy, $this->values);
		echo "Foreign key $this->fkAddedBy is dropped from $this->values.\n";

		$this->dropTable($this->values);
		echo "Table  $this->values is dropped.\n";

		$this->dropTable($this->attrs);
		echo "Table  $this->attrs is dropped.\n";

		$this->dropForeignKey($this->fkUpdatedBy, $this->name);
		echo "Foreign key $this->fkUpdatedBy is droped from $this->name.\n";

		$this->dropForeignKey($this->fkAddedBy, $this->name);
		echo "Foreign key $this->fkAddedBy is dropped from $this->name.\n";

		$this->dropTable($this->name);
		echo "Table  $this->name is dropped.\n";

		return true;
	}
}
