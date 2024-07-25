<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Models\Setting;
use App\Models\Department;
use App\Models\Queue;
use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Member;
use App\Models\User;
use App\Models\Message;
use App\Models\Channel;
use App\Models\Ratting;



class HomeController extends Controller
{
    protected $home;

    public function __construct(HomeRepository $home)
    {

        $this->home = $home;

        
    }

    public function home()
    {

        $settings = Setting::first();

        $now = Carbon::now();
       
        $jambuka = $settings->jam_buka;
        $jamtutup = $settings->jam_tutup;
        $time  = $now->format('H:i:s');

        
        $weekMap = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        
        $dayOfTheWeek = $now->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        
        return view('home.index', [
            'settings' => $this->home->getSetting(),
            'departments' =>  $this->home->getDepartments(),
            'total' =>  $this->home->getTodayQueue(),
            'member' =>  $this->home->member(),
            'buka' =>  $jambuka,
            'tutup' =>  $jamtutup,
            'timenow' =>  $time,
            'libur' =>  $dayOfTheWeek,
            'mobile' =>  $this->home->isMobile(),
            'mobiles' =>  $this->home->getMobile(),
            'rattings' =>  $this->home->getRattings(),
            'rattingmembers' =>  $this->home->getMembers(),
            'now' =>  $now,

        ]);

        
        
    }

    public function profile()
    {
 
        return view('user.profile.profile', [
            'settings' => $this->home->getSetting(),
            'departments' =>  $this->home->getDepartments(),
            'total' =>  $this->home->getTodayQueue(),
            'mobile' =>  $this->home->isMobile(),
        ]);

        
        
    }

    public function chat($id)
    {

         $settings = Setting::first();
            

        event(new \App\Events\TokenCalled());


        $member = auth('members')->user();
        $readys = Channel::select()
                    ->get();

        if($readys->where('to_id', $id)->where('re_id', $member->id)->count() == '0') {

            

            return redirect()->route('listchat');

        } else {
        
            return view('user.chat.index', [
            'id' => $id,
            'settings' => $settings,
            'users' => $this->home->getUsers(),
            'datas' => $this->home->getDisplayData($id),
            ]);

        }    

        
        
    }

    public function listchat()
    {

         $settings = Setting::first();

        return view('user.chat.list', [
            'settings' => $settings,
            'users' => $this->home->getUsersChat(),
            'channels' => $this->home->getUsersChannel(),
            'readys' => $this->home->getAllchannel(),
            'displays' => $this->home->getDisplayDataChat(),
            'mobile' =>  $this->home->isMobile(),
        ]);
        
    }

    public function stafChatHome()
    {

         $settings = Setting::first();

        event(new \App\Events\TokenCalled());

        return view('user.stafchat.home', [
            'settings' => $settings,
            'users' => $this->home->getUsers(),
            'channels' => $this->home->getUsersChannelStaf(),
            'members' => $this->home->getDisplayDataMemberStaf(),
            'chats' => $this->home->getDisplayDataChatStaf(),
        ]);
        
    }

    public function stafChat($id)
    {

         $settings = Setting::first();

        event(new \App\Events\TokenCalled());

        return view('user.stafchat.index', [
            'id' => $id,
            'settings' => $settings,
            'users' => $this->home->getUsers(),
            'datas' => $this->home->getDisplayDataStaf($id),
        ]);
        
    }

    public function sendMessage(Request $request, $id)
    {
        $member = auth('members')->user();

         $this->validate($request, [
                'message' => 'bail|required',
            ]);

        $data = $request->all();
        $data['admin_id'] = $request->admin_id;
        $data['member_id'] = $member->id;
        $data['message'] = $request->message;
        $data['type'] = $request->type;
        $data = Message::create($data);

        file_put_contents(base_path('assets/files/chat'), json_encode([$data]));

        return redirect()->route('chat',['id' => $id]);
    }

    public function sendMessageStaf(Request $request, $id)
    {
        $user = $request->user();

         $this->validate($request, [
                'message' => 'bail|required',
            ]);

        $data = $request->all();
        $data['admin_id'] = $user->id;
        $data['member_id'] = $request->member_id;
        $data['message'] = $request->message;
        $data['type'] = '';
        $data = Message::create($data);

        file_put_contents(base_path('assets/files/chat'), json_encode($data));

        return redirect()->route('stafchat',['id' => $id]);
    }

    public function register()
    {
 
        return view('user.register.index', [
            'settings' => $this->home->getSetting(),
            'mobile' =>  $this->home->isMobile(),
        ]);
        
    }


