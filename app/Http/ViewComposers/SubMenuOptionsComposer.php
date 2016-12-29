<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Megacampus\Repositories\RoleTransaction\RoleTransactionRepositoryInterface;
use Megacampus\Repositories\User\UserRepositoryInterface;

use Auth, Request;

class SubMenuOptionsComposer
{
   
    protected $userRepository;
    protected $roleTransactionRepository;

    
    public function __construct(UserRepositoryInterface $userRepository,
                                RoleTransactionRepositoryInterface $roleTransactionRepository)
    {
        $this->userRepository            = $userRepository;
        $this->roleTransactionRepository = $roleTransactionRepository;
    }

    
    public function compose(View $view)
    {
        
        // verify if the user is authenticated 
         if (Auth::check()){
            //get user role
            $roleId   = $this->userRepository->find(Auth::user()->id)->role_id; 
            //get the routeToArray from the route
            $routeToArray=explode('.', Request::route()->getName());
            $moduleName =  $routeToArray[0];
            
            if ($moduleName=='fixassets') {
                    $moduleName='assets';
            }
            //get modules list for the user role
            $subMenuOptions= $this->roleTransactionRepository->getTransactionsByRoleIdAndModuleName($roleId, $moduleName);
            //verify if it is a submenu, it is get the transaction action id (access rights)
            if (count($routeToArray) > 1){
                 $transactionName =  str_replace('_', ' ', $routeToArray[1]);

                 switch ($transactionName) {
                    case 'campuss':
                         $transactionName='campus';
                         break;
                    case 'roles_transactions':
                         $transactionName='access rights';
                         break;
                 }
                
                //get the transaccion action id for the user role  and module name 
                 $transactionActionId= $this->roleTransactionRepository->getTransactionsActionIdByRoleIdAndModuleName($roleId, $moduleName, $transactionName);
            }
            
            $view->with(array(
                'subMenuOptions'      => $subMenuOptions,
                'transactionActionId' => (empty($transactionActionId)) ? null : $transactionActionId
                ));

           
        }
    }
}