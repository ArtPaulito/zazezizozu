<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$servername = "seu_servidor";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém o ID do funcionário autenticado
$username = $_SESSION['username'];
$sql = "SELECT id FROM employees WHERE username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$employee_id = $row['id'];

// Obtém o conteúdo específico do funcionário
$sql = "SELECT c.title, c.content FROM contents c INNER JOIN employee_content ec ON c.id = ec.content_id WHERE ec.employee_id = $employee_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdo</title>
</head>
<body>
    <h2>Conteúdo</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['content'] . "</p>";
        }
    } else {
        echo "Nenhum conteúdo disponível para este funcionário.";
    }
    ?>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>

<?php
$conn->close();
?>