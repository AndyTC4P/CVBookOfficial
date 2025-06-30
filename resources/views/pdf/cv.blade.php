<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $cv->nombre }} {{ $cv->apellido }}</title>
    <style>
        @page { margin: 0; }
body { margin: 0; padding: 0; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .cv-wrapper {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .cv-row { display: table-row; }

        .left-column {
            display: table-cell;
            width: 35%;
            background-color: #1d1d1d;
            color: white;
            padding: 40px 25px;
            vertical-align: top;
        }

        .right-column {
            display: table-cell;
            width: 65%;
            background-color: #fff;
            padding: 50px 40px 30px 40px;
            vertical-align: top;
        }

        .photo-full {
            width: 100%;
            max-height: 300px;
            overflow: hidden;
            margin-bottom: 25px;
            background-color: #444;
            border: 2px solid #fff;
        }

        .photo-full img {
            width: 100%;
            max-height: 280px;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .section { margin-bottom: 35px;  page-break-inside: avoid; }

        .section h3 {
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 12px;
            border-bottom: 1px solid #666;
            padding-bottom: 6px;
            color: #fff;
        }

        .section p, .section li {
            font-size: 13px;
            line-height: 1.5;
        }

        .section ul {
            list-style: none;
            padding-left: 0;
        }

        .section ul li {
            margin-bottom: 6px;
        }

        .name {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #111;
        }

        .position {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .job-block {
            margin-bottom: 25px;
        }

        .job-block h4 {
            font-size: 15px;
            font-weight: bold;
        }

        .job-block .date {
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }

        .education-block h4 {
            font-size: 14px;
            font-weight: bold;
        }

        .education-block .date {
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
    <div class="cv-wrapper">
        <div class="cv-row">
            <!-- Columna izquierda -->
            <div class="left-column">
                <div class="photo-full">
                    @php
                        $ruta = public_path('storage/' . $cv->imagen);
                    @endphp
                    @if ($cv->imagen && file_exists($ruta))
                        <img src="{{ $ruta }}" alt="Foto de Perfil">
                    @else
                        <div style="width:100%;aspect-ratio:3/4;background:#444;color:#fff;display:flex;align-items:center;justify-content:center;border:2px solid #fff;">
                            Foto de Perfil
                        </div>
                    @endif
                </div>

                <div class="section">
                    <h3>Perfil Profesional</h3>
                    <div style="font-size: 11px; line-height: 1.6; word-break: break-word; white-space: pre-line;">
                        {!! nl2br(e($cv->perfil)) !!}
                    </div>
                </div>

                <div class="section">
    <h3>Contacto</h3>

    <p style="font-size: 12px; margin-bottom: 2px;">
        <strong>Teléfono:</strong> {{ $cv->telefono }}
    </p>
    <p style="font-size: 12px; margin-bottom: 10px;">
        <strong>Correo:</strong> {{ $cv->correo }}
    </p>

    <p style="font-weight: bold; font-size: 12px; margin-bottom: 2px;">Ubicación:</p>
    <p style="font-size: 12px;">{{ $cv->ciudad }}, {{ $cv->pais }}</p>
</div>


                <div class="section">
                    <h3>Habilidades</h3>
                    @php
                        $habilidades = is_array($cv->habilidades) ? $cv->habilidades : json_decode($cv->habilidades, true) ?? [];
                        $habilidadesLimitadas = array_slice($habilidades, 0, 5);
                    @endphp
                    <ul>
                        @foreach($habilidadesLimitadas as $habilidad)
                            <li style="white-space: normal;">{{ \Illuminate\Support\Str::limit($habilidad, 35) }}</li>
                        @endforeach
                    </ul>
                </div>

               <div class="section">
    <h3>Idiomas</h3>
    @php
        $idiomas = is_array($cv->idiomas) ? $cv->idiomas : json_decode($cv->idiomas, true) ?? [];
        if (!empty($cv->otro_idioma)) {
            $idiomas[] = $cv->otro_idioma;
        }
        $idiomas = array_slice($idiomas, 0, 4); // Limita a máximo 4
    @endphp
    <ul style="padding-left: 1rem; margin: 0;">
        @foreach ($idiomas as $idioma)
            @if (is_array($idioma) && isset($idioma['nombre'], $idioma['nivel']))
                <li>{{ $idioma['nombre'] }} – {{ ucfirst($idioma['nivel']) }}</li>
            @elseif (is_string($idioma))
                <li>{{ $idioma }}</li>
            @endif
        @endforeach
    </ul>
</div>

            </div>

            <!-- Columna derecha -->
            <div class="right-column">
                @php use Carbon\Carbon; @endphp

                <div class="name">{{ $cv->nombre }} {{ $cv->apellido }}</div>
                <div class="position">{{ $cv->titulo }}</div>

                <div class="section">
                    <h3 style="color: #111;">Experiencia Laboral</h3>
                    @php
                        $experiencias = is_array($cv->experiencia) ? $cv->experiencia : json_decode($cv->experiencia, true) ?? [];
                    @endphp
                    @foreach(array_slice($experiencias, 0, 4) as $exp)
                        <div class="job-block">
                            <h4>{{ $exp['empresa'] ?? '' }} - {{ $exp['puesto'] ?? '' }}</h4>
                            <div class="date">
                                @php
                                    $inicio = !empty($exp['inicio']) ? ucfirst(Carbon::parse($exp['inicio'])->translatedFormat('F, Y')) : 'Fecha no especificada';
                                    $fin = !empty($exp['fin']) ? ucfirst(Carbon::parse($exp['fin'])->translatedFormat('F, Y')) : 'Actual';
                                @endphp
                                {{ $inicio }} - {{ $fin }}
                            </div>

                            @if(!empty($exp['tareas']))
                                @php
                                    $tareas = is_array($exp['tareas']) ? $exp['tareas'] : json_decode($exp['tareas'], true);
                                    $tareas = array_slice($tareas ?? [], 0, 3);
                                @endphp
                                <ul style="padding-left: 18px; margin-top: 5px; list-style-type: disc;">
                                    @foreach($tareas as $tarea)
                                        <li style="margin-bottom: 4px; font-size: 13px; line-height: 1.5;">
                                            {{ $tarea }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="section education-block">
    <h3 style="color: #111;">Formación Profesional</h3>
    @php
        $educacion = is_array($cv->educacion) ? $cv->educacion : json_decode($cv->educacion, true) ?? [];
    @endphp
    @foreach($educacion as $edu)
        <div>
            <h4 style="margin: 0;">
                {{ $edu['carrera'] ?? '' }} – {{ $edu['centro'] ?? $edu['universidad'] ?? '' }}
            </h4>

            @if(!empty($edu['ciudad']))
                <p style="margin: 0; font-size: 12px;">
                    {{ $edu['ciudad'] }}
                </p>
            @endif

            <p class="date" style="margin: 0; font-size: 12px;">
                @php
                    $eduInicio = !empty($edu['inicio']) ? ucfirst(Carbon::parse($edu['inicio'])->locale('es')->translatedFormat('F, Y')) : 'Fecha no especificada';
                    $eduFin = !empty($edu['fin']) ? ucfirst(Carbon::parse($edu['fin'])->locale('es')->translatedFormat('F, Y')) : 'Actualidad';
                    $estado = ucfirst($edu['estado'] ?? 'Desconocido');
                @endphp
                {{ $eduInicio }} – {{ $eduFin }} — <span style="font-style: italic;">{{ $estado }}</span>
            </p>
        </div>
        <br>
    @endforeach
</div>

            </div>
        </div>
    </div>
</body>
</html>
