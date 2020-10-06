let vue_app = new Vue({
  el: '#vue2el',
	data: {
		show: false,
		select: '/Vue/selNews.php?page=',
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
		items: [],
		page: 1	
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
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=msgs&nameId=id"
				this.$http.get(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
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
			let req = this.select+this.page
			console.log("reqsel - "+req)
			this.$http.get(req).then(function (response) {
				console.log("here")
				this.elements = JSON.parse(response.data)				
					for (let bas of this.elements) {
						console.log("page="+bas.page+"   title - "+bas.title+"   id - "+bas.id)
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
			//console.log("name - "+elm.name+"name - "+elm.name)
			let req = this.selectElm+elm.id
			this.$http.get(req).then(function (response){
				if (JSON.parse(response.data).length > 0) {
					let resp = JSON.parse(response.data)
					if (!(resp.name == "empty")) {
						this.items = resp
						for (let item of this.items) {
				            console.log("  msg="+item.msg+"  countrl="+item.countrl)
				        }
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
		let get          = window.table
		this.page         = get["page"]
/*		this.nameElement = get["name"]
		this.nameId      = get["id"]
		this.isId        = get["isId"]
		this.idVal       = get["idVal"]*/
		//this.idVal       = Val		
		//console.log('112  isId - '+this.isId+'   idVal - '+this.idVal+'   coun - '+coun+'  table - '+this.tbl+'    nameElement - '+this.nameElement+'    nameId - '+this.nameId)
		console.log('page='+this.page)
		this.getAll()
	}	
  })