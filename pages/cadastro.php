<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redireciona para o login se não estiver logado
    exit();
}

$nome_usuario = $_SESSION['usuario_nome'];
$imagem_perfil = $_SESSION['usuario_imagem'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header>
        <!-- Cabeçalho com menu e logo -->
        <div class="menu-container">
            <div id="logo">
                <img src="../img/img-alex.jpg" alt="Logo">
            </div>
            <div id="menu-toggle" class="fas fa-bars"></div>
            <div class="search-container">
                <input type="text" placeholder="O que você procura?">
                <i class="fas fa-search"></i>
            </div>
            <ul class="menu">
                <li class="info">
                    <a href="cadastro-login.html?">
                        <i class="fas fa-user"></i> 
                    </a>
                    <a href="login.php" class="link">Entre</a> ou 
                    <a href="cadastro.php" class="link">Cadastre-se</a>
                </li>
                <li class="info">
                    <a href="">
                        <i class="fas fa-heart"></i> Meus Favoritos
                    </a>
                </li>
                <li class="info">
                    <a href="">
                        <i class="fas fa-shopping-cart"></i> Meu Carrinho
                    </a>
                </li>
                <li class="info">
                    <a href="">
                        <i class="fas fa-phone"></i> Contato
                    </a>
                </li>
                <li class="info">
                    <a href="">
                        <i class="fas fa-map-marker-alt"></i> Localização
                    </a>
                </li>
                <li id="perfil">
                    <!-- Exibir o nome e a imagem de perfil do usuário -->
                    <div class="perfil-container">
                        <img src="<?php echo $imagem_perfil; ?>" alt="Foto do Usuário" class="perfil-img">
                        <span class="perfil-nome"><?php echo $nome_usuario; ?></span>
                    </div>
                </li>
                <li class="exit">Sair</li>
            </ul>
            <ul class="icon-hidden">
                <li><a href="cadastro-login.html"><i class="fas fa-user"></i></a></li>
                <li><a href=""><i class="fas fa-heart"></i></a></li>
                <li><a href=""><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href=""><i class="fas fa-phone"></i></a></li>
                <li id="location">
                    <a href="">
                        <i class="fas fa-map-marker-alt"></i>
                    </a>
                </li>
                    <div class="location-text">
                        <p>Entregar em</p>
                        <span>São Paulo</span>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <form action="processa_cadastro.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <h2>CADASTRO</h2>
                <input class="inp" type="text" name="nome" placeholder="Nome" required>
                <input class="inp" type="email" name="email" placeholder="Email" required>
                <input class="inp" type="number" name="numero" placeholder="Número" required>
                <input class="inp" type="password" name="senha" placeholder="Senha" required>
                <input class="inp" type="file" name="foto" required>
                <button type="submit">Cadastrar</button>
            </fieldset>
        </form>        
    </main>
    <script src="../js/burguer.js"></script>
    <style>
        main{
            display: flex;
        }
        fieldset{
            width: 50vw;
            /*height: 30vh;*/
            padding: 3vh;
            position: absolute;
            margin-left: 50vw;
            margin-top: 35vh;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 5px;
        }
        h2{
            color: gray;
            text-align: center;
        }
        @media(max-width: 887px){
            fieldset{
                width: 70vw;
            }
            
        }
        .inp{
            padding: 10px;
            background-color: #f6f6f6;
            border: none;
            display: block;
            margin: 10px;
            width: 93%;
            cursor: pointer;
        }
        .inp:hover{
            margin-top: 10px;
            background-color: #f0f0f0;
            transition: .5s;
        }
        button{
            padding: 5px;
            background-color: gray;
            color: white;
            cursor: pointer;
        }
    </style>
</body>
</html>
