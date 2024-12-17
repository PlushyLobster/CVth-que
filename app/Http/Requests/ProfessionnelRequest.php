<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
 
 
class ProfessionnelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prenom' => ['required' , 'string', 'max:25'],
            'nom' => ['required' , 'string', 'max:40'],
            'cp' => ['required' , 'string', 'between:5,5'],
            'ville' => ['required' , 'string', 'max:38'],
            'telephone' => ['required' , 'string', 'max:14'],
            'email' => ['required' , 'email:rfc,dns', Rule::unique('professionnels')->ignore($this->professionnel)],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'naissance' => ['required' , 'date_format:Y-m-d'],
            'formation' => ['required'],
            'domaine' => ['required'],
            'metier_id' => ['required'],
            'competence_id' => ['required'],
 
        ];
    }

    public function messages(){
        return[
            'prenom.required' => 'Le prénom est obligatoire',
            'prenom.string' => 'Le prénom doit être une chaine de caractères',
            'prenom.max' => 'Le prénom ne doit pas dépasser 25 caractères',
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaine de caractères',
            'nom.max' => 'Le nom ne doit pas dépasser 40 caractères',
            'cp.required' => 'Le code postal est obligatoire',
            'cp.between' => 'Le code postal doit être composé de 5 chiffres',
            'ville.required' => 'La ville est obligatoire',
            'ville.string' => 'La ville doit être une chaine de caractères',
            'ville.max' => 'La ville ne doit pas dépasser 38 caractères',
            'telephone.required' => 'Le téléphone est obligatoire',
            'telephone.string' => 'Le téléphone doit être une chaine de caractères',
            'telephone.max' => 'Le téléphone ne doit pas dépasser 14 caractères',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'naissance.required' => 'La date de naissance est obligatoire',
            'naissance.date_format' => 'La date de naissance doit être au format YYYY-MM-DD',
            'formation.required' => 'La formation est obligatoire',
            'domaine.required' => 'Le domaine est obligatoire',
            'metier_id.required' => 'Le choix d\'un métier est obligatoire',
            'competence_id.required' => 'Le choix d\'une compétence est obligatoire',
            'cv.file' => 'Le CV doit être un fichier valide.',
            'cv.mimes' => 'Le CV doit être au format PDF.',
            'cv.max' => 'Le CV ne doit pas dépasser 2 Mo.',
        
         ];
    }
}