<?php
require_once __DIR__ . '/includes/config.php';
role(['admin']);

$p = db();
$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check();

    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($current === '' || $new === '' || $confirm === '') {
        $error = 'Please complete all password fields.';
    } elseif (strlen($new) < 8) {
        $error = 'Your new password must contain at least 8 characters.';
    } elseif ($new !== $confirm) {
        $error = 'The new password and confirmation do not match.';
    } else {
        $s = $p->prepare('SELECT password_hash FROM users WHERE id = ? LIMIT 1');
        $s->execute([$_SESSION['user']['id']]);
        $user = $s->fetch();

        if (!$user || !password_verify($current, $user['password_hash'])) {
            $error = 'The current password is incorrect.';
        } elseif (password_verify($new, $user['password_hash'])) {
            $error = 'Choose a new password different from your current password.';
        } else {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $update = $p->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
            $update->execute([$hash, $_SESSION['user']['id']]);
            log_action('CHANGE_PASSWORD', 'Administrator changed own password');
            $msg = 'Your password has been changed successfully.';
        }
    }
}

head('Change Administrator Password');
?>
<h1>Change Administrator Password</h1>
<section class="panel" style="max-width:620px">
    <p class="muted">Update the password for your administrator account. Your new password must be at least 8 characters long.</p>
    <?php if ($msg): ?><p class="notice"><?=e($msg)?></p><?php endif; ?>
    <?php if ($error): ?><p class="notice" style="background:#fde8e8;color:#991b1b"><?=e($error)?></p><?php endif; ?>
    <form method="post" autocomplete="off">
        <input type="hidden" name="token" value="<?=e(token())?>">
        <label>Current password
            <input type="password" name="current_password" autocomplete="current-password" required>
        </label>
        <label>New password
            <input type="password" name="new_password" minlength="8" autocomplete="new-password" required>
        </label>
        <label>Confirm new password
            <input type="password" name="confirm_password" minlength="8" autocomplete="new-password" required>
        </label>
        <button type="submit">Update Password</button>
        <a class="button" href="index.php">Back to Dashboard</a>
    </form>
</section>
<?php foot(); ?>
