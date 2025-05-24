<?php
namespace app\contracts;


interface Controller{
    
    public function load(string $viewName, array $viewData = []);
    
}