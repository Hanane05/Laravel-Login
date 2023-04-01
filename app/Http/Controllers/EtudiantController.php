<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $etudiants = Etudiant::paginate(15);
        return view('etudiant.index', ['etudiants' => $etudiants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $villes = Ville::all();
        return view("etudiant.create", ["villes" => $villes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $request->validate([
            'nom' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:etudiants',
            'adresse' => 'required|string|min:15|max:100',
            'phone' => [
                'required',
                'regex:/^\+[\d-]+$/'
            ],
            'date_de_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id'

        ]);

        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'date_de_naissance' => $request->date_de_naissance,
            'ville_id' => $request->ville_id,

        ]);

        return redirect(route('etudiant.show', $etudiant->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $ville = Ville::find($etudiant->ville_id);
        return view("etudiant.show", ["etudiant" => $etudiant, "ville" => $ville->nom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $villes = Ville::all();
        return view('etudiant.edit', ['etudiant' => $etudiant, "villes" => $villes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $request->validate([
            'nom' => 'required|string|min:3|max:30',
            'email' => 'required|email',
            'adresse' => 'required|string|min:15|max:100',
            'phone' => [
                'required',
                'regex:/^\+[\d-]+$/'
            ],
            'date_de_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id'

        ]);

        $etudiant->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'date_de_naissance' => $request->date_de_naissance,
            'ville_id' => $request->ville_id,
        ]);

        return redirect(route('etudiant.show', $etudiant->id))->withSuccess('Informations étudiant mises à jour avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $etudiant->delete();
        return redirect()->route("etudiant.index");
    }
}
