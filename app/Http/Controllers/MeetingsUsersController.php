<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use App\Models\MeetingsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class MeetingsUsersController extends Controller
{
    public function create(Request $request)
    {
        // create a new user if possible based on input
        $email = $request->input('email');
        $meetingId = $request->input('meeting_id');

        $user = User::where('email', $email)->first();
        if (is_null($user)){
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
            $user->save();
        }

        // create a new meeting_user
        $meeting_user = MeetingsUser::where('user_id', $user->id)->where('meeting_id', $meetingId)->first();
        if (is_null($meeting_user)){
            $meeting_user = new MeetingsUser();
        }
        $meeting_user->user_id = $user->id;
        $meeting_user->meeting_id = $meetingId;
        $meeting_user->save();

        // get meeting details
        $meeting = Meeting::find($meetingId);
        $path_arr = explode("/", $request->path());
        $is_public = $path_arr[count($path_arr) - 1] == "public";

        $url = "meetings/".$meetingId;
        if ($request->input('public_path') === 'true'){
          $url .= "/public";
        }

        return Redirect::to($url);
    }

    private function getUsers($meetingId){
        $users = [];
        $meetings_users = MeetingsUser::all();
        foreach($meetings_users as $meeting_user){
            if ($meeting_user->meeting_id == $meetingId){
              $user = User::find($meeting_user->user_id);
              array_push($users, $user->email . ", " . $meeting_user->response);
            }
        }
        return $users;
    }
}
