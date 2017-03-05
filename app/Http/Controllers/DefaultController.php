<?php

namespace App\Http\Controllers;


class DefaultController extends Controller
{
    public function index()
    {

        $this->flash('error', 'This is an error msg');
        $this->flash('success', 'This is a success msg');
        $this->flash('warning', 'This is a warning msg');
        $this->flash('info', 'This is a info msg 1');
        $this->flash('info', 'This is a info msg 2');

        return view('default.index');
    }



}
