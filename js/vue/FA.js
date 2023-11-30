$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#edit',
	data: {
		show: false,
		select : '../Vue/selFA.php?',
		like: '../Vue/like.php?id=',
		page:'',
		cat:'',
		albums: []	
	},
	methods: {
		getFAs() {
			var req = this.select
			console.log("req - "+req)
			this.$http.get(req).then(function (response) {
				this.albums = JSON.parse(response.data)
				for (var bas of this.albums) {
					console.log("name - "+bas.name+"   id - "+bas.id)
				}				
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		this.getFAs()
	}
})
})