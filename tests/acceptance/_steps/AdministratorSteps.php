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
		$I->amOnPage('/admin/appearance');
		$I->click('//a[@title="Enable '. $themeName .' as default theme"]');

    }

    function addNode($contentType, $data){
    	//Simple, doesn't handle special fields
    	$I = $this;
		$I->amOnPage('/node/add/'.$contentType);
		foreach ($data as $fieldName => $value ){
			$I->fillField("#".$fieldName, $value);
		}
		$I->click("#edit-submit");
    }

    function logout()
    {
        $I = $this;
        $I->amOnPage("/user/logout");
    }


}