<?php

namespace App\Http\Middleware;

use Closure;
use Megacampus\Services\AccessRights\AccessRightsServiceInterface;


class CheckRoleAccess 
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

        $route=$request->route()->getName();
        
        dd($route);

        $module      =$route[0];
        $transaction =$route[1];
        $action      =$route[2];



        switch (count($route)){
            
            case 1: 
                break;

            case 2: 
                break;

            case 3: 

                if (! $this->accessRightsService->hasAccessToModuleTransactionForAction($module, $transaction, $action)){
                 //   redirect()->back();
                }
                break;
        }

        return $next($request);
    }
}
