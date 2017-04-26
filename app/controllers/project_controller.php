<?php

class ProjectController extends BaseController {

    public static function etusivu() {
        View::make('projektit/etusivu.html');
    }

    public static function index() {
        self::check_logged_in();
        $projects = Project::allActive();
        $old_projects = Project::allClosed();
        View::make('projektit/projektit.html', array('projects' => $projects, 'old_projects' => $old_projects));
    }

    public static function projekti($id) {
        self::check_logged_in();
        $project = Project::find($id);
        $tasks = Task::findByProject($id);
        $approved_tasks = 0;
        foreach ($tasks as $task) {
            if ($task['approved'] == TRUE) {
                $approved_tasks++;
            }
        }
        View::make('projektit/projekti.html', array('project' => $project, 'tasks' => $tasks, 'approved_tasks' => $approved_tasks));
    }

    //get
    public static function lisaa() {
        self::check_logged_in();
        $managers = Person::findManagers();
        View::make('projektit/muokkaa_projekti.html', array('managers' => $managers));
    }

    public static function poista($pid) {
        $name = Project::findName($pid);
        Project::destroy($pid);
        Redirect::to('/projektit/', array('message' => 'Projekti ' . $name . ' ja kaikki sen tehtävät poistettiin.'));
    }

    //post
    public static function lisaauusi() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'manager' => $params['manager'],
            'name' => $params['name'],
            'current_status' => 'pending',
            'description' => $params['description'],
            'start_date' => $params['start_date']
        );

        $managers = Person::findManagers();
        $project = new Project($attributes);
        $errors = $project->errors();
        if (count($errors) == 0) {
            $project->save();
            Redirect::to('/projektit/' . $project->id, array('message' => 'Projektin ' . $project->name . ' lisääminen onnistui.'));
        } else {
            array_unshift($errors, 'Antamissasi tiedoissa oli virheitä. ');
            View::make('/projektit/muokkaa_projekti.html', array('errors' => $errors, 'project' => $project, 'managers' => $managers));
        }
    }

    //get
    public static function muokkaa($pid) {
        self::check_logged_in();
        $project = Project::find($pid);
        $managers = Person::findManagers();
        View::make('projektit/muokkaa_projekti.html', array('project' => $project, 'managers' => $managers));
    }

    //post
    public static function muokkaaprojekti($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'manager' => $params['manager'],
            'name' => $params['name'],
            'description' => $params['description'],
            'start_date' => $params['start_date'],
            'deadline' => $params['deadline']
        );

        $project = new Project($attributes);
        $errors = $project->errors();
        if (count($errors) == 0) {
            $project->update();
            Redirect::to('/projektit/' . $project->id, array('message' => 'Projektin ' . $project->name . ' tiedot päivitetiin.'));
        } else {
            array_unshift($errors, 'Antamissasi tiedoissa oli virheitä. ');
            View::make('/projektit/muokkaa_projekti.html', array('errors' => $errors, 'project' => $project));
        }
    }

}
