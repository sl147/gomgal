(function( $ ) {
	var vue_ins = new Vue({
		el: '#sljarInsurance',
		data: {
			k1:1,
			k11:0,
			k2: 1.5,
			k21:4,
			k3: 1,
			k31: 0,
			k4:1,
			k41:0,
			k4:1.55,
			k5: 1,
			k51: 0,
			k6: 1,
			k7: 1,
			k71: 0,
			k8: 1,
			k9:1,
			base: 180,
			used: 1,
			usedTZ: 1,
			showk1: 0,
			showk41: 0,
			showk42: 0,
			showname: '',
			fr:2,
			options_Fr: [
				{ text: '2600',value: 0 },
				{ text: '1300', value: 1},
				{ text: '0', value: 2}
			],
			options_k1: [
				{ type: 'B1', name: 'до 1600 куб.см',                           value: 0  },
				{ type: 'B2', name: 'від 1601 до 2000 куб.см',                  value: 1},
				{ type: 'B3', name: 'від 2001 до 3000 куб.см',                  value: 2  },
				{ type: 'B4', name: '3001 куб.см і більше',                     value: 3 },
				{ type: 'ЕМ', name: 'електромобіль (з силовим електродвигуном, окрім гібридних авто)',value: 4 },
				{ type: 'A1', name: 'мотоцикли і моторолери до 300 см. куб',    value: 5 },
				{ type: 'A2', name: 'мотоцикли і моторолери понад 300 см. куб', value: 6 },
				{ type: 'C1', name: 'Вантажні а/м до 2т',                       value: 7 },
				{ type: 'C2', name: 'Вантажні а/м понад 2т',                    value: 8 },
				{ type: 'D1', name: 'Автобуси до 20 чол',                       value: 9 },
				{ type: 'D2', name: 'Автобуси понад 20 чол',                    value: 10 },
				{ type: 'F', name: 'Причепи до легкових автомобілів',           value: 11 },
				{ type: 'E', name: 'Причепи до вантажних автомобілів',          value: 12 },
			],

			value_k1: [
				{ type: 'B1', name: 'до 1600 куб.см',                           value: [1,1,1]  },
				{ type: 'B2', name: 'від 1601 до 2000 куб.см',                  value: [1.14,1.14,1.14]},
				{ type: 'B3', name: 'від 2001 до 3000 куб.см',                  value: [1.18,1.18,1.18]  },
				{ type: 'B4', name: '3001 куб.см і більше',                     value: [1.82,1.82,1.82]  },
				{ type: 'ЕМ', name: 'електромобіль (з силовим електродвигуном, окрім гібридних авто)',value: [0.9,0.9,0.9] },
				{ type: 'A1', name: 'мотоцикли і моторолери до 300 см. куб',    value: [0.34,0.34,0.34] },
				{ type: 'A2', name: 'мотоцикли і моторолери понад 300 см. куб', value: [0.68,0.68,0.68] },
				{ type: 'C1', name: 'Вантажні а/м до 2т',                       value: [2,2,2] },
				{ type: 'C2', name: 'Вантажні а/м понад 2т',                    value: [2.18,2.18,2.18] },
				{ type: 'D1', name: 'Автобуси до 20 чол',                       value: [2.55,2.55,2.55] },
				{ type: 'D2', name: 'Автобуси понад 20 чол',                    value: [3,3,3] },
				{ type: 'F', name: 'Причепи до легкових автомобілів',           value: [0.34,0.34,0.34] },
				{ type: 'E', name: 'Причепи до вантажних автомобілів',          value: [0.5,0.5,0.5] },
			],			
			value_k2: [
				{ text: 'Київ',                   value: [4.8,4.8,4.8] },
				{ text: 'Львів, Дніпро,Одеса, Харків,Бориспіль Ірпінь',       value: [3.5,3.5,3.5] },
				{ text: 'від 500 тис до 1 млн',   value:[2.8,2.8,2.8] },
				{ text: 'від 100 тис до 500 тис', value:[2.5,2.5,2.5]},
				{ text: 'інші населені пункти',   value:[1.5,1.5,1.5]  },	
				{ text: 'Іноземна реєстрація',    value:[5,5,5] },
			],
			options_k2: [
				{ text: 'Київ',                   value: 0 },
				{ text: 'Львів, Дніпро,Одеса, Харків,Бориспіль Ірпінь', value: 1 },
				{ text: 'від 500 тис до 1 млн',   value:2 },
				{ text: 'від 100 тис до 500 тис', value:3},
				{ text: 'інші населені пункти',   value:4  },	
				{ text: 'Іноземна реєстрація',    value:5 },
			],
			value_k3: [
				{ text: 'фіз особа(не таксі)',       value: 1 },
				{ text: 'юр особа(не таксі)',        value: 1},
				{ text: 'Вантажні а/м, автобуси',    value: 1 },
				{ text: 'а/м для надання послуг ФО', value: 1.4 },
				{ text: 'а/м для надання послуг ЮО', value: 1.5 },
			],
			options_k3: [
				{ text: 'фіз особа(не таксі)',       value: 0 },
				{ text: 'юр особа(не таксі)',        value: 1 },
				{ text: 'Вантажні а/м, автобуси',    value: 2 },
				{ text: 'а/м для надання послуг фіз особа (таксі)', value: 3 },
				{ text: 'а/м для надання послуг юр. особа (таксі)', value: 4 },
			],
			value_k4: [
				{ text: 'фіз особа',value: 1.6 },
				{ text: 'юр особа', value: 1.2 },
			],
			options_k4: [
				{ text: 'фіз особа',value: 0 },
				{ text: 'юр особа', value: 1 },
			],
			value_k5: [
				{ text: '12 місяців', value: 1,},
				{ text: '11 місяців', value: 0.95 },
				{ text: '10 місяців', value: 0.9 },
				{ text: '9 місяців',  value: 0.85 },
				{ text: '8 місяців',  value: 0.8 },
				{ text: '7 місяців',  value: 0.75 },
				{ text: '6 місяців',  value: 0.7 }
			],			
			options_k5: [
				{ text: '12 місяців', value: 0,},
				{ text: '11 місяців', value: 1 },
				{ text: '10 місяців', value: 2 },
				{ text: '9 місяців',  value: 3 },
				{ text: '8 місяців',  value: 4 },
				{ text: '7 місяців',  value: 5 },
				{ text: '6 місяців',  value: 6 }
			],
			value_k7: [
				{ text: '12 місяців', value: 1,},
				{ text: '11 місяців', value: 0.95 },
				{ text: '10 місяців', value: 0.9 },
				{ text: '9 місяців',  value: 0.85 },
				{ text: '8 місяців',  value: 0.8 },
				{ text: '7 місяців',  value: 0.75 },
				{ text: '6 місяців',  value: 0.7 },
				{ text: '5 місяців',  value: 0.6 },
				{ text: '4 місяців',  value: 0.5 },
				{ text: '3 місяці',   value: 0.4 },
				{ text: '2 місяці',   value: 0.3 },
				{ text: '1 місяць',   value: 0.2 },
				{ text: '15 днів',    value: 0.15 },
			],
			options_k7: [
				{ text: '12 місяців', value: 0,},
				{ text: '11 місяців', value: 1 },
				{ text: '10 місяців', value: 2 },
				{ text: '9 місяців',  value: 3 },
				{ text: '8 місяців',  value: 4 },
				{ text: '7 місяців',  value: 5 },
				{ text: '6 місяців',  value: 6 },
				{ text: '5 місяців',  value: 7 },
				{ text: '4 місяців',  value: 8 },
				{ text: '3 місяці',   value: 9 },
				{ text: '2 місяці',   value: 10 },
				{ text: '1 місяць',   value: 11 },
				{ text: '15 днів',    value: 12 },
			],
			options_k8: [
				{ text: 'паперовий носій',   value: 1,},
				{ text: 'електронний носій', value: 0.9,},
			],
			options_k9: [
				{ text: 'без пільг',         value: 1   },
				{ text: 'пенсіонери',        value: 0.5 },
				{ text: 'інваліди ІІ групи', value: 0.5 },
				{ text: 'особи, які постраждали внаслідок Чорнобильської катастрофи', value:0.5 },
				{ text: 'учасники війни',    value: 0.5 }
			],
			//Фіз.особи k4, не таксі k3 не електромобілі B1-B4 A1 A2 F E
			k611: [
				[1.08,1.18,1.32],
				[1.08,1.18,1.32],
				[1.06,1.16,1.29],
				[1.03,1.12,1.25],
				[1.03,1.12,1.25],
				[1.03,1.12,1.25],
			],
			//Фіз.особи k4, не таксі k3 електромобілі B5
			k612: [
				[1.19,1.31,1.46],
				[1.19,1.31,1.46],
				[1.17,1.29,1.43],
				[1.14,1.25,1.39],
				[1.14,1.25,1.39],
				[1.14,1.25,1.39],
			],
			//Юр.особи k4, не таксі k3 не електромобілі B1-B4 A1 A2 F E
			k613: [
				[1.29,1.42,1.58],
				[1.29,1.42,1.58],
				[1.27,1.39,1.55],
				[1.23,1.35,1.50],
				[1.23,1.35,1.50],
				[1.23,1.35,1.50],
			],
			//Юр.особи k4, не таксі k3 електромобілі B5
			k614: [
				[1.43,1.57,1.75],
				[1.43,1.57,1.75],
				[1.41,1.54,1.72],
				[1.37,1.50,1.67],
				[1.37,1.50,1.67],
				[1.37,1.50,1.67],
			],
			//Фіз.особи k4, не таксі k3 D1 D2
			k615: [
				[1.61,1.77,1.98],
				[1.61,1.77,1.98],
				[1.58,1.74,1.94],
				[1.54,1.69,1.88],
				[1.54,1.69,1.88],
				[1.54,1.69,1.88],
			],
			//Юр.особи k4, не таксі k3 D1 D2
			k616: [
				[2.15,2.36,2.63],
				[2.15,2.36,2.63],
				[2.11,2.31,2.58],
				[2.05,2.25,2.51],
				[2.05,2.25,2.51],
				[2.05,2.25,2.51],
			],			
			//Фіз.особи k4, не таксі k3 C1 C2
			k617: [
				[1.24,1.36,1.51],
				[1.24,1.36,1.51],
				[1.21,1.33,1.49],
				[1.18,1.29,1.44],
				[1.18,1.29,1.44],
				[1.18,1.29,1.44],
			],
			//Юр.особи k4, не таксі k3 C1 C2
			k618: [
				[1.65,1.81,2.02],
				[1.65,1.81,2.02],
				[1.62,1.77,1.98],
				[1.57,1.72,1.92],
				[1.57,1.72,1.92],
				[1.57,1.72,1.92],
			],
			//таксі всі однакові k31 = 3,4
			k619: 3
		},
		computed: {
			suma: function(){
				s = this.base * this.k1 * this.k2 * this.k3 * this.k4 * this.k5 * this.k6 * this.k7 * this.k8 * this.k9
				return (isNaN(s)) ? (0).toFixed(0) : (s).toFixed(0)
			}			
		},
		watch: {
			k11: function() {
				this.k1 = this.value_k1[this.k11].value[this.fr]
				this.switchk1()
				if ((this.k11 == 9) || (this.k11 == 10)) {
					this.k51 = 6
					this.k5  = 1
					this.k71 = 6
					this.k7  = 0.5
					this.showk1 = 1
					this.showk42 = ((this.showk41 == 1) || (this.showk42 == 1)) ? 1 : 0
					this.showk41 = 0
					this.showname = this.value_k1[this.k11].name
				}
				else {
					this.showk1 = 0
					this.showk41 = ((this.showk41 == 1) || (this.showk42 == 1)) ? 1 : 0
					this.showk42 = 0
					if (this.k51 == 6) {
						this.k51 = 0
						this.k5  = this.value_k5[this.k51].value
					}
					if (this.k71 == 6) {
						this.k71 = 0
						this.k7  = this.value_k7[this.k71].value
					}
				}
				this.printShow()
			},
			k21: function() {
				this.k2 = this.value_k2[this.k21].value[this.fr]
				this.switchk1()
			},
			k31: function() {
				this.k3 = this.value_k3[this.k31].value
				switch (this.k31) {
					case 0:
						this.k4  = this.value_k4[0].value
						this.k41 = 0
						this.showk41 = 0
						this.showk42 = 0
						break;
					case 1:
						this.k4  = this.value_k4[1].value
						this.k41 = 1
						this.showk41 = 0
						this.showk42 = 0
						break;
					case 2:
						this.k4  = this.value_k4[0].value
						this.k41 = 0
						this.showk41 = 0
						this.showk42 = 0
						break;
					case 3:
						this.k4  = this.value_k4[0].value
						this.k41 = 0
						this.fr  = 0
						if (this.showk1 == 0) {
							this.showk41 = 1
							this.showk42 = 0
						}else{
							this.showk41 = 0
							this.showk42 = 1
						}
						break;
					case 4:
						this.k4  = this.value_k4[1].value
						this.k41 = 1
						this.fr  = 0
						if (this.showk1 == 0) {
							this.showk41 = 1
							this.showk42 = 0
						}else{
							this.showk41 = 0
							this.showk42 = 1
						}
						break;
				}		
				this.switchk1()
				this.printShow()
			},
			k41: function() {
				this.k4 = this.value_k4[this.k41].value
				switch (this.k41) {
					case 0:
						if ((this.k31 == 1) || (this.k31 == 4)) {
							this.k3  = this.value_k3[0].value
							this.k31 = 0
						}
						break
					case 1:
						if ((this.k31 == 0) || (this.k31 == 2) || (this.k31 == 3)) {
							this.k3  = this.value_k3[1].value
							this.k31 = 1
						}
						break
				}
				this.switchk1()
			},
			k51: function() {
				this.ifk5171()			
			},
			k71: function() {
				this.ifk5171()
			},
			fr: function() {
				if ((this.k31 == 3) || (this.k31 == 4)) {
					this.fr = 0
				}
				else {
					this.k1 = this.value_k1[this.k11].value[this.fr]
					this.k2 = this.value_k2[this.k21].value[this.fr]
					this.k3 = this.value_k3[this.k31].value
					this.k4 = this.value_k4[this.k41].value
				}
				this.switchk1()
			}
		},	
		methods: {
			ifk5171: function() {
				if ((this.k11 == 9) || (this.k11 == 10)) {
					this.k51 = 6
					this.k5  = 1
					this.k7  = 0.5
					this.k71 = 6
				}
				else {
					this.k5 = this.value_k5[this.k51].value
					this.k7 = this.value_k7[this.k71].value
				}
			},
			ifk6: function(var1,var2) {
				this.k6 = (this.k41 == 0) ? var1 : var2
			},
			switchk1: function() {
				if ((this.k31 == 3) || (this.k31 == 4)) {
					this.k6 = this.k619
				}
				else {
					switch (this.k11) {
						case 0:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 1:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 2:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 3:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 4:
							this.ifk6(this.k612[this.k21][this.fr], this.k614[this.k21][this.fr])						
							break;
						case 5:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 6:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 7:
							this.ifk6(this.k617[this.k21][this.fr], this.k618[this.k21][this.fr])
							break;
						case 8:
							this.ifk6(this.k617[this.k21][this.fr], this.k618[this.k21][this.fr])
							break;
						case 9:
							this.ifk6(this.k615[this.k21][this.fr], this.k616[this.k21][this.fr])
							break;
						case 10:
							this.ifk6(this.k615[this.k21][this.fr], this.k616[this.k21][this.fr])
							break;
						case 11:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						case 12:
							this.ifk6(this.k611[this.k21][this.fr], this.k613[this.k21][this.fr])
							break;
						default:
							this.k6 = this.k612[this.k21][this.fr]
							break;
					}
				}
			},				
			print: function(){
				console.log('fr='+this.fr)
				console.log('print base='+this.base +' k1='+ this.k1+' k2='+this.k2+' k3='+this.k3+' k4='+this.k4+' k5='+this.k5+' k6='+this.k6+' k7='+this.k7+' k8='+this.k8+' k9='+this.k9)
			},
			printShow: function() {
				console.log('showk1='+this.showk1+' showk41='+this.showk41+' showk42='+this.showk42)
			}	
		},
		created: function() {
			this.k1 = this.value_k1[this.k11].value[this.fr]
			this.k2 = this.value_k2[this.k21].value[this.fr]
			this.k3 = this.value_k3[this.k31].value
			this.k4 = this.value_k4[this.k41].value
			this.k7 = this.value_k7[this.k71].value
			this.k6 = this.k611[this.k21][this.fr]
		}
})
})( jQuery )