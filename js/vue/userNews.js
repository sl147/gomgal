$(document).ready(function() {
let vue_app = new Vue({
  el: '#vue2el',
	data: {
		select: '/Vue/selUserNews.php?page=',
		del:    '/Vue/delVue.php?id=',
		comm: [],
		page: 1
	},
	methods: {		
		del2el(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=ComCl&nameId=id"
				console.log(delt)
				this.$http.get(delt).then(function (response) {
					this.getAll()
				},function (error){
					console.log(error)
				})
			}
		},
		getAll() {
			let req = this.select+this.page
			this.$http.get(req).then(function (response) {
				this.comm = JSON.parse(response.data)
				for (let bas of this.comm) {
					console.log("page="+bas.page+"   txt_com - "+bas.txt_com+"   id - "+bas.id)
				}
			},function (error){
				console.log(error)
			})
		},
	},
	created: function() {
		this.page = window.table["page"]
		this.getAll()
	}
  })
})