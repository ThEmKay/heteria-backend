<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of genossenschaften_model
 *
 * @author Seb
 */
class Kunden_model extends CI_Model {
    
    public function getKunden($f = 'name', $s = 'ASC'){
        
        $this->db->select('nummer, id, name, land, branche')
                 ->from('genossenschaft_basis gb')
                 ->join('genossenschaft g', 'g.basis_id = gb.id')
                 ->order_by($f, $s);
        
        return $this->db->get();
        
    }
    
    public function getKunde($id = 0){
        if($id > 0){
            
            $this->db->select('*')
                     ->from('genossenschaft_basis gb')
                     ->join('genossenschaft_adresse ga', 'ga.genossenschaft_id = gb.id')
                     ->join('genossenschaft g', 'gb.id = g.basis_id')
                     ->where('gb.id', $id);
 
            return $this->db->get();
        }
        return array();
    }
    
    
}

?>
