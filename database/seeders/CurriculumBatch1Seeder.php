<?php

namespace Database\Seeders;

use App\Models\CurriculumItem;
use App\Models\InstitutionCareer;
use Illuminate\Database\Seeder;

/**
 * Primer lote de pensums reales (Fase 3): UES, UCA, UDB — 7 combinaciones
 * institución-carrera verificadas con fuente oficial. Ver reportes de
 * investigación para las URLs de cada malla curricular.
 */
class CurriculumBatch1Seeder extends Seeder
{
    public function run(): void
    {
        $this->seedCareer(3, 'Ingeniería de Sistemas Informáticos', [
            ['Ciclo I', 1, [
                ['Fundamentos de Programación', 'FPC115', 4],
                ['Álgebra Lineal y Vectorial', 'ALV115', 4],
                ['Fundamentos Empresariales', 'FEM115', 4],
                ['Cálculo Diferencial', 'CAD115', 4],
                ['Ingeniería de Sistemas y Sociedad', 'ISS115', 2],
            ]],
            ['Ciclo II', 2, [
                ['Estructuras de Datos I', 'ESD115', 4],
                ['Teoría de Sistemas', 'TSI115', 2],
                ['Programación Orientada a Objetos', 'POO115', 4],
                ['Cálculo Integral', 'CAI115', 4],
                ['Mecánica Clásica', 'MEC115', 4],
            ]],
            ['Ciclo III', 3, [
                ['Estructuras de Datos II', 'ESD215', 4],
                ['Aplicaciones de Escritorio', 'APE115', 2],
                ['Base de Datos I', 'BAD115', 4],
                ['Sistemas Contables', 'SCO115', 4],
                ['Cálculo Multivariable', 'CAM115', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Programación para Internet', 'PPI115', 4],
                ['Ingeniería de Requerimientos', 'INR115', 4],
                ['Base de Datos II', 'BAD215', 4],
                ['Estadística Básica', 'ESB115', 4],
                ['Electricidad y Magnetismo', 'EMA115', 4],
            ]],
            ['Ciclo V', 5, [
                ['Técnica Electiva I', null, 4],
                ['Formulación y Evaluación de Proyectos Informáticos I', 'FPI115', 2],
                ['Diseño de Software', 'DSI115', 4],
                ['Estadística Aplicada', 'ESA115', 4],
                ['Arquitecturas de Computadoras', 'ARC115', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Técnica Electiva II', null, 4],
                ['Formulación y Evaluación de Proyectos Informáticos II', 'FPI215', 4],
                ['Aseguramiento de la Calidad de Software', 'ASC115', 4],
                ['Arquitectura de Software I', 'ARS115', 4],
                ['Gestión del Talento Humano', 'GTH115', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Técnica Electiva III', null, 4],
                ['Programación para Arquitecturas Empresariales', 'PAE115', 4],
                ['Arquitectura de Software II', 'ARS215', 4],
                ['Sistemas Operativos', 'SIO115', 4],
                ['Fundamentos de Redes', 'FDR115', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Técnica Electiva IV', null, 4],
                ['Mercadeo de Productos y Servicios de TI', 'MPS115', 4],
                ['Gestión de Proyectos de Desarrollo de Software', 'GPS115', 4],
                ['Microprogramación', 'MIP115', 4],
                ['Seguridad Informática', 'SEI115', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Técnica Electiva V', null, 4],
                ['Gerencia Informática', 'GEI115', 4],
                ['Metodología de la Investigación Científica', 'MEI115', 4],
                ['Introducción a la Analítica de Datos', 'IAD115', 4],
                ['Diseño de Redes de Datos', 'DRD115', 4],
            ]],
            ['Ciclo X', 10, [
                ['Técnica Electiva VI', null, 4],
                ['Planeación Estratégica', 'PLE115', 2],
                ['Continuidad de Servicios', 'COS115', 4],
                ['Gestión de Redes de Datos', 'GRD115', 2],
                ['Gestión del Conocimiento', 'GEC115', 4],
            ]],
            ['Fuera de ciclo regular', null, [
                ['Inglés I', 'ING115', 2],
                ['Inglés II', 'ING215', 2],
                ['Inglés III', 'ING315', 2],
                ['Inglés IV', 'ING415', 2],
                ['Fundamentos de Emprendimiento', 'FMP115', 2],
                ['Taller de Grado', 'TAG115', 2],
            ]],
        ]);

        $this->seedCareer(38, 'Licenciatura en Ciencias Jurídicas', [
            ['Semestre I', 1, [
                ['Principios de Filosofía', 'PDF112', 4],
                ['Sociedad y Economía', 'SYE112', 4],
                ['Introducción al Estudio del Derecho I', 'IED112', 4],
                ['Introducción a las Ciencias Políticas', 'ICP112', 4],
                ['Introducción a la Investigación Social I', 'ISO112', 4],
            ]],
            ['Semestre II', 2, [
                ['Ética Jurídica', 'EJU112', 4],
                ['Fundamentos Sociológicos y Económicos del Derecho', 'FSE112', 4],
                ['Introducción al Estudio del Derecho II', 'IED212', 4],
                ['Teoría del Estado', 'TES112', 4],
                ['Introducción a la Investigación Social II', 'ISO212', 4],
            ]],
            ['Semestre III', 3, [
                ['Derecho Constitucional I', 'DCO112', 4],
                ['Derecho de Familia', 'DFA112', 4],
                ['Derecho Civil: Personas y Bienes', 'DCI112', 4],
                ['Teoría General del Proceso', 'TGP112', 4],
                ['Derecho Penal I', 'DPE112', 4],
            ]],
            ['Semestre IV', 4, [
                ['Derecho Constitucional II', 'DCO212', 4],
                ['Derecho Procesal de Familia', 'DPF112', 4],
                ['Derecho Civil: Obligaciones', 'DCI212', 4],
                ['Derecho Procesal I', 'DPR112', 4],
                ['Derecho Penal II', 'DPE212', 4],
            ]],
            ['Semestre V', 5, [
                ['Derecho Laboral I', 'DLA112', 4],
                ['Derecho Administrativo', 'DAD112', 4],
                ['Derecho Civil: Contratos', 'DCI312', 4],
                ['Derecho Procesal II', 'DPR212', 4],
                ['Derecho Procesal Penal I', 'DPP112', 4],
            ]],
            ['Semestre VI', 6, [
                ['Derecho Laboral II', 'DLA212', 4],
                ['Derecho Administrativo Financiero', 'DAF112', 4],
                ['Derecho Civil: Sucesiones', 'DCI412', 4],
                ['Derecho Procesal III', 'DPR312', 4],
                ['Derecho Procesal Penal II', 'DPP212', 4],
            ]],
            ['Semestre VII', 7, [
                ['Derecho Procesal Laboral', 'DPL112', 4],
                ['Derecho Tributario', 'DTR112', 4],
                ['Derecho Mercantil I', 'DME112', 4],
                ['Derecho Notarial', 'DNO112', 4],
                ['Derecho Procesal Penal III', 'DPP312', 4],
            ]],
            ['Semestre VIII', 8, [
                ['Derecho Municipal', 'DMU112', 4],
                ['Derecho Internacional Público', 'DIP112', 4],
                ['Derecho Mercantil II', 'DME212', 4],
                ['Derecho Registral', 'DRE112', 4],
                ['Criminología', 'CRI112', 4],
            ]],
            ['Semestre IX', 9, [
                ['Derecho Ambiental', 'DAM112', 4],
                ['Derecho Procesal Administrativo', 'DPA112', 4],
                ['Derecho Mercantil III', 'DME312', 4],
                ['Técnicas de Oralidad', 'TOR112', 4],
                ['Ejecución de Penas y Medidas de Seguridad', 'EPM112', 4],
            ]],
            ['Semestre X', 10, [
                ['Filosofía del Derecho', 'FDE112', 4],
                ['Derecho Procesal Constitucional', 'DPC112', 4],
                ['Electiva jurídica I', null, 4],
                ['Electiva jurídica II', null, 4],
                ['Electiva jurídica III', null, 4],
            ]],
        ]);

        $this->seedCareer(12, 'Ingeniería Informática', [
            ['Ciclo 01', 1, [
                ['Precálculo', '010180', 4],
                ['Elementos para el Estudio de la Ciencia y la Tecnología', '200087', 4],
                ['Matemática Discreta I', '010142', 3],
                ['Fundamentos de Programación', '190153', 4],
            ]],
            ['Ciclo 02', 2, [
                ['Álgebra Vectorial y Matrices', '010112', 4],
                ['Cálculo I', '010181', 4],
                ['Programación de Estructuras Dinámicas', '190154', 4],
                ['Matemática Discreta II', '010143', 3],
            ]],
            ['Ciclo 03', 3, [
                ['Física I', '200068', 5],
                ['Cálculo II', '010182', 4],
                ['Programación Orientada a Objetos', '190175', 4],
                ['Bases de Datos', '190155', 4],
            ]],
            ['Ciclo 04', 4, [
                ['Electricidad y Magnetismo', '200084', 5],
                ['Cálculo III', '010183', 4],
                ['Programación Web', '190156', 4],
                ['Administración de Bases de Datos', '190157', 4],
                ['Optativa Humanístico-Social I', null, 4],
            ]],
            ['Ciclo 05', 5, [
                ['Análisis Numérico', '010141', 4],
                ['Redes de Computadoras', '190158', 4],
                ['Programación de Dispositivos Móviles', '190159', 4],
                ['Análisis de Sistemas', '190160', 3],
                ['Física II', '200069', 5],
            ]],
            ['Ciclo 06', 6, [
                ['Optativa Humanístico-Social II', null, 4],
                ['Análisis de Algoritmos', '190161', 4],
                ['Programación de Artefactos', '190162', 4],
                ['Probabilidad y Estadística', '010118', 4],
                ['Seguridad en Entornos de Desarrollo', '190163', 4],
            ]],
            ['Ciclo 07', 7, [
                ['Arquitectura de Computadoras', '190065', 4],
                ['Técnicas de Simulación en Computadoras', '190164', 4],
                ['Programación N-Capas', '190165', 4],
                ['Fundamentos de Inteligencia de Negocios', '190176', 4],
                ['Optativa Humanístico-Social III', null, 4],
            ]],
            ['Ciclo 08', 8, [
                ['Sistemas Operativos', '190166', 4],
                ['Programación Declarativa', '190167', 4],
                ['Ingeniería de Software', '190168', 4],
                ['Formulación y Evaluación de Proyectos', '250055', 4],
            ]],
            ['Ciclo 09', 9, [
                ['Optativa Humanístico-Social IV', null, 3],
                ['Optativa Técnica I', null, 4],
                ['Aplicaciones de Código Abierto', '190169', 4],
                ['Práctica Profesional I', '190170', 4],
            ]],
            ['Ciclo 10', 10, [
                ['Optativa Técnica II', null, 4],
                ['Teoría de Lenguajes de Programación', '190171', 4],
                ['Optativa Humanístico-Social V', null, 4],
                ['Práctica Profesional II', '190172', 4],
            ]],
        ]);

        $this->seedCareer(14, 'Licenciatura en Administración de Empresas', [
            ['Ciclo 01', 1, [
                ['Fundamentos para la Investigación Empresarial', '020358', 3],
                ['Introducción a la Economía I', '060115', 4],
                ['Principios de Contabilidad', '270060', 4],
                ['Principios de Matemática', '010179', 4],
            ]],
            ['Ciclo 02', 2, [
                ['Fundamentos de Administración', '020326', 3],
                ['Introducción a la Economía II', '060116', 4],
                ['Contabilidad Financiera', '270072', 4],
                ['Matemática', '010189', 5],
            ]],
            ['Ciclo 03', 3, [
                ['Comportamiento Organizacional', '020167', 3],
                ['Microeconomía', '060190', 4],
                ['Gestión de Costos y Presupuestos', '270074', 4],
                ['Matemática Financiera', '010190', 4],
                ['Optativa Humanístico-Social I', null, 4],
            ]],
            ['Ciclo 04', 4, [
                ['Liderazgo Personal', '020359', 3],
                ['Macroeconomía', '060191', 4],
                ['Fundamentos de Análisis Financieros', '270076', 4],
                ['Estadística Aplicada', '010191', 4],
            ]],
            ['Ciclo 05', 5, [
                ['Gestión de Equipos', '020354', 3],
                ['Fundamentos de Mercadeo', '020238', 4],
                ['Gestión Financiera a Corto Plazo', '270087', 4],
                ['Gestión de Operaciones', '250077', 5],
                ['Optativa Humanístico-Social II', null, 4],
            ]],
            ['Ciclo 06', 6, [
                ['Emprendimiento e Innovación', '020327', 4],
                ['Gestión del Marketing', '020360', 4],
                ['Gestión Financiera a Largo Plazo', '270088', 4],
                ['Logística de Aprovisionamiento y Distribución', '020361', 4],
            ]],
            ['Ciclo 07', 7, [
                ['Análisis Estratégico', '020283', 4],
                ['Investigación de Mercados', '020239', 5],
                ['Gestión Estratégica del Talento Humano I', '020362', 5],
                ['Diseño y Gestión de Modelos de Negocio', '020363', 4],
            ]],
            ['Ciclo 08', 8, [
                ['Taller de Planificación Estratégica', '020364', 4],
                ['Legislación Comercial y Tributaria', null, 4],
                ['Gestión Estratégica del Talento Humano II', '020365', 5],
                ['Optativa Humanístico-Social III', null, 4],
            ]],
            ['Ciclo 09', 9, [
                ['Sistema de Inteligencia de Negocios I', '020366', 4],
                ['Formulación y Evaluación de Proyectos', '020367', 5],
                ['Comercio Internacional', '020368', 4],
                ['Optativa Humanístico-Social IV', null, 4],
            ]],
            ['Ciclo 10', 10, [
                ['Sistema de Inteligencia de Negocios II', '020369', 4],
                ['Proyectos de Desarrollo', '020370', 5],
                ['Consultoría Empresarial', '020336', 4],
                ['Ética Profesional', '100203', 3],
            ]],
        ]);

        $this->seedCareer(43, 'Licenciatura en Ciencias Jurídicas', [
            ['Ciclo 01', 1, [
                ['Introducción al Derecho I', '040238', 4],
                ['Expresión Escrita y Técnicas de Redacción', '110272', 4],
                ['Derecho Constitucional I: Teoría del Estado', '040272', 4],
                ['Optativa Técnica', null, 4],
            ]],
            ['Ciclo 02', 2, [
                ['Introducción al Derecho Procesal', '040092', 4],
                ['Derecho y Contexto Social', '040240', 4],
                ['Derecho Constitucional II: Derechos Humanos', '040241', 4],
                ['Bienes y Registro', '040239', 4],
            ]],
            ['Ciclo 03', 3, [
                ['Teorías de la Fundamentación del Derecho', '040254', 4],
                ['Derecho Penal I', '040020', 4],
                ['Derecho Constitucional III: Organización del Estado', '040243', 4],
                ['Obligaciones', '040242', 4],
            ]],
            ['Ciclo 04', 4, [
                ['Litigación Oral', '040246', 3],
                ['Derecho Penal II', '040021', 4],
                ['Derecho Procesal Constitucional', '040346', 4],
                ['Contratos', '040244', 4],
            ]],
            ['Ciclo 05', 5, [
                ['Optativa Humanístico-Social', null, 4],
                ['Derecho Procesal Penal I', '040319', 4],
                ['Derecho Societario', '040320', 4],
                ['Sucesiones', '040321', 4],
            ]],
            ['Ciclo 06', 6, [
                ['Derecho Laboral I', '040322', 4],
                ['Derecho Procesal Penal II', '040323', 4],
                ['Derecho Cambiario', '040324', 4],
                ['Derecho de Familia', '040325', 4],
            ]],
            ['Ciclo 07', 7, [
                ['Derecho Laboral II', '040326', 4],
                ['Contratos Mercantiles', '040327', 4],
                ['Derecho Procesal de Familia', '040328', 4],
                ['Optativa Humanístico-Social', null, 4],
            ]],
            ['Ciclo 08', 8, [
                ['Derecho Procesal Laboral', '040329', 4],
                ['Derecho Administrativo I', '040330', 4],
                ['Derecho Procesal Civil y Mercantil I', '040331', 4],
                ['Derecho Internacional Público', '040332', 4],
                ['Derecho Notarial', '040333', 4],
            ]],
            ['Ciclo 09', 9, [
                ['Optativa Técnica', null, 4],
                ['Derecho Administrativo II', '040339', 4],
                ['Derecho Procesal Civil y Mercantil II', '040340', 4],
                ['Derecho Internacional Privado', '040341', 4],
            ]],
            ['Ciclo 10', 10, [
                ['Responsabilidad Profesional de la Abogacía', '040342', 3],
                ['Derecho Tributario', '040343', 4],
                ['Derecho Bancario', '040344', 4],
                ['Derecho Comunitario de Centroamérica', '040345', 4],
                ['Optativa Técnica', null, 4],
            ]],
        ]);

        $this->seedCareer(23, null, [
            ['Ciclo I', 1, [
                ['Antropología Filosófica', 'ANF231', 3],
                ['Pensamiento Social Cristiano', 'PSC231', 3],
                ['Álgebra Vectorial y Matrices', 'ALG501', 4],
                ['Cálculo Diferencial', 'CAD501', 4],
            ]],
            ['Ciclo II', 2, [
                ['Aplicaciones de Dibujo Industrial y Sistemas CAD', 'DIS103', 3],
                ['Química General', 'QUG501', 4],
                ['Cinemática y Dinámica de las Partículas', 'CDP501', 4],
                ['Cálculo Integral', 'CAI501', 4],
            ]],
            ['Ciclo III', 3, [
                ['Electricidad y Magnetismo', 'EYM501', 4],
                ['Estadística Aplicada', 'ESA501', 4],
                ['Oscilaciones, Fluidos y Calor', 'OFC501', 4],
                ['Cálculo de Varias Variables', 'CVV501', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Diseño Industrial de Procesos', 'DIP106', 4],
                ['Análisis del Entorno Industrial', 'AEI106', 4],
                ['Análisis Estadístico de los Procesos', 'AEP106', 4],
                ['Ecuaciones Diferenciales', 'EDI501', 4],
            ]],
            ['Ciclo V', 5, [
                ['Ingeniería del Trabajo Industrial', 'ITI106', 4],
                ['Análisis y Evaluación Económica', 'AEE106', 4],
                ['Gestión Ambiental', 'GEA106', 4],
                ['Optimización de Modelos Industriales', 'OPM106', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Sistemas Industriales de Manufactura', 'SIM106', 4],
                ['Dirección de Proyectos', 'DDP106', 4],
                ['Inteligencia de Negocios', 'IDN106', 4],
                ['Gestión de Almacenes', 'GAL106', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Automatización de Procesos Industriales', 'API106', 4],
                ['Control de Costos Industriales', 'CCI106', 4],
                ['Administración de la Calidad', 'ACA106', 4],
                ['Diseño de Redes de Distribución', 'DRD106', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Diseño de Plantas Industriales', 'DPI106', 4],
                ['Gestión Administrativa', 'GAD106', 4],
                ['Ecoeficiencia de Procesos Industriales', 'EPI106', 4],
                ['Gestión de la Cadena de Abastecimientos', 'CDA106', 5],
            ]],
            ['Ciclo IX', 9, [
                ['Planeación y Control de la Producción', 'PCP106', 4],
                ['Gestión del Capital Humano', 'GCH106', 4],
                ['Gestión de Riesgos Industriales', 'RII106', 5],
                ['Gestión del Comercio Internacional', 'GCI106', 4],
            ]],
            ['Ciclo X', 10, [
                ['Diseño de Planes de Negocio', 'DPN106', 4],
                ['Planeación Estratégica y Finanzas', 'PEF106', 5],
                ['Sistemas de Gestión Integrados', 'SGI106', 4],
                ['Electiva Técnica I', null, 4],
            ]],
        ]);

        $this->seedCareer(49, 'Ingeniería en Ciencias de la Computación', [
            ['Ciclo I', 1, [
                ['Cálculo Diferencial', 'CAD501', 4],
                ['Química General', 'QUG501', 4],
                ['Antropología Filosófica', 'ANF231', 3],
                ['Programación Estructurada', 'PRE104', 4],
            ]],
            ['Ciclo II', 2, [
                ['Álgebra Vectorial y Matrices', 'ALG501', 4],
                ['Cálculo Integral', 'CAI501', 4],
                ['Modelamiento y Diseño de Base de Datos', 'MDB104', 4],
                ['Programación Orientada a Objetos', 'POO104', 4],
            ]],
            ['Ciclo III', 3, [
                ['Cálculo de Varias Variables', 'CVV501', 4],
                ['Cinemática y Dinámica de las Partículas', 'CDP501', 4],
                ['Análisis y Diseño de Sistemas Informáticos', 'ADS104', 4],
                ['Programación con Estructuras de Datos', 'PRD104', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Ecuaciones Diferenciales', 'EDI501', 4],
                ['Electricidad y Magnetismo', 'EYM501', 4],
                ['Datawarehouse y Minería de Datos', 'DMD104', 4],
                ['Estadística Aplicada', 'ESA501', 4],
            ]],
            ['Ciclo V', 5, [
                ['Análisis de Circuitos Eléctricos', 'ACE102', 4],
                ['Gestión Ambiental', 'GEA106', 4],
                ['Análisis y Evaluación Económica', 'AEE106', 4],
                ['Oscilaciones, Fluidos y Calor', 'OFC501', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Dirección de Proyectos', 'DDP106', 4],
                ['Arquitectura de Computadoras', 'ACO101', 4],
                ['Lenguajes Interpretados en el Cliente', 'LIC104', 4],
                ['Diseño de Redes de Datos', 'DRD101', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Aplicación de Métodos Numéricos', 'APN501', 4],
                ['Sistemas Operativos', 'SIO104', 4],
                ['Lenguajes Interpretados en el Servidor', 'LIS104', 4],
                ['Interconexión de Redes de Datos', 'IRD101', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Pensamiento Social Cristiano', 'PSC231', 3],
                ['Ingeniería de Software', 'INS104', 5],
                ['Diseño y Programación de Software Multiplataforma', 'DPS104', 4],
                ['Diseño de Sistemas de Seguridad para Redes de Datos', 'DSS101', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Normalización de Tecnologías de la Información', 'NTI104', 4],
                ['Gestión de la Calidad del Software', 'CDS104', 5],
                ['Desarrollo de Software para Móviles', 'DSM104', 4],
                ['Administración e Implementación de Redes con Sistemas Operativos Propietarios', 'ASR104', 4],
            ]],
            ['Ciclo X', 10, [
                ['Auditoría de Sistemas', 'AUS104', 4],
                ['Electiva', null, 4],
                ['Desarrollo de Software Empresarial', 'DES104', 5],
                ['Administración e Implementación de Redes con Sistemas Operativos Libres', 'ASI104', 4],
            ]],
        ]);
    }

    /**
     * @param  array<int, array{0: string, 1: int|null, 2: array<int, array{0: string, 1: string|null, 2: int}>}>  $cycles
     */
    private function seedCareer(int $institutionCareerId, ?string $officialName, array $cycles): void
    {
        $institutionCareer = InstitutionCareer::findOrFail($institutionCareerId);

        if ($officialName) {
            $institutionCareer->update(['official_career_name' => $officialName]);
        }

        $sortOrder = 0;

        foreach ($cycles as [$cycleLabel, $cycleNumber, $items]) {
            foreach ($items as [$subjectName, $subjectCode, $credits]) {
                CurriculumItem::updateOrCreate(
                    [
                        'institution_career_id' => $institutionCareerId,
                        'subject_name' => $subjectName,
                        'cycle_label' => $cycleLabel,
                    ],
                    [
                        'cycle_number' => $cycleNumber,
                        'subject_code' => $subjectCode,
                        'credits' => $credits,
                        'sort_order' => $sortOrder,
                    ]
                );
                $sortOrder++;
            }
        }
    }
}
