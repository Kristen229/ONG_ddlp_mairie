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
        $domaines = \App\Models\Domaine::all();

        foreach ($domaines as $domaine) {
            $newName = trim(preg_replace('/\s*\(.*\)/', '', $domaine->nom));
            
            if ($newName !== $domaine->nom) {
                // Check if a domain with the new name already exists to avoid unique constraint violations
                $existingDomaine = \App\Models\Domaine::where('nom', $newName)
                                                    ->where('id', '!=', $domaine->id)
                                                    ->first();
                if ($existingDomaine) {
                    // Merge relationships to the existing domain
                    $userIds = \Illuminate\Support\Facades\DB::table('domaine_user')
                                ->where('domaine_id', $domaine->id)
                                ->pluck('user_id');
                    
                    foreach ($userIds as $userId) {
                        $exists = \Illuminate\Support\Facades\DB::table('domaine_user')
                            ->where('domaine_id', $existingDomaine->id)
                            ->where('user_id', $userId)
                            ->exists();
                        if (!$exists) {
                            \Illuminate\Support\Facades\DB::table('domaine_user')->insert([
                                'domaine_id' => $existingDomaine->id,
                                'user_id' => $userId
                            ]);
                        }
                    }
                    // Delete the old domain
                    \Illuminate\Support\Facades\DB::table('domaine_user')->where('domaine_id', $domaine->id)->delete();
                    $domaine->delete();
                } else {
                    $domaine->update(['nom' => $newName]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // One way operation
    }
};
