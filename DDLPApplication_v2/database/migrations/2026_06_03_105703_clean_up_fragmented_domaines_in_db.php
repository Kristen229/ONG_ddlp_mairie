<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Domaines fragmentés à supprimer
        $fragmented = [
            "accouchements sécurisés",
            "bouillies enrichies)",
            "des IST",
            "du VIH/SIDA",
            "du diabète)",
            "vaccination)"
        ];

        // Pour chaque domaine fragmenté, on supprime la relation et le domaine lui-même
        foreach ($fragmented as $frag) {
            $domaine = \App\Models\Domaine::where('nom', $frag)->first();
            if ($domaine) {
                // Détacher de tous les utilisateurs
                \Illuminate\Support\Facades\DB::table('domaine_user')->where('domaine_id', $domaine->id)->delete();
                // Supprimer le domaine
                $domaine->delete();
            }
        }

        // Cas spécifiques où le parent a été coupé sans inclure la fin :
        $brokenParents = [
            "Lutte contre les maladies (prévention du paludisme" => "Lutte contre les maladies (prévention du paludisme, du VIH/SIDA, des IST, du diabète)",
            "Nutrition communautaire (lutte contre la malnutrition des enfants" => "Nutrition communautaire (lutte contre la malnutrition des enfants, bouillies enrichies)",
            "Santé maternelle et infantile (suivi des grossesses" => "Santé maternelle et infantile (suivi des grossesses, accouchements sécurisés, vaccination)",
            "Alphabétisation des adultes" => "Alphabétisation des adultes (cours de lecture/écriture en langues nationales : Fon, Adja, Yoruba...)"
        ];

        foreach ($brokenParents as $broken => $full) {
            $brokenDomaine = \App\Models\Domaine::where('nom', $broken)->first();
            $fullDomaine = \App\Models\Domaine::where('nom', $full)->first();

            if ($brokenDomaine && $fullDomaine) {
                // Migrer les users du domaine cassé vers le domaine complet
                $userIds = \Illuminate\Support\Facades\DB::table('domaine_user')->where('domaine_id', $brokenDomaine->id)->pluck('user_id');
                foreach ($userIds as $userId) {
                    $exists = \Illuminate\Support\Facades\DB::table('domaine_user')
                        ->where('domaine_id', $fullDomaine->id)
                        ->where('user_id', $userId)
                        ->exists();
                    if (!$exists) {
                        \Illuminate\Support\Facades\DB::table('domaine_user')->insert([
                            'domaine_id' => $fullDomaine->id,
                            'user_id' => $userId
                        ]);
                    }
                }
                \Illuminate\Support\Facades\DB::table('domaine_user')->where('domaine_id', $brokenDomaine->id)->delete();
                $brokenDomaine->delete();
            } elseif ($brokenDomaine && !$fullDomaine) {
                $brokenDomaine->update(['nom' => $full]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // On ne recrée pas les domaines fragmentés
    }
};
