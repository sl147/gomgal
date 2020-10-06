$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#voteAd',
	data: {
		show: false,
		select : '../Vue/selVoteAd.php',
		editF: '../Vue/editVoteAd.php?id=',
		add: '../Vue/addVote.php?voteid=',
		delF:    '/Vue/delVue.php?id=',
		voteid:'',
		nameVote: "",
		votes: []	
	},
	methods: {
		addItem() {
			var req = this.add+this.voteid
			//console.log("req - "+req)
			this.$http.get(req).then(function (response){     
				this.getVotes()
				this.voteid = ""
				this.show = true
			},function (error){
				console.log(error);
			})
		},
		edit(g){
			console.log("send id="+g.id+"  name-"+g.name)
			var req = this.editF + g.id+"&name="+g.name
			console.log("req="+req)
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},
		del(g) {
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				var delt = this.delF + g.id+"&nameId=idrl&nameTab=catVote"
				this.$http.get(delt).then(function (response) {	          
					this.votes.splice(this.votes.indexOf(g),1)
				},function (error){
					console.log(error)
				})
			}     
		},
		getVotes() {
			var req = this.select
			//console.log("req - "+req)
			this.$http.get(req).then(function (response) {
				this.votes = JSON.parse(response.data)
				for (var bas of this.votes) {
					//this.nameVote = bas.name
					console.log("name - "+bas.name+"   id - "+bas.id)
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