<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Professionnel,
    Metier,
    Competence,
};

use App\Http\Requests\ProfessionnelRequest;



class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug = null)
    {
        // Récupérer les paramètres de recherche
        $search = $request->input('search'); // Recherche par nom/prénom
        $competence = $request->input('competence'); // Recherche par compétence
    
        // Commencer par récupérer les professionnels
        $professionnels = Professionnel::query();
    
        // Filtrer par slug (métier) si présent
        if ($slug) {
            $metier = Metier::where('slug', $slug)->firstOrFail();
            $professionnels = $metier->professionnels();
        }
    
        // Filtrer par nom/prénom
        if ($search) {
            $professionnels->where(function ($query) use ($search) {
                $query->where('nom', 'LIKE', "%{$search}%")
                      ->orWhere('prenom', 'LIKE', "%{$search}%");
            });
        }
    
        // Filtrer par compétence
        if ($competence) {
            $professionnels->whereHas('competences', function ($query) use ($competence) {
                $query->where('intitule', 'LIKE', "%{$competence}%");
            });
        }
    
        // Paginer les résultats
        $professionnels = $professionnels->paginate(5);
    
        // Récupérer tous les métiers pour la vue
        $metiers = Metier::all();
    
        return view('professionnels.index', [
            'titre' => 'Les professionnels de la ' . config("app.name"),
            'description' => 'Retrouvez les professionnels de la ' . config("app.name"),
            'professionnels' => $professionnels,
            'metiers' => $metiers,
            'slug' => $slug,
            'search' => $search,
            'competence' => $competence, // Transmettre la compétence pour la vue
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Chargement du combo metier 
        $metiers = Metier::orderBy('libelle')->get();

        // pour relation 1,N 1,N Professionnel/compétences 
        $competences = Competence::orderBy('intitule')->get();

        $data = [
            'titre'=> 'Les professionnels de la ' .config("app.name"),
            'description'=> 'Retrouvez les professionnels de la ' .config("app.name"),
            'metiers'=> $metiers,
            // pour relation 1,N 1,N Professionnel/compétences 
            'competences'=> $competences,
        ];
            return view('professionnels.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionnelRequest $professionnelRequest)
    {
        // Récupération des données validées
        $validData = $professionnelRequest->validated();
    
        // Traitement du champ "domaine"
        $validData["domaine"] = implode(',', $professionnelRequest->input('domaine'));
    
        // Gestion de l'upload du fichier CV
        if ($professionnelRequest->hasFile('cv')) {
            $cv = $professionnelRequest->file('cv');
    
            // Générer un nom unique pour le fichier
            $cvName = time() . '_' . $cv->getClientOriginalName();
    
            // Enregistrer le fichier dans le dossier public/cvs
            $cv->storeAs('public/cvs', $cvName);
    
            // Ajouter le nom du fichier dans les données à sauvegarder
            $validData['cv'] = $cvName;
        }
    
        // Création du professionnel
        $nouveauProfessionnel = Professionnel::create($validData);
    
        // Attachement des compétences
        $competences = $professionnelRequest->input('competence_id');
        if (!empty($competences)) {
            $nouveauProfessionnel->competences()->attach($competences);
        }
    
        // Redirection avec message de confirmation
        $msg = "Le professionnel a bien été enregistré avec son CV.";
        return redirect()->route('professionnels.index')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Professionnel $professionnel)
    {
        $professionnel->domaine = explode(',', $professionnel->domaine);
        $data = [
            'titre'=> 'Le professionnel ' . $professionnel->nom,
            'description'=> 'Détails du professionnel ' . $professionnel->nom,
            'professionnel'=> $professionnel,
        ];
            return view('professionnels.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professionnel $professionnel)
    {
        $professionnel->domaine = explode(',', $professionnel->domaine);
        $metiers = Metier::orderBy('libelle')->get();
        $competences = Competence::orderBy('intitule')->get();

        $data = [
            'titre' => 'Modifier le professionnel ' . $professionnel->nom,
            'description' => 'Modifier le professionnel ' . $professionnel->nom,
            'professionnel' => $professionnel,
            'metiers' => $metiers,
            'competences' => $competences,
            
        ];
        return view('professionnels.edit',$data);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionnelRequest $professionnelRequest, Professionnel $professionnel)
    {
        $valideData = $professionnelRequest->validated();
        $valideData["domaine"] = implode(',', $professionnelRequest->input('domaine', []));
    
        $professionnel->update($valideData);
        $professionnel->competences()->sync($professionnelRequest->input('competence_id', []));
    
        $msg = "Le professionnel a bien été modifié.";
        return redirect()->route('professionnels.index')->with('success', $msg);
    }

    public function destroy(Professionnel $professionnel)
    {
        $professionnel->delete();
       

        $msg = "Le professionnel a bien été supprimé.";
        return redirect()->route('professionnels.index')->withInformation($msg);

    }
}
