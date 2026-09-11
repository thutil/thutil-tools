<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'thutil - เครื่องมือ Utility สำหรับคนไทย Open Source',
            'activeNav' => 'home'
        ];
        return view('home/index', $data);
    }
}
