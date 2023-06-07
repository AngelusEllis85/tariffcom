<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserSavedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserSaved $event)
    {
        // Get the user from the event
        $user = $event->user;
        // Calculate the user's full name
        $fullName = $user->firstname;
        if ($user->middlename) {
            $fullName .= ' ' . $user->middlename;
        }
        $fullName .= ' ' . $user->lastname;
        
        // Calculate the user's middle initial
        $middleInitial = $user->middlename ? substr($user->middlename, 0, 1) . '.' : null;
        
        // Determine the user's avatar
        $avatar = $user->photo ? 'http://localhost/storage/uploads/' . $user->photo : null;
        
        // Determine the user's gender based on the prefixname
        $gender = null;
        if ($user->prefixname === 'Mr') {
            $gender = 'Male';
        } elseif ($user->prefixname === 'Mrs' || $user->prefixname === 'Ms') {
            $gender = 'Female';
        }
        
        // Create an array of details to update or create
        $details = [
            ['key' => 'Full name', 'type' => 'bio', 'value' => $fullName],
            ['key' => 'Middle Initial', 'type' => 'bio', 'value' => $middleInitial],
            ['key' => 'Avatar', 'type' => 'bio', 'value' => $avatar],
            ['key' => 'Gender', 'type' => 'bio', 'value' => $gender],
        ];
        
        // Update or create the details in the details table
        foreach ($details as $detail) {
            $user->details()->updateOrCreate(['key' => $detail['key'], 'type' => $detail['type']], $detail);
        }
    }
}