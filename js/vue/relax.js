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
		relaxes: []
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
			this.$http.get(req).then(function (response) {
				this.relaxes = JSON.parse(response.data)				
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
		this.getRelaxes()
	}
})
})