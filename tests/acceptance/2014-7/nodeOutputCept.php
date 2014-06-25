<?php 
$scenario->group('2014-7');

$I = new AcceptanceTester\AdministratorSteps($scenario);
$I->wantTo('verify the output of titles on article node types');
$I->login('admin','admin');
$I->activateTheme('seeblue');
$I->addNode('article', Array('edit-title' => 'Test Title'));
$I->see("Test Title");

