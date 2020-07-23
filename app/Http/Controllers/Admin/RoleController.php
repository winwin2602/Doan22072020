<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RoleRequest;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Permission\PermissionInterface;
use App\Repositories\PermissionRole\PermissionRoleInterface;
use Carbon\Carbon;
use App\Models\Role;
class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;
    protected $permissionRoleRepository;    
    public function __construct(RoleInterface $roleRepos, PermissionInterface $permissionRepos,PermissionRoleInterface $permissionRoleRepos)
    {
        $this->roleRepository = $roleRepos;
        $this->permissionRepository = $permissionRepos;
        $this->permissionRoleRepository = $permissionRoleRepos;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->getAll();
        return view('admin.layouts.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAll();
        return view('admin.layouts.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $request->validated();
            $data = new Role([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $roleCreate = $this->roleRepository->create($data->toArray());
            // Insert data to role_permission
            $roleCreate->permissions()->attach($request->permission);

            $roleCreate->save();
            if ($roleCreate) return redirect('/admin/role')->with('message','Create new successfully!');
            else return back()->with('err','Save error!');
        } catch (\Exception $exception) {
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
        $permissions = $this->permissionRepository->getAll();
        $role = $this->roleRepository->find($id);
        $getAllPermissionOfRole = $this->permissionRoleRepository->getAllPermissionOfRole($id);
        return view('admin.layouts.roles.edit', compact('permissions', 'role', 'getAllPermissionOfRole')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $delete =  $this->permissionRoleRepository->deletePermissionOfRole($id);            
            $roleUpdate = $this->roleRepository->find($id);
            $roleUpdate->name = $request->name;
            $roleUpdate->display_name = $request->display_name;
            $roleUpdate->permissions()->attach($request->permission);
            $result = $this->roleRepository->update($id, $roleUpdate->toArray());
            return redirect('admin/role')->with('message','Edit successfully!');
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
            $role = $this->roleRepository->find($request->id);
            $this->permissionRoleRepository->deletePermissionOfRole($request->id);
            $roleDelete = $this->roleRepository->delete($role->id);

            if ($roleDelete) return back()->with('message','Delete success!');            
            else return back()->with('err','Delete fail!');
        } catch (Exception $e) {
            
        }        
    }
}
