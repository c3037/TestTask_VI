<?php

class Controller_Main extends Controller
{

    function action_index()
	{

        $data = array();
		$data["page_title"] = "Расписание поездок";
        
        $this->use_model('Schedule');
        $data["trips"] = $this->model->get_list();
        $data["start"] = null;
        $data["finish"] = null;
        
        try{
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            $data["start"] = (!isset($_POST['start']) or empty($_POST['start'])) ? null : htmlspecialchars($_POST['start'], ENT_QUOTES, "UTF-8");
            $data["finish"] = (!isset($_POST['finish']) or empty($_POST['finish'])) ? null :htmlspecialchars($_POST['finish'], ENT_QUOTES, "UTF-8");
            
            $data["trips"] = $this->model->get_list($data["start"], $data["finish"]);

        }
        catch(Exception $e){}
        
        $this->view->generate('view_main', 'template_main', $data);

	}
    
    function action_add()
	{

        $data = array();
		$data["page_title"] = "Добавить поездку";
        $data['status'] = null;
        
        $this->use_model('Regions');
        $data["regions"] = $this->model->get_list();
        
        $this->use_model('Couriers');
        $data["couriers"] = $this->model->get_list();
        
        try{
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            if(!isset($_POST['courier']) or empty($_POST['courier'])) throw new Exception;
            if(!isset($_POST['region']) or empty($_POST['region'])) throw new Exception;
            if(!isset($_POST['date']) or empty($_POST['date'])) throw new Exception;
            
            $this->use_model('Schedule');
            $data['status'] = $this->model->add($_POST['courier'], $_POST['region'], $_POST['date']);
            
            if(!isset($_POST['ajax']) or $_POST['ajax']!=1) throw new Exception;
            else exit($data['status']);

        }
        catch(Exception $e){}
        
        $this->view->generate('view_add', 'template_main', $data);

	}
    
    function action_delete_trip()
	{	
        $data = array();
        $data["page_title"] = "Удалить поездку";
        $data['status'] = null;
        
        try{
            $this->use_model('Schedule');
            $tmp = $this->model->get($_GET['id']);
            
            if(!isset($_GET['id']) or empty($_GET['id']) or $_GET['id'] < 0 or $tmp === "no_data")
            {
                $data['status'] = "Данных не найдено";
                throw new Exception;
            }
            
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            if(!isset($_POST['yes']) or empty($_POST['yes'])) throw new Exception;
            
            $data['status'] = $this->model->delete($_GET['id']);

        }
        catch(Exception $e){}
        
        $data = array_merge((is_array($tmp)) ? $tmp : array(), $data);
        
        if($data['status']=='success') Route::Page('/main/index');
        $this->view->generate('view_delete_trip', 'template_main', $data);
        
	}
    
    function action_regions()
	{	
        $data = array();
        $data["page_title"] = "Список регионов";
        
        $this->use_model('Regions');
        $data["regions"] = $this->model->get_list();
        
        $this->view->generate('view_regions', 'template_main', $data);
        
	}
    
    function action_add_region()
	{	
        $data = array();
        $data["page_title"] = "Добавить регион";
        $data['status'] = null;
        
        try{
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            if(!isset($_POST['name']) or empty($_POST['name'])) throw new Exception;
            if(!isset($_POST['days_in']) or empty($_POST['days_in'])) throw new Exception;
            if(!isset($_POST['days_out']) or empty($_POST['days_out'])) throw new Exception;
            
            $this->use_model('Regions');
            $data['status'] = $this->model->add($_POST['name'],$_POST['days_in'],$_POST['days_out']);
            
            if(!isset($_POST['ajax']) or $_POST['ajax']!=1) throw new Exception;
            else exit($data['status']);

        }
        catch(Exception $e){}
        
        $this->view->generate('view_add_region', 'template_main', $data);
        
	}
    
    function action_delete_region()
	{	
        $data = array();
        $data["page_title"] = "Удалить регион";
        $data['status'] = null;
        
        try{
            $this->use_model('Regions');
            $tmp = $this->model->get($_GET['id']);
            
            if(!isset($_GET['id']) or empty($_GET['id']) or $_GET['id'] < 0 or $tmp === "no_data")
            {
                $data['status'] = "Данных не найдено";
                throw new Exception;
            }
            
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            if(!isset($_POST['yes']) or empty($_POST['yes'])) throw new Exception;
            
            $data['status'] = $this->model->delete($_GET['id']);

        }
        catch(Exception $e){}
        
        $data = array_merge((is_array($tmp)) ? $tmp : array(), $data);
        
        if($data['status']=='success') Route::Page('/main/regions');
        $this->view->generate('view_delete_region', 'template_main', $data);
        
	}
    
    function action_couriers()
	{	
        $data = array();
        $data["page_title"] = "Список курьеров";
        
        $this->use_model('Couriers');
        $data["couriers"] = $this->model->get_list();
        
        $this->view->generate('view_couriers', 'template_main', $data);
        
	}
    
    function action_add_courier()
	{	
        $data = array();
        $data["page_title"] = "Добавить курьера";
        $data['status'] = null;
        
        try{
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            if(!isset($_POST['name']) or empty($_POST['name'])) throw new Exception;
            
            $this->use_model('Couriers');
            $data['status'] = $this->model->add($_POST['name']);
            
            if(!isset($_POST['ajax']) or $_POST['ajax']!=1) throw new Exception;
            else exit($data['status']);

        }
        catch(Exception $e){}
        
        $this->view->generate('view_add_courier', 'template_main', $data);
        
	}
    
    function action_delete_courier()
	{	
        $data = array();
        $data["page_title"] = "Удалить курьера";
        $data['status'] = null;
        
        try{
            $this->use_model('Couriers');
            $tmp = $this->model->get($_GET['id']);
            
            if(!isset($_GET['id']) or empty($_GET['id']) or $_GET['id'] < 0 or $tmp === "no_data")
            {
                $data['status'] = "Данных не найдено";
                throw new Exception;
            }
            
            if(!isset($_POST) or empty($_POST)) throw new Exception;
            if(!isset($_POST['yes']) or empty($_POST['yes'])) throw new Exception;
            
            $data['status'] = $this->model->delete($_GET['id']);

        }
        catch(Exception $e){}
        
        $data = array_merge((is_array($tmp)) ? $tmp : array(), $data);
        
        if($data['status']=='success') Route::Page('/main/couriers');
        $this->view->generate('view_delete_courier', 'template_main', $data);
        
	}

}
