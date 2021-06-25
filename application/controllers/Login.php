<?php 
defined('BASEPATH') or exit('No direct script acess allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');
class Login extends CI_Controller{
    public function logar(){
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario = $resultado->usuario;
        $senha = $resultado->senha;

        $this->load->model('m_acesso');

        $retorno = $this->m_acesso->validalogin($usuario,$senha);

        echo json_encode($retorno);
    }
}

?>