<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Rules\PasswordMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        $user = Auth::user();
        $validation = $this->validate($request, [
            'username' => [
                'required',
                'unique:users,username,'.auth()->user()->id,
                'min:3',
                'max:20', 
                'not_in:twitter,editar-perfil'
            ],
            
            'email' => [
                'required',
                'unique:users,email,'.auth()->user()->id,
                'min:3',
                'max:60', 
                'email'
            ],

            'password' => [
                'nullable', 
                'string', 
                //'required_with:new_password,new_password_confirmation',
                new PasswordMatch
            ],

            'new_password' => [
                'nullable',
                'required_with:password,new_password_confirmation',
                'string',
                'min:6',
                'max:20',
                'different:password'
            ],

	        'new_password_confirmation' => 'same:new_password',
        ]);

        /* , 'in:CLIENTE,PROVEEDOR,VENDEDOR' */

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }



        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        if ($request->filled('new_password')) {
            $usuario->password = Hash::make($request->new_password);
        }

        $usuario->save();


        //Redireccionar al usuario
        return redirect()->route('posts.index', $usuario->username);




    }
}
