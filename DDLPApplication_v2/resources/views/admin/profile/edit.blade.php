@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-black text-slate-900">Profil administrateur</h1>
        <p class="text-sm text-slate-500 mt-1">Gérez votre accès au tableau de bord.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-200 text-sm font-bold">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
            <ul class="text-sm text-red-700 list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Nom</p>
                <p class="font-bold text-slate-900">{{ $admin->nom ?: 'Non renseigné' }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Prénom</p>
                <p class="font-bold text-slate-900">{{ $admin->prenom ?: 'Non renseigné' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Email</p>
                <p class="font-bold text-slate-900">{{ $admin->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-5" x-data="{ current: false, password: false, confirmation: false }">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-black text-slate-900 border-t border-gray-100 pt-6">Modifier mon mot de passe</h2>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Mot de passe actuel</label>
                <div class="relative">
                    <input :type="current ? 'text' : 'password'" name="current_password" required class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 focus:border-teal-500 focus:ring-teal-500">
                    <button type="button" @click="current = !current" class="absolute inset-y-0 right-0 px-4 text-gray-400 hover:text-teal-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nouveau mot de passe</label>
                    <div class="relative">
                        <input :type="password ? 'text' : 'password'" name="password" required minlength="8" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 focus:border-teal-500 focus:ring-teal-500">
                        <button type="button" @click="password = !password" class="absolute inset-y-0 right-0 px-4 text-gray-400 hover:text-teal-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Confirmation</label>
                    <div class="relative">
                        <input :type="confirmation ? 'text' : 'password'" name="password_confirmation" required minlength="8" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 focus:border-teal-500 focus:ring-teal-500">
                        <button type="button" @click="confirmation = !confirmation" class="absolute inset-y-0 right-0 px-4 text-gray-400 hover:text-teal-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-xl bg-teal-700 px-6 py-3 font-bold text-white hover:bg-teal-800">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
