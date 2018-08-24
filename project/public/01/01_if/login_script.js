var name = "user";
var pass = "pass";

var db_data = [];
db_data['name'] = "username";
db_data['pass'] = "password";

if (db_data["name"] == name && db_data["pass"] == pass) {
    //会員ページの表示
    document.write("会員ページです。");
} else {
    // ログイン失敗の処理
    document.write("ログインに失敗しました。");
}