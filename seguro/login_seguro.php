
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_votacoes";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Falha na conexão.";
    exit;
}

$usuario = trim($_POST['usuario'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if (empty($usuario) || empty($senha)) {
    echo 'Campos vazios. Por favor, preencha todos os campos.';
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->execute([$usuario, $senha]);

    if ($stmt->rowCount() > 0) {
        echo 'Login efetuado com sucesso!';
    } else {
        echo 'Usuário ou senha inválidos!';
    }
} catch (PDOException $e) {
    echo 'Erro no login!';
}
?>
