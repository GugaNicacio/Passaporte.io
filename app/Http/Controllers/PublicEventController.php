<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    //
     public function index(Request $request)
    {
        $query = Event::with([
            'category',
            'organizer'
        ])
        ->where(
            'date_time',
            '>',
            now()
        );

        if($request->filled('category'))
        {
            $query->where(
                'category_id',
                $request->category
            );
        }

        $events = $query
            ->latest()
            ->paginate(9);

        $categories = Category::all();

        return view(
            'home',
            compact(
                'events',
                'categories'
            )
        );
    }

    public function show(Event $event)
    {
        $event->load([
            'category',
            'organizer',
            'participants'
        ]);

        return view(
            'events.show',
            compact('event')
        );
    }
}
