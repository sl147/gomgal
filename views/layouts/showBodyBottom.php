<!--<script type="text/javascript">
	$('.rightSide').remove();
	alert('empty');
</script> -->
	<?php include 'views/layouts/footer.php';?>
	<script src="/libs/fancybox/jquery.fancybox.pack.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/vue.min.js"></script>
	<script src="/js/vue-resource.min.js"></script>
	<noscript>		
		<style>
			img[data-src] {
				display: none !important;
			}
		</style>
	</noscript>

	<script>
		let images = document.querySelectorAll("img");
		lazyload(images);
	</script>
</body>