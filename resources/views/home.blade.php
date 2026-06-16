<x-layout>
    <div class="flex flex-wrap justify-center gap-2 mb-8 bg-white p-3 rounded-xl shadow-md border border-gray-300">
        <a href="{{ route('home') }}" class="px-4 py-1.5 text-sm rounded-md transition-all {{ !request('category_id') ? 'bg-[#425E83] text-white font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">Todos</a>
        @foreach($categories as $category)
            <a href="{{ route('home', ['category_id' => $category->id]) }}" 
               class="px-4 py-1.5 text-sm rounded-md transition-all {{ request('category_id') == $category->id ? 'bg-[#425E83] text-white font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white rounded-xl shadow-lg border border-gray-300 overflow-hidden flex flex-col">
                <div class="h-44 w-full bg-gray-200 relative">
                    <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover" />
                    <span class="absolute top-2 right-2 bg-gray-100 border border-gray-400 text-gray-800 text-xs font-bold px-2 py-1 rounded shadow-xs">{{ $event->category->name }}</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 truncate mb-1">{{ $event->title }}</h2>
                        <p class="text-xs text-gray-500 line-clamp-2 mb-3">{{ $event->description }}</p>
                        
                        <div class="text-xs space-y-1 text-gray-600 bg-gray-50 p-2 rounded border border-gray-200">
                            <p> {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y \à\s H:i') }}</p>
                            <p> {{ $event->location }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-3 border-t border-gray-200 mt-auto">
                        <span class="text-xs font-bold text-gray-700">Vagas: {{ $event->capacity - $event->participants()->count() }}</span>
                        <a href="{{ route('events.show', $event) }}" class="px-3 py-1.5 text-xs font-semibold rounded bg-[#425E83] hover:bg-[#6382aa] text-white shadow-xs transition-colors">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-md border border-gray-300">
                <p class="text-md font-semibold text-gray-500">Nenhum evento ativo encontrado.</p>
            </div>
        @endforelse
    </div>

    @if($events->hasPages())
        <div class="mt-12 flex justify-center w-full">
            <div class="bg-white px-4 py-2 rounded-xl shadow-md border border-gray-300 text-sm">
                {{ $events->links() }}
            </div>
        </div>
    @endif
</x-layout>