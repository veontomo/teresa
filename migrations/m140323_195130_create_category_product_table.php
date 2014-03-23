<?php

use yii\db\Schema;

class m140323_195130_create_category_product_table extends \yii\db\Migration
{
    private $tableName = 'teresa_category_product';
    private $fkCategoryId = 'categoryIdOfProduct';
    private $fkProductId = 'productIdOfCategory';
    private $fkAddedBy = 'categoryProductAddedBy';
    private $fkUpdatedBy = 'categoryProductUpdatedBy';

    public function up()
    {
    	$this->createTable($this->tableName, [
    		'category_id' => 'SMALLINT(5) UNSIGNED',
    		'product_id' =>  'INT(11) UNSIGNED UNSIGNED',
    		'addedBy' => 'SMALLINT(5) UNSIGNED',
    		'creationTime' => 'DATETIME NOT NULL',
    		'updatedBy' => 'SMALLINT(5) UNSIGNED DEFAULT NULL',
    		'updateTime' => 'DATETIME DEFAULT NULL',
    		'PRIMARY KEY (`category_id`, `product_id`)'
    	]);
    	echo "Table " . $this->tableName . " is created.\n";
    	$this->addForeignKey($this->fkCategoryId, $this->tableName, 'category_id', 
    		'teresa_category', 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkCategoryId is added to $this->tableName.\n";
    	$this->addForeignKey($this->fkProductId, $this->tableName, 'product_id', 
    		'teresa_product', 'id', 'restrict', 'cascade');
    	echo "Foreign key $this->fkProductId is added to $this->tableName.\n";
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
		$this->dropForeignKey($this->fkProductId, $this->tableName);
		echo "Foreign key $this->fkProductId is dropped from $this->tableName.\n";
		$this->dropForeignKey($this->fkCategoryId, $this->tableName);
		echo "Foreign key $this->fkCategoryId is dropped from $this->tableName.\n";
		$this->dropTable($this->tableName);
		echo "Table $this->tableName is dropped.\n";
		return true;
    }
}
