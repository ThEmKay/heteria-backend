<?php

class Ajax extends CI_Controller
{
    public function item($iItemId)
    {
        $this->load->library(array('parser'));
        
        if(intval($iItemId) > 0)
        {
            
 
            $this->db->select('*')->from('item_template')->where('entry', $iItemId);
            
            $oQuery = $this->db->get();
            
            $aResult = $oQuery->row_array();
            
            
            
            
            
            if(!empty($aResult))
            {
                
                $aParse['name'] = $aResult['name'];
                
                foreach($aResult as $mKey => $mValue)
                {
                    if($mKey == 'Quality')
                    {
                        switch($mValue)
                        {
                          case 0: $aParse['quality'] = 'q0'; break;
                          case 1: $aParse['quality'] = 'q1'; break;
                          case 2: $aParse['quality'] = 'q2'; break;
                          case 3: $aParse['quality'] = 'q3'; break;
                          case 4: $aParse['quality'] = 'q4'; break;
                        }
                    }
                    
                    if($mKey == 'bonding')
                    {
                        switch($mValue)
                        {
                          case 1: $aParse['bonding'] = array(array('bind' => 'Beim Aufheben gebunden')); break;
                          case 2: $aParse['bonding'] = array(array('bind' => 'Beim Anlegen gebunden')); break;                          
                          default: $aParse['bonding'] = array(); break; 
                        }
                    }
                    
                    if($mKey == 'InventoryType')
                    {
                        switch($mValue)
                        {
                          case 1: $aParse['inventoryType'] = array(array('type' => 'kein plan')); break;
                          case 12: $aParse['inventoryType'] = array(array('type' => 'Schmuck')); break;
                          case 13: $aParse['inventoryType'] = array(array('type' => 'Einhand')); break;                          
                          default: $aParse['inventoryType'] = array(); break; 
                        }
                    }                                         
                
                
                
                
                }
                
                echo utf8_encode($this->parser->parse('item_tpl', $aParse, true));
            }
            else
            {
              echo "Fehler!";
            }
            
        }
        else
        {
            echo "Fehler!";
        }
    }
}