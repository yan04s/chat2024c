<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FriendController extends Controller
{
    // Send Friend Request
    public function sendRequest(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Find the user by email
        $friend = User::where('email', $request->email)->first();

        if (!$friend) {
            return back()->withErrors(['email' => 'User not found']);
        }

        // Check if the user is trying to send a friend request to themselves
        if (Auth::id() === $friend->id) {
            return back()->withErrors(['email' => 'You cannot send a friend request to yourself']);
        }

        // Check if a friendship or friend request already exists
        /*$exists = Friend::where(function ($query) use ($friend) {
            $query->where('user_id', Auth::id())
                ->where('friend_id', $friend->id);
        })->orWhere(function ($query) use ($friend) {
            $query->where('user_id', $friend->id)
                ->where('friend_id', Auth::id());
        })->exists();*/
        $exists = Friend::where('user_id', Auth::id())
                ->where('friend_id', $friend->id)
                ->first();
        $mutual = Friend::where('user_id', $friend->id)
                ->where('friend_id', Auth::id())
                ->first();
        
        if ($exists) {
            if ($exists->status=='declined') {
                return back()->withErrors(['errors' => 'Receiver declined your friend request']);
            }elseif ($exists->status=='accepted') {
                return back()->withErrors(['errors' => 'You are already friends']);
            }elseif ($exists->status=='blocked') {
                return back()->withErrors(['errors' => 'Not Found']);
            }elseif ($exists->status=='pending') {
                return back()->withErrors(['errors' => 'Please wait for the response of '.$friend->name]);
            }
        }elseif ($mutual) {
            if ($mutual->status=='pending') {
                $mutual->update(['status' => 'accepted']);
                return back()->with('success', 'Friend request accepted! Friend request sent mutually, you are now friends with '.$friend->name);
            }elseif ($mutual->status=='accepted') {
                return back()->withErrors(['errors' => 'You are already friends']);
            }elseif ($mutual->status=='blocked') {
                return back()->withErrors(['errors' => 'Not Found']);
            }elseif ($mutual->status=='declined') {
                $mutual->update(['status' => 'pending', 'user_id' => Auth::id(), 'friend_id' => $friend->id]);
                return back()->with('success', 'Friend request sent successfully');
            }
        }

        // Create a new friend request
        Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $friend->id,
        ]);

        // Log the friend request
        //Log::info('Friend request sent from user ID ' . Auth::id() . ' to user ID ' . $friend->id);

        return back()->with('success', 'Friend request sent successfully');
    }

    // Accept Friend Request
    public function acceptRequest($email)
    {
        
        // Find the user based on email
        $friend = User::where('email', $email)->firstOrFail();

        // Handle accepting the friend request logic (e.g., create a new friend relationship)
        $friendRequest = Friend::where('friend_id', Auth::id())
            ->where('user_id', $friend->id)
            ->where('status', 'pending')
            ->first();

        if (!$friendRequest) {
            return response()->json(['error' => 'No pending friend request found'], 404);
        }
        
        $friendRequest->update(['status' => 'accepted']);
        
        // Redirect back with a success message
        return back()->with('success', 'Friend request accepted!');

    }

    // Decline Friend Request
    public function declineRequest($email)
    {
        // Find the user based on email
        $friend = User::where('email', $email)->firstOrFail();

        // Handle accepting the friend request logic (e.g., create a new friend relationship)
        $friendRequest = Friend::where('friend_id', Auth::id())
            ->where('user_id', $friend->id)
            ->where('status', 'pending')
            ->first();

        if (!$friendRequest) {
            return response()->json(['error' => 'No pending friend request found'], 404);
        }
        
        $friendRequest->update(['status' => 'declined']);
        
        // Redirect back with a success message
        return back()->with('success', 'Friend request declined!');
    }

    

}
