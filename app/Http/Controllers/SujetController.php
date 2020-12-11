<?php

namespace App\Http\Controllers;

use App\Models\Sujet;
use App\Models\Comment;

use Illuminate\Http\Request;

class SujetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sujets = Sujet::latest()->paginate(10);

        return view('sujets.index', compact('sujets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sujets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'titre' =>'required|min:5',
            'contenu'=>'required|min:10'
        ]);

        $sujet = auth()->user()->sujets()->create($data); 

        return redirect()->route('sujets.show', $sujet->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function show(Sujet $sujet)
    {
        return view('sujets.show', compact('sujet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function edit(Sujet $sujet)
    {
        $this->authorize('update', $sujet);

        return view('sujets.edit', compact('sujet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sujet $sujet)
    {
        $this->authorize('update', $sujet);

        $data= $request->validate([
            'titre' =>'required|min:5',
            'contenu'=>'required|min:10'
        ]);
        
        $sujet->update($data);

        return redirect()->route('sujets.show', $sujet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sujet $sujet)
    {
        $this->authorize('update', $sujet);
        
        Sujet::destroy($sujet->id);

        return redirect('/');
    }


}
