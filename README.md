
##### Sobre o Projeto
É um CRUD simples totalmente desenvolvido em PHP, onde é possível Criar/Editar/Excluir/Listar usuários. Também possui um sistema de vincular/desvincular várias cores ao usuário. 

Além disso, foi implantado uma validação de email, portanto o email deve ser no seguinte formato: `email.examplo.com`.

O projeto faz parte da seguinte proposta: https://github.com/dlimars/prova-php-entrevista

##### Estrutura de banco de dados
A seguinte estrutura foi utilizada:

```sql
    tabela: users
        id      int not null auto_increment primary key
        name    varchar(100) not null
        email   varchar(100) not null
```
```sql
    tabela: colors
        id      int not null auto_increment primary key
        name    varchar(50) not null
```
```sql
    tabela: user_colors
        color_id  int
        user_id   int
```

##### Start
Este projeto conta com uma base sqlite com alguns registros já inseridos. Para início das atividades, use como base o arquivo `index.php`.

##### Interface
- Apresentação da interface (Foi utilizado o frameworks CSS Bootstrap e ícones do Material Design)

##### Mais Informações
- Para utilizar o banco de dados contido na pasta `database/db.sqlite` é necessário que a instalação do php tenha a extensão do sqlite instalada e ativada
- O Php possui um servidor embutido, você consegue dar start ao projeto abrindo o terminal de comando na pasta baixada e executando `php -S 0.0.0.0:7070` e em seguida abrir o navegador em `http://localhost:7070`.
