<?php 
$scenario->group('2014-7');

$I = new AcceptanceTester\AdministratorSteps($scenario);
$I->wantTo('check for required footer text.');
$I->login('admin','admin');
$I->activateTheme('seeblue');
$I->amOnPage('/');
$I->see("University of Kentucky | Lexington, Kentucky 40506 | (859) 257-9000");
$I->see("An Equal Opportunity University | Mission Statement");

//TODO: check for the actual image source by getting the theme's path into the test somehow
$I->seeElement('//*[@id="footer"]//img[@alt="University of Kentucky"]');
$I->seeElement('//*[@id="footer"]//img[@alt="see blue."]');


