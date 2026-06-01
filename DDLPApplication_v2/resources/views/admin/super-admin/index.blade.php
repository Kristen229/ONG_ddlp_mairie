@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ 
    showCreateModal: false, 
    showEditModal: false, 
    editAdmin: { id: null, email: '', is_super_admin: false }
}">
    
    <!-- En-tête -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 flex items-center gap-2">
                <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Gestion des Administrateurs
            </h1>
            <p class="text-sm text-slate-500 mt-1">Créez et gérez les accès au tableau de bord (Super Admin uniquement).</p>
        </div>
        <button @click="showCreateModal = true" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-md transition-colors flex items-center gap-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvel Administrateur
        </button>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-200 shadow-sm text-sm font-bold flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm">
            <ul class="text-sm text-red-700 list-disc pl-5 font-medium space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Rôle</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Date de création</th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-teal-100 text-teal-700 font-bold flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($admin->email, 0, 1)) }}
                                </div>
                                <span class="font-bold text-slate-800">{{ $admin->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($admin->is_super_admin)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                                    Super Admin
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                    Admin
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                            {{ $admin->created_at->format('d M. Y - H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button @click="editAdmin = { id: {{ $admin->id }}, email: '{{ addslashes($admin->email) }}', is_super_admin: {{ $admin->is_super_admin ? 'true' : 'false' }} }; showEditModal = true;" class="inline-flex items-center justify-center text-teal-600 hover:text-teal-900 bg-teal-50 hover:bg-teal-100 h-8 w-8 rounded-lg transition-colors border border-teal-100" title="Modifier">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            @if($admin->id !== auth('admin')->id())
                            <form method="POST" action="{{ route('admin.superadmin.destroy', $admin->id) }}" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 h-8 w-8 rounded-lg transition-colors border border-red-100" title="Supprimer">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL CREATE -->
    <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showCreateModal" x-transition.opacity class="fixed inset-0 bg-gray-900/75 transition-opacity" @click="showCreateModal = false" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="showCreateModal" @click.stop
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form method="POST" action="{{ route('admin.superadmin.store') }}">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-teal-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-black text-gray-900" id="modal-title">Nouvel Administrateur</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" required class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Mot de passe <span class="text-red-500">*</span></label>
                                        <input type="password" name="password" required minlength="8" class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                    </div>
                                    <div class="flex items-center gap-2 mt-4">
                                        <input type="checkbox" id="is_super_admin" name="is_super_admin" value="1" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 h-4 w-4">
                                        <label for="is_super_admin" class="text-sm font-bold text-gray-700">Rôle Super Administrateur</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-bold text-white hover:bg-teal-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Créer
                        </button>
                        <button type="button" @click="showCreateModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showEditModal" x-transition.opacity class="fixed inset-0 bg-gray-900/75 transition-opacity" @click="showEditModal = false" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="showEditModal" @click.stop
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form method="POST" :action="'/admin/super-admin/' + editAdmin.id">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-black text-gray-900" id="modal-title">Modifier l'Administrateur</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" :value="editAdmin.email" required class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Nouveau mot de passe <span class="text-xs text-gray-500 font-normal">(laisser vide pour ne pas modifier)</span></label>
                                        <input type="password" name="password" minlength="8" class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                    </div>
                                    <div class="flex items-center gap-2 mt-4" x-show="editAdmin.id !== {{ auth('admin')->id() }}">
                                        <input type="checkbox" id="edit_is_super_admin" name="is_super_admin" value="1" :checked="editAdmin.is_super_admin" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 h-4 w-4">
                                        <label for="edit_is_super_admin" class="text-sm font-bold text-gray-700">Rôle Super Administrateur</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-amber-500 text-base font-bold text-white hover:bg-amber-600 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Enregistrer
                        </button>
                        <button type="button" @click="showEditModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
