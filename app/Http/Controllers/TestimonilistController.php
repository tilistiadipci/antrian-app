<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\Department;
use App\Models\Counter;
use App\Models\User;

class TestimonilistController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users; 
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.testimoni.list', [
            'users' => $this->users->getAll(),
            'counters' => $this->users->getCounters(),
            'departments' => $this->users->getDepartments(),
        ]);
    }
}
