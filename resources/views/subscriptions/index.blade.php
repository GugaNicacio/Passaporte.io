<x-layouts.app>
    <div class="bg-base-100 rounded-2xl shadow-xl p-6 md:p-8">
        <h1 class="text-3xl font-extrabold mb-6 text-base-content">Meus Passaportes Digitais</h1>

        <div class="overflow-x-auto w-full">
            <table class="table table-zebra w-full">
                <thead>
                    <tr class="text-base">
                        <th>Evento</th>
                        <th>Data / Hora</th>
                        <th>Categoria</th>
                        <th>Código do Ingresso</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <div class="font-bold text-md text-primary">{{ $event->title }}</div>
                                <span class="text-xs text-base-content/60">Organizado por: {{ $event->organizer->name }}</span>
                            </td>
                            <td>
                                <span class="font-semibold">{{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y') }}</span>
                                <span class="text-xs block text-base-content/60">{{ \Carbon\Carbon::parse($event->date_time)->format('H:i') }}</span>
                            </td>
                            <td><span class="badge badge-ghost">{{ $event->category->name }}</span></td>
                            <td>
                                <span class="badge badge-primary font-mono tracking-wider p-3 text-sm text-white font-bold shadow-sm">
                                    {{ $event->pivot->ticket_code }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('subscriptions.destroy', $event) }}" method="POST" onsubmit="return confirm('Tem certeza de que deseja cancelar sua inscrição e abrir mão de sua vaga?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm text-white font-semibold">Cancelar Inscrição</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">
                                Você ainda não se inscreveu em nenhum evento da plataforma.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    </div>
</x-layouts.app>