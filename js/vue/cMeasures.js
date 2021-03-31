$(document).ready(function() {
	var vue_sign = new Vue({
		el: '#length',
		data: {
			selectType : "../Vue/selCMeasuresType.php?type=",
			selectTypeActive : "../Vue/selCMeasuresTypeActive.php?type=",
			select : "../Vue/selCMeasures.php?tab=",
			editQ : "../Vue/editCQ.php?id=",
			elements:[],
			rob:[],
			types:[],
			typesActive:[],
			quantity: 1,
			first: 0,
			second:0,
			typeCalc: 0,
			show: true,
			nameFirst:'',
			l:'margin-left:40px;width: 80px;border-style:none;padding-left:10px;'		
		},
		methods: {
			sort: function() {
				this.elements.sort(function(a, b){
				let nameA=a.name.toLowerCase()
				let nameB=b.name.toLowerCase()
				if (nameA < nameB) //сортуєм стрічки по зростанню
				  return -1
				if (nameA > nameB)
				  return 1
				return 0 // Ніякого сортування
				})				
			},
			getAllActive: function(type) {
				this.$http.get(this.selectTypeActive+type).then(function (response) {
					this.typesActive = JSON.parse(response.data)
					this.sort()
				},function (error){
					console.log(error)
				})
			},
			getAll: function(type) {
				this.$http.get(this.selectType+type).then(function (response) {
					this.elements = JSON.parse(response.data)
					this.sort()
					let i = 1
					for (let r of this.elements) {
						if(i == 2) {
							this.second = r
							i += 1
						}
						if (i == 1) {
							this.first = r
							i += 1
						}
					}
				},function (error){
					console.log(error)
				})
			},
			getTypes: function() {
				console.log("getTypes start")
				this.$http.get(this.select+'typeCalculator').then(function (response) {
					this.rob = JSON.parse(response.data)
					for (let r of this.rob){
						console.log("name:"+r.name+"  tab:"+r.tab)
						if (r.type == 1) {
							this.types.push(r)
						}
					}								
				},function (error){
					console.log(error)
				})
			},
			resActive: function(t) {
				return (this.first.k > 0) ? (this.first.k/t.k * this.quantity).toFixed(5) : 0
			},
			getNameFirst: function(t){
				for (let n of this.elements) {
					if (n.id == t) {
						return n.name
					}
				}
			},
			saveQ: function(id,q) {
				q = parseInt(q) + 1
				let s = this.editQ+id+'&q='+q
				this.$http.get(s).then(function (response) {
				},function (error){
					console.log(error)
				})				
			},
			saveQuantity: function() {
				if ((this.first.k > 0) && (this.second.k > 0)) {
					this.saveQ(this.first.id,this.first.quantity)
					this.saveQ(this.second.id,this.second.quantity)
				}
			}
		},
		watch: {
			typeCalc: function() {
				console.log("this.typeCalc="+this.typeCalc)
				if(this.typeCalc>0) {
					this.elements=[]
					this.getAll(this.typeCalc)
					this.getAllActive(this.typeCalc)
					this.result   = ''
					this.quantity = 1
					this.first    = 0
					this.second   = 0
				}
			},
			first: function(){
				this.saveQuantity()
			},
			second: function(){
				this.saveQuantity()
			},
			quantity: function(val, oldVal){
				//console.log('новое значение: %s, старое значение: %s', val, oldVal)
				this.quantity = (this.quantity > 0) ? this.quantity : 1
				this.quantity = (val.length > 20) ? oldVal : val
				let m = (this.quantity.length * 10)+50
				m = (m > 500) ? 500 : m
				this.l = 'width: '+m+'px;border-style:none;padding-left:10px;margin-left:40px;'
			}
		},		
		computed: {
			result: function() {
				return ((this.first.k > 0) && (this.second.k > 0)) ? (this.first.k/this.second.k * this.quantity).toFixed(5) : 0
			}
		},
		created: function() {			
			this.getTypes()
			this.typeCalc=4	
		}		
	})
})