<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVController extends Controller
{
    public function index()
    {
        $cvs = CV::where('user_id', Auth::id())->get();
        return view('cv.index', compact('cvs'));
    }

    public function show($slug)
    {
        $cv = CV::with('user')->where('slug', $slug)->firstOrFail();

        if (!$cv->publico && (!Auth::check() || Auth::id() !== $cv->user_id)) {
            return view('cv-no-disponible');
        }

        return view('cv.show', compact('cv'));
    }

    public function edit($slug)
    {
        $cv = CV::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();
        return view('cv.edit', compact('cv'));
    }

    public function update(Request $request, $slug)
    {
        $cv = CV::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'experiencia' => 'nullable|string',
        ]);

        $cv->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'experiencia' => $request->experiencia,
            'publico' => $request->has('publico'),
        ]);

        return redirect()->route('cv.index')->with('message', '✅ CV actualizado correctamente.');
    }

    public function destroy($slug)
    {
        $cv = CV::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();
        $cv->delete();

        return redirect()->route('cv.index')->with('message', '✅ CV eliminado correctamente.');
    }

    public function create()
    {
        return view('cv.create');
    }
}
