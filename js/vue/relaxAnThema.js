$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#relax',
	data: {
		show: false,
		select : '/Vue/selRelaxAnThema.php?cat=',
		like: '/Vue/like.php?id=',
		page:'',
		cat:'',
		SHOWRELAX:'',
		relaxes: []	
	},
	methods: {
		edCount(g,val) {
			const req = this.like + g.id+"&countrl="+g.countrl+"&val="+val
			this.$http.get(req).then(function (response){
				this.getRelaxes()
			},function (error){
				console.log(error)
			})	
		},	
		getRelaxes() {
			const req = this.select+this.cat+'&page='+this.page+'&SHOWRELAX='+this.SHOWRELAX
			console.log(req)
			this.$http.get(req).then(function (response) {
				this.relaxes = JSON.parse(response.data)			
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		var get   = window.table
		this.cat  = get["cat"]
		this.page = get["page"]
		this.SHOWRELAX = get["SHOWRELAX"]
		console.log('cat='+this.cat+'   page='+this.page+'  SHOWRELAX='+this.SHOWRELAX)
		this.getRelaxes()
	}
})
})