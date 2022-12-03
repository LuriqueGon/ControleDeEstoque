## Badges  
[![Badge em Desenvolvimento](https://img.shields.io/badge/Version-1.0-green/style=plastic)]()  
[![](https://img.shields.io/badge/PHP-8.0.13-brightgreen)]()
# Controle De Estoque

## Antes de tudo 📝  

Faça o download do arquivo.

Sempre que aparecer na documentação o termo __*PATH*__ ou __*DIR*__, se referirá ao caminho da pasta que você instalará o sistema. Ex: __*c:/sistemas/programação/clones/ControleDeEstoque;*__

O seu __*PATH*__ / __*DIR*__ será __*c:/sistemas/programação/clones/ControleDeEstoque;*__

## Requisitos

- PHP >7 (Recomendado o 8.0.13);
- PHP em variaveis de ambiente PATH;
- Um banco de dados( Recomendado MYSQL);

## Download

- Dentro do Repositorio no GitHub, procure o Button Code;
- Clique;
- Em seguida escolha entre fazer o CLONE, ou baixar o ZIP.
- Se for feito o ZIP, extraia ele.

### Clone do projeto
~~~bash  
  git clone https://github.com/LuriqueGon/ControleDeEstoque.git
~~~

## Configurações

- Vá até a pasta onde foi colocado os arquivos.
- Siga esse caminho :  \__DIR__ \vendor\MF\SQL;
- Abra o arquivo chamado  __*db-Estoque.sql*__;
- Copie Tudo.



#### Caso não queira copiar pelo arquivo, copie esse aqui 
    SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'; CREATE SCHEMA IF NOT EXISTS `estoque` DEFAULT CHARACTER SET utf8 ; USE `estoque` ; CREATE TABLE IF NOT EXISTS `estoque`.`usuarios`( `idUser` INT NOT NULL AUTO_INCREMENT, `Username` VARCHAR(120) NOT NULL, `Email` VARCHAR(120) NOT NULL, `Senha` VARCHAR(45) NOT NULL, `DataRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `Permissao` INT NOT NULL DEFAULT 1, `quantVendas` INT NOT NULL DEFAULT 0, `perfil` VARCHAR(200) DEFAULT "avatar.png", `ativo` BOOLEAN DEFAULT 1, PRIMARY KEY (`idUser`)) ENGINE = InnoDB; CREATE TABLE IF NOT EXISTS `estoque`.`produtos` ( `CodRefProduto` INT NOT NULL AUTO_INCREMENT, `NomeProduto` VARCHAR(120) NOT NULL, `usuarios_idUser` INT NOT NULL, `ativo` tinyint(1) DEFAULT 1, PRIMARY KEY (`CodRefProduto`), INDEX `fk_produtos_usuarios_idx` (`usuarios_idUser` ASC) VISIBLE, CONSTRAINT `fk_produtos_usuarios` FOREIGN KEY (`usuarios_idUser`) REFERENCES `estoque`.`usuarios` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB; CREATE TABLE IF NOT EXISTS `estoque`.`fabricantes` ( `idFabricante` INT NOT NULL AUTO_INCREMENT, `nomeFabricante` VARCHAR(120) NOT NULL, `CNPJFabricante` VARCHAR(120) NOT NULL, `EmailFabricante` VARCHAR(120) NOT NULL, `enderecoFabricante` VARCHAR(120) NOT NULL, `TelefoneFabricante` VARCHAR(120) NOT NULL, `ativo` tinyint(1) DEFAULT 1, `usuarios_idUser` INT NOT NULL, PRIMARY KEY (`idFabricante`), INDEX `fk_fabricantes_usuarios1_idx` (`usuarios_idUser` ASC) VISIBLE, CONSTRAINT `fk_fabricantes_usuarios1` FOREIGN KEY (`usuarios_idUser`) REFERENCES `estoque`.`usuarios` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB; CREATE TABLE IF NOT EXISTS `estoque`.`representantes` ( `idRepresentante` INT NOT NULL AUTO_INCREMENT, `nomeRepresentante` VARCHAR(120) NOT NULL, `telefoneRepresentante` VARCHAR(45) NOT NULL, `emailRepresentante` VARCHAR(120) NOT NULL, `fabricantes_idFabricante` INT NOT NULL, `ativo` tinyint(1) DEFAULT 1, `usuarios_idUser` INT NOT NULL, PRIMARY KEY (`idRepresentante`), INDEX `fk_representantes_fabricantes1_idx` (`fabricantes_idFabricante` ASC) VISIBLE, INDEX `fk_representantes_usuarios1_idx` (`usuarios_idUser` ASC) VISIBLE, CONSTRAINT `fk_representantes_fabricantes1` FOREIGN KEY (`fabricantes_idFabricante`) REFERENCES `estoque`.`fabricantes` (`idFabricante`) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT `fk_representantes_usuarios1` FOREIGN KEY (`usuarios_idUser`) REFERENCES `estoque`.`usuarios` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB; CREATE TABLE IF NOT EXISTS `estoque`.`itens` ( `idItens` INT NOT NULL AUTO_INCREMENT, `cdb` VARCHAR(20) NOT NULL, `descricao` VARCHAR(200) NOT NULL, `quantItens` INT NOT NULL, `quantItensVend` INT NOT NULL, `valCompItem` FLOAT(8,2) NOT NULL, `valVendItem` FLOAT(8,2) NOT NULL, `dataCompra` DATE NOT NULL, `dataVencItem` DATE NULL, `ativo` TINYINT NOT NULL DEFAULT 1, `produtos_CodRefProduto` INT NOT NULL, `fabricantes_idFabricante` INT NOT NULL, `usuarios_idUser` INT NOT NULL, PRIMARY KEY (`idItens`), INDEX `fk_itens_produtos1_idx` (`produtos_CodRefProduto` ASC) VISIBLE, INDEX `fk_itens_fabricantes1_idx` (`fabricantes_idFabricante` ASC) VISIBLE, INDEX `fk_itens_usuarios1_idx` (`usuarios_idUser` ASC) VISIBLE, CONSTRAINT `fk_itens_produtos1` FOREIGN KEY (`produtos_CodRefProduto`) REFERENCES `estoque`.`produtos` (`CodRefProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT `fk_itens_fabricantes1` FOREIGN KEY (`fabricantes_idFabricante`) REFERENCES `estoque`.`fabricantes` (`idFabricante`) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT `fk_itens_usuarios1` FOREIGN KEY (`usuarios_idUser`) REFERENCES `estoque`.`usuarios` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB; SET SQL_MODE=@OLD_SQL_MODE; SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS; SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS; INSERT INTO `usuarios` (`idUser`, `Username`, `Email`, `Senha`, `DataRegistro`, `Permissao`, `quantVendas`, `perfil`) VALUES (NULL, 'default', 'default@default.com', '21232f297a57a5a743894a0e4a801fc3', CURRENT_TIMESTAMP, '3', '0', DEFAULT); CREATE TABLE vendas ( idItemVenda INT NOT NULL PRIMARY KEY AUTO_INCREMENT, cdb VARCHAR(20) NOT NULL, quantidade INT NOT NULL, idUser INT NOT NULL, FOREIGN KEY (cdb) REFERENCES itens(cdb)); CREATE TABLE info_loja ( cep INT NOT NULL, estado VARCHAR(2) NOT NULL, cidade VARCHAR(120) NOT NULL, municipio VARCHAR(120) NOT NULL, numero VARCHAR(20) NOT NULL, endereco VARCHAR(120) NOT NULL, CNPJ VARCHAR(14) NOT NULL, IE VARCHAR(9), IM VARCHAR(7) ); CREATE TABLE historico ( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, cpf VARCHAR(11) NOT NULL, produtos TEXT NOT NULL, valorPago FLOAT(8,2) NOT NULL, MDP VARCHAR(50) NOT NULL, primeira_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP, ultima_compra TIMESTAMP NOT NULL, idUser INT NOT NULL ); CREATE TABLE clientes ( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, cpf VARCHAR(20) NOT NULL UNIQUE, telefone VARCHAR(20) NOT NULL, nome VARCHAR(120), primeira_compra TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ultima_compra TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, totalCompras INT NOT NULL DEFAULT 0 ); CREATE TABLE configs( meta INT NOT NULL, base INT NOT NULL ); INSERT INTO `configs` (`meta`, `base`) VALUES ('1', '1');

- Abra seu banco de dados;
- Cole o conteudo do arquivo dentro do seu SQL editor;
- Abra a pasta do sistema;
- Vá até App/Connection.php, e abra;
- Confirme se todos os dados batem com o seu banco;

- Volte até a main Path;
- Clique em __*IniciarSistema.bat*__
- O sistema irá abrir automaticamente o Chrome, com a url __*http://localhost:8080*__;

#### Iniciar Sistema 

~~~bash  
PATH /iniciarSistema.bat
~~~  
- Caso não funcione, abra o cmd;
- copie o caminho da path, exemplo: c:/ControleDeEstoque;
- Digite no cmd o comando __*cd*__;
- E cole no cmd o path, logo após adicione __*/public*__

#### Comando
~~~bash  
  cd PATH/public 
~~~
~~~bash  
  cd c:/ControleDeEstoque/public 
~~~

- logo após, digite o seguinte comando __*php -S localhost: (port)*__
- A porta precisa de uma atenção redobrada, póis existem portas que são usadas por padrão no Sistema.
- Recomendado usar a porta 8080 ou 5500;
- OBS: o __*-S*__, tem o S maiusculo;

#### Comando
~~~bash  
  php -S localhost:8080
~~~

- Acesse o sistema;


## Informações

O sistema já vem com um usuario DEFAULT, ele servirá para fazer a criação de outros usuarios posteriores no Sistema!!

__*Username:*__
~~~bash  
    default
~~~  
__*Senha:*__ 
~~~bash  
    admin
~~~  

- Após entrar com o usuario e senha padrão, você estará dentro do sistema;
- Você verá uma tela assim :

- ![NavBar](https://live.staticflickr.com/65535/52540041011_2620a7217c_n.jpg)  
- Cadastre primeiramente seu usuario Principal.
- Vá até usuarios, Cadastrar Usuario;
- preencha todas as informações, e clique em cadastrar;
- OBS: para ter acesso a todo o sistema, a permissão precisará ser de pelo menos __*Gerente*__;
- Após o cadastro, você estará na tela de Usuarios, exibirUsuarios;
- Nessa seção, delete o usuario Default, clicando na lixeirinha, ou desmarcando o checkbox;
- Clique em sair, no topo do menu;
- Acesse a nova conta Criada.

- Após criar a conta e adicionar uma imagem, você pode acha-la no sistema.
- Vá até a pasta public, Dist, img.
- A sua foto de perfil estará dentro de uma pasta com o nome do seu usuario e um nome gerado aleatoriamente, para evitar a sobreposição;

## Como funciona o Sistema ?

 O sistema funciona na base de que, todo estoque vai ser configurado com base em 4 coisas:

### 1-  Produto;
- Vai ser a base para adicionar os itens.
- Exemplo: Caneta;

#### adicionar produtos;
- Na guia produtos, clique em adicionar Produtos;
- Coloque um nome, Ex: caneta;
- Cadastre-o;
- Após isso, você será direcionado para a guia Produtos, Produtos;
- haverá uma tabela que mostrará todos os produtos;

- Tudo dentro do sistema, que for visualizavel como tabela, terá 2 ações;
- Editar e Deletar;
- Para deletar(desativar Temporariamente), existem dois modos.
    1. Selecione pelo checkbox, ou clicando na lixeira;
- Já para editar, basta clicar no lapís;
- caso clique, será redirecionado para tela de edição, aonde será quase identica a tela de adição;
#### 2 - Fabricante;

- Todo item, precisará ter um fabricante. 
- E todo fabricante precisará do seu representante.
- Faça o mesmo caminho que fez para cadastrar um produto, mas agora na guia fabricantes;
- Ex: Fabricante Bic, Representante Marcos Luccas;
- Após isso você terá a fabricante Bic, e o repesentante Marcos, cadastrados no seu Sistema;

#### 3 - Representante;

- Um fabricante pode ter varios Representantes. Pode ser um por setor, por item...
- Então você poderá cadastrar outros representantes para o mesmo fabricante;
- Ex: João também é um representante Bic agora;
- Futuramente, você também poderá adicionar um mesmo representante para varios fabricantes;
- Ex: João também representa a Fabercastel;

#### 4 - Item:

- Para cadastrar um fabricante é necessario um Representante;
- Para cadastrar um Item, é necessario um Produto, Fabricante e representante;
- Cadastre a __*caneta preta bic 1mm*__;
- Selecione o produto e o Fabricante;
- Informe o código de Barras (obs: atualmente o sistema só suporta o EAN-13, ou seja o código de barrasa precisa de 13 digitos);
- Ex: __*1234567891011*__
- A descrição do produto seria seu nome inteiro;
- Ex:  __*caneta preta 1mm*__;
- QuantItens é a quantidade de  __*canetas preta de 1mm*__ que o sistema está Adicionando agora;
- Adicione na ordem também, o valor de compra, valor de venda, data de compra (ANO - MES - DIA), e se tiver uma data de validade;
- Ex : 60 Itens -  0.75(R$) - 1.50(R$) - 2022/12/03;
- Após adicionar o primeiro item, o sistema fica mais completo para funcionalidades;
- Na tela de visualição dos itens, na tabela pode notar que:
    - você pode baixar em EXCEL, PDF ou imprimir um registro da tabela;
    - Também pode ver os lucros e prejuizos;

## Sistema do Vendedor:

- Tudo que foi visto nessa ultima sessão, somente pessoas com permissão acima de 3 (gerente, adm, Full) podem fazer adições;
- O vendedor, ele tem acesso geral a Gui __*CONTROLE DE VENDAS*__
- Na guia consultar, você receberá todas informações do item, cujo cód barras for informado;
- Vamos seguir para a guia __*Debitar Itens*__;
- Lá você seleciona o Item, e digita um valor. O valor digitado será adicionado como valor Vendido;
- Ex: debitar 10 do estoque;
- Se voltar para a guia Itens, irá ver que os itens vendidos, que antes eram 0, agora são 10;
- Voltando agora para a guia Itens, possui um campo lá, __*adicionar itens ao Estoque*__;
- Essa função serve para adicionar quantidade aos itens comprados;
- Outra função do sistema do Vendedor, é a de vender itens;
- Mas antes disso, nós precisamos adicionar as informações da loja.
    - Para isso, volte ao seu console SQL e digite:
    ~~~bash  
        INSERT INTO `info_loja` (`cep`, `estado`, `cidade`, `municipio`, `numero`, `endereco`, `CNPJ`, `IE`, `IM`) VALUES ('Insira o Seu CEP', 'Insira o Seu estado', 'Insira a Sua cidade', 'Insira o Seu municipio', 'Insira o numero da loja', 'Insira o complemento', 'Insira o Seu cnpj', 'Insira o Seu ie', 'Insira o seu im');
    ~~~  
    - E então confirme, para ter as informações do seu sistema;
    - Ex: __*INSERT INTO `info_loja` (`cep`, `estado`, `cidade`, `municipio`, `numero`, `endereco`, `CNPJ`, `IE`, `IM`) VALUES ('12345678', 'PE', 'Paulista', 'Paratibe', '65122', 'Uma casa', '00000000000000', '00000000', '000000');*__
- Após tudo, vá até a guia Vender Itens;
- Na parte inferior, estão dois inputs; 
- Caso não inserir quantidade, será contabilizada como 1;
- Efetue a compra de um Item;
- Digite o Cód Barras, da caneta, a quantidade 10, e adicione o item;
- Clique em finalizar Compras;
- Escolha o metodo de pagamento, e preencha as informações que precisar;
- Após finalizar a compra, você criara um Cliente, Historico, e indice de Venda;
- Se fechar essa guia, e voltar para a guia principal, e clicar no seu nome, irá pra seu Profile;
- Lá possui informações do Usuario, uma delas é quantas vendas ele efetuou;
- Lá você pode editar suas informações;
    - Essa seção serve principalmente para os vendedores, já que eles não tem acesso a editar usuarios pelo guia usuario;
- Se você for em Vedas, historico de Vendas, verá todas as vendas efetuada, separadas pelo cpf;

## Sistema de Clientes:

- Não tem muito oq falar, já que é bem auto explicativo cada guia dessa seção;
- Na guia __*Todos os clientes*__, você tem acesso ao cadastro de informações novas sobre o cliente, e também acesso ao historico de compras dele;


## Configs:

- primeiramente, clique em cofig, Configurações;
- Na versão 1, o sistema só tem 2 tipos de config.
- Primeiro a de setar __*Meta*__;
    - Seria meta de vendas dos Funcionarios;
- Segundo a de setar uma __*Base*__;
    - Que futuramente será para enviar notificações de itens que estejam, em estoque, com quantidades abaixo da Base. Para assim efetuar a reposição
- __*Insira a Base e a Meta*__;
- Vá até a guia Meta de Vendas;
- Nessa guia, mostra um grafico, onde todos os usuarios são análisados pelas suas vendas;
- A ultima configuração que não foi implementada ainda, é a de pagamento;
- Ela servirá para o pagamento dos funcionarios, para controlar todos os contra cheques e tals.
## License  
[MIT](https://choosealicense.com/licenses/mit/)  

## Credit
[AdminLTE](https://adminlte.io/)


### Conclusão

Esse ssitema usou um layout pre-made, o do AdminLTE. Foi ultilizado principalmente nas tabelas e na nav/side bar;
   
