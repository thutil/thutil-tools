<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'thutil - ศูนย์รวมเครื่องมือ Utility ออนไลน์สำหรับคนไทย ใช้งานฟรี',
            'activeNav' => 'home'
        ];
        return view('home/index', $data);
    }

    public function terms(): string
    {
        $data = [
            'title' => 'เงื่อนไขการใช้งานและข้อจำกัดความรับผิดชอบ - thutil',
            'activeNav' => 'terms',
            'metaDesc' => 'เงื่อนไขและข้อกำหนดการใช้งานเว็บไซต์ thutil นโยบายความเป็นส่วนตัว Zero Storage และข้อจำกัดความรับผิดชอบในการคำนวณ'
        ];
        return view('home/terms', $data);
    }
}
