@extends('layouts.admin')

@section('content')
<section class="py-6" x-data="boardMembers()">
    <div class="max-w-4xl mx-auto">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-teal-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Membres du Bureau</h2>
                <p class="text-teal-100">Président, Secrétaire, Trésorier & autres (Étape 2 sur 3)</p>
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-teal-900">
                        <div style="width: 66%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-400"></div>
                    </div>
                </div>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <ul class="text-sm text-red-700 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.createUserType2') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-bold text-amber-800 text-sm">Mode Admin</h4>
                                <p class="text-amber-700 text-sm mt-1">Les <strong>photos des membres</strong> sont optionnelles lorsque l'inscription est faite par l'administrateur.</p>
                            </div>
                        </div>
                    </div>
                    
                    <template x-for="(member, index) in members" :key="index">
                        <div class="border border-gray-200 rounded-2xl p-6 space-y-4 bg-gray-50/50">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black" x-text="index + 1"></span>
                                    <span x-text="member.roleLabel"></span>
                                    <span x-show="index < 3" class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full font-bold">Obligatoire</span>
                                    <span x-show="index >= 3" class="text-xs bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full font-bold">Supplémentaire</span>
                                </h3>
                                <button type="button" x-show="index >= 3" @click="removeMember(index)" class="text-red-500 hover:text-red-700 text-sm font-bold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Retirer
                                </button>
                            </div>

                            <input type="hidden" :name="'members[' + index + '][role]'" :value="member.role">

                            <div x-show="index >= 3">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Rôle / Fonction <span class="text-red-500">*</span></label>
                                <input type="text" :name="'members[' + index + '][role]'" x-model="member.role" placeholder="Ex: Vice-président..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm" :required="index >= 3">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'members[' + index + '][nom]'" x-model="member.nom" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'members[' + index + '][prenom]'" x-model="member.prenom" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Contact <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'members[' + index + '][telephone]'" x-model="member.telephone" placeholder="+229 XX XX XX XX" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Photo <span class="text-gray-400 text-xs font-normal">(optionnel)</span></label>
                                    <input type="file" :name="'members[' + index + '][photo]'" accept="image/*" class="block w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-teal-50 file:text-teal-700 file:font-semibold file:text-sm">
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="flex justify-center">
                        <button type="button" @click="addMember()" class="flex items-center gap-2 text-teal-600 hover:text-teal-800 font-bold text-sm border-2 border-dashed border-teal-300 hover:border-teal-500 px-6 py-3 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Ajouter un membre supplémentaire
                        </button>
                    </div>

                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.createForm1') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">← Retour Étape 1</a>
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">Suivant : Documents (3/3) →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function boardMembers() {
    return {
        members: [
            { role: 'Président', roleLabel: 'Président(e)', nom: '', prenom: '', telephone: '' },
            { role: 'Secrétaire', roleLabel: 'Secrétaire Général(e)', nom: '', prenom: '', telephone: '' },
            { role: 'Trésorier', roleLabel: 'Trésorier(ère) Général(e)', nom: '', prenom: '', telephone: '' },
        ],
        addMember() {
            this.members.push({ role: '', roleLabel: 'Membre supplémentaire', nom: '', prenom: '', telephone: '' });
        },
        removeMember(index) {
            if (index >= 3) { this.members.splice(index, 1); }
        }
    }
}
</script>
@endsection
