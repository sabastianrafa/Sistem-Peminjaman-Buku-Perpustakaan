protected $routeMiddleware = [
    // ... lainnya
    'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
];