<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        // RNF04 & RNF05: Eager loading e Paginação
        $events = auth()->user()->events()
            ->with(['category'])
            ->orderBy('date_time', 'desc')
            ->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // RN01 e RN02: Validações estritas do edital
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date|after:now', // RN01: Data futura obrigatória
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'banner' => 'required|image|max:2048', // RN02: Imagem de no máximo 2MB
        ]);

        // RNF09: Ofuscação de nomes de arquivo automatizada
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('banners', 'public');
            $validated['banner_path'] = $path;
        }

        // RN07: Vinculado automaticamente ao usuário logado (sem campo oculto no HTML)
        $request->user()->events()->create($validated);

        return redirect()->route('events.index')->with('success', 'Evento cadastrado com sucesso!');
    }

    public function edit(Event $event)
    {
        // RN09: Proteção de Propriedade Transversal
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'banner' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            if ($event->banner_path) {
                Storage::disk('public')->delete($event->banner_path);
            }
            $validated['banner_path'] = $request->file('banner')->store('banners', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Evento atualizado!');
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        // RN03: Não pode excluir evento que possua inscritos
        if ($event->participants()->count() > 0) {
            return back()->with('error', 'Impossível excluir. Este evento já possui participantes inscritos!');
        }

        if ($event->banner_path) {
            Storage::disk('public')->delete($event->banner_path);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento removido com sucesso.');
    }
}