<?php

class clscliente{
    private $id_cliente;
    private $nome_cliente;
    private $cpf_cliente;
    private $data_nasc_cliente;
    private $telefone_cliente;
    private $email_cliente;



    public function getid_cliente()
    {
        return $this->id_cliente;
    }
    public function setid_cliente($idc)
    {
        $this->id_cliente = $idc;
    }

    //--------

    public function getnome_cliente()
    {
        return $this->nome_cliente;
    }
    public function setnome_cliente($nmc)
    {
        $this->nome_cliente = $nmc;
    }

    //--------

    public function getcpf_cliente()
    {
        return $this->cpf_cliente;
    }
    public function setcpf_cliente($cpfc)
    {
        $this->cpf_cliente = $cpfc;
    }

    //--------

    public function getdata_nasc_cliente()
    {
        return $this->data_nasc_cliente;
    }
    public function setdata_nasc_cliente($dnc)
    {
        $this->data_nasc_cliente = $dnc;
    }

    //--------

    public function gettelefone_cliente()
    {
        return $this->telefone_cliente;
    }
    public function settelefone_cliente($telc)
    {
        $this->telefone_cliente = $telc;
    }

    //--------

    public function getemail_cliente()
    {
        return $this->email_cliente;
    }
    public function setemail_cliente($emc)
    {
        $this->email_cliente = $emc;
    }

    //--------

    public function gravar()
    {
        include_once "conexao.php";

        try{
            $Comando=$conexao->prepare("insert into tb_cliente (id_cliente,nome_cliente,cpf_cliente,data_nasc_cliente,telefone_cliente,email_cliente) values (?,?,?,?,?,?)");
            $Comando->bindParam(1,$this->id_cliente);
            $Comando->bindParam(2,$this->nome_cliente);
            $Comando->bindParam(3,$this->cpf_cliente);
            $Comando->bindParam(4,$this->data_nasc_cliente);
            $Comando->bindParam(5,$this->telefone_cliente);
            $Comando->bindParam(6,$this->email_cliente);

            if ($Comando->execute()) {
                return "Cliente cadastrado com sucesso!";
            } else {
                return "Erro ao tentar cadastrar o cliente.";
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
            $Comando=$conexao->prepare("delete from tb_cliente where id_cliente= ?");
            $Comando->bindParam(1,$this->id_cliente);

            if ($Comando->execute()) {
                return "Cliente removido com sucesso!";
            } else {
                return "Erro ao tentar remover o cliente.";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro" . $Erro->getMessage();
        }
        return $Retorno;
        }

        public function consultacliente() {
            include_once "conexao.php";
            try {
                $Comando = $conexao->prepare("select tb_cliente.id_cliente,
        tb_cliente.nome_cliente,
        tb_cliente.cpf_cliente,
        date_format(tb_cliente.data_nasc_cliente, '%d/%m/%y') as data_nasc_cliente,
        tb_cliente.telefone_cliente,
        tb_cliente.email_cliente
        from tb_cliente");
                $Comando->execute();
                $resultados = $Comando->fetchAll(PDO::FETCH_ASSOC);
                return $resultados;
            } catch (PDOException $Erro) {
                return json_encode(["erro" => "Erro ao consultar clientes: " . $Erro->getMessage()]);
            }
        }
}