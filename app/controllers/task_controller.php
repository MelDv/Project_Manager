<?php

class TaskController extends BaseController {

    public static function index() {
        self::check_logged_in();
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
        $tasks = Task::all($page, $page_size);
        View::make('projektit/tehtavat.html', array('pages' => $pages, 'page' => $page, 'prev_page' => $prev_page,
            'next_page' => $next_page, 'page_size' => $page_size, 'tasks' => $tasks));
    }

}
