<?php

/**
 * Description of MundoController
 *
 * @author Pedro Giacometto
 */
class MundoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

        // action body
    }

    public function holaAction()
    {
       $modelCategoria = new Application_Model_Categoria();
       $result = $modelCategoria->addMultiOptions();
       var_dump($result);exit;
    }

    public function chaoAction()
    {
        $model = new Application_Model_Post();
        $post = $model->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/search.phtml');
        $paginator = Zend_Paginator::factory($post);
        $paginator->setItemCountPerPage(4);
    
        if($this->_hasParam('page')){
            $paginator->setCurrentPageNumber($this->_getParam('page'));
            
        }
        
        $this->view->paginator = $paginator;
    }
    
    public function cateAction()
    {
        $modelCategoria = new Application_Model_Categoria();
        $id = $this->_getParam('id');
        if ($id) {         
            $this->view->catePost = $modelCategoria->getPostCategoria($id);
        }else{
            $this->view->catePost = $modelCategoria->getPostCategoria();
        }
        
    }

    public function addAction()
    {
        $form = new Application_Form_Post();

        if ($this->getRequest()->isPost()) {

           if($form->isValid($this->getAllParams())){
               
               $modelPost = new Application_Model_Post();
               $modelPost->addPost($form->getValues());
               return $this->_redirect('/mundo/chao');
               
           }  else {
               $this->view->form = $form;
           }
           
        } else {
            
            $this->view->form = $form;
            
        }
    }
    
    public function updateAction()
    {
        if (!$this->_hasParam('id')) {
            return $this->_redirect('/mundo/chao');
        }

        $form = new Application_Form_Post();
        $modelPost = new Application_Model_Post();

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->getAllParams())) {

                $modelPost->upFila($form->getValues(), $this->getParam('id'));
                return $this->_redirect('/mundo/chao');
                
            } else {
                
                $this->view->form = $form;
            }
        } else {

            $row = $modelPost->getFila($this->getParam('id'));
            
            if ($row) {
                
                $form->populate($row->toArray());
            }
            $this->view->form = $form;
        }
    }
    
    public function deleteAction()
    {
        if(!$this->_hasParam('id')){
            $this->_redirect('/mundo/chao');
        }
        
        $filaDelete = new Application_Model_Post();
        
        $fila = $filaDelete->getFila($this->_getParam('id'));
        if($fila){
           $fila ->delete(); 
        }
        
        return $this->redirect('/mundo/chao');
    }


}

