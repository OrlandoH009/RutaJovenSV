<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'text' => '¿Cuál de estas actividades disfrutarías más?',
                'options' => [
                    ['text' => 'Crear una página web o una app', 'weights' => ['technology' => 10]],
                    ['text' => 'Diseñar un logotipo o una ilustración', 'weights' => ['creativity' => 10]],
                    ['text' => 'Ayudar a una persona enferma', 'weights' => ['health' => 9, 'social' => 3]],
                    ['text' => 'Resolver un problema matemático', 'weights' => ['math' => 10]],
                    ['text' => 'Organizar un proyecto o un evento', 'weights' => ['business' => 9, 'communication' => 3]],
                    ['text' => 'Investigar un fenómeno científico', 'weights' => ['science' => 10]],
                ],
            ],
            [
                'text' => '¿Qué tipo de materias te llaman más la atención?',
                'options' => [
                    ['text' => 'Informática o computación', 'weights' => ['technology' => 10]],
                    ['text' => 'Matemática o física', 'weights' => ['math' => 10]],
                    ['text' => 'Biología o química', 'weights' => ['science' => 8, 'health' => 4]],
                    ['text' => 'Arte o educación artística', 'weights' => ['creativity' => 10]],
                    ['text' => 'Estudios sociales o historia', 'weights' => ['social' => 10]],
                    ['text' => 'Lenguaje y literatura', 'weights' => ['communication' => 10]],
                ],
            ],
            [
                'text' => '¿Prefieres actividades más prácticas o más teóricas?',
                'options' => [
                    ['text' => 'Prácticas: armar, construir o experimentar', 'weights' => ['technology' => 5, 'science' => 5]],
                    ['text' => 'Teóricas: leer, analizar e investigar', 'weights' => ['science' => 8, 'social' => 4]],
                ],
            ],
            [
                'text' => '¿Cómo prefieres trabajar la mayoría del tiempo?',
                'options' => [
                    ['text' => 'Solo/a, concentrado/a en una tarea específica', 'weights' => ['technology' => 6, 'math' => 4]],
                    ['text' => 'En equipo, coordinando con otras personas', 'weights' => ['business' => 6, 'social' => 4]],
                    ['text' => 'Ayudando directamente a otras personas', 'weights' => ['health' => 6, 'education' => 4]],
                    ['text' => 'Creando o diseñando algo nuevo', 'weights' => ['creativity' => 10]],
                ],
            ],
            [
                'text' => '¿Qué actividad extracurricular te gustaría más?',
                'options' => [
                    ['text' => 'Un club de robótica o programación', 'weights' => ['technology' => 10]],
                    ['text' => 'Un club de debate o periodismo escolar', 'weights' => ['communication' => 10]],
                    ['text' => 'Voluntariado en salud o brigadas médicas', 'weights' => ['health' => 10]],
                    ['text' => 'Un club de arte, música o teatro', 'weights' => ['creativity' => 10]],
                    ['text' => 'Un club de finanzas o mini-empresa estudiantil', 'weights' => ['business' => 10]],
                    ['text' => 'Un club de ciencias o de investigación escolar', 'weights' => ['science' => 10]],
                ],
            ],
            [
                'text' => '¿Qué tipo de problema te resulta más interesante resolver?',
                'options' => [
                    ['text' => 'Un error en un programa o sistema', 'weights' => ['technology' => 10]],
                    ['text' => 'Un cálculo o ecuación compleja', 'weights' => ['math' => 10]],
                    ['text' => 'Un conflicto entre personas', 'weights' => ['social' => 10]],
                    ['text' => 'Cómo hacer crecer un negocio', 'weights' => ['business' => 10]],
                    ['text' => 'Por qué ocurre un fenómeno natural', 'weights' => ['science' => 10]],
                    ['text' => 'Cómo cuidar la salud de alguien', 'weights' => ['health' => 10]],
                ],
            ],
            [
                'text' => '¿Te imaginas mejor en un trabajo donde...',
                'options' => [
                    ['text' => '...enseñas o explicas cosas a otras personas?', 'weights' => ['education' => 10]],
                    ['text' => '...cuidas la salud de las personas?', 'weights' => ['health' => 10]],
                    ['text' => '...diseñas o creas contenido visual?', 'weights' => ['creativity' => 10]],
                    ['text' => '...analizas datos o números?', 'weights' => ['math' => 8, 'technology' => 4]],
                    ['text' => '...gestionas proyectos o equipos?', 'weights' => ['business' => 10]],
                    ['text' => '...investigas y publicas hallazgos?', 'weights' => ['science' => 8, 'communication' => 3]],
                ],
            ],
            [
                'text' => '¿Qué tipo de contenido te gustaría crear en redes sociales?',
                'options' => [
                    ['text' => 'Tutoriales de ciencia o tecnología', 'weights' => ['technology' => 6, 'science' => 6]],
                    ['text' => 'Diseños o arte propio', 'weights' => ['creativity' => 10]],
                    ['text' => 'Noticias o entrevistas', 'weights' => ['communication' => 10]],
                    ['text' => 'Consejos de salud y bienestar', 'weights' => ['health' => 10]],
                    ['text' => 'Tips de negocios o finanzas personales', 'weights' => ['business' => 9, 'communication' => 3]],
                ],
            ],
            [
                'text' => '¿Qué te resulta más satisfactorio al terminar una tarea?',
                'options' => [
                    ['text' => 'Haber construido o programado algo funcional', 'weights' => ['technology' => 10]],
                    ['text' => 'Haber ayudado a alguien a sentirse mejor', 'weights' => ['health' => 10]],
                    ['text' => 'Haber logrado una meta de negocio o ahorro', 'weights' => ['business' => 10]],
                    ['text' => 'Haber entendido cómo funciona algo complejo', 'weights' => ['science' => 10]],
                    ['text' => 'Haber creado algo visualmente atractivo', 'weights' => ['creativity' => 10]],
                    ['text' => 'Haber ayudado a resolver un conflicto o duda de alguien', 'weights' => ['social' => 8, 'communication' => 2]],
                ],
            ],
            [
                'text' => '¿En qué tipo de ambiente te ves trabajando en el futuro?',
                'options' => [
                    ['text' => 'Una oficina de tecnología o startup', 'weights' => ['technology' => 10]],
                    ['text' => 'Un hospital o clínica', 'weights' => ['health' => 10]],
                    ['text' => 'Una escuela o universidad', 'weights' => ['education' => 10]],
                    ['text' => 'Un estudio creativo o agencia de diseño', 'weights' => ['creativity' => 10]],
                    ['text' => 'Una empresa gestionando equipos o finanzas', 'weights' => ['business' => 10]],
                    ['text' => 'Un laboratorio o centro de investigación', 'weights' => ['science' => 10]],
                ],
            ],
            [
                'text' => '¿Qué papel sueles tomar cuando trabajas en un proyecto grupal?',
                'options' => [
                    ['text' => 'El/la que organiza tareas y plazos', 'weights' => ['business' => 8, 'communication' => 2]],
                    ['text' => 'El/la que propone ideas creativas', 'weights' => ['creativity' => 10]],
                    ['text' => 'El/la que investiga y aporta datos', 'weights' => ['science' => 6, 'math' => 4]],
                    ['text' => 'El/la que media cuando hay desacuerdos', 'weights' => ['social' => 10]],
                    ['text' => 'El/la que presenta o comunica los resultados', 'weights' => ['communication' => 10]],
                ],
            ],
            [
                'text' => 'Si tuvieras que elegir un libro o documental para ver, ¿cuál escogerías?',
                'options' => [
                    ['text' => 'Sobre inventos y avances tecnológicos', 'weights' => ['technology' => 10]],
                    ['text' => 'Sobre el cuerpo humano o enfermedades', 'weights' => ['health' => 10]],
                    ['text' => 'Sobre el universo, la naturaleza o los animales', 'weights' => ['science' => 10]],
                    ['text' => 'Sobre historia, política o sociedad', 'weights' => ['social' => 10]],
                    ['text' => 'Sobre arte, cine o diseño', 'weights' => ['creativity' => 10]],
                    ['text' => 'Sobre emprendedores y negocios exitosos', 'weights' => ['business' => 10]],
                ],
            ],
            [
                'text' => '¿Qué tarea escolar disfrutas más al hacerla?',
                'options' => [
                    ['text' => 'Armar una presentación con gráficos y datos', 'weights' => ['math' => 6, 'technology' => 4]],
                    ['text' => 'Escribir un ensayo o exponer un tema en clase', 'weights' => ['communication' => 10]],
                    ['text' => 'Hacer un experimento o proyecto de ciencias', 'weights' => ['science' => 10]],
                    ['text' => 'Ilustrar, decorar o diseñar un trabajo', 'weights' => ['creativity' => 10]],
                    ['text' => 'Ayudar a un compañero a entender un tema', 'weights' => ['education' => 8, 'social' => 2]],
                ],
            ],
            [
                'text' => '¿Qué te gustaría lograr con tu trabajo en el futuro?',
                'options' => [
                    ['text' => 'Crear tecnología que facilite la vida de las personas', 'weights' => ['technology' => 10]],
                    ['text' => 'Mejorar la salud y calidad de vida de la gente', 'weights' => ['health' => 10]],
                    ['text' => 'Generar impacto social o comunitario', 'weights' => ['social' => 10]],
                    ['text' => 'Construir o dirigir mi propio negocio', 'weights' => ['business' => 10]],
                    ['text' => 'Producir contenido creativo que inspire a otros', 'weights' => ['creativity' => 10]],
                    ['text' => 'Hacer descubrimientos que aporten al conocimiento', 'weights' => ['science' => 10]],
                ],
            ],
            [
                'text' => '¿Con qué frase te identificas más?',
                'options' => [
                    ['text' => '"Siempre quiero entender cómo funcionan las cosas por dentro."', 'weights' => ['technology' => 6, 'science' => 4]],
                    ['text' => '"Me gusta cuidar y escuchar a las personas."', 'weights' => ['health' => 6, 'social' => 4]],
                    ['text' => '"Disfruto expresarme y crear cosas nuevas."', 'weights' => ['creativity' => 10]],
                    ['text' => '"Me motiva liderar, negociar y ver resultados."', 'weights' => ['business' => 10]],
                    ['text' => '"Me gusta enseñar y ver crecer a los demás."', 'weights' => ['education' => 10]],
                    ['text' => '"Disfruto resolver problemas lógicos o numéricos."', 'weights' => ['math' => 10]],
                ],
            ],
            [
                'text' => '¿Qué tipo de noticias sueles leer o ver con más interés?',
                'options' => [
                    ['text' => 'Innovación, gadgets y avances digitales', 'weights' => ['technology' => 10]],
                    ['text' => 'Salud pública, medicina y bienestar', 'weights' => ['health' => 10]],
                    ['text' => 'Economía, empresas y emprendimiento', 'weights' => ['business' => 10]],
                    ['text' => 'Cultura, arte y espectáculos', 'weights' => ['creativity' => 8, 'communication' => 2]],
                    ['text' => 'Política, sociedad y derechos humanos', 'weights' => ['social' => 10]],
                    ['text' => 'Medio ambiente, ciencia y descubrimientos', 'weights' => ['science' => 10]],
                ],
            ],
            [
                'text' => 'Si pudieras resolver un problema del mundo, ¿cuál elegirías?',
                'options' => [
                    ['text' => 'Falta de acceso a tecnología en comunidades rurales', 'weights' => ['technology' => 10]],
                    ['text' => 'Enfermedades sin cura o poco atendidas', 'weights' => ['health' => 10]],
                    ['text' => 'Pobreza y desigualdad social', 'weights' => ['social' => 10]],
                    ['text' => 'Falta de educación de calidad para todos', 'weights' => ['education' => 10]],
                    ['text' => 'Cambio climático y contaminación', 'weights' => ['science' => 10]],
                    ['text' => 'Desempleo y falta de oportunidades económicas', 'weights' => ['business' => 10]],
                ],
            ],
            [
                'text' => '¿Qué habilidad te gustaría perfeccionar más?',
                'options' => [
                    ['text' => 'Programar o crear soluciones digitales', 'weights' => ['technology' => 10]],
                    ['text' => 'Comunicarme y hablar en público', 'weights' => ['communication' => 10]],
                    ['text' => 'Dibujar, diseñar o crear contenido visual', 'weights' => ['creativity' => 10]],
                    ['text' => 'Calcular, medir y analizar con precisión', 'weights' => ['math' => 10]],
                    ['text' => 'Negociar y administrar recursos', 'weights' => ['business' => 10]],
                    ['text' => 'Brindar cuidado y apoyo emocional a otros', 'weights' => ['health' => 6, 'social' => 4]],
                ],
            ],
        ];

        foreach ($questions as $qIndex => $q) {
            $question = Question::updateOrCreate(
                ['text' => $q['text']],
                ['order' => $qIndex + 1]
            );

            foreach ($q['options'] as $oIndex => $option) {
                $question->options()->updateOrCreate(
                    ['text' => $option['text']],
                    ['interest_weights' => $option['weights'], 'order' => $oIndex + 1]
                );
            }
        }
    }
}
