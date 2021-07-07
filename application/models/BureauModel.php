<?php

/**
 * User: Edgar AYENA
 * Date: 13/12/2018
 * ayenadedg@gmail.com
 * +229 95 80 53 26
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BureauModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getService() {
        $this->db->from('service s');
        $this->db->join('employee e', 'e.idemp=s.chefservicefkidemp');
        $this->db->join('groupe g', 'g.idgroupe=s.fkidgroupe');
        $this->db->where('s.fkidgroupe', $_SESSION['idgroupe']);
        $this->db->where('s.isdeleted', false);
        return $this->db->get()->result_array();
    }

    function getServiceByIdSuc($value='')
    {
        $this->db->from('service s');
        // $this->db->join('user u', 'u.id_user=s.chefservicefkidemp');
        $this->db->join('surccusale suc', 'suc.id_suc=s.id_suc_serv');
        $this->db->where('s.id_suc_serv',$value);
        $this->db->where('s.supprimer_serv', 1);
        return $this->db->get()->result_array();
    }

    // function getGroupe() {
    //     $this->db->from('groupe g');
    //     $this->db->where('g.isdeleted', false);
    //     return $this->db->get()->result_array();
    // }

    //code6

    function getSurccusale() {
        $this->db->from('surccusale suc');
        $this->db->where('suc.supprimer_suc', 1);
        return $this->db->get()->result_array();
    }

    function getSurccusalePays()
    {
        $this->db->from('surccusale suc');
        $this->db->join('pays p', 'p.id_pays=suc.fki_pays');
       
        return $this->db->get()->result_array();     
    }

    public function getListPays()
    {
        $this->db->select('*');
        $this->db->from('pays p');
        $res = $this->db->get()->result_array();
        return $res;     
    }


    function getEmploye() {
        $this->db->from('employee');
        $this->db->where('ischef', 0);
        return $this->db->get()->result_array();
    }

    function getUser($value='') {
        $this->db->from('user');
        $this->db->where('ischef', 0);
        $this->db->where('statut', 1);
        $this->db->where('fki_suc_us', $value);
        return $this->db->get()->result_array();
    }

    function getServiceByIdgroupe($idgroupe) {
        $this->db->from('service s');
        $this->db->where('s.isdeleted', false);
        $this->db->where('s.fkidgroupe', $idgroupe);
        return $this->db->get()->result_array();
    }

    function getEmploye2() {
        $this->db->from('employee');
        return $this->db->get()->result_array();
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function createUser($nomemp, $prenomemp, $emailemp, $titreemp, $username, $password)
    {
        $data = array(
            'nomemp' => $nomemp,
            'prenomemp' => $prenomemp,
            'emailemp' => $emailemp,
            'titreemp' => $titreemp,
            'ischef' => 0,
        );
        $this->db->insert('employee', $data);
        $idemp = $this->db->insert_id();

        if($idemp) {
            $data1 = array(
                'fkidemp' => $idemp,
                'username' => $username,
                'password' => $this->hashPassword($password),
                'isdeleted' => false,
                'createdat' => date('Y-m-j H:i:s')
            );
            $this->db->insert('user', $data1);

        }
    }

    function createService($libelleservice, $fkidgroupe, $chefservicefkidemp) {
        $data = array(
            'libelleservice' => $libelleservice,
            'fkidgroupe' => $fkidgroupe,
            'chefservicefkidemp' => $chefservicefkidemp,
        );
        $this->db->insert('service', $data);
        $idservice = $this->db->insert_id();
        if($idservice) {
            $data1 = array(
                'fkidservice' => $idservice,
                'fkidgroupe' => $fkidgroupe,
                'ischef' => 1,
                'idchef' => $chefservicefkidemp
            );
            $this->db->where('idemp', $chefservicefkidemp);
            $this->db->update('employee', $data1);
        }
    }

    function updateService($id, $libelleservice, $fkidgroupe, $chefservicefkidemp) {
        $data = array(
            'libelleservice' => $libelleservice,
            'fkidgroupe' => $fkidgroupe,
            'chefservicefkidemp' => $chefservicefkidemp,
        );
        $this->db->where('idservice', $id);
        $this->db->update('service', $data);

        $data1 = array(
            'ischef' => 1,
            'idchef' => $chefservicefkidemp
        );
        $this->db->where('idemp', $chefservicefkidemp);
        $this->db->update('employee', $data1);
    }


    function getServiceById($idservice) {
	    if($idservice) {
            $this->db->from('service s');
            $this->db->join('employee e', 'e.idemp=s.chefservicefkidemp');
            $this->db->where('s.idservice', $idservice);
            return $this->db->get()->row();
        }
    }


    function deleteService($id,$surccusale) {
        $data1 = array(
            'supprimer_serv' => 0,
        );
        $this->db->where('id_service', $id);
        $this->db->where('id_suc_serv', $surccusale);
        $this->db->update('service', $data1);
    }

    function deleteGroupe($id) {
        $data1 = array(
            'isdeleted' => 1,
        );
        $this->db->where('idgroupe', $id);
        $this->db->update('groupe', $data1);
    }

    function addGroupe($libellegroupe) {
        $data = array(
            'libellegroupe' => $libellegroupe,
        );

        $this->db->insert('groupe', $data);
    }

    // function addGroupe($libellegroupe) {
    //     $data = array(
    //         'libellegroupe' => $libellegroupe
    //     );

    //     $this->db->insert('groupe', $data);
    // }
    function addPaysCode($libellepays,$code) {
        $data = array(
            'libelle_pays' => $libellepays,
            'code_pays' => $code
        );

        $this->db->insert('pays', $data);
        return true;
    }

    function addsite($surccusale,$pays) {
        $data = array(
            'libelle_suc' => $surccusale,
            'fki_pays' => $pays,
            'supprimer_suc' => 1
        );

        $this->db->insert('surccusale', $data);
        return true;
    }

    function addservice($libelleservice2,$codeservice2,$surccusale) {
        $data = array(
            'libelle_service' => $libelleservice2,
            'code_service' => $codeservice2,
            'id_suc_serv' => $surccusale,
            'supprimer_serv' => 1
        );

        $this->db->insert('service', $data);
        return true;
    }


    function add_expediteur($nomcomplet,$email_exp,$num_exp) {
        $data = array(
            'nomcomplet' => $nomcomplet,
            'email_exp' => $email_exp,
            'tel_exp' => $num_exp,
            'supprimer_exp' => 1
        );

        $this->db->insert('expediteur', $data);
        return true;
    }

    function add_dossier($libelle_dossier,$code_dossier,$typedossier,$surccusale) {
        $data = array(
            'code_dossier' => $code_dossier,
            'nom_dossier' => $libelle_dossier,
            'type_dossier' => $typedossier,
            'fki_suc_dos' => $surccusale,
            'supprimer_dos' => 1
        );

        $this->db->insert('dossier', $data);
        return true;
    }

     function add_type($libelle_type,$traitement,$relance,$surccusale) {
        $data = array(
            'libelle_type' => $libelle_type,
            'delai_traitement' => $traitement,
            'delai_relance' => $relance,
            'fki_suc_typ' => $surccusale,
            'supprimer_typ' => 1
        );

        $this->db->insert('type_courrier', $data);
        return true;
    }


    function edit_service($libelleservice2,$idservice,$codeservice2,$surccusale) {
        $data = array(
            'libelle_service' => $libelleservice2,
            'code_service' => $codeservice2
        );
        
        $this->db->where('id_service', $idservice);
        $this->db->where('id_suc_serv', $surccusale);
        $this->db->update('service', $data);
        return true;
    }


}
