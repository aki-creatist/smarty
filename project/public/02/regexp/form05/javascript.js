window.addEventListener('load',
    //ページロード時の処理
    function(event){
        var elem = document.getElementById('submit');
        elem.addEventListener('click', addMember, false);
    }
    , false);
//addMemberクリック時の処理
function addMember(event){
    var regist = document.getElementById('regist');
    regist.className = 'filled_table';

    //選択されたオプションを取得
    var gender = '';
    var options = document.getElementsByName('gender');
    for(var i=0; i < options.length; i++){
        if(options[i].checked){
            gender = options[i].value;
            break;
        }
    }

    var year = '';
    var options = document.getElementById('year');
    if (options.value !== "") {
        year = options.value;
    } else {
        year = "選択されていません。";
    }

    //名前を取得
    var family_name = document.getElementById('family_name');
    var family_name = family_name.value;
    var first_name = document.getElementById('first_name');
    var first_name = first_name.value;

    //値を設定
    regist.innerHTML = '';
    regist.innerHTML += '<tr><th>お名前(氏名)</th><td>'+family_name+first_name+ '</td></tr>';
    regist.innerHTML += '<tr><th>性別</th><td>'+gender+'</td></tr>';
    regist.innerHTML += '<tr><th>生年月日</th><td>'+year+'</td><tr>';

    var check = [];
    var checked = "";
    var traffic = document.getElementsByName('traffic');
    regist.innerHTML += "";

    var trafficArr = ["徒歩", "自転車", "バス", "電車", "車・バイク"];
    for (var i = 0; i < traffic.length; i++) {
        if(traffic[i].checked) {
            check[i] = i;
            if (check[i] !== "") {
                checked += " "+trafficArr[i]+" ";
            } else {
                var checked = "";
            }
        }
    }
    if (checked !== "") {
        regist.innerHTML += "<tr><th>交通手段</th><td>"+checked+"</td></tr>";
    } else {
        regist.innerHTML += "<tr><th>交通手段</th><td>何もチェックされていません。</td></tr>";
    }
}