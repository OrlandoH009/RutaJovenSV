# RutaJovenSV

Plataforma web de orientación vocacional para jóvenes de El Salvador: ayuda a un estudiante a descubrir sus intereses, recibir recomendaciones de carreras afines, explorar instituciones donde estudiarlas y planificar su ruta académica.

## Tabla de contenidos

1. [Descripción del sistema](#descripción-del-sistema)
2. [Stack tecnológico](#stack-tecnológico)
3. [Arquitectura y estructura de carpetas](#arquitectura-y-estructura-de-carpetas)
4. [Modelo de dominio](#modelo-de-dominio)
5. [Módulos funcionales](#módulos-funcionales)
6. [Roles y autorización](#roles-y-autorización)
7. [Instalación y configuración](#instalación-y-configuración)
8. [Comandos de desarrollo](#comandos-de-desarrollo)
9. [Pruebas](#pruebas)
10. [Despliegue](#despliegue)
11. [Convenciones y cómo modificar el sistema](#convenciones-y-cómo-modificar-el-sistema)
12. [Licencia](#licencia)

## Descripción del sistema

El flujo típico de un estudiante es:

```
Responde el cuestionario → se calcula su perfil de intereses → recibe
carreras recomendadas → explora instituciones que las ofrecen → guarda
favoritos, compara opciones, simula costos → construye su ruta académica
```

Un administrador mantiene el catálogo base (áreas académicas, carreras, instituciones y preguntas del cuestionario) y gestiona los usuarios del sistema.

## Stack tecnológico

| Capa          | Tecnología                                                                 |
|---------------|------------------------------------------------------------------------------|
| Backend       | PHP ^8.3, Laravel ^13.17                                                     |
| Autenticación | Laravel Breeze ^2.4 (scaffolding de login/registro/verificación/reset)      |
| Autorización  | Spatie Laravel Permission ^8.3 (roles `student` / `admin`)                   |
| Base de datos | SQLite por defecto (`DB_CONNECTION=sqlite` en `.env`), vía Eloquent ORM      |
| Frontend      | Blade + Tailwind CSS ^3.1 + Alpine.js ^3.4 + GSAP ^3.15 (ScrollTrigger)      |
| Build         | Vite ^8 + `laravel-vite-plugin`                                              |
| Testing       | PHPUnit ^12.5 (no Pest), Mockery, Faker                                     |
| Calidad       | Laravel Pint ^1.27 (formateo PSR-12)                                        |
| Despliegue    | Laravel Cloud (ver [Despliegue](#despliegue))                               |

## Arquitectura y estructura de carpetas

La aplicación está organizada **por audiencia** (público / estudiante / administrador), no solo por tipo de archivo. Esto se refleja en los controladores y en las vistas:

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Public/       # Catálogo abierto (sin login): carreras, instituciones, búsqueda
│   │   ├── Student/      # Área autenticada: cuestionario, perfil, ruta, favoritos, simulador
│   │   ├── Admin/        # Panel de administración (requiere rol admin)
│   │   ├── Auth/         # Login / registro / verificación / reset (Breeze)
│   │   └── ProfileController.php
│   └── Middleware/
│       └── EnsureUserIsAdmin.php   # alias de ruta: "admin"
├── Models/                # AcademicArea, Career, Institution, Question, User, InterestProfile, AcademicRoute, ...
└── Services/
    ├── InterestProfileService.php   # calcula el perfil de intereses de un usuario
    └── RecommendationService.php    # rankea carreras según afinidad con ese perfil

config/
├── interests.php     # los 9 ejes de interés usados por el cuestionario y el algoritmo
└── el_salvador.php   # catálogo de departamentos/municipios (selectores de ubicación)

database/
├── migrations/        # evolución del esquema
└── seeders/            # el catálogo (carreras, instituciones, preguntas) vive aquí, no se crea a mano

resources/views/
├── admin/              # areas, careers, institutions, questions, users
├── careers/, institutions/, compare/, search/   # catálogo público
├── questionnaire/, interest-profile/, my-route/, cost-simulator/   # área del estudiante
├── auth/, profile/     # autenticación y cuenta
├── layouts/, components/   # layout base (Breeze) y componentes reutilizables

routes/
├── web.php             # rutas públicas, de estudiante y de administración
└── auth.php            # rutas de autenticación (Breeze)
```

## Modelo de dominio

Relaciones principales entre los modelos de `app/Models`:

```
AcademicArea 1───N Career
Career       N───N Institution      (tabla pivote institution_careers: modalidad, requisitos, costo)
Career       1───N CareerInterestWeight   (peso de la carrera en cada eje de interés)
Question     1───N QuestionOption          (opciones ordenadas; cada opción aporta peso a ejes de interés)
User         1───1 InterestProfile         (scores 0–100 por eje, calculado por InterestProfileService)
User         1───N UserAnswer               (respuestas al cuestionario)
User         1───1 AcademicRoute → 1───N AcademicRouteItem   (plan de estudio del estudiante)
User         1───N SavedCareer, SavedInstitution   (favoritos)
```

Los **9 ejes de interés** (tecnología, matemáticas, creatividad, ciencia, negocios, salud, comunicación, educación, social) están definidos en [`config/interests.php`](config/interests.php) y son el vocabulario común entre `QuestionOption` (lo que mide el cuestionario) y `CareerInterestWeight` (lo que necesita cada carrera). `RecommendationService` compara el perfil del usuario contra esos pesos para rankear carreras.

## Módulos funcionales

### Catálogo público (sin autenticación)

| Ruta                          | Controlador                              | Vista                      |
|--------------------------------|-------------------------------------------|-----------------------------|
| `GET /`                        | `Public\HomeController@index`             | `home` (vía `layouts`)      |
| `GET /carreras`                 | `Public\CareerController@index`            | `careers/index`             |
| `GET /carreras/{career:slug}`   | `Public\CareerController@show`             | `careers/show`              |
| `GET /instituciones`            | `Public\InstitutionController@index`      | `institutions/index`        |
| `GET /instituciones/{institution:slug}` | `Public\InstitutionController@show` | `institutions/show`         |
| `GET /buscar`                   | `Public\SearchController@index`            | `search/index`              |
| `GET /comparador`               | `Student\CompareController@index`          | `compare/index`             |

> Nota: `CompareController` vive en el namespace `Student\` aunque su ruta no exige login — es una decisión existente del código, no un error de este documento.

### Panel del estudiante (requiere `auth`)

| Ruta                                | Controlador                                     | Vista                        |
|---------------------------------------|---------------------------------------------------|-------------------------------|
| `GET /dashboard`                      | `Student\DashboardController@index`               | `dashboard`                   |
| `GET/POST /cuestionario`              | `Student\QuestionnaireController@show/@store`     | `questionnaire/*`             |
| `GET /perfil-intereses`               | `Student\InterestProfileController@show`          | `interest-profile/*`          |
| `POST /favoritos/carreras/{career}`   | `Student\FavoriteController@toggleCareer`         | —                              |
| `POST /favoritos/instituciones/{institution}` | `Student\FavoriteController@toggleInstitution` | —                      |
| `GET/PUT /mi-ruta`, `POST/DELETE /mi-ruta/items/*` | `Student\AcademicRouteController`     | `my-route/*`                   |
| `GET/POST /simulador-costos`          | `Student\CostSimulatorController@show/@calculate` | `cost-simulator/*`            |
| `GET/PATCH/DELETE /profile`           | `ProfileController`                               | `profile/*`                    |

### Panel de administración (requiere `auth` + rol `admin`, prefijo `/admin`)

| Ruta                                  | Controlador                                  | Vista               |
|------------------------------------------|------------------------------------------------|----------------------|
| `GET /admin`                              | `Admin\AdminDashboardController@index`         | `admin/dashboard`    |
| `/admin/areas` (resource, sin `show`)     | `Admin\AcademicAreaController`                 | `admin/areas/*`      |
| `/admin/careers` (resource, sin `show`)   | `Admin\CareerController`                       | `admin/careers/*`    |
| `/admin/institutions` (resource, sin `show`) + add/remove carrera | `Admin\InstitutionController` | `admin/institutions/*` |
| `/admin/questions` (resource, sin `show`) + add/remove opción | `Admin\QuestionController`      | `admin/questions/*`  |
| `GET /admin/users`, `PATCH /admin/users/{user}/role` | `Admin\UserController`          | `admin/users/*`      |

## Roles y autorización

- Roles gestionados con **Spatie Laravel Permission** (`config/permission.php`): `student` y `admin`, creados por `database/seeders/RoleSeeder.php`.
- El acceso al panel de administración se controla con el middleware `App\Http\Middleware\EnsureUserIsAdmin` (alias de ruta `admin`), que verifica `->hasRole('admin')` y responde `403` si no corresponde.
- **No existen Policies** en este proyecto — toda la autorización es a nivel de middleware/ruta. Si se necesita autorización más fina (p. ej. "un estudiante solo puede editar su propia ruta académica"), usar [Gates o Policies de Laravel](https://laravel.com/docs/authorization) en vez de extender este middleware.

## Instalación y configuración

Requisitos: PHP 8.3+, Composer, Node.js + npm.

**Opción rápida** (instala dependencias, copia `.env`, genera la key, migra el esquema e instala/compila los assets — **no siembra datos**, ver nota abajo):

```bash
composer run setup
```

**Paso a paso**, si prefieres controlarlo manualmente:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
```

> **Hay que sembrar la base de datos siempre, con `--seed` o `php artisan db:seed` aparte** (incluso después de `composer run setup`, que solo corre `migrate --force` sin `--seed`). El catálogo de áreas académicas, carreras, instituciones y preguntas del cuestionario no se crea desde la interfaz: vive en `database/seeders/` (`AcademicAreaSeeder`, `CareerSeeder`, `InstitutionSeeder`, `QuestionSeeder`, además de `RoleSeeder` y `AdminUserSeeder`). Sin sembrar, la app arranca vacía y el cuestionario/catálogo no tendrán datos.

Por defecto la app usa **SQLite** (`DB_CONNECTION=sqlite` en `.env`). Para usar MySQL/PostgreSQL, ajusta las variables `DB_*` en `.env` antes de migrar.

## Comandos de desarrollo

| Comando                     | Qué hace                                                                 |
|------------------------------|---------------------------------------------------------------------------|
| `composer run dev`           | Levanta servidor, cola y Vite en paralelo (orquestado por `php artisan dev`) |
| `npm run dev`                 | Solo el servidor de desarrollo de Vite (hot reload de assets)            |
| `npm run build`                | Compila los assets para producción                                       |
| `composer run test` / `php artisan test` | Limpia config de prueba y corre la suite de PHPUnit            |
| `vendor/bin/pint`              | Formatea el código PHP según las convenciones del proyecto (PSR-12)      |

## Pruebas

Suite en PHPUnit (`tests/`), no Pest:

- **`tests/Feature/Auth/*`**: flujos de Breeze (login, registro, verificación de correo, reseteo/actualización de contraseña).
- **`tests/Feature/ProfileTest.php`**, **`AdminAccessTest.php`**: edición de perfil y control de acceso al panel admin.
- **`tests/Unit/InterestProfileServiceTest.php`**, **`RecommendationServiceTest.php`**: cubren la lógica de negocio central (cálculo de perfil y recomendación de carreras).

**Huecos conocidos** (útiles si vas a extender la suite): no hay tests de los controladores CRUD de `Admin\*` (áreas, carreras, instituciones, preguntas) ni del catálogo público (`Public\CareerController`, `InstitutionController`, `SearchController`, `CompareController`).

## Despliegue

El objetivo de despliegue es **Laravel Cloud** (`boost.json` tiene `"cloud": true`). El repositorio incluye la skill `.claude/skills/deploying-to-cloud/` con el checklist y los comandos de la CLI de Cloud para crear entornos, bases de datos y variables de entorno.

## Convenciones y cómo modificar el sistema

Antes de escribir código nuevo, revisa las guías ya instaladas en el repo en vez de reinventar convenciones:

- [`AGENTS.md`](AGENTS.md) — convenciones generales del proyecto para agentes de IA (Laravel Boost): comandos `artisan make:*`, formateo con Pint, reglas de testing obligatorias.
- `.claude/skills/laravel-best-practices/` — arquitectura, Eloquent, validación, colas, seguridad, etc.
- `.claude/skills/testing-best-practices/` — cómo nombrar y estructurar tests nuevos.
- `.claude/skills/tailwindcss-development/` — convenciones de utilidades Tailwind usadas en las vistas Blade.

Reglas propias de este proyecto a tener en cuenta:

1. **El catálogo es código, no datos de producción editados a mano.** Si agregas o corriges una carrera, institución o pregunta, hazlo en el seeder correspondiente (`database/seeders/`) y vuelve a sembrar — así el catálogo queda versionado y reproducible en cualquier entorno.
2. **Los ejes de interés son un contrato compartido.** Si agregas un eje nuevo en `config/interests.php`, debes actualizar también los pesos (`CareerInterestWeight`) y las opciones del cuestionario (`QuestionOption`) que lo usan, o el algoritmo de `RecommendationService` quedará con datos incompletos para ese eje.
3. **Autorización nueva va en Gates/Policies, no en el middleware `admin`.** Ese middleware solo distingue estudiante vs. administrador; no lo extiendas con reglas específicas de un recurso.

## Licencia

Software de código abierto licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT) (declarada en `composer.json`).
