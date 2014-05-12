
CLanguage
=========

A simple multi-language class.


Installation 
------------

This guide is based on that you have Anax-mvc installed. 
This is not required but if you want to follow my examples you need it.

0 Clone Anax-mvc: [http://github.com/mosbth/Anax-mvc](http://github.com/mosbth/Anax-mvc)


1 Copy the config-file to `Anax-mvc/app/config`
```
cp config/config_language.php  ~/Anax-mvc/app/config/
```

2 Add CLanguge as a service to Anax in `CDIFactory*`
```
$this->setShared('lang', function() {
      $conf = require ANAX_APP_PATH . 'config/config_language.php';
      $lang = new \Foiki\Language\CLanguage($conf);
      return $lang;
  });   
```

3 Copy the example-front-controller  
```
cp example.php ~/Anax-mvc/webroot/example.php
```

4 Copy the theme-template to `thene/(theme-name)/`
```
cp theme/index.tpl.php ~/Anax-mvc/theme/anax-grid/index.tpl.php
```

5 Copy the example-content to `app/content`
```
cp -R content/ ~/Anax-mvc/app/content/
```

*Done*


License 
------------------

This software is free software and carries a MIT license.


History
-----------------------------------

1.0.0 (2014-05-12)

* First release after initial article.

----------------------------------------------------------------------

Copyright (c) 2014 - 2015 Jonatan Karlsson, me@jonatankarlsson.se
