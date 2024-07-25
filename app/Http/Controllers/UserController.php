<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\Department;
use App\Models\Counter;
use App\Models\User;

class UserController extends Controller
{
    protected $users; 

    public function __construct(UserRepository $users)
    {
        $this->users = $users; 
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.users.index', [
            'users' => $this->users->getAll(),
            'counters' => $this->users->getCounters(),
            'departments' => $this->users->getDepartments(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.users.create', [
            'users' => $this->users->getAll(),
            'counters' => $this->users->getCounters(),
            'departments' => $this->users->getDepartments(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('access', User::class);

        $this->validate($request, [
            'name' => 'bail|required',
            'username' => 'bail|required|min:6|unique:users,username',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|min:6|confirmed',
        ]);

        $data = $request->all();
        $data['role'] = $request->role;
        $data['departments'] = $request->department;
        $data['counter'] = $request->counter;
        $data['password'] = bcrypt($request->password);
        $data['testi_sangat_puas'] = '0';
        $data['testi_puas'] = '0';
        $data['testi_cukup_puas'] = '0';
        $data['testi_tidak_puas'] = '0';
        $user = User::create($data);

        flash()->success('User created');
        return redirect()->route('users.index');
    }

    public function getPassword(Request $request, User $user)
    {
        $this->authorize('access', User::class);

        if($user->id==$request->user()->id) abort(404);

        return view('user.users.password', [
            'cuser' => $user,
        ]);
    }

    public function postPassword(Request $request, User $user)
    {
        $this->authorize('access', User::class);

        if($user->id==$request->user()->id) abort(404);

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        flash()->success('Password changed');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request, User $user)
    {
        $this->authorize('access', User::class);

        $user->delete();

        flash()->success('User deleted');
        return redirect()->route('users.index');
    }
}
