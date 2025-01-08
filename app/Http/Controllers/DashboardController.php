<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    
    public function index(){

        $data = $this->getPageData();
        if(auth()->user()->role == 'Admin'){

            $pengguna = User::where('role', 'Admin')->get();
            return view('pages.admin.dashboard',compact(['data','pengguna']));
        }
        if(auth()->user()->role == 'User'){

            return view('pages.user.dashboard',compact(['data']));
        }

        
    }

    public function profile(){
        $data = $this->getPageData();
        $data['page_name'] = 'Profile';
        $data['page_subname'] = 'Profile Anda';
       
        $data['page_breadcum'] = array_merge($data['page_breadcum'],[['name' => 'Profile','link' => route('profile'),'status' => 'active']]);
        $user = User::findOrFail(auth()->user()->id);
        \Log::debug('Debugging User Image', [
            'user_image' => $user->user_image,
            'full_path' => asset('storage/' . $user->user_image),
        ]);
        
        return view('pages.admin.profile',compact(['data','user']));
    }
    public function updateProfile(Request $request){
        
        $id = auth()->user()->id;
        $oldData = User::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'name' => ['required'],
            'user_phone' => ['required'],
            'username' => ['required'],
            'email' => ['required','email'],
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        else {
        $request->request->remove('password');
        }
        if ($request->hasFile('foto')) {
            $user_image = $request->file('foto');
            $imageName = $request->file('foto')->getClientOriginalName();
    
            $imageName = $request->file('foto')->storeAs('foto', $imageName, 'public');
            $request['user_image'] = $imageName;
    
            if ($oldData->user_image && Storage::exists('public/foto/' . $oldData->user_image)) {
                Storage::delete('public/foto/' . $oldData->user_image);
            }
        } else {
            $request['user_image'] = $oldData->user_image;
        }

        return User::updateData($id,$request,['foto']) ? redirect()->back()->with('sukses',"Profile berhasil diperbarui!") : redirect()->back()->with('eror',"Update Profile Failed, Please Try Again") ;
    }
}
