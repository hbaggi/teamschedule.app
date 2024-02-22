<?php

$ob_main = $setting['main'];
$main = json_decode($ob_main, true);

$ob_theme = $setting['theme'];
$theme = json_decode($ob_theme, true);

$ob_twitter_og = $setting['twitter_og'];
$twitter_og = json_decode($ob_twitter_og, true);

$area = explode('/', $viewName)[0];

switch ($area) {
    case 'signin':
        $this->loadViewInTemplate($viewName, $viewData);
        break;

    case 'signup':
        $this->loadViewInTemplate($viewName, $viewData);
        break;

    case 'recovery':
        $this->loadViewInTemplate($viewName, $viewData);
        break;

    case 'verify':
        $this->loadViewInTemplate($viewName, $viewData);
        break;

    case 'notfound':
        $this->loadViewInTemplate($viewName, $viewData);
        break;

    default:
        require_once(__DIR__ . '/partials/header.php');
        require_once(__DIR__ . '/partials/navbar.php');
        require_once(__DIR__ . '/partials/main-sidebar.php');
        $this->loadViewInTemplate($viewName, $viewData);
        require_once(__DIR__ . '/partials/footer.php');
        break;
}
