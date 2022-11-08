<?php

class ClasseCompte{
    public $idCompte;
    public $email;
    public $password;
    public $image;
    public $username;
    public $nb_projets;
    
    function __construct() {   
    }
    
    public static function construct2(array $row){
        $instance = new self();
        $instance->idCompte = $row['id_compte'];
        $instance->email = $row['email'];
        $instance->password = $row['password'];
        if($row['image']==""){
            $instance->image ="profile.jpg";
        }else{
            $instance->image = $row['image'];
        };
        $instance->username = $row['username'];
        $instance->nb_projets = $row['nb_projets'];
        return $instance;
    }   
    
}
?>
