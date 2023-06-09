<?php

/* Class Pension */

class Pension{
    const errmessage = "Une erreur s'est produite \n";

    /*Propriété */
    private int $tarif;
    private int $duree;
    private string $date_de_debut;
    private string $libelle;
    private string $id_cheval;
    
    
    /*Constructor */
    public function __construct($letarif, $laduree, $date, $lelibelle, $id_c) {
        $this->tarif=$letarif;
        $this->duree=$laduree;
        $this->date_de_debut=$date;
        $this->libelle=$lelibelle;
        $this->id_cheval=$id_c;
    }
    
    
    /*Setter */
    public function setTarif($letarif){
        $this->tarif=$letarif;
    }
    
    public function setDuree($laduree){
        $this->duree=$laduree;
    }
    
    public function setDate_de_debut($date){
        $this->date_de_debut=$date;
    }
    
    public function setLibelle($lelibelle) {
        $this->libelle=$lelibelle;
    }
    
    public function setId_Cheval($id_c) {
        $this->id_cheval=$id_c;
    }
    
    /*Getter */
    public function getTarif(){
        return $this->tarif;
    }
    
    public function getDuree(){
        return $this->duree;
    }
    
    public function getDate_de_debut(){
        return $this->date_de_debut;
    }
    
    public function getLibelle(){
        return $this->libelle;
    }
    
    public function getId_Cheval() {
        return $this->id_cheval;
    }
    
    /*Fonction */
    public function get_all(){
        global $con;
        
        $req="SELECT * FROM ".DB_TABLE_PENSION;
        try{
            $sql=$con->query($req);
            return $sql->fetchAll (PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            return $e->getMessage();
        }        
    }
}