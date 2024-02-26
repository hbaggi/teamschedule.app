<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
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
