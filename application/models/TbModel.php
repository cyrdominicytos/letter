<?php

/**
 * User: Edgar AYENA
 * Date: 13/12/2018
 * ayenadedg@gmail.com
 * +229 95 80 53 26
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class TbModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// function nbatraiter() {
 //        $this->db->select('count(*) as nb');
 //        $this->db->from('couriertraiter ct');
 //        $this->db->where('ct.destCourier', $_SESSION['idemp']);
 //        $this->db->where('ct.isread', 0);
 //        $this->db->where('ct.stateCourierTraite', 'Traite courrier');
 //        return $this->db->get()->row()->nb;
 //    }

    function nbatraiter() {
        $this->db->select('count(*) as nb');
        $this->db->from('diffusion d');
        $this->db->join('user u', 'u.id_user=d.fki_user_dif');
        $this->db->where('u.fki_suc_us', $_SESSION['fki_suc_us']);
        $this->db->where('d.fki_user_dif', $_SESSION['userid']);
        $this->db->where('d.fki_statut_dif', 1);
        return $this->db->get()->row()->nb;
    }


    // function nbmyservice() {
    //     $this->db->select('count(*) as nb');
    //     $this->db->from('courier c');
    //     $this->db->where('c.serviceInit', $_SESSION['idservice']);
    //     return $this->db->get()->row()->nb;
    // }

     function nbmyservice() {

        // $this->db->select('count(id_courrier) as nb');
        $this->db->select('count(distinct(fki_courrier_dif)) as nb');
        $this->db->from('diffusion d');
        // $this->db->from('courrier c');
        // $this->db->where('c.service_dest', $_SESSION['idservice']);
        // $this->db->or_where('c.exp_courrier', 14);
        // $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
        $this->db->join('user u', 'u.id_user=d.fki_user_dif');
        $this->db->join('service s', 's.id_service=u.fki_service_us');
        // $this->db->where('u.fki_suc_us', $_SESSION['fki_suc_us']);
        $this->db->where('u.fki_service_us', $_SESSION['idservice']);
        // $this->db->group_by('fki_courrier_dif');
        return $this->db->get()->row()->nb;
    }

    // function nbenregistre() {
    //     $this->db->select('count(*) as nb');
    //     $this->db->from('courier c');
    //     $this->db->where('c.expCourier', $_SESSION['idemp']);
    //     return $this->db->get()->row()->nb;
    // }

    function nbenregistre() {
        $this->db->select('count(*) as nb');
        $this->db->from('courrier c');
        $this->db->join('user u', 'u.id_user=c.exp_courrier');
        $this->db->where('c.exp_courrier', $_SESSION['userid']);
        $this->db->where('u.fki_suc_us', $_SESSION['fki_suc_us']);
        return $this->db->get()->row()->nb;
    }

    // function nbencopie() {
    //     $this->db->select('count(*) as nb');
    //     $this->db->from('listdiffusioncourier ldc');
    //     $this->db->where('ldc.fkIdDest', $_SESSION['idemp']);
    //     return $this->db->get()->row()->nb;
    // }

    function nbencopie() {
        $this->db->select('count(*) as nb');
        $this->db->from('diffusion d');
        $this->db->join('user u', 'u.id_user=d.fki_user_dif');
        $this->db->where('u.fki_suc_us', $_SESSION['fki_suc_us']);
        $this->db->where('d.fki_user_dif', $_SESSION['userid']);
        $this->db->where('d.fki_statut_dif', 4);
        return $this->db->get()->row()->nb;
    }



    function urgent1()
    {
        $this->db->select("*,DATEDIFF(dateLimittraiteCourier, CURDATE()) as jr");
        $this->db->from('couriertraiter ct');
        //$this->db->join('courier c', 'c.idcourier=ct.fkIdcourier');
        $where = "DATEDIFF(dateLimittraiteCourier, CURDATE()) BETWEEN 2 AND 23";
        $this->db->where($where);
        $this->db->where('ct.destCourier', $_SESSION['idemp']);
		$this->db->where('ct.stateCourierTraite', 'Traite courrier');
        return $this->db->get()->result_array();

        /*return $this->db->get()->row()->nb;
        $query = " SELECT d.* , DATEDIFF( STR_TO_DATE(d.dat_depot_dao, '%d/%m/%Y') , CURDATE() ) as jr FROM dao d
									   WHERE DATEDIFF( STR_TO_DATE(d.dat_depot_dao, '%d/%m/%Y') , CURDATE() ) BETWEEN 2 AND 7
									   and d.daoUserGroupId = '".$id_group."' and d.statut_dao != 'Déposé' limit 3";
        $query = $this->db->query($query);*/
    }

    //  function urgent()
    // {
    //     $this->db->select("*");
    //     $this->db->from('courrier');
    //     return $this->db->get()->result_array();
    // }

     function urgent()
    {
        $this->db->select('DATE_FORMAT(date_limite, "%d-%m-%Y") as date_limite,num_courrier,id_dif,id_courrier,priorite_courrier,DATEDIFF(date_limite, CURDATE()) as jr');
        $this->db->from('courrier c');
        //$this->db->join('courier c', 'c.idcourier=ct.fkIdcourier');
        $where = "DATEDIFF(date_limite, CURDATE()) BETWEEN 1 AND 15";
        $this->db->join('diffusion d', 'c.id_courrier=d.fki_courrier_dif');
        $this->db->where($where);
        $this->db->where('d.fki_user_dif', $_SESSION['userid']);
        $this->db->where('d.fki_statut_dif', 1);
        $this->db->order_by('jr');
        return $this->db->get()->result_array();
    }

}
