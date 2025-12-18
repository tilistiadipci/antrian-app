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

    public function template($id)
    {
        $settings = $this->displays->getSettings();
        $template = $this->displays->getTemplate($id);

        if (empty($template)) {
            abort(404);
        }

        \App::setLocale($settings->language->code);

        event(new \App\Events\TokenCalled());

        $view = 'display.templates.' . $id;
        $contents = json_decode($template->content, true);
        // dd($contents);
        return view($view, [
            'data' => $this->displays->getDisplayByTemplate(3, $template),
            'settings' => $settings,
            'template' => $template,
            'contents' => $contents,
            'counters' => $this->displays->getCounters(),
        ]);
    }
}
