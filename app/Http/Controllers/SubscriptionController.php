<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function store(Event $event)
    {
        $user = auth()->user();

        // RN06: Organizador não pode se inscrever em eventos
        if ($user->role === 'organizer') {
            return back()->with('error', 'Organizadores não possuem permissão para se inscrever em eventos.');
        }

        // RN04: Usuário não pode se inscrever duas vezes no mesmo evento
        if ($event->participants()->where('users.id', $user->id)->exists()) {
            return back()->with('error', 'Você já está inscrito neste evento.');
        }

        // RN05: Não pode ultrapassar a capacidade máxima
        if ($event->participants()->count() >= $event->capacity) {
            return back()->with('error', 'Inscrição mal-sucedida! O evento atingiu a lotação máxima.');
        }

        // RF09: Geração automática de ticket alfanumérico único com 12 dígitos
        $event->participants()->attach($user->id, [
            'ticket_code' => strtoupper(Str::random(12)),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Sua inscrição foi confirmada e seu passaporte foi gerado!');
    }

    public function index()
    {
        // RF10 e RNF04: Histórico de inscrições aplicando Eager Loading (evita o problema N+1)
        $events = auth()->user()->subscriptions()
            ->with(['category', 'organizer'])
            ->orderBy('event_user.created_at', 'desc')
            ->paginate(10);

        return view('subscriptions.index', compact('events'));
    }

    public function destroy(Event $event)
    {
        // RF11: Sistema de cancelamento (Remove o nome da lista e invalida o ingresso)
        auth()->user()->subscriptions()->detach($event->id);

        return back()->with('success', 'Sua inscrição foi cancelada e a vaga foi liberada.');
    }
}