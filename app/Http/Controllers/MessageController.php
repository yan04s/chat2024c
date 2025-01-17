<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatMessage as Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use App\Events\MessageDeleted;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\User;

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

    public function transcript(Request $request, User $friend)
    {
        $messages = Message::where(function ($query) use ($friend) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $friend->id);
        })
            ->orWhere(function ($query) use ($friend) {
                $query->where('sender_id', $friend->id)
                    ->where('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('id', 'asc')
            ->get();

        if ($request->has('preview')) {
            $imageDisplayPath = '/storage/';
            return view('chatTranscript', compact('messages', 'imageDisplayPath'));
        };
        $imageDisplayPath = public_path('storage/');

        //Log::info($messages); //[2025-01-15 14:57:45] local.INFO: [{"id":1,"receiver_id":2,"sender_id":1,"text":"Hey there, I am using ICE!","images":["chat_images\/jXR5T2ghkDmClUoibBRkc2kLkBa9X7Bfwu9mFYss.jpg"],"created_at":"2025-01-09T15:00:44.000000Z","updated_at":"2025-01-09T15:00:44.000000Z","sender":{"id":1,"name":"yan","email":"tan828825@gmail.com","email_verified_at":null,"facebook_id":"2194005417436797","avatar":"https:\/\/graph.facebook.com\/v3.3\/2194005417436797\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-10T14:17:21.000000Z"},"receiver":{"id":2,"name":"bing","email":"tby789111@gmail.com","email_verified_at":null,"facebook_id":"1372148920826510","avatar":"https:\/\/graph.facebook.com\/v3.3\/1372148920826510\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-11T13:11:02.000000Z"}},{"id":2,"receiver_id":1,"sender_id":2,"text":"Nice to Meet You :)","images":["chat_images\/I7KM8kTxEsEJwKjLcIWhamiWaWxbSShFGDP1TJGW.jpg"],"created_at":"2025-01-09T15:02:05.000000Z","updated_at":"2025-01-09T15:02:05.000000Z","sender":{"id":2,"name":"bing","email":"tby789111@gmail.com","email_verified_at":null,"facebook_id":"1372148920826510","avatar":"https:\/\/graph.facebook.com\/v3.3\/1372148920826510\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-11T13:11:02.000000Z"},"receiver":{"id":1,"name":"yan","email":"tan828825@gmail.com","email_verified_at":null,"facebook_id":"2194005417436797","avatar":"https:\/\/graph.facebook.com\/v3.3\/2194005417436797\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-10T14:17:21.000000Z"}},{"id":3,"receiver_id":2,"sender_id":1,"text":"Friday Night","images":["chat_images\/ltTI0akErxquIpPqkvTV752Clh10uwL89c8xDOxY.jpg"],"created_at":"2025-01-10T12:25:49.000000Z","updated_at":"2025-01-11T09:34:50.000000Z","sender":{"id":1,"name":"yan","email":"tan828825@gmail.com","email_verified_at":null,"facebook_id":"2194005417436797","avatar":"https:\/\/graph.facebook.com\/v3.3\/2194005417436797\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-10T14:17:21.000000Z"},"receiver":{"id":2,"name":"bing","email":"tby789111@gmail.com","email_verified_at":null,"facebook_id":"1372148920826510","avatar":"https:\/\/graph.facebook.com\/v3.3\/1372148920826510\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-11T13:11:02.000000Z"}},{"id":4,"receiver_id":2,"sender_id":1,"text":"Dinner","images":["chat_images\/IUua2NBFh9nG530lhkjQZXJRt4TPhA1kYyYmaMC8.jpg","chat_images\/7pvWsIRN7UB9qA9aTyl9UbyejjqVQvXm1FuAu3Jm.jpg","chat_images\/JF96R5yT4Wv0jATRdNRde5hLWiYUAIRsB1iC5fmB.jpg","chat_images\/ZmnPEGg5TxHF9tW3GRaJIoxdRsZWh7AP7dDU8pZR.jpg","chat_images\/rc8VPfdZMezNpxpG99rCVgWGkw925yoWWrgkxUHU.jpg"],"created_at":"2025-01-10T12:38:22.000000Z","updated_at":"2025-01-11T09:31:17.000000Z","sender":{"id":1,"name":"yan","email":"tan828825@gmail.com","email_verified_at":null,"facebook_id":"2194005417436797","avatar":"https:\/\/graph.facebook.com\/v3.3\/2194005417436797\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-10T14:17:21.000000Z"},"receiver":{"id":2,"name":"bing","email":"tby789111@gmail.com","email_verified_at":null,"facebook_id":"1372148920826510","avatar":"https:\/\/graph.facebook.com\/v3.3\/1372148920826510\/picture","created_at":"2024-12-29T10:01:43.000000Z","updated_at":"2025-01-11T13:11:02.000000Z"}}]  
        $pdf = PDF::loadView('chatTranscript', compact('messages', 'imageDisplayPath'));
        return $pdf->download('transcript.pdf');
        //return $pdf->stream();
        //return view('chatTranscript', compact('messages'));
    }
}
