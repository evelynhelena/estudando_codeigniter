<?php 
defined('BASEPATH') or exit('No direct script acess allowed');

class Login extends CI_Controller{
    public function logar(){
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');

        $this->load->model('m_acesso');

        $retorno = $this->m_acesso->validalogin($usuario,$senha);

        echo json_encode($retorno);
    }
}

?>