$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#vote',
	data: {
		show: false,
		select : '../Vue/selVote.php',
		add: '../Vue/addVote.php?voteid=',
		voteid:'',
		nameVote: "",
		votes: []	
	},
	methods: {
		addItem() {
			let req = this.add+this.voteid
			console.log("req="+req)
			this.$http.get(req).then(function (response){     
				this.getVotes()
				this.voteid = ""
				this.show = true
			},function (error){
				console.log(error);
			})
		},
		getVotes() {
			this.$http.get(this.select).then(function (response) {
				this.votes = JSON.parse(response.data)
				for (let bas of this.votes) {
					this.nameVote = bas.name
				}				
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		this.getVotes()
	}
})
})