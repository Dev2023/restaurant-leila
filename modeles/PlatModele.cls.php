<?php
class PlatModele extends AccesBd 
{
	//Cherche tous les plats vins groupés par nom de categorie
	public function tout() {
		$sql = "SELECT cat_nom, plat.* FROM plat JOIN categorie ON pla_cat_id_ce = cat_id WHERE cat_type = 'plat' ORDER BY cat_id";
		
		return $this->lire($sql, []);
	}

	public function ajouter() {

	}

	public function changer() {

	}

	public function retirer() {
		
	}

}
