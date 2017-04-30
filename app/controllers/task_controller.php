<?php

class TaskController extends BaseController {

    //omattehtavat listaussivu
    public static function index() {
        self::check_logged_in();
        $user = self::get_user_logged_in();
        $id = $user->id;
        $task_count = WorkersTasks::countWorkersTasks($id);

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
        Task::late($id);
        $task = Task::find($pid, $id);
        $workers = WorkersTasks::findWorkersByTask($id);
        $names = array();
        //etsi aktiiviset työntekijät
        $person_temp = Person::findByActivity(TRUE);
        //poista listasta ne, jotka on jo kiinnitetty tähän tehtävään
        $persons = self::poistaTiimi($id, $person_temp);

        for ($x = 0; $x < count($workers); $x++) {
            $person_id = $workers[$x];
            $person_name = Person::findName($person_id);
            $names[] = array(
                'person_id' => $person_id,
                'person_name' => $person_name);
        }

        View::make('/projektit/tehtava.html', array('task' => $task, 'names' => $names, 'persons' => $persons));
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
        $persons = Person::findByActivity(TRUE);
        $errors = $task->errors();
        if (Task::nameExists($params['name'])) {
            $errors[] = 'Nimi on jo käytössä. Valitse uusi nimi.';
        }
        if (count($errors) == 0) {
            $task->save();
            self::luoWorkersTasks($task->id, $params['person']);
            Redirect::to('/projektit/' . $pid . '/tehtava/' . $task->id, array('message' => 'Tehtävän ' . $task->name . ' lisääminen onnistui.'));
        } else {
            array_unshift($errors, 'Antamissasi tiedoissa oli virheitä. ');
            View::make('/projektit/muokkaa_tehtava.html', array('errors' => $errors, 'task' => $task, 'pid' => $pid, 'persons' => $persons));
        }
    }

    //get
    public static function lisaa($pid) {
        self::check_logged_in();
        $project_name = Project::findName($pid);
        $persons = Person::findByActivity(TRUE);
        View::make('/projektit/muokkaa_tehtava.html', array('pid' => $pid, 'project_name' => $project_name, 'persons' => $persons));
    }

    //get
    public static function muokkaa($pid, $id) {
        self::check_logged_in();
        Task::late($id);
        $task = Task::find($pid, $id);
        View::make('projektit/muokkaa_tehtava.html', array('pid' => $pid, 'task' => $task));
    }

    public static function lisaatekija($pid, $id) {
        $params = $_POST;
        self::luoWorkersTasks($id, $params['person']);
        Redirect::to('/projektit/' . $pid . '/tehtava/' . $id, array('message' => 'Tiimiin lisättiin uusi jäsen!'));
    }

    public static function poistatekija($pid, $id) {
        $params = $_POST;
        $person_id = $params['person_id'];
        $person_name = $params['person_name'];
        $errors = array();
        if (WorkersTasks::countTasksWorkers($id) < 2) {
            $errors[] = 'Poistaminen ei onnistunut. Tehtävällä täytyy olla vähintään yksi tekijä.';
            Redirect::to('/projektit/' . $pid . '/tehtava/' . $id, array('errors' => $errors));
        }
        $attributes = array(
            'worker' => $person_id,
            'owner_task' => $id
        );
        $wt = new WorkersTasks($attributes);
        $wt->destroyOne($id, $person_id);
        Redirect::to('/projektit/' . $pid . '/tehtava/' . $id, array('message' => $person_name . ' poistettiin tiimistä.'));
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

    private function poistaTiimi($id, $persons) {
        $team = WorkersTasks::findWorkersByTask($id);
        $i = 0;
        foreach ($persons as $person) {
            if (in_array($person->id, $team)) {
                unset($persons[$i]);
            }
            $i++;
        }
        return $persons;
    }

    private function luoWorkersTasks($task, $worker) {
        $attributes = array(
            'worker' => $worker,
            'owner_task' => $task
        );
        $wt = new WorkersTasks($attributes);
        $wt->save();
    }

}
