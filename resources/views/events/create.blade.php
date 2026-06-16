<x-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-xl border border-gray-300 p-6 md:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Cadastrar Novo Evento</h1>
        <p class="text-xs text-gray-500 mb-6 border-b pb-4">Preencha todos os critérios regulamentados do sistema.</p>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label py-1"><span class="label-text font-semibold text-gray-600">Título do Evento</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                @error('title') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Categoria</span></label>
                    <select name="category_id" class="select select-bordered w-full bg-gray-50 focus:bg-white" required>
                        <option value="" disabled selected>Selecione...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Data e Hora</span></label>
                    <input type="datetime-local" name="date_time" value="{{ old('date_time') }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('date_time') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Localização</span></label>
                    <input type="text" name="location" value="{{ old('location') }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('location') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Lotação / Capacidade</span></label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" min="1" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('capacity') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-control">
                <label class="label py-1"><span class="label-text font-semibold text-gray-600">Descrição Detalhada</span></label>
                <textarea name="description" rows="4" class="textarea textarea-bordered w-full bg-gray-50 focus:bg-white resize-none" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="form-control">
                <label class="label py-1"><span class="label-text font-semibold text-gray-600">Banner de Divulgação (Máx 2MB)</span></label>
                <input type="file" name="banner" class="file-input file-input-bordered w-full bg-gray-50" required />
                @error('banner') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t">
                <a href="{{ route('events.index') }}" class="px-4 py-2 border rounded text-xs font-medium text-gray-600 hover:bg-gray-100">Cancelar</a>
                <button type="submit" class="px-5 py-2 rounded bg-[#425E83] hover:bg-[#6382aa] text-white text-xs font-semibold shadow">Publicar Evento</button>
            </div>
        </form>
    </div>
</x-layout>