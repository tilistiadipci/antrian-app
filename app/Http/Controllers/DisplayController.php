<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DisplayRepository;
use App\Models\Counter;

 
class DisplayController extends Controller
{
    protected $displays;

    public function __construct(DisplayRepository $displays)
    {
        $this->displays = $displays;
    }

    public function index()
    {
        $settings = $this->displays->getSettings();

        \App::setLocale($settings->language->code);

        event(new \App\Events\TokenCalled());

        return view('display.index', [
            'data' => $this->displays->getDisplayData(),
            'settings' => $settings,
            'counters' => $this->displays->getCounters(),
        ]);
    }

    public function index1()
    {
        $settings = $this->displays->getSettings();

        \App::setLocale($settings->language->code);

        event(new \App\Events\TokenCalled());

        return view('display.index1', [
            'data' => $this->displays->getDisplayData(),
            'settings' => $settings,
            'counters' => $this->displays->getCounters(),
        ]);
    }

}
