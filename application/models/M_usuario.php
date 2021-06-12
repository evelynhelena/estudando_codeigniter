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

    public function consultar($usuario,$nome,$tipo_usuario){
        $sql = "select * from tbl_usuarios where dtcria >= '2020-08-01 00:00:00:'";
        if($usuario != ''){
            $sql = $sql . "and usuario = '$usuario'";
        }
        if($tipo_usuario != ''){
            $sql = $sql . "and tipo = '$tipo_usuario'";
        }
        if($nome != ''){
            $sql = $sql . "and nome like'%$nome%'";
        }

        $retorno = $this->db->query($sql);

        if($retorno->num_rows() > 0){
            $dados = array('codigo' => 1,'msg' => 'consulta efetuada com sucesso', 'data' => $retorno->result());
        }else{
            $dados = array('codigo' => 6,'msg' => 'Dados não encontrados');
        }
        return $dados;
    }

    public function listAll(){
        $sql = "select * from tbl_usuarios where estatus != 'D'";
 
        $retorno = $this->db->query($sql);

        if($retorno->num_rows() > 0){
            $dados = array('codigo' => 1,'msg' => 'consulta efetuada com sucesso', 'data' => $retorno->result());
        }else{
            $dados = array('codigo' => 6,'msg' => 'Dados não encontrados');
        }
        return $dados;
    }

    public function alterar($usuario,$nome,$senha,$tipo_usuario){
        $this->db->query("update tbl_usuarios set nome = '$nome', senha = '$senha', tipo ='$tipo_usuario' where usuario = '$usuario'");

        if($this->db->affected_rows() > 0){
            $dados = array('codigo' => 1, 'msg' => 'Usuário atualizado com sucesso');
        }else{
            $dados = array('codigo' => 6, 'msg' => 'Houve algum problema na atualização na tabela de usuários');
        }

        return $dados;
    }

    public function desativar($id){
        $this->db->query("update tbl_usuarios set estatus = 'D' where id_usuario = '$id'");
        if($this->db->affected_rows() > 0){
            $dados = array('codigo' => 1,'msg' => 'Usuário Desativado com sucesso');
        }else{
            $dados = array('codigo' => 1,'msg' => 'Erro ao desativar o usuário');
        }
        return $dados;
    }
}

?>