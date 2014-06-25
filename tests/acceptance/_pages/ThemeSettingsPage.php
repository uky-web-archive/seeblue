<?php

class ThemeSettingsPage
{
    // include url of current page
    static $URL = '/admin/appearance/settings/seeblue';
    static $headerTextfield = "#edit-site-description";
    static $headerBackground = "#edit-background-logo-select";

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
     * @return ThemeSettingsPage
     */
    public static function of(AcceptanceTester $I)
    {
        return new static($I);
    }
}