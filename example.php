<?php
require __DIR__.'/config.php';

$app->withSession();

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
// landing page. Select lang.
$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Kikwall.com | Your gateway to new friends");

    // här hämtar vi vilket språk som anv vill kolla på
    // (något fint formulär här)
    $form = $app->form;

    $form = $form->create(
        [
            'id' => '',
        ],
        [
            'lang' => [
                'type' => 'select',
                'label' => 'Select language',
                // @TODO add more options
                'options' => [
                    'sv' => 'Svenska',
                    'en' => 'Eng',
                ],
                'value' => '',
                'required' => true,
                // @TODO Look one more time here... Do I need it?
                'validation' => [
                    'not_empty'
                ],
            ],
            'submit' => [
                'type' => 'submit',
                'callback' => function($form) use($app) {
                    $app->session->set('lang',
                    $form->value('lang'));
                    return true;
                }
            ],
    ]);

    $app->views->add('kikwall/page',[
        'info' => '',
        'form' => $form->getHTML(),
    ]);

    $status = $form->check();

    if ($status === true) {
        // magic setter
        $app->lang->lang = $app->session->get('lang');

        $app->session->remove('lang');

        $url = $app->url->create($app->url->baseUrl . '/' . $app->lang->lang .'/');
        $app->response->redirect($url);
    }
});

// landing swe page
$app->router->add('sv', function () use ($app) {
    // TODO add a nice title
    $app->theme->setTitle("Kikwall");
    $app->lang->lang = 'sv';

    // Tells the page to look at kikController
    $app->dispatcher->forward([
        'controller' => 'kik',
        'action' => 'index',
    ]);

// I controller (pil ner)
    // magic getter. it gets the about field in the class lang
    // när jag kallar getAbout() så går lang in app/content/sv/about.php
    //$app->lang->getAbout();
    // same as above
    //$app->lang->getContent();
});

// norge page
$app->router->add('no', function () use ($app) {
    // TODO add same shit as sv
});

// fi page
$app->router->add('fi', function () use ($app) {
    // TODO add same shit as sv
});

// Enge page
$app->router->add('en', function () use ($app) {
    // TODO add same shit as sv

    $app->theme->setTitle("Kikwall");
    $app->lang->lang = 'en';

    // Tells the page to look at kikController
    $app->dispatcher->forward([
        'controller' => 'kik',
        'action' => 'index',
    ]);
});

$app->router->handle();
$app->theme->render();

