<?php

abstract class Model {

    /**
     * @var PDO
     */
    protected $db;

    protected $table = '';

    function __construct () {

        global $app;

        $this->db = $app->db;
        
    }

    /**
     * @return array
     */
    public function getAll(){
        $model = strtolower(get_called_class());
        return $this->db->query("Select * FROM {$model}")->fetchAll();;
    }

    /**
     * @return array
     */
    public function getByPk($id){
        $model = strtolower(get_called_class());
        $sth = $this->db->prepare("Select * FROM {$model} WHERE id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetch();
    }

}

?>