<?php
require __DIR__.'/config.php';

$app->withSession();

$app->router->add('lang', function () use ($app) {
    $lang = $app->request->getGet('lang');
    $app->lang->setLang($lang);
    
    $app->navbar->configure($app->lang->getNavbar());

    $app->theme->setTitle($app->lang->getlang() . " page ");

    $content = $app->lang->get('about');

    $de = $app->url->create('lang?lang=de');
    $sv = $app->url->create('lang?lang=sv');
    $en = $app->url->create('lang?lang=en');
    $default = $app->url->create('lang');

    $sidebar = 
    "<li><a href='{$sv}'>Swe</a></li>
    <li><a href='{$en}'>English</a></li>
    <li><a href='{$de}'>Deutsch</a></li>
    <li><a href='{$default}'>default</a></li>
    ";

    $app->views->addString($content, 'main')
               ->addString($sidebar, 'sidebar');
});

$app->router->handle();
$app->theme->render();


