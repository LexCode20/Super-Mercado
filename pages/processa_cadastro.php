<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'supermarket');

// Verifica se a conexão falhou
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$numero = $_POST['numero'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$foto = $_FILES['foto']['name'];

// Upload da foto
$uploadDir = 'uploads/';
$uploadFile = $uploadDir . basename($_FILES['foto']['name']);
if (!move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
    die("Erro ao fazer upload da foto.");
}

// Verifica se o email já está cadastrado
$sqlCheck = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sqlCheck);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email já cadastrado
    echo "<script>
        alert('O email já está cadastrado! Tente outro.');
        window.location.href = 'cadastro.html';
    </script>";
    exit();
}

// Inserir os dados no banco
$sqlInsert = "INSERT INTO usuarios (nome, email, numero, senha, foto) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("sssss", $nome, $email, $numero, $senha, $foto);

if ($stmt->execute()) {
    echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href = 'login.php';
    </script>";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
