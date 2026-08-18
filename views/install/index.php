<?php
$error = isset($_GET['error']) ? trim($_GET['error']) : '';
$pageTitle = 'نصب پروژه';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - دیجیتو</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Tahoma, Arial, sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e2e8f0;
        }
        .card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 1rem;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.4);
        }
        h1 {
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .sub {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 0.9rem;
            color: #cbd5e1;
        }
        input {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 0.5rem;
            background: rgba(15,23,42,0.6);
            color: #f1f5f9;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }
        input::placeholder {
            color: #64748b;
        }
        .btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .btn:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .alert-error {
            background: rgba(239,68,68,0.2);
            border: 1px solid rgba(239,68,68,0.4);
            color: #fca5a5;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>نصب پروژه دیجیتو</h1>
        <p class="sub">اطلاعات اتصال دیتابیس را وارد کنید.</p>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <input type="hidden" name="install_step" value="db">
            <label for="db_host">هاست دیتابیس</label>
            <input type="text" id="db_host" name="db_host" value="<?= isset($_POST['db_host']) ? htmlspecialchars($_POST['db_host']) : 'localhost' ?>" placeholder="localhost" required>

            <label for="db_name">نام دیتابیس</label>
            <input type="text" id="db_name" name="db_name" value="<?= isset($_POST['db_name']) ? htmlspecialchars($_POST['db_name']) : 'digito' ?>" placeholder="digito" required>

            <label for="db_username">نام کاربری</label>
            <input type="text" id="db_username" name="db_username" value="<?= isset($_POST['db_username']) ? htmlspecialchars($_POST['db_username']) : 'root' ?>" placeholder="root" required>

            <label for="db_password">رمز عبور</label>
            <input type="password" id="db_password" name="db_password" value="<?= isset($_POST['db_password']) ? htmlspecialchars($_POST['db_password']) : '' ?>" placeholder="خالی بگذارید اگر رمزی ندارید">

            <button type="submit" class="btn">اعتبارسنجی و نصب</button>
        </form>
    </div>
</body>
</html>
