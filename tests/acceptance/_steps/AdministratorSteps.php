<?php
namespace AcceptanceTester;

class AdministratorSteps extends \AcceptanceTester
{
    function login($name, $password)
    {
        $I = $this;
        $I->amOnPage(\UserLoginPage::$URL);
        $I->fillField(\UserLoginPage::$usernameField, $name);
        $I->fillField(\UserLoginPage::$passwordField, $password);
        $I->click(\UserLoginPage::$loginButton);
    }   


    function activateTheme($themeName)
    {
    	$I = $this;
		//$I->login('admin','admin');
		$I->amOnPage('/admin/appearance');
		$I->click('//a[@title="Enable '. $themeName .' as default theme"]');

    }

    function logout()
    {
        $I = $this;
        $I->amOnPage("/user/logout");
    }


}