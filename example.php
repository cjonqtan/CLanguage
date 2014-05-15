<?php
/**
 * A example file based on anax-mvc
 */ 

// Creates the $di and $app-object
require __DIR__.'/config.php';

// Starts the session
$app->withSession();

// Creates a new router
$app->router->add('langauge', function () use ($app) {
    // Gets the ?lang value
    $lang = $app->request->getGet('lang');
    // Sets the langauge
    $app->lang->setLang($lang);
    // Configure the navbar with the new languate
    $app->navbar->configure($app->lang->getNavbar());
    // Adds a nice page, lol
    $app->theme->setTitle($app->lang->getlang() . " page ");
    // This is how you get some content. 
    $content = $app->lang->get('about');
    // Creates some urls for example 
    $de = $app->url->create('lang?lang=de');
    $sv = $app->url->create('lang?lang=sv');
    $en = $app->url->create('lang?lang=en');
    $default = $app->url->create('lang');
    // Sidebar content
    $sidebar = 
    "<li><a href='{$sv}'>Swe</a></li>
    <li><a href='{$en}'>English</a></li>
    <li><a href='{$de}'>Deutsch</a></li>
    <li><a href='{$default}'>default</a></li>
    ";
    // Adds a view
    $app->views->addString($content, 'main')
               ->addString($sidebar, 'sidebar');
});
// Handle the router
$app->router->handle();
// Render the theme
$app->theme->render();


