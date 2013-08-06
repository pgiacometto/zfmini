<?php

/**
 * Description of categoria
 *
 * @author Pedro Giacometto
 */
class Application_Model_Categoria extends Zend_Db_Table_Abstract
{
    protected $_name = 'categoria';
    protected $_primary = 'idcategoria';
    
    public function getAll()
    {
        $this->fetchAll();
    }
    
    public function getValores()
    {
       $select = $this->select()
               ->from($this->_name, array('idcategoria', 'nombre'));
   
       //return $this->fetchAll($select)->toArray();
       $rowset = $this->fetchAll($select);
       
       $result = array();
       
       foreach ($rowset as $row) {
           $result[$row->idcategoria] = $row->nombre;
       }
       
       return $result;
    }
    
    public function getPostCategoria($categoria = NULL)
    {
        $query = $this->select()
                ->from(array('phc' => 'post_has_categoria'),array('p.titulo','c.nombre'))
                ->join(array('p' => 'post'), 'phc.post_idpost = p.idpost',array(''))
                ->join(array('c' =>'categoria'), 'phc.categoria_idcategoria=c.idcategoria',array(''))            
                ->setIntegrityCheck(false);
              
        
        if($categoria){
            $query->where('phc.categoria_idcategoria='.$categoria);
        }
               
       return $this->fetchAll( $query );
                
    }
            
    
}

