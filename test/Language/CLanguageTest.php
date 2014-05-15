<?php
namespace Foiki\Language;


define('ANAX_APP_PATH', __DIR__ . '/../../');


/**
 * 
 */ 
class CLanguageTest extends \PHPUnit_Framework_TestCase
{    

    public function setup()
    {
        $conf = require __DIR__ . '/config_language_test.php';
        $this->language = new \Foiki\Language\CLanguage($conf);
    }

    public function testDefaultLang() 
    {
        $lang = $this->language->getDefault('lang');
        $exp = "sv";
        $this->assertEquals($exp, $lang);
    }

    public function testSetGetLang() 
    {
        $this->language->setLang('en');
        $p = $this->language->getLang();
        $exp = "en";
        $this->assertEquals($exp, $p);
    }

    public function testMeta() 
    {
        $p = $this->language->getMeta('keywords');
        $exp = "Svensk keywords";
        $this->assertEquals($exp, $p);
        $p = $this->language->getMeta('description');
        $exp = "Svensk description";
        $this->assertEquals($exp, $p);
        // changes the language
        $this->language->setLang('en');

        $p = $this->language->getMeta('keywords');
        $exp = "English keywords";
        $this->assertEquals($exp, $p);
        $p = $this->language->getMeta('description');
        $exp = "English description";
        $this->assertEquals($exp, $p);
        
        // Gets a specific keywords && description 
        $p = $this->language->getMeta('keywords', 'sv');
        $exp = "Svensk keywords";
        $this->assertEquals($exp, $p);
        $p = $this->language->getMeta('description', 'sv');
        $exp = "Svensk description";
        $this->assertEquals($exp, $p);
    }

    public function testGetNav()
    {
        $this->language->setLang('sv');   
        $arr = require $this->language->getNavbar();

        $exp = require __DIR__ . '/../../content/sv/navbar.php';

        sort($arr);
        sort($exp);

        $this->assertEquals(json_encode($exp), json_encode($arr));
    }

    public function testGet() 
    {
        $this->language->setLang('sv');

        $about = $this->language->get('about');
        $exp = "swe about\n";

        $this->assertEquals($exp, $about);        
    }
}
