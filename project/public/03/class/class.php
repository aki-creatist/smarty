<?php

$user_name_1 = new testClass("name");
$user_name_2 = new testClass("name");
var_dump($user_name_1);
//echo $name;
//$user_name_1['name']
//privateなのでエラー
//echo $user_name_1->name . "<br>";

//これだとコンピューターが迷う
//setAge("32");

$user_name_1->setAge("32");
//echo $user_name_1->age . "<br>";
$user_name_1->setLanguage("PHP");

//var_dump($user_name_1);

$user_name_1->showTable();

$tanakaData = [
    'name'     => "tanaka",
    'age'      => "26",
    'language' => "Java"
];

echo "<br><br>";

$tanaka = new testClass2($tanakaData);

//これを実行するとエラー
//echo $tanaka->name;

$tanaka->getAge();
$tanaka->getLanguage();
$tanaka->showTable();

$personData = [
    'name'     => "satou ichirou",
    'age'      => "50",
    'language' => "C#"
];

$satou = new testClass3($personData);
$satou->viewMessage();

class testClass
{
    //変数の設定
    private  $name      = '';
    private  $age       = '';
    private  $language  = '';

    public function __construct($name)
    {
        //$thisはオブジェクトの中のname, $nameは外からはいってきたname
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
        echo $this->name . " is " . $this->age . " years old <br>";
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        echo $this->name . " uses " . $this->language . " <br>";
    }


    public function showTable()
    {
        echo "<table border='1'>";
        echo "<caption>" . $this->name ."'s profile </caption>";
        echo "<tr><th>name</th><th>age</th><th>language</th></tr>";
        echo "<tr><td>" . $this->name . "</td><td>" . $this->age . "</td><td>" . $this->language . "</td></tr>";
        echo "</table>";
    }
}

class testClass2
{
    //変数の設定
    protected $name      = '';
    protected $age       = '';
    protected $language  = '';

    public function __construct($data)
    {
        $this->name     = $data["name"];
        $this->age      = $data["age"];
        $this->language = $data["language"];
    }

    public function getAge()
    {
        echo $this->name . "  is  " . $this->age . " years old <br>";
    }

    public function getLanguage()
    {
        echo $this->name . " uses " . $this->language . " <br>";
    }

    public function showTable()
    {
        echo "<table border='1'>";
        echo "<caption>" . $this->name . "'s profile </caption>";
        echo "<tr><th>name</th><th>age</th><th>language</th></tr>";
        echo "<tr><td>" . $this->name . "</td><td>" . $this->age . "</td><td>" . $this->language . "</td></tr>";
        echo "</table>";
    }
}

//継承
class testClass3 extends testClass2
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function viewMessage($flg = true)
    {
        if($flg === true) {
            //親のクラスを呼べる
            $this->showTable();
        } else {
            echo $this->name . "<br>";
            echo $this->age . "<br>";
            echo $this->language . "<br>";
        }
    }
}
