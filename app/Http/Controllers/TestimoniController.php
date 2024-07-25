<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SettingsRepository;
use App\Models\Language;
use App\Models\Setting;
use App\Models\User;

class TestimoniController extends Controller
{
    protected $settings;

    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings;
    }

    public function index(Request $request)
    {
        return view('user.testimoni.index', [
            'settings' => $this->settings->getSettings(),
        ]);

    }

    public function postDept(Request $request)
    {
        $user = $request->user();
        $user->testi_sangat_puas = ($user->testi_sangat_puas + $request->testi_sangat_puas);
        $user->testi_puas = ($user->testi_puas + $request->testi_puas);
        $user->testi_cukup_puas = ($user->testi_cukup_puas + $request->testi_cukup_puas);
        $user->testi_tidak_puas = ($user->testi_tidak_puas + $request->testi_tidak_puas);
        $user->save();
        

        flash()->success('Terima kasih sudah memberikan penilaian, semoga hari anda menyenangkan');
        return redirect()->route('testimoni');
    }
}
