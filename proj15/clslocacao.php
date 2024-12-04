<?php

class clslocacao{
    private $id_locacao;
    private $id_cliente;
    private $id_filme;
    private $data_locacao;
    private $data_devolucao;


    public function getid_locacao()
    {
        return $this->id_locacao;
    }
    public function setid_locacao ($idl)
    {
        $this->id_locacao = $idl;
    }

    //--------

    public function getid_cliente()
    {
        return $this->id_cliente;
    }
    public function setid_cliente($idc)
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

    public function getdata_locacao()
    {
        return $this->data_locacao;
    }
    public function setdata_locacao($dtl)
    {
        $this->data_locacao = $dtl;
    }

    //--------

    public function getdata_devolucao()
    {
        return $this->data_devolucao;
    }
    public function setdata_devolucao ($dtd)
    {
        $this->data_devolucao = $dtd;
    }


    public function gravar()
    {
        include_once "conexao.php";

        try{
            $Comando=$conexao->prepare("insert into tb_locacao (id_locacao,id_cliente,id_filme,data_locacao, data_devolucao) values (?,?,?,?,?)");
            $Comando->bindParam(1,$this->id_locacao);
            $Comando->bindParam(2,$this->id_cliente);
            $Comando->bindParam(3,$this->id_filme);
            $Comando->bindParam(4,$this->data_locacao);
            $Comando->bindParam(5,$this->data_devolucao);

            if ($Comando->execute())
            {
                $Retorno = "Locação feita com sucesso";
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
            $Comando=$conexao->prepare("delete from tb_locacao where id_locacao= ?");
            $Comando->bindParam(1,$this->id_locacao);

            if ($Comando->execute())
            {
                $Retorno = "Locação deletada com sucesso";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro" . $Erro->getMessage();
        }
        return $Retorno;
        }

        public function consultalocacao() {
            include_once "conexao.php";
            try {
                $Comando = $conexao->prepare("select tb_locacao.id_locacao,
                tb_cliente.nome_cliente,
                tb_filme.titulo_filme,
                date_format(tb_locacao.data_locacao, '%d/%m/%Y') as data_locacao,
                date_format(tb_locacao.data_devolucao, '%d/%m/%Y') as data_devolucao
                from tb_locacao
                inner join tb_filme on tb_locacao.id_filme = tb_filme.id_filme
                inner join tb_cliente on tb_locacao.id_cliente = tb_cliente.id_cliente;");
                $Comando->execute();
                $resultados = $Comando->fetchAll(PDO::FETCH_ASSOC);
                return $resultados;
            } catch (PDOException $Erro) {
                return json_encode(["erro" => "Erro ao consultar as locações: " . $Erro->getMessage()]);
            }
        }
}