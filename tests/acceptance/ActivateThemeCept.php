<?php 
$I = new AcceptanceTester\AdministratorSteps($scenario);
$I->wantTo('activate the seeblue theme.');
$I->login('admin','admin');
$I->amOnPage('/admin/appearance');
$I->click('//a[@title="Enable seeblue as default theme"]');
$I->see("seeblue is now the default theme.");
