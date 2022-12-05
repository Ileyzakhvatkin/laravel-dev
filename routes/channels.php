<?php

use App\Broadcasting\AdminChannel;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('admin-channel.{id}', function (User $user, $id) {
    return $user->isAdmin();
});
