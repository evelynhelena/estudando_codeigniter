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

    public function consultar(){
        $usuario = $this->input->post('usuario');
        $nome = $this->input->post('nome');
        $tipo_usuario = strtoupper($this->input->post('tipo_usuario'));

        if(trim($tipo_usuario) != 'ADMINISTRADOR' && trim($tipo_usuario) != 'COMUM' && trim($tipo_usuario) != ''){
            $retorno = array('codigo' => 5, 'msg' => 'Tipo de usuário inválido');
        }else{
            $this->load->model('m_usuario');
            $retorno = $this->m_usuario->consultar($usuario,$nome,$tipo_usuario);
        }
        echo json_encode($retorno);
    }

    public function alterar(){
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        $nome = $this->input->post('nome');
        $tipo_usuario = $this->input->post('tipo_usuario');

        if(trim($tipo_usuario) != 'ADMINISTRADOR' && trim($tipo_usuario) != 'COMUM' && trim($tipo_usuario) != ''){
            $retorno = array('codigo' => 5, 'msg' => 'Tipo de usuário inválido');
        }elseif(trim($usuario == '')){
            $retorno = array('codigo' => 2, 'msg' => 'Usuário não informado');
        }elseif(trim($senha == '')){
            $retorno = array('codigo' => 4, 'msg' => 'Semha não informada');
        }else{
            $this->load->model('m_usuario');

            $retorno = $this->m_usuario->alterar($usuario,$nome,$senha,$tipo_usuario);
        }
        echo json_encode($retorno);
    }

    public function desativar(){
        $usuario = $this->input->post('usuario');
        if(trim($usuario == '')){
            $retorno = array('codigo' => 2, 'msg' => 'Usuário não informado');
        }else{
            $this->load->model('m_usuario');

            $retorno = $this->m_usuario->desativar($usuario);
        }
        echo json_encode($retorno);
    }

}

?>