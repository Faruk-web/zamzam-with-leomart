<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\User;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Wallet;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Nexmo\Laravel\Facade\Nexmo;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Hash;

class UserController extends Controller
{
    public $successStatus = 200;

    public function vendorLogin(Request $request){
        // dd($request);
        Log::info($request);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            return redirect()->route('vendor.desboard');
        }
        else{
            return Redirect::back();
        }
    }
    public function getNidImageUrl($request)
    {
        $nidImage = $request->file('nid_image_front_side');
        $nidImageName = Str::slug($request->name).'-'.time().'.'.$nidImage->getClientOriginalExtension();
        $directory = 'images/vendor/';
        $nidImage->move($directory, $nidImageName);
        $nidImageUrl = $directory . $nidImageName;
        return $nidImageUrl;
    }

    public function getBackImage($request)
    {
        $backImage = $request->file('nid_image_back_side');
        $backImageName = Str::slug($request->name).'-'.time().'.'.$backImage->getClientOriginalExtension();
        $directory = 'images/vendor/';
        $backImage->move($directory, $backImageName);
        $imageBackUrl = $directory . $backImageName;
        return $imageBackUrl;
    }
    public function getTradeUrl($request)
    {
        $tradeImage = $request->file('trade_license_image');
        $tradeImageName = Str::slug($request->name).'-'.time().'.'.$tradeImage->getClientOriginalExtension();
        $directory = 'images/trade/';
        $tradeImage->move($directory, $tradeImageName);
        $imageTraidUrl = $directory . $tradeImageName;
        return $imageTraidUrl;
    }

    public function register(Request $request)
    {
//         dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->user_type = 'vendor';
        $user->type = 2;
        $user->vendor_status = '0';
        $user->password =  bcrypt($request->password);
        $user->save();
        $seller = new Vendor;
        $seller->user_id = $user->id;
        $seller->name = $request->name;
        $seller->last_name = $request->last_name;
        $seller->phone = $request->phone;
        $seller->last_phone = $request->last_phone;
        $seller->shop_office_name = $request->shop_office_name;
        $seller->p_nid = $request->p_nid;
        $seller->nid_image_front_side =$this->getNidImageUrl($request);
        $seller->nid_image_back_side = $this->getBackImage($request);
        $seller->trade_license_no = $request->trade_license_no;
        $seller->trade_license_image = $this->getTradeUrl($request);
        $seller->country_id = $request->country_id;
        $seller->division_id = $request->division_id;
        $seller->district_id = $request->district_id;
        $seller->thana_id = $request->thana_id;
        $seller->first_house_no = $request->first_house_no;
        $seller->second_country_id = $request->second_country_id;
        $seller->second_division_id = $request->second_division_id;
        $seller->second_thana_id = $request->second_thana_id;
        $seller->house_no = $request->house_no;
        $seller->thrd_country_id = $request->thrd_country_id;
        $seller->business_type = $request->business_type;
        $seller->save();
        $wallet = new Wallet;
        $wallet->customer_id = $user->id;
        $wallet->save();
        $wishist = new Wishlist;
        $wishist->customer_id = $user->id;
        $wishist->save();
        return redirect('/vendor/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }



}
