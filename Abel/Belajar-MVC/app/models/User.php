<?php
class User
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }



    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan array dari semua pengguna
    }

    public function insertUser($id, $name, $email)
    {
        $stmt = $this->db->prepare("INSERT INTO users (id, name, email) VALUES (:id, :name, :email)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        // $stmt->bindParam(':foto', $foto);
        return $stmt->execute();
    }
    public function updateUser($id, $name, $email) {
        // Menyiapkan query SQL untuk update
        $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    
        // Mengikat parameter
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        
        // Eksekusi dan kembalikan hasil
        return $stmt->execute();
    }

    public function deleteUser($id, $name, $email) {
        // Menyiapkan query SQL untuk update
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
    
        // Mengikat parameter
        $stmt->bindParam(':id', $id);
        
        
        // Eksekusi dan kembalikan hasil
        return $stmt->execute();
    }
    

        // UPDATE `users` SET `name` = 'Wahyuidi5' WHERE `users`.`id` = '1234'
    }
    

