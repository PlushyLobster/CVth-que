<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Metier,
};

use App\Http\Requests\MetierRequest;

class MetierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $metiers = Metier::orderBy('id', 'asc')->get();
        $data = [
            'titre' => 'Les metiers de la ' . config('app.name'),
            'description' => 'Liste des metiers de la ' . config('app.name'),
            'metiers' => $metiers
        ];
        
        return view('metiers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(MetierRequest $MetierRequest): \Illuminate\Http\RedirectResponse
    // {
    //     $validated = $MetierRequest->validated();
    //     Metier::create($validated);
    //     return redirect()->route('metiers.index')->with('success', 'Metier ajouté avec succès');
    // }
    public function store(MetierRequest $metierRequest)
     {
    //     $matier = new Metier();
    //     $matier->libelle = $metierRequest->input('libelle');
    //     $matier->description = $metierRequest->input('description');
    //     $matier->slug = $metierRequest->input('slug');
    //     $matier->save();
           Metier::create($metierRequest->all());

        $msg = "Le métier a bien été ajoutée.";
        return redirect()->route('metiers.index')->withInformation($msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Metier $metier)
    {
        $data = [
            'titre' => 'Le metier ' . $metier->libelle,
            'description' => 'Détails du metier ' . $metier->libelle,
            'slug'=> $metier->slug,
            'metier' => $metier
        ];
        return view('metiers.show',$data);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metier $metier)
    {
        $data = [
            'titre' => 'Modifier le metier ' . $metier->libelle,
            'description' => 'Modifier le metier ' . $metier->libelle,
            'metier' => $metier
        ];
        return view('metiers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetierRequest $metierRequest, Metier $metier)
    {
        $valideData = $metierRequest->all();
        $metier->update($valideData);

        $msg = "Le metier a bien été modifié.";
        return redirect()->route('metiers.index')->withInformation($msg);
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function deleteform(Metier $metier)
    {
        $data = [
            'titre' => 'Supprimer le metier ' . $metier->libelle,
            'description' => 'Etes-vous sûr de vouloir supprimer le metier ' . $metier->libelle . ' ?',
            'metier' => $metier
        ];
        return view('metiers.destroy',$data);
    }

    public function destroy(Metier $metier)
    {
        $metier->delete();
       

        $msg = "Le metier a bien été supprimé.";
        return redirect()->route('metiers.index')->withInformation($msg);

    }
}
