<?php

use App\Controllers\MainController;
use App\Controllers\UserController;
use App\Http\Request;
use App\Http\Router;

### Main Page route.
Router::get("/", function () {
    echo (new MainController())->index();
});

### User CRUD routing.
Router::get('/users', function (Request $request) {
    $request->response->toJSON((new UserController())->index(), 200);
});

Router::get('/user/([0-9]*)', function (Request $request) {
    $id = $request->getParams(); //all we need is the first index.
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $request->response->toJSON((new UserController())->getById($id), 200);
    } else {
        $request->response->toJSON(['error' => 'Incorrect parameter']);
    }
});

Router::post('/user/create', function (Request $request) {
    $data = $request->parseJSON();
    if ($data) {
        $userAdded = (new UserController())->createUser($data);
        if ($userAdded) {
            $request->response->toJSON(['status' => 'success']);
        }
    }
});

Router::post('/user/update/([0-9]*)', function (Request $request) {
    echo '<pre>' . print_r($request->params, 1) . '</pre>';
    (new UserController())->updateUser($request->params[0], $request->parseJSON());
});