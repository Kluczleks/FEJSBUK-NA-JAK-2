<?php
class User {
    //klasa user ma zawierać wszystkie informacje i czynności związane z użytkownikiem portalu
    //modelem w bazie danych jest tabela user

    static function Register(string $email, string $password) : bool {
        //poniższa funkcja odpowiada za dodanie użytkownika do właściwej tabeli w bazie danych
        //user{id INT, email VARCHAR(128), password VARCHAR(128)}

        //skonwertuj hasło do hasha
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);


        //połączenie do bazy danych
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        //kwerenda do bazy danych
        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";
        //zapytanie
        $q = $db->prepare($sql);
        //podstaw dane
        $q->bind_param("ss", $email, $passwordHash);

        //wyślij zapytanie
        $result = $q->execute();
        //zwróć wynik rejestracji
        if(!$result)
            return false;
        return $result;
    }static function Login(string $email, string $password)
    {
        //połączenie do bazy danych
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        $sql = "SELECT * FROM user WHERE = ?";
        $q = $db->prepare($sql);
        $q->bind_param("s",$email);
        $result = $q->execute();
        $row = $q->get_result()->fetch_assoc();
        if(password_verify($password,$row['password'])){
            return true;
        }else
        return false;
            {
       
    }
}
}
?>