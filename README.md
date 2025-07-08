
# 🔐 Login Inseguro vs Seguro – Estudo sobre SQL Injection

Este repositório contém um exemplo prático comparando duas abordagens comuns em sistemas de login com PHP e MySQL:

- `inseguro/login_inseguro.php`: versão vulnerável a SQL Injection
- `seguro/login_seguro.php`: versão protegida com PDO e prepared statements

---

## 🚨 Código Inseguro: login_inseguro.php

```php
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
```

### ❗ Problema:
Essa abordagem **concatena diretamente os dados inseridos pelo usuário na consulta SQL**, sem qualquer tipo de validação ou proteção.

### 🔓 Risco:
Um invasor pode inserir comandos maliciosos, como:

- **Usuário:** `admin`
- **Senha:** `' OR '1'='1`

E a consulta gerada será:

```sql
SELECT * FROM usuarios WHERE usuario = 'admin' AND senha = '' OR '1'='1'
```

Esse `OR '1'='1'` **sempre retorna verdadeiro**, permitindo acesso indevido ao sistema **sem senha válida**. Além disso, se o sistema permitir múltiplas instruções (multi-statements), um atacante mais experiente poderia até **excluir dados, vazar tabelas ou injetar novos comandos SQL**.

---

## ✅ Código Seguro: login_seguro.php

```php
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
$stmt->execute([$usuario, $senha]);
```

### 🔐 Proteção com `prepared statements`:
- A consulta é **preparada antes dos dados do usuário serem inseridos**.
- Os dados são enviados **de forma separada**, impedindo que o SQL seja manipulado.
- Isso **neutraliza completamente** tentativas de injeção.

---

## 🛡️ Conclusão

Sempre utilize **PDO com prepared statements** ou bibliotecas/frameworks que abstraem isso de forma segura. Nunca confie em dados vindos do usuário sem validação e proteção adequadas.

> Este exemplo é didático e serve para reforçar boas práticas no desenvolvimento web. Use com responsabilidade.

---

👨‍💻 Criado por Uilton Gomes – Foco no aprendizado e segurança da informação
