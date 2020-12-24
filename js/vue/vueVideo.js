$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#vueVideo',
	data: {
		show: false,
		select : '../Vue/selVideo.php?page=',
		addF:    '/Vue/addVideo.php?idYT=',
		editF: '../Vue/editVideo.php?id=',
		delF:    '/Vue/delVue.php?id=',
		page:'',
		cat:'',
		newidYT: '',
		newTitle: '',
		videos: []	
	},
	methods: {
		add() {
			let req = this.addF+this.newidYT+"&title="+this.newTitle
			this.$http.get(req).then(function (response){     
				this.getVideos()
				this.show = !this.show
				this.newidYT = ""
				this.newTitle = ""
			},function (error){
				console.log(error)
			})
		},		
		edit(g){
			console.log("send id="+g.id+"  title-"+g.title)
			let req = this.editF + g.id+"&idYT="+g.idYT+"&title="+g.title
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},		
		del(g) {
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				var delt = this.delF + g.id+"&nameId=prid&nameTab=progrnk"
				this.$http.get(delt).then(function (response) {	          
					this.videos.splice(this.videos.indexOf(g),1)
				},function (error){
					console.log(error)
				})
			}     
		},	
		getVideos() {
			let req = this.select+this.page
			this.$http.get(req).then(function (response) {
				this.videos = JSON.parse(response.data)
/*				for (var bas of this.videos) {
					console.log("id - "+bas.id+"   idYT - "+bas.idYT+"   title - "+bas.title)
				}*/				
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		let get   = window.table
		this.page = get["page"]
		this.getVideos()
	}
})
})