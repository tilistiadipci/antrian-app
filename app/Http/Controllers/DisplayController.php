<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DisplayRepository;
 
class DisplayController extends Controller
{
    protected $displays;

    public function __construct(DisplayRepository $displays)
    {
        $this->displays = $displays;
    }

    private function applyDisplayLocale($settings)
    {
        $locale = config('app.locale');

        if ($settings && $settings->language && !empty($settings->language->code)) {
            $locale = $settings->language->code;
        }

        \App::setLocale($locale);
    }

    public function index()
    {
        $settings = $this->displays->getSettings();

        $this->applyDisplayLocale($settings);

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

        $this->applyDisplayLocale($settings);

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

        $this->applyDisplayLocale($settings);

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
