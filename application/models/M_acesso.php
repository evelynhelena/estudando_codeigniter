<?php 
defined('BASEPATH') or exit('No direct script acess allowed');

class M_acesso extends CI_Model{
    public function validalogin($usuario, $senha){
        $retorno = $this->db->query("select * from tbl_usuarios where usuario = '$usuario' and senha = '$senha' and estatus = ''");
        
        if($retorno->num_rows() > 0){
            $dados = array('codigo' => 1, 'msg' => 'Usuário correto');
        }else{
            $dados = array('codigo' => 2, 'msg' => 'Usuário Incorreto');
        }
        
        return $dados;
    }
}

?>