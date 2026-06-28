@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen" x-data="boardMembers()">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête et Stepper -->
            <div class="bg-blue-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Membres du Bureau</h2>
                <p class="text-blue-100">Président, Secrétaire, Trésorier & autres (Étape 2 sur 3)</p>
                
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-blue-900">
                        <div style="width: 66%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-400"></div>
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

                <form method="POST" action="{{ route('user.createUserPartie2') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-bold text-blue-800 text-sm">Composition du Bureau Exécutif</h4>
                                <p class="text-blue-700 text-sm mt-1">Les 3 membres obligatoires sont : <strong>Président</strong>, <strong>Secrétaire</strong> et <strong>Trésorier</strong>. Vous pouvez ajouter des membres supplémentaires si nécessaire.</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- ===== MEMBRES OBLIGATOIRES (Président, Secrétaire, Trésorier) ===== --}}
                    <template x-for="(member, index) in members" :key="index">
                        <div class="border border-gray-200 rounded-2xl p-6 space-y-4 bg-gray-50/50">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black" x-text="index + 1"></span>
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

                            <!-- Rôle personnalisé pour les supplémentaires -->
                            <div x-show="index >= 3">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Rôle / Fonction <span class="text-red-500">*</span></label>
                                <input type="text" :name="'members[' + index + '][role]'" x-model="member.role" placeholder="Ex: Vice-président, Commissaire aux comptes..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 sm:text-sm" :required="index >= 3">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nom -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'members[' + index + '][nom]'" x-model="member.nom" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <!-- Prénom -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'members[' + index + '][prenom]'" x-model="member.prenom" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <!-- Téléphone -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Contact <span class="text-red-500">*</span></label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-4 py-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm font-bold">
                                            +229
                                        </span>
                                        <input type="text" :name="'members[' + index + '][telephone]'" x-model="member.telephone" placeholder="01XXXXXXXX" required minlength="10" maxlength="10" pattern="01[0-9]{8}" title="Le numéro doit contenir exactement 10 chiffres et commencer par 01" class="flex-1 block w-full px-4 py-3 border border-gray-300 rounded-r-xl focus:ring-blue-500 focus:border-blue-500 sm:text-sm" @input="member.telephone = member.telephone.replace(/[^0-9]/g, '')">
                                    </div>
                                </div>
                                <!-- Photo -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Photo <span class="text-red-500">*</span></label>
                                    <input type="file" :name="'members[' + index + '][photo]'" accept="image/*" required class="block w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 sm:text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold file:text-sm">
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Bouton ajouter membre -->
                    <div class="flex justify-center">
                        <button type="button" @click="addMember()" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-bold text-sm border-2 border-dashed border-blue-300 hover:border-blue-500 px-6 py-3 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Ajouter un membre supplémentaire
                        </button>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('user.createForme1') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">
                            ← Retour Étape 1
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">
                            Suivant : Documents (3/3) →
                        </button>
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
            if (index >= 3) {
                this.members.splice(index, 1);
            }
        }
    }
}
</script>
@endsection
