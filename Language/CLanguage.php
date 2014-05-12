<?php

namespace Foiki\Language;

/**
 * A simple mutli-language class
 *
 * @version 1.0.0
 * @author Jonatan Karlsson
 *
 **/
class CLanguage
{
    protected $lang;
    protected $saveType;
    protected $options;

    /**
     * 
     * @param array $options
     * @param string $saveType 
     */
    public function __construct($options, $saveType = 'session')
    {
        $this->options = $options;

        $this->saveType = $saveType;
        $this->setLang($this->options['default']['lang']);
    }

    /**
     * Gets the value based on $key
     *
     * @param  $key
     *
     * @return String based on $key
     */
    public function get($key) 
    {
        $var = $this->options['paths'][$key];
        $default = $this->getDefault($key);
        if (isset($var)) {
            $var = str_replace('$1', $this->getLang(), $var);
            return file_get_contents($var);
        } 
        return $this->getDefault($key);
    }

    /**
     * Gets the language sat
     * @return $lang
     */
    public function getLang() 
    {
        if ($this->saveType != 'session') {
            return $this->lang;
        }
        return $_SESSION['lang']; 
    }

    /**
     * Sets the language
     * @param string $lang
     */
    public function setLang($lang)
    {        
        if ($this->saveType != 'session') {
            $this->lang = $lang;
        } else {
            $_SESSION['lang'] = $lang;
        }
    } 

    /**
     * Gets the default value based on $key
     *
     * @param  $key
     *
     * @return String based on $key
     */
    public function getDefault($key)
    {
        if (isset($key, $this->options)) {
            return file_get_contents($this->options['default'][$key]);
        } else {
            throw new \Exception("Didn't find {$key}");
        } 
    }

    /**
     * gets the navbar
     * @return Array with for the navbarconfig
     */
    public function getNavbar() 
    {
        if (isset($this->options['paths']['navbar'])) {
            return str_replace('$1', $this->getLang(), $this->options['paths']['navbar']);
        } else {
            return $this->options['default']['navbar'];
        }
    }

    /**
     *  Gets metaname content
     * 
     *  @param $key the metaname
     *
     *  @return Content based on $key
     */
    public function getMeta($key, $lang = null) 
    {
        if (isset($this->options['meta'][$this->getLang()][$key])) {
            return $this->options['meta'][$this->getLang()][$key];
        } else if (isset($this->options['meta'][$lang][$key])) {
            return $this->options['meta'][$lang][$key];
        }
        return $this->options['default'][$key];   
    }
}
