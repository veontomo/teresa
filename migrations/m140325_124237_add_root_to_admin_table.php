<?php

use yii\db\Schema;

class m140325_124237_add_root_to_admin_table extends \yii\db\Migration
{
    private $tableName = 'teresa_admin';
    private $userName = 'admin';
    public function up()
    {
    	$admin = new app\models\Admin();
    	$this->insert($this->tableName, [
    		'name' => 'Mario',
    		'loginName' => $this->userName,
    		'creationTime' => date('Y-m-d H:i:s') ,
    		'role' => $admin::ROLE_ROOT,
            'pswd' => 'admin']
    	);
    	echo "User $this->userName is inserted into table $this->tableName\n";
    }

    public function down()
    {
		$this->delete($this->tableName, 'loginName = :loginName', [':loginName' => $this->userName]);
		echo "User $this->userName is deleted from table $this->tableName\n";
    }
}
