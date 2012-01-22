			</div> <!-- span10 -->
			<div class="span4">
				<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
				<script>
				new TWTR.Widget({
				  version: 2,
				  type: 'profile',
				  rpp: 4,
				  interval: 30000,
				  width: 'auto',
				  theme: {
				    shell: {
				      background: '#ffffff',
				      color: '#000000'
				    },
				    tweets: {
				      background: '#ffffff',
				      color: '#666666',
				      links: '#0067d6'
				    }
				  },
				  features: {
				    scrollbar: false,
				    loop: false,
				    live: true,
				    behavior: 'all'
				  }
				}).render().setUser('{{twitter_username}}').start();
				</script>
				<div class="side-buttons">
					<a class="btn primary" href="/feed">RSS</a>
				</div>
			</div> <!-- span4 -->
		</div> <!-- row -->
		<div class="row">
			<div class="span12">
				<div class="pagination">
					<ul>
						{{page_previous}}
						{{page_next}}
					</ul>
				</div>
			</div>
			<div class="span4"></div>
		</div> <!-- row -->
	</div> <!-- content -->

    <footer>
      	<p>&copy; Matt Walters {{current_year}}</p>
		{{markd_footer}}
    </footer>

</div> <!-- container -->
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
</body>
</html>