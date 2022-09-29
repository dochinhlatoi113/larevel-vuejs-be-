<?php

namespace App\Http\Controllers;

// dependcy injection
class C_Controller
{
    //
    private $A_Controller; // tên class của A_controller
    private $B_Controller;
    //
    public function __contruct(B_Controller $B_Controller, A_Controller $A_Controller)
    {
        $this->A_Controller = $A_Controller;
        $this->B_Controller = $B_Controller;
    }
    //
    public function index()
    {
        $test = new B_Controller(new A_Controller);
        $test->index();
    }
}
