$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#editOne',
	data: {
		show: false,
		select : '../Vue/selFAOne.php?id=',
		ed: '../Vue/edFA.php?id=',
		add: '../Vue/addFAPhoto.php?id=',
		del: '../Vue/delData2el.php?nameid=id&id=',
		id:'',
		sub:'',
		newSub: '',
		photo: '',
		image: '',
		albums: []	
	},
	methods: {
		onFileChange(e) {
	      var files = e.target.files || e.dataTransfer.files;
	      console.log('files - '+Object.values(files[0]))
	      console.log('files[0] - '+files[0])
	      console.log('e - '+Object.getOwnPropertyNames(files[0]).sort())
	      if (!files.length)
	        return;
	      this.createImage(files[0]);

	    },
	    createImage(file) {
	      var image = new Image();
	      var reader = new FileReader();
	      var vm = this;

	      reader.onload = (e) => {
	        vm.image = e.target.result;
	      };
	      reader.readAsDataURL(file);
	      console.log('filename-'+file.name)
	      var counter = 0;

			for (var key in file) {
			  counter++;
			  console.log( "Ключ: " + key + " значение: " + file[key] );
			}
			console.log('counter-'+counter)
	    },
	    removeImage(e) {
	      this.image = '';
	    },	    
		addItem(item) {
			var req = this.add+item.id+'&newSub='+this.newSub+'&photo='+this.photo
			console.log("req - "+req)
/*			this.$http.get(req).then(function (response){     
				this.getFAs()
			},function (error){
				console.log(error);
			})*/
		},

		edItem(item) {
			var req = this.ed+item.id+'&subscribe='+item.subscribe
			console.log("req - "+req)
			this.$http.get(req).then(function (response){     
				this.getFAs()
			},function (error){
				console.log(error);
			})
		},
		delItem(item) {
			console.log("delete")
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				var delt = this.del + item.id+"&tab="+this.table
				this.$http.get(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}     
		},
		getFAs() {
			var req = this.select+this.id
			console.log("req - "+req)
			this.$http.get(req).then(function (response) {
				this.albums = JSON.parse(response.data)
				for (var bas of this.albums) {
					console.log("fotoName - "+bas.fotoName+"   id - "+bas.id)
				}				
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		var get = window.table
		this.id = get['id']
		console.log('id-'+this.id)
		this.getFAs()
	}
})
})