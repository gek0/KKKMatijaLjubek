<?php

class NewsController extends AdminController{

    public function getIndex()
    {
        $this->layout->content = View::make('admin.vijesti.index');
    }
}