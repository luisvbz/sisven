<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('us:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dni' => 'required|numeric',
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'permissions' => 'required',
            'rol' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'Debe ingresar el DNI',
            'dni.numeric' => 'Solo puede ingresar números',
            'dni.max' => 'El máximo de digitos es de 9',
            'username.required' => 'Ingrese el nombre de usuario',
            'name.required' => 'Debe ingresar el nombre',
            'username.unique' => 'El nombre de usuario esta siendo usado',
            'email.required' => 'Ingrese el correo electrónico',
            'email.unique' => 'El correo está siendo usado por otra persona',
            'email.email' => 'Debe ingresar un correo válido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener minimo 6 caracteres',
            'password_confirmation.required' => 'Debe repetir la contraseña',
            'password_confirmation.same' => 'Las contraseñas debe coincidir',
            'permissions.required' => 'Debe seleccionar los permisos',
            'rol.required' => 'Debe seleccionar el Perfil'
        ];
    }
}
