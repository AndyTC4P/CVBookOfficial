<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CV Profesional</title>
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
            min-height: 1122px; /* Altura visual de página A4 (a 96 dpi) */
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
                    <img src="C:\xampp\htdocs\cvbook_app\resources\image\Fotografía-profesional-para-Linkedin-y-CV.jpg" alt="Foto de Perfil">
                </div>

                <div class="section">
                    <h3>Perfil Profesional</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non suscipit sapien.</p>
                </div>

                <div class="section">
                    <h3>Contacto</h3>
                    <p>correo@ejemplo.com</p>
                    <p>(55) 1234-5678</p>
                    <p>Ciudad Ejemplo, País</p>
                </div>

                <div class="section">
                    <h3>Habilidades</h3>
                    <ul>
                        <li>Gestión de proyectos</li>
                        <li>Organización</li>
                        <li>Análisis de datos</li>
                        <li>Resolución de problemas</li>
                        <li>Comunicación efectiva</li>
                    </ul>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="right-column">
                <div class="name">Pedro Fernández</div>
                <div class="position">Ejecutivo de ventas</div>

                <div class="section">
                    <h3>Experiencia Laboral</h3>

                    <div class="job-block">
                        <h4>Empresa Brocelle</h4>
                        <div class="date">2010 - 2012</div>
                        <p>Identificación de oportunidades de mercado y desarrollo de estrategias para aumentar la presencia online.</p>
                    </div>

                    <div class="job-block">
                        <h4>Empresa Brocelle</h4>
                        <div class="date">2012 - 2014</div>
                        <p>Agente de atención, encargado de relaciones con clientes y soporte postventa.</p>
                    </div>

                    <div class="job-block">
                        <h4>Empresa Brocelle</h4>
                        <div class="date">2014 - 2016</div>
                        <p>Ejecutivo de ventas con enfoque en fidelización de clientes y superación de metas trimestrales.</p>
                    </div>
                </div>

                <div class="section education-block">
                    <h3>Estudios Superiores</h3>

                    <div>
                        <h4>Licenciatura en Administración</h4>
                        <div class="date">2010 - 2012</div>
                        <p>Universidad Brocelle</p>
                    </div>

                    <br>

                    <div>
                        <h4>Maestría en Finanzas</h4>
                        <div class="date">2016 - 2018</div>
                        <p>Universidad Brocelle</p>
                    </div>
                </div>

                <!-- Relleno visual -->
                <div style="height: 396px;"></div>
            </div>
        </div>
    </div>
</body>
</html>










