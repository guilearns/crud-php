<?php

function pegarUserId() {

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        return $userid = $_GET["id"];

    } else {
        
        return $userid = $_POST["id"];

    }

}


#######################################################
# As funções abaixo são utilizadas no arquivo criar_usuario.php #
#######################################################


function addUsuarioNoDB($nome, $email) {
    
    $connection = new Connection();

    $prepInser = $connection->getConnection()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

    $prepInser->bindParam(':name', $nome);
    $prepInser->bindParam(':email', $email);

    $prepInser->execute();

}

function verificarExistenciaDoEmail($emailFornecido) {
    
    $connection = new Connection();

    $prepStm = $connection->getConnection()->prepare("SELECT email FROM users WHERE email = :emailFornecido");

    $prepStm->bindParam(':emailFornecido', $emailFornecido);

    $prepStm->execute();

    return $resultado = $prepStm->fetch();

}

function validarEmail($emailJaExiste) {

    if('POST' && $emailJaExiste == 'nao') {

        echo "

            <div class='alert alert-success' role='alert'>
                Usuário criado com Sucesso!
            </div>

        ";

    } elseif ($emailJaExiste == 'sim') {

        echo "

            <div class='alert alert-danger' role='alert'>
                O email utilizado já existe!
            </div>

        ";
        
    } elseif ($emailJaExiste == 'erro') {

        echo "

            <div class='alert alert-danger' role='alert'>
                É necessário preencher os dois campos e o email deve estar no seguinte formato: email@exemplo.com
            </div>

        ";

    }

}


#######################################################
# As funções abaixo são utilizadas no arquivo editar.php #
#######################################################


function verificarExistenciaDaCor($connection, $userid, $color_id, $message) {

    $prepStm = $connection->getConnection()->prepare("SELECT color_id FROM user_colors WHERE user_id = :userid AND color_id = :color_id");

    $prepStm->bindParam(':userid', $userid);
    $prepStm->bindParam(':color_id', $color_id);

    $prepStm->execute();

    $resultado = $prepStm->fetch();
    
    if(!empty($resultado)) { print_r($message); } 

}

function vincularCor($connection, $userid, $color_id) {

    if(is_numeric($color_id)) {
        verificarExistenciaDaCor($connection, $userid, $color_id, "<div class='alert alert-danger mt-3 text-center' role='alert'>
            Essa cor já foi vinculada ao usuário.
        </div>");
    }

    $prepInser = $connection->getConnection()->prepare("INSERT INTO user_colors (color_id, user_id)
    SELECT * FROM (SELECT :color_id, :userid) AS tmp
    WHERE NOT EXISTS (
        SELECT color_id, user_id FROM user_colors WHERE color_id = :color_id AND user_id = :userid) LIMIT 1");

    $prepInser->bindParam(':color_id', $_POST["color_id"]);
    $prepInser->bindParam(':userid', $userid);

    $prepInser->execute();

}


?>