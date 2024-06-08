$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#relax',
	data: {
		show: false,
		selRelax : '/Vue/selRelax.php?cat=',
		like: '/Vue/like.php?id=',
		page:'',
		cat:'',
		SHOWRELAX:'',
		relaxes: [],
		j:1
	},
	methods: {
		edCount(g,val) {
			let req = this.like + g.id+"&countrl="+g.countrl+"&val="+val
			this.$http.get(req).then(function (response){
				this.getRelaxes()
			},function (error){
				console.log(error)
			})	
		},	
		getRelaxes() {
			let req = this.selRelax+this.cat+'&page='+this.page+'&SHOWRELAX='+this.SHOWRELAX
			console.log('getRelaxes - '+req)
			this.$http.get(req).then(function (response) {
				this.relaxes = JSON.parse(response.data)

				for (var bas of this.relaxes) {
					console.log(bas)
					console.log("id - "+bas.id+"   category - "+bas.cat+"   msg - "+bas.msg)
				}

				for (let relax of this.relaxes) {
					this.nameVote = relax.name
					relax.num = this.j
					this.j++
				}
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		let get        = window.table
		this.cat       = get["cat"]
		this.page      = get["page"]
		this.SHOWRELAX = get["SHOWRELAX"]
		console.log("created  cat - "+this.cat+"   page - "+this.page+"   SHOWRELAX - "+this.SHOWRELAX)
		this.getRelaxes()
	}
})
})