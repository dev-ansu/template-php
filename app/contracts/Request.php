<?php
namespace app\contracts;

interface Request{

    public function data();
    public function validated();
    public function errors();
}