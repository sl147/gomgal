$(document).ready(function() {
var vue_app = new Vue({
  el: '#vue2el',
	data: {
		show: false,
		select: '/Vue/selectEditOne.php?id=',
		edit:   '/Vue/edit2el.php?id=',
		add:    '/Vue/addElVote.php?name=',
		del:    '/Vue/delData2el.php?id=',
		nameElement:'',
		nameId:'',
		tbl:'',
		newname:'',
		isId:'',
		idVal:'',
		elements: []
	},
	methods: {
		add2el() {
			let req = this.add+this.newname+"&cat="+this.idVal
			console.log(req)
			this.$http.get(req).then(function (response){
				this.getAll()
				this.show = !this.show
				this.newname = ""
			},function (error){
				console.log(error)
			})
		},
		del2el(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab="+this.tbl+"&nameId="+this.nameId
				console.log("del1 delt="+delt)
				this.$http.get(delt).then(function (response) {
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}
		},
		edit2el(g){
			let req = this.edit + g.id+"&name="+g.name+"&tab="+this.tbl+"&nameEl="+this.nameElement+"&nameId="+this.nameId
			console.log("req="+req)
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})
		},
		getAll() {
			let req = this.select+this.idVal
			console.log("getAll reqsel - "+req)
			this.$http.get(req).then(function (response) {
				this.elements = JSON.parse(response.data)
					for (let bas of this.elements) {
						console.log("name - "+bas.name+"   id - "+bas.id)
					}
			},function (error){
				console.log(error)
			})
		}
	},
	created: function() {
		let get          = window.table
		this.tbl         = get["table"]
		this.nameElement = get["name"]
		this.nameId      = get["id"]
		this.isId        = get["isId"]
		this.idVal       = get["idVal"]
		console.log('editVoteOne  isId - '+this.isId+'   idVal - '+this.idVal+'  table - '+this.tbl+'    nameElement - '+this.nameElement+'    nameId - '+this.nameId)
		this.getAll()
	}	
  })
})