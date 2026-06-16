<x-layout>
    <div class="flex justify-center items-center my-8">
        <div class="card bg-white w-full max-w-md shadow-xl border border-gray-300 rounded-xl">
            <form action="{{ route('register') }}" method="POST" class="card-body p-8">
                @csrf
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Criar Nova Conta</h2>

                <div class="form-control mb-3">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Nome Completo</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('name') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-3">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">E-mail</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('email') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Tipo de Perfil</span></label>
                    <div class="flex gap-4 p-2 bg-gray-100 rounded-lg border border-gray-200">
                        <label class="label cursor-pointer gap-2 flex-1 justify-center bg-white rounded p-2 shadow-xs border border-gray-300">
                            <input type="radio" name="role" value="participant" class="radio radio-sm" {{ old('role', 'participant') === 'participant' ? 'checked' : '' }} />
                            <span class="label-text font-medium text-gray-700">Participante</span>
                        </label>
                        <label class="label cursor-pointer gap-2 flex-1 justify-center bg-white rounded p-2 shadow-xs border border-gray-300">
                            <input type="radio" name="role" value="organizer" class="radio radio-sm" {{ old('role') === 'organizer' ? 'checked' : '' }} />
                            <span class="label-text font-medium text-gray-700">Organizador</span>
                        </label>
                    </div>
                    @error('role') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-3">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Senha</span></label>
                    <input type="password" name="password" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('password') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Confirmar Senha</span></label>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                </div>

                <button type="submit" class="w-full py-3 rounded-lg bg-[#425E83] text-white font-medium shadow-md hover:bg-[#6382aa] transition-colors">
                    Cadastrar no Passaporte.io
                </button>
            </form>
        </div>
    </div>
</x-layout>