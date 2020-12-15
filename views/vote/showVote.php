<link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css" />
<link rel="stylesheet" href="/css/main.css" />
<link rel="stylesheet" href="/css/media.css" />
<div class='vote'>
<div id="vote">
	<div class="text-center">{{nameVote}}</div>
	<div v-if="show">
		<div class='vote' v-for="vote in votes">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">			
						{{vote.msg}}
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">		
						- {{vote.countrl}}
					</div>
				</div>	
			</div>	
		</div>	
	</div>
	<div v-else>
		<div class='' v-for="vote in votes">
		<input type="radio" v-bind:value="vote.id" v-model="voteid">
			{{vote.msg}}
	
	</div>
		<br><br>
	<button @click="addItem()" class='btn btn-delta11 btn-block'>
		Проголосувати
	</button>		
	</div>
</div>
</div>
<script src="/js/jquery-1.11.3.min.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/vue-resource.min.js"></script>
<script src="/js/vue/editVote.js"></script>