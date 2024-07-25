<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Repositories\DisplayRepository;
use Illuminate\Support\Facades\Password;
use App\Models\Setting;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        $settings = Setting::first();
        return view('auth.email', [
            'status' => '',
            'settings' => $settings,
        ]);
    }

    public function showLinkRequestFormMember()
    {
        $settings = Setting::first();
        return view('user.forgot.index', [
            'status' => '',
            'settings' => $settings,
            'mobile' =>  $this->isMobile(),
        ]); 
    }

    public function sendResetLinkEmailMember(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return view('user.forgot.index', [
                'status' => trans($response),
            ]);
        }

        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return view('auth.email', [
                'status' => trans($response),
            ]);
        }

        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    function isMobile() 
    {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}
