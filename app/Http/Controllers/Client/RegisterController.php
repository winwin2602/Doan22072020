<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\User\UserInterface;
use App\Repositories\Role\RoleInterface;
use App\Repositories\RoleUser\RoleUserInterface;
use App\Repositories\Customer\CustomerInterface;
use Str;
use Auth;
use App\Http\Requests\RegisterRequest;
class RegisterController extends Controller
{
    protected $redirectTo = '/home';
    protected $userRepository;
    protected $roleRepository;
    protected $roleUserRepository;
    protected $customerRepository;
    public function __construct(UserInterface $userRepos, RoleInterface $roleRepos, RoleUserInterface $roleUserRepos,CustomerInterface $customerRepos)
    {
        $this->userRepository = $userRepos;
        $this->roleRepository = $roleRepos;
        $this->roleUserRepository = $roleUserRepos;
        $this->customerRepository = $customerRepos;        
    }
    protected function create(RegisterRequest $request)
    {
        $request->validated();        

        $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_deleted' => false,
                'level' => 1,
            ]);
        // Auth::login($user,true);
        $userCreate = $this->userRepository->create($user->toArray());
            // Insert data to role_permission
        $userCreate->roles()->attach(4);        

        $customer = new Customer([
        	'full_name' => $request->full_name,
        	'address' => $request->address,
        	'phone_no' => $request->phone_no,
        	'email' => $request->email,
        	'slug' => Str::slug($request->full_name),
        	'is_deleted' => false,
            'user_id' => $userCreate->id,
        ]);
        $createCustomer = $this->customerRepository->create($customer->toArray());
        $createCustomer->save();
        Auth::login($userCreate,true);
        return redirect('/home'); 
    }
}
