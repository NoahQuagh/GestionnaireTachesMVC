<?php
class TaskController {
    public function all() {
        $taskModel = new Task();
        $tasks = $taskModel->getAllTasks();

        require_once 'views/tasks.php';
    }

    public function byId($id) {
        $taskModel = new Task();
        $tasks = $taskModel->getById($id);

        require_once 'views/tasks.php';
    }
}