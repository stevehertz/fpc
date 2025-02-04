<?php 

namespace App\Repositories;

use App\Enums\EventPriority;
use App\Enums\EventStatus;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EventRepositories
{
    public function getAllEvents()
    {
        return Event::latest()->get();
    }

    public function storeEvent(array $attributes, ?UploadedFile $image = null)  
    {
        if(!$this->showCriticalEvent())
        {
            $event = Event::create([
                'name' => data_get($attributes, 'name'),
                'slug' => Str::slug(data_get($attributes, 'name')),
                'description' => data_get($attributes, 'description'),
                'status' => data_get($attributes, 'status'),
                'venue' => data_get($attributes, 'venue'),
                'theme' => data_get($attributes, 'theme'),
                'start_date' => data_get($attributes, 'start_date'),
                'end_date' => data_get($attributes, 'end_date'),
                'priority' => data_get($attributes, 'priority'),
                'image' => 'img/events/noimage.png'
            ]);
            
            // upload featured image
            if ($image) {
                $path = $image->store('img/events', 'public');
                $event->update(['image' => $path]);
            }
            return $event;
        } else {
            return false;
        }

    }

    public function showEventBySlug($slug)  
    {
        return Event::where('slug', $slug)->first();
    }

    public function showCriticalEvent($priority = EventPriority::CRITICAL)  
    {
        $event = Event::where('priority', $priority)->first();
        if($event)
        {
            return $event;
        }
        return false;
    }

    public function showUpcomingCriticalEvent($status = EventStatus::UPCOMING, $priority = EventPriority::CRITICAL)  
    {
        $event = Event::where('status', $status)->where('priority', $priority)->first();
        if($event)
        {
            return $event;
        }
        return false;
    }

    public function showEvent($id)  
    {
        return Event::findOrFail($id);
    }

    public function updateEvent(Event $event, array $attributes, ?UploadedFile $image = null)  
    {

        // $priority = EventPriority::getName($event->priority);
        // if($priority == EventPriority::getName(EventPriority::CRITICAL))
        // {
        //     $priority = $event->priority;
        // } else 
        // {
        //     $priority = data_get($attributes, 'priority');
        // }
        $event->update([
            'name' => data_get($attributes, 'name'),
            'slug' => Str::slug(data_get($attributes, 'name')),
            'description' => data_get($attributes, 'description'),
            'status' => data_get($attributes, 'status'),
            'venue' => data_get($attributes, 'venue'),
            'theme' => data_get($attributes, 'theme'),
            'start_date' => data_get($attributes, 'start_date'),
            'end_date' => data_get($attributes, 'end_date'),
            'priority' => data_get($attributes, 'priority'),
            'image' => $event->image
        ]);

        // upload featured image
        if ($image) {
            $path = $image->store('img/events', 'public');
            $event->update(['image' => $path]);
        }

        return $event;
    }

    public function deleteEvent(Event $event)  
    {
        // Delete the image from storage
        if($event->image)
        {
            if ($event->image != 'img/events/noimage.png') {
                Storage::disk('public')->delete($event->image);
            }
        }

        $event->delete();

        return true;
    }
}