<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use App\Models\MeetingsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MeetingsController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();

        return view('meetings.index')->with(['meetings' => $meetings]);
    }

    public function show(Request $request, $meetingId)
    {
        $meeting = Meeting::find($meetingId);
        $path_arr = explode("/", $request->path());
        $is_public = $path_arr[count($path_arr) - 1] == "public";
        $users = $this->getUsers($meetingId);

        return view('meetings.show')->with([
            'meeting' => $meeting,
            'is_public' => $is_public,
            'users' => $users
        ]);
    }

    public function update(Request $request, $meetingId)
    {
        $meeting = Meeting::find($meetingId);

        $meeting->is_public = $request->has('is_public');
        $meeting->save();

        return view('meetings.show')->with([
            'meeting' => $meeting,
            'is_public' => ($request->input('public_path') === 'true'),
            'users' => $this->getUsers($meetingId)
        ]);
    }

    /**
     * If a frontend framework was in play for this, I would not redirect, I would only return a 204
     */
    public function delete(Request $request, $meetingId)
    {
        Meeting::destroy($meetingId);

        $url = "meetings";
        return Redirect::to($url);
    }


    /**
     * private functions
     */
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
