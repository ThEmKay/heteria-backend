<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Genossenschaften
 *
 * @author Seb
 */
class Kunden extends CI_Controller{
    
    public function index(){
        
        echo '<a href="'.site_url('kunden/neu').'">Neuer Kunde</a>';
        
        $this->load->library('grid');
        $this->grid->parse('kunden_model', 'getKunden', array('edit')); 
    }
    
    public function neu(){
    
        $this->load->library(array('parser', 'form_validation'));
                
        if($this->input->post('btnSpeichern')){
            
            $this->form_validation->set_rules('fldName', 'Name', 'required|trim|is_unique[genossenschaft_basis.name]');
            $this->form_validation->set_rules('fldBranche', 'Branche', 'required|trim');
            $this->form_validation->set_rules('fldPlz', 'Postleitzahl', 'required|trim|exact_length[5]');
            $this->form_validation->set_rules('fldOrt', 'Ort', 'required|trim');
            $this->form_validation->set_rules('fldStrasse', 'Stra&szlig;e', 'required|trim');
            $this->form_validation->set_rules('fldBundesland', 'Bundesland', 'required|trim');
            
            if($this->form_validation->run()){
                
                $this->load->helper(array('text', 'inflector'));
                $clearname = strtolower(underscore(umlaute(utf8_decode($this->input->post('fldName')))));
                
                mkdir('../heteria/data/'.$clearname);
                mkdir('../heteria/data/'.$clearname.'/bilder');
                mkdir('../heteria/data/'.$clearname.'/logo');
                mkdir('../heteria/data/'.$clearname.'/mood');
                mkdir('../heteria/data/'.$clearname.'/temp');
                
                chmod('../heteria/data/'.$clearname, 0755);
                
                $this->db->select('id')->from('genossenschaft_basis')->order_by('id', 'DESC')->limit(1);
                $oResult = $this->db->get();
                $aResult = $oResult->row_array();
                
                $iNextId = intval($aResult['id'])+1;
                $this->db->insert('genossenschaft_basis', array('id' => $iNextId,
                                                                'name' => $this->input->post('fldName'),
                                                                'land' => 'de',
                                                                'branche' => $this->input->post('fldBranche')));
                
                $this->db->insert('genossenschaft_adresse', array('genossenschaft_id' => $iNextId,
                                                                  'plz' => $this->input->post('fldPlz'),
                                                                  'ort' => $this->input->post('fldOrt'),
                                                                  'strasse' => $this->input->post('fldStrasse'),
                                                                  'bundesland' => $this->input->post('fldBundesland')));
                
                $this->db->insert('genossenschaft', array('passwort' => sha1('changeme'.$iNextId),
                                                          'basis_id' => $iNextId));  
                
                $this->db->insert('genossenschaft_profil', array('basis_id' => $iNextId,
                                                                 'titel' => $this->input->post('fldName'),
                                                                 'text' => utf8_encode('Kurzer Einleitungstext über diese tolle Genossenschaft.')));                   
            }
        }
        
        $this->parser->parse('neu_view', array());        
        
        
    }
    
    public function stammdaten($iId){
    
        $this->load->model('kunden_model', 'gm');
        
        $oResult = $this->gm->getKunde($iId);
        $aResult = $oResult->row_array();

        $this->load->library(array('parser', 'form_validation'));
                
        if($this->input->post('btnSpeichern')){
            
            $this->form_validation->set_rules('fldName', 'Name', 'required|trim');
            $this->form_validation->set_rules('fldPlz', 'Postleitzahl', 'required|trim|exact_length[5]');
            $this->form_validation->set_rules('fldOrt', 'Ort', 'required|trim');
            $this->form_validation->set_rules('fldStrasse', 'Stra&szlig;e', 'required|trim');
            $this->form_validation->set_rules('fldBundesland', 'Bundesland', 'required|trim');
            
            if($this->form_validation->run()){
                
                $this->db->where('id', $iId);
                $this->db->update('genossenschaft_basis', array('name' => $this->input->post('fldName')));
                
                $this->db->where('genossenschaft_id', $iId);
                $this->db->update('genossenschaft_adresse', array('plz' => $this->input->post('fldPlz'),
                                                                  'ort' => $this->input->post('fldOrt'),
                                                                  'strasse' => $this->input->post('fldStrasse'),
                                                                  'bundesland' => $this->input->post('fldBundesland')));
            }
        }
        
        $this->parser->parse('stammdaten_view', $aResult);
  
    }
       
}

?>
