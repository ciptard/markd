<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>{{site_title}} - {{site_desc}}</title>
<meta property="og:title" content="{{site_title}}" />
<meta property="og:url" content="http://mattwalters.net" />
<meta property="og:description" content="{{site_desc}}" />
<meta property="og:site_name" content="{{site_title}}" />

<link rel="stylesheet" href="/style.css">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{{google_analytics_id}}']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

{{markd_header}}
</head>

<body>

<div class="topbar">
	<div class="fill">
		<div class="container">
			<a class="brand" href="/">{{site_title}}</a>
			{{site_navigation}}
		</div>
	</div>
</div>

<div class="container">
	<div class="content">
		<div class="row">
			<div class="span10">
