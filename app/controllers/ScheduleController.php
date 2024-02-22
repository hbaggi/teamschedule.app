<?php

/**
 * Projeto Agenda PHP PDO MVC.
 *
 * @author Lázaro Baggi
 * @copyright CTI SAEB - SECRETARIA DA ADMINISTRAÇÃO All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.git
 * 
 * 
 */

class ScheduleController extends Controller
{
    public function index()
    {
        $data = array();
        $data['page'] = 'Agenda';
        $user_id = $_SESSION['user_id'];

        // ########################################################################

        $class_settings = new Settings();
        $data['setting'] = $class_settings->getSettings();

        $class_language = new Languages();
        $data['language'] = $class_language->getLanguage();

        $class_auth = new Authentication();
        $class_auth->requireLoggedInAndVerified();

        $class_user = new User();
        $data['user'] = $class_user->getUser($user_id);

        // ########################################################################

        $class_event = new Schedule();
        $data['events'] = $class_event->getEvents();

        $data['events_user'] = $class_event->getEventsByUserID($user_id);


        require_once(__DIR__ . '/receivers/schedule-create.php');
        require_once(__DIR__ . '/receivers/schedule-edit.php');
        require_once(__DIR__ . '/receivers/schedule-delete.php');

        $this->loadTemplate('schedule/index', $data);
    }
}
