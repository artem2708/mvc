<?php

class Main extends Controller
{

    function Index()
    {
        $model = new Post();

        $this->view('template/header');
        $this->view('dashboard/index', ['posts' => $model->getAll()]);
        $this->view('template/footer');

    }

    function Article($id)
    {
        $model = new Post();

        $this->view('template/header');
        $this->view('dashboard/article', ['post' => $model->getByPk($id)]);
        $this->view('template/footer');
    }
}
?>