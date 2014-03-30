<?php

use yii\db\Schema;

class m140325_124237_add_root_to_admin_table extends \yii\db\Migration
{
    private $tableName = 'teresa_admin';
    private $userLoginName = 'admin';
    private $userName = 'Mario';
    public function up()
    {
    	$salt = md5($this->userLoginName . date('d:s'));
        $hash = hash_hmac('sha256', 'admin', $salt);
        $admin = new app\models\Admin();
    	$this->insert($this->tableName, [
    		'name' => $this->userName,
    		'loginName' => $this->userLoginName,
    		'creationTime' => date('Y-m-d H:i:s'),
            'salt' => $salt,
    		'role' => $admin::ROLE_ROOT,
            'hash' => $hash]
    	);
    	echo "User $this->userName is inserted into table $this->tableName\n";
    }

    public function down()
    {
		$this->delete($this->tableName, 'loginName = :loginName', [':loginName' => $this->userName]);
		echo "User $this->userName is deleted from table $this->tableName\n";
    }
}
