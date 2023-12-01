$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#edit',
	data: {
		show: false,
		select: '/Vue/selFA.php',
		delete: '/Vue/delVue.php?id=',
		like: '/Vue/like.php?id=',
		page:'',
		cat:'',
		albums: []	
	},
	methods: {
		getFA_all() {
			var req = this.select
			console.log("req - "+req)
			this.$http.get(req).then(function (response) {
				this.albums = JSON.parse(response.data)
				for (var bas of this.albums) {
					console.log("name - "+bas.name_FA+"   id - "+bas.id_FA)
				}				
			},function (error){
				console.log(error);
			})
		},
		delete(g) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.delete + g.id+"&nameId=id_FA&nameTab=photoalbum"
				this.$http.get(delt).then(function (response) {	          
					this.videos.splice(this.videos.indexOf(g),1)
				},function (error){
					console.log(error)
				})
			}     
		},
	},
	created: function() {
		this.getFA_all()
	}
})
})