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
<script type="text/javascript">
sitePath = "/";
sflakesMax = 64;
sflakesMaxActive = 20;
svMaxX = 3;
svMaxY = 3;
ssnowStick = 1;
sfollowMouse = 1;
</script>
<script type="text/javascript" src="/js/snow.js"></script>
</body>