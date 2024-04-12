<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message,
        .error-message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 20px;
            border-radius: 4px;
            z-index: 9999;
            animation: popupFadeInOut 3s ease forwards;
        }

        @keyframes popupFadeInOut {
            0% {
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
<?php
$correct_credentials = array(

    "Maria Santos" => "marisantos2024",
    "João Silva" => "silvaceo2024"
);

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        if (array_key_exists($username, $correct_credentials) && $correct_credentials[$username] === $password) {
            $success_message = "Login bem-sucedido!";
        } else {
            $error_message = "Credenciais incorretas. Por favor, tente novamente.";
            echo "<script>showErrorPopup('$error_message');</script>";
        }
    } else {
        $error_message = "Por favor, preencha todos os campos.";
    }
}
?>
<div class="login-container">
    <h2>Login</h2>
    <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Usuário:</label>
        <select id="username" name="username" required>
            <option value="Maria Santos">Maria Santos</option>
            <option value="João Silva">João Silva</option>
        </select>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Entrar</button>
        <a href="#error-message" id="auto-anchor" style="display: none;"></a>
    </form>
    <?php if ($success_message): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
        <a href="login.html">Ir para Outra Página</a>
    <?php endif; ?>
    <?php if ($error_message): ?>
        <div class="error-message" id="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
</div>

<script>
    function showErrorPopup(message) {
        var popup = document.createElement('div');
        popup.className = 'popup';
        popup.textContent = message;
        document.body.appendChild(popup);
        setTimeout(function() {
            popup.style.display = 'none';
        }, 3000);
        document.getElementById('auto-anchor').click();
    }
</script>

</body>
</html>