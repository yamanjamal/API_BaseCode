<?php

namespace App\Http\BaseCode\RolesandPermissions;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RolesAndPermission\GrantPermissionRequest;
use App\Http\Requests\RolesAndPermission\RevokePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseController
{
    public function index()
    {
        abort_if(Gate::denies('permission_access'), 403);
        $permissions =Permission::all();
        return $this->sendResponse(PermissionResource::collection($permissions),'permissions sent sussesfully');
    }
    
    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), 403);
        return $this->sendResponse(new PermissionResource($permission->load('roles')),'permission sent sussesfully');
    }

    public function grant(GrantPermissionRequest $request,Role $role)
    {
        $role->LoadMissing('permissions');
        $role->givePermissionTo($request->permissions);
        return $this->sendResponse(new RoleResource($role),'permission granted sussesfully');
    }

    public function revoke(RevokePermissionRequest $request ,Role $role)
    {
        $role->LoadMissing('permissions');
        $role->revokePermissionTo($request->permissions);
        return $this->sendResponse(new RoleResource($role),'permission revoked sussesfully');
    }
}
