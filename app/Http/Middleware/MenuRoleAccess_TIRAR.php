<?php

namespace App\Http\Middleware;

use Closure;
use Megacampus\Services\AccessRights\AccessRightsServiceInterface;

class MenuRoleAccess 
{

    public function __construct(AccessRightsServiceInterface $accessRightsService)
    {

        $this->accessRightsService = $accessRightsService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $authorezed=$this->accessRightsService->hasAccessToModule($request->route()->getName());

        if ($authorezed){

            return $next($request);

        }

        return view('errors.access_denied');
       
    }
}
