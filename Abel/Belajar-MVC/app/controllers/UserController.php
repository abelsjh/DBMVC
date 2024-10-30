<?php
require_once 'app/models/User.php';

class UserController
{
    private $userModel;

    public function __construct($dbConnection)
    {
        $this->userModel = new User($dbConnection);
    }

    public function show($id)
    {
        // Fetch user by ID (optional, you might want to implement this)
        // $user = $this->userModel->getUserById($id);
        $users = $this->userModel->findAll();
        require_once 'app/views/userView.php';
    }
    
    public function store()
    {
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            

            

            // Insert user into the database
            $stmt = $this->userModel->insertUser($id, $name, $email);
            if ($stmt) {
                header("Location: index.php?controllers=UserController&action=show");
            } else {
                // Handle error
                echo "Error saving data.";
            }
        }
    }
    public function update()
    {
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            // Insert user into the database
            $stmt = $this->userModel->updateUser($id, $name, $email);
            if ($stmt) {
                header("Location: index.php?controllers=UserController&action=show");
            } else {
                // Handle error
                echo "Error saving data.";
            }
            // dd($id,$name,$email);
        }
    }

    public function delete()
    {
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            // Insert user into the database
            $stmt = $this->userModel->deleteUser($id, $name, $email);
            if ($stmt) {
                header("Location: index.php?controllers=UserController&action=show");
            } else {
                // Handle error
                echo "Error saving data.";
            }
            // dd($id,$name,$email);
        }
    }

}

    

