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
        View::make('projektit/projekti.html', array('project' => $project));
    }

    public static function lisaa() {
        self::check_logged_in();
        View::make('projektit/muokkaa_lisaa.html');
    }

}
