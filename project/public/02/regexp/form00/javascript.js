function button_check()
{
    name = document.getElementById('name_id').value;

    if (name === '') {
        alert('名前が入力されていません');
    } else {
        document.getElementById('write').innerHTML = name;
        alert( '入力された名前は' + name + 'です' );
    }
}