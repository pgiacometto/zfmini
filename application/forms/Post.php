<?php

/**
 * Description of PostForm
 *
 * @author Pedro Giacometto
 */
class Application_Form_Post extends Zend_Form
{

    public function init()
    {
        $this->addElement('text', 'titulo', array(
            'label' => 'Titulo',
            'required' => true
        ));
        $this->addElement('textarea', 'contenido', array(
             'label'=>'Contenido', 'rows'=>'6'
        ));
        $this->addElement('select', 'idcategoria', array(
             'label'=>'Categoria' 
        ));
        $this->addElement('submit', 'Guardar', array());
        
        $categoryModel = new Application_Model_Categoria();
   
        $this->idcategoria->addMultiOptions(
          $categoryModel->getValores()     
        );
    
    }
}

