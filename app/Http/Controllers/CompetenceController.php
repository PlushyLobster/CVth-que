<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Competence,
};

use App\Http\Requests\CompetenceRequest;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $competences = Competence::query()
        ->when($search, function ($query, $search) {
            $query->where('intitule', 'LIKE', "%{$search}%");
        })
        ->orderBy('intitule')
        ->paginate(5); // Utilisez la pagination pour afficher les résultats
        //$competences = Competence::all(); Permet seulement d'aller chercher la liste entière
        // $competences = Competence::orderBy('id', 'desc')->get(); permet de retourner la liste par ordre décroissant par l'id
        $data = [
            'titre' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Liste des compétences de la ' . config('app.name'),
            'competences' => $competences
        ];
        
        return view('competences.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('competences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetenceRequest $competenceRequest)
    {
        //EXEMPLE 1 
        // $valideData = $competenceRequest->all();
        // Competence::create($valideData);

        // $msg = "La compétence a bien été ajoutée.";
        // return redirect()->route('competences.index')->withInformation($msg);
        // retourne le message de validation dans l'encart information 

        //EXEMPLE 2
        $competence = new Competence();
        $competence->intitule = $competenceRequest->input('intitule');
        $competence->description = $competenceRequest->input('description');
        $competence->save();

        $msg = "La compétence a bien été ajoutée.";
        return redirect()->route('competences.index')->withInformation($msg);

    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        $data = [
            'titre' => 'La compétence ' . $competence->nom,
            'description' => 'Détails de la compétence ' . $competence->nom,
            'competence' => $competence
        ];

        return view('competences.show', $data);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        $data = [
            'titre' => 'Modifier la compétence ' . $competence->nom,
            'description' => 'Modifier la compétence ' . $competence->nom,
            'competence' => $competence
        ];

        return view('competences.edit', $data);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetenceRequest $competenceRequest, Competence $competence)
    {
        $valideData = $competenceRequest->all();
        $competence->update($valideData);

        $msg = "La compétence a bien été modifiée.";
        return redirect()->route('competences.index')->withInformation($msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();

        $msg = "La compétence a bien été supprimée.";
        return back()->withInformation($msg);
    }
}
