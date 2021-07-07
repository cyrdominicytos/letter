<?php

/**
 * User: Edgar AYENA
 * Date: 13/12/2018
 * ayenadedg@gmail.com
 * +229 95 80 53 26
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/*
        Vérifie le couple de connexion identifiant/mot de passe
     */
	// public function resolveUserLogin($username, $password)
	// {
	// 	$this->db->select('u.password');
	// 	$this->db->from('user u');
 //        $this->db->join('employee e', 'e.idemp=u.fkidemp');
 //        $this->db->join('privileges p', 'p.idpriv=e.fkidprofil');
	// 	$this->db->where('u.username', $username);
	// 	$this->db->where('u.isdeleted', false);
 //        $this->db->where('p.isdeleted', false);
	// 	$hash = $this->db->get()->row('password');

	// 	return $this->verifyPasswordHash($password, $hash);
	// }

    public function resolveUserLogin($email, $password)
    {
        $this->db->select('u.pass');
        $this->db->from('user u');
        $this->db->join('privileges p', 'p.id_priv=u.fki_profil_us');
        $this->db->where('u.email', $email);
        $this->db->where('u.statut !=', 3);
        // $this->db->where('p.supprimer', 1);
        $hash = $this->db->get()->row('pass');

        return $this->verifyPasswordHash($password, $hash);
    }



	/*
        Vérifie si le mot de passe est ok
     */
	private function verifyPasswordHash($password, $hash)
	{
		return password_verify($password, $hash);
	}


	private function hashPassword($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	/*
        Retourne l'utilisateur dont l'id est fourni
     */
	// public function getUserById($user_id)
	// {
	// 	$this->db->from('user u');
	// 	$this->db->join('employee e', 'e.idemp=u.fkidemp','left');
 //        //$this->db->join('profil p', 'p.idprofil=e.fkidprofil','left');
 //        $this->db->join('privileges p', 'p.idpriv=e.fkidprofil');
	// 	$this->db->join('service s', 's.idservice=e.fkidservice','left');
	// 	$this->db->join('groupe g', 'g.idgroupe=e.fkidgroupe','left');
 //        $this->db->where('e.idemp', $user_id);
	// 	$this->db->where('u.isdeleted', false);
	// 	//$this->db->where('p.isdeleted', false);
	// 	return $this->db->get()->row();
	// }

    public function getUserById($user_id)
    {
        $this->db->from('user u');
        $this->db->join('privileges p', 'p.id_priv=u.fki_profil_us');
        $this->db->join('service s', 's.id_service=u.fki_service_us');
        $this->db->join('surccusale suc', 'suc.id_suc=u.fki_suc_us');
        $this->db->where('u.id_user', $user_id);
        // $this->db->where('s.supprimer_serv', 1);
        //$this->db->where('p.isdeleted', false);
        return $this->db->get()->row();
    }

	function getPrivById($id) {
        $this->db->from('privileges p');
        $this->db->where('p.id_priv', $id);
        return $this->db->get()->row();
    }

	/*
        Liste des utilisateurs
     */
	// public function getUsers()
	// {

 //        $this->db->from('user u');
 //        $this->db->join('employee e', 'e.idemp=u.fkidemp', 'left');
 //        $this->db->join('privileges p', 'p.idpriv=e.fkidprofil');
 //        $this->db->join('service s', 's.idservice=e.fkidservice', 'left');
 //        $this->db->join('groupe g', 'g.idgroupe=e.fkidgroupe', 'left');
 //        $this->db->where('p.isdeleted', false);
 //        $this->db->where('u.isdeleted', false);
 //        $res = $this->db->get()->result_array();
 //        //var_dump($res);
 //        return $res;
	// }
//code6
    public function getUsers()
    {

        $this->db->from('user u');
        $this->db->join('privileges p', 'p.id_priv=u.fki_profil_us');
        $this->db->join('service s', 's.id_service=u.fki_service_us');
        // $this->db->join('groupe g', 'g.idgroupe=e.fkidgroupe', 'left');
        // $this->db->where('p.supprimer', 1);
        // $this->db->where('u.supprimer', 0);
        $res = $this->db->get()->result_array();
        //var_dump($res);
        return $res;
    }


	function getServiceByUserService() {
        $query = $this->db->get_where('service', array('fkidgroupe' => $_SESSION['idgroupe']));
        return $query->result_array();
    }

    //code6

    function getAllService(){

       $query = $this->db->get_where('service', array('id_suc_serv' => $_SESSION['fki_suc_us']));
        return $query->result_array();
    }

    function getServiceByUserSurccusale() {
        $query = $this->db->get_where('service', array('id_suc_serv' => $_SESSION['fki_suc_us']));
        return $query->result_array();
    }

    function getServiceByUserSurccusale1() {
        $query = $this->db->get_where('service', array('id_suc_serv' => $_SESSION['fki_suc_us'],'supprimer_serv' =>1));
        return $query->result_array();
    }

    function getGroupeByUser() {
        $query = $this->db->get_where('groupe', array('idgroupe' => $_SESSION['idgroupe']));
        return $query->row();
    }

    function getAllGroupe() {
		$this->db->where('isdeleted', false);
        $query = $this->db->get('groupe');
        return $query->result_array();
    }

    function getAllSurccusale() {
        $this->db->where('supprimer_suc', 1);
        $query = $this->db->get('surccusale');
        return $query->result_array();
    }

    // function getPrivileges() {
    //     //$query = $this->db->get('privileges');
    //     $query = $this->db->get_where('privileges', array('isdeleted' => false));
    //     //$this->db->where('p.isdeleted', false);
    //     return $query->result_array();
    // }

    //code6

    function getPrivileges() {
        $query = $this->db->get('privileges');
        // $query = $this->db->get_where('privileges', array('supprimer' => 1));
        // $this->db->where('p.isdeleted', false);
        return $query->result_array();
    }

    function getPrivileges1() {
        $query = $this->db->get('privileges');
        $query = $this->db->get_where('privileges', array('supprimer' => 1));
        // $this->db->where('p.isdeleted', false);
        return $query->result_array();
    }

	/*
        Liste des utilisateurs supprimés
     */
	public function getDelUsers()
	{
		$query = $this->db->get_where('user', array('deleted' => true));
		return $query->result_array();
	}

	// public function getUserIdByUsername($username)
	// {
	// 	$this->db->select('e.idemp');
	// 	$this->db->from('user u');
	// 	$this->db->join('employee e','e.idemp=u.fkidemp');
	// 	$this->db->where('u.username', $username);
	// 	$this->db->where('u.isdeleted', false);

	// 	return $this->db->get()->row('idemp');
	// }

    public function getUserIdByemail($email)
    {
        $this->db->select('id_user');
        $this->db->from('user u');
        $this->db->where('u.email', $email);

        return $this->db->get()->row('id_user');
    }

    // public function getEmailByUserId($id_user)
    // {
    //     $this->db->select('email');
    //     $this->db->from('user u');
    //     $this->db->where('u.id_user', $id_user);

    //     return $this->db->get()->row('email');
    // }

    public function getInfoUserByEmail($email)
    {
        $this->db->select('*');
        $this->db->from('user u');
        $this->db->where('u.email', $email);

        return $this->db->get()->row();
    }

    public function getUserStatutByemail($email)
    {
        $this->db->select('statut');
        $this->db->from('user u');
        $this->db->where('u.email', $email);
        
        return $this->db->get()->row('statut');
    }

    public function getListEmail()
    {
        $this->db->select('email');
        $this->db->from('user u');
        $res = $this->db->get()->result_array();
        return $res;     
    }

    //code6

    public function MailExist($email)
    {   
        $this->db->select('email');
        $this->db->from('user u');
        $result = $this->db->where('u.email', $email); 
        if($result)
            return true ;
        return false;
    }

	/*
        CREATE NEW USER
     */
	function getIdChef($idservice) {
        $query = $this->db->get_where('service', array('idservice' => $idservice));
        return $query->row()->chefservicefkidemp;
    }

	public function CreateUser($nomemp, $prenomemp, $emailemp, $titreemp, $fkidservice, $fkidprofil, $fkidgroupe)
	{
		$data = array(
			'nom_user' => $nomemp,
			'prenom_user' => $prenomemp,
			'email' => $emailemp,
			'titre' => $titreemp,
			'fki_service_us' => $fkidservice,
			'fki_profil_us' => $fkidprofil,
			'fki_suc_us' => $fkidgroupe,
			// 'ischef' => 0,
            'statut' => 3,
			// 'idchef' => 0
            // 'idchef' => $this->getIdChef($fkidservice)
		);
		$this->db->insert('user', $data);
		// $idemp = $this->db->insert_id();

		// if($idemp) {
  //           $data1 = array(
  //               'fkidemp' => $idemp,
  //               'username' => $username,
  //               'password' => $this->hashPassword($password),
  //               'isdeleted' => false,
  //               'createdat' => date('Y-m-j H:i:s')
  //           );
  //           $this->db->insert('user', $data1);

  //       }
	}

	function createPriv($libellepriv2, $courrierpriv, $employepriv, $servicepriv, $dossierpriv, $groupepriv, $privpriv) {
        $data = array(
            'libelle_priv' => $libellepriv2,
            'courrier_priv' => $courrierpriv,
            'user_priv' => $employepriv,
            'service_priv' => $servicepriv,
            'dossier_priv' => $dossierpriv,
            'group_priv' => $groupepriv,
            'priv_priv' => $privpriv,
            'supprimer' => 1
        );

        //var_dump($data);
        //die('dd');
        $this->db->insert('privileges', $data);
    }

    function updatePriv($id, $courrierpriv, $employepriv, $servicepriv,
                        $dossierpriv, $groupepriv, $privpriv) {
	    if(isset($id)) {
            $data = array(
                // 'libelle_priv' => $libellepriv,
                'courrier_priv' => $courrierpriv,
                'user_priv' => $employepriv,
                'service_priv' => $servicepriv,
                'dossier_priv' => $dossierpriv,
                'group_priv' => $groupepriv,
                'priv_priv' => $privpriv,
            );

            //var_dump($data);
            //die('dd');
            $this->db->where('id_priv', $id);
            $this->db->update('privileges', $data);
        }

    }

	/*
        UPDATE PROFILE USER
     */

	function updateUser($id, $idemp, $nomemp, $prenomemp, $emailemp, $titreemp, $fkidservice, $fkidprofil, $fkidgroupe, $username, $password) {
        $data = array(
            'nomemp' => $nomemp,
            'prenomemp' => $prenomemp,
            'emailemp' => $emailemp,
            'titreemp' => $titreemp,
            'fkidservice' => $fkidservice,
            'fkidprofil' => $fkidprofil,
            'fkidgroupe' => $fkidgroupe,
            'idchef' => $this->getIdChef($fkidservice)
        );
        $this->db->where('idemp', $idemp);
        $this->db->update('employee', $data);

        $data1 = array(
            'fkidemp' => $idemp,
            'username' => $username,
            'password' => $this->hashPassword($password),
            'isdeleted' => false,
            'createdat' => date('Y-m-j H:i:s')
        );
        $this->db->where('iduser', $id);
        $this->db->update('user', $data1);


    }

    function updateUser2($id, $nomemp, $prenomemp, $emailemp, $titreemp, $fkidservice, $fkidgroupe,$fkidprofil) {
        $data = array(
            'nom_user' => $nomemp,
            'prenom_user' => $prenomemp,
            'email' => $emailemp,
            'titre' => $titreemp,
            'fki_service_us' => $fkidservice,
            'fki_suc_us' => $fkidgroupe,
            'fki_profil_us' => $fkidprofil
            // 'idchef' => $this->getIdChef($fkidservice)
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }


	/*
        update user state
     */
	function updateUserState($id)
	{
		if (!empty($id)) {
			$user = $this->getUserById($id);
			if ($user->state == 1) $data = array('state' => 0);
			if ($user->state == 0) $data = array('state' => 1);

			$this->db->where('idUser', $id);
			$this->db->update('user', $data);
		}
	}


	/*
        deleted user
     */
	function deleteUser($id)
	{
		if (!empty($id)) {
			$data = array('statut' => 2);
			$this->db->where('id_user', $id);
			$this->db->update('user', $data);
		}
	}


    /*
        reactiver user
     */
    function ReactiverUserbyId($id)
    {
        if (!empty($id)) {
            $data = array('statut' => 1);
            $this->db->where('id_user', $id);
            $this->db->update('user', $data);
        }
    }

	function deletePriv($id) {
        if (!empty($id)) {
            $data = array('supprimer' => 0);
            $this->db->where('id_priv', $id);
            $this->db->update('privileges', $data);
        }
    }

	/*
        restore user
     */
	function restoreUser($id)
	{
		if (!empty($id)) {
			$data = array('deleted' => false);
			$this->db->where('idUser', $id);
			$this->db->update('user', $data);
		}
	}

}
