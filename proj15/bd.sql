create database locadora;
use locadora;

create table tb_filme(
id_filme int primary key,
titulo_filme varchar (30),
genero_filme varchar (15),
ano_lancamento_filme char (4),
preco_locacao_filme decimal (10,2),
estoque_filme varchar (2)
);

create table tb_cliente(
id_cliente int primary key,
nome_cliente varchar (50),
cpf_cliente char (11),
data_nasc_cliente date,
telefone_cliente char (11),
email_cliente varchar (50)
);

create table tb_locacao(
id_locacao int primary key,
id_cliente int,
id_filme int,
data_locacao date,
data_devolucao date,
foreign key (id_cliente) references tb_cliente (id_cliente),
foreign key (id_filme) references tb_filme (id_filme)
);

create table tb_avaliacao(
id_avaliacao int primary key,
id_cliente int,
id_filme int,
data_avaliacao date,
nota_avaliacao int,
comentario_avaliacao varchar (250),
foreign key (id_cliente) references tb_cliente (id_cliente),
foreign key (id_filme) references tb_filme (id_filme)
);

select tb_locacao.id_locacao, tb_cliente.nome_cliente, tb_filme.titulo_filme, tb_locacao.data_locacao, tb_locacao.data_devolucao
from tb_locacao
inner join tb_filme on tb_locacao.id_filme = tb_filme.id_filme
inner join tb_cliente on tb_locacao.id_cliente = tb_cliente.id_cliente;

select tb_avaliacao.id_avaliacao, tb_cliente.nome_cliente, tb_filme.titulo_filme, tb_avaliacao.data_avaliacao, tb_avaliacao.nota_avaliacao, tb_avaliacao.comentario_avaliacao
from tb_avaliacao
inner join tb_filme on tb_avaliacao.id_filme = tb_filme.id_filme
inner join tb_cliente on tb_avaliacao.id_cliente = tb_cliente.id_cliente;
