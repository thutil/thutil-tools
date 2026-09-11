<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// High-Demand Thai Utility Tools Routes
$routes->group('tools', static function ($routes) {
    // 1. High-Search Financial Tools (ภาษี, สินเชื่อ, ผ่อน, ดอกเบี้ย)
    $routes->get('tax', 'Tools::tax');
    $routes->get('car-loan', 'Tools::carLoan');
    $routes->get('home-loan', 'Tools::homeLoan');
    $routes->get('compound-interest', 'Tools::compoundInterest');
    $routes->get('salary', 'Tools::salary');
    $routes->get('vat-tax', 'Tools::vatTax');
    $routes->get('bahttext', 'Tools::bahttext');

    // 2. High-Search Daily Life, Utilities & Health (ค่าไฟ, BMI, เบอร์มงคล, แป้นพิมพ์, สุ่ม, รูปภาพ)
    $routes->get('electricity', 'Tools::electricity');
    $routes->get('bmi-mr', 'Tools::bmiBmr');
    $routes->get('bmi-bmr', 'Tools::bmiBmr');
    $routes->get('random', 'Tools::random');
    $routes->get('image-converter', 'Tools::imageConverter');
    $routes->get('lucky-phone', 'Tools::luckyPhone');
    $routes->get('keyboard-fix', 'Tools::keyboardFix');
    $routes->get('word-counter', 'Tools::wordCounter');
    $routes->get('age', 'Tools::age');
    $routes->get('era', 'Tools::era');
    $routes->get('holidays', 'Tools::holidays');

    // 3. GIS & Administrative (ที่ดิน & พิกัด)
    $routes->get('gis', 'Tools::gis');
    $routes->get('postcode', 'Tools::postcode');

    // 4. Identity & Verification (บัตรประชาชน & โค้ด)
    $routes->get('thai-id', 'Tools::thaiId');
    $routes->get('qrcode', 'Tools::qrcode');
    $routes->get('barcode', 'Tools::barcode');
    $routes->get('mock-thai', 'Tools::mockThai');
});

// Direct top-level shortcuts for SEO & quick access
$routes->get('tax', 'Tools::tax');
$routes->get('car-loan', 'Tools::carLoan');
$routes->get('home-loan', 'Tools::homeLoan');
$routes->get('gis', 'Tools::gis');
$routes->get('electricity', 'Tools::electricity');
$routes->get('bmi-bmr', 'Tools::bmiBmr');
$routes->get('promptpay', 'Tools::qrcode');
$routes->get('qrcode', 'Tools::qrcode');
$routes->get('thai-id', 'Tools::thaiId');
$routes->get('bahttext', 'Tools::bahttext');
$routes->get('vat-tax', 'Tools::vatTax');
$routes->get('age', 'Tools::age');
$routes->get('compound-interest', 'Tools::compoundInterest');
$routes->get('salary', 'Tools::salary');


