define(
	['require', 'phaser', 'lodash', 'util/publisher', 'app/game'],
	function (require, Phaser, _, publisher, Game) { 
		'use strict';

		var localPub = publisher();
		var theGame = {};
		var theParent = {};

		function Items() {    
			console.log('initiating the Items');    
		}
		
		Items.prototype = {
			constructor: Items,

			coinsAnimLength: 6,
			shiftVal: 0,
			gameBoardHeight: 16,
			dupLength: 2,
			windowWidth: 24,
			windowHeight: 8,
			marginX: 2,
			marginY: 2,
			rot: [0, 1, 2, 3, 4, 5],
			colGrp: {},
			table: {},
			coins: [],

			init: function(game, parent) {
				this.windowWidth = 24;
				this.windowHeight = 8;
				theParent = parent;
				theGame = game;
			},

			create: function() {
				this.createSquareOfCoins({
					boxWidth: 5,
					boxHeight: 3
				});
				this.render({
					posX: 4,
					posY: 2,
				});
			},

			render: function(cData) {

				this.colGrp = theGame.add.group();

				for (var y = 0; y < this.windowHeight; y++) {
					for (var x = 0; x < this.windowWidth; x++) {
						if(this.table['sq'][y][x] == 'c'){
							var coin = theGame.add.sprite(
								( this.marginX + x + cData.posX ) * 32, 
								( this.marginY + y + cData.posY ) * 32,
								'money', (x*2+y)%this.rot.length, this.colGrp);
							coin.animations.add('rotate', this.rotate(this.rot, (x*2+y)%this.rot.length));
							coin.animations.play('rotate', 20, true);

							coin.enableBody = true;
							coin.physicsBodyType = Phaser.Physics.ARCADE;

						}
					};
				};
				publisher.publish('onReady.coins', this.colGrp);
			},

			createSquareOfCoins: function(cData) {
				var tbl = this.cleanTable();
				for (var y = 0; y < cData.boxHeight; y++) {
					for (var x = 0; x < cData.boxWidth; x++) {
						tbl[y][x] = 'c';
					}
				}
				this.table['sq'] = tbl;
			},

			cleanTable: function () {
				var arr = [];
				for (var x = 0; x < this.windowWidth; x++) {
					arr[x] = [];
					for (var y = 0; y < this.windowHeight; y++) {
						arr[x][y] = 'x';
					}
				}
				return arr;
			},

		    rotate: function(array, n, guard) {
				var head, tail;
		        n = (n == null) || guard ? 1 : n;
		        n = n % array.length;
		        tail = array.slice(n);
				head = array.slice(0, n);
				return tail.concat(head);
		    },

			calcSineTable: function (cData) {

				var counter = 0;
				// 100 iterations
				var increase = Math.PI * 2 / 100;
				var j=0;
				var x,y;
				var coin = [];

				var tbl = this.cleanTable();

				var xc,yc;
				for ( var i = 0; i <= cData.lengthDegree/360; i += cData.flattenY/100 ) {
					y = Math.sin( counter ) / 2;

					xc = Math.floor((i * this.windowWidth * 32) / 32);
					yc = Math.floor((y * this.windowHeight * 32) / 32) + (this.windowHeight / 2);

					tbl[yc][xc] = 'c';

					counter += increase;
				}

				this.table['sine'] = tbl;
			},

			update: function() {

			},

		};
		return Items;
	}
);