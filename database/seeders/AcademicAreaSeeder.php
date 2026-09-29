<?php

namespace Database\Seeders;

use App\Models\AcademicArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AcademicAreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            'Tecnología' => 'Carreras enfocadas en software, redes y sistemas de información.',
            'Ingeniería' => 'Carreras que aplican ciencia y matemática para diseñar y construir soluciones.',
            'Salud' => 'Carreras orientadas al cuidado y bienestar de las personas.',
            'Administración y Negocios' => 'Carreras de gestión, finanzas y emprendimiento.',
            'Ciencias' => 'Carreras de investigación y análisis científico.',
            'Educación' => 'Carreras orientadas a la enseñanza y formación de otras personas.',
            'Arte y Diseño' => 'Carreras creativas centradas en la expresión visual y estética.',
            'Comunicación' => 'Carreras relacionadas con medios, periodismo y publicidad.',
            'Ciencias Sociales' => 'Carreras que estudian el comportamiento humano y la sociedad.',
            'Ciencias Agropecuarias' => 'Carreras enfocadas en agricultura, ganadería y manejo de recursos naturales.',
        ];

        foreach ($areas as $name => $description) {
            AcademicArea::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => $description]
            );
        }
    }
}
