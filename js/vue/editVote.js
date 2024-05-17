$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#vote',
	data: {
		show: false,
		select : '../Vue/selVote.php',
		add: '../Vue/addVote.php?voteid=',
		voteid:'',
		nameVote: "",
		votes: [],
	},
	methods: {
		addItem() {
			let req = this.add+this.voteid+'&count='+this.getCount()
			console.log('addItem '+req)
			this.$http.get(req).then(function (response){
				this.getVotes()
				this.voteid = ""
				this.show   = true
			},function (error){
				console.log(error);
			})
		},
		getCount(){
			for (let bas of this.votes) {
				if (bas.id == this.voteid) {
					return Number(bas.countrl) + 1
				} 
			}
			return 0
		},
		getVotes() {
			this.$http.get(this.select).then(function (response) {
				this.votes = JSON.parse(response.data)
				for (let bas of this.votes) {
					this.nameVote = bas.msg
					console.log("name - "+bas.msg+"   id - "+bas.id+"   countrl = "+bas.countrl)
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