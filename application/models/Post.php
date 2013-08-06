<?php

/**
 * Description of Post
 *
 * @author Pedro Giacometto
 */
class Application_Model_Post extends Zend_Db_Table_Abstract
{

    protected $_name = 'post';
    protected $_primary = 'idpost';

    //put your code here

    public function getAll()
    {
        return $this->fetchAll();
    }

    public function addPost($data)
    {
        $row = $this->createRow();
        $row->titulo = $data['titulo'];
        $row->contenido = $data['contenido'];
        // $row->setFromArray($data);
        $row->save();
    }

    public function getFila($id)
    {
        $fila = $this->find($id)->current();
        return $fila;
    }

    public function upFila($data, $id)
    {
        $fila = $this->getFila($id);
        $fila->setFromArray($data);
        $fila->save();
    }
    
   
}

