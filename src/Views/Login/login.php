<?php include_once __DIR__ . '/../Commons/base_header.php'; ?>

<h2>Login</h2>

<form action="/login_check" method="post">
    <div>
        <label>
            Email:
            <input type="email" name="email" required <?php if (isset($email)): ?>value='<?= htmlspecialchars($email) ?>'<?php endif; ?> />
        </label>
    </div>
    <div>
        <label>
            Password:
            <input type="password" name="password" required />
        </label>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
    <input type="hidden" name="csrf" value="<?= $csrf ?? '' ?>" />
</form>

<div>
    <?php if (isset($error)): ?>
        <div>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../Commons/base_footer.php'; ?>
