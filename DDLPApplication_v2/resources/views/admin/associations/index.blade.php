@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- En-tête -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Structures et ONG</h1>
            <p class="text-sm text-slate-500">Gérez l'ensemble des associations et ONG enregistrées à la commune.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('pdf.exportByDomaine', ['domaine' => request('domaine', 'all')]) }}" class="bg-indigo-50 text-indigo-700 hover:bg-indigo-100 hover:text-indigo-800 font-bold px-4 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2 border border-indigo-100 shadow-sm">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export PDF
            </a>
            <a href="{{ route('admin.export.excel') }}" class="bg-green-50 text-green-700 hover:bg-green-100 hover:text-green-800 font-bold px-4 py-2.5 rounded-xl text-sm transition-colors flex items-center gap-2 border border-green-100 shadow-sm">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </a>
            <a href="{{ route('admin.createForm1') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-md transition-colors flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nouveau
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200">
        <form method="GET" action="{{ route('admin.associations.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une structure..." class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="w-full md:w-64">
                <select name="type" class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tous les types</option>
                    <option value="ong" {{ request('type') === 'ong' ? 'selected' : '' }}>ONG</option>
                    <option value="association" {{ request('type') === 'association' ? 'selected' : '' }}>Association</option>
                </select>
            </div>

            <div class="w-full md:w-72">
                <select name="domaine" class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tous les domaines</option>
                    @foreach($domainesList as $domaine)
                        <option value="{{ $domaine }}" {{ request('domaine') === $domaine ? 'selected' : '' }}>
                            {{ \Illuminate\Support\Str::limit($domaine, 40) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-slate-800 transition-colors">
                    Filtrer
                </button>
                @if(request()->anyFilled(['search', 'type', 'domaine']))
                    <a href="{{ route('admin.associations.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors flex items-center">
                        Effacer
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Logo & Nom</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Domaine</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($users as $u)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200 flex items-center justify-center">
                                    @if($u->logo_path) 
                                        <img src="{{ asset('storage/' . $u->logo_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-slate-400 font-bold text-lg">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="w-48 xl:w-64">
                                    <p class="text-sm font-bold text-slate-900 truncate" title="{{ $u->name }}">{{ $u->name }}</p>
                                    <p class="text-xs text-slate-500 truncate">{{ $u->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($u->groupe && strtolower($u->groupe->value) === 'ong')
                                <span class="px-3 py-1 text-xs font-black rounded-lg bg-blue-100 text-blue-800 shadow-sm border border-blue-200">ONG</span>
                            @else
                                <span class="px-3 py-1 text-xs font-black rounded-lg bg-green-100 text-green-800 shadow-sm border border-green-200">ASSO</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-slate-700 truncate max-w-[150px] inline-block" title="{{ is_array($u->domaine) ? implode(', ', $u->domaine) : $u->domaine }}">{{ is_array($u->domaine) ? implode(', ', $u->domaine) : ($u->domaine ?: 'Non défini') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-600">
                            {{ $u->number1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('account.show', $u->id) }}" class="inline-flex items-center justify-center text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 h-8 w-8 rounded-lg transition-colors border border-blue-100" title="Gérer">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.delete', $u->id) }}" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $u->name }} ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 h-8 w-8 rounded-lg transition-colors border border-red-100" title="Supprimer">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $users->links() }}
        </div>
        @endif
        @if($users->isEmpty())
        <div class="p-8 text-center text-slate-500">
            Aucune structure n'a été trouvée.
        </div>
        @endif
    </div>
</div>
@endsection
