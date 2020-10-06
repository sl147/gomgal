$(document).ready(function() {
let vue_app = new Vue({
  el: '#vue2el',
	data: {
		select: '/Vue/selCommentNews.php?page=',
		del:    '/Vue/delData2el.php?id=',
		elements: [],
		page: 1	
	},
	methods: {		
		del2el(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=Comment&nameId=id_com"
				this.$http.get(delt).then(function (response) {	          
					//this.elements.splice(this.elements.indexOf(item),1)
					this.getAll()
				},function (error){
					console.log(error)
				})
			}     
		},		
		getAll() {
			let req = this.select+this.page
			console.log("reqsel - "+req)
			this.$http.get(req).then(function (response) {
				console.log(response.data)
				this.elements = JSON.parse(response.data)
				for (let bas of this.elements) {
					console.log("page="+bas.page+"   txt_com - "+bas.txt_com+"   id - "+bas.id)
				}			
			},function (error){
				console.log(error)
			})
		},		
	},
	created: function() {
		this.page = window.table["page"]
		console.log('page='+this.page)
		this.getAll()
	}	
  })
})