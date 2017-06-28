<?php

namespace App\Http\Middleware;

use \Illuminate\Support\Facades\App;
use Illuminate\Bus\Dispatcher as BusDispatcher;
 use App\Utils\SetLocale;
use Closure;

class LanguagesSet {

    protected $bus;
    protected $setLocale;

    public function __construct(BusDispatcher $bus, SetLocale $setLocale) {
        $this->bus = $bus;
        $this->setLocale = $setLocale;
    }

    public function handle($request, Closure $next) {
        $this->bus->dispatch($this->setLocale);
        return $next($request);
    }

}
