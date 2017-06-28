<?php

namespace App\Utils; 

class ChangeLocale  
{
    protected $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function handle()
    {
        session()->put('locale',$this->lang);
                  
    }
}