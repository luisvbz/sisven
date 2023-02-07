<?php

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('us:edit');
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
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->user->id)],
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'name' => 'required',
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
            'permissions.required' => 'Debe seleccionar los permisos',
            'rol.required' => 'Debe seleccionar el Perfil'
        ];
    }
}
