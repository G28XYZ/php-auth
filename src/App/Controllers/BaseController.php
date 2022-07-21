<?php

namespace App\Controllers;
use App\View;

abstract class BaseController {

    protected View $view;

    public function __construct()
    {
        if(!$this->access()) {
            die('Доступа нет!');
        }
        $this->view = new View();
    }

    protected function access():bool {
        return true;
    }

    // если класс имеет один публичный метод то инвок выполнит логику в своем теле функции при вызове класса как функцию
    abstract public function __invoke();
}