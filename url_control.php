<?php
include 'config.php';
include 'link_generator.php';

$url = $_POST['orig_url'];

if(!empty($url) && filter_var($url, FILTER_VALIDATE_URL)) {
    $generator = new LinkGenerator($db);
    $random_link = $generator->generateLink();

    // Добавление сгенерированной короткой ссылки в базу данных
    $query = "INSERT INTO urls (short_url, orig_url) VALUES (:short_url, :orig_url)";
    $stmt = $db->prepare($query);
    $params = array("short_url"=>$random_link,"orig_url"=>$url);
    if($result = $stmt->execute($params)) {
        echo $random_link;
    } else {
        echo 'Something went wrong';
    }
} else {
    echo 'This is not valid URL';
}
?>
