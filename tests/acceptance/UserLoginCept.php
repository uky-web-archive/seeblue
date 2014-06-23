<?php 
$I = new AcceptanceTester\AdministratorSteps($scenario);
$I->wantTo('log in as an authenticated user.');
$I->login('admin','admin');
$I->see('Member for');
