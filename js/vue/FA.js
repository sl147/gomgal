$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#edit',
	data: {
		show: false,
		select: '/Vue/selFA.php?page=',
		delete: '/Vue/delVue.php?id=',
		deletePhoto : '/Vue/deleteFAAlbumPhoto.php?id=',
		edit: '/Vue/edFA.php?id=',
		like: '/Vue/like.php?id=',
		page:'',
		cat:'',
		albums: []	
	},
	methods: {
		getFA_all() {
			var req = this.select+this.page
			console.log("req - "+req)
			this.$http.get(req).then(function (response) {
				this.albums = JSON.parse(response.data)
				/*for (var bas of this.albums) {
					console.log("name - "+bas.count+"   id - "+bas.id_FA)
				}*/			
			},function (error){
				console.log(error);
			})
		},
		editFA(g){
			let req = this.edit + g.id_FA+"&name_FA="+g.name_FA+"&msgs_FA="+g.msgs_FA
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},
		deleteFA(g) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.delete + g.id_FA+"&nameId=id_FA&tab=photoalbum"
				this.$http.get(delt).then(function (response) {	          
					this.albums.splice(this.albums.indexOf(g),1)
				},function (error){
					console.log(error)
				})
				delt = this.deletePhoto + g.id_FA
				this.$http.get(delt).then(function (response) {
				},function (error){
					console.log(error)
				})
			}     
		},
	},
	created: function() {
		let get   = window.table
		this.page = get["page"]
		this.getFA_all()
	}
})
})