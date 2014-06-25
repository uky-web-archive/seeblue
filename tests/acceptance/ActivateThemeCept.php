<?php 
$I = new AcceptanceTester\AdministratorSteps($scenario);
$I->wantTo('activate the seeblue theme.');
$I->login('admin','admin');
$I->activateTheme('seeblue');
$I->see("seeblue is now the default theme.");

