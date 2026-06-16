<x-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-xl border border-gray-300 p-6 md:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Editar Evento</h1>
        <p class="text-xs text-gray-500 mb-6 border-b pb-4">Ajuste os dados necessários de governança do evento.</p>

        <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-control">
                <label class="label py-1"><span class="label-text font-semibold text-gray-600">Título do Evento</span></label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                @error('title') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Categoria</span></label>
                    <select name="category_id" class="select select-bordered w-full bg-gray-50 focus:bg-white" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Data e Hora</span></label>
                    <input type="datetime-local" name="date_time" value="{{ old('date_time', \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i')) }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('date_time') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Localização</span></label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                </div>

                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Capacidade</span></label>
                    <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" min="1" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                </div>
            </div>

            <div class="form-control">
                <label class="label py-1"><span class="label-text font-semibold text-gray-600">Descrição Detalhada</span></label>
                <textarea name="description" rows="4" class="textarea textarea-bordered w-full bg-gray-50 focus:bg-white resize-none" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="form-control">
                <label class="label py-1"><span class="label-text font-semibold text-gray-600">Alterar Imagem de Banner (Opcional)</span></label>
                <div class="mb-2 flex items-center gap-3 p-2 bg-gray-100 rounded border">
                    <div class="w-16 h-10 rounded overflow-hidden shrink-0 bg-neutral">
                        <img src="{{ asset('storage/' . $event->banner_path) }}" class="w-full h-full object-cover" />
                    </div>
                    <span class="text-xs text-gray-500">Banner atualmente visível no portal.</span>
                </div>
                <input type="file" name="banner" class="file-input file-input-bordered w-full bg-gray-50" />
                @error('banner') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t">
                <a href="{{ route('events.index') }}" class="px-4 py-2 border rounded text-xs font-medium text-gray-600 hover:bg-gray-100">Cancelar</a>
                <button type="submit" class="px-5 py-2 rounded bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold shadow">Atualizar Dados</button>
            </div>
        </form>
    </div>
</x-layout>