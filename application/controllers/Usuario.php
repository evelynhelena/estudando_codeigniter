<?php 
defined('BASEPATH') or exit('No direct script acess allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

class Usuario extends CI_Controller{

    public function insert(){
        
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);
  
        $usuario = $resultado->usuario;
        $senha = $resultado->senha;
        $nome = $resultado->nome;
        $tipo_usuario = $resultado->tipo_usuario;

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

        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario = $resultado->usuario;
        $nome = $resultado->nome;
        $tipo_usuario = $resultado->tipo_usuario;

        if(trim($tipo_usuario) != 'ADMINISTRADOR' && trim($tipo_usuario) != 'COMUM' && trim($tipo_usuario) != ''){
            $retorno = array('codigo' => 5, 'msg' => 'Tipo de usuário inválido');
        }else{
            $this->load->model('m_usuario');
            $retorno = $this->m_usuario->consultar($usuario,$nome,$tipo_usuario);
        }
        echo json_encode($retorno);
    }

    public function listAll(){

        $this->load->model('m_usuario');
        $retorno = $this->m_usuario->listAll();
     
        echo json_encode($retorno);
    }

    public function alterar(){

        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario = $resultado->usuario;
        $senha = $resultado->senha;
        $nome = $resultado->nome;
        $tipo_usuario = $resultado->tipo_usuario;

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
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $id = $resultado->id;
        if(trim($id == '')){
            $retorno = array('codigo' => 2, 'msg' => 'Usuário não informado');
        }else{
            $this->load->model('m_usuario');

            $retorno = $this->m_usuario->desativar($id);
        }
        echo json_encode($retorno);
    }

}

?>