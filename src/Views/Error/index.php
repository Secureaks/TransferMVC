<?php include_once __DIR__ . '/../Commons/base_header.php'; ?>

    <h3>Error:</h3>
    <pre><?= htmlspecialchars($message ?? '', ENT_QUOTES) ?></pre>

<?php include_once __DIR__ . '/../Commons/base_footer.php'; ?>