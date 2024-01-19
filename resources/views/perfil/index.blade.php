@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store') }}" enctype="multipart/form-data" method="POST">
                @csrf 
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        id="username"
                        name="username"
                        placeholder="Tu nombre de usuario..."
                        class="border p-3 w-full rounded-lg @error('username')  border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                        type="text"
                        
                        />

                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        placeholder="Tu cuenta de correo..."
                        class="border p-3 w-full rounded-lg @error('email')  border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"
                        type="email"
                        
                        />

                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input 
                        id="password"
                        name="password"
                        placeholder="Tu contraseña..."
                        class="border p-3 w-full rounded-lg  @error('password')  border-red-500 @enderror"
                        value=""
                        type="password"/>

                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nueva contraseña
                    </label>
                    <input 
                        id="new_password"
                        name="new_password"
                        placeholder="Tu contraseña..."
                        class="border p-3 w-full rounded-lg  @error('new_password')  border-red-500 @enderror"
                        value=""
                        type="password"/>

                        @error('new_password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir la nueva contraseña
                    </label>
                    <input 
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        placeholder="Repite la contraseña..."
                        class="border p-3 w-full rounded-lg"
                        type="password"/>
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input 
                        id="imagen"
                        name="imagen"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        type="file"
                        accept=".jpg, .jpeg"
                        />
                </div>

                <input 
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 uppercase font-bold w-full p-3 text-white rounded-lg transition-colors cursor-pointer text-center" 
                />
            </form>
        </div>
    </div>
@endsection