<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\ChatMessage;
use App\Events\MessageSent;
use App\Events\FetchMessage;

use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Auth;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard', [
        //'users' => User::whereNot('id', auth()->id())->get()
        'users' => Friend::where('user_id', Auth::id())->orWhere('friend_id', Auth::id())->where('status', 'accepted')
        ->leftJoin('users', function ($join) {
            $join->on('users.id', '=', DB::raw('CASE WHEN friends.user_id = ' . Auth::id() . ' THEN friends.friend_id ELSE friends.user_id END'));
        })
        ->select('friends.*', 'users.name as friend_name', 'users.email as friend_email', 'users.id as friend_id')
        ->get(),
        'friendRequests' => Friend::where('friend_id', Auth::id())->where('status', 'pending')
        ->leftJoin('users', 'users.id', '=', 'friends.user_id') // Join with the users table to get the sender's data
        ->select('friends.*', 'users.name as sender_name', 'users.email as sender_email') // Select fields you need
        ->get(),
    ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/friends/send', [FriendController::class, 'sendRequest'])->name('friend.send');
    Route::post('/friends/accept/{email}', [FriendController::class, 'acceptRequest'])->name('friend.accept');
    Route::post('/friends/decline/{email}', [FriendController::class, 'declineRequest'])->name('friend.decline');
});

Route::get('/chat/{friend}', function (User $friend) {
    return view('chat', [
        'friend' => $friend
    ]);
})->middleware(['auth'])->name('chat');

Route::get('/messages/{friend}', function (User $friend) {
    return ChatMessage::query()
        ->where(function ($query) use ($friend) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $friend->id);
        })
        ->orWhere(function ($query) use ($friend) {
            $query->where('sender_id', $friend->id)
                ->where('receiver_id', auth()->id());
        })
       ->with(['sender', 'receiver'])
       ->orderBy('id', 'asc')
       ->get();
})->middleware(['auth']);

Route::post('/messages/{friend}', function (User $friend, Request $request) {
    $request->validate([
        'message' => 'nullable|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:3072', // Validation for multiple images
    ]);

    $uploadedImagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('chat_images', 'public'); // Save to storage/app/public/chat_images
            $uploadedImagePaths[] = $path;
        }
    }
    //Log::info($uploadedImagePaths);

    $message = ChatMessage::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $friend->id,
        'text' => $request->message,
        'images' => $uploadedImagePaths,//json_encode($uploadedImagePaths), // Save images as JSON
    ]);

    // Broadcast the message event
    broadcast(new MessageSent($message));
    //broadcast(new FetchMessage($message));

    return $message;
    
    // $message = ChatMessage::create([
    //     'sender_id' => auth()->id(),
    //     'receiver_id' => $friend->id,
    //     'text' => request()->input('message')
    // ]);

    // broadcast(new MessageSent($message));

    // return  $message;
});

Route::middleware('auth')->group(function () {
    // Edit message
    Route::post('/messages/edit/{message}', [MessageController::class, 'update'])->name('messages.update');

    // Delete message
    Route::delete('/messages/delete/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

// https://www.freecodecamp.org/news/how-to-set-up-google-auth-in-laravel-apps/
// Route to redirect to Google's OAuth page
Route::get('/auth/google/redirect', [LoginController::class, 'redirect'])->name('auth.google.redirect');

// Route to handle the callback from Google
Route::get('/auth/google/callback', [LoginController::class, 'callback'])->name('auth.google.callback');

// Route to redirect to Facebook's OAuth page
Route::get('/auth/facebook/redirect', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook.redirect');

// Route to handle the callback from Facebook
Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');


require __DIR__.'/auth.php';