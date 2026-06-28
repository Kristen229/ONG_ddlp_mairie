<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssociationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Retourne uniquement les associations approuvées
        return User::where('is_approved', true)->with('domaines')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom de l\'Association',
            'Email',
            'Téléphone',
            'Domaines d\'intervention',
            'Date de création',
            'Statut'
        ];
    }

    public function map($user): array
    {
        $domaines = $user->domaines->pluck('nom')->join(', ');

        return [
            $user->id,
            $user->name,
            $user->email,
            $user->telephone ?? 'Non renseigné',
            $domaines ?: 'Aucun domaine',
            $user->created_at ? $user->created_at->format('d/m/Y') : 'Inconnue',
            'Validée'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style pour la ligne d'en-tête des colonnes (ligne 1)
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FF1E3A8A']]],
        ];
    }
}
