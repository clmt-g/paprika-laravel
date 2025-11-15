<?php

namespace App\Http\Controllers;

use App\Models\Caserne;
use App\Models\Grade;
use App\Models\Pompier;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Mockery\Exception;

class PompierController extends Controller
{
    public function show() {
        $compteur = 1;
        $pompiers = Pompier::all();
        return view('pompier.show', ['pompiers' => $pompiers, 'compteur' => $compteur]);
    }

    public function detail($id) {
        $pompier = Pompier::find($id);
        return view('pompier.detail', ['pompier' => $pompier]);
    }

    public function create() {
        $pompiers = Pompier::all();
        $grades = Grade::all();
        $casernes = Caserne::all();
        return view('pompier.create', ['casernes' => $casernes, 'grades' => $grades, 'pompiers' => $pompiers]);
    }

    public function do_create(Request $request)
    {
        // Validation
        $validated = $this->validatePompier($request);

        try {
            // Générer le matricule automatiquement
            $matricule = $this->genererMatricule();

            // Créer le pompier
            $pompier = Pompier::create([
                'Matricule' => $matricule,
                'Nom' => $validated['nom'],
                'Prenom' => $validated['prenom'],
                'ChefAgret' => $validated['chefAgret'] ?? null,
                'DateNaissance' => $validated['dateNaissance'],
                'NumCaserne' => $validated['numCaserne'],
                'CodeGrade' => $validated['codeGrade'],
                'MatriculeRespo' => $validated['matriculeRespo'] ?? null,
            ]);

            // Succès
            return redirect()
                ->route('pompiers')
                ->with('success', 'Le pompier a été créé avec succès !');

        } catch (\Exception $e) {
            // Erreur
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function update($matricule) {
        $pompier = Pompier::find($matricule);
        $grades = Grade::all();
        $casernes = Caserne::all();
        $pompiers = Pompier::all();
        return view('pompier.update', ['pompier' => $pompier, 'grades' => $grades, 'casernes' => $casernes, 'pompiers' => $pompiers]);
    }

    public function do_update(Request $request, $matricule)
    {
        $validated = $this->validatePompier($request);

        try {
            $pompier = Pompier::findOrFail($matricule); // erreur 404 si le pompier est introuvable

            $pompier->update([
                'Nom' => $validated['nom'],
                'Prenom' => $validated['prenom'],
                'ChefAgret' => $validated['chefAgret'] ?? null,
                'NumCaserne' => $validated['numCaserne'],
                'DateNaissance' => $validated['dateNaissance'],
                'CodeGrade' => $validated['codeGrade'],
                'MatriculeRespo' => $validated['matriculeRespo'] ?? null,
            ]);

            return redirect()
                ->route('pompiers')
                ->with('success', 'Le pompier a été mis à jour avec succès !');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function delete($matricule) {
        $pompier = Pompier::find($matricule);
        return view('pompier.delete', ['pompier' => $pompier]);
    }

    public function do_delete($matricule) {
        try {
            $pompier = Pompier::findOrFail($matricule);
            $pompier->delete();
            return redirect()
                ->route('pompiers')
                ->with('success', 'Le pompier a été supprimé avec succès');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Générer un matricule automatique
     */
    private function genererMatricule(): string
    {
        // Récupérer le dernier matricule
        $dernierPompier = Pompier::orderBy('Matricule', 'desc')->first();

        if (!$dernierPompier) {
            // Premier pompier
            return 'P000001';
        }

        // Extraire le numéro du dernier matricule (ex: P000008 → 8)
        $dernierNumero = (int) substr($dernierPompier->Matricule, 1);

        // Incrémenter et formater (ex: 8 → 9 → P000009)
        $nouveauNumero = $dernierNumero + 1;

        return 'P' . str_pad($nouveauNumero, 6, '0', STR_PAD_LEFT);
    }

    private function validatePompier(Request $request, ?string $matriculeExclude = null): array
    {
        $rules = [
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'chefAgret' => 'nullable|string|max:50',
            'dateNaissance' => 'required|date|before:18 years ago',
            'numCaserne' => 'required|exists:casernes,NumCaserne',
            'codeGrade' => 'required|exists:grades,CodeGrade',
            'matriculeRespo' => 'nullable|exists:pompiers,Matricule',
        ];

        // Si c'est un UPDATE (matriculeExclude existe)
        if ($matriculeExclude !== null) {
            // On ajoute la règle AVANT de valider
            $rules['matricule'] = 'required|string|exists:pompiers,Matricule';
        }

        // Maintenant on valide avec TOUTES les règles
        return $request->validate($rules);
    }
}
