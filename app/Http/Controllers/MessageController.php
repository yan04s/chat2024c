<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatMessage as Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use App\Events\MessageDeleted;
use Illuminate\Support\Facades\Storage;

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

        broadcast(new MessageSent($message));

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

        $receiverId = $message->receiver_id;
        $senderId = $message->sender_id;
        $messageId = $message->id;

        // Retrieve image paths (assume stored as JSON in the database)
        $imagePaths = $message->images; // Replace 'image_paths' with your actual column name

        // Delete each image file if it exists
        if (!empty($imagePaths) && is_array($imagePaths)) {
            foreach ($imagePaths as $imagePath) {
                //Log::info($imagePath.json_encode(\Storage::disk('public')->exists($imagePath)));
                //Log::info(json_encode(\Storage::disk('public')->delete($imagePath)));
                if (\Storage::disk('public')->exists($imagePath)) {
                    \Storage::disk('public')->delete($imagePath);
                }
            }
        }
        
        // Delete the message
        $message->delete();

        // Broadcast the deletion event
        broadcast(new MessageDeleted($messageId, $receiverId, $senderId))->toOthers();
        

        return response()->json(['message' => 'Message deleted successfully']);
    }
}
