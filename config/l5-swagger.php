<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
            ],

            'routes' => [
                /*
                 * Ruta donde queda disponible la interfaz interactiva de la API de VentasFix
                 */
                'api' => 'api/documentation',
            ],
            'paths' => [
                /*
                 * URL absoluta usada por la UI para cargar sus propios assets (CSS/JS)
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                * Carpeta donde se guardan los assets de Swagger UI
                */
                'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

                /*
                 * Nombre del archivo JSON con la especificación OpenAPI generada de VentasFix
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * Nombre del archivo YAML con la especificación OpenAPI generada de VentasFix
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Formato que se usa para mostrar la documentación en la UI (json o yaml)
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Carpeta donde swagger-php escanea los atributos PHP 8 (#[OA\...])
                 * usados en los controladores de VentasFix, incluyendo
                 * Api/ProductoApiController, Api/ClienteApiController y Api/UsuarioApiController.
                 */
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],
     'defaults' => [
        'routes' => [
            /*
             * Ruta donde quedan expuestas las anotaciones ya procesadas.
             */
            'docs' => 'docs',

            /*
             * Ruta de callback para OAuth2. VentasFix no la usa: la autenticación
             * de la API se maneja con Sanctum (ver 'securitySchemes' más abajo).
             */
            'oauth2_callback' => 'api/oauth2-callback',

            /*
             * Middleware para restringir el acceso a la documentación,
             * por si en el futuro se quiere proteger /api/documentation.
             */
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],

            /*
             * Opciones del grupo de rutas de la documentación.
             */
            'group_options' => [],
        ],

        'paths' => [
            /*
             * Carpeta donde se guarda la especificación generada
             * (aquí queda storage/api-docs/api-docs.json de VentasFix)
             */
            'docs' => storage_path('api-docs'),

            /*
             * Carpeta donde se exportan las vistas de Swagger UI, si se personalizan
             */
            'views' => base_path('resources/views/vendor/l5-swagger'),

            /*
             * Base path de la API, si se necesita fijar uno distinto al de la app
             */
            'base' => env('L5_SWAGGER_BASE_PATH', null),

            /*
             * Carpetas que se excluyen del escaneo de anotaciones
             * @deprecated usar `scanOptions.exclude`
             */
            'excludes' => [],
        ],

        'scanOptions' => [
            /**
             * Generador personalizado de OpenApi\Generator, si se necesitara reemplazar
             * el que trae la librería por defecto. VentasFix no lo usa.
             *
             * @see \L5Swagger\CustomGeneratorInterface
             */
            'generator_factory' => null,

            /**
             * Configuración de los procesadores por defecto de swagger-php.
             *
             * @link https://zircote.github.io/swagger-php/reference/processors.html
             */
            'default_processors_configuration' => [
            /** Ejemplo */
            /**
             * 'operationId.hash' => true,
             * 'pathFilter' => [
             * 'tags' => [
             * '/pets/',
             * '/store/',
             * ],
             * ],.
             */
            ],

            /**
             * Analizador de código: por defecto usa \OpenApi\StaticAnalyser
             *
             * @see \OpenApi\scan
             */
            'analyser' => null,

            /**
             * Instancia de análisis: por defecto crea una nueva \OpenApi\Analysis
             *
             * @see \OpenApi\scan
             */
            'analysis' => null,

            /**
             * Procesadores personalizados adicionales (VentasFix no define ninguno).
             *
             * Cada entrada puede ser:
             * - Un nombre de clase o instancia (se inserta después de BuildPaths por defecto)
             * - Un arreglo con las llaves 'class' y 'after' para posicionarlo con precisión:
             *   ['class' => MyProcessor::class, 'after' => SomeProcessor::class]
             *
             * @link https://github.com/zircote/swagger-php/tree/master/Examples/processors/schema-query-parameter
             * @see \OpenApi\scan
             */
            'processors' => [
                // \App\SwaggerProcessors\SchemaQueryParameter::class,
                // ['class' => \App\SwaggerProcessors\Custom::class, 'after' => \OpenApi\Processors\AugmentSchemas::class],
            ],

            /**
             * Patrón de archivos a escanear (por defecto *.php).
             *
             * @see \OpenApi\scan
             */
            'pattern' => null,

            /*
             * Carpetas que se excluyen del escaneo
             * @note esta opción sobrescribe `paths.excludes`
             * @see \OpenApi\scan
             */
            'exclude' => [],

            /*
             * Versión de la especificación OpenAPI a generar (3.0.0 o 3.1.0).
             * VentasFix usa la versión por defecto (3.0.0).
             */
            'open_api_spec_version' => env('L5_SWAGGER_OPEN_API_SPEC_VERSION', \L5Swagger\Generator::OPEN_API_DEFAULT_SPEC_VERSION),
        ],

        /*
         * Esquema de autenticación de la API de VentasFix (Sanctum).
         * IMPORTANTE: en el botón "Authorize" de Swagger UI se debe pegar
         * SOLO el token devuelto por /api/login, sin la palabra "Bearer" adelante,
         * porque la UI ya la agrega automáticamente. Escribirla dos veces
         * genera un 401 (ver Bug #3 de la bitácora: "Bearer Bearer").
        */
        'securityDefinitions' => [
            'securitySchemes' => [
                'bearerAuth' => [
                    'type' => 'http',
                    'scheme' => 'bearer',
                    'bearerFormat' => 'Sanctum Token',
                    'description' => 'Ingresa el token obtenido en /api/login, sin la palabra "Bearer" adelante.',
                ],
               
            
            /*
                 * Ejemplos de otros esquemas de seguridad (no usados en VentasFix)
                 */
                /*
                'api_key_security_example' => [ // Unique name of security
                    'type' => 'apiKey', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'A short description for security scheme',
                    'name' => 'api_key', // The name of the header or query parameter to be used.
                    'in' => 'header', // The location of the API key. Valid values are "query" or "header".
                ],
                'oauth2_security_example' => [ // Unique name of security
                    'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'A short description for oauth2 security scheme.',
                    'flow' => 'implicit', // The flow used by the OAuth2 security scheme. Valid values are "implicit", "password", "application" or "accessCode".
                    'authorizationUrl' => 'http://example.com/auth', // The authorization URL to be used for (implicit/accessCode)
                    //'tokenUrl' => 'http://example.com/auth' // The authorization URL to be used for (password/application/accessCode)
                    'scopes' => [
                        'read:projects' => 'read your projects',
                        'write:projects' => 'modify projects in your account',
                    ]
                ],
                */

                /* Soporte para Open API 3.0
                'passport' => [ // Unique name of security
                    'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'Laravel passport oauth2 security.',
                    'in' => 'header',
                    'scheme' => 'https',
                    'flows' => [
                        "password" => [
                            "authorizationUrl" => config('app.url') . '/oauth/authorize',
                            "tokenUrl" => config('app.url') . '/oauth/token',
                            "refreshUrl" => config('app.url') . '/token/refresh',
                            "scopes" => []
                        ],
                    ],
                ],
                'sanctum' => [ // Unique name of security
                    'type' => 'apiKey', // Valid values are "basic", "apiKey" or "oauth2".
                    'description' => 'Enter token in format (Bearer <token>)',
                    'name' => 'Authorization', // The name of the header or query parameter to be used.
                    'in' => 'header', // The location of the API key. Valid values are "query" or "header".
                ],
                */
            ],
            'security' => [
                /*
                 * Ejemplos de seguridad (no usados en VentasFix)
                 */
                [
                    /*
                    'oauth2_security_example' => [
                        'read',
                        'write'
                    ],

                    'passport' => []
                    */
                ],
            ],
        ],

        /*
         * En true, regenera la documentación en cada request (útil en desarrollo).
         * En producción se deja en false para no perder rendimiento.
         */
        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),

        /*
         * En true, además del JSON también genera una copia en formato YAML
         */
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

        /*
         * IP del proxy de confianza, necesario si se despliega detrás de
         * un balanceador de carga (por ejemplo AWS Load Balancer). No aplica
         * en el entorno local de VentasFix.
         */
        'proxy' => false,

        /*
         * Permite cargar configuraciones externas en vez de pasarlas a SwaggerUIBundle.
         * Ver: https://github.com/swagger-api/swagger-ui#configs-plugin
         */
        'additional_config_url' => null,

        /*
         * Orden de la lista de operaciones de cada endpoint. Puede ser 'alpha'
         * (alfabético por ruta) o 'method' (por verbo HTTP). VentasFix usa el
         * orden por defecto que entrega el servidor.
         */
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),

        /*
         * URL del validador que usa Swagger UI. En null, la validación queda deshabilitada.
         */
        'validator_url' => null,

        /*
         * Parámetros de configuración de la interfaz de Swagger UI
         */
        'ui' => [
            'display' => [
                /*
                 * Modo oscuro de la interfaz de Swagger UI
                 */
                'dark_mode' => env('L5_SWAGGER_UI_DARK_MODE', false),
                /*
                 * Controla la expansión por defecto de tags y operaciones. Puede ser:
                 * 'list' (expande solo los tags),
                 * 'full' (expande tags y operaciones),
                 * 'none' (no expande nada).
                 */
                'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),

                /**
                 * Si está activo, habilita el filtro de operaciones en la barra
                 * superior de Swagger UI (por ejemplo, para buscar "productos"
                 * o "clientes" rápidamente entre todos los endpoints).
                 */
                'filter' => env('L5_SWAGGER_UI_FILTERS', true), // true | false
            ],

            'authorization' => [
                /*
                 * Si está en true, mantiene el token autorizado aunque se
                 * recargue o cierre el navegador.
                 */
                'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),

                'oauth2' => [
                    /*
                     * Agrega PKCE al flujo de Authorization Code Grant (no usado en VentasFix)
                     */
                    'use_pkce_with_authorization_code_grant' => false,
                ],
            ],
        ],
        /*
         * Constantes que se pueden usar dentro de las anotaciones/atributos
         */
        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://my-default-host.com'),
        ],
    ],
];
