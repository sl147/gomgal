$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#editOne',
	data: {
		show: false,
		select : '/Vue/selFAOne.php?id=',
		edit: '/Vue/editFAOne.php?id=',
		delete: '/Vue/deleteFAOneVue.php?id=',
		deletePhoto : '/Vue/deleteFAOnePhoto.php?id=',
		add: '../Vue/addFAPhoto.php?id=',
		id:'',
		sub:'',
		newSub: '',
		photo: '',
		image: '',
		albums: []	
	},
	methods: {	    
		addItem(item) {
			var req = this.add+item.id+'&newSub='+this.newSub+'&photo='+this.photo
			console.log("req - "+req)
/*			this.$http.get(req).then(function (response){     
				this.getFAOne()
			},function (error){
				console.log(error);
			})*/
		},
		editFAOne(item) {
			var req = this.edit+item.id+'&subscribe='+item.subscribe
			console.log("req - "+req)
			this.$http.get(req).then(function (response){     
				this.getFAOne()
			},function (error){
				console.log(error);
			})
		},
		deleteFAOne(g) {
			console.log(g)
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.delete + g.id//+"&nameId=id_foto&nameTab=photoinAlbum"
				console.log("req delete - "+delt)
				this.$http.get(delt).then(function (response) {	          
					this.albums.splice(this.albums.indexOf(g),1)
				},function (error){
					console.log(error)
				})
				delt = this.deletePhoto + g.id+"&fotoName="+g.fn+"&fotoNames="+g.fotoNames+"&idAlbum="+this.id
				console.log("req delete photo - "+delt)
				this.$http.get(delt).then(function (response) {	          

				},function (error){
					console.log(error)
				})
			}     
		},
		getFAOne() {
			var req = this.select+this.id
			console.log("req - "+req)
			this.$http.get(req).then(function (response) {
				this.albums = JSON.parse(response.data)
				for (var bas of this.albums) {
					//console.log(bas)
					//'../album/'.$id.'/'.$row['fotoName'];
					bas.fn = bas.fotoName
					bas.fotoName = '../album/'+this.id+'/'+bas.fotoName
					console.log("isFile - "+bas.isFile+"   fotoName - "+bas.fotoName+"   id_foto - "+bas.id)
					//					console.log("isFile - "+bas.isFile+"   fotoName - "+'../album/'+bas.id+'/'+bas.fotoName+"   id_foto - "+bas.id)
				}				
			},function (error){
				console.log(error);
			})
		},
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
	},
	created: function() {
		var get = window.table
		this.id = get['id']
		console.log('id-'+this.id)
		this.getFAOne()
	}
})
})