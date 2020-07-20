<?php

use App\Controllers\MainController;
use App\Http\Request;
use App\Http\Router;

Router::get("/", function () {
    echo (new MainController())->index();
});

Router::get("/contact/edit/([0-9]*)", function (Request $request) {
    echo $request->getParams()[0];
});
