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
					console.log("name - "+bas.name_FA+"   id - "+bas.id_FA)
				}*/				
			},function (error){
				console.log(error);
			})
		},
		editFA(g){
			console.log("send id="+g.id_FA+"  name_FA-"+g.name_FA)
			let req = this.edit + g.id_FA+"&name_FA="+g.name_FA+"&msgs_FA="+g.msgs_FA
			console.log("req edit - "+req)
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},
		deleteFA(g) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.delete + g.id_FA+"&nameId=id_FA&nameTab=photoalbum"
				console.log("req delete - "+delt)
				this.$http.get(delt).then(function (response) {	          
					this.albums.splice(this.albums.indexOf(g),1)
				},function (error){
					console.log(error)
				})
				delt = this.deletePhoto + g.id_FA
				console.log("req delete - "+delt)
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
		console.log("page-"+this.page + '  total='+get['total'])
		this.getFA_all()
	}
})
})