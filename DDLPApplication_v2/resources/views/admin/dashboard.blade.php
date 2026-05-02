@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- En-tête -->
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800">Bienvenue dans l'Administration</h1>
            <p class="text-slate-500 mt-2">Gérez les structures, suivez les activités et traitez les courriers depuis votre barre de navigation.</p>
        </div>
        <div class="flex-shrink-0">
            <div class="h-20 w-20 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Raccourcis Rapides -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Raccourci Associations -->
        <a href="{{ route('admin.associations.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-teal-500 hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">{{ $userCount }} Enregistrées</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Structures & ONG</h3>
                <p class="text-sm text-slate-500 mt-1">Gérer le répertoire des associations de la commune.</p>
            </div>
        </a>

        <!-- Raccourci Courriers -->
        <a href="{{ route('admin.requests.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-teal-500 hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="h-12 w-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                @if($pendingRequestsCount > 0)
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">{{ $pendingRequestsCount }} En attente</span>
                @else
                    <span class="bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1 rounded-full">À jour</span>
                @endif
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Courriers & Demandes</h3>
                <p class="text-sm text-slate-500 mt-1">Traiter les lettres et correspondances des associations.</p>
            </div>
        </a>

        <!-- Raccourci Activités -->
        <a href="{{ route('admin.activities.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-teal-500 hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="h-12 w-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">{{ $activityCount }} Publiées</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Galerie des Activités</h3>
                <p class="text-sm text-slate-500 mt-1">Modérer et valider les activités soumises sur la plateforme.</p>
            </div>
        </a>
    </div>

</div>
@endsection
