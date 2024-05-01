<?php
set_include_path(dirname(__FILE__) . "/../");
require 'mongodbphp/vendor/autoload.php';

use MongoDB\Driver\ServerApi;



/*
$collection->insertOne([
    'Borrower'=>35,
    "Loan"=>45000,
    "interest_rate"=> 3,
]);
/*
$collection->deleteOne([
    'Borrower'=>34,
]);*/
/*$collection->updateOne([
    'Borrower'=>1],
    ['$set' => ["Loan" => 69]]
);*/

class Model
{
    function OpenCon()
    {
        $uri = 'mongodb+srv://ashiq:ashiq@cluster0.1vw1o0y.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
        $apiVersion = new ServerApi(ServerApi::V1);
        $conn = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
        return $conn;
    }
    function autoIncrement($conn)
    {
        $collection = $conn->online_health->counter;
        $cursor = $collection->find();
        foreach ($cursor as $document) {
            $count = (int)$document["p_id"];
        }
        $collection->updateOne(
            [
                'p_id' => $count
            ],
            ['$set' => ["p_id" => $count + 1]]
        );
        return $count;
    }

    function AddPatient($conn, $name, $email, $password, $gender, $phone, $dob, $martial, $address)
    {
        $count = $this->autoIncrement($conn);
        $collection = $conn->online_health->patient;
        $cursor = $collection->insertOne([
            'p_id' => $count + 1,
            'name' => $name,
            "email" => $email,
            "password" => $password,
            'gender' => $gender,
            'phone' => $phone,
            'dob' => $dob,
            'marital' => $martial,
            'address' => $address
        ]);
        return $cursor->getInsertedCount();
    }
    function login($conn, $email, $password)
    {
        $collection = $conn->online_health->patient;
        $cursor = $collection->findOne([
            'email' => $email,
            'password' => $password,
        ]);
        return $cursor;
    }
    function ShowProfile($conn, $email)
    {
        $collection = $conn->online_health->patient;
        $cursor = $collection->findOne([
            'email' => $email,
        ]);
        return $cursor;
    }
    function checkEmail($conn, $email){
        return $this->ShowProfile($conn, $email);       
    }
    function UpdateUser($conn, $email, $name, $phone, $password)
    {
        $sql = "UPDATE patient SET name='$name', phone='$phone', password='$password'  WHERE email='$email'";
        return $conn->query($sql);
    }
    function UploadDocument($conn, $email, $photo, $nid, $medical)
    {
        $sql = "INSERT INTO documents (email, photo, nid, medical) VALUES ('$email', '$photo', '$nid', '$medical')";
        return $conn->query($sql);
    }
}