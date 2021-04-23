<?php 
defined('BASEPATH') or exit('No direct script acess allowed');

class M_usuario extends CI_Model{
    public function inserir($usuario,$senha,$nome,$tipo_usuario){
        $this->db->query("insert into tbl_usuarios (usuario,senha,nome,tipo) values('$usuario','$senha','$nome','$tipo_usuario')");

        if($this->db->affected_rows() > 0){
            $dados = array('codigo' => 1, 'msg' => 'Usuário Cadastrado Corretamente');
        }else{
            $dados = array('codigo' => 6, 'msg' => 'Erro ao enviar ao servidor');
        }

        return $dados;
    }
}

?>