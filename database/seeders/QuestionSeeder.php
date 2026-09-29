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
                    ['text' => 'Crear una página web', 'weights' => ['technology' => 10]],
                    ['text' => 'Diseñar un logotipo', 'weights' => ['creativity' => 10]],
                    ['text' => 'Ayudar a una persona enferma', 'weights' => ['health' => 10]],
                    ['text' => 'Resolver un problema matemático', 'weights' => ['math' => 10]],
                    ['text' => 'Organizar un proyecto', 'weights' => ['business' => 10]],
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
                ],
            ],
            [
                'text' => '¿Qué red social o plataforma usarías para crear contenido?',
                'options' => [
                    ['text' => 'Para explicar temas de ciencia o tecnología', 'weights' => ['technology' => 6, 'science' => 6]],
                    ['text' => 'Para compartir diseños o arte propio', 'weights' => ['creativity' => 10]],
                    ['text' => 'Para hacer noticias o entrevistas', 'weights' => ['communication' => 10]],
                    ['text' => 'Para dar consejos de salud y bienestar', 'weights' => ['health' => 10]],
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
