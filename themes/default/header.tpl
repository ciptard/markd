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
<script src="http://www.jotform.com/min/g=feedback" type="text/javascript">
  new JotformFeedback({
     formId		: "{{jotform_id}}",
     buttonText	: "Contact Me",
     base		: "http://www.jotform.com/",
     background	: "#0064CD",
     fontColor	: "#FFFFFF",
     buttonSide	: "right",
     buttonAlign	: "center",
     type		: 2,
     width		: 700,
     height		: 500
  });
</script>
</head>

<body>

<div class="topbar">
	<div class="fill">
		<div class="container">
			<a class="brand" href="/">{{site_title}}</a>
			<!--
			<ul class="nav">
				<li class="active"><a href="/">Home</a></li>
			</ul>
			-->
		</div>
	</div>
</div>

<div class="container">
	<div class="content">
		<div class="row">
			<div class="span10">
