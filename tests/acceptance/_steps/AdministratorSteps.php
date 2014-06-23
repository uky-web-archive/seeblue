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

    function logout()
    {
        $I = $this;
        $I->amOnPage("/user/logout");
    }


}