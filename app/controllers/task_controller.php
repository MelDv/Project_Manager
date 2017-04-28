<?php

class TaskController extends BaseController {

    //omattehtavat listaussivu
    public static function index() {
        self::check_logged_in();
        $user = self::get_user_logged_in();
        $id = $user->id;
        $task_count = WorkersTasks::count($id);

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

        $own_projects = Project::findByManager($id);

        $tasks = Task::myActiveTasks($page, $page_size, $id);
        View::make('/projektit/omattehtavat.html', array('own_projects' => $own_projects, 'pages' => $pages, 'page' => $page, 'prev_page' => $prev_page,
            'next_page' => $next_page, 'page_size' => $page_size, 'tasks' => $tasks));
    }

    //tehtava esittelysivu
    public static function tehtava($pid, $id) {
        self::check_logged_in();
        $task = Task::find($pid, $id);
        $workers = WorkersTasks::findWorkersByTask($id);
        $names = array();

        for ($x = 0; $x < count($workers); $x++) {
            $person_id = $workers[$x];
            $person_name = Person::findName($person_id);
            $names[] = array(
                'person_id' => $person_id,
                'person_name' => $person_name);
        }

        View::make('/projektit/tehtava.html', array('task' => $task, 'names' => $names));
    }

    //post
    public static function lisaauusi($pid) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'project' => $pid,
            'name' => $params['name'],
            'description' => $params['description'],
            'start_date' => $params['start_date'],
            'deadline' => $params['deadline'],
            'current_status' => 'pending'
        );

//        Kint::dump($params);
        $task = new Task($attributes);
        $errors = $task->errors();
        if (Task::nameExists($params['name'])) {
            $errors[] = 'Nimi on jo käytössä. Valitse uusi nimi.';
        }
        if (count($errors) == 0) {
            $task->save();
            Redirect::to('/projektit/' . $pid . '/tehtava/' . $task->id, array('message' => 'Tehtävän ' . $task->name . ' lisääminen onnistui.'));
        } else {
            array_unshift($errors, 'Antamissasi tiedoissa oli virheitä. ');
            View::make('/projektit/muokkaa_tehtava.html', array('errors' => $errors, 'task' => $task, 'pid' => $pid));
        }
    }

    //get
    public static function lisaa($pid) {
        self::check_logged_in();
        $project_name = Project::findName($pid);
        View::make('/projektit/muokkaa_tehtava.html', array('pid' => $pid, 'project_name' => $project_name));
    }

    //get
    public static function muokkaa($pid, $id) {
        self::check_logged_in();
        $task = Task::find($pid, $id);
        View::make('projektit/muokkaa_tehtava.html', array('pid' => $pid, 'task' => $task));
    }

    //post
    public static function muokkaatehtava($pid, $id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'project' => $pid,
            'name' => $params['name'],
            'current_status' => $params['current_status'],
            'description' => $params['description'],
            'start_date' => $params['start_date'],
            'deadline' => $params['deadline']
        );

        $task = new Task($attributes);
        $errors = $task->errors();
        if (count($errors) == 0) {
            $task->update();
            Redirect::to('/projektit/' . $pid . '/tehtava/' . $id, array('message' => 'Tehtävän ' . $task->name . ' tiedot päivitettiin.'));
        } else {
            array_unshift($errors, 'Antamissasi tiedoissa oli virheitä. ');
            View::make('/projektit/muokkaa_tehtava.html', array('errors' => $errors, 'task' => $task));
        }
    }

    public static function poista($pid, $id) {
        self::check_logged_in();
        $name = Task::findName($id);
        $task = new Task(array('id' => $id));
        $task->destroy($id);
        Redirect::to('/projektit/' . $pid, array('message' => 'Tehtävä ' . $name . ' poistettiin'));
    }

    public static function valmis($id) {
        $task = new Task(array('id' => $id));
        $task->ready($id);
        Redirect::to('/projektit/omattehtavat', array('message' => 'Tehtävä merkittiin valmiiksi'));
    }

    public static function hylkaa($pid, $id) {
        Task::reassign($id);
        Redirect::to('/projektit/' . $pid . '/tehtava/' . $id, array('message' => 'Tehtävä palautettiin keskeneräiseksi'));
    }

    public static function hyvaksy($pid, $id) {
        Task::approve($id);
        Redirect::to('/projektit/' . $pid . '/tehtava/' . $id, array('message' => 'Tehtävä on nyt hyväksytty'));
    }

}
