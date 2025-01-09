<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        //
        $data = $this->getPageData();
        $data['page_name'] = 'Pengguna';
        $data['page_subname'] = 'Pengaturan Administrator dan Pengguna';
        $data['page_breadcum'] = array_merge($data['page_breadcum'],[['name' => 'Pengguna','link' => route('users.index'),'status' => 'active']]);

        $filter = $request->query('filter');

        if ($filter === 'User') {
            $users = User::where('role', 'User')->latest()->get();
        } elseif ($filter === 'Admin') {
            $users = User::where('role', 'Admin')->latest()->get();
        } else {
            $users = User::where('role', 'Admin')->latest()->get();
        }

        return view('pages.admin.users.index',compact(['data','users', 'filter']));
    }

    public function create()
    {
        //
        $data = $this->getPageData();
        $data['page_name'] = 'Tambah Pengguna';
        $data['page_subname'] = 'Tambah Pengguna';
        $data['page_breadcum'] = array_merge($data['page_breadcum'],[['name' => 'Pengguna','link' => route('users.index'),'status' => ''],['name' => 'Tambah Pengguna','link' => route('users.create'),'status' => 'active']]);
        return view('pages.admin.users.create',compact(['data']));
    }
    

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'role' => ['required'],
            'user_image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'user_phone' => ['nullable', 'string'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $filenamefoto = $request->file('user_image')->getClientOriginalName();
        $fotoPath = $request->file('user_image')->storeAs('foto', $filenamefoto, 'public');
        
        $validatedData = $validator->validated();

        $validatedData['user_phone'] = $validatedData['user_phone'] ?? '-';
        
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'user_phone' => $validatedData['user_phone'], 
                'password' => bcrypt($validatedData['password']), 
                'role' => $validatedData['role'],
                'user_image' => $fotoPath,
            ]);
        
            return redirect()->route('users.index')->with('sukses', 'Berhasil menambah pengguna!');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan pengguna: ' . $e->getMessage());
        
            return redirect()->back()->with('eror', 'Oops Something Went Wrong');
        }
    }

    public function edit(string $id)
    {

        $data = $this->getPageData();
        $data['page_name'] = 'Perbarui Pengguna';
        $data['page_subname'] = 'Menu Perbarui Pengguna';
        $data['page_breadcum'] = array_merge($data['page_breadcum'],[['name' => 'Pengguna','link' => route('users.index'),'status' => ''],['name' => 'Tambah User','link' => route('users.create'),'status' => 'active']]);
        $user = User::findOrFail($id);
        return view('pages.admin.users.edit',compact(['data','user']));
    }

    public function update(Request $request, $id)
    {
        $oldData = User::findOrFail($id);
    
        $validate = \Validator::make($request->all(), [
            'name' => ['required'],
            'user_phone' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
        ]);
    
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    
        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        else {
            $request->request->remove('password');
            }
    
    $oldData->update($request->except('_token', '_method', 'foto', 'user_image'));

    if ($request->hasFile('foto')) {
        $user_image = $request->file('foto');
        $imageName = time() . '_' . $user_image->getClientOriginalName();

        $imagePath = $user_image->storeAs('foto', $imageName, 'public');

    if ($oldData->user_image && Storage::exists('public/' . $oldData->user_image)) {
        Storage::delete('public/' . $oldData->user_image);
    }

    $oldData->update(['user_image' => $imagePath]);
    }
        return redirect()->route('users.index')->with('sukses', 'Berhasil memperbarui pengguna!');
    }

    public function destroy(string $id)
    {
    $oldData = User::findOrFail($id);

    if (!empty($oldData->user_image) && $oldData->user_image != '-') {
        $filePath = $this->defaultUploadFileDir . '/' . $oldData->user_image;

        if (is_file($filePath)) {
            unlink($filePath);
        } else {
            \Log::warning("File not found or not a file: $filePath");
        }
    }
    }
}