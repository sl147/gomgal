$(document).ready(function() {
let vue_app = new Vue({
  el: '#vue2el',
	data: {
		show: false,
		select: '/Vue/selPoster.php?page=',
		selectElm: '/Vue/selectElm.php?id=',
		edit:   '/Vue/edit2el.php?id=',
		add:    '/Vue/add2el.php?name=',
		del:    '/Vue/delVue.php?id=',
		nameElement:'',
		nameId:'',
		tbl:'',
		newname:'',
		isId:'',
		idVal:'',
		elements: [],
		items: [],
		page: 1
	},
	methods: {
		add2el() {
			let req = this.add+this.newname+"&tab="+this.tbl+"&nameEl="+this.nameElement
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
				let delt = this.del + item.id+"&tab=poster&nameId=id_poster"
				this.$http.get(delt).then(function (response) {
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}
		},
		edit2el(g){
			let req = this.edit + g.id+"&name="+g.name+"&tab="+this.tbl+"&nameEl="+this.nameElement+"&nameId="+this.nameId
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})
		},
		getAll() {
			let req = this.select+this.page
			this.$http.get(req).then(function (response) {
				this.elements = JSON.parse(response.data)
					for (let bas of this.elements) {
						console.log("page="+bas.page+"   title_p - "+bas.title_p+"   id - "+bas.id)
					}
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
			let req = this.selectElm+elm.id
			this.$http.get(req).then(function (response){
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
		let get   = window.table
		this.page = get["page"]
		this.getAll()
	}
  })
})