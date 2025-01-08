<?php
session_start(); // Inicia a sessão

if (!isset($_SESSION['email'])) {
    echo "Usuário não está logado.";
    exit(); // Interrompe o script se o usuário não estiver logado
}

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'supermarket');

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Buscar os dados do usuário
$email = $_SESSION['email']; // O email do usuário logado
$sql = "SELECT foto FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<img src='" . $row['foto'] . "' alt='Foto de Perfil' class='perfil-img'>";
} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>
