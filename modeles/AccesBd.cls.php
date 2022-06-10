<?php
    class AccesBd 
    {
        //connexion à la BD 
        //Proprietés de la clase
        private $pdo = null; //visibilité : public, protected //connexion PDO
        private $requete = null;  //requete parametre PDO
    
        //Constructeur(permet de configurer la connexion PDO)
        function __construct() 
        {   
            if(!$this->pdo) {
                $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
                $this->pdo = new PDO("mysql:host=".BD_HOTE."; dbname=".BD_NOM."; charset=utf8", 
                BD_UTIL, BD_MPD, $options);
            }
        }
    
        //methodes de la classe (Implementation de toutes les operations CRUD)        
        /**
         * Soumet une req paramentrée
         *
         * @param  mixed $sql Reuqete
         * @param  mixed $params Tab de parametres utilises dans la requete
         * @return void
         */
        protected function soumettre($sql, $params = [])
        {
            $this->requete = $this->pdo->prepare($sql);
            $this->requete->execute($params);
        }
       /**
        * Obtenir un jeu d'enregistrement de la BD
        * @param string $sql Requete
        * @param array $params de la requete
        * @return array   
        */
        protected function lire($sql, $params = [])
        {
            $this->soumettre($sql, $params);

            //$enregistrements = [];
            //while($enreg = $this->requete->fetch()) {
              //  $enregistrements[$enreg->cat_nom][] = $enreg;
            //}
            return $this->requete->fetchAll(PDO::FETCH_GROUP);
        }
        
    
        public function creer($sql, $params) 
        {
            $this->soumettre($sql, $params);
            return $this->pdo->lastInsertId();
        }
    
        public function modifier($sql, $params) 
        {
            $this->soumettre($sql, $params);
            return $this->requete->rowCount();
        }
    
        public function supprimer() 
        {
            
        }
    
    }
?>