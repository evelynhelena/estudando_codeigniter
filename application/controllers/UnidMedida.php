<?php 
defined('BASEPATH') or exit('No direct script acess allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

class UnidMedida extends CI_Controller{

    public function insert(){
        
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $sigla = $resultado->sigla;
        $descricao = $resultado->descricao;
        $usuario = $resultado->usuario;

        if(trim($sigla) == ''){
            $retorno = array('codigo' => 2, 'msg' => 'Sigla não informada');
        }elseif(strlen(trim($sigla)) > 3){
            echo (strlen(trim($sigla)));
            $retorno = array('codigo' => 3, 'msg' => 'Sigla pode conter no maximo 3 caracteres');
        }elseif(trim($descricao) == ''){
            $retorno = array('codigo' => 4, 'msg' => 'Descrição não informado');
        }elseif((trim($usuario) == '' || trim($usuario) == 0)){
            $retorno = array('codigo' => 5, 'msg' => 'Usuario não informado');
        }else{
            $this->load->model('m_unidmedida');
            $retorno = $this->m_unidmedida->inserir($sigla,$descricao,$usuario);
        }
       echo json_encode($retorno);
    }

    
    public function listAll(){

        $this->load->model('m_unidmedida');
        $retorno = $this->m_unidmedida->listAll();
     
        echo json_encode($retorno);
    }

    public function consultarId($id){
        if(trim($id == '')){
            $retorno = array('codigo' => 2, 'msg' => 'Unidade de medida não informada');
        }else{
            $this->load->model('m_unidmedida');

            $retorno = $this->m_unidmedida->consultarId($id);
        }
        echo json_encode($retorno);
    }

   /* public function consultar(){

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
    }*/

    /*public function alterar(){

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
    }*/

    public function desativar($id){
        if(trim($id == '')){
            $retorno = array('codigo' => 2, 'msg' => 'Unidade de medida não informada');
        }else{
            $this->load->model('m_unidmedida');

            $retorno = $this->m_unidmedida->desativar($id);
        }
        echo json_encode($retorno);
    }

}

?>