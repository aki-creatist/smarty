writeCalendar(2018, 1);

/**
 * 年(year)と月(month)を受け取って、10列×4行の表を作成
 * @param year
 * @param month
 */
function writeCalendar(year, month)
{
    var weekday = ['日', '月', '火', '水', '木', '金', '土'];
    document.write('<table>\n');
    for (var y = 0; y < 4; y++) {
        document.write('<tr>');
        for (var x = 0; x < 10; x++) {
            var date = y * 10 + x + 1;
            //インスタンスを作成
            var d = new Date(year, month-1, date);
            document.write('<td>');
            //月数のと日数を取り出して表示
            document.write((d.getMonth()+1) + '/' + d.getDate() + '<br>' + weekday[d.getDay()]);
            document.write('</td>');
        }
        document.write('</tr>\n');
    }
    document.write('</table>\n');
}
