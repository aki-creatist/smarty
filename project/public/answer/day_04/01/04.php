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

$matsumoto = new student("norio",31,"tokyo");
$matsumoto->showData("1");
$matsumoto->showData("0");

$fp = fopen("student.csv", "r");

while ($res = fgetcsv($fp)) {
    $member_obj = new student( $res[0],$res[1], $res[2]);
    $member_obj->showData($res[3]);
}

$matsumoto = new student2("aki", 31, "tokyo" );
$matsumoto->showData2();

class student2 extends student
{
    public function __construct($name, $age, $pref)
    {
        parent::__construct($name, $age, $pref);
    }

    public function showData2()
    {
        echo "<table border='1'>";
        echo  "<caption>" . $this->name ."'s profile </caption>";
        echo "<tr><th>name</th><th>age</th><th>language</th></tr>";
        echo "<tr><td><strong>" . $this->name . "</strong></td><td><strong>" . $this->age . "</strong></td><td><strong>" . $this->pref . "</strong></td></tr>";
        echo "</table>";
    }

}
