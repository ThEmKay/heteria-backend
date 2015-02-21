<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grid
 *
 * @author Seb
 */
class Grid {
    
    private $oCI = null;
    
    public function __construct() {
        $this->oCI =& get_instance();
    }
    
    public function parse($model = '', $function = '', $options = array()){
        
        $this->oCI->load->library('parser');
        
        if($model != '' && $function != ''){
        
            $this->oCI->load->model($model);
            
            $f = '';
            $s = 'ASC';
            if($this->oCI->input->get('f')){
                $f = $this->oCI->input->get('f');
            }
            if($this->oCI->input->get('s')){
                $s = $this->oCI->input->get('s');
            }

            if($this->oCI->input->get()){
            $oResult = $this->oCI->{$model}->{$function}($f, $s);    
            }else{
            $oResult = $this->oCI->{$model}->{$function}();
            }

            $arr = $oResult->result_array();
            if(!empty($arr)){
                
                $bInd = true;
                foreach($arr as $row){
                    
                    // Leerfeld im Titel für Optionen (Bearbeiten Button etc.)
                    if(!empty($options)){
                        $aPrep['row'][-1]['col'][0]['content'] = '&nbsp;';
                    }
                    
                    foreach($row as $key => $col){
                        if($bInd){
                            $sort = 'ASC';
                            if($f == $key){
                                switch($s){
                                    case 'ASC': $sort = 'DESC'; break;
                                    case 'DESC': $sort = 'ASC'; break;
                                }
                            }
                            $aPrep['row'][-1]['col'][]['content'] = '<a href="'.current_url().'?f='.$key.'&s='.$sort.'">'.$key.'</a>';
                        } 
                        
                        // Optionen (Bearbeiten Button etc.)
                        $sOpt = '';
                        if(!empty($options)){
                            if(in_array('edit', $options)){
                                $sOpt.= '<a href="'.site_url('kunden/stammdaten').'/'.$row['id'].'">edit</a>';
                            }
                            $aPrep['row'][$row['id']]['col'][0]['content'] = $sOpt;
                        }
                        
                        $aPrep['row'][$row['id']]['col'][]['content'] = utf8_decode($col);
                    }
                    $bInd = false;
                }

                $aPrep['table'] = $aPrep;
            }

            if(!empty($aPrep)){
                $this->oCI->parser->parse('tabelle_view', $aPrep);
            }
        } 
        
    }
    
    
}

?>
