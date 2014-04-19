<?php

use yii\db\Schema;

class m140419_190837_add_admin extends \yii\db\Migration
{
    private $tableName = 'teresa_admin';
    private $userLoginName = 'admin';
    private $userName = 'Mario';
    public function up()
    {
        $hash = password_hash('admin_pass', PASSWORD_DEFAULT);
        $time = date('Y-m-d H:i:s');
        $admin = new app\models\Admin();
    	$this->insert($this->tableName, [
    		'name' => $this->userName,
    		'loginName' => $this->userLoginName,
    		'creationTime' => $time,
    		'role' => $admin::ROLE_ROOT,
            'hash' => $hash]
    	);
    	echo "User $this->userName is inserted into table $this->tableName\n";
    }

    public function down()
    {
		$this->delete($this->tableName, 'loginName = :loginName', [':loginName' => $this->userLoginName]);
		echo "User $this->userName is deleted from table $this->tableName\n";
    }
}
