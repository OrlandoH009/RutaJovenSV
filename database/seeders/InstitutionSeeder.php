<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Institution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InstitutionSeeder extends Seeder
{
    /**
     * Coordenadas aproximadas del centro de cada municipio (para el mapa).
     */
    private array $coordinates = [
        'San Salvador' => [13.6929, -89.2182],
        'Antiguo Cuscatlán' => [13.6722, -89.2461],
        'Soyapango' => [13.7017, -89.1408],
        'Santa Tecla' => [13.6736, -89.2789],
        'Santa Ana' => [13.9942, -89.5597],
        'San Miguel' => [13.4833, -88.1833],
        'San Vicente' => [13.6411, -88.7847],
        'Usulután' => [13.3500, -88.4500],
        'La Unión' => [13.3369, -87.8419],
        'Zacatecoluca' => [13.5039, -88.8697],
    ];

    public function run(): void
    {
        $institutions = [
            [
                'name' => 'Universidad de El Salvador (UES)',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Universidad pública',
                'website' => 'https://www.ues.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ciencias de la Computación' => 'presencial',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Ingeniería Civil' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Arquitectura' => 'presencial',
                    'Medicina' => 'presencial',
                    'Enfermería' => 'presencial',
                    'Odontología' => 'presencial',
                    'Biología' => 'presencial',
                    'Psicología' => 'presencial',
                    'Licenciatura en Educación' => 'presencial',
                    'Derecho' => 'presencial',
                    'Trabajo Social' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Medicina Veterinaria y Zootecnia' => 'presencial',
                ],
            ],
            [
                // Antiguo Cuscatlán pertenece al departamento de La Libertad, no San Salvador.
                'name' => 'Universidad Centroamericana José Simeón Cañas (UCA)',
                'department' => 'La Libertad',
                'municipality' => 'Antiguo Cuscatlán',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.uca.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'mixta',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Ingeniería Civil' => 'presencial',
                    'Ingeniería Ambiental' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Psicología' => 'presencial',
                    'Comunicaciones y Periodismo' => 'presencial',
                    'Derecho' => 'presencial',
                    'Relaciones Internacionales' => 'presencial',
                    'Publicidad y Relaciones Públicas' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Tecnológica de El Salvador (UTEC)',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.utec.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'virtual',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Arquitectura' => 'presencial',
                    'Diseño Gráfico' => 'presencial',
                    'Mercadeo' => 'presencial',
                    'Publicidad y Relaciones Públicas' => 'presencial',
                    'Administración de Empresas' => 'virtual',
                    'Turismo' => 'presencial',
                    'Gastronomía' => 'presencial',
                    'Derecho' => 'presencial',
                ],
            ],
            [
                // Campus principal: Soyapango pertenece al departamento de San Salvador.
                'name' => 'Universidad Don Bosco (UDB)',
                'department' => 'San Salvador',
                'municipality' => 'Soyapango',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.udb.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ciencias de la Computación' => 'presencial',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Ingeniería Civil' => 'presencial',
                    'Ingeniería Mecánica' => 'presencial',
                    'Arquitectura' => 'presencial',
                    'Diseño Gráfico' => 'presencial',
                ],
            ],
            [
                // Segundo campus de UDB, en Santa Tecla, departamento de La Libertad.
                'name' => 'Universidad Don Bosco - Sede La Libertad',
                'department' => 'La Libertad',
                'municipality' => 'Santa Tecla',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.udb.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Ingeniería en Alimentos' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Diseño Gráfico' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Francisco Gavidia (UFG)',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.ufg.edu.sv',
                'careers' => [
                    'Comunicaciones y Periodismo' => 'presencial',
                    'Publicidad y Relaciones Públicas' => 'presencial',
                    'Mercadeo' => 'mixta',
                    'Administración de Empresas' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Turismo' => 'presencial',
                    'Gastronomía' => 'presencial',
                    'Desarrollo de Software' => 'virtual',
                    'Derecho' => 'presencial',
                ],
            ],
            [
                'name' => 'Instituto Técnico Ricaldone',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Instituto técnico',
                'website' => 'https://www.ricaldone.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Diseño Gráfico' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Evangélica de El Salvador (UEES)',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.uees.edu.sv',
                'careers' => [
                    'Medicina' => 'presencial',
                    'Enfermería' => 'presencial',
                    'Fisioterapia' => 'presencial',
                    'Nutrición' => 'presencial',
                    'Licenciatura en Educación' => 'presencial',
                    'Psicología' => 'presencial',
                    'Trabajo Social' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Dr. José Matías Delgado (UJMD)',
                'department' => 'La Libertad',
                'municipality' => 'Antiguo Cuscatlán',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.ujmd.edu.sv',
                'careers' => [
                    'Medicina' => 'presencial',
                    'Odontología' => 'presencial',
                    'Derecho' => 'presencial',
                    'Arquitectura' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Relaciones Internacionales' => 'presencial',
                    'Comunicaciones y Periodismo' => 'presencial',
                    'Psicología' => 'presencial',
                ],
            ],
            [
                'name' => 'Instituto Técnico Centroamericano (ITCA-FEPADE) - Santa Tecla',
                'department' => 'La Libertad',
                'municipality' => 'Santa Tecla',
                'institution_type' => 'Instituto técnico',
                'website' => 'https://www.itca.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Turismo' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Pedagógica de El Salvador (UPED)',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.upedsv.edu.sv',
                'careers' => [
                    'Licenciatura en Educación' => 'presencial',
                    'Psicología' => 'presencial',
                    'Idiomas y Traducción' => 'presencial',
                    'Trabajo Social' => 'virtual',
                ],
            ],
            [
                'name' => 'Universidad Politécnica de El Salvador (UPES)',
                'department' => 'San Salvador',
                'municipality' => 'San Salvador',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.upes.edu.sv',
                'careers' => [
                    'Ingeniería Civil' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Ingeniería Mecánica' => 'presencial',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Arquitectura' => 'presencial',
                    'Administración de Empresas' => 'mixta',
                ],
            ],
            [
                'name' => 'Universidad Modular Abierta (UMA)',
                'department' => 'Santa Ana',
                'municipality' => 'Santa Ana',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.uma.edu.sv',
                'careers' => [
                    'Administración de Empresas' => 'virtual',
                    'Contaduría Pública' => 'virtual',
                    'Derecho' => 'mixta',
                    'Licenciatura en Educación' => 'virtual',
                    'Mercadeo' => 'virtual',
                ],
            ],
            [
                'name' => 'Universidad Católica de Occidente (UNICO)',
                'department' => 'Santa Ana',
                'municipality' => 'Santa Ana',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.unico.edu.sv',
                'careers' => [
                    'Medicina' => 'presencial',
                    'Derecho' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Psicología' => 'presencial',
                    'Enfermería' => 'presencial',
                    'Ingeniería Agronómica' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad de El Salvador - Facultad Multidisciplinaria de Occidente',
                'department' => 'Santa Ana',
                'municipality' => 'Santa Ana',
                'institution_type' => 'Universidad pública',
                'website' => 'https://www.ues.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Medicina' => 'presencial',
                    'Enfermería' => 'presencial',
                    'Ingeniería Agronómica' => 'presencial',
                    'Licenciatura en Educación' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad de El Salvador - Facultad Multidisciplinaria Oriental',
                'department' => 'San Miguel',
                'municipality' => 'San Miguel',
                'institution_type' => 'Universidad pública',
                'website' => 'https://www.ues.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Civil' => 'presencial',
                    'Ingeniería Agronómica' => 'presencial',
                    'Medicina' => 'presencial',
                    'Enfermería' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Derecho' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad de El Salvador - Facultad Multidisciplinaria Paracentral',
                'department' => 'San Vicente',
                'municipality' => 'San Vicente',
                'institution_type' => 'Universidad pública',
                'website' => 'https://www.ues.edu.sv',
                'careers' => [
                    'Ingeniería Agronómica' => 'presencial',
                    'Medicina Veterinaria y Zootecnia' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Licenciatura en Educación' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad de Oriente (UNIVO)',
                'department' => 'San Miguel',
                'municipality' => 'San Miguel',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.univo.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería en Sistemas' => 'presencial',
                    'Ingeniería Civil' => 'presencial',
                    'Medicina' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Psicología' => 'presencial',
                    'Derecho' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Gerardo Barrios (UGB)',
                'department' => 'San Miguel',
                'municipality' => 'San Miguel',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.ugb.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Administración de Empresas' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Mercadeo' => 'presencial',
                    'Turismo' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Derecho' => 'presencial',
                    'Psicología' => 'presencial',
                ],
            ],
            [
                'name' => 'Universidad Gerardo Barrios - Sede Usulután',
                'department' => 'Usulután',
                'municipality' => 'Usulután',
                'institution_type' => 'Universidad privada',
                'website' => 'https://www.ugb.edu.sv',
                'careers' => [
                    'Administración de Empresas' => 'presencial',
                    'Contaduría Pública' => 'presencial',
                    'Licenciatura en Educación' => 'presencial',
                    'Ingeniería Agronómica' => 'presencial',
                ],
            ],
            [
                'name' => 'Instituto Técnico Centroamericano (ITCA-FEPADE) - San Miguel',
                'department' => 'San Miguel',
                'municipality' => 'San Miguel',
                'institution_type' => 'Instituto técnico',
                'website' => 'https://www.itca.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Ingeniería en Alimentos' => 'presencial',
                    'Turismo' => 'presencial',
                ],
            ],
            [
                'name' => 'Instituto Técnico Centroamericano (ITCA-FEPADE) - La Unión',
                'department' => 'La Unión',
                'municipality' => 'La Unión',
                'institution_type' => 'Instituto técnico',
                'website' => 'https://www.itca.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Turismo' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                ],
            ],
            [
                'name' => 'Instituto Técnico Centroamericano (ITCA-FEPADE) - Zacatecoluca',
                'department' => 'La Paz',
                'municipality' => 'Zacatecoluca',
                'institution_type' => 'Instituto técnico',
                'website' => 'https://www.itca.edu.sv',
                'careers' => [
                    'Desarrollo de Software' => 'presencial',
                    'Ingeniería Agronómica' => 'presencial',
                    'Ingeniería Industrial' => 'presencial',
                    'Turismo' => 'presencial',
                ],
            ],
        ];

        foreach ($institutions as $data) {
            $coords = $this->coordinates[$data['municipality']] ?? [null, null];

            $institution = Institution::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name' => $data['name'],
                    'department' => $data['department'],
                    'municipality' => $data['municipality'],
                    'institution_type' => $data['institution_type'],
                    'website' => $data['website'],
                    'contact_info' => ['website' => $data['website']],
                    'latitude' => $coords[0],
                    'longitude' => $coords[1],
                ]
            );

            foreach ($data['careers'] as $careerName => $modality) {
                $career = Career::where('slug', Str::slug($careerName))->first();

                if (! $career) {
                    continue;
                }

                $institution->careers()->syncWithoutDetaching([
                    $career->id => ['modality' => $modality],
                ]);
            }
        }

        Institution::linkCampuses();
    }
}
