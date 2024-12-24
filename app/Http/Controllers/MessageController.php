<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatMessage as Message;

class MessageController extends Controller
{
    /**
     * Update the specified message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        // Ensure the user is the sender of the message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate the new message text
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);

        // Update the message
        $message->text = $request->text;
        $message->save();

        return response()->json($message);
    }

    /**
     * Remove the specified message from storage.
     *
     * @param  int  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        // Ensure the user is the sender of the message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete the message
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
}
