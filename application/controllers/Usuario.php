<?php 
defined('BASEPATH') or exit('No direct script acess allowed');

class Usuario extends CI_Controller{

    public function insert(){
        
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        $nome = $this->input->post('nome');
        $tipo_usuario = $this->input->post('tipo_usuario');

        if(trim($usuario) == ''){
            $retorno = array('codigo' => 2, 'msg' => 'Usuário não informado');
        }elseif(trim($senha) == ''){
            $retorno = array('codigo' => 3, 'msg' => 'Senha não informada');
        }elseif(trim($nome) == ''){
            $retorno = array('codigo' => 4, 'msg' => 'Nome não informado');
        }elseif((strtoupper(trim($tipo_usuario)) != "ADMNISTRADOR" && strtoupper(trim($tipo_usuario)) != 'COMUM')
            || trim($tipo_usuario) === ''){
            $retorno = array('codigo' => 5, 'msg' => 'Topo de usuário inválido');
        }else{
            $this->load->model('m_usuario');
            $retorno = $this->m_usuario->inserir($usuario,$senha,$nome,$tipo_usuario);
        }
        echo json_encode($retorno);
    }

}

?>