    public function store(Request $request)
    {
        
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
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['telp'] = $request->telp;
        $data['password'] = bcrypt($request->password);
        $data = Member::create($data);

        flash()->success('User created');
        return redirect('/user/login');
    }


    public function antriansaya(Request $request)
    {   

        $datenow = Carbon::now(); 

        $calls = $this->home->getAllTypesDetails();
        return view('user.antrian.index', [
            'settings' => $this->home->getSetting(),
            'queues' =>  $this->home->getAntrian(), 
            'departments' =>  $this->home->getDepartments(),
            'counters' =>  $this->home->getCounters(),
            'times' =>  $calls,
            'datenow' =>  $datenow,
            'mobile' =>  $this->home->isMobile(),
            'rattings' =>  $this->home->getRattings(),
        ]);

        
        
    }

    public function edit(Request $request)
    {
        $member = $request->user();

        if($request->password=='') {
            $this->validate($request, [
                'name' => 'bail|required',
                'telp' => 'bail|required',
            ]);

            $member->name = $request->name;
            $member->telp = $request->telp;
            $member->alamat = $request->alamat;
            $member->username = $request->username;
            $member->email = $request->email;
            $member->save();
        } else {
            $this->validate($request, [
                'name' => 'bail|required',
                'telp' => 'bail|required',
                'password' => 'bail|required|min:6|confirmed',
            ]);

            $member->name = $request->name;
            $member->telp = $request->telp;
            $member->alamat = $request->alamat;
            $member->username = $request->username;
            $member->email = $request->email;
            $member->password = bcrypt($request->password);
            $member->save();
        }

        flash()->success('Profile Update');
        return redirect()->route('profile');
    }

    public function postDept(Request $request)
    {
        $member = $request->user();

        $department = Department::findOrFail($request->department);

        $last_token = $this->home->getLastToken($department);

        if($last_token) {
            $queue = $department->queues()->create([
                'number' => ((int)$last_token->number)+1,
                'called' => 0,
                'id_member' => $member->id,
            ]);
        } else {
            $queue = $department->queues()->create([
                'number' => $department->start,
                'called' => 0,
                'id_member' => $member->id,
            ]);
        }

        $total = $this->home->getCustomersWaiting($department);

        event(new \App\Events\TokenIssued());

        $request->session()->flash('department_name', $department->name);
        $request->session()->flash('number', ($department->letter!='')?$department->letter.'-'.$queue->number:$queue->number);
        $request->session()->flash('total', $total);
        

        //flash()->success('Token Added');
        return redirect()->back()->with('error_code', 5);
    }

    public function postChannel(Request $request)
    {
        $member = auth('members')->user();
    
            $channel = Channel::create([
            'to_id' => $request->toid,
            're_id' => $member->id,
            ]);

            return redirect()->route('chat',['id' => $request->toid]); 

    }

    public function postDept1(Request $request)
    {
        $member = $request->user();

        
      
            $queue = Queue::select()
                    ->where('id', $request->queueid)
                    ->where('called', 0)
                    ->first();

        $department = Department::findOrFail($queue->department_id);            
        
        if($queue->called == '1') {
   
        } else {
            if($queue->number - $queue->where('called', 1)->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))->where('department_id', $queue->department_id)->get()->count() == '1') {
            $menunggu = '';
            $total = 'Giliran anda!';
            } else {
            $menunggu = 'Menunggu';    
            $total =  $queue->number - $queue->where('called', 1)->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))->where('department_id', $queue->department_id)->get()->count() - 1 .' Orang';    
            }    
        }

        event(new \App\Events\TokenIssued());

        $request->session()->flash('department_name', $department->name);
        $request->session()->flash('number', ($department->letter!='')?$department->letter.'-'.$queue->number:$queue->number);
        $request->session()->flash('total', $menunggu.' '.$total);
        $request->session()->flash('tanggal', $queue->created_at);
        $request->session()->flash('jam', $queue->created_at);
        

        //flash()->success('Token Added');
        return redirect()->back()->with('error_code', 5);
    }
    
    public function sendRatting(Request $request)
    {
        $member = auth('members')->user();

         $this->validate($request, [
                'pesan' => 'bail|required',
            ]);

        $data = $request->all();
        $data['user_id'] = $request->user_id;
        $data['pelanggan_id'] = $member->id;
        $data['nomor'] = $request->nomor;
        $data['bintang'] = $request->bintang;
        $data['message'] = $request->pesan;
        $data['loket'] = $request->loket;
        $data = Ratting::create($data);

        return redirect()->back()->with('sukses', 5);
    }
}
