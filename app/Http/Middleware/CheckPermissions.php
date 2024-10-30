<?php

namespace App\Http\Middleware;

use App\Actions\Ordita\Permissions\HasAccess;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    public array $controllerPermissions = [
        'AdministratorsController' => 'administrator',
        'ArticlesController' => 'articles',
        'Categories' => 'categories',
        'MenusController' => 'menus',
        'PagesController' => 'pages',
        'ProductsController' => 'products',
        'RewardsController' => 'rewards',
        'ServicesController' => 'services',
        'SystemLogsController' => 'systemLogs',
        'VendorsController' => 'vendors'
    ];

    public function __construct(protected HasAccess $permissionCheck)
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $controller = class_basename($request->route()->getController());

        if (empty($this->controllerPermissions[$controller])) {
            return $next($request);
        }

        if (!$this->permissionCheck->execute(Auth::user(), [$this->controllerPermissions[$controller]])) {
            return Redirect::route('dashboard')->with('error', 'Restricted Access: You don\'t have the authorisation to view this content');
        }

        return $next($request);
    }
}
