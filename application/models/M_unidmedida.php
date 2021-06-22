<?php 
defined('BASEPATH') or exit('No direct script acess allowed');

class M_unidmedida extends CI_Model{
    public function inserir($sigla,$descricao,$usuario){
        $sql = "select * from tbl_usuarios where id_usuario = '$usuario' and estatus != 'D'";
        $retorno = $this->db->query($sql);
    
        if($retorno->num_rows() > 0 ){
            $this->db->query("insert into tbl_unid_medida(sigla,descricao,fk_user) values ('$sigla', '$descricao', '$usuario')");
    
            if($this->db->affected_rows() > 0){
                $dados = array('codigo' => 1, 'msg' => 'Unidade de medida Cadastrada Corretamente');
            }else{
                $dados = array('codigo' => 6, 'msg' => 'Erro ao enviar ao servidor');
            }
            return $dados;
        }else{
            return array('codigo' => 7, 'msg' => 'Usuário não cadastrado no sistema');
        }

    }

    public function listAll(){
        $sql = "select * from tbl_unid_medida tum
        join tbl_usuarios tu on tum.fk_user = tu.id_usuario 
        where status != 'D'";
 
        $retorno = $this->db->query($sql);

        if($retorno->num_rows() > 0){
            $dados = array('codigo' => 1,'msg' => 'consulta efetuada com sucesso', 'data' => $retorno->result());
        }else{
            $dados = array('codigo' => 6,'msg' => 'Dados não encontrados');
        }
        return $dados;
    }

    public function consultarId($id){
        $sql = "select * from tbl_unid_medida tum
        join tbl_usuarios tu on tum.fk_user = tu.id_usuario 
        where id = '$id' and status != 'D'";

        $retorno = $this->db->query($sql);

        if($retorno->num_rows() > 0){
            $dados = array('codigo' => 1,'msg' => 'consulta efetuada com sucesso', 'data' => $retorno->result());
        }else{
            $dados = array('codigo' => 6,'msg' => 'Dados não encontrados');
        }
        return $dados;
    }

    public function desativar($id){
        $this->db->query("update tbl_unid_medida set status = 'D' where id = '$id'");
        if($this->db->affected_rows() > 0){
            $dados = array('codigo' => 1,'msg' => 'Unidade de medida desativada com sucesso');
        }else{
            $dados = array('codigo' => 1,'msg' => 'Erro ao desativar a unidade de medida');
        }
        return $dados;
    }
}

?>