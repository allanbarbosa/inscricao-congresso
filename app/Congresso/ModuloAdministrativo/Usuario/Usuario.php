<?php namespace Congresso\ModuloAdministrativo\Usuario;

use Congresso\ModuloAdministrativo\Usuario\Models\Usuario as ModelUsuario;

class Usuario
{
    protected $usuario;

    protected $errors;

    public function __construct(ModelUsuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function logar($input)
    {

        try {

            $senha = md5($input['senha']);

            $usuario = $this->usuario->where('usua_login', '=', $input['usuario'])
                                     ->where('usua_senha', '=', $senha)
                                     ->first();

            if(!$usuario){
                throw new \AppException('Login e senha inválidos');
            }

            \Auth::login($usuario);

            return true;

        }catch(\AppException $e){
            $this->errors = $e->getMensagem();
            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}