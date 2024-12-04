<?php

class clsfilme{
    private $id_filme;
    private $titulo_filme;
    private $genero_filme;
    private $ano_lancamento_filme;
    private $preco_locacao_filme;
    private $estoque_filme;
    
    
    public function getid_filme()
    {
        return $this->id_filme;
    }
    public function setid_filme($idf)
    {
        $this->id_filme = $idf;
    }

    //--------

    public function gettitulo_filme()
    {
        return $this->titulo_filme;
    }
    public function settitulo_filme($ttlf)
    {
        $this->titulo_filme = $ttlf;
    }

    //--------

    public function getgenero_filme()
    {
        return $this->genero_filme;
    }
    public function setgenero_filme($gnrf)
    {
        $this->genero_filme = $gnrf;
    }

    //--------

    public function getano_lancamento_filme()
    {
        return $this->ano_lancamento_filme;
    }
    public function setano_lancamento_filme($alf)
    {
        $this->ano_lancamento_filme = $alf;
    }

    //--------

    public function getpreco_locacao_filme()
    {
        return $this->preco_locacao_filme;
    }
    public function setpreco_locacao_filme($plf)
    {
        $this->preco_locacao_filme = $plf;
    }

    //--------

    public function getestoque_filme()
    {
        return $this->estoque_filme;
    }
    public function setestoque_filme($esf)
    {
        $this->estoque_filme = $esf;
    }

    //--------


    public function gravar()
    {
        include_once "conexao.php";

        try{
            $Comando=$conexao->prepare("insert into tb_filme (id_filme,titulo_filme,genero_filme,ano_lancamento_filme,preco_locacao_filme,estoque_filme) values (?,?,?,?,?,?)");
            $Comando->bindParam(1,$this->id_filme);
            $Comando->bindParam(2,$this->titulo_filme);
            $Comando->bindParam(3,$this->genero_filme);
            $Comando->bindParam(4,$this->ano_lancamento_filme);
            $Comando->bindParam(5,$this->preco_locacao_filme);
            $Comando->bindParam(6,$this->estoque_filme);

            if ($Comando->execute())
            {
                $Retorno = "Filme adicionado com sucesso ao catálogo";
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
            $Comando=$conexao->prepare("delete from tb_filme where id_filme= ?");
            $Comando->bindParam(1,$this->id_filme);

            if ($Comando->execute())
            {
                $Retorno = "Filme deletado com sucesso";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro" . $Erro->getMessage();
        }
        return $Retorno;
        }


        public function consultafilme() {
            include_once "conexao.php";
            try {
                $Comando = $conexao->prepare("select * from tb_filme");
                $Comando->execute();
                $resultados = $Comando->fetchAll(PDO::FETCH_ASSOC);
                return $resultados;
            } catch (PDOException $Erro) {
                return json_encode(["erro" => "Erro ao consultar filmes: " . $Erro->getMessage()]);
            }
        }
}