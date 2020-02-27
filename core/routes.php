<?php

return [
    
    'GET /login' => 'LoginController.show',
    'POST /session' => 'SessionController.create',
    'POST /logout' => 'SessionController.destroy',
    'GET /' => 'TasksController.list',
    'GET /tasks/:page/:order/:direction' => 'TasksController.list',
    'GET /tasks/create' => 'TasksController.create',
    'POST /tasks/create' => 'TasksController.insert',
    'GET /tasks/edit/:id' => 'TasksController.edit',
    'POST /tasks/edit/:id' => 'TasksController.update'
    
];
