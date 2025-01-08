<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'supermarket');

// Verifica se a conexão falhou
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Verificar se o email existe no banco de dados
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar se a senha está correta
    if (password_verify($senha, $user['senha'])) {
        // Armazena informações na sessão
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];

        // Redireciona para a página inicial ou dashboard
        echo "<script>
            alert('Login realizado com sucesso!');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        // Senha incorreta
        echo "<script>
            alert('Senha incorreta. Tente novamente.');
            window.location.href = 'login.php';
        </script>";
        exit();
    }
} else {
    // Email não encontrado
    echo "<script>
        alert('Email não cadastrado.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

$stmt->close();
$conn->close();
?>
