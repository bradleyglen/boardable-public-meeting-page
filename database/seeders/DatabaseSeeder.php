<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\User;
use App\Models\MeetingsUser;
use Database\Factories\MeetingFactory;
use Database\Factories\MeetingUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create the default user for login
        User::factory(1)->create([
          'email' => "test@boardable.com"
        ]);
        for ($i = 0; $i < 55; $i++){
          User::factory(1)->create([
            'email' => "test+". $i ."@boardable.com"
          ]);
        }
        $users = User::all();
        $meetings = Meeting::factory(20)->create();
        
        $response_opts = [
          'yes',
          'no',
          'maybe'
        ];
        $used_users = [];
        // create meetings_users (users who RSVP'd to a meeting)
        foreach($meetings as $meeting){
            for ($i = 0; $i < rand(2,10); $i++){
                $rand_int = $this->getUnusedUserId($used_users, $users);
                $rand_user = $users[$rand_int];
                array_push($used_users, $rand_int);
                MeetingsUser::factory(1)->create([  
                    'user_id' => $rand_user->id,
                    'meeting_id' => $meeting->id,
                    'response' => $response_opts[rand(0,2)]
                ]);
            }
        }
    }

    private function getUnusedUserId($used_user_arr, $user_arr, $iterations = 0){
        $rand_int = rand(0,count($user_arr) - 1);
        if (!in_array($rand_int, $used_user_arr) || $iterations > 5){
            return $rand_int;
        }
        else{
            return $this->getUnusedUserId($used_user_arr, $user_arr, $iterations + 1);
        }
    }
}
