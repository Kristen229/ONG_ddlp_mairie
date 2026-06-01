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
            @if(auth('admin')->user()?->is_super_admin)
                <form method="POST" action="{{ route('admin.stats.pdf') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-teal-700 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-teal-800 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Exporter le tableau de bord
                    </button>
                </form>
            @else
                <div class="h-20 w-20 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
            @endif
        </div>
    </div>

    <!-- Raccourcis Rapides -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mt-8">
        <!-- Raccourci Candidatures -->
        <a href="{{ route('admin.candidates.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-red-500 hover:shadow-md transition-all flex flex-col justify-between relative overflow-hidden">
            @if($pendingCandidatesCount > 0)
                <div class="absolute top-0 right-0 w-16 h-16 bg-red-50 text-red-500 rounded-bl-full flex items-start justify-end p-3 pointer-events-none">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                </div>
            @endif
            <div class="flex justify-between items-start mb-4">
                <div class="h-12 w-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                @if($pendingCandidatesCount > 0)
                    <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full z-10">{{ $pendingCandidatesCount }} En attente</span>
                @else
                    <span class="bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1 rounded-full z-10">À jour</span>
                @endif
            </div>
            <div class="z-10">
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-red-600 transition-colors">Candidatures</h3>
                <p class="text-sm text-slate-500 mt-1">Examiner les nouvelles inscriptions.</p>
            </div>
        </a>

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

        <!-- Raccourci Avis Citoyens -->
        <a href="{{ route('admin.reviews.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-purple-500 hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="h-12 w-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">{{ $reviewCount }} Avis</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-purple-600 transition-colors">Avis Citoyens</h3>
                <p class="text-sm text-slate-500 mt-1">Consulter et modérer les retours laissés par le public.</p>
            </div>
        </a>
    </div>

    <!-- STATISTIQUES AVANCÉES -->
    <div class="mt-8 space-y-6">
        <h2 class="text-2xl font-black text-slate-800 flex items-center gap-2">
            <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Statistiques Avancées
        </h2>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500">Bénéficiaires touchés</p>
                    <p class="text-2xl font-black text-slate-800">{{ number_format($totalBeneficiaries, 0, ',', ' ') }}</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500">Taux de résolution (Courriers)</p>
                    <p class="text-2xl font-black text-slate-800">{{ $resolutionRate }}%</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500">ONG Enregistrées</p>
                    <p class="text-2xl font-black text-slate-800">{{ $ongCount }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500">Associations Enregistrées</p>
                    <p class="text-2xl font-black text-slate-800">{{ $associationCount }}</p>
                </div>
            </div>
        </div>

        <!-- GRAPHIQUES -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Camembert ONG vs Associations -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Répartition des Structures</h3>
                <div class="relative h-64 w-full">
                    <canvas id="repartitionChart"></canvas>
                </div>
            </div>

            <!-- Inscriptions mensuelles -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Inscriptions Mensuelles</h3>
                <div class="relative h-64 w-full">
                    <canvas id="inscriptionsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top 5 Domaines -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Top 5 - Domaines d'Intervention</h3>
                <div class="space-y-4">
                    @forelse($topDomaines as $domaine)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-slate-600 truncate mr-4">{{ $domaine->nom }}</span>
                            <span class="text-sm font-black text-slate-800 bg-slate-100 px-3 py-1 rounded-full">{{ $domaine->total }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-teal-500 h-2 rounded-full" style="width: {{ $userCount > 0 ? ($domaine->total / $userCount) * 100 : 0 }}%"></div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Aucune donnée disponible.</p>
                    @endforelse
                </div>
            </div>

            <!-- Répartition géographique -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Répartition par Arrondissement</h3>
                <div class="space-y-4 max-h-64 overflow-y-auto pr-2">
                    @forelse($repartitionGeo as $geo)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-slate-600">{{ $geo->arrondissement }}</span>
                            <span class="text-sm font-black text-slate-800">{{ $geo->total }} str.</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Aucune donnée géographique.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

<!-- INITIALISATION DES GRAPHIQUES -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Camembert
        const ctxRep = document.getElementById('repartitionChart').getContext('2d');
        new Chart(ctxRep, {
            type: 'doughnut',
            data: {
                labels: ['ONG', 'Associations'],
                datasets: [{
                    data: [{{ $ongCount }}, {{ $associationCount }}],
                    backgroundColor: ['#14b8a6', '#6366f1'], // Teal & Indigo
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '70%'
            }
        });

        // Line Chart Inscriptions
        const ctxIns = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctxIns, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Nouvelles Inscriptions',
                    data: {{ json_encode(array_values($countsByMonth)) }},
                    borderColor: '#f43f5e', // Rose
                    backgroundColor: 'rgba(244, 63, 94, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    });
</script>
@endsection
