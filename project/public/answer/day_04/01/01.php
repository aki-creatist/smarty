<?php
class student
{
    //変数の設定
    public $name = '';
    public $age  = '';
    public $pref = '';

    public function __construct($name, $age, $pref)
    {
        $this->name = $name;
        $this->age  = $age;
        $this->pref = $pref;
    }

    public function showData($tbl_flg)
    {
        if ($tbl_flg === "1") {
            echo "<table border='1'>";
            echo  "<caption>" . $this->name ."'s profile </caption>";
            echo "<tr><th>name</th><th>age</th><th>language</th></tr>";
            echo "<tr><td>" . $this->name . "</td><td>" . $this->age . "</td><td>" . $this->pref . "</td></tr>";
            echo "</table>";
        } else {
            echo $this->name ."'s profile <br>";
            echo $this->name ."is " . $this->age . "years old<br>";
            echo $this->name ."is  from" . $this->pref ."<br>";
        }
    }
}
