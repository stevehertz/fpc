<?php 

namespace App\Repositories;

use App\Models\Event;

class AttendanceRepository
{
    public function getAllAttendances()  
    {
        
    }

    public function getAttendanceForAnEvent(Event $event)  
    {
        
    }

    public function storeAttendance(array $attributes)  
    {
        $event = Event::findOrFail(data_get($attributes, 'event_id'));
        if($event)
        {
            $attendance = $event->attendance()->create([
                'first_name' => data_get($attributes, 'first_name'),
                'last_name' => data_get($attributes, 'last_name'),
                'phone' => data_get($attributes, 'phone'),
                'email' => data_get($attributes, 'email'),
                'organization' => data_get($attributes, 'organization'),
                'position' => data_get($attributes, 'position'),
                'user_type' => data_get($attributes, 'user_type'),
            ]);

            return $attendance;
        }

        return false;
    }
}