<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Megacampus\Repositories\RoleTransaction\RoleTransactionRepositoryInterface;
use Megacampus\Repositories\User\UserRepositoryInterface;

use Auth, Session;

class NavigationTopBarComposer
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
            $roleId = $this->userRepository->find(Auth::user()->id)->role_id; 
            //get modules list for the user role
            $view->with('menuNames', $this->roleTransactionRepository->getModulesByRoleId($roleId));
        }
    }
}