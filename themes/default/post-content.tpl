<div class="post-wrap well">
	<h2 class="post-title"><a href="{{post_permalink}}">{{post_title}}</a></h2>
	<div class="posted-date">Posted {{post_date}}</div>
	<div class="post-content">{{post_content}}</div>
	<script type="text/javascript">
	    var disqus_shortname = '{{disqus_shortname}}';
	    (function () {
	        var s = document.createElement('script'); s.async = true;
	        s.type = 'text/javascript';
	        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
	        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
	    }());
	</script>
	<div class="comment-count">
		<a href="{{post_permalink}}#disqus_thread" data-disqus-identifier="{{post_id}}">Comments</a>
	</div>
</div>
