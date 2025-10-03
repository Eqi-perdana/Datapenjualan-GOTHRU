protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    // ✅ tambahkan middleware role
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
