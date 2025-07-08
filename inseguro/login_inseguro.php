
<?php
$pdo = new PDO('mysql:host=localhost;dbname=sistema_votacoes', 'root', '');
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
$result = $pdo->query($sql);

if ($result && $result->rowCount() > 0) {
    echo "Login bem-sucedido (inseguro)!";
} else {
    echo "Usuário ou senha inválidos!";
}
?>
