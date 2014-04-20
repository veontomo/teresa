<?php

use yii\db\Schema;

class m140420_170156_feed_lang extends \yii\db\Migration
{
    private $table = 'teresa_lang';
    public function up()
    {
    	$this->insert($this->table, [
			'name' => 'ru',
			'description' => 'русский',
			'charset' => 'utf-8',
			'status' => 'default', // default, disabled etc
			// value to use in html with "lang" attribute
			'lang' => 'ru',   
			'creationTime' =>  date('Y-m-d H:i:s')
		]);
    	$this->insert($this->table, [
			'name' => 'ua',
			'description' => 'українська',
			'charset' => 'utf-8',
			// 'status' => '', // default, disabled etc
			// value to use in html with "lang" attribute
			'lang' => 'ua',   
			'creationTime' =>  date('Y-m-d H:i:s')
		]);
    	$this->insert($this->table, [
			'name' => 'it',
			'description' => 'italiano',
			'charset' => 'utf-8',
			// 'status' => '', // default, disabled etc
			// value to use in html with "lang" attribute
			'lang' => 'it',   
			'creationTime' =>  date('Y-m-d H:i:s')
		]);
    	$this->insert($this->table, [
			'name' => 'en',
			'description' => 'english',
			'charset' => 'utf-8',
			// 'status' => '', // default, disabled etc
			// value to use in html with "lang" attribute
			'lang' => 'en',   
			'creationTime' =>  date('Y-m-d H:i:s')
		]);
		echo "Ru, ua, it and en are added into $this->table.\n";

    }

    public function down()
    {
        $this->delete($this->table, 'name = :en', [':en' => 'en']);
        $this->delete($this->table, 'name = :it', [':it' => 'it']);
        $this->delete($this->table, 'name = :ua', [':ua' => 'ua']);
        $this->delete($this->table, 'name = :ru', [':ru' => 'ru']);
        echo "En, it, ua and ru are deleted from $this->table.\n";

        return true;
    }
}
