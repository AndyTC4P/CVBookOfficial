<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CV;
use App\Models\Habilidad;

class ImportarHabilidadesAntiguas extends Command
{
    protected $signature = 'cvbook:importar-habilidades';

    protected $description = 'Importa todas las habilidades antiguas desde los CVs y las guarda en la tabla habilidades';

    public function handle()
    {
        $cvs = CV::all();
        $totalNuevas = 0;

        foreach ($cvs as $cv) {
            $habilidades = is_array($cv->habilidades)
                ? $cv->habilidades
                : json_decode($cv->habilidades, true);

            if (is_array($habilidades)) {
                foreach ($habilidades as $nombre) {
                    $nombre = trim($nombre);
                    if (!empty($nombre)) {
                        $nueva = Habilidad::firstOrCreate(['nombre' => $nombre]);
                        if ($nueva->wasRecentlyCreated) {
                            $totalNuevas++;
                        }
                    }
                }
            }
        }

        $this->info("✅ Habilidades importadas correctamente. Nuevas: $totalNuevas");
    }
}

