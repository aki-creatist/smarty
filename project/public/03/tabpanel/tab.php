<style>
/* タブパネル */
.contain {
  width: 640px;
}

.contain > ul {
  margin: 0px;
  padding: 0px;
}

.contain > ul li {
  list-style-type: none;
  float: left;
  line-height: 160%;
  width: 128px;
  height: 40px;
}

.contain > ul li a {
  display: block;
  text-align: center;
  text-decoration: none;
  background-color: #cfc;
  color: #000;
  border: solid 1px Black;
}

.contain > ul li a.selected {
  background-color: #000;
  color: #fff;
}

.contain > div {
  border: 1px solid #c0c0c0;
  border-top: none;
  padding: 15px;
}
</style>

<script>
$(function() {
    var tabs = $('.contain');
    $('> ul li:first a', tabs).addClass('selected');
    $('> div', tabs).load(
        $('> ul li:first a', tabs).attr('href'));
        $('> ul li a', tabs).click(function(e) {
        if (!$(this).hasClass('selected')) {
            $('> ul li a.selected', tabs).removeClass('selected');
            $(this).addClass('selected');
            $('> div', tabs).load($(this).attr('href'));
        }
        e.preventDefault();
    });
});
</script>

<div class="contain">
<ul>
<li><a href="tab01.php">windows</a></li>
<li><a href="tab02.php">mac</a></li>
</ul>
<div style="width:225px;"></div>
</div>
