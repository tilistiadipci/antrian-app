<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class MainController extends Controller
{
    public function redirect(Request $request)
    {
    	if(\Auth::user()) {
    		return redirect()->route('admin/login');
    	} else {
    		return redirect()->route('get_login');
    	}
        
    }

    public function redirectuser(Request $request)
    {
        if(\Auth::user()) {
            return redirect()->route('user/login');
        } else {
            return redirect()->route('get_login_user');
        }
        
    }

    public function changeLocale(Request $request, $locale)
    {
        $locale = Language::where('code', $locale)->first();
        if($locale) {
            $request->session()->put('locale', $locale->code);
        }
        return redirect()->back();
    }
}
