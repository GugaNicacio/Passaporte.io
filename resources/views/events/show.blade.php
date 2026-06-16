<x-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-xl border border-gray-300 overflow-hidden">
            <div class="h-64 md:h-80 w-full bg-gray-300">
                <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover" />
            </div>
            <div class="p-6 md:p-8 space-y-4">
                <span class="inline-block px-3 py-1 bg-gray-100 border border-gray-400 rounded text-xs font-bold text-gray-800">{{ $event->category->name }}</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ $event->title }}</h1>
                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line text-justify">{{ $event->description }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-xl border border-gray-300 p-6 space-y-4 sticky top-6">
            <h3 class="font-bold text-lg border-b pb-2 text-gray-800">Informações de Acesso</h3>
            
            <div class="space-y-3 text-xs text-gray-700">
                <div><p class="font-bold text-gray-500">Data e Horário</p><p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y \à\s H:i') }}</p></div>
                <div><p class="font-bold text-gray-500">Local</p><p class="font-medium text-gray-900">{{ $event->location }}</p></div>
                <div><p class="font-bold text-gray-500">Organizador por</p><p class="font-medium text-gray-900">{{ $event->organizer->name }}</p></div>
                <div><p class="font-bold text-gray-500">Lotação Máxima</p><p class="font-medium text-gray-900">{{ $event->capacity }} vagas no total</p></div>
            </div>

            <div class="border-t pt-4 mt-2">
                @auth
                    @if(auth()->user()->role === 'participant')
                        @php
                            $jaInscrito = $event->participants->contains(auth()->id());
                            $lotado = $event->participants()->count() >= $event->capacity;
                        @endphp

                        @if($jaInscrito)
                            <div class="p-3 bg-green-100 border border-green-400 text-green-800 rounded-lg text-xs font-bold text-center"> Inscrição Ativa Confimada</div>
                            <a href="{{ route('subscriptions.index') }}" class="block mt-2 text-center text-xs text-gray-600 underline font-medium hover:text-black">Ver Meus Ingressos</a>
                        @elseif($lotado)
                            <div class="p-3 bg-red-100 border border-red-400 text-red-800 rounded-lg text-xs font-bold text-center">Vagas Totalmente Esgotadas</div>
                        @else
                            <form action="{{ route('subscriptions.store', $event) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-2.5 rounded bg-[#425E83] text-white text-sm font-semibold shadow hover:bg-[#6382aa] transition-colors">
                                    Gerar Passaporte Digital
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="p-3 bg-yellow-50 border border-yellow-300 text-yellow-800 rounded-lg text-xs font-medium text-center">Organizadores não efetuam inscrições em listas.</div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full py-2.5 text-center rounded bg-[#425E83] text-white text-sm font-semibold shadow hover:bg-[#6382aa] transition-colors">
                        Faça Log In para se Inscrever
                    </a>
                @endauth
            </div>
        </div>

    </div>
</x-layout>