<x-layout>
    <div class="flex justify-center items-center my-16">
        <div class="card bg-white w-full max-w-md shadow-xl border border-gray-300 rounded-xl">
            <form action="{{ route('login') }}" method="POST" class="card-body p-8">
                @csrf
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Entrar no Sistema</h2>

                <div class="form-control mb-3">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">E-mail</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                    @error('email') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label py-1"><span class="label-text font-semibold text-gray-600">Senha</span></label>
                    <input type="password" name="password" class="input input-bordered w-full bg-gray-50 focus:bg-white" required />
                </div>

                <button type="submit" class="w-full py-3 rounded-lg bg-[#425E83] text-white font-medium shadow-md hover:bg-[#6382aa] transition-colors">
                    Fazer Login
                </button>
            </form>
        </div>
    </div>
</x-layout>