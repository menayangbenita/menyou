<?php 

class Get
{
    public static function model($model)
    {
        require_once "../app/models/{$model}.php";
        return new $model;
    }

    public static function view($view, $data = [])
    {
        require_once "../app/views/{$view}.php";
    }
}