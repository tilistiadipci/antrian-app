<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MemberRepository;
use App\Models\Department;
use App\Models\Counter;
use App\Models\User;
use App\Models\Member;

class MemberController extends Controller
{
    protected $members; 

    public function __construct(MemberRepository $members)
    {
        $this->members = $members; 
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.members.index', [
            'members' => $this->members->getAll(),
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.members.create', [
            'members' => $this->members->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('access', User::class);

        $this->validate($request, [
            'name' => 'bail|required',
            'telp' => 'bail|required',
            'username' => 'bail|required|min:6|unique:members,username',
            'email' => 'bail|required|email|unique:members,email',
            'password' => 'bail|required|min:6|confirmed',
        ]);

        $data = $request->all();
        $data['role'] = 'U';
        $data['alamat'] = '';
        $data['name'] = $request->name;
        $data['telp'] = $request->telp;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $user = Member::create($data);

        flash()->success('Berhasil membuat akun Pengguna');
        return redirect()->route('members.index');
    }

    public function getPassword(Request $request, Member $member)
    {
        $this->authorize('access', User::class);

        if($member->id==$request->user()->id) abort(404);

        return view('user.members.password', [
            'cuser' => $member,
        ]);
    }

    public function postPassword(Request $request, Member $member)
    {
        $this->authorize('access', User::class);

        if($member->id==$request->user()->id) abort(404);

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $member->password = bcrypt($request->password);
        $member->save();

        flash()->success('Password changed');
        return redirect()->route('members.index');
    }

    public function destroy(Request $request, Member $member)
    {
        $this->authorize('access', User::class);

        $member->delete();

        flash()->success('Menghapus pengguna');
        return redirect()->route('members.index');
    }
}
