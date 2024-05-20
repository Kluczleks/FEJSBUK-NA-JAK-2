<?php
class Profile {
    private int $_id;
    private int $_userID;
    private string $_firstName;
    private string $_lastName;
    private int $_profilePhotoID;

    public function __construct(int $id, int $userID, string $firstName, string $lastName, int $profilePhotoID)
    {
        $this->_id = $id;
        $this->_userID = $userID;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_profilePhotoID = $profilePhotoID;
    }

    static function Get($id) : Profile {
        //pobierz jeden profil po jego ID
        //zwróć obiekt Profile
        //połączenie do bazy danych
        $db = new mysqli('localhost', 'root', '', 'friendbook');
        //kwerenda do bazy danych
        $sql = "SELECT * FROM profile WHERE ID=? LIMIT 1";
        $q = $db->prepare($sql);
        $q->bind_param("i", $id);
        $q->execute();
        $result = $q->get_result();
        $row = $result->fetch_assoc();
        $p = new Profile($row['ID'], $row['userID'], $row['firstName'], $row['lastName'], $row['profilePhotoID']);
        return $p;
    }
}

?>