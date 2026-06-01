@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <a href="{{ route('accueil') }}#activite" class="inline-flex items-center gap-2 text-sm font-bold text-teal-700 hover:text-teal-800 mb-6">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour aux activités
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">
                <div class="lg:col-span-3">
                    <div class="aspect-video bg-gray-100 rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                        <img src="{{ asset('storage/' . $activity->attachment) }}" alt="{{ $activity->titre }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <p class="text-sm font-black uppercase tracking-wider text-teal-700 mb-2">{{ $activity->created_at->format('d/m/Y') }}</p>
                        <h1 class="text-3xl lg:text-4xl font-black text-gray-900 leading-tight">{{ $activity->titre }}</h1>
                    </div>

                    <a href="{{ route('association.details', $activity->user->id) }}" class="flex items-center gap-4 rounded-2xl bg-gray-50 border border-gray-100 p-4 hover:bg-teal-50 hover:border-teal-100 transition-colors">
                        <div class="h-14 w-14 rounded-xl bg-white overflow-hidden border border-gray-100 shadow-sm shrink-0">
                            @if($activity->user->logo_path)
                                <img src="{{ asset('storage/' . $activity->user->logo_path) }}" alt="{{ $activity->user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-teal-50 text-teal-700 font-black">{{ substr($activity->user->name, 0, 1) }}</div>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Structure</p>
                            <p class="font-black text-gray-900">{{ $activity->user->name }}</p>
                        </div>
                    </a>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white border border-gray-100 rounded-2xl p-4">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Lieu</p>
                            <p class="font-bold text-gray-900">{{ $activity->lieu }}</p>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-2xl p-4">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Date prévue</p>
                            <p class="font-bold text-gray-900">{{ $activity->date?->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-2xl p-4">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Bénéficiaires</p>
                            <p class="font-bold text-gray-900">{{ number_format($activity->beneficiaries_expected ?? 0, 0, ',', ' ') }}</p>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-2xl p-4">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Public cible</p>
                            <p class="font-bold text-gray-900">{{ $activity->target_audience }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm">
            <h2 class="text-xl font-black text-gray-900 mb-4">Description de l'activité</h2>
            <p class="text-gray-700 leading-8 whitespace-pre-line">{{ $activity->description }}</p>
        </div>
    </section>
</div>
@endsection
