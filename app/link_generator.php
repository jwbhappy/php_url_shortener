<?php
class LinkGenerator {

    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function randomString(){
        return substr(md5(microtime()), rand(0, 26), 5);
    }

    // Генерация строки для короткой ссылки с проверкой уникальности в базе
    public function generateLink() {
        $query = "SELECT short_url FROM urls WHERE short_url = ?";
        $stmt = $this->db->prepare($query);
        $link_string = $this->randomString();
        $stmt->execute([$link_string]);
        while(count($stmt->fetchAll()) > 0){
            $link_string = $this->randomString();
            $stmt->execute($link_string);
        }
        return $link_string;
    }
}
?>