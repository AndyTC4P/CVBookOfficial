<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $cv->nombre }} {{ $cv->apellido }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .cv-row {
            display: table-row;
        }

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
            margin-bottom: 25px;
            background-color: #444;
            border: 2px solid #fff;
        }

        .photo-full img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h3 {
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 12px;
            border-bottom: 1px solid #444;
            padding-bottom: 6px;
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
            margin-bottom: 4px;
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

        .job-block p {
            font-size: 14px;
            line-height: 1.6;
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
                    <p>{{ \Illuminate\Support\Str::limit($cv->perfil, 300) }}</p>
                </div>

                <div class="section">
                    <h3>Contacto</h3>
                    <p>{{ $cv->correo }}</p>
                    <p>{{ $cv->telefono }}</p>
                    <p>{{ $cv->ciudad }}, {{ $cv->pais }}</p>
                </div>

                <div class="section">
                    <h3>Habilidades</h3>
                    @php
                        $habilidades = is_array($cv->habilidades) ? $cv->habilidades : json_decode($cv->habilidades, true) ?? [];
                    @endphp
                    <ul>
                        @foreach($habilidades as $habilidad)
                            <li>{{ \Illuminate\Support\Str::limit($habilidad, 25) }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="section">
                    <h3>Idiomas</h3>
                    @php
                        $idiomas = is_array($cv->idiomas) ? $cv->idiomas : json_decode($cv->idiomas, true) ?? [];
                    @endphp
                    <ul>
                        @foreach($idiomas as $idioma)
                            <li>{{ $idioma }}</li>
                        @endforeach
                        @if ($cv->otro_idioma)
                            <li>{{ $cv->otro_idioma }}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="right-column">
                <div class="name">{{ $cv->nombre }} {{ $cv->apellido }}</div>
                <div class="position">{{ $cv->titulo }}</div>

                <div class="section">
                    <h3>Experiencia Laboral</h3>
                    @php
                        $experiencias = is_array($cv->experiencia) ? $cv->experiencia : json_decode($cv->experiencia, true) ?? [];
                    @endphp
                    @foreach($experiencias as $exp)
                        <div class="job-block">
                            <h4>{{ $exp['empresa'] ?? '' }} - {{ $exp['puesto'] ?? '' }}</h4>
                            <div class="date">{{ $exp['fecha_inicio'] ?? '' }} - {{ $exp['fecha_fin'] ?? '' }}</div>
                            <p>{{ \Illuminate\Support\Str::limit($exp['descripcion'] ?? '', 300) }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="section education-block">
                    <h3>Estudios Superiores</h3>
                    @php
                        $educacion = is_array($cv->educacion) ? $cv->educacion : json_decode($cv->educacion, true) ?? [];
                    @endphp
                    @foreach($educacion as $edu)
                        <div>
                            <h4>{{ $edu['centro'] ?? '' }} - {{ $edu['carrera'] ?? '' }}</h4>
                            <div class="date">{{ $edu['anio_inicio'] ?? '' }} - {{ $edu['anio_fin'] ?? '' }}</div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
