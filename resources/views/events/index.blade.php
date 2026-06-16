<x-layout>
    <div class="bg-white rounded-xl shadow-xl border border-gray-300 p-6 md:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-4 border-b border-gray-200">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Painel do Organizador</h1>
                <p class="text-xs text-gray-500">Listagem de eventos criados e controle corporativo.</p>
            </div>
            <a href="{{ route('events.create') }}" class="px-4 py-2 text-xs font-semibold rounded-lg bg-[#425E83] text-white shadow hover:bg-[#6382aa] transition-colors">+ Novo Evento</a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="table-auto w-full border-collapse text-left text-sm text-gray-600">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 font-bold border-b border-gray-300 text-xs uppercase tracking-wider">
                        <th class="p-3">Evento</th>
                        <th class="p-3">Data / Hora</th>
                        <th class="p-3">Inscritos</th>
                        <th class="p-3 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($events as $event)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-10 rounded bg-gray-200 overflow-hidden border shrink-0">
                                        <img src="{{ asset('storage/' . $event->banner_path) }}" class="w-full h-full object-cover" />
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $event->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $event->category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 font-medium">{{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y H:i') }}</td>
                            <td class="p-3"><span class="font-bold text-gray-900">{{ $event->participants()->count() }}</span> / {{ $event->capacity }}</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('events.edit', $event) }}" class="px-2 py-1 text-xs border border-gray-400 bg-white hover:bg-gray-100 rounded text-gray-800 font-medium">Editar</a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Excluir este evento permanentemente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-xs bg-red-600 hover:bg-red-700 text-white font-medium rounded">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-400 italic">Você não possui nenhum evento publicado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $events->links() }}
        </div>
    </div>
</x-layout>