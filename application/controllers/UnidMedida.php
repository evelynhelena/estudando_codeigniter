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

    public function alterar(){
        
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $sigla = $resultado->sigla;
        $descricao = $resultado->descricao;
        $usuario = $resultado->usuario;
        $id = $resultado->id;

        if(trim($sigla) == ''){
            $retorno = array('codigo' => 2, 'msg' => 'Sigla não informada');
        }elseif(strlen(trim($sigla)) > 3){
            echo (strlen(trim($sigla)));
            $retorno = array('codigo' => 3, 'msg' => 'Sigla pode conter no maximo 3 caracteres');
        }elseif(trim($descricao) == ''){
            $retorno = array('codigo' => 4, 'msg' => 'Descrição não informado');
        }elseif((trim($usuario) == '' || trim($usuario) == 0)){
            $retorno = array('codigo' => 5, 'msg' => 'Usuario não informado');
        }else if($id === 0){
            $retorno = array('codigo' => 6, 'msg' => 'Id não informado');
        }else{
            $this->load->model('m_unidmedida');
            $retorno = $this->m_unidmedida->alterar($sigla,$descricao,$usuario,$id);
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