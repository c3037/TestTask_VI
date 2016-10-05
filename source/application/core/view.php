<?php

class View
{
	
    /*
	$view_content - виды, отображающие контент страниц;
	$view_template - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы.
	*/
	function generate($view_content, $view_template, $data = null)
	{
        
        // подключаем вид, отображающий контент страницы
        ob_start();
            require_once('application/views/'.$view_content.'.php');
            $content = ob_get_contents();
        ob_get_clean();
        
        /*
		подключаем общий шаблон (вид),
		внутри которого будет встраиваться вид
		для отображения контента конкретной страницы.
		*/
        require_once ('application/views/templates/'.$view_template.'.php');
	}
	
}
