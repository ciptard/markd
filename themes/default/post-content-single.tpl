				<div class="post-wrap single">
					<h1 class="post-title">{{post_title}}</h1>
					<div class="posted-date">Posted {{post_date}}</div>
					<div class="post-content">{{post_content}}</div>
					<div id="disqus_thread"></div>
					<script type="text/javascript">
					    var disqus_shortname = '{{disqus_shortname}}';
						var disqus_identifier = '{{post_id}}';
					    (function() {
					        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
					        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
					        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					    })();
					</script>
				</div>