<?php

class clsavaliacao{
    private $id_avaliacao;
    private $id_cliente;
    private $id_filme;
    private $data_avaliacao;
    private $nota_avaliacao;
    private $comentario_avaliacao;


    public function getid_avaliacao()
    {
        return $this->id_avaliacao;
    }
    public function setid_avaliacao ($ida)
    {
        $this->id_avaliacao = $ida;
    }

    //--------

    public function getid_cliente()
    {
        return $this->id_cliente;
    }
    public function setid_cliente ($idc)
    {
        $this->id_cliente = $idc;
    }

    //--------

    public function getid_filme()
    {
        return $this->id_filme;
    }
    public function setid_filme($idf)
    {
        $this->id_filme = $idf;
    }

    //--------

    public function getdata_avaliacao()
    {
        return $this->data_avaliacao;
    }
    public function setdata_avaliacao($dta)
    {
        $this->data_avaliacao = $dta;
    }

    //--------

    public function getnota_avaliacao()
    {
        return $this->nota_avaliacao;
    }
    public function setnota_avaliacao($nta)
    {
        $this->nota_avaliacao = $nta;
    }

    //--------

    public function getcomentario_avaliacao()
    {
        return $this->comentario_avaliacao;
    }
    public function setcomentario_avaliacao($coa)
    {
        $this->comentario_avaliacao = $coa;
    }

    //--------



    public function gravar()
    {
        include_once "conexao.php";

        try{
            $Comando=$conexao->prepare("insert into tb_avaliacao (id_avaliacao,id_cliente,id_filme,data_avaliacao,nota_avaliacao,comentario_avaliacao) values (?,?,?,?,?,?)");
            $Comando->bindParam(1,$this->id_avaliacao);
            $Comando->bindParam(2,$this->id_cliente);
            $Comando->bindParam(3,$this->id_filme);
            $Comando->bindParam(4,$this->data_avaliacao);
            $Comando->bindParam(5,$this->nota_avaliacao);
            $Comando->bindParam(6,$this->comentario_avaliacao);

            if ($Comando->execute()) {
                return "Avaliação cadastrada com sucesso!";
            } else {
                return "Erro ao tentar cadastrar a avaliação.";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro" . $Erro->getMessage();
        }
        return $Retorno;
    }



    public function deletar()
    {
        include_once "conexao.php";

        try{
            $Comando=$conexao->prepare("delete from tb_avaliacao where id_avaliacao= ?");
            $Comando->bindParam(1,$this->id_avaliacao);

            if ($Comando->execute()) {
                return "Avaliação removida com sucesso!";
            } else {
                return "Erro ao tentar remover a avaliação.";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro" . $Erro->getMessage();
        }
        return $Retorno;
        }

        public function consultaavaliacao() {
            include_once "conexao.php";
            try {
                $Comando = $conexao->prepare("select tb_avaliacao.id_avaliacao, 
                tb_cliente.nome_cliente, 
                tb_filme.titulo_filme, 
                date_format(tb_avaliacao.data_avaliacao, '%d/%m/%y') as data_avaliacao, 
                tb_avaliacao.nota_avaliacao, 
                tb_avaliacao.comentario_avaliacao
                from tb_avaliacao
                inner join tb_filme on tb_avaliacao.id_filme = tb_filme.id_filme
                inner join tb_cliente on tb_avaliacao.id_cliente = tb_cliente.id_cliente;");
                $Comando->execute();
                $resultados = $Comando->fetchAll(PDO::FETCH_ASSOC);
                return $resultados;
            } catch (PDOException $Erro) {
                return json_encode(["erro" => "Erro ao consultar as avaliações: " . $Erro->getMessage()]);
            }
        }
}