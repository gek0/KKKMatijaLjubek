<?php

class NewsController extends AdminController{

    /**
     * news homepage
     */
    public function getIndex()
    {
        $this->layout->content = View::make('admin.vijesti.index');
    }

    /**
     * new news form output
     */
    public function getNova()
    {
        $this->layout->content = View::make('admin.vijesti.nova');
    }

    public function postNova()
    {
        //
    }
}