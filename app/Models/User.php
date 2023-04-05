<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'address',
        'is_wholeseller',
        'password',
        'vendor_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
      // Custom code
      public static function getPermissionGroupsForAdminHealperRole()
      {
        $permissionGroups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permissionGroups;
      }
      public static function permissionsByGroupNameForAdminHealperRole($groupname)
      {
        $permissions = DB::table('permissions')->where('group_name', $groupname)->orderBy('name', 'asc')->get();
        return $permissions;
      }
  
      public static function checkPermission($permissionName) {
          if(Auth::user()->can($permissionName) || Auth::user()->type == 1) {
              return true;
          }
        }
    
        public static function checkMultiplePermission($permissionName) {
          if(Auth::user()->hasAnyPermission($permissionName) || Auth::user()->type == 1) {
              return true;
          }
        }
}
