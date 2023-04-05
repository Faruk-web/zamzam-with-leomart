<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sidebar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



use App\Models\Business_info;
use Image;



use Illuminate\Support\Facades\File;
// use Auth;
// use Image;
// Use File;
use Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $admins = User::where('type', 1)->orderBy('id', 'DESC')->get();
            return view('admin.admin.index', compact('admins'));
        }
        else {
            session()->flash('error','Access Denied !');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->type == 1) {
            return view('admin.admin.create');
        }
        else {
            session()->flash('error','Access Denied !');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'phone' => 'required|max:255|unique:users',
            'image' => 'nullable|image',
        ]);
        $admin = new User;
        $admin->name = $request->name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->admin_type = $request->admin_type;
        $admin->city = $request->city;
        //$admin->country = $request->country;
        $admin->password = Hash::make($request->password);
        // image save
        if ($request->image){
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/admin/'. $img);
            Image::make($image)->save($location);
            $admin->image = $img;
        }
        $admin->type = 1;
        $admin->is_active = 1;
        $admin->save();
        //$admin->sendEmailVerificationNotification();

        Alert::toast('One admin added !', 'success');
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->type == 1) {
            $admin = User::find($id);
            if (!is_null($admin)) {
                return view('admin.admin.edit', compact('admin'));
            }
            else{
                session()->flash('error','Something went wrong !');
                return back();
            }
        }
        else {
            session()->flash('error','Access Denied !');
            return back();
        }
    }
    public function permission($id)
    {
        if (Auth::user()->type == 1) {
            $admin = User::find($id);
            if (!is_null($admin)) {
                $sidebars = Sidebar::get();
                return view('admin.admin.permission', compact('admin','sidebars'));
            }
            else{
                session()->flash('error','Something went wrong !');
                return back();
            }
        }
        else {
            session()->flash('error','Access Denied !');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$admin->id,
            'phone' => 'required|max:255|unique:users,phone,'.$admin->id,
            'image' => 'nullable|image',
        ]);
        $admin->name = $request->name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        // $admin->description = $request->description;
        $admin->city = $request->city;
        // $admin->country = $request->country;
        
        // image save
        if ($request->image){
            if (File::exists('images/admin/'.$admin->image)){
                File::delete('images/admin/'.$admin->image);
            }
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/admin/'. $img);
            Image::make($image)->save($location);
            $admin->image = $img;
        }

        

        $admin->save();

        Alert::toast('Admin Updated !', 'success');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::find($id);
        if (!is_null($admin)) {
            if (File::exists('images/admin/'.$admin->image)){
                File::delete('images/admin/'.$admin->image);
            }
            $admin->delete();
            Alert::toast('Admin has been deleted !', 'success');
            return redirect()->route('admin.index');
        }
        else {
            session()->flash('error','Something went wrong !');
            return redirect()->route('admin.index');
        }
    }

    public function customer_index()
    {
        if (Auth::user()->type == 1) {
            $customers = User::where('type', 2)->orderBy('id', 'DESC')->get();
            return view('admin.customer.index', compact('customers'));
        }
        else {
            session()->flash('error','Access Denied !');
            return back();
        }
    }

    public function customer_destroy($id)
    {
        $customer = User::find($id);
        if (!is_null($customer)) {
            if (File::exists('images/customer/'.$customer->image)){
                File::delete('images/customer/'.$customer->image);
            }
            $customer->delete();
            Alert::toast('Customer has been deleted !', 'success');
            return redirect()->route('customer.index');
        }
        else {
            session()->flash('error','Something went wrong !');
            return redirect()->route('customer.index');
        }
    }


    //role permission
    
    public function role() {
        if(User::checkPermission('role.view') == true) {
            $roles = DB::table('roles')->get();
            return view('pages.roles.role', compact('roles'));
        }
        else {
            return 'coming soon user dashboard';
        }
    }

    public function create_role(Request $request) {
        if(User::checkPermission('create.role') == true) {
            $role_name = $request->name;
            $check = DB::table('roles')->where('name', $role_name)->first();
            if(!empty($check->id)) {
                return Redirect()->back()->with('error', 'This role is already exist!');
            }
            else {
                $data = array();
                $data['name'] = $role_name;
                $data['guard_name'] = 'web';
                $data['created_at'] = Carbon::now();

                $insert = DB::table('roles')->insert($data);
                if($insert) {
                    return Redirect()->back()->with('success', 'New role has been created.');
                }
                else {
                    return Redirect()->back()->with('error', 'Error Occoured, Please Try again.');
                }
            }
        }
        else {
            return 'coming soon user dashboard';
        }
    }

    //Begin:: Edit Admin helper role
    public function Edit_Admin_helper_role($id) {
        if(User::checkPermission('update.role') == true){
            $role_info = DB::table('roles')->where('id', $id)->first();
            if(!empty($role_info->id)) {
                return view('pages.roles.edit_role', compact('role_info'));
            }
            else {
                return Redirect()->back()->with('error', 'Sorry you can not access this page');
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
        
    }
    //Begin:: Edit Admin helper role

    //Begin:: Update Admin helper role
    public function update_Admin_helper_role(Request $request, $id) {
        if(User::checkPermission('update.role') == true){
            $role_name = $request->name;
            $check = DB::table('roles')->where('name', $role_name)->first();
            if(!empty($check->id)) {
                return Redirect()->back()->with('error', 'Sorry, This role is already exist!');
            }
            else {
                $data = array();
                $data['name'] = $role_name;
                $data['updated_at'] = Carbon::now();
                $update = DB::table('roles')->where('id', $id)->update($data);
                if($update) {
                    return Redirect()->route('admin.role')->with('success', 'Role has benn Updated.');
                }
                else {
                    return Redirect()->back()->with('error', 'Error Occoured, Please Try again.');
                }
                
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
        
    }
    //End:: Update Admin helper role


    //Begin:: Update Admin helper role Permission
    public function admin_helper_permission($id) {
        if(User::checkPermission('permissions') == true){
            $role = Role::findById($id);
            $permissions = Permission::all();
            $permissionGroups = User::getPermissionGroupsForAdminHealperRole();
            $wing = 'main';
            return view('pages.roles.permissions', compact('permissions', 'permissionGroups', 'role', 'wing'));
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    //End:: Update Admin helper role Permission

    //Begin:: Set Permission to admin helper role
    public function set_permission_to_admin_helper_role() {
        $role_id = $_GET['roleID'];
        $permission_id = $_GET['permission_id'];     
        $check = DB::table('role_has_permissions')->where('role_id', $role_id)->where('permission_id', $permission_id)->first();
        if(empty($check->role_id)) {
            $data = array();
            $data['role_id'] = $role_id;
            $data['permission_id'] = $permission_id;

            $insert = DB::table('role_has_permissions')->insert($data);

            if($insert) {
                \Artisan::call('permission:cache-reset');
                $sts = [
                    'status' => 'yes',
                    'reason' => 'Permission set successfully'
                ];
                return response()->json($sts);
            }
            else {
                $sts = [
                    'status' => 'no',
                    'reason' => 'Something is wrong, please try again.'
                ];
                return response()->json($sts);
            }
            
        }
        else {
            $sts = [
                'status' => 'no',
                'reason' => 'Permission is already exist, Please try another.'
            ];
            return response()->json($sts);
        }
        
    }
    //End:: Set Permission to admin helper role


    //Begin:: Delete Permission from role
    public function delete_permission_from_role() {
        $role_id = $_GET['roleID'];
        $permission_id = $_GET['permission_id'];
        $check = DB::table('role_has_permissions')->where('role_id', $role_id)->where('permission_id', $permission_id)->first();
        if(!empty($check->role_id)) {
            
            $delete = DB::table('role_has_permissions')->where('role_id', $role_id)->where('permission_id', $permission_id)->delete();
            if($delete) {
                \Artisan::call('permission:cache-reset');
                $sts = [
                    'status' => 'yes',
                    'reason' => 'Permission Delete successfully'
                ];
                return response()->json($sts);
            }
            else {
                $sts = [
                    'status' => 'no',
                    'reason' => 'Something is wrong, please try again.'
                ];
                return response()->json($sts);
            }
            
        }
        else {
            $sts = [
                'status' => 'no',
                'reason' => 'Permission is not exist, Please try another.'
            ];
            return response()->json($sts);
        }
        
    }
    //End:: Delete Permission from role
}
