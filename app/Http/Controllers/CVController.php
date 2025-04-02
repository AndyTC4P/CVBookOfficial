<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVController extends Controller
{
    /**
     * Mostrar todos los CVs del usuario autenticado.
     * 
     * - Obtiene los CVs que pertenecen al usuario autenticado.
     * - Los envía a la vista `cv.index` para ser listados.
     */
    public function index()
    {
        $cvs = CV::where('user_id', Auth::id())->get(); // Filtra solo los CVs del usuario autenticado
        return view('cv.index', compact('cvs')); // Envía los CVs a la vista
    }

    /**
     * Mostrar un CV individual (público o privado).
     * 
     * - Busca el CV por su ID.
     * - Si el CV es privado y no pertenece al usuario autenticado, muestra un error.
     * - Si el CV es público o pertenece al usuario, lo envía a la vista `cv.show`.
     */
    public function show($id)
{
    $cv = CV::with('user')->findOrFail($id); // Asegura que se carga la relación del usuario

    // Si el CV es privado y el usuario no es el dueño, mostrar error
    if (!$cv->publico && (!Auth::check() || Auth::id() !== $cv->user_id)) {
        return view('cv.not-available');
    }

    return view('cv.show', compact('cv'));
}

    /**
     * Mostrar el formulario de edición de un CV.
     * 
     * - Busca el CV por ID y verifica que pertenezca al usuario autenticado.
     * - Si el CV no pertenece al usuario, lanza un error 404.
     * - Muestra el formulario `cv.edit` con los datos del CV.
     */
    public function edit($id)
    {
        $cv = CV::where('id', $id)->where('user_id', auth()->id())->firstOrFail(); // Asegura que el CV le pertenezca al usuario autenticado
        return view('cv.edit', compact('cv')); // Retorna la vista de edición con los datos del CV
    }
    /**
 * Actualizar un CV con los datos modificados por el usuario.
 *
 * - Verifica que el CV exista y que pertenezca al usuario autenticado.
 * - Valida los datos ingresados en el formulario.
 * - Guarda los cambios en la base de datos.
 * - Redirige al usuario a la lista de CVs con un mensaje de éxito.
 */
public function update(Request $request, $id)
{
    // 1️⃣ Buscar el CV en la base de datos y asegurarse de que pertenezca al usuario autenticado
    $cv = CV::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    // 2️⃣ Validar los datos ingresados por el usuario
    $request->validate([
        'nombre' => 'required|string|max:255', // El nombre es obligatorio y tiene un máximo de 255 caracteres
        'apellido' => 'required|string|max:255', // El apellido es obligatorio y tiene un máximo de 255 caracteres
        'experiencia' => 'nullable|string', // La experiencia puede ser opcional pero debe ser texto si se llena
    ]);

    // 3️⃣ Actualizar los datos del CV en la base de datos
    $cv->update([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'experiencia' => $request->experiencia,
        'publico' => $request->has('publico'), // Se asigna como público si el checkbox fue marcado
    ]);

    // 4️⃣ Redirigir al usuario a la lista de CVs con un mensaje de confirmación
    return redirect()->route('cv.index')->with('message', '✅ CV actualizado correctamente.');
}

public function destroy($id)
{
    $cv = CV::where('user_id', auth()->id())->findOrFail($id);
    $cv->delete();

    return redirect()->route('cv.index')->with('message', '✅ CV eliminado correctamente.');
}
}

