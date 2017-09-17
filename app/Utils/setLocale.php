<?php

namespace App\Utils;

class setLocale {

    protected $languages;

    public function __construct() {
        $this->languages = config('app.languages');
    }

    public function handle() {
        if (!session()->has('locale')) {
            session()->put('locale', 'th');
        }
        app()->setLocale(session('locale'));
    }

}
