<?php
$footermenu = '<li><a href="#list" data-icon="bullets">Caneuon</a></li>
                <li><a href="#amdan" data-icon="info">Amdan::About</a></li>';
                
$live = false;
?><!DOCTYPE html>
<!--<html manifest="canu.appcache">-->
<html>
<head>
<title>Y Codwr Canu</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="jquery.mobile-1.4.0.min.css" />
<style>
.ui-page
{
background-color: #000;
background: url(rygbi.jpg) ;
background-size: auto 100%;
background-attachment: fixed;
}
.ui-overlay-a, .ui-page-theme-a, .ui-page-theme-a .ui-panel-wrapper {
color: #fff;
text-shadow: 0 1px 0 #333;
}
element.style {
}
.ui-page-theme-a .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a .ui-btn, html head+body .ui-btn.ui-btn-a, .ui-page-theme-a .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a .ui-btn:visited, html head+body .ui-btn.ui-btn-a:visited{
background:rgba(246, 246, 246, 0.8);
border:#888;
}
.ui-page-theme-a .ui-btn:hover, html .ui-bar-a .ui-btn:hover, html .ui-body-a .ui-btn:hover, html body .ui-group-theme-a .ui-btn:hover, html head+body .ui-btn.ui-btn-a:hover {
background:rgba(246, 246, 246, 0.6);
}
.song{
background:rgba(255,255,255,0.8);
}
</style>

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="jquery.mobile-1.4.0.min.js"></script>
<script src="caneuon.json"></script>
<script>

$(document).on('pagecreate', '#list', function(){

    refreshList();
    
    // event handler for song selection. load the song data into the next page
    $(document).on('click', '.loadsong', function( event, data ) 
    {
        for(var i in caneuon)
        {
            var can = caneuon[i];
            if(can.id == $(this).data('song'))
            {
                $('#single h1').html(can.title);
                $('#single div[role=main]').html('<h3 class="ui-bar ui-bar-a ui-corner-all">'+can.title+'</h3>'+window.youtube(can));
                $('#single div[role=main]').append('<div class="videoplayer"></div><div class="ui-body ui-body-a ui-corner-all song"><p>'+can.lyrics+'</p></div>');
                break;
            }
        }
    });
});

// don't show an empty page
$(document).on('pagecreate', '#single', function(){
    if($(this).find('div[role=main]').children().length == 0) window.location = '#list';
    
    // set up youtube link
    $(document).on('click', '.youtube', function(event, data){
        event.preventDefault();
        $('.videoplayer').html('<iframe width="435" height="300" src="//www.youtube.com/embed/'+$(this).data('href')+'#t=30" frameborder="0" allowfullscreen style="width:100%"></iframe>');
        $(this).remove();
    });
});
$(document).on('pagecontainershow', function( event, ui ) {
  ui.prevPage.find('h3').remove();
  ui.prevPage.find('.videoplayer').remove();
  $(this).children('.song').remove();
});
    
    
$(document).on('click', '.refresh', refreshList);

function youtube(can)
{
    var html = '';
    if(can.ton != null && can.youtube != null) html = ' <a href="#" class="youtube ui-btn ui-icon-audio ui-btn-icon-left" data-href="'+can.youtube+'">'+can.ton+'</a>';
    return html;
}

function refreshList()
{
    var html = '';
    for(var i in caneuon)
    {
        var can = caneuon[i];        
        html += '<li data-icon="'+audioIcon(can)+'"><a href="#single" data-song="'+can.id+'" class="loadsong">'+can.title+'</a></li>';
    }
    $('#songlist').html(html);
    $('#songlist').listview('refresh');
}

function audioIcon(can)
{
    return (can.youtube != null) ? 'audio' : 'carat-r';
}

</script>
</head>
<body>

