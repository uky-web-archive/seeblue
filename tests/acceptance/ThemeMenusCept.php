<?php 
$I = new AcceptanceTester\AdministratorSteps($scenario);
$I->wantTo('Render menus without triggering a variable pass by reference strict warning.');
$I->login('admin','admin');
$I->activateTheme('seeblue');
$I->amOnPage('/');
$I->amOnPage('/');
$I->dontSee("Strict warning: Only variables should be passed by reference in include() ");
