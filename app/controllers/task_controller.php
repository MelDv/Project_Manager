<?php

class TaskController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $user = self::get_user_logged_in();
        $id = $user->id;
        $task_count = Task::count();

        $page_size = 10;
        $pages = ceil($task_count / $page_size);
        $page = (isset($_GET['page']) AND (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        $prev_page = $page - 1;
        $next_page = $page + 1;

        if ($prev_page < 1) {
            $prev_page = null;
        } elseif ($next_page > $pages) {
            $next_page = null;
        }

        $tasks = Task::myActiveTasks($page, $page_size, $id);
        View::make('projektit/omattehtavat.html', array('pages' => $pages, 'page' => $page, 'prev_page' => $prev_page,
            'next_page' => $next_page, 'page_size' => $page_size, 'tasks' => $tasks));
    }

    public static function tehtava($pid, $id) {
        self::check_logged_in();
        $task = Task::find($id, $pid);
        $workers = WorkersTasks::findWorkersByTask($id);
        $names = array();

        for ($x = 0; $x < count($workers); $x++) {
            $person_id = $workers[$x];
            $person_name = Person::findName($person_id);
            $names[] = array(
                'person_id' => $person_id,
                'person_name' => $person_name);
        }

        View::make('projektit/tehtava.html', array('task' => $task, 'names' => $names));
    }

    public static function lisaauusi() {
        self::check_logged_in();
        $pid = (isset($_GET['project']) AND (int) $_GET['project'] > 0) ? (int) $_GET['project'] : 1;
        View::make('projektit/uusitehtava.html', array('project_id' => $pid));
    }

    public static function lisaa() {
        self::check_logged_in();
        $pid = (isset($_GET['project']) AND (int) $_GET['project'] > 0) ? (int) $_GET['project'] : 1;
        View::make('projektit/uusitehtava.html', array('project_id' => $pid));
    }

    public static function muokkaa($id) {
        self::check_logged_in();
        View::make('projektit/muokkaatehtava.html');
    }

    public static function poista($id) {
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        $task->destroy($id);
        Redirect::to('/projektit/omattehtavat', array('message' => 'Tehtävä on poistettu'));
    }

    public static function valmis($id) {
        $task = new Task(array('id' => $id));
        $task->ready($id);
        Redirect::to('/projektit/omattehtavat', array('message' => 'Tehtävä merkittiin valmiiksi'));
    }

}
