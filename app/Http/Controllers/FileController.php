<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::paginate(20);
        return view('file.index', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("file.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|min:10|max:50',
            'titre_fr' => 'required|min:10|max:50',
            'fichier' => 'required|file|mimes:pdf,doc,zip',
        ]);

            $file = $request->file('fichier');
            $filename = $file->hashName();

            // File upload location
            $location = 'uploads';

            // Upload file
            $file->move($location,$filename);

            // File path
            $filepath = url('uploads/'.$filename);

        $file = File::create([
            'titre' => $request->titre,
            'titre_fr' => $request->titre_fr,
            'fichier'  => $filepath,
            'etudiant_id' => Auth::User()->id
        ]);

        return redirect(route('file.show', $file));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        $file->author = User::find($file->etudiant_id)->name;
        return view("file.show", ["file" => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        if(  Auth::user()->id != $file->etudiant_id ) {
            return redirect()->back();
         }
        return view('file.edit', ['file' => $file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        if(  Auth::user()->id != $file->etudiant_id ) {
            return redirect()->back();
        }

        $request->validate([
            'titre' => 'required|min:10|max:50',
            'titre_fr' => 'required|min:10|max:50',
            'fichier' => 'file|mimes:pdf,doc,zip',
        ]);

        $file->update([
            'titre' => $request->titre,
            'titre_fr' => $request->titre_fr,
            'etudiant_id' => Auth::User()->id
        ]);

        if($request->file('fichier')){

            $updatedFile = $request->file('fichier');
            $filename = $updatedFile->hashName();

            // File upload location
            $location = 'uploads';

            // Upload file
            $updatedFile->move($location,$filename);

            // File path
            $filepath = url('uploads/'.$filename);
            $file->update([
                'fichier'  => $filepath
            ]);
        }
            
        return redirect(route('file.show', $file->id))->withSuccess('Fichier mis à jour avec success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        if( Auth::user()->id != $file->etudiant_id ) {
            return redirect()->back();
        }

        $file->delete();
        return redirect(route('file.index'));
    }
}
