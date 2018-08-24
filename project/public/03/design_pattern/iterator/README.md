# Iteratorパターン

http://localhost:8080/design_pattern/iterator/

* イテレータ(Iterator)
    * 反復子と訳される
    * オブジェクトに対する繰り返し処理に適用するデザインパターン
    * 繰り返す対象は配列が、その中身を意識することなく各要素に順番にアクセスする方法を提供する
* 利点
    * データを保持するクラスに変更を加えないで、反復処理で必要なデータを取得できる
    * foreachのルーブ内にデータを選ぶ処理を記述しないため見通しの良いプログラムになる

## Standard PHP Library

* PHPではインターフェースを実装することでイテレータを定義可能
    * SPLにIteratorパターンを実装するのに必要なインターフェースとクラスがある
        * SPL: Standard PHP Library
    * インターフェース: 内容を記述しないでメソッドの外観だけを定義するもの
    * クラスにインターフェースと組み込むと定義されたメソッドを全て実装しないとエラーになる
* Iteratorパターンのインターフェースの種類
    * Iterator
        * 反復処理に利用するメソッドを全て実装する必要がある
    * IteratorAggregate
        * getIteratorメソッドのみ実装が必要

## Memberクラスの作成

### インターフェースの組み込み

* 前の手順で作成したMemberクラスのインスタンス一つが一人分の会員名簿ということになる
* 会員一覧を表示するには複数のインスタンスを一度に保持する必要がある
    * ここではMembers(複数形です)クラスを作成し、その機能を実装する
    * `implements`キーワードの後に組み込むインターフェース名`IteratorAggregate`を続けて宣言する

```php
class Members implements IteratorAggregate
{
```

### プロパティ

* `private`はクラスの中だけで参照するもの
* `$members`は配列の初期化を行う
* 配列$membersにオブジェクト形式の会員情報を蓄積する

```php
private $members = [];
```

### addメソッド

* addメソッドを使って会員情報をこのMembersクラスに追加する
* addメソッドはMemberクラスのオブジェクト$memberを引数に取る
* `()`の中のMemberは**タイプヒンティング**と呼ばれるもの
    * 引数の型をここで限定する
    * addメソッドの中の`$this->members`
        * 配列$membersをメソッドの中で参照している
    * インスタンス自身を表す`$this`と`->`を使って$this->membersで配列を表す
    * ここにMemberクラスのオブジェクト変数$memberを追加する

```php
    public function add(Member $member)
    {
        $this->members[] = $member;
    }
```

### getIteratorメソッド

* `getIterator`メソッド
    * IteratorAggregateインターフェース内に定義されている抽象メソッドをオーバーライドしたもの
    * 実際に動作するgetIteratorメソッドを定義
        * 抽象メソッドは、オーバーライドして同じ名称おメソッドを実装しないとエラーになるため
    * newキーワードでインスタンスを生成しているArrayIterator
        * SQL内に組み込まれているイテレータ関連のクラスreturn文により、返す必要がある
        * 配列$this->membersをArrayIteratorでラップして値を返している

```php
public function getIterator()
{
    return new ArrayIterator($this->members);
}
```

## Memberクラスの修正

### コンストラクタ

* コンストラクタを追加
    * 前の手順で作成したMemberクラスでインスタンスを生成するときに同時に値を設定可能にするため
* コンストラクタとは、インスタンスが生成されるときに最初に実行される処理を記述した特別のメソッド
    * `_`アンダーバーを２個先頭につけた`__construct`メソッドという決まった名称を利用する
    * このメソッドの`()`内に引数を指定して、インスタンスを作成するときに引数を指定するとコンストラクタへ値を渡せる
        * 引数と引数は`,`カンマで区切る

```php
class Member
{
    private $id;
    private $lastname;
    private $firstname;
    private $email;
    private $password;
```

### データの追加

* 以下の会員情報を`set`＋`変数名`のメソッドでオブジェクト内部のそれぞれの変数に格納する
    * 会員番号
    * 姓
    * 名
    * メールアドレス
    * パスワード

```php
public function __construct($id, $lastname, $firstname, $email, $password)
{
    $this->setId($id);
    $this->setLastname($lastname);
    $this->setFirstname($firstname);
    $this->setEmail($email);
    $this->setPassword($password);
}
```

### デストラクタ

* コンスタクタはインスタンス生成時に内部の処理を実行する
* デストラクタは、インスタンスの消滅時に処理を実行する
    * `__destruct`という名称でメソッド定義する
    * 例: あるオブジェクトを参照するオブジェクト変数が一つもなくなったときやスクリプト終了時に実行される

```php
funtion __destruct()
{
	// 処理を記述する
}
```

## 一覧表示

### ダミーデータの追加

* require_once文により、PHPファイルを読み込み実行可能
* ここではMemberクラス書き込まれた以下のクラスをを読み込んでいる
    * memberclass.php
    * membersclass.php
* `new Member`でMemberクラスのインスタンスを生成
    * このとき引数に値を指定して、Memberクラスのコンストラクタに値を渡している
* 数値はそのまま、文字列は`" "`で囲む
* 引数と引数の間は`,`カンマで区切る
    * 引数の数は、コンストラクタで設定した引数の数と同じにする必要がある
    * $member1はMemberクラスのオブジェクト$member2から$member5も同じ

### 会員データを追加

* Membersクラスに会員データを集積する
    * Membersクラスに実装したaddメソッドを使用する
* $member1から$member5までをこのメソッドでMembersクラス内部の配列に格納している

```php
// 関連ファイルを読み込みます。
require_once 'memberclass.php';
require_once 'membersclass.php';

// ダミーの会員データを作成
$member1 = new Member(1, "姓１", "名１", "email1@example.com", "password1");
$member2 = new Member(2, "姓２", "名２", "email2@example.com", "password2");
$member3 = new Member(3, "姓３", "名３", "email3@example.com", "password3");
$member4 = new Member(4, "姓４", "名４", "email4@example.com", "password4");
$member5 = new Member(5, "姓５", "名５", "email5@example.com", "password5");

// Membersクラスに会員データを追加
$members = new Members;
$members->add($member1);
$members->add($member2);
$members->add($member3);
$members->add($member4);
$members->add($member5);
```

### イテレータ

* getIteratorメソッドによりイテレータ(走査可能な配列やオブジェクト)を取得する
* foreach文には配列やオブジェクトを反復処理する機能がある
* Memberクラスの`get`＋`変数名`のメソッドで各値を取得
* print文で表示する
    * `." "`はデータの間にスペースを追加
* 最後に`.""`としてブラウザ上で開業する
* 準備ができたら、iterator.phpと同じディレクトリにmemberclass.php、membersclass.phpファイルを置いてiterator.phpを実行する
* ルートディレクトリに設置した場合はhttp://localhost/iterator.phpとすると設定した会員一覧が表示される

```php
// getIteratorによりイテレータを取得
$iterator = $members->getIterator();

// ループ処理
foreach ($iterator as $member) {
    print $member->getId()        . " ";
    print $member->getLastname()  . " ";
    print $member->getFirstname() . " ";
    print $member->getEmail()     . " ";
    print $member->getPassword()  . "<br>";
}
```
