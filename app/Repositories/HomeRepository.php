<?php

namespace App\Repositories;

use App\Models\Department;
use Carbon\Carbon;
use App\Models\Queue;
use App\Models\Counter;
use App\Models\Call;
use App\Models\Member;
use App\Models\Setting;
use App\Models\User; 
use App\Models\Message;
use App\Models\Channel;
use App\Models\Mobile;
use App\Models\Ratting; 


class HomeRepository
{
    public function getDepartments()
    {
        return Department::all();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getCounters()
    {
        return Counter::all();
    }

    public function getAll()
    {
        return Member::all();
    }

    public function getAllchat()
    {
        return Message::all();
    }

    public function getAllchannel()
    {
        return Channel::all();
    }

    public function getSetting()
    {
        return Setting::first();
    }
    
    public function getMobile()
    {
        return Mobile::first();
    }

    public function getLastToken(Department $department)
    {
        return $department->queues()
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->orderBy('created_at', 'desc')
                    ->first();
    }

    public function getCustomersWaiting(Department $department)
    {
        return $department->queues()
                    ->where('called', 0)
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->count();
    }


     public function getTodayQueue()
    {   
      
        return Queue::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->first();
                    
    }

    public function getAntrian()
    {   
        $member = auth('members')->user();
           
         $antrian = Queue::select()
                    ->where('id_member', $member->id)
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $antrian;          
    }

    public function member()
    {   
        $member = auth('members')->user();
        if(!$member) {
        return ''; 
        } else {
        $id = $member->id; 
        return $id; 
        }         
    }

    public function getAllTypesDetails()
    {
  

        $settings = Setting::first();
        $q = Call::with('queue', 'user', 'department', 'counter');

        $times = $q->get();


        foreach ($times as $key => $time) {
            $next_call_key = $times->search(function($incall, $key) use($time) {
                if(($incall->queue_id>$time->queue_id)) return $key;
            });

            if($next_call_key) {
                if(($times[$next_call_key]->created_at->timestamp-$time->created_at->timestamp)>$settings->over_time) {
                    $time->serving_end = $times[$next_call_key]->created_at;
                    $time->served_time = round((($times[$next_call_key]->created_at->timestamp-$time->created_at->timestamp)/60), 2);
                } 
            } else {

                $times->pull($key);


            }



            
        }
        return $times;
    }

    public function getMembers()
    {
        return Member::all();
    }

    public function getUsersChat()
    {
        $member = User::select()
                    ->where('role', 'C')
                    ->orderBy('id', 'desc')
                    ->get();

        return $member;
    }

    public function getUsersChannel()
    {
        $member = auth('members')->user();
        $channel = Channel::select()
                    ->where('re_id', $member->id)
                    ->orderBy('id', 'desc')
                    ->get();

        return $channel;
    }

    public function getUsersChannelStaf()
    {
        $user = auth('users')->user();
        $channel = Channel::select()
                    ->where('to_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->get();

        return $channel;
    }

    public function getDisplayData($id)
    {
        
        $member = auth('members')->user();
        $calls = Message::select()
                    ->where('admin_id', $id)
                    ->where('member_id', $member->id)
                    ->orderBy('id', 'asc')
                    ->get();

        return $calls;
    }


    public function getDisplayDataChat()
    {
        
        $member = auth('members')->user();
        $calls = Message::select()
                    ->where('member_id', $member->id)
                    ->orderBy('updated_at', 'desc')
                    ->get();

        //file_put_contents(base_path('assets/files/chat'), json_encode($calls));            

        return $calls;
    }


    public function getDisplayDataStaf($id)
    {
        
        $user = auth('users')->user();
        $calls = Message::select()
                    ->where('admin_id', $user->id)
                    ->orderBy('id', 'asc')
                    ->get();
                    
       //file_put_contents(base_path('assets/files/chat'), json_encode($datachat));

        return $calls;
    }

    public function getDisplayDataMemberStaf()
    {
        $member = Member::select()
                    ->orderBy('updated_at', 'desc')
                    ->take(1)
                    ->get();

        return $member;
    }

    public function getDisplayDataChatStaf()
    {
        $chat = Message::select()
                    ->orderBy('id', 'desc')
         
                    ->get();

        return $chat;
    }

    function isMobile() 
    {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    
    public function getRattings()
    {

        $ratting = Ratting::select()
                    ->orderBy('updated_at', 'desc')
                    ->take(7)
                    ->get();

        return $ratting;

    }

}
