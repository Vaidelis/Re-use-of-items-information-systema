<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessageController extends Controller
{
    public function index()
    {
        $threads = Thread::forUser(Auth::id())
            ->withCount('messages')
            ->latest()
            ->get()
            ->reject(function ($value) {
                return $value->messages_count == 1 && $value->creator() == Auth::user();
            });

        return view('messageList', compact('threads'));
    }
    public function show(Thread $thread)
    {
        $thread->markAsRead(Auth::id());

        return view('messageScreen', compact('thread'));
    }
    public function create($id)
    {
        $users = User::find($id);

        return view('messageCreate', compact('users'));
    }
    public function store(Request $request)
    {
        $thread = Thread::create([
            'subject' => $request->subject,
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $request->message,
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        $thread->addParticipant($request->recipient);

        return redirect()->route('openmessagelist')->with('success', 'Message sent successfully.');
    }
    public function destroy(Thread $thread)
    {
        $thread->removeParticipant(Auth::id());

        return redirect()->route('openmessagelist')->with('success', 'Thread deleted successfully.');
    }
    public function update(Request $request, Thread $thread)
    {
        $thread->activateAllParticipants();

        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $request->message,
        ]);

        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);

        $participant->last_read = new Carbon;
        $participant->save();

        return redirect()->route('openmessagelist')->with('success', 'Atsakėte į žinutę.');
    }
}
