<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // RNF04: Carregamento Ansioso (Eager Loading) das relações para evitar consultas em loops
        $query = Event::with(['category', 'organizer'])->where('date_time', '>', now());

        // RF13: Filtro por categoria
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->orderBy('date_time', 'asc')->paginate(12);
        $categories = Category::orderBy('name', 'asc')->get();

        return view('home', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        // Carrega os dados necessários para a tela específica do evento
        $event->load(['category', 'organizer']);
        return view('events.show', compact('event'));
    }
}