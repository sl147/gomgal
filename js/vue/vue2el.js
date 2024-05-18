$(document).ready(function() {
var vue_app = new Vue({
  el: '#vue2el',
	data: {
		show: false,
		select: '/Vue/select2el.php?tab=',
		selectElm: '/Vue/selectElm.php?id=',
		edit:   '/Vue/edit2el.php?id=',
		add:    '/Vue/add2el.php?name=',
		del:    '/Vue/delData2el.php?id=',
		nameElement:'',
		nameId:'',
		tbl:'',
		newname:'',
		isId:'',
		idVal:'',
		elements: [],
		items: []
	},
	methods: {
		add2el() {
			let req = this.add+this.newname+"&tab="+this.tbl+"&nameEl="+this.nameElement
			console.log('reqAdd - '+req)
			this.$http.get(req).then(function (response){
				this.getAll()
				this.show = !this.show
				this.newname = ""
			},function (error){
				console.log(error)
			})
		},
		del2el(item) {
			const accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab="+this.tbl+"&nameId="+this.nameId
				this.$http.get(delt).then(function (response) {
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
				if (this.tbl == "catVote") {
					delt = this.del + item.id+"&tab=vote&nameId=category"
					this.$http.get(delt).then(function (response) {
					},function (error){
						console.log(error)
					})
				}
			}
		},
		edit2el(g){
			console.log("send id="+g.id+"  name-"+g.name)
			let req = this.edit + g.id+"&name="+g.name+"&tab="+this.tbl+"&nameEl="+this.nameElement+"&nameId="+this.nameId
			console.log("req="+req)
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})
		},
		getAll() {
			let req = this.select+this.tbl+"&name="+this.nameElement+"&id="+this.nameId+"&isId="+this.isId+"&idVal="+this.idVal
			console.log("reqsel - "+req)
			this.$http.get(req).then(function (response) {
				console.log(response.data)
				this.elements = JSON.parse(response.data)
			},function (error){
				console.log(error)
			})
		},
		getGroupItem(elm) {  //for views/vote/voteshow
			this.show = !this.show
			for (let gr of this.elements) {
				if (gr.id == elm.id) {
	            	gr.isPlus = !gr.isPlus
	            }
	            else {
	            	gr.isPlus = false
	            }
	            console.log("name - "+gr.name+"   isPlus - "+gr.isPlus+"   id - "+gr.id)
			}
			let reqEl = this.selectElm+elm.id
			console.log("reqEl - "+reqEl)
			this.$http.get(reqEl).then(function (response){
				if (JSON.parse(response.data).length > 0) {
					let resp = JSON.parse(response.data)
					if (!(resp.name == "empty")) {
						this.items = resp
			        }
			        else {
				    	this.items = []
				    }
			    }
			},function (error){
				console.log(error);
			})
		},
	},
	created: function() {
		const get        = window.table
		this.tbl         = get["table"]
		this.nameElement = get["name"]
		this.nameId      = get["id"]
		this.isId        = get["isId"]
		this.idVal       = get["idVal"]	
		console.log('112  isId - '+this.isId+'   idVal - '+this.idVal+'  table - '+this.tbl+'    nameElement - '+this.nameElement+'    nameId - '+this.nameId)
		this.getAll()
	}	
  })
})