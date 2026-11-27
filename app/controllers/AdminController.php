<?php

class AdminController extends Controller
{
    public function users()
    {
      

        $this->view("admin/users", [
            
        ]);
    }

}
