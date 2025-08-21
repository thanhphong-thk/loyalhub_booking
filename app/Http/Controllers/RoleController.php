<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $data = $this->roleService->getAllRole();

        return Inertia::render('role/index', $data);
    }


    public function create(RoleRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->validated();
            $this->roleService->createRole($data);

            DB::commit();
            return $this->success($data, "Thêm mới thành công");

        } catch(Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(),null, "Đã xảy ra lỗi");
        }
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            $data = $request->validated();

            $role = Role::findOrFail($id);
            $role->update($data);

            return $this->success($data,'Cập nhật vai trò thành công.');
        } catch (Exception $e) {

            return $this->error($e->getMessage(), $data, "Đã xảy ra lỗi");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $roleId)
    {
        try{
            $role = Role::find($roleId);
            $role->delete();

            return $this->success($roleId, "Xóa thành công");
        } catch (Exception $e) {

            return $this->error($e->getMessage(), $roleId, "Đã xảy ra lỗi");

        }
    }
}
