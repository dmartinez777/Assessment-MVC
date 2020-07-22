<?php

use App\Controllers\MainController;
use App\Controllers\UserController;
use App\Http\Request;
use App\Http\Router;

### User CRUD routing.

// Main Page.
Router::get("/", function () {
    echo (new MainController())->index();
});

//Get all users
Router::get('/users', function (Request $request) {
    $request->response->toJSON((new UserController())->index(), 200);
});

//Get a user by id
Router::get('/user/([0-9]*)', function (Request $request) {
    $id = $request->getParams();
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $request->response->toJSON((new UserController())->getById((int) $id), 200);
    } else {
        $request->response->toJSON(['error' => 'Incorrect parameter']);
    }
});

//Create User
Router::post('/user/create', function (Request $request) {
    $data = $request->getJSON();
    if ($data) {
        $userAdded = (new UserController())->createUser($data);
        if ($userAdded) {
            $request->response->toJSON(['status' => $userAdded]);
        }
    }
});

//Update user
Router::post('/user/update/([0-9]*)', function (Request $request) {
    $status = false;
    if (filter_var($request->params[0], FILTER_VALIDATE_INT)) {
        $status = (new UserController())->updateUser($request->params[0], $request->getJSON());
    }
    $request->response->toJSON(['status' => $status]);
});

//Delete User
Router::post('/user/delete', function (Request $request) {
    $status = false;
    $userId = $request->getJSON();

    if (isset($userId->id) && filter_var($userId->id, FILTER_VALIDATE_INT)) {
        $status = (new UserController())->deleteUser($userId->id);
    }
    $request->response->toJSON(['status' => $status]);
});