<div data-role="page" id="splash">

	<div data-role="header">
		<h1>Y Codwr Canu</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
        <h1 class="ui-bar ui-bar-a ui-corner-all">Codi Canu</h1>
        
        <div class="ui-body ui-body-a ui-corner-all song">
            <h3>Caneuon ac Emynau ar gyfer dathlu rygbi.</h3>
            <h4>Songs and Welsh hymns for celebrating rugby</h4>
        </div>
        <a href="#list" class="ui-btn ui-icon-carat-r ui-btn-icon-right">Caneuon</a>
        
        <div class="ui-body ui-body-a ui-corner-all song">
            <h4>teclyn gan <a href="http://twitter.com/meigwilym">@meigwilym</a></h4>
        </div>
	</div><!-- /content -->

	<div data-role="footer">
        <div data-role="navbar">
            <ul>
                <?php echo $footermenu; ?>
            </ul>
        </div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page -->

<div data-role="page" id="list" >

	<div data-role="header" data-add-back-btn="true" data-back-btn-text="'Nôl">
		<h1>Caneuon</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
    
		<form>
            <input id="filter-for-listview" data-type="search" placeholder="Chwilio...">
        </form>
        <ul id="songlist" data-role="listview" data-inset="true" data-input="#filter-for-listview" data-filter="true">
        
        </ul>
	</div><!-- /content -->

	<div data-role="footer">
		<div data-role="navbar">
            <ul>
                <?php echo $footermenu; ?>
            </ul>
        </div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page -->


<div data-role="page" id="single">

	<div data-role="header" data-add-back-btn="true" data-back-btn-text="'Nôl">
		<h1></h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		
	</div><!-- /content -->

	<div data-role="footer">
        <div data-role="navbar">
            <ul>
                <?php echo $footermenu; ?>
            </ul>
        </div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page -->


<div data-role="page" id="amdan">
	<div data-role="header" data-add-back-btn="true" data-back-btn-text="'Nôl">
		<h1>Amdan :: About</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
        <h3 class="ui-bar ui-bar-a ui-corner-all">Beth yw hwn?</h3>
        <div class="ui-body ui-body-a ui-corner-all song">
            <p><em>Don't do a  <a href="http://www.youtube.com/watch?v=RIwBvjoLyZc">John Redwood</a></em>. Mae canu'n well na meimio. </p>
            <p>Dyma app i estyn yn y dafarn ar ôl y gem. </p>
            <p>Mae rhai o'r emynau yn dod gyda fideo o'r dôn. Mae icon yn arddangos yn y rhestr. </p>
            <p>Lawrlwytho unwaith &ndash; bydd dy ffôn yn cofio pob cân. Cyfleus pan bydd signal yn wael. </p>
            <p>Platform agnostic - h.y. gweithio ar iOS, Android, Windows Mobile ayyb. </p>
            <p>Adborth, dymuniadau a chwrw i <a href="http://twitter.com/meigwilym">@meigwilym</a>. </p>
        </div>
        
        <h3 class="ui-bar ui-bar-a ui-corner-all">So What is This?</h3>
        <div class="ui-body ui-body-a ui-corner-all song">
            <p><em>Don't do a <a href="http://www.youtube.com/watch?v=RIwBvjoLyZc">John Redwood</a></em>. Singing is much more enjoyable than miming.</p>
            <p>Here's an app to reach for in the bar after a game.</p>
            <p>Some of the hymns come with a video of the tune. An icon is shown in the list. </p>
            <p>Download once and all lyrics will be kept on the phone - ideal when signal is poor. </p>
            <p>Platform agnostic - works on iPhones, Android, Windows Mobile and anything else that displays a webpage.</p>
            <p>Send requests, feedback and - ooh - a pint of lager thanks, to <a href="http://twitter.com/meigwilym">@meigwilym</a>.</p>
        </div>
	</div><!-- /content -->

	<div data-role="footer">
		<div data-role="navbar">
            <ul>
                <?php echo $footermenu; ?>
            </ul>
        </div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page -->
<?php if($live): ?>
<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(100702527); }catch(e){}</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-1193642-27', 'gwilym.net');  ga('send', 'pageview');
</script>
<?php endif; ?>
</body>
</html>