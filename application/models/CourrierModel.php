<?php

/**
 * User: Edgar AYENA
 * Date: 13/12/2018
 * ayenadedg@gmail.com
 * +229 95 80 53 26
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class CourrierModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function deleteExpediteur($id)
	{
		$data1 = array(
			'supprimer_exp' => 0
		);
		$this->db->where('id_exp', $id);
		$this->db->update('expediteur', $data1);
	}

	function deletedossier($id,$surccusale)
	{
		$data1 = array(
			'supprimer_dos' => 0,
			'fki_suc_dos' => $surccusale
		);
		$this->db->where('id_dossier', $id);
		$this->db->update('dossier', $data1);
	}

	function deletetype($id,$surccusale)
	{
		$data1 = array(
			'supprimer_typ' => 0,
			'fki_suc_typ' => $surccusale
		);
		$this->db->where('id_type', $id);
		$this->db->update('type_courrier', $data1);
	}

	function getUserByCourrier($value)
	{	
		$this->db->select('fki_user_dif');
		$this->db->from('diffusion d');
		$this->db->where('d.fki_courrier_dif', $value);
		$this->db->where('d.fki_statut_dif', 1);
		return $this->db->get()->result_array();

	}


	function getUserEnCopieByCourrier($value)
	{	
		$this->db->select('fki_user_dif');
		$this->db->from('diffusion d');
		$this->db->where('d.fki_courrier_dif', $value);
		$this->db->where('d.fki_statut_dif', 4);
		return $this->db->get()->result_array();

	}

	function getExpediteur()
	{
		$this->db->from('expediteur e');
		$this->db->where('e.supprimer_exp', 1);
		return $this->db->get()->result_array();
	}

	function getDossier($surccusale)
	{
		$this->db->from('dossier d');
		$this->db->where('d.supprimer_dos', 1);
		$this->db->where('d.fki_suc_dos', $surccusale);
		return $this->db->get()->result_array();
	}


	function getTypeCourrier($surccusale)
	{
		$this->db->from('type_courrier t');
		$this->db->where('t.supprimer_typ', 1);
		$this->db->where('t.fki_suc_typ', $surccusale);
		return $this->db->get()->result_array();
	}


	function getUsersBySurccusale($surccusale)
    {

        $this->db->from('user u');
        $this->db->where('u.statut', 1);
        $this->db->where('u.fki_suc_us', $surccusale);
        return $this->db->get()->result_array();

    }


    function getexpediteurbyId($id)
	{
		$this->db->from('expediteur e');
		$this->db->where('e.supprimer_exp', 1);
		$this->db->where('e.id_exp', $id);
		return $this->db->get()->row();
	}

	function getdossierbyId($id)
	{
		$this->db->from('dossier d');
		$this->db->where('d.supprimer_dos', 1);
		$this->db->where('d.id_dossier', $id);
		return $this->db->get()->row();
	}

	function gettypebyId($id)
	{
		$this->db->from('type_courrier t');
		$this->db->where('t.supprimer_typ', 1);
		$this->db->where('t.id_type', $id);
		return $this->db->get()->row();
	}

	function getIdCourrierByNumCourrier($value) {
		$this->db->select('id_courrier');
        $this->db->from('courrier c');
        $this->db->where('c.num_courrier', $value);
        return $this->db->get()->row('id_courrier');
        
    }


	function getIdCourrierByIddif($value) {
		$this->db->select('fki_courrier_dif');
        $this->db->from('diffusion d');
        $this->db->where('d.id_dif', $value);
        return $this->db->get()->row('fki_courrier_dif');
        
    }


    function getServiceDest($value)
	{
		$this->db->select('code_service');
		$this->db->from('service s');
		// $this->db->join('user u', 'u.fki_service_us=s.id_service');
		$this->db->where('s.id_service', $value);
		return $this->db->get()->row('code_service');
	}


	function getNbCourrier()
	{
		$this->db->select('count(*) as nb');
		$this->db->from('courrier c');
		$this->db->where('YEAR(c.date_arrivee)', date('Y'));
		$this->db->where('MONTH(c.date_arrivee)', date('m'));
		return $this->db->get()->row()->nb + 1;
	}

	function getCodeSucByIdsuc($surccusale)
	{
		$this->db->select('code_pays');
		$this->db->from('pays p');
        $this->db->join('surccusale s', 's.fki_pays=p.id_pays');
        $this->db->where('s.id_suc', $surccusale);
        // return $this->db->get()->result_array();
        return $this->db->get()->row('code_pays');
	}

	function getEmailByUserId($id_user)
    {
        $this->db->select('email');
        $this->db->from('user u');
        $this->db->where('u.id_user', $id_user);

        return $this->db->get()->row('email');
    }


	function getNoteByCourrier($id)
	{
		$this->db->from('note n');
		$this->db->where('n.fkIdCourier', $id);
		$this->db->join('employee e', 'e.idemp=n.fkIdInitiateurNote	');
		return $this->db->get()->result_array();
	}

	function getreponseByCourrier($id)
	{
		$this->db->from('responsedestinataire r');
		$this->db->where('r.fkIdCourier', $id);
		$this->db->join('employee e', 'e.idemp=r.fkIdExpResponse	');
		return $this->db->get()->result_array();
	}

	function getCourrierAValider()
	{
		$this->db->from('courier c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('s.chefservicefkidemp', $_SESSION['idemp']);
		$this->db->where('c.stateCourier', 'En attente');
		return $this->db->get()->result_array();
	}

	function getCourrierATraiter()
	{
		/*$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('c.destCourier', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Traite courrier');
		$this->db->order_by('c.idCourierTraite', 'DESC');*/

		$this->db->select('*');
		$this->db->from('listdestinataire ld');
		$this->db->join('couriertraiter c', 'c.fkIdcourier=ld.fkidCourier');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('ld.fkIdDest', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Traite courrier');
		$this->db->order_by('c.idCourierTraite', 'DESC');


		return $this->db->get()->result_array();
	}

	function getCourrierTransferer()
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('c.destCourier', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Tranférer');
		$this->db->order_by('c.idCourierTraite', 'DESC');
		return $this->db->get()->result_array();
	}

	function getCourrierArchiver()
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		//$this->db->where('c.destCourier', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Archiver');
		$this->db->order_by('c.idCourierTraite', 'DESC');
		return $this->db->get()->result_array();
	}


	function getCourrierEnCopie()
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('listdiffusioncourier l', 'l.fkidCourier=c.fkIdcourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('l.fkIdDest', $_SESSION['idemp']);
		//$this->db->where('c.stateCourierTraite', 'Traite courrier');
		$this->db->order_by('c.idCourierTraite', 'DESC');
		return $this->db->get()->result_array();
	}



	function getCourrierSave()
	{
		$this->db->from('courier c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.destCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('c.expCourier', $_SESSION['idemp']);
		$this->db->order_by('c.idcourier', 'DESC');
		return $this->db->get()->result_array();
	}

	function getAlldoc()
	{
		$this->db->from('doc d');
		$this->db->join('surccusale suc', 'suc.id_suc=d.entite');
		$this->db->where('d.entite', $_SESSION['fki_suc_us']);
		return $this->db->get()->result_array();
	}


	function getAllCourrierAppelView($value='')
	{
		$this->db->select('courier_lier,id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,DATE_FORMAT(date_limite, "%Y-%m-%d") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}



	function getAllCourrierConfAppelView($value='')
	{
		$this->db->select('courier_lier,id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	function getCourrierTraiterPrintAppelView($value1,$value2)
	{
		$this->db->select('courier_lier,id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_dif,transferer_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.id_courrier', $value2);
		$this->db->where('d.id_dif', $value1);
		$this->db->where('st.id_statut', 2);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	


	function getAllCourrierConfprintAppelView($value='')
	{
		$this->db->select('courier_lier,id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_dif,transferer_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}



	function getAllCourrierConfFactureView($value='')
	{
		$this->db->select('courier_lier,id_facture,fki_courrier_fact,provenance_fact,montant_fact,DATE_FORMAT(date_paie, "%d-%m-%Y") as date_paie,type_facture,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value);
		// $this->db->group_by('c.id_courrier,st.id_statut');
		return $this->db->get()->result_array();
	}



	function getAllCourrierConfprintFactureView($value='')
	{
		$this->db->select('courier_lier,id_facture,fki_courrier_fact,provenance_fact,montant_fact,DATE_FORMAT(date_paie, "%d-%m-%Y") as date_paie,type_facture,id_dif,transferer_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value);
		// $this->db->group_by('c.id_courrier,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getCourrierTraiterPrintFactureView($value1,$value2)
	{
		$this->db->select('courier_lier,id_facture,fki_courrier_fact,provenance_fact,montant_fact,DATE_FORMAT(date_paie, "%d-%m-%Y") as date_paie,type_facture,id_dif,transferer_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value2);
		$this->db->where('d.id_dif', $value1);
		$this->db->where('st.id_statut', 2);
		// $this->db->group_by('c.id_courrier,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierFactureView($value='')
	{
		$this->db->select('courier_lier,id_facture,fki_courrier_fact,provenance_fact,montant_fact,date_paie,type_facture,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,date_limite,DATE_FORMAT(date_limite, "%Y-%m-%d") as date_limite,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierConfById($value)
	{
		$this->db->select('courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	function getAllCourrierConfprintById($value)
	{
		$this->db->select('courier_lier,id_dif,transferer_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getCourrierTraiterPrintById($value1,$value2)
	{
		$this->db->select('courier_lier,id_dif,transferer_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('c.id_courrier', $value2);
		$this->db->where('d.id_dif', $value1);
		$this->db->where('st.id_statut', 2);

		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}



	function getAllCourrierSaveById($value)
	{
		$this->db->select('courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,DATE_FORMAT(date_limite, "%Y-%m-%d") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierConsultView($value)
	{
		$this->db->select('id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,courier_lier, categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		$this->db->where('c.num_courrier', $value);
		// $this->db->or_where('st.id_statut', 4);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('fki_courrier_dif,id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierConsultCallView($value)
	{
		$this->db->select('id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp,courier_lier');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		$this->db->where('c.num_courrier', $value);
		// $this->db->or_where('st.id_statut', 4);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('fki_courrier_dif,id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierConsultFactureView($value)
	{
		$this->db->select('id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp,courier_lier,id_facture,fki_courrier_fact,provenance_fact,montant_fact,date_paie,type_facture');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		$this->db->where('c.num_courrier', $value);
		// $this->db->or_where('st.id_statut', 4);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('fki_courrier_dif,id_statut');
		return $this->db->get()->result_array();
	}




	function getAllCourrierSaveView($value)
	{
		$this->db->select('id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,courier_lier, categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		$this->db->where('c.id_courrier', $value);
		// $this->db->or_where('st.id_statut', 4);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('fki_courrier_dif,id_statut');
		return $this->db->get()->result_array();
	}

	function getAllCourrierSaveCallView($value)
	{
		$this->db->select('id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp,courier_lier');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		$this->db->where('c.id_courrier', $value);
		// $this->db->or_where('st.id_statut', 4);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('fki_courrier_dif,id_statut');
		return $this->db->get()->result_array();
	}

	function getAllCourrierSaveFactureView($value)
	{
		$this->db->select('id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp,courier_lier,id_facture,fki_courrier_fact,provenance_fact,montant_fact,date_paie,type_facture');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		$this->db->where('c.id_courrier', $value);
		// $this->db->or_where('st.id_statut', 4);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('fki_courrier_dif,id_statut');
		return $this->db->get()->result_array();
	}





	function getAllCourrierSave1($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as limite,DATE_FORMAT(date_relance, "%Y-%m-%d") as relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_statut_dif', 1);
		$this->db->order_by('d.date_dif', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	// function getAllCourrierSave($value='')
	// {
	// 	$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
	// 	$this->db->from('diffusion d');
	// 	$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
	// 	$this->db->join('user u', 'u.id_user=d.fki_user_dif');
	// 	$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
	// 	// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
	// 	// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
	// 	$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
	// 	// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
	// 	$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
	// 	$this->db->join('service s', 'u.fki_service_us=s.id_service');
	// 	$this->db->where('c.exp_courrier', $_SESSION['userid']);
	// 	$this->db->order_by('d.date_dif', 'DESC');
	// 	// $this->db->group_by('d.id_dif,st.id_statut');
	// 	return $this->db->get()->result_array();
	// }

	function getAllCourrierSave($value='')
	{
		$this->db->select('id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('courrier c');
		// $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
		// $this->db->join('user u', 'u.id_user=d.fki_user_dif');
		// $this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->where('st.id_statut', 1);
		// $this->db->or_where('st.id_statut', 4);
		$this->db->order_by('c.id_courrier', 'DESC');
		$this->db->group_by('id_courrier');
		return $this->db->get()->result_array();
	}

	function getAllDifSave($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_statut,libelle_statut,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email');
		$this->db->from('diffusion d');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		// $this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		// $this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$options = array (1,3);
		$this->db->where_in('st.id_statut', $options);
		// $this->db->where('st.id_statut', 1);
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	function getAllDifSavecopie2($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_statut,libelle_statut,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email');
		$this->db->from('diffusion d');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		// $this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		// $this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('st.id_statut', 4);
		// $this->db->where('d.fki_courrier_dif', $value);
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllDifSavebyIdCourrierforarchiver($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_statut,libelle_statut,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email');
		$this->db->from('diffusion d');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		// $this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		// $this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('st.id_statut', 3);
		$this->db->where('d.fki_courrier_dif', $value);
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	function getAllDifSavebyIdCourrier($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_statut,libelle_statut,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email');
		$this->db->from('diffusion d');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		// $this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		// $this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$options = array (1,3);
		$this->db->where_in('st.id_statut', $options);
		// $this->db->or_where('st.id_statut', 3);
		$this->db->where('d.fki_courrier_dif', $value);
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}



	function getAllDifCopiebyIdCourrier($value)
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_statut,libelle_statut,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email');
		$this->db->from('diffusion d');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		// $this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		// $this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('st.id_statut', 4);
		$this->db->where('d.fki_courrier_dif', $value);
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	function getAllDifCopie($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_statut,libelle_statut,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email');
		$this->db->from('diffusion d');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		// $this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		// $this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		// $this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('st.id_statut', 4);
		// $this->db->where('c.exp_courrier', $_SESSION['userid']);
		// $this->db->order_by('c.id_courrier', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierAtraiter($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 1);
		$this->db->order_by('d.date_dif', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	function getAllCourrierAtraiterById($value)
	{
		$this->db->select('courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 1);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	//Donnees appel view atraiter

	function getAllCourrierAppelAtraiterById($value)
	{
		$this->db->select('id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 1);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	//Donnees facture

	function getAllCourrierFactureAtraiterById($value)
	{
		$this->db->select('id_facture,fki_courrier_fact,provenance_fact,montant_fact,DATE_FORMAT(date_paie, "%d-%m-%Y") as date_paie,type_facture,courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 1);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierEncopie($value='')
	{
		$this->db->select('courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 4);
		$this->db->order_by('d.date_dif', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierEncopieById($value)
	{
		$this->db->select('courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 4);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	//Donnees appel 

	function getAllCourrierAppelEncopieById($value)
	{
		$this->db->select('id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 4);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierFactureEncopieById($value)
	{
		$this->db->select('id_facture,fki_courrier_fact,provenance_fact,montant_fact,DATE_FORMAT(date_paie, "%d-%m-%Y") as date_paie,type_facture,courier_lier,id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 4);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierTransferer($value='')
	{
		$this->db->select('courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 2);
		$this->db->order_by('d.date_dif', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierTransfererById($value)
	{
		$this->db->select('courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 2);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	//Donnees facture

	function getAllCourrierFactureTransfererById($value)
	{
		$this->db->select('id_facture,fki_courrier_fact,provenance_fact,montant_fact,DATE_FORMAT(date_paie, "%d-%m-%Y") as date_paie,type_facture,courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 2);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	// Donnees Appel

	function getAllCourrierAppelTransfererById($value)
	{
		$this->db->select('id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 2);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierArchiver($value='')
	{
		$this->db->select('id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,DATE_FORMAT(date_limite, "%Y-%m-%d") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 3);
		$this->db->order_by('d.date_dif', 'DESC');
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierArchiverById($value)
	{
		$this->db->select('courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 3);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}

	//Donnees Appel

	function getAllCourrierAppelArchiverById($value)
	{
		$this->db->select('id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 3);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierFactureArchiverById($value)
	{
		$this->db->select('id_facture,fki_courrier_fact,provenance_fact,montant_fact,date_paie,type_facture,courier_lier,id_dif,transferer_par,archiver_par,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,DATE_FORMAT(date_courrier, "%d-%m-%Y") as date_courrier,DATE_FORMAT(date_arrivee, "%d-%m-%Y") as date_arrivee,DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle,service_dest,courrier_exp');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		// $this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('d.fki_user_dif', $_SESSION['userid']);
		$this->db->where('st.id_statut', 3);
		$this->db->where('d.id_dif', $value);
		// $this->db->group_by('d.id_dif,st.id_statut');
		return $this->db->get()->result_array();
	}


	function getAllCourrierWithAppel($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_doc,fki_courrier_doc,entite,chemin,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,fki_suc_dos,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_appel,fki_courrier_app,provenance,numero,objet_appel,message_appel,destination,action,mention,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		// $this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		$this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		$this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('u.id_user', $_SESSION['userid']);
		// $this->db->group_by('d.id_dif','st.id_statut');
		return $this->db->get()->result_array();
	}

	function getAllCourrierWithFacture($value='')
	{
		$this->db->select('id_dif,fki_courrier_dif,fki_user_dif,fki_statut_dif,date_dif,id_doc,fki_courrier_doc,entite,chemin,id_dossier,code_dossier,nom_dossier,type_dossier,date_dossier,fki_suc_dos,id_facture,fki_courrier_fact,provenance_fact,montant_fact,date_paie,type_facture,id_service,libelle_service,id_suc_serv,id_statut,libelle_statut,id_type,fki_suc_typ,libelle_type,delai_traitement,delai_relance,id_user,fki_suc_us,fki_profil_us,fki_service_us,nom_user,prenom_user,titre,email,id_courrier,num_courrier,fki_dossier,fki_type_courrier,categorie_courrier,priorite_courrier,date_courrier,date_arrivee,date_limite,date_relance,nature_courrier,objet_courrier,confidentiel,exp_courrier,info,mot_cle');
		$this->db->from('diffusion d');
		$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
		$this->db->join('user u', 'u.id_user=d.fki_user_dif');
		$this->db->join('statut st', 'st.id_statut=d.fki_statut_dif');
		$this->db->join('facture f', 'f.fki_courrier_fact=c.id_courrier');
		// $this->db->join('appel ap', 'ap.fki_courrier_app=c.id_courrier');
		$this->db->join('type_courrier tc', 'tc.id_type=c.fki_type_courrier');
		$this->db->join('doc', 'doc.fki_courrier_doc=c.id_courrier');
		$this->db->join('dossier', 'dossier.id_dossier=c.fki_dossier');
		$this->db->join('service s', 'u.fki_service_us=s.id_service');
		$this->db->where('u.id_user', $_SESSION['userid']);
		// $this->db->group_by('d.id_dif','st.id_statut');
		return $this->db->get()->result_array();
	}

	// function getAllCourrier2($value='')
	// {
	// 	$this->db->from('diffusion d');
	// 	$this->db->join('courrier c', 'c.id_courrier=d.fki_courrier_dif');
	// 	$this->db->join('user u', 'u.idemp=c.destCourier');
	// 	return $this->db->get()->result_array();
	// }

	function getEmp($idemp)
	{
		$this->db->from('employee e');
		$this->db->where('e.idemp', $idemp);
		return $this->db->get()->row();
	}

	function getSurccusaleCodePays()
    {
    	$this->db->select('code_pays');
        $this->db->from('surccusale suc');
        $this->db->join('pays p', 'p.id_pays=suc.fki_pays');
       	$this->db->where('suc.id_suc', $_SESSION['fki_suc_us']);
        // return $this->db->get()->result_array();   
        return $this->db->get()->row();  
    }

    function getIdMaxCourrier()
	{
		$this->db->select('Max(id_courrier) as id');
		$this->db->from('courrier c');
		return $this->db->get()->row();
	}


	function getUsersendmail($id_user)
	{
		$this->db->from('user u');
		$this->db->where('u.id_user', $id_user);
		return $this->db->get()->row();
	}


	function getExpById($user_id)
    {
        $this->db->from('user u');
        $this->db->join('diffusion d', 'd.transferer_par=u.id_user');
        $this->db->where('d.transferer_par', $user_id);
        return $this->db->get()->row();
    }


    function getExpCourrierById($value)
    {
    	
        $this->db->from('expediteur e');
        // $this->db->join('courrier c', 'c.exp_courrier=u.id_user');
        $this->db->where('e.id_exp', $value);
        $this->db->where('e.supprimer_exp', 1);
        return $this->db->get()->row();
    }

    function getExpByIdAtraiter($user_id)
    {
    	$this->db->select('prenom_user,nom_user,code_service,libelle_service');
        $this->db->from('user u');
        $this->db->join('service s', 's.id_service=u.fki_service_us');
        $this->db->where('u.id_user', $user_id);
        return $this->db->get()->row();
    }

    function getTransfereParByIdCourrier($id_dif)
    {
    	$this->db->select('transferer_par');
        $this->db->from('diffusion d');
        $this->db->where('d.id_dif', $id_dif);
        $this->db->where('d.fki_statut_dif', 2);
        return $this->db->get()->row();
    }


    function getServiceDestByIdservice($value)
    {
        $this->db->from('service s');
        // $this->db->join('courrier c', 'c.exp_courrier=u.id_user');
        $this->db->where('s.id_service', $value);
        return $this->db->get()->row();
    }


	function getCourrierAValiderById($id)
	{
		$this->db->from('courier c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->join('dossier d', 'd.iddossier=c.fkIdDossier', 'left');
		$this->db->where('s.chefservicefkidemp', $_SESSION['idemp']);
		$this->db->where('c.stateCourier', 'En attente');
		$this->db->where('c.idcourier', $id);
		return $this->db->get()->row();
	}

	function getCourrierATraiterById($id)
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->where('c.destCourier', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Traite courrier');
		$this->db->where('c.fkIdcourier', $id);
		//$this->db->order_by('c.idCourierTraite', 'DESC');
		return $this->db->get()->row();
	}



	function getCourrierEnCopieById($id)
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		//$this->db->where('c.destCourier', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Traite courrier');
		$this->db->where('c.fkIdcourier', $id);
		//$this->db->order_by('c.idCourierTraite', 'DESC');
		return $this->db->get()->row();
	}

	function getCourrierTransfererById($id)
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->where('c.destCourier ', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Tranférer');
		$this->db->where('c.fkIdcourier', $id);
		return $this->db->get()->row();
	}

	function getCourrierArchiverById($id)
	{
		$this->db->from('couriertraiter c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		//$this->db->where('c.expCourier ', $_SESSION['idemp']);
		$this->db->where('c.stateCourierTraite', 'Archiver');
		$this->db->where('c.fkIdcourier', $id);
		return $this->db->get()->row();
	}

	function getCourrierEnregistrerById($id)
	{
		$this->db->from('courier c');
		$this->db->join('service s', 's.idservice=c.serviceInit');
		$this->db->join('employee e', 'e.idemp=c.expCourier');
		$this->db->where('c.expCourier', $_SESSION['idemp']);
		$this->db->where('c.idcourier', $id);
		return $this->db->get()->row();
	}

	function getService()
	{
		$this->db->from('service s');
		$this->db->where('s.fkidgroupe', $_SESSION['idgroupe']);
		return $this->db->get()->result_array();
	}

	function getDepart()
	{
		$this->db->from('courrier c');
		$this->db->where('c.categorie_courrier', 'DEPART');
		return $this->db->get()->result_array();
	}

	function getArrive()
	{
		$this->db->from('courrier c');
		$this->db->where('c.categorie_courrier', 'ARRIVE');
		return $this->db->get()->result_array();
	}

	function getEmploye2()
	{
		$this->db->from('employee e');
		$this->db->where('e.fkidgroupe', $_SESSION['idgroupe']);
		return $this->db->get()->result_array();
	}

	function updateCourrierByInitiateur($id, $natureCourier, $dateCourier, $typeCourier, $categorieCourier, $numcourier,
										$linkDoc, $prioriteCourier, $objetCourier, $destCourier, $dateLimittraiteCourier,
										$expCourier, $serviceInit, $fkIdDossier, $lieidCourierTraite)
	{
		if ($_SESSION['ischef'] == true) $state = 'Validé';
		else $state = 'En attente';

		$data1 = array(
			'natureCourier' => $natureCourier,
			'dateCourier' => date('Y-m-d H:i:s'),
			'typeCourier' => $typeCourier,
			'categorieCourier' => $categorieCourier,
			'numcourier' => $numcourier,
			'linkDoc' => $linkDoc,
			'prioriteCourier' => $prioriteCourier,
			'objetCourier' => $objetCourier,
			'destCourier' => $destCourier[0],
			'expCourier' => $expCourier,
			'serviceInit' => $serviceInit,
            'fkIdDossier' => $fkIdDossier,
            'lieidCourierTraite' => $lieidCourierTraite,
			'serviceTraitant' => $this->getServiceByEmp($expCourier),
			'dateLimittraiteCourier' => $dateLimittraiteCourier,
			'stateCourier' => $state,
			'isread' => 0,
		);

		$this->db->where('idcourier', $id);
		$this->db->update('courier', $data1);

		$data = array(
			'fkIdcourier' => $id,
			'natureCourier' => $natureCourier,
			'dateCourier' => $dateCourier,
			'typeCourier' => $typeCourier,
			'categorieCourier' => $categorieCourier,
			'numCourier' => $numcourier,
			'linkDoc' => $linkDoc,
			'prioriteCourier' => $prioriteCourier,
			'objetCourier' => $objetCourier,
			'destCourier' => $destCourier[0],
			'expCourier' => $expCourier,
			'serviceInit' => $serviceInit,
            'fkIdDossier' => $fkIdDossier,
            'lieidCourierTraite' => $lieidCourierTraite,
			'serviceTraitant' => $this->getServiceByEmp($expCourier),
			'dateLimittraiteCourier' => $dateLimittraiteCourier,
			'stateCourierTraite' => 'Traite courrier',
			'isread' => 0,
		);

		$this->db->where('fkIdcourier', $id);
		$this->db->update('couriertraiter', $data);

		if($this->db->delete('listdestinataire', array('fkidCourier' => $id))) {
			if ($destCourier != '') {
				foreach ($destCourier as $key => $rowdest) {
					$data3 = array(
						'fkidCourier' => $id,
						'fkIdDest' => $destCourier[$key],
						'roleListDest' => 'Destinataire',
					);
					$this->db->insert('listdestinataire', $data3);
				}
			}
		}
	}

	function archivercourrier($idCourierTraite) {

		foreach ($idCourierTraite as $key=>$item) {
			$data1 = array(
				'stateCourierTraite' => 'Archiver'
			);
			$this->db->where('idCourierTraite', $idCourierTraite[$key]);
			$this->db->update('couriertraiter', $data1);
		}

	}

	function archiveCourrier($id_dif2) {

			$data1 = array(
				'fki_statut_dif' => 3
			);
			$this->db->where('id_dif',$id_dif2);
			$this->db->where('fki_user_dif', $_SESSION['userid']);
			$this->db->where('fki_statut_dif', 1);
			$this->db->update('diffusion', $data1);

	}

	function transfertCourrier($id_Courrier, $fkIdDest)
	{

                $data = array(
			            'fki_courrier_dif' => $id_Courrier,
			            'fki_user_dif' => $fkIdDest,
			            'transferer_par' => $_SESSION['userid'],
			            'fki_statut_dif' => 2
        					);

                $this->db->insert('diffusion', $data);	  
      
	}

	function transferercourrier($idCourierTraite, $fkIdDest)
	{

		if($idCourierTraite) {
			foreach ($idCourierTraite as $key=>$item) {
				$this->db->from('couriertraiter ct');
				$this->db->where('ct.idCourierTraite', $idCourierTraite[$key]);
				$couriertraiter = $this->db->get()->row();

				$data1 = array(
					'stateCourierTraite' => 'Tranférer',
				);
				$this->db->where('idCourierTraite', $idCourierTraite[$key]);
				$upd = $this->db->update('couriertraiter', $data1);

				if ($upd) {
					$data = array(
						'fkIdcourier' => $couriertraiter->fkIdcourier,
						'natureCourier' => $couriertraiter->natureCourier,
						'dateCourier' => $couriertraiter->dateCourier,
						'typeCourier' => $couriertraiter->typeCourier,
						'categorieCourier' => $couriertraiter->categorieCourier,
						'numCourier' => $couriertraiter->numCourier,
						'linkDoc' => $couriertraiter->linkDoc,
						'prioriteCourier' => $couriertraiter->prioriteCourier,
						'objetCourier' => $couriertraiter->objetCourier,
						'destCourier' => $fkIdDest,
						//'expCourier' => $couriertraiter->expCourier,
						'expCourier' => $_SESSION['idemp'],
						'serviceInit' => $couriertraiter->serviceInit,
						'serviceTraitant' => $couriertraiter->serviceTraitant,
						'dateLimittraiteCourier' => $couriertraiter->dateLimittraiteCourier,
						'stateCourierTraite' => 'Traite courrier',
						'isread' => 0,
					);
					$this->db->insert('couriertraiter', $data);
				}
			}
		}
	}

	function readcourrieratraiter()
	{
		$data1 = array(
			'isread' => 1
		);
		$this->db->where('destCourier', $_SESSION['idemp']);
		$this->db->update('couriertraiter', $data1);
	}

	function readcourrieratraiter1($idcourrier)
	{
		$data1 = array(
			'isread' => 1
		);
		//$this->db->where('destCourier', $_SESSION['idemp']);
		$this->db->where('fkIdcourier', $idcourrier);
		$this->db->update('couriertraiter', $data1);
	}

	function readcourrierencopie()
	{
		$data1 = array(
			'isread' => 1
		);
		$this->db->where('destCourier', $_SESSION['idemp']);
		$this->db->update('couriertraiter', $data1);
	}

	function updateCourrierByChef($id, $natureCourier, $dateCourier, $typeCourier, $categorieCourier, $numcourier,
								  $linkDoc, $prioriteCourier, $objetCourier, $destCourier, $dateLimittraiteCourier,
								  $expCourier, $serviceInit)
	{
		$data1 = array(
			'objetCourier' => $objetCourier,
			'prioriteCourier' => $prioriteCourier,
			'destCourier' => $destCourier,
			'dateLimittraiteCourier' => $dateLimittraiteCourier,
			'stateCourier' => 'Validé'
		);
		$this->db->where('idcourier', $id);
		$this->db->update('courier', $data1);

		$data = array(
			'fkIdcourier' => $id,
			'natureCourier' => $natureCourier,
			'dateCourier' => $dateCourier,
			'typeCourier' => $typeCourier,
			'categorieCourier' => $categorieCourier,
			'numCourier' => $numcourier,
			'linkDoc' => $linkDoc,
			'prioriteCourier' => $prioriteCourier,
			'objetCourier' => $objetCourier,
			'destCourier' => $destCourier,
			'expCourier' => $expCourier,
			'serviceInit' => $serviceInit,
			'serviceTraitant' => $this->getServiceByEmp($expCourier),
			'dateLimittraiteCourier' => $dateLimittraiteCourier,
			'stateCourierTraite' => 'Traite courrier',
			'isread' => 0,
		);
		$this->db->insert('couriertraiter', $data);
	}

	function newnote($fkIdCourierTraiter, $fkIdCourier, $fkIdInitiateurNote, $objetNote)
	{
		$data = array(
			'fkIdCourierTraiter' => $fkIdCourierTraiter,
			'fkIdCourier' => $fkIdCourier,
			'fkIdInitiateurNote' => $fkIdInitiateurNote,
			'objetNote' => $objetNote,
			'dateNote' => date('Y-m-d H:i:s'),
		);
		$this->db->insert('note', $data);
	}

	function createDossier($nomdossier, $typedossier)
	{
		$data = array(
			'nomdossier' => $nomdossier,
			'typedossier' => $typedossier,
			'datecreateddossier' => date('Y-m-d')
		);
		$this->db->insert('dossier', $data);
	}


	function edit_expediteur($nomcomplet_edit,$email_exp_edit,$num_exp_edit)
	{
        $data = array(
            'nom_dossier' => $libelle_dossier2,
            'code_dossier' => $code_dossier2,
            'type_dossier' => $typedossier
        );
        
        $this->db->where('id_dossier', $edit_dossier_id);
        $this->db->where('fki_suc_dos', $surccusale);
        $this->db->update('dossier', $data);
        return true;
    }


    function edit_exp($nomcomplet_edit,$email_exp_edit,$num_exp_edit,$edit_exp_id)
	{
        $data = array(
            'nomcomplet' => $nomcomplet_edit,
            'email_exp' => $email_exp_edit,
            'tel_exp' => $num_exp_edit
        );
        
        $this->db->where('id_exp', $edit_exp_id);
        $this->db->update('expediteur', $data);
        return true;
    }


	function edit_dossier($libelle_dossier2,$code_dossier2,$typedossier,$edit_dossier_id,$surccusale)
	{
        $data = array(
            'nom_dossier' => $libelle_dossier2,
            'code_dossier' => $code_dossier2,
            'type_dossier' => $typedossier
        );
        
        $this->db->where('id_dossier', $edit_dossier_id);
        $this->db->where('fki_suc_dos', $surccusale);
        $this->db->update('dossier', $data);
        return true;
    }


    function edit_type($edit_libelle_type2,$traitement,$relance,$edit_type_id,$surccusale)
	{
        $data = array(
            'libelle_type' => $edit_libelle_type2,
            'delai_traitement' => $traitement,
            'delai_relance' => $relance
        );
        
        $this->db->where('id_type', $edit_type_id);
        $this->db->where('fki_suc_typ', $surccusale);
        $this->db->update('type_courrier', $data);
        return true;
    }

	function updateDossier($id, $nomdossier, $typedossier)
	{
		$data = array(
			'nomdossier' => $nomdossier,
			'typedossier' => $typedossier,
			'datecreateddossier' => date('Y-m-d')
		);

		$this->db->where('iddossier', $id);
		$this->db->update('dossier', $data);
	}

	function newresponse($fkIdCourierTraiter, $fkIdCourier, $fkIdExpResponse, $msgResponse,
						 $subjetResponse, $DestResponse)
	{
		$data = array(
			'fkIdCourierTraiter' => $fkIdCourierTraiter,
			'fkIdCourier' => $fkIdCourier,
			'fkIdExpResponse' => $fkIdExpResponse,
			'DestResponse' => $DestResponse,
			'subjetResponse' => $subjetResponse,
			'msgResponse' => $msgResponse,
			'dateResponse' => date('Y-m-d H:i:s'),
		);
		$this->db->insert('responsedestinataire', $data);
	}

	function getServiceByEmp($idemp)
	{
		$this->db->select('fkidservice');
		$this->db->from('employee e');
		$this->db->where('e.idemp', $idemp);
		return $this->db->get()->row()->fkidservice;
	}


	function addCourriernew($lieidCourierTraite,$prioriteCourier,$objetCourier,$categorieCourier,$typeCourier,$natureCourier,$date_courrier,$date_arrivee,$confidentiel,$info,$mot_cle,$numcourier,$expCourier,$fkIdDossier,$dateLimittraiteCourier,$date_relance,$service_dest,$expediteur_courrier)
	{	
		$data = array(
			'priorite_courrier' => $prioriteCourier,
			'courier_lier' => $lieidCourierTraite,
			'objet_courrier' => $objetCourier,
			'categorie_courrier' => $categorieCourier,
			'fki_type_courrier' => $typeCourier,
			'nature_courrier' => $natureCourier,
			'date_courrier' => $date_courrier,
			'date_arrivee' => $date_arrivee,
			'confidentiel' => $confidentiel,
			'info' => $info,
			'mot_cle' => $mot_cle,
			'num_courrier' => $numcourier,
			'exp_courrier' => $expCourier,
			'fki_dossier' => $fkIdDossier,
			'date_limite' => $dateLimittraiteCourier,
			'date_relance' => $date_relance,
			'courrier_exp' => $expediteur_courrier,
			'service_dest' => $service_dest
			);

			$this->db->insert('courrier', $data);
			return true;

	}

	function addDif($id_courrier,$statut,$id_dest)
	{
		$data = array(
			'fki_courrier_dif' => $id_courrier,
			'fki_user_dif' => $id_dest,
			'fki_statut_dif' => $statut
		);
		$this->db->insert('diffusion', $data);
	}


	function addCourrierAppel($origine_tel,$tel,$obj_tel,$mention,$des_tel,$action,$mes_tel,$id_courrier)
	{
		$data = array(
			'fki_courrier_app' => $id_courrier,
			'provenance' => $origine_tel,
			'numero' => $tel,
			'objet_appel' => $obj_tel,
			'mention' => $mention,
			'destination' => $des_tel,
			'action' => $action,
			'message_appel' => $mes_tel

		);
			$this->db->insert('appel', $data);

	}

	function addCourrierFacture($origine_fact,$montant,$type_facture,$date_echeant,$id_courrier)
	{
		$data = array(
			'fki_courrier_fact' => $id_courrier,
			'provenance_fact' => $origine_fact,
			'montant_fact' => $montant,
			'type_facture' => $type_facture,
			'date_paie' => $date_echeant
			

		);
			$this->db->insert('facture', $data);


	}

	function addDoc($id_courrier,$name,$surccusale)
	{	
		$data = array(
			'fki_courrier_doc' => $id_courrier,
			'entite' => $surccusale,
			'chemin' => $name
		);
			$this->db->insert('doc', $data);

	}

	function deleteFicheCourrier($value)
	{
		$this->db->where('id_courrier',$value);
		$this->db->delete('courrier');
		

	}
	function deleteFichedif($value)
	{
		$this->db->where('fki_courrier_dif',$value);
		$this->db->delete('diffusion');

	}

	function deleteFicheAppel($value)
	{
		$this->db->select('fki_courrier_app');
		$this->db->from('appel');
		$this->db->where('fki_courrier_app',$value);
		$id = $this->db->get()->row('fki_courrier_app');
		// return $id;

		if ($id==$value) {
			
		$this->db->where('fki_courrier_app',$value);
		$this->db->delete('appel');
		}

		

	}

	function deleteFicheFacture($value)
	{
		$this->db->select('fki_courrier_fact');
		$this->db->from('facture');
		$this->db->where('fki_courrier_fact',$value);
		$id = $this->db->get()->row('fki_courrier_fact');
		// return $id;

		if ($id==$value) {
			
		$this->db->where('fki_courrier_fact',$value);
		$this->db->delete('facture');
		}

	}

	function deleteFichedoc($value)
	{

		$this->db->select('fki_courrier_doc');
		$this->db->from('doc');
		$this->db->where('fki_courrier_doc',$value);
		$id = $this->db->get()->row('fki_courrier_doc');
		// return $id;

		if ($id==$value) 
		{
		$this->db->where('fki_courrier_doc',$value);
		$this->db->delete('doc');
		}

	}
	



	function addCourrier($natureCourier, $typeCourier, $categorieCourier, $numcourier,
						 $linkDoc, $prioriteCourier, $objetCourier, $destCourier, $fkIdDest, $dateLimittraiteCourier,
						 $expCourier, $serviceInit, $fkIdDossier, $lieidCourierTraite)
	{

		if ($_SESSION['ischef'] == true) $state = 'Validé';
		//else $state = 'En attente';
		else $state = 'Validé';

		$data = array(
			'natureCourier' => $natureCourier,
			'dateCourier' => date('Y-m-d H:i:s'),
			'typeCourier' => $typeCourier,
			'categorieCourier' => $categorieCourier,
			'lieidCourierTraite' => $lieidCourierTraite,
			'numcourier' => $numcourier,
			'linkDoc' => $linkDoc,
			'prioriteCourier' => $prioriteCourier,
			'objetCourier' => $objetCourier,
			'destCourier' => $destCourier[0],
			'expCourier' => $expCourier,
			'serviceInit' => $serviceInit,
			'serviceTraitant' => $this->getServiceByEmp($expCourier),
			'dateLimittraiteCourier' => $dateLimittraiteCourier,
			'stateCourier' => 'Validé',
			'fkIdDossier' => $fkIdDossier,
			'isread' => 0
		);
		$this->db->insert('courier', $data);
		$idcourrier = $this->db->insert_id();

		//if($_SESSION['ischef']== true) {
		$data1 = array(
			'fkIdcourier' => $idcourrier,
			'natureCourier' => $natureCourier,
			'dateCourier' => date('Y-m-d H:i:s'),
			'typeCourier' => $typeCourier,
			'categorieCourier' => $categorieCourier,
			'lieidCourierTraite' => $lieidCourierTraite,
			'numCourier' => $numcourier,
			'linkDoc' => $linkDoc,
			'prioriteCourier' => $prioriteCourier,
			'objetCourier' => $objetCourier,
			'destCourier' => $destCourier[0],
			'expCourier' => $expCourier,
			'serviceInit' => $serviceInit,
			'serviceTraitant' => $this->getServiceByEmp($expCourier),
			'dateLimittraiteCourier' => $dateLimittraiteCourier,
			'stateCourierTraite' => 'Traite courrier',
			'fkIdDossier' => $fkIdDossier,
			'isread' => 0,
		);
		$this->db->insert('couriertraiter', $data1);
		//}

		if ($fkIdDest != '') {
			$i = 0;
			foreach ($fkIdDest as $key => $row) {
				$data2 = array(
					'fkidCourier' => $idcourrier,
					'fkIdDest' => $fkIdDest[$key],
					'roleListDif' => 'En copie',
				);
				$this->db->insert('listdiffusioncourier', $data2);
				$i++;
			}
		}


		if ($destCourier != '') {
			foreach ($destCourier as $key => $rowdest) {
				$data3 = array(
					'fkidCourier' => $idcourrier,
					'fkIdDest' => $destCourier[$key],
					'roleListDest' => 'Destinataire',
				);
				$this->db->insert('listdestinataire', $data3);
			}
		}
	}
}
