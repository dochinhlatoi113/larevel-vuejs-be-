<?php

namespace App\Http\Controllers;

class B_Controller extends Controller
{
    //
    public function __construct(A_Controller $A_Controller)
    {
        $this->A_Controller = $A_Controller;
    }

    public function index()
    {
        // $test = new A_Controller();
        // $b = $test->index();
        // $c = $test->index2('aaa');
        //test contructor
        $testContructor = $this->A_Controller->index();
        // var_dump($test instanceof A_Controller);
    }
}
