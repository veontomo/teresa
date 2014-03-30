<?php

use tests\_pages\LoginPage;

$I = new WebGuy($scenario);
$I->wantTo('ensure that login works');
$I->seeInDatabase('teresa_admin', ['loginName' => 'admin']);
// $name = $I->grabFromDatabase('teresa_admin', 'name', ['loginName' => 'admin']);
$loginPage = LoginPage::openBy($I);

$I->see('Login', 'h1');

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
$I->expectTo('see validations errors');
$I->see('Username cannot be blank.');

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin', 'wrong');
$I->expectTo('see validations errors');
$I->see('Incorrect username or password.');

$I->amGoingTo('try to login with correct credentials');
$loginPage->login('admin', 'admin');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('see user info');
$I->see('Logout (admin)');
