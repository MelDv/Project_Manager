<?php

class ProjectController extends BaseController {

    public static function etusivu() {
        View::make('projektit/etusivu.html');
    }

    public static function index() {
        self::check_logged_in();
        $projects_count = Project::count();

        $page_size = 10;
        $pages = ceil($projects_count / $page_size);
        $page = (isset($_GET['page']) AND (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        $prev_page = $page - 1;
        $next_page = $page + 1;

        if ($prev_page < 1) {
            $prev_page = null;
        } elseif ($next_page > $pages) {
            $next_page = null;
        }

        $projects = Project::all($page, $page_size);
        View::make('projektit/projektit.html', array('pages' => $pages, 'page' => $page, 'prev_page' => $prev_page,
            'next_page' => $next_page, 'projects' => $projects));
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
