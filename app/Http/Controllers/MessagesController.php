<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function feedback()
    {
        $messages = Message::latest()->get();
        return view('admin.feedback', compact('messages'));
    }

    public function contacts()
    {
        return view('pages.contacts');
    }

    public function store()
    {
        $this->validate(request(), [
            'mail' => 'required|email',
            'message' => 'required|max:255',
        ]);

        Message::create(request()->all());
        flash('Ваше сообщение успешно отправлено!', 'success');

        return redirect('/contacts');
    }
}
