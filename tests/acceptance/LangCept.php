<?php

use tests\_pages\LoginPage;


	$I = new WebGuy($scenario);
	$I->wantTo('manage languages');

	$loginPage = LoginPage::openBy($I);

	$I->amGoingTo('connect to the page as non-authenticated user');
	$I->amOnPage('/web/index-test.php?r=lang');
	$I->dontSee('Language', 'h1');
	$I->see('Login');

	$I->amGoingTo('login');
	$loginPage->login('admin', 'admin_pass');
	if (method_exists($I, 'wait')) {
	    $I->wait(3); // only for selenium
	}
	$I->see('Logout (admin)');

	$I->amGoingTo('see the page as authenticated user');
	$I->amOnPage('/web/index-test.php?r=lang');
	$I->dontSee('Language', 'h1');
	$I->see('english');
	$I->see('italiano');
	$I->see('українська');
	$I->see('русский');
