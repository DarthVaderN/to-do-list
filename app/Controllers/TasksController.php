<?php
namespace Controllers;

class TasksController extends Controller
{
    public function list($arguments) {
        $possibleOrders = [ 'user', 'email', 'completed' ];
        $possibleDirections = [ 'desc', 'asc' ];
        $paging = $this->getPagingParams($arguments, $possibleOrders, $possibleDirections);
        $paging['base_uri'] = '/tasks';
        $connection = \Database::getConnection();
        $stmt = $connection->prepare(
            'SELECT * FROM `tasks` ORDER BY `' . $paging['order'] . '` ' .
            $paging['direction'] . ' LIMIT ' . $paging['offset'] . ', ' . $paging['per_page']
        );

        $stmt->execute();
        $tasks = $stmt->fetchAll();

        $stmt = $connection->query('SELECT COUNT(*) FROM `tasks`');
        $stmt->execute();
        $count_all = $stmt->fetch()[0];

        return $this->view('tasks/list', [
            'tasks' => $tasks,
            'paging' => $paging,
            'count_all' => $count_all
        ]);
    }

    public function create() {
        return $this->view('tasks/create', []);
    }

    public function insert($arguments, $data) {
        $validationErrors = [];

        if (!array_key_exists('user', $data) || empty($data['user'])) {
            $validationErrors[] = 'Enter Login';
        }

        if (!array_key_exists('email', $data) || empty($data['email'])) {
            $validationErrors[] = 'Enter e-mail';
        } elseif (array_key_exists('email', $data) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $validationErrors[] = 'Enter a valid e-mail';
        }

        if (!array_key_exists('description', $data) || empty($data['description'])) {
            $validationErrors[] = 'Enter text';
        }

        if (count($validationErrors)) {
            return $this->redirectWithErrors('/tasks/create', $validationErrors);
        }

        $connection = \Database::getConnection();
        $connection->prepare('INSERT INTO `tasks` (`user`, `email`, `description`) VALUES (?, ?, ?)')
            ->execute([ $data['user'], $data['email'], $data['description'] ]);

        return $this->redirectWithMessage('/', 'Successfully created');
    }

    public function edit($arguments) {
        if (!\Session::isAuth()) {
            return $this->redirectWithError('/', 'Logged in');
        }

        $connection = \Database::getConnection();
        $stmt = $connection->prepare('SELECT * FROM `tasks` WHERE `id` = ?');
        $stmt->execute([ $arguments['id'] ]);
        $task = $stmt->fetch();

        if (!$task) {
            return $this->redirectWithError('/', 'Task not found');
        }

        return $this->view('tasks/edit', [
            'task' => $task
        ]);
    }

    public function update($arguments, $data) {
        if (!\Session::isAuth()) {
            return $this->redirectWithError('/', 'Logged in');
        }

        $connection = \Database::getConnection();
        $stmt = $connection->prepare('SELECT * FROM `tasks` WHERE `id` = ?');
        $stmt->execute([ $arguments['id'] ]);
        $task = $stmt->fetch();

        if (!$task) {
            return $this->redirectWithError('/', 'Task not found');
        }

        $validationErrors = [];

        if (!array_key_exists('description', $data) || empty($data['description'])) {
            $validationErrors[] = 'Enter text';
        }

        if (count($validationErrors)) {
            return $this->redirectWithErrors('/tasks/create', $validationErrors);
        }

        $connection->prepare('UPDATE `tasks` SET `description` = ?, `completed` = ?, `updated` = ? WHERE `id` = ?')
            ->execute([
                $data['description'],
                array_key_exists('completed', $data) && $data['completed'] ? 1 : 0,
                strcmp($task['description'], $data['description']) !== 0 ? 1 : $task['updated'],
                $arguments['id']
            ]);

        return $this->redirectWithMessage('/', 'Successfully created');
    }

    public function complete($arguments) {
        if (!\Session::isAuth()) {
            return $this->redirectWithError('/', 'Logged in');
        }

        $connection = \Database::getConnection();
        $stmt = $connection->prepare('SELECT * FROM `tasks` WHERE `id` = ?');
        $stmt->execute([ $arguments['id'] ]);
        $task = $stmt->fetch();

        if (!$task) {
            return $this->redirectWithError('/', 'Task not found');
        }


        $connection->prepare('UPDATE `tasks` SET `completed` = 1 WHERE `id` = ?')
            ->execute([ $arguments['id'] ]);

        return $this->redirectWithMessage('/', 'Successfully created');
    }
}
