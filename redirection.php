<?php
$reserved_uris = array('/index.php', '/', '/?i=', '/login.php', '/signup.php');

// Преобразование красивого URL, без '?i=', в некрасивый, чтобы короткая ссылка попала в $_GET 

if(!in_array($_SERVER['REQUEST_URI'], $reserved_uris)){
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "?i=" . (substr($_SERVER['REQUEST_URI'], 1)));
}

// Редирект на оригинальный URL

if(isset($_GET['i'])) {
    $query = "SELECT orig_url FROM urls WHERE short_url = ?";
    $stmt = $db->prepare($query);
    $orig_url = $stmt->execute([$_GET['i']]);
    $location = $stmt->fetchAll()[0][0] ?? '';
    header('Location: ' . $location);
}
?>
