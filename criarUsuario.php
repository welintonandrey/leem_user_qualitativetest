<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('user.php');
require_once('videoOriginal.php');
require_once('videoFiltrados.php');
require_once('testeUsuario.php');

if (isset($_POST["email"]) && isset($_POST["password1"]) && isset($_POST["password2"]) &&
        isset($_POST["name"]) && isset($_POST["type"])) {
    
    if(strcmp(trim($_POST["name"]), "") == 0){
        $_SESSION['msg']['reg-err'] = "Name can't be empty";
        header('Location: ./newUser.php');
        exit();
    }
    
    if(strcmp(trim($_POST["email"]), "") == 0){
        $_SESSION['msg']['reg-err'] = "Email can't be empty";
        header('Location: ./newUser.php');
        exit();
    }
    
    if(strcmp(trim($_POST["password1"]), "") == 0){
        $_SESSION['msg']['reg-err'] = "Password can't be empty";
        header('Location: ./newUser.php');
        exit();
    }
    
    if(strlen($_POST["password1"]) < 6){
        $_SESSION['msg']['reg-err'] = "Password must contain at least 6 characters";
        header('Location: ./newUser.php');
        exit();
    }
    
    if(strcmp($_POST["password1"], $_POST["password2"]) != 0){
        $_SESSION['msg']['reg-err'] = "Passwords must be equals";
        header('Location: ./newUser.php');
        exit();
    }

    $email    = trim($_POST["email"]);
    $password = $_POST["password1"];
    $name     = $_POST["name"];
    $type     = $_POST["type"];

    $user = User::selectByEmail($email);
    if(strcmp($user->getEmail(), $email) == 0){
        $_SESSION['msg']['reg-err'] = "User already exists in our database";
        header('Location: ./newUser.php');
        exit(); 
    }
    
    //cria novo usuário
    $user = new User($email, $password, $name, $type, -1);
    if($user->insert() == FALSE){
        $_SESSION['msg']['reg-err'] = "User already exists in our database";
        header('Location: ./newUser.php');
        exit();
    }

    $assunto = "New User";
    $to = $email;
    $from = "welintonandrey@gmail.com";
    $mensagem = " Name: " . $name . "\n" 
            . "Email: " . $email  . "\n" 
            . "Password: " . $password; 
    
    $headers = 'From: ' . $from . "\r\n" . //CABEÇALHO DA MENSAGEM
            'Reply-To: ' . $from . '' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    $result = mail($to, $assunto, $mensagem, $headers);    //ENVIA A MENSAGEM

    //seleciona todos os videos originais
    $videosOrignais = videoOriginal::selectAll();
    //embaralha os videos originais recuperados
    shuffle($videosOrignais);

    //para cada video original
    foreach ($videosOrignais as $vo) {
        //seleciona todos os videos filtrados de cada video original
        $videosFiltrados = videoFiltrados::selectByOriginalVideoId($vo->getId());
        //embaralha os videos filtrados
        shuffle($videosFiltrados);

        //percorre o vetor de videos filtrados de 4 em 4
        for ($i = 0; $i < sizeof($videosFiltrados); $i = $i + 4) {
            $testeUsuario = new testeUsuario($user->getEmail(), 
                    0,
                    $vo->getId(), 
                    $videosFiltrados[$i]->getId(), 
                    $videosFiltrados[$i + 1]->getId(), 
                    $videosFiltrados[$i + 2]->getId(), 
                    $videosFiltrados[$i + 3]->getId(), 
                    null);
            $testeUsuario->insert();
        }
        $testeUsuario = new testeUsuario($user->getEmail(), 1, $vo->getId(), null, null, null, null, null);
        $testeUsuario->insert();
    }
    
    $tu = testeUsuario::selectFirstTest($user->getEmail());
    $user->setCurrentTest($tu->getId());
    $user->update();
    
    $_SESSION['msg']['reg-success'] = "Usuario criado com sucesso!!!";
    header('Location: ./index.php');
    exit();
}
