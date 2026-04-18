@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8" x-data="{ tab: 'profil', showActivityModal: false, showRequestModal: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Profil -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden mb-8 relative">
            <div class="h-32 bg-gradient-to-r from-teal-700 to-green-600"></div>
            <div class="px-8 pb-8 relative">
                <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-12 sm:-mt-16 gap-6">
                    <div class="h-24 w-24 sm:h-32 sm:w-32 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex-shrink-0">
                        @if($user->attachment5)
                            <img src="{{ asset('storage/' . $user->attachment5) }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="text-center sm:text-left flex-grow">
                        <h1 class="text-3xl font-black text-gray-900">{{ $user->name }}</h1>
                        <p class="text-teal-600 font-medium text-lg">{{ $user->denomination }}</p>
                    </div>
                    <div class="flex gap-3 mt-4 sm:mt-0">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-teal-100 text-teal-800">
                            {{ $user->groupe ? Str::title($user->groupe->value) : '-' }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Navigation des Onglets -->
            <div class="bg-gray-50/50 border-t border-gray-100 px-8 flex overflow-x-auto">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button @click="tab = 'profil'" :class="tab === 'profil' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Mon Profil
                    </button>
                    <button @click="tab = 'activites'" :class="tab === 'activites' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Mes Activités
                    </button>
                    <button @click="tab = 'demandes'" :class="tab === 'demandes' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Mes Demandes
                    </button>
                    <!-- Bouton Déconnexion -->
                    <form method="POST" action="{{ route('user.logout') }}" class="ml-auto mt-2">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm px-4 py-2 hover:bg-red-50 rounded-lg transition-colors">
                            Déconnexion
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- CONTENU DES ONGLETS -->
        <div class="w-full">
            
            <!-- ONGLET 1 : PROFIL -->
            <div x-show="tab === 'profil'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                <!-- Info Section -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-4">Informations Générales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                        <div>
                            <p class="text-gray-500 mb-1">Domaine d'intervention</p>
                            <p class="font-semibold text-gray-900 text-base">{{ $user->domaine }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-1">Email (Identifiant)</p>
                            <p class="font-semibold text-gray-900 text-base">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-1">Siège / Localisation</p>
                            <p class="font-semibold text-gray-900 text-base">{{ $user->siege }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-1">Téléphones</p>
                            <p class="font-semibold text-gray-900 text-base">{{ $user->number1 }} @if($user->number2) / {{ $user->number2 }} @endif</p>
                        </div>
                    </div>
                </div>

                <!-- Bureau Section -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-4">Membres du Bureau</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-2">Président</p>
                            <p class="font-bold text-gray-900">{{ $user->name_president }} {{ $user->last_name_president }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-2">Vice-Président</p>
                            <p class="font-bold text-gray-900">{{ $user->name_vice_president ?: '-' }} {{ $user->last_name_vice_president ?: '-' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-2">Secrétaire G.</p>
                            <p class="font-bold text-gray-900">{{ $user->name_secretaire_general ?: '-' }} {{ $user->last_name_secretaire_general ?: '-' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-2">Trésorier</p>
                            <p class="font-bold text-gray-900">{{ $user->name_tresorier_general ?: '-' }} {{ $user->last_name_tresorier_general ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ONGLET 2 : ACTIVITÉS -->
            <div x-show="tab === 'activites'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                        <h3 class="text-xl font-bold text-gray-900">Historique des Activités</h3>
                        <button @click="showActivityModal = true" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
                            + Ajouter une activité
                        </button>
                    </div>

                    <!-- Liste des activités (à boucler) -->
                    @if($user->activities && $user->activities->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($user->activities as $activity)
                            <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                                <img src="{{ asset('storage/' . $activity->attachment) }}" class="w-full h-40 object-cover bg-gray-100">
                                <div class="p-4 flex-grow flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-gray-900">{{ $activity->titre }}</h4>
                                            @if($activity->is_visible)
                                                <span class="px-2 py-1 text-xs font-bold bg-green-100 text-green-700 rounded-lg">Publié</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-bold bg-yellow-100 text-yellow-700 rounded-lg">En attente</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 mb-2">{{ $activity->created_at->format('d/m/Y') }}</p>
                                        <p class="text-sm text-gray-600 line-clamp-2">{{ $activity->description }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            <p class="text-gray-500">Aucune activité enregistrée.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ONGLET 3 : DEMANDES -->
            <div x-show="tab === 'demandes'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                        <h3 class="text-xl font-bold text-gray-900">Mes Demandes d'accompagnement</h3>
                        <button @click="showRequestModal = true" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
                            Écrire au Maire
                        </button>
                    </div>

                    <!-- Tableau des demandes -->
                    <div class="overflow-x-auto text-sm">
                        @if($user->associationRequests && $user->associationRequests->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 text-gray-500 uppercase">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Objet de la Demande</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Justificatif</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->associationRequests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $request->objet }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/' . $request->attachment) }}" target="_blank" class="text-teal-600 hover:underline">Voir PDF</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($request->status === \App\Enums\RequestStatus::PENDING)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En cours</span>
                                        @elseif($request->status === \App\Enums\RequestStatus::APPROVED)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approuvé</span>
                                        @elseif($request->status === \App\Enums\RequestStatus::REJECTED)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejeté</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                <p class="text-gray-500">Aucune demande envoyée.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL AJOUT ACTIVITÉ -->
    <div x-show="showActivityModal" style="display: none;" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showActivityModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showActivityModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showActivityModal" x-transition.scale class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl leading-6 font-bold text-gray-900 mb-4" id="modal-title">Ajouter une Activité</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Titre de l'activité <span class="text-red-500">*</span></label>
                                <input type="text" name="titre" required class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:ring-teal-500 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Description détaillée <span class="text-red-500">*</span></label>
                                <textarea name="description" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:ring-teal-500 focus:border-teal-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Affiche ou Photo (Image) <span class="text-red-500">*</span></label>
                                <input type="file" name="attachment" accept="image/*" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Enregistrer l'activité
                        </button>
                        <button type="button" @click="showActivityModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL NOUVELLE DEMANDE (LETTRE) -->
    <div x-show="showRequestModal" style="display: none;" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showRequestModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showRequestModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showRequestModal" x-transition.scale class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                <form action="{{ route('courrier.generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center gap-3 mb-4 border-b pb-4">
                            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-teal-100 text-teal-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl leading-6 font-bold text-gray-900" id="modal-title">Écrire à l'administration</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Objet de la demande <span class="text-red-500">*</span></label>
                                <input type="text" name="objet" placeholder="Ex: Demande de subvention, Audience..." required class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:ring-teal-500 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Lettre ou Fichier Justificatif (PDF) <span class="text-red-500">*</span></label>
                                <input type="file" name="attachment" accept="application/pdf" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Veuillez joindre une lettre officielle signée au format PDF.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Envoyer la demande
                        </button>
                        <button type="button" @click="showRequestModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
