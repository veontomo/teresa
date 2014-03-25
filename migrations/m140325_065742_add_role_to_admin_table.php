<?php

use yii\db\Schema;

class m140325_065742_add_role_to_admin_table extends \yii\db\Migration
{
	private $tableName = 'teresa_admin';
	private $columnName = 'role';

    public function up()
    {
    	$this->addColumn($this->tableName, $this->columnName, 'TINYINT');
    	echo "Column $this->columnName is added to the table $this->tableName.\n";
    }

    public function down()
    {
        $this->dropColumn($this->tableName, $this->columnName);
        return true;
    }
}
