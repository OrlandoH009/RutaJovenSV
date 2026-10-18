<?php

namespace Database\Seeders;

use App\Models\CurriculumItem;
use App\Models\InstitutionCareer;
use Illuminate\Database\Seeder;

/**
 * Segundo lote de pensums reales (Fase 3, resto de carreras de UES/UCA/UDB).
 * Ver reportes de investigación para las URLs de cada malla curricular.
 */
class CurriculumBatch2Seeder extends Seeder
{
    public function run(): void
    {
        $this->seedCareer(36, null, [
            ['Ciclo I', 1, [
                ['Métodos de Investigación', 'MEI115', 3],
                ['Medio Ambiente', 'MEA115', 3],
                ['Dibujo Básico', 'DIB115', 5],
                ['Cálculo Diferencial', 'CAD115', 4],
            ]],
            ['Ciclo II', 2, [
                ['Fundamentos de Arquitectura', 'FUA115', 3],
                ['Fundamentos de Diseño I', 'FUD115', 5],
                ['Física para Arquitectura', 'FPA115', 4],
                ['Geometría Descriptiva', 'GED115', 5],
                ['Cálculo Integral', 'CAI115', 4],
                ['Inglés I', 'ING115', 2],
            ]],
            ['Ciclo III', 3, [
                ['Arquitectura de la Antigüedad', 'ARA115', 3],
                ['Fundamentos de Diseño II', 'FUD215', 5],
                ['Topografía', 'TOP115', 4],
                ['Dibujo Arquitectónico', 'DIA115', 5],
                ['Procesos Constructivos', 'PCO115', 5],
                ['Estática para Arquitectura', 'ESA115', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Arquitectura Medieval', 'AME115', 3],
                ['Metodología del Diseño', 'MED115', 5],
                ['Sistema de Información Territorial', 'SIT115', 4],
                ['Perspectiva y Sombra', 'PES115', 5],
                ['Desarrollo del Proyecto Arquitectónico', 'DPA115', 5],
                ['Introducción a las Estructuras', 'INE115', 4],
                ['Inglés II', 'ING215', 2],
                ['Fundamentos de Emprendimiento', 'FMP115', 2],
            ]],
            ['Ciclo V', 5, [
                ['Arquitectura Moderna', 'AMO115', 3],
                ['Diseño Espacial Inicial', 'DEI115', 5],
                ['Iniciación al Urbanismo', 'INU115', 3],
                ['Representación Arquitectónica I', 'RPA115', 5],
                ['Presupuesto del Proyecto Arquitectónico', 'PPA115', 3],
                ['Diseño de Elementos Estructurales', 'DEE115', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Arquitectura Contemporánea', 'ACO115', 3],
                ['Diseño Espacial Multigenérico', 'DEM115', 5],
                ['Sociología Urbana', 'SOU115', 3],
                ['Representación Arquitectónica II', 'RPA215', 5],
                ['Desarrollo del Proyecto Urbanístico', 'DPU115', 3],
                ['Propuesta Estructural para Edificios', 'PEE115', 4],
                ['Inglés III', 'ING315', 2],
            ]],
            ['Ciclo VII', 7, [
                ['Diseño de Complejos Comerciales', 'DCC115', 5],
                ['Planificación Territorial', 'PLT115', 3],
                ['Presupuesto del Proyecto Urbanístico', 'PPU115', 3],
                ['Estadística Básica', 'EBA115', 4],
                ['Electiva I', null, 3],
            ]],
            ['Ciclo VIII', 8, [
                ['Diseño de Complejos Culturales', 'DCU115', 5],
                ['Diseño Urbano', 'DIU115', 3],
                ['Programación de Obras', 'PRO115', 3],
                ['Inglés IV', 'ING415', 2],
                ['Electiva II', null, 3],
            ]],
            ['Ciclo IX', 9, [
                ['Diseño de Complejos Habitacionales', 'DCH115', 5],
                ['Hábitat', null, 3],
                ['Concursos y Licitaciones', 'COL115', 3],
                ['Electiva III', null, 3],
            ]],
            ['Ciclo X', 10, [
                ['Formulación y Evaluación de Proyectos', 'FEP115', 3],
                ['Diseño de Complejos Urbanos', 'DUR115', 5],
                ['Administración y Supervisión de Obras', 'ASO115', 3],
                ['Electiva IV', null, 3],
            ]],
        ]);

        $this->seedCareer(40, null, [
            ['Ciclo 1', 1, [
                ['Teoría Administrativa I', 'TAD118', 3],
                ['Filosofía General', 'FIG118', 3],
                ['Matemática I', 'MAT118', 5],
                ['Introducción a la Economía I', 'INE118', 4],
            ]],
            ['Ciclo 2', 2, [
                ['Sociología General', 'SOG118', 3],
                ['Teoría Administrativa II', 'TAD218', 3],
                ['Matemática II', 'MAT218', 5],
                ['Inglés I', 'ING118', 2],
                ['Introducción a la Economía II', 'INE218', 4],
            ]],
            ['Ciclo 3', 3, [
                ['Computación I', 'COM118', 2],
                ['Inglés II', 'ING218', 2],
                ['Microeconomía I', 'MIC118', 4],
                ['Contabilidad Financiera I', 'COF118', 4],
                ['Técnicas de Investigación', 'TDI118', 3],
                ['Matemática III', 'MAT318', 5],
            ]],
            ['Ciclo 4', 4, [
                ['Computación II', 'COM218', 2],
                ['Macroeconomía I', 'MAC118', 4],
                ['Contabilidad Financiera II', 'COF218', 4],
                ['Matemática Financiera', 'MAF118', 5],
                ['Derecho Mercantil I', 'DME118', 3],
            ]],
            ['Ciclo 5', 5, [
                ['Estadística I', 'EST118', 5],
                ['Contabilidad Financiera III', 'COF318', 4],
                ['Contabilidad de Costos I', 'CCO118', 4],
                ['Derecho Mercantil II', 'DME218', 3],
            ]],
            ['Ciclo 6', 6, [
                ['Estadística II', 'EST218', 5],
                ['Derecho Tributario I', 'DET118', 3],
                ['Contabilidad Financiera IV', 'COF418', 4],
                ['Contabilidad de Costos II', 'CCO218', 4],
            ]],
            ['Ciclo 7', 7, [
                ['Administración Financiera I', 'ADF118', 4],
                ['Derecho Tributario II', 'DET218', 3],
                ['Contabilidad Financiera V', 'COF518', 4],
                ['Contabilidad de Seguros', 'CDS118', 4],
            ]],
            ['Ciclo 8', 8, [
                ['Contabilidad Agrícola y Ganadera', 'CAG118', 4],
                ['Contabilidad Bancaria', 'CBY118', 4],
                ['Administración Financiera II', 'ADF218', 4],
                ['Auditoría I', 'AUD118', 4],
            ]],
            ['Ciclo 9', 9, [
                ['Contabilidad Gubernamental', 'CGU118', 4],
                ['Sistemas Contables Computarizados', 'SCC118', 5],
                ['Auditoría II', 'AUD218', 4],
            ]],
            ['Ciclo 10', 10, [
                ['Seminario de Contabilidad', 'SEC118', 4],
                ['Auditoría de Sistemas', 'AUS118', 4],
                ['Seminario de Auditoría', 'SEA118', 4],
            ]],
            ['Electivas', null, [
                ['Derecho Laboral', 'DLA118', 3],
                ['Administración de la Producción', 'APR118', 4],
                ['Legislación Aduanera', 'LEA118', 3],
                ['Formulación y Evaluación de Proyectos', 'FEP118', 4],
            ]],
        ]);

        $this->seedCareer(1, 'Ingeniería en Desarrollo de Software', [
            ['Ciclo I', 1, [
                ['Paradigmas de Programación', 'PAP135', 4],
                ['Matemática Aplicada I', 'MAT135', 4],
                ['Introducción a la Ingeniería de Software', 'IIS135', 4],
                ['Introducción a las Bases de Datos', 'IBD135', 4],
                ['Inglés Técnico I', 'ITE135', 4],
            ]],
            ['Ciclo II', 2, [
                ['Física para Ingeniería', 'FIN135', 4],
                ['Matemática Aplicada II', 'MAT235', 4],
                ['Probabilidad y Estadística', 'PYE135', 4],
                ['Investigación en Ingeniería Aplicada', 'IIA135', 4],
                ['Inglés Técnico II', 'ITE235', 4],
            ]],
            ['Ciclo III', 3, [
                ['Diseño y Programación de Base de Datos', 'DPB135', 4],
                ['Manejo de Estructura de Datos', 'MED135', 4],
                ['Lógica de Programación', 'LDP135', 4],
                ['Principios de Economía', 'PEC135', 4],
                ['Inglés Técnico III', 'ITE335', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Administración de Bases de Datos', 'ABD135', 4],
                ['Lógica y Diseño Digital', 'LDD135', 4],
                ['Programación Orientada a Objetos', 'POO135', 4],
                ['Psicología del Trabajo', 'PTR135', 4],
                ['Introducción al Software Libre', 'ISL135', 4],
            ]],
            ['Ciclo V', 5, [
                ['Análisis y Diseño de Software I', 'ADS135', 4],
                ['Diseño y Estructura de Computadoras', 'DEC135', 4],
                ['Desarrollo de Aplicaciones Web', 'DAW135', 4],
                ['Cálculo Numérico para Desarrollo de Aplicaciones', 'CDA135', 4],
                ['Análisis de las Finanzas', 'AFI135', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Análisis y Diseño de Software II', 'ADS235', 4],
                ['Gestión y Programación de Sistemas Operativos I', 'GPO135', 4],
                ['Introducción a la Gestión Empresarial', 'IGE135', 4],
                ['Plan de Negocios', 'PDN135', 4],
                ['Programación de Modelos Matemáticos', 'PMM135', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Redes I', 'RED135', 4],
                ['Gestión y Programación de Sistemas Operativos II', 'GPO235', 4],
                ['Desarrollo de Aplicaciones Móviles I', 'DAM135', 4],
                ['Ingeniería de Negocios', 'INE135', 4],
                ['Técnica Electiva', null, 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Redes II', 'RED235', 4],
                ['Testing y Calidad del Software', 'CAS135', 4],
                ['Desarrollo de Aplicaciones Móviles II', 'DAM235', 4],
                ['Técnica Electiva I', null, 4],
                ['Técnica Electiva II', null, 4],
            ]],
            ['Ciclo IX', 9, [
                ['Derecho Laboral', 'DLA135', 4],
                ['Gestión del Capital Humano', 'GCH135', 4],
                ['Ética Profesional', 'EPR135', 4],
                ['Técnica Electiva III', null, 4],
                ['Técnica Electiva IV', null, 4],
            ]],
            ['Ciclo X', 10, [
                ['Asesoría Profesional', 'APR135', 4],
                ['Auditoría de Sistemas Informáticos', 'ASI135', 4],
                ['Gestión de Proyectos de Software', 'GPS135', 4],
                ['Seminario de Tesis', 'STE135', 4],
                ['Técnica Electiva', null, 4],
            ]],
        ]);

        $this->seedCareer(4, null, [
            ['Ciclo I', 1, [
                ['Cálculo Diferencial', 'CAD115', 4],
                ['Álgebra Lineal y Vectorial', 'ALV115', 4],
                ['Introducción a la Ingeniería Civil y Medio Ambiente', 'ICM115', 3],
                ['Dibujo para Ingeniería Civil', 'DIC115', 3],
                ['Psicología y Relaciones Sociolaborales', 'PRS115', 4],
            ]],
            ['Ciclo II', 2, [
                ['Cálculo Integral', 'CAI115', 4],
                ['Lógica y Algoritmos', 'LYA115', 4],
                ['Mecánica Clásica', 'MEC115', 4],
                ['Geometría Descriptiva', 'GEO115', 4],
                ['Química para Ingeniería', 'QPI115', 3],
                ['Inglés I', 'ING115', 2],
            ]],
            ['Ciclo III', 3, [
                ['Cálculo Multivariable', 'CAM115', 4],
                ['Estática', 'ETT115', 4],
                ['Ondas, Fluidos y Calor', 'OFC115', 4],
                ['Probabilidad y Estadística', 'PYE115', 4],
                ['Herramientas Informáticas para Ingeniería', 'HII115', 3],
            ]],
            ['Ciclo IV', 4, [
                ['Ecuaciones Diferenciales', 'ECD115', 4],
                ['Mecánica de Materiales', 'MDM115', 4],
                ['Dinámica', 'DNI115', 4],
                ['Topografía General', 'TOP115', 4],
                ['Inglés II', 'ING215', 2],
                ['Fundamentos de Emprendimiento', 'FMP115', 2],
            ]],
            ['Ciclo V', 5, [
                ['Geología Aplicada', 'GEA115', 4],
                ['Materiales de Construcción I', 'MCT115', 4],
                ['Análisis Estructural', 'AES115', 4],
                ['Mecánica de Fluidos', 'MFC115', 4],
                ['Topografía Aplicada', 'TOP215', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Mecánica de Suelos', 'MDS115', 4],
                ['Tecnología del Concreto', 'TEC115', 4],
                ['Estructuras de Concreto I', 'ESC115', 4],
                ['Hidráulica', 'HID115', 4],
                ['Sistemas de Información Geográfica', 'SIH115', 4],
                ['Inglés III', 'ING315', 2],
            ]],
            ['Ciclo VII', 7, [
                ['Análisis Geotécnico I', 'AGE115', 4],
                ['Estructuras de Mampostería', 'EMA115', 4],
                ['Estructuras de Acero I', 'EDA115', 4],
                ['Abastecimiento de Agua y Alcantarillados', 'AAL115', 4],
                ['Hidrología', 'HDI115', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Ingeniería Vial', 'IVL115', 4],
                ['Procesos Constructivos', 'PCT115', 4],
                ['Diseño Sismo Resistente', 'DRE115', 4],
                ['Ingeniería Sanitaria', 'ISA115', 4],
                ['Inglés IV', 'ING415', 2],
                ['Técnica Electiva', null, 4],
            ]],
            ['Ciclo IX', 9, [
                ['Formulación y Evaluación de Proyectos', 'FDP115', 4],
                ['Costos y Presupuestos', 'CIP115', 4],
                ['Técnica Electiva I', null, 4],
                ['Técnica Electiva II', null, 4],
                ['Técnica Electiva III', null, 4],
            ]],
            ['Ciclo X', 10, [
                ['Proyecto de Ingeniería', 'PDI115', 4],
                ['Planeamiento y Administración de Obras', 'PAB115', 4],
                ['Legislación Aplicada a la Práctica Profesional', 'LEA115', 3],
                ['Técnica Electiva IV', null, 4],
                ['Técnica Electiva V', null, 4],
            ]],
        ]);

        $this->seedCareer(5, null, [
            ['Ciclo I', 1, [
                ['Investigación en Ingeniería', 'IVI115', 4],
                ['Matemática I', 'MAT115', 4],
                ['Psicología y Relaciones Sociolaborales', 'PYR115', 4],
                ['Dibujo Técnico I', 'DIT115', 3],
                ['Introducción a la Ingeniería Industrial', 'III115', 4],
            ]],
            ['Ciclo II', 2, [
                ['Física I', 'FIR115', 4],
                ['Matemática II', 'MAT215', 4],
                ['Responsabilidad de la Ingeniería en la Economía y la Sociedad', 'RES115', 4],
                ['Química Técnica', 'QTR115', 4],
                ['Dibujo Técnico II', 'DIT215', 4],
            ]],
            ['Ciclo III', 3, [
                ['Física II', 'FIR215', 4],
                ['Matemática III', 'MAT315', 4],
                ['Ofimática y Software para Ingeniería Industrial', 'OFI115', 4],
                ['Lógica y Algoritmos', 'LYA115', 4],
                ['Sólidos Deformables', 'SDS115', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Física III', 'FIR315', 4],
                ['Matemática IV', 'MAT415', 4],
                ['Dinámica', 'DIN115', 4],
                ['Fundamentos de Administración', 'FAD115', 4],
                ['Tecnología Industrial I', 'TIR115', 4],
            ]],
            ['Ciclo V', 5, [
                ['Mecánica de los Fluidos', 'MEF115', 4],
                ['Fundamentos de Economía', 'FDE115', 4],
                ['Eficiencia Energética', 'EFE115', 4],
                ['Probabilidad y Estadística', 'PYE115', 4],
                ['Tecnología Industrial II', 'TIR215', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Ingeniería Económica', 'IEC115', 4],
                ['Investigación de Operaciones I', 'IOP115', 4],
                ['Gestión de la Calidad', 'GCA115', 4],
                ['Seguridad y Salud Ocupacional', 'SSO115', 4],
                ['Tecnología Industrial III', 'TIR315', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Gestión del Capital Humano', 'GCH115', 4],
                ['Contabilidad y Costos', 'CIC115', 4],
                ['Investigación de Operaciones II', 'IOP215', 4],
                ['Análisis y Diseño Organizacional', 'ADO115', 4],
                ['Ingeniería de Métodos', 'IMT115', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Mercadeo', 'MER115', 4],
                ['Administración Financiera', 'ADF115', 4],
                ['Gestión de la Cadena de Suministros', 'GCS115', 4],
                ['Distribución en Planta', 'DIP115', 4],
                ['Medida del Trabajo', 'MMT115', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Técnica Electiva I', null, 4],
                ['Técnica Electiva II', null, 4],
                ['Gestión de la Producción', 'GPR115', 4],
                ['Legislación Profesional', 'LPR115', 4],
                ['Formulación y Evaluación de Proyectos', 'FEP115', 4],
            ]],
            ['Ciclo X', 10, [
                ['Técnica Electiva III', null, 4],
                ['Técnica Electiva IV', null, 4],
                ['Gestión Empresarial', 'GEM115', 4],
                ['Protocolo de Trabajo de Graduación', 'PTG115', 3],
                ['Gestión de la Implementación de Proyectos', 'GIP115', 4],
            ]],
        ]);

        $this->seedCareer(10, 'Licenciatura en Educación con Especialidad en Administración y Gestión Educativa', [
            ['Ciclo I', 1, [
                ['Fundamentos Básicos de Filosofía', 'FBF114', 4],
                ['Expresión Oral y Escrita', 'EXI114', 4],
                ['Realidad Social', 'RSO114', 4],
                ['Tecnologías de la Información y Comunicación', 'TFC114', 4],
                ['Historia de la Educación y de la Pedagogía', 'HEP114', 4],
            ]],
            ['Ciclo II', 2, [
                ['Psicología de la Personalidad', 'PDP114', 4],
                ['Inglés Comunicativo', 'ICM114', 4],
                ['Introducción a la Investigación', 'IIV114', 4],
                ['Producción Multimedia para Entornos Educativos', 'PMU114', 4],
                ['Filosofía de la Educación', 'FIE114', 4],
            ]],
            ['Ciclo III', 3, [
                ['Seminario de Educación Ambiental, Educación Inclusiva, Gestión para la Reducción de Riesgos Familiar y de Género', 'SVA114', 4],
                ['Administración Institucional', 'ADI114', 4],
                ['Fundamentos Básicos de Matemática Aplicados a la Educación', 'FBA114', 4],
                ['Entornos Virtuales de Aprendizaje', 'ENV114', 4],
                ['Psicología Educativa', 'PSE114', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Seminario de Derechos Humanos, Prevención a la Violencia, Arte y Cultura', 'SDP114', 4],
                ['Inglés Técnico Aplicado a la Educación', 'ITE114', 4],
                ['Estadística Descriptiva e Inferencial Aplicada a la Educación', 'ETD114', 4],
                ['Administración y Gestión Educativa', 'AGE114', 4],
                ['Didáctica General y Diferencial en Educación', 'DGD114', 4],
            ]],
            ['Ciclo V', 5, [
                ['Evaluación de Aprendizajes I', 'EDA114', 4],
                ['Comunicación en Lengua de Señas', 'CLS114', 4],
                ['Investigación Educativa I', 'IVE114', 4],
                ['Educación del Movimiento Humano para la Salud', 'EMH114', 4],
                ['Desarrollo Profesional y Legislación Educativa', 'DPL114', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Evaluación de Aprendizajes II', 'EDA214', 4],
                ['Planeamiento Educativo y Diseño Curricular', 'PLC114', 4],
                ['Investigación Educativa II', 'IVE214', 4],
                ['Evaluación Institucional I', 'EVI114', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Dirección y Organización Institucional', 'DOI114', 5],
                ['Contabilidad Educativa y Uso de Software', 'CEW114', 5],
                ['Gestión del Talento Humano y Ética Profesional', 'GTH114', 6],
            ]],
            ['Ciclo VIII', 8, [
                ['Administración de Finanzas y Procesos Técnicos Administrativos', 'AFT114', 5],
                ['Comportamiento Organizacional', 'CPO114', 5],
                ['Planeación y Gestión Estratégica de Planes y Proyectos', 'PGP114', 6],
            ]],
            ['Ciclo IX', 9, [
                ['Práctica Administrativa I', 'PAV114', 10],
                ['Seminario sobre Problemas Educativos Organizacionales', 'SEO114', 6],
            ]],
            ['Ciclo X', 10, [
                ['Práctica Profesional de Administración y Gestión', 'PAG114', 10],
                ['Seminario de Graduación', 'SDG114', 6],
            ]],
        ]);

        $this->seedCareer(90, null, [
            ['Ciclo I', 1, [
                ['Matemática I', 'MAT113', 4],
                ['Química General', 'QUG113', 4],
                ['Biología General', 'BIG113', 4],
                ['Métodos y Técnicas de Investigación', 'MTI113', 4],
                ['Sociología Rural', 'SOR113', 4],
            ]],
            ['Ciclo II', 2, [
                ['Matemática II', 'MAT213', 4],
                ['Embriología e Histología', 'EMH113', 4],
                ['Química Analítica', 'QUA113', 4],
                ['Ecología y Ambiente', 'EAM113', 4],
                ['Propedéutica', 'PRO113', 4],
            ]],
            ['Ciclo III', 3, [
                ['Bioestadística', 'BIE113', 4],
                ['Microbiología Animal', 'MBA113', 4],
                ['Anatomía Animal I', 'ANA113', 4],
                ['Bioquímica', 'BIQ113', 4],
                ['Fisiología Animal I', 'FAN113', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Nutrición Animal', 'NUA113', 4],
                ['Laboratorio Clínico Veterinario', 'LCV113', 4],
                ['Inmunología y Virología Veterinaria', 'IVV113', 4],
                ['Anatomía Animal II', 'ANA213', 4],
                ['Fisiología Animal II', 'FAN213', 4],
            ]],
            ['Ciclo V', 5, [
                ['Patología Animal I', 'PAT113', 4],
                ['Parasitología Animal', 'PAR113', 4],
                ['Economía Pecuaria', 'ECP113', 4],
                ['Sistema de Producción Avícola', 'SPA113', 4],
                ['Farmacología y Terapéutica Veterinaria I', 'FTV113', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Inglés Técnico I', 'INT113', 2],
                ['Farmacología y Terapéutica Veterinaria II', 'FTV213', 4],
                ['Enfermedades Parasitarias', 'ENP113', 4],
                ['Patología Animal II', 'PAT213', 4],
                ['Cirugía Animal I', 'CIA113', 4],
                ['Especies Menores I', 'ESM113', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Inglés Técnico II', 'INT213', 2],
                ['Enfermedades Infecciosas I', 'ENI113', 4],
                ['Especies Menores II', 'ESM213', 4],
                ['Cirugía Animal II', 'CIA213', 4],
                ['Sistemas de Producción Ovino y Caprino', 'SPO113', 4],
                ['Diseño de Experimentos', 'DIE113', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Enfermedades Infecciosas II', 'ENI213', 4],
                ['Sistema de Producción Porcina', 'SPP113', 4],
                ['Reproducción y Mejoramiento Animal', 'RME113', 4],
                ['Producción y Conservación de Forrajes Tropicales', 'PCF113', 4],
                ['Administración y Planificación Pecuaria', 'APP113', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Clínica de Especies Menores', 'CEM113', 4],
                ['Ginecología y Obstetricia', 'GIO113', 4],
                ['Epidemiología', 'EPI113', 4],
                ['Sistema de Producción Acuícola', 'SAC113', 4],
                ['Sistema de Producción Bovino', 'SPB113', 4],
            ]],
            ['Ciclo X', 10, [
                ['Formulación y Gestión de Proyectos', 'FGP113', 4],
                ['Clínica de Especies Mayores', 'CME113', 4],
                ['Salud Pública Veterinaria', 'SPV113', 4],
                ['Tecnologías, Inspecciones e Inocuidad de Productos Pecuarios', 'TIP113', 4],
                ['Investigación Dirigida', 'IND113', 2],
                ['Manejo y Clínica de Equinos', 'MCE113', 4],
            ]],
        ]);

        $this->seedCareer(37, 'Doctorado en Cirugía Dental', [
            ['Primer año - Ciclo I', 1, [
                ['Estomatología I', 'EST117', 5],
                ['Morfofunción I', 'MPF117', 5],
                ['Patología I', 'PAT117', 3],
                ['Tratamientos I', 'TTA117', 4],
            ]],
            ['Primer año - Ciclo II', 2, [
                ['Estomatología II', 'EST217', 3],
                ['Morfofunción II', 'MPF217', 6],
                ['Patología II', 'PAT217', 4],
                ['Tratamientos II', 'TTA217', 4],
            ]],
            ['Segundo año - Ciclo III', 3, [
                ['Estomatología III', 'EST317', null],
                ['Morfofunción III', 'MPF317', null],
                ['Patología III', 'PAT317', null],
                ['Tratamientos III', 'TTA317', null],
            ]],
            ['Segundo año - Ciclo IV', 4, [
                ['Estomatología IV', 'EST417', null],
                ['Morfofunción IV', 'MPF417', null],
                ['Patología IV', 'PAT417', null],
                ['Tratamientos IV', 'TTA417', null],
            ]],
            ['Tercer año - Ciclo V', 5, [
                ['Estomatología V', 'EST517', null],
                ['Morfofunción V', 'MPF517', null],
                ['Patología V', 'PAT517', null],
                ['Tratamientos V', 'TTA517', null],
            ]],
            ['Tercer año - Ciclo VI', 6, [
                ['Estomatología VI', 'EST617', null],
                ['Morfofunción VI', 'MPF617', null],
                ['Patología VI', 'PAT617', null],
                ['Tratamientos VI', 'TTA617', null],
            ]],
            ['Cuarto año - Ciclo VII', 7, [
                ['Diagnóstico Preclínico', 'OPC117', null],
                ['Endodoncia Preclínica', 'EPC117', null],
                ['Clínica de Periodoncia I', 'CPR117', null],
                ['Odontopediatría I', 'ODI117', null],
                ['Ortopedia/Ortodoncia I', 'ORT117', null],
                ['Clínica de Operatoria II', 'COO217', null],
                ['Restaurativa Preclínica I', 'RPC117', null],
                ['Odontología Preventiva Comunitaria e Investigación III', 'OPC317', null],
            ]],
            ['Cuarto año - Ciclo VIII', 8, [
                ['Clínica de Diagnóstico I', 'CDD117', null],
                ['Clínica de Endodoncia I', 'CDE117', null],
                ['Clínica de Periodoncia II', 'CDP217', null],
                ['Cirugía Maxilofacial', 'CIM117', null],
                ['Odontopediatría II', 'ODI217', null],
                ['Ortopedia/Ortodoncia II', 'ORT217', null],
                ['Clínica de Restaurativa', 'CDR117', null],
                ['Restaurativa Preclínica II', 'RPC217', null],
                ['Odontología Preventiva Comunitaria e Investigación IV', 'OPC417', null],
            ]],
            ['Séptimo año', 13, [
                ['Clínica Integral del Paciente Adulto I', 'CPA117', null],
                ['Clínica Integral del Paciente Adulto II', 'CPA217', null],
                ['Clínica Integral de Odontología Infantil, Ortopedia y Ortodoncia I', 'CEI117', null],
                ['Clínica Integral de Odontología Infantil, Ortopedia y Ortodoncia II', 'CEI217', null],
                ['Investigación Epidemiológica Clínica I', 'IEC117', null],
                ['Investigación Epidemiológica Clínica II', 'IEC217', null],
                ['Investigación Epidemiológica Clínica III', 'IEC317', null],
                ['Práctica Disciplinar Profundizada', 'PDP117', null],
            ]],
        ]);

        $this->seedCareer(9, null, [
            ['Ciclo I', 1, [
                ['Psicología General I', 'PSG114', 4],
                ['Estadística Aplicada a la Psicología', 'EAP114', 2],
                ['Fundamentos de Psicología Fisiológica', 'FPF114', 4],
                ['Realidad Nacional', 'RNA114', 4],
                ['Filosofía General', 'FIG114', 4],
            ]],
            ['Ciclo II', 2, [
                ['Psicología General II', 'PSG214', 4],
                ['Metodología de la Investigación', 'MDI114', 4],
                ['Introducción a la Psicopatología', 'IPT114', 4],
                ['Psicología Social', 'PSO114', 4],
                ['Psicología de la Infancia y la Adolescencia', 'PIA114', 4],
            ]],
            ['Ciclo III', 3, [
                ['Psicología del Trabajo', 'PDT114', 4],
                ['Metodología de la Investigación Cualitativa', 'MCU114', 4],
                ['Psicopatología', 'PPA114', 6],
                ['Psicología de la Salud', 'PSL114', 4],
                ['Psicología de la Persona Adulta', 'PAU114', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Psicología Educativa y del Aprendizaje', 'PEP114', 4],
                ['Psicología Comunitaria', 'PMN114', 4],
                ['Psicopatología Social', 'PTG114', 4],
                ['Introducción a la Evaluación Psicológica', 'IEP114', 4],
                ['Introducción a la Psicología de la Personalidad', 'IPR114', 4],
            ]],
            ['Ciclo V', 5, [
                ['Psicología Clínica', 'PGC114', 4],
                ['Intervención Comunitaria', 'INC114', 4],
                ['Intervención en Psicopatología Social', 'IPO114', 4],
                ['Evaluación Psicológica', 'EPG114', 4],
                ['Personalidad Social e Individual', 'PSI114', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Evaluación y Tratamiento Psicológico Infantil', 'EPI114', 4],
                ['Psicología Jurídica y Forense', 'PJF114', 6],
                ['Psicoterapia Individual', 'PID114', 4],
                ['Psicología en Situación de Emergencia', 'PEM114', 4],
                ['Fundamentos Psicológicos de Atención a Personas con Discapacidad', 'FPD114', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Diagnóstico Psicopedagógico', 'DPP114', 4],
                ['Gestión y Desarrollo de Personal I', 'GDP114', 4],
                ['Psicoterapia Familiar y de Pareja I', 'PFP114', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Psicoterapia Grupal', 'PGP114', 4],
                ['Intervención Psicopedagógica', 'ISP114', 4],
                ['Gestión y Desarrollo de Personal II', 'GDP214', 4],
                ['Psicoterapia Familiar y de Pareja II', 'PFP214', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Prácticas Profesionales I', 'PPF114', 12],
            ]],
            ['Ciclo X', 10, [
                ['Prácticas Profesionales II', 'PPF214', 12],
                ['Seminario de Investigación', 'SDI114', 4],
            ]],
        ]);

        $this->seedCareer(39, null, [
            ['Ciclo I', 1, [
                ['Filosofía General', 'FIG114', 4],
                ['Sociología General', 'SOG114', 4],
                ['Expresión Oral y Escrita', 'EXI114', 4],
                ['Matemática', 'MTT114', 4],
                ['Antropología General', 'ANG114', 4],
            ]],
            ['Ciclo II', 2, [
                ['Introducción al Trabajo Social', 'ITS114', 4],
                ['Epistemología de las Ciencias Sociales', 'EPI114', 4],
                ['Lógica', 'LCA114', 4],
                ['Estadística Aplicada a las Ciencias Sociales', 'EAC114', 4],
                ['Salud Pública', 'SPU114', 4],
            ]],
            ['Ciclo III', 3, [
                ['Metodología de Trabajo Social I', 'MTB114', 4],
                ['Diagnóstico Comunitario y Recursos Institucionales', 'DSI114', 4],
                ['Psicología General', 'PGE114', 4],
                ['Demografía', 'DEM114', 4],
                ['Principios Generales de Economía', 'PRE114', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Metodología de Trabajo Social II', 'MTB214', 4],
                ['Promoción Humana y Métodos de Educación', 'PME114', 4],
                ['Desarrollo Humano', 'DHU114', 4],
                ['Metodología Operativa', 'MEO114', 4],
                ['Historia Social y Política de El Salvador', 'HSP114', 4],
            ]],
            ['Ciclo V', 5, [
                ['Ética Profesional', 'ETP114', 4],
                ['Gestión del Desarrollo Comunitario, Local, Regional y Nacional', 'GDC114', 4],
                ['Psicología Social', 'PLG114', 4],
                ['Investigación Cuantitativa', 'ICN114', 4],
                ['Planificación Social y Económica', 'PSN114', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Familia y Sociedad', 'FYS114', 4],
                ['Gerencia Social', 'GSO114', 4],
                ['Psicopatología', 'PCP114', 4],
                ['Investigación Cualitativa', 'ICL114', 4],
                ['Formulación de Proyectos Sociales', 'FPY114', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Métodos de Intervención con Familia y Grupos', 'MFG114', 4],
                ['Política Social', 'POS114', 4],
                ['Legislación Social I', 'LSO114', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Práctica Formativa', 'PFO114', 8],
                ['Legislación Social II', 'LSO214', 4],
                ['Gestión, Monitoreo y Evaluación de Proyectos Sociales', 'GPS114', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Práctica Profesional I', 'PPF114', 8],
                ['Movimientos Sociales', 'MSS114', 4],
            ]],
            ['Ciclo X', 10, [
                ['Práctica Profesional II', 'PPF214', 8],
                ['Seminario de la Realidad Nacional', 'SRN114', 4],
            ]],
        ]);

        // UCA
        $this->seedCareer(16, 'Licenciatura en Comunicación Social (itinerario Periodismo, narrativas y multimedia)', [
            ['Ciclo I', 1, [
                ['Herramientas de Recolección de Datos', '110323', 4],
                ['Lectura y Redacción Básica', '110324', 4],
                ['Lenguaje en Producción Audiovisual', '110378', 4],
                ['Introducción a las Humanidades Digitales', '110326', 4],
            ]],
            ['Ciclo II', 2, [
                ['Comunicación Aplicada a la Organización', '110366', 4],
                ['Introducción al Periodismo', '110328', 4],
                ['Guion Audiovisual Multimedia', '110330', 4],
                ['Historia de la Producción Audiovisual', '110379', 4],
            ]],
            ['Ciclo III', 3, [
                ['Redacción Avanzada', '110380', 4],
                ['Dramática', '110057', 4],
                ['Equipos de Producción Audiovisual Multimedia', '110331', 4],
                ['Diseño, Diagramación y Pensamiento Crítico', '110381', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Investigación Periodística', '110339', 4],
                ['Locución y Conducción Audiovisual', '110335', 4],
                ['Historia de El Salvador', '100378', 4],
                ['Introducción a la Programación Multimedia', '110332', 4],
            ]],
            ['Ciclo V', 5, [
                ['Ética de la Comunicación', '100134', 4],
                ['Postproducción Multimedia', '110334', 4],
                ['Multimedia Interactiva', '110336', 4],
                ['Marketing de Proyectos Multimedia', '110333', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Diseño y Formulación de Proyectos', '110383', 4],
                ['Análisis e Interpretación de Datos Estadísticos', '110338', 4],
                ['Introducción al Lenguaje', '110184', 4],
                ['Optativa Humanístico-Social', null, 4],
            ]],
            ['Ciclo VII', 7, [
                ['Estudios de Recepción y Audiencias', '110337', 4],
                ['Investigación Social para Comunicadores', '110342', 4],
                ['Teorías de Comunicación y Cultura', '110340', 4],
                ['Optativa Humanístico-Social', null, 3],
            ]],
            ['Ciclo VIII', 8, [
                ['Comunicación Estratégica', '110382', 4],
                ['Lógica y Retórica', '110341', 4],
                ['Semiótica de la Comunicación', '110384', 4],
                ['Optativa Humanístico-Social', null, 3],
            ]],
            ['Ciclo IX (itinerario Periodismo)', 9, [
                ['Periodismo de Datos y Visualización', '110346', 4],
                ['Fotografía Periodística', '110347', 4],
                ['Narrativas y Formatos de los Nuevos Media', '110348', 4],
                ['Narrativas y Técnicas del Periodismo Radiofónico', '110349', 4],
                ['Optativa Técnica', null, 4],
            ]],
            ['Ciclo X (itinerario Periodismo)', 10, [
                ['Taller de Periodismo Multimedia', '110355', 4],
                ['Taller de Reportaje y Crónica', '110356', 4],
                ['Taller de Notas y Entrevistas', '110357', 4],
                ['Taller de Periodismo en Radio y Televisión', '110358', 4],
                ['Optativa Técnica', null, 4],
            ]],
        ]);

        $this->seedCareer(42, 'Licenciatura en Contaduría Pública (semipresencial)', [
            ['Ciclo I', 1, [
                ['Fundamentos de Administración', '020326', 3],
                ['Principios de Contabilidad', '270060', 4],
                ['Introducción a la Economía I', '060115', 4],
                ['Principios de Matemática', '010179', 4],
            ]],
            ['Ciclo II', 2, [
                ['Electiva Humanístico-Social I', null, 4],
                ['Contabilidad Financiera', '270072', 4],
                ['Introducción a la Economía II', '060116', 4],
                ['Matemática I', '010108', 5],
            ]],
            ['Ciclo III', 3, [
                ['Introducción a Sistemas Informáticos', '270066', 4],
                ['Contabilidad de Activos', '270098', 4],
                ['Macroeconomía I', '060173', 4],
                ['Matemática II', '010109', 5],
                ['Electiva Humanístico-Social II', null, 4],
            ]],
            ['Ciclo IV', 4, [
                ['Contabilidad de Sociedades', '270096', 3],
                ['Contabilidad de Pasivo y Patrimonio', '270097', 5],
                ['Microeconomía I', '060172', 4],
                ['Cálculo Financiero', '010188', 4],
                ['Ética Profesional', '100203', 3],
            ]],
            ['Ciclo V', 5, [
                ['Gestión de Costos y Presupuestos', '270074', 4],
                ['Contabilidad Bancaria', '270100', 5],
                ['Fundamentos de Análisis Financiero', '270076', 4],
                ['Estadística Aplicada', '010191', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Gestión de Operaciones', '250076', 4],
                ['Contabilidad de Seguros', '270101', 5],
                ['Gestión Financiera a Corto Plazo', '270087', 4],
                ['Planeación de Auditoría Financiera', '270102', 5],
            ]],
            ['Ciclo VII', 7, [
                ['Electiva Humanístico-Social III', null, 4],
                ['Información Financiera de Grupos Económicos', '270103', 5],
                ['Gestión Financiera a Largo Plazo', '270088', 4],
                ['Ejecución de Auditoría Financiera', '270104', 5],
            ]],
            ['Ciclo VIII', 8, [
                ['Contabilidad Gubernamental', '270105', 5],
                ['Contabilidad y Gestión de Impuestos', '270099', 5],
                ['Formulación y Evaluación de Proyectos', '020355', 5],
                ['Informes de Auditoría Financiera', '270106', 5],
            ]],
            ['Ciclo IX', 9, [
                ['Electiva Humanístico-Social IV', null, 4],
                ['Investigación Contable', '270107', 5],
                ['Inteligencia de Negocios', '270085', 5],
                ['Gobierno Corporativo y Cumplimiento', '270108', 5],
            ]],
        ]);

        $this->seedCareer(11, 'Técnico en Desarrollo de Software (no presencial)', [
            ['Ciclo I', 1, [
                ['Administración de Sistemas Operativos', '190185', 4],
                ['Redes', '190186', 4],
                ['Fundamentos de Programación', '190187', 4],
                ['Matemática Discreta', '010215', 4],
            ]],
            ['Ciclo II', 2, [
                ['Administración de Bases de Datos', '190188', 4],
                ['Programación Orientada a Objetos', '190189', 4],
                ['Programación Web (orientada al usuario)', '190190', 4],
                ['Desarrollo Colaborativo', '190191', 4],
            ]],
            ['Ciclo III', 3, [
                ['Administración de Servicios', '190192', 4],
                ['Optativa Humanístico-Social', null, 4],
                ['Programación Web (orientada al servidor)', '190193', 4],
                ['Internet de las Cosas', '190194', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Administración de Servicio en la Nube', '190195', 4],
                ['Inteligencia de Negocios', '190196', 4],
                ['Programación para Dispositivos Móviles', '190197', 4],
                ['Ética para Ingeniería', '100404', 4],
            ]],
        ]);

        $this->seedCareer(41, null, [
            ['Ciclo I', 1, [
                ['Precálculo', '010180', 4],
                ['Elementos para el Estudio de la Ciencia y la Tecnología', '200087', 4],
                ['Comunicación Gráfica para el Diseño en Ingeniería', '220132', 4],
                ['Optativa Humanístico-Social I', null, 4],
            ]],
            ['Ciclo II', 2, [
                ['Cálculo I', '010181', 4],
                ['Álgebra Vectorial y Matrices', '010112', 4],
                ['Química General', '260061', 5],
                ['Optativa Humanístico-Social II', null, 4],
            ]],
            ['Ciclo III', 3, [
                ['Cálculo II', '010182', 4],
                ['Física I', '200068', 5],
                ['Ingeniería Geológica', '200076', 3],
                ['Estética', '210017', 3],
                ['Programación y Métodos Numéricos', '190146', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Cálculo III', '010183', 4],
                ['Física II', '200069', 5],
                ['Ecuaciones Diferenciales', '010184', 4],
                ['Mecánica de Materiales', '210055', 4],
                ['Optativa Humanístico-Social III', null, 4],
            ]],
            ['Ciclo V', 5, [
                ['Mecánica de Fluidos', '200053', 4],
                ['Análisis Estructural I', '210114', 3],
                ['Materiales de Construcción', '210057', 4],
                ['Dinámica', '210013', 3],
                ['Probabilidad y Estadística', '010118', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Ingeniería Ambiental', '260024', 5],
                ['Análisis Estructural II', '210115', 3],
                ['Ingeniería de Construcción I', '210112', 4],
                ['Ingeniería Geotécnica', '210060', 5],
                ['Topografía', '210029', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Hidrología', '200075', 4],
                ['Estructuras de Acero', '210130', 4],
                ['Ingeniería en Construcción II', '210113', 4],
                ['Estructuras Geotécnicas', '210062', 4],
                ['Optativa Humanístico-Social IV', null, 3],
            ]],
            ['Ciclo VIII', 8, [
                ['Acueductos y Alcantarillados', '200055', 3],
                ['Concreto Reforzado', '210116', 3],
                ['Ingeniería de Transporte', '210095', 3],
                ['Electricidad y Magnetismo', '200084', 5],
            ]],
            ['Ciclo IX', 9, [
                ['Análisis Dinámico de Estructuras', '210097', 3],
                ['Concreto Estructural', '210117', 3],
                ['Obras de Transporte', '210119', 4],
                ['Paredes Estructurales', '210118', 4],
            ]],
            ['Ciclo X', 10, [
                ['Optativa Técnica I', null, 4],
                ['Optativa Técnica II', null, 3],
                ['Formulación, Evaluación y Gestión de Proyectos de Construcción', '250044', 3],
                ['Optativa Humanístico-Social V', null, 4],
            ]],
        ]);

        $this->seedCareer(13, null, [
            ['Ciclo I', 1, [
                ['Precálculo', '010180', 4],
                ['Elementos para el Estudio de la Ciencia y la Tecnología', '200087', 4],
                ['Química General', '260061', 5],
                ['Comunicación Gráfica para el Diseño en Ingeniería', '220132', 4],
            ]],
            ['Ciclo II', 2, [
                ['Álgebra Vectorial y Matrices', '010112', 4],
                ['Cálculo I', '010181', 4],
                ['Ciencia de los Materiales', '210031', 3],
                ['Optativa Humanístico-Social I', null, 4],
            ]],
            ['Ciclo III', 3, [
                ['Física I', '200068', 5],
                ['Cálculo II', '010182', 4],
                ['Optativa Humanístico-Social II', null, 4],
                ['Estética', '210017', 3],
            ]],
            ['Ciclo IV', 4, [
                ['Física II', '200069', 5],
                ['Cálculo III', '010183', 4],
                ['Introducción a la Ingeniería Industrial', '250045', 4],
                ['Optativa Humanístico-Social III', null, 4],
            ]],
            ['Ciclo V', 5, [
                ['Programación y Métodos Numéricos', '190146', 4],
                ['Electricidad y Magnetismo', '200084', 5],
                ['Ecuaciones Diferenciales', '010184', 4],
                ['Estadística y Probabilidad', '010176', 4],
                ['Mecánica de Materiales I', '210066', 4],
                ['Dinámica', '210013', 3],
            ]],
            ['Ciclo VI', 6, [
                ['Termodinámica I', '200027', 4],
                ['Investigación de Operaciones I', '250007', 3],
                ['Estadística Inferencial', '010177', 4],
                ['Ingeniería de Manufactura', '210099', 3],
                ['Optativa Humanístico-Social IV', null, 3],
            ]],
            ['Ciclo VII', 7, [
                ['Mecánica de Fluidos I', '200019', 4],
                ['Investigación de Operaciones II', '250009', 3],
                ['Administración y Control de Calidad', '250008', 4],
                ['Ingeniería de Métodos', '250010', 4],
                ['Optativa Humanístico-Social V', null, 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Sistemas de Gestión de la Información', '250016', 4],
                ['Diseño y Análisis de Experimentos', '250012', 4],
                ['Planeación y Control de Operaciones', '250013', 4],
                ['Ingeniería Económica', '250022', 3],
                ['Optativa Técnica I', null, 4],
            ]],
            ['Ciclo IX', 9, [
                ['Simulación', '250051', 4],
                ['Planeación de Instalaciones', '250052', 4],
                ['Contabilidad y Finanzas', '270024', 4],
                ['Optativa Técnica II', null, 4],
            ]],
            ['Ciclo X', 10, [
                ['Gestión de Proyectos', '250018', 4],
                ['Gestión de la Cadena de Suministro y Logística', '250053', 4],
                ['Formulación y Evaluación de Proyectos', '250020', 4],
                ['Optativa Técnica III', null, 4],
            ]],
        ]);

        $this->seedCareer(15, null, [
            ['Ciclo I', 1, [
                ['Introducción a la Psicología', '090149', 4],
                ['Técnicas de Redacción', '110136', 4],
                ['Historia Contemporánea', '100284', 4],
                ['Realidad Nacional', '050208', 4],
            ]],
            ['Ciclo II', 2, [
                ['Procesos Psicológicos Básicos', '090271', 4],
                ['Teorías y Sistemas Psicológicos', '090221', 4],
                ['Bases Biológicas del Comportamiento I', '090222', 4],
                ['Métodos Estadísticos para las Ciencias Sociales', '010145', 5],
            ]],
            ['Ciclo III', 3, [
                ['Psicología del Desarrollo I', '090150', 4],
                ['Psicometría', '090154', 4],
                ['Bases Biológicas del Comportamiento II', '090223', 5],
                ['Métodos y Técnicas Cualitativas de Investigación', '090310', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Psicología del Desarrollo II', '090157', 4],
                ['Teorías de la Personalidad', '090152', 4],
                ['Optativa', null, 3],
                ['Métodos y Técnicas Cuantitativas de Investigación', '090309', 5],
            ]],
            ['Ciclo V', 5, [
                ['Ética en Psicología', '090320', 4],
                ['Psicología del Aprendizaje', '090215', 4],
                ['Psicología del Trabajo', '090163', 4],
                ['Psicología Social I', '090161', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Psicología del Comportamiento Anormal I', '090165', 4],
                ['Métodos de Evaluación I', '090156', 4],
                ['Optativa', null, 3],
                ['Psicología Social II', '090164', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Psicología del Comportamiento Anormal II', '090167', 4],
                ['Métodos de Evaluación II', '090162', 4],
                ['Psicología Aplicada a la Empresa', '090168', 4],
                ['Psicología Comunitaria', '090321', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Tratamiento Psicológico', '090225', 4],
                ['Psicología Educativa', '090166', 4],
                ['Psicología Organizacional', '090172', 4],
                ['Diseño y Evaluación de Intervenciones Sociales', '090311', 5],
            ]],
            ['Ciclo IX', 9, [
                ['Tratamiento Psicológico en la Niñez y Adolescencia', '090273', 4],
                ['Evaluación Psicoeducativa', '090170', 4],
                ['Orientación Profesional', '090177', 3],
                ['Optativa', null, 3],
            ]],
            ['Ciclo X', 10, [
                ['Tratamiento Psicológico en la Adultez y Vejez', '090274', 5],
                ['Prácticas Educativas', '090176', 5],
                ['Gestión Estratégica de las Relaciones Laborales', '020353', 5],
                ['Optativa', null, 3],
            ]],
        ]);

        // UDB
        $this->seedCareer(25, 'Licenciatura en Diseño Gráfico', [
            ['Ciclo I', 1, [
                ['Antropología Filosófica', 'ANF231', 3],
                ['Pensamiento Social Cristiano', 'PSC231', 3],
                ['Expresión Oral y Escrita', 'EOE295', 3],
                ['Investigación, Creatividad e Innovación', 'ICI295', 4],
                ['Sistema del Lenguaje Visual', 'SLV295', 4],
            ]],
            ['Ciclo II', 2, [
                ['Preproducción Multimedia', 'PMU295', 4],
                ['Edición Digital de Gráficos', 'EDG295', 4],
                ['Técnicas de Redacción', 'TER295', 4],
                ['Técnicas Fotográficas', 'TEF295', 4],
                ['Técnicas de Composición Visual', 'TCV295', 4],
            ]],
            ['Ciclo III', 3, [
                ['Dibujo Técnico para la Comunicación Gráfica', 'DTC295', 4],
                ['Ilustración Aplicada al Diseño', 'IAD295', 4],
                ['Diseño de Contenidos Multimedia', 'DDM295', 4],
                ['Costos y Presupuestos de Negocios de Diseño', 'CPN295', 4],
                ['Tipografía', 'TIP295', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Diseño Tridimensional', 'DTR295', 4],
                ['Animación Digital', 'ANI295', 4],
                ['Creatividad Publicitaria', 'CPU295', 4],
                ['Investigación de Mercados', 'INM295', 4],
                ['Publicación de Productos Multimedia', 'PPM295', 4],
            ]],
            ['Ciclo V', 5, [
                ['Innovación Emprendedora', 'INE295', 4],
                ['Diseño y Estrategia de Marca', 'DEM295', 4],
                ['Marketing', 'MAR295', 4],
                ['Electiva I', null, 4],
            ]],
            ['Ciclo VI', 6, [
                ['Gestión Cooperativa de Proyectos', 'GDP295', 4],
                ['Estrategias de Publicidad y Medios', 'EPM295', 4],
                ['Estrategias de Marketing Digital', 'EMD295', 4],
                ['Electiva II', null, 4],
            ]],
            ['Ciclo VII', 7, [
                ['Modelado 3D Análogo y Digital', 'MAD295', 4],
                ['Investigación de Experiencia de Usuario', 'IEU295', 4],
                ['Diseño, Desarrollo y Estrategia de Empaques y Envases', 'DDE295', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Animación 2D y 3D', 'AND295', 4],
                ['Interpretación Visual de la Información', 'IVI295', 4],
                ['Lógica de Programación', 'LDP295', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Diseño de Productos Audiovisuales', 'DAU295', 4],
                ['Diseño Web Móvil', 'DWM295', 4],
                ['Ética y Propiedad Intelectual', 'EPI295', 4],
            ]],
            ['Ciclo X', 10, [
                ['Proyecto Integrador', 'PRI295', 8],
                ['Estrategias de Promoción Profesional', 'EPP295', 8],
            ]],
        ]);

        $this->seedCareer(94, null, [
            ['Ciclo I', 1, [
                ['Antropología Filosófica', 'ANF231', 3],
                ['Álgebra Vectorial y Matrices', 'ALG501', 4],
                ['Química General', 'QUG501', 4],
            ]],
            ['Ciclo II', 2, [
                ['Pensamiento Social Cristiano', 'PSC231', 3],
                ['Cálculo Diferencial', 'CAD501', 4],
                ['Aplicaciones Electrónicas Básicas', 'AEB101', 4],
                ['Aplicaciones de Dibujo Industrial y Sistemas CAD', 'DIS103', 3],
            ]],
            ['Ciclo III', 3, [
                ['Gestión Ambiental', 'GEA106', 4],
                ['Cálculo Integral', 'CAI501', 4],
                ['Cinemática y Dinámica de las Partículas', 'CDP501', 4],
                ['Análisis de Producción y Manufactura', 'ADP103', 4],
            ]],
            ['Ciclo IV', 4, [
                ['Cálculo de Varias Variables', 'CVV501', 4],
                ['Estadística Aplicada', 'ESA501', 4],
                ['Oscilaciones, Fluidos y Calor', 'OFC501', 4],
                ['Equilibrio de los Cuerpos Rígidos', 'ECR501', 4],
                ['Mecanizado y Planificación de Procesos', 'MYP103', 4],
            ]],
            ['Ciclo V', 5, [
                ['Análisis y Evaluación Económica', 'AEE106', 4],
                ['Cálculo Avanzado', 'CAA501', 4],
                ['Ecuaciones Diferenciales', 'EDI501', 4],
                ['Electricidad y Magnetismo', 'EYM501', 4],
                ['Cinética de Mecanismos', 'CIM103', 4],
            ]],
            ['Ciclo VI', 6, [
                ['Análisis de Circuitos Eléctricos', 'ACE102', 4],
                ['Dirección de Proyectos', 'DDP106', 4],
                ['Mecánica de los Fluidos', 'MEF501', 4],
                ['Termodinámica Aplicada', 'TEA501', 4],
                ['Mecánica de Materiales', 'MDM103', 4],
            ]],
            ['Ciclo VII', 7, [
                ['Aplicaciones de Autómatas Programables', 'AAP101', 4],
                ['Análisis de las Máquinas de Fluido Incompresible', 'AFI103', 4],
                ['Análisis de Transferencia de Calor', 'ANT103', 4],
                ['Diseño de Elementos de Máquinas y CAE', 'DEM103', 4],
                ['Ciencia e Ingeniería de Materiales', 'CEM103', 4],
            ]],
            ['Ciclo VIII', 8, [
                ['Aplicaciones con Motores de Combustión Interna', 'MCI103', 5],
                ['Desarrollo de Aplicaciones Térmicas', 'DET103', 4],
                ['Diseño y Modelado de Transmisiones', 'MDT103', 4],
            ]],
            ['Ciclo IX', 9, [
                ['Aplicaciones con Redes de Comunicación Industrial y Uso de los SCADA', 'RCI101', 4],
                ['Aplicaciones de Sistemas de Control Hidráulico y Neumático', 'SCH103', 4],
                ['Manufactura Integrada por Computadora y Sistemas CAD CAM', 'MCC103', 5],
            ]],
            ['Ciclo X', 10, [
                ['Análisis Dinámico de Maquinaria', 'DDM103', 5],
                ['Electiva', null, 4],
                ['Gestión y Mantenimiento de Equipos y Plantas Industriales', 'MPE103', 4],
            ]],
        ]);
    }

    /**
     * @param  array<int, array{0: string, 1: int|null, 2: array<int, array{0: string, 1: string|null, 2: int|null}>}>  $cycles
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
