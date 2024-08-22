<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepositories;

class EventController extends Controller
{

    private $eventRepositories;
    public function __construct(EventRepositories $eventRepositories)
    {
        $this->middleware('auth');
        $this->eventRepositories = $eventRepositories;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->eventRepositories->getAllEvents();
        return view('backend.events.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.events.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //
        if ($request->hasFile('image')) {
            $image = $request->file('image');
        } else {
            $image = null;
        }
        $data = $request->except("_token");
        $event = $this->eventRepositories->storeEvent($data, $image);
        if ($event) {
            return response()->json([
                'status' => true,
                'message' => trans('alerts.create', ['title' => 'an event'])
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Critical event already exists'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $this->eventRepositories->showEvent($id)
        ]);
    }

    /**
     * Display page the specified resource.
     */
    public function view($id)
    {
        $data = $this->eventRepositories->showEvent($id);
        return view('backend.events.view', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
        return view('backend.events.edit', [
            'data' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
        if ($request->hasFile('image')) {
            $image = $request->file('image');
        } else {
            $image = null;
        }

        $data = $request->except("_token");

        $event = $this->eventRepositories->updateEvent($event, $data, $image);

        if ($event) {
            return response()->json([
                'status' => true,
                'message' => trans('alerts.update', ['title' => 'an event'])
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        if ($this->eventRepositories->deleteEvent($event)) {
            return response()->json([
                'status' => true,
                'message' => trans('alerts.delete', ['title' => 'an event'])
            ]);
        }
    }
}
