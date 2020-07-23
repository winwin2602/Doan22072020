<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserInterface;
use App\Repositories\Role\RoleInterface;
use App\Repositories\RoleUser\RoleUserInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RoleUser;
class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;
    protected $roleUserRepository;

    public function __construct(UserInterface $userRepos, RoleInterface $roleRepos, RoleUserInterface $roleUserRepos)
    {
        $this->userRepository = $userRepos;
        $this->roleRepository = $roleRepos;
        $this->roleUserRepository = $roleUserRepos;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('admin.layouts.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->getAll();
        return view('admin.layouts.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $request->validated();
            $data = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_deleted' => false,
                'level' => 0,
            ]);
            $userCreate = $this->userRepository->create($data->toArray());
            // Insert data to role_permission
            $userCreate->roles()->attach($request->roles);

            $userCreate->save();
            if ($userCreate) return redirect('/admin/user')->with('message','Create new successfully!');
            else return back()->with('err','Save error!');
        } catch (Exception $e) {
            
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = $this->roleRepository->getAll();
        $user = $this->userRepository->find($id);
        $listRoleOfUser = $this->roleUserRepository->getAllRoleOfUser($id);
        return view('admin.layouts.users.edit', compact('user','roles','listRoleOfUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $delete =  $this->roleUserRepository->deleteRoleOfUser($id);
            
            $userUpdate = $this->userRepository->find($id);
            $userUpdate->name = $request->name;
            $userUpdate->email = $request->email;
            $userUpdate->roles()->attach($request->roles);
            $result = $this->userRepository->update($id, $userUpdate->toArray());
            return redirect('admin/user')->with('message','Edit successfully!');
        } catch (Exception $e) {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $user = $this->userRepository->find($request->id);

            $this->roleUserRepository->deleteRoleOfUser($user->id);

            $userDelete = $this->userRepository->delete($user->id);

            if ($userDelete) return back()->with('message','Delete success!');            
            else return back()->with('err','Delete fail!');
        } catch (Exception $e) {
            
        }        
    }
}
