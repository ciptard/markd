			</div> <!-- span10 -->
			<div class="span4">
				{{markd_sidebar}}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

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


<script src="/common.js" type="text/javascript"></script>

</body>
</html>