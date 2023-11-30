$(document).ready(function() {
var vue_app = new Vue({
  el: '#length',
	data: {
		show: false,
		showEdit: false,
		seltype:"../Vue/selCMeasures.php?tab=",
		selectSub:"../Vue/selCSubMeasures.php?type=",
		select: '/Vue/selCMeasuresType.php?type=',
		edit:   '/Vue/editCMeasures.php?id=',
		add:    '/Vue/addCMeasures.php?name=',
		del:    '/Vue/delDataVue.php?id=',
		newname:'',
		k: 1,
		elements: [],
		types: [],
		rob:[],
		subs:[],
		type:'',
		idType: 1,
		typeCalc:'',
		nameType:'',
		elmsubtype:''
	},
	methods: {
		add2el: function () {
			let req = this.add+this.newname+"&k="+this.k+"&type="+this.type
			this.$http.get(req).then(function (response){     
				this.getAll()
				this.show = !this.show
				this.newname = ""
				this.k = 1
			},function (error){
				console.log(error)
			})
		},		
		deleteElement: function(item) {
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=calculator&nameid=id"
				this.$http.get(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}     
		},		
		editElement: function(item){
			let req = this.edit + item.id+"&name="+item.name+"&k="+item.k+"&type="+item.type+"&subtype="+item.subtype+"&quantity="+item.quantity+"&active="+item.active
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},
		getTypes: function() {
			this.$http.get(this.seltype+'typeCalculator').then(function (response) {
				this.rob = JSON.parse(response.data)
					for (let r of this.rob){
						if (r.type == 1) {
							this.types.push(r)
						}
					}			
			},function (error){
				console.log(error)
			})
		},	
		getAll: function() {
			this.$http.get(this.select+this.type).then(function (response) {
				this.elements = JSON.parse(response.data)			
			},function (error){
				console.log(error)
			})			
		},
		getNameType: function(t){
			for (let n of this.types) {
				if (n.id == t) {
					return n.name
				}
			}
		},	
		getSub: function() {
			this.$http.get(this.selectSub+this.type).then(function (response) {
				this.subs = JSON.parse(response.data)
				for (let n of this.subs) {
					console.log('id='+n.id+'  '+n.name)
				}			
			},function (error){
				console.log(error)
			})			
		},
	},
	watch: {
		typeCalc: function() {
			console.log('type='+this.typeCalc)
			if(this.typeCalc>0) {
				this.elements=[]
				this.nameType = this.getNameType(this.typeCalc)
				this.type = this.typeCalc
				this.getSub()
				this.getAll()
				this.showEdit = true
			}
		}
	},
	created: function() {
		this.getTypes()
	}	
  })
})