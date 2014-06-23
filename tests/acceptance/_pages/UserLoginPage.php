<?php

class UserLoginPage
{
    // include url of current page
    static $URL = '/user';
    static $usernameField = '#user-login input[name=name]';
    static $passwordField = '#user-login input[name=pass]';
    static $loginButton = "#user-login input[type=submit]";

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
     public static function route($param)
     {
        return static::$URL.$param;
     }

    /**
     * @var AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    /**
     * @return UserLoginPage
     */
    public static function of(AcceptanceTester $I)
    {
        return new static($I);
    }
